<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');
App::import('Vendor', 'DOMPDF', true, array(), 'dompdf'.DS.'dompdf_config.inc.php', false);

class DeliveriesController extends DeliveryAppController {

   
    public $uses = array('Delivery.Delivery', 'Delivery.DeliveryDetail');
    public $helpers = array('Accounting.PhpExcel');
    public $paginate = array(
        'limit' => 10
    );

    public function index() {

        $userData = $this->Session->read('Auth');

        $this->loadModel('Sales.ClientOrder');

        $this->loadModel('Sales.ClientOrderDeliverySchedule');

        $deliveryData = $this->Delivery->find('list',array('fields' => array('schedule_uuid','status')));

        $this->ClientOrder->bindDelivery();

        //pr($deliveryData); exit;

        // $clientsOrder = $this->ClientOrder->find('all', array(
        //                                 'order' => 'ClientOrderDeliverySchedule.id DESC'
        //                                 ));  
        
        $this->ClientOrder->bindDelivery();
        $clientsStatus = $this->ClientOrder->find('all',array( 'conditions' => array(
                                        'ClientOrderDeliverySchedule.client_order_id' => 86
                                        )));

        $this->Delivery->bindDelivery();
        $deliveryStatus = $this->Delivery->find('all');

        $deliveryList = $this->Delivery->find('list',array('fields' => array('schedule_uuid', 'dr_uuid')));

        $orderList = $this->DeliveryDetail->find('list',array('fields' => array('delivery_uuid', 'status')));

        $orderListHelper = $this->Delivery->find('list',array('fields' => array('clients_order_id', 'dr_uuid')));

        $orderDeliveryList = $this->ClientOrderDeliverySchedule->find('list',array('fields' => array('uuid', 'uuid')));

        $deliveryDetailList = $this->DeliveryDetail->find('list',array('fields' => array('delivery_uuid', 'delivered_quantity')));

        $this->ClientOrder->bindDelivery();

        $this->ClientOrder->recursive = 1;

        $limit = 5;

        $conditions = array();

        $this->ClientOrder->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'fields' => array(
              'ClientOrder.uuid',
              'ClientOrder.po_number',
              'Company.company_name',  
              'Product.name', 
              'ClientOrderDeliverySchedule.quantity', 
              'ClientOrderDeliverySchedule.location', 
              'ClientOrderDeliverySchedule.schedule'
              ),
            'order' => 'ClientOrder.id DESC',
        );

        $clientsOrder = $this->paginate('ClientOrder');

        //no permission sales/Receivable Staff/Accounting Head
        if ($userData['User']['role_id'] == 3 || $userData['User']['role_id'] == 6 || $userData['User']['role_id'] == 9) {

            $noPermissionSales = 'disabled not-active';

        }else{
            $noPermissionSales = ' ';
        }

        $this->set(compact('noPermissionSales','clientsOrder','deliveryData', 'deliveryList', 'deliveryDetailList', 'clientsStatus', 'deliveryStatus', 'orderList', 'orderListHelper', 'orderDeliveryList'));
    }

    public function add($deliveryScheduleId = null,$quotationId = null, $clientsOrderUuid = null){

      $userData = $this->Session->read('Auth');
      
        $this->loadModel('Sales.ClientOrderDeliverySchedule');

        $this->ClientOrderDeliverySchedule->bind(array('ClientOrder'));

        $scheduleInfo = $this->ClientOrderDeliverySchedule->find('first', array(
                                                                         'conditions' => array(
                                                                          'ClientOrderDeliverySchedule.id' => $deliveryScheduleId
                                                                        )
                                                                    ));

        $DRdata = $this->Delivery->find('first', array(
                    'conditions' => array(
                      'Delivery.dr_uuid' => $this->request->data['Delivery']['dr_uuid'])
                    ));

             
        if (!empty($DRdata)) {

            $this->Session->setFlash(__('The Delivery Receipt No. already exists'), 'error');
          
            $this->redirect( array(
                'controller' => 'deliveries',   
                'action' => 'view',$deliveryScheduleId,$quotationId,$clientsOrderUuid
            ));  
        }

        $this->request->data['Delivery']['schedule_uuid'] = $scheduleInfo['ClientOrderDeliverySchedule']['uuid'];
        $this->request->data['Delivery']['clients_order_id']  = $scheduleInfo['ClientOrder']['uuid'];
        $this->request->data['Delivery']['status']  = '1';
        $this->request->data['DeliveryDetail']['location']  = $scheduleInfo['ClientOrderDeliverySchedule']['location'];
        $this->request->data['DeliveryDetail']['quantity']  = $scheduleInfo['ClientOrderDeliverySchedule']['quantity'];
        $this->request->data['DeliveryDetail']['schedule']  = $scheduleInfo['ClientOrderDeliverySchedule']['schedule'];
        $this->request->data['DeliveryDetail']['created_by']  = $userData['User']['id'];
        $this->request->data['Delivery']['modified_by']  = $userData['User']['id'];
        $this->request->data['DeliveryDetail']['modified_by']  = $userData['User']['id'];
        $this->request->data['DeliveryDetail']['delivery_uuid']  = $this->request->data['Delivery']['dr_uuid'];
        $this->request->data['DeliveryDetail']['remaining_quantity'] = ($this->request->data['ClientOrderDeliverySchedule']['quantity']) - ($this->request->data['DeliveryDetail']['quantity']);

        $this->Delivery->create();

        $this->id = $this->Delivery->saveDelivery($this->request->data,$userData['User']['id']);

        $this->DeliveryDetail->saveDeliveryDetail($this->request->data,$userData['User']['id']);

        $this->Session->setFlash(__('Delivery receipt was issued'));

        $this->redirect(

            array('controller' => 'deliveries', 'action' => 'view',$deliveryScheduleId,$quotationId,$clientsOrderUuid)

        );

        $this->set(compact('scheduleInfo'));
        
    }

    public function find_data($id = null){

        $this->layout = false;
        $this->loadModel('Delivery.Schedule');
        $data = $this->Schedule->find('first', array(
             'conditions' => array(
                'sales_order_id' => $id
            )
        ));
   
        echo json_encode($data);

        $this->autoRender = false;

    }

    public function view($deliveryScheduleId = null, $quotationId = null, $clientsOrderUuid = null) {

        $this->loadModel('Sales.ClientOrderDeliverySchedule');

        $this->loadModel('Sales.ClientOrder');

        $this->loadModel('Sales.Address');

        $this->loadModel('Delivery.DeliveryReceipt');

        $this->ClientOrder->bindDelivery();
        $scheduleInfo = $this->ClientOrder->find('first', array(
                                         'conditions' => array(
                                          'ClientOrderDeliverySchedule.id' => $deliveryScheduleId
                                        )
                                    ));

        $this->Delivery->bindDelivery();
        $deliveryDetailsData = $this->Delivery->find('all',array('order' => 'Delivery.id DESC'));

        // $deliveryDetailsData = $this->Delivery->find('all', array(
        //                                  'conditions' => array(
        //                                 'Delivery.schedule_uuid' => $clientsOrderUuid
        //                                 )
        //                             ));



        $this->Delivery->bindDeliveryView();
        $deliveryEdit = $this->Delivery->find('all', array(
                                         'conditions' => array(
                                        'Delivery.schedule_uuid' => $clientsOrderUuid
                                        ),
                                        'order' => 'Delivery.id DESC'
                                    ));

        //pr($deliveryEdit); exit;

        $this->Delivery->bindDelivery();
        $drData = $this->Delivery->find('all');

        $this->DeliveryReceipt->bindDelivery();

        $DeliveryReceiptData =  $this->DeliveryReceipt->find('all');

        $deliveryDetailList = $this->DeliveryDetail->find('list',array('fields' => array('delivery_uuid', 'delivered_quantity')));
        
        $deliveryList = $this->Delivery->find('list',array('fields' => array('schedule_uuid', 'dr_uuid')));  

        $quantityInfo = $this->ClientOrderDeliverySchedule->find('list',array('fields' => array('uuid','quantity')));

        $deliveryData = $this->Delivery->find('list',array('fields' => array('schedule_uuid','status')));

        $deliveryDataID = $this->Delivery->find('list',array('fields' => array('schedule_uuid','id')));

        $this->Delivery->bindDelivery();
        $deliveryStatus = $this->Delivery->find('all');

        $deliveryList = $this->Delivery->find('list',array('fields' => array('schedule_uuid', 'dr_uuid')));

        $orderList = $this->DeliveryDetail->find('list',array('fields' => array('delivery_uuid', 'status')));

        $orderListHelper = $this->Delivery->find('list',array('fields' => array('clients_order_id', 'dr_uuid')));

        $orderDeliveryList = $this->ClientOrderDeliverySchedule->find('list',array('fields' => array('uuid', 'uuid')));

        $companyAddress = $this->Address->find('list',array('fields' => array('address1','address1','foreign_key')));
 
        $this->ClientOrder->bindDelivery();

        $clientsOrder = $this->ClientOrder->find('first', array(
                                              'conditions' => array('ClientOrderDeliverySchedule.uuid' => $clientsOrderUuid
                                              )));    

        if ($this->request->is(array('post', 'put'))) {

            $this->ClientOrderDeliverySchedule->id = $this->request->data['ClientOrderDeliverySchedule']['id'];

            if ($this->ClientOrderDeliverySchedule->save($this->request->data)) {

                $this->ClientOrderDeliverySchedule->save($this->request->data);
                $this->Session->setFlash(__('Schedule has been updated.'),'success');
                $this->redirect( array(
                             'controller' => 'deliveries', 
                             'action' => 'view'
                        ));
            }
            $this->Session->setFlash(__('Unable to update your post.'));
        }

        $noPermissionSales = ' ';

        $this->set(compact('noPermissionSales','driverList','helperList','truckList','deliveryScheduleId','quotationId','clientsOrderUuid','scheduleInfo','deliveryData', 'quantityInfo','deliveryDataID','deliveryDetailsData', 'deliveryEdit', 'deliveryDetailList','deliveryList','deliveryStatus', 'orderList', 'orderListHelper', 'orderDeliveryList', 'clientsOrder', 'companyAddress', 'drData', 'deliveryDetailsData', 'DeliveryReceiptData'));
        
        //if ($gatepass == 1) {
          
            //$this->render('print_gatepass');

        //}
    }

    public function add_schedule($idDelivery = null,$idDeliveryDetail = null,$deliveryScheduleId = null, $quotationId = null, $clientsOrderUuid = null) {

        $userData = $this->Session->read('Auth');

        $this->loadModel('Delivery.DeliveryDetail');

        $this->loadModel('Sales.ClientOrder');

        $this->Delivery->bindDelivery();

        $deliveryData = $this->Delivery->find('first', array('conditions' => array(
                                  'Delivery.schedule_uuid' => $this->request->data['Delivery']['schedule_uuid']),
                                  'order' => 'Delivery.id DESC'));

        if ($this->request->is(array('post', 'put'))) {

            $this->Delivery->id = $idDelivery;
            $this->DeliveryDetail->id = $idDeliveryDetail;

            $DRdata = $this->Delivery->find('first', array(
                    'conditions' => array(
                      'Delivery.dr_uuid' => $this->request->data['Delivery']['dr_uuid'])
                    ));

            if (!empty($DRdata)) {

                $this->Session->setFlash(__('The Delivery Receipt No. already exists'), 'error');
              
                $this->redirect( array(
                           'controller' => 'deliveries',   
                           'action' => 'view',$deliveryScheduleId,$quotationId,$clientsOrderUuid
                      ));  
            }

            $this->request->data['DeliveryDetail']['delivery_uuid'] =  $this->request->data['Delivery']['dr_uuid']; 
            $this->request->data['DeliveryDetail']['created_by'] =  $userData['User']['id'];    
            $this->request->data['Delivery']['status'] =  '1';   
            $this->request->data['Delivery']['modified_by'] =  $userData['User']['id']; 
  
            $this->Delivery->saveDelivery($this->request->data,$userData['User']['id']);
            $this->DeliveryDetail->saveDeliveryDetail($this->request->data,$userData['User']['id']);
  
            $this->Session->setFlash(__('Schedule has been updated.'),'success');
            $this->redirect( array(
                           'controller' => 'deliveries', 
                           'action' => 'view',$deliveryScheduleId,$quotationId,$clientsOrderUuid
                      ));
            
            $this->Session->setFlash(__('Unable to update your post.'));
        }

        $this->set(compact('scheduleInfo',  'deliveryData'));
        
    }

    public function delivery_return($deliveryScheduleId = null,$quotationId = null,$clientsOrderUuid =null) {

        $userData = $this->Session->read('Auth');

        if ($this->request->is(array('post', 'put'))) {

            // if($this->request->data['DeliveryDetail']['quantity'] == $this->request->data['DeliveryDetail']['delivered_quantity']){

            //     $this->request->data['DeliveryDetail']['status'] =  '4'; 

            // }else{

                $this->request->data['DeliveryDetail']['status'] =  '3';

            
            //}

            if(!empty($this->request->data['DeliveryDetail']['from_replacing'])){     

                if($this->request->data['DeliveryDetail']['from_replacing'] = 'replacing'){

                    $this->request->data['DeliveryDetail']['delivered_quantity'] =  $this->request->data['DeliveryDetail']['delivered'] + $this->request->data['DeliveryDetail']['delivered_quantity'];

                }
            }

            if(!empty($this->request->data['DeliveryDetail']['holder'])){  

                $this->request->data['DeliveryDetail']['quantity'] = $this->request->data['DeliveryDetail']['holder'];

            }
            
            $this->DeliveryDetail->saveDeliveryDetail($this->request->data,$userData['User']['id']);

            $this->Session->setFlash(__('Delivered quantity has been recorded.'),'success');

            $this->redirect( array(
                           'controller' => 'deliveries', 
                           'action' => 'view',$deliveryScheduleId,$quotationId,$clientsOrderUuid
                      ));
            
        }
       
    }

    public function delivery_replacing() {

        $userData = $this->Session->read('Auth');

        $this->loadModel('Sales.ClientOrderDeliverySchedule');

        $this->loadModel('Delivery.DeliveryReceipt');

        $this->loadModel('Delivery.Transmittal');

        $this->loadModel('Sales.ClientOrder');

        $this->Delivery->bindDeliveryView();
      
        $deliveryEdit = $this->Delivery->find('all', array(
                                             'conditions' => array(
                                            'DeliveryDetail.quantity != DeliveryDetail.delivered_quantity' , "DeliveryDetail.status !=" => "5"),
                                            'order' => 'DeliveryDetail.modified DESC'
                                           // 'fields' => array('DISTINCT Delivery.dr_uuid', 'DeliveryDetail.schedule','DeliveryDetail.location', 'DeliveryDetail.quantity','DeliveryDetail.delivered_quantity', 'DeliveryDetail.status', 'DeliveryReceipt.type', 'Delivery.schedule_uuid','DeliveryDetail.id', 'Transmittal.type' ,'DeliveryDetail.delivery_uuid'),
                                        ));

        $this->DeliveryReceipt->bindDelivery();

        $DeliveryReceiptData =  $this->DeliveryReceipt->find('all');

        $this->Transmittal->bindDelivery();

        $TransmittalData =  $this->Transmittal->find('all');

        //pr($TranmisttalData); exit;

        $this->ClientOrder->bindDelivery();

        $clientOrderData = $this->ClientOrderDeliverySchedule->find('list',array('fields' => array('uuid','id')));

        $scheduleInfo = $this->ClientOrder->find('all');

        // $this->Delivery->bindDeliveryView();

        // $limit = 1;

        // $conditions =  array('DeliveryDetail.quantity != DeliveryDetail.delivered_quantity' , "DeliveryDetail.status !=" => "5");

        // $this->Delivery->paginate = array(
        //     'conditions' => $conditions,
        //     'limit' => '1',
        //     'fields' => array(
        //       'Delivery.dr_uuid',
        //       'DeliveryDetail.schedule',
        //       'DeliveryDetail.quantity',  
        //       'DeliveryDetail.location', 
        //       'DeliveryDetail.delivered_quantity', 
        //       'DeliveryDetail.location', 
        //       'DeliveryDetail.status'
        //       ),
        //     'order' => 'Delivery.id DESC',
        // );

        // $deliveryEdit = $this->paginate('Delivery');

        $noPermissionSales = ' '; 

        $this->set(compact('noPermissionSales','deliveryEdit', 'scheduleInfo', 'clientOrderData', 'DeliveryReceiptData', 'TransmittalData'));     
            
    }

    public function delivery_edit($dr_uuid = null, $clientsOrderUuid = null) {

        $userData = $this->Session->read('Auth');

        $this->loadModel('Sales.ClientOrder');

        $this->loadModel('Sales.Address');

        $this->Delivery->bindDelivery();

        $deliveryEdit = $this->Delivery->find('first', array(
                                         'conditions' => array(
                                        'DeliveryDetail.delivery_uuid' => $dr_uuid
                                        )
                                    ));

        $this->Delivery->bindDelivery();
        $deliveryData = $this->Delivery->find('all', array(
                                       'conditions' => array(
                                      'Delivery.schedule_uuid' => $clientsOrderUuid
                                      )
                                  ));

        $this->ClientOrder->bindDelivery();
        $scheduleInfo = $this->ClientOrder->find('first', array(
                                         'conditions' => array(
                                          'ClientOrderDeliverySchedule.uuid' => $clientsOrderUuid
                                        )
                                    ));

        $clientOrderData = $this->ClientOrder->find('list',array('fields' => array('uuid','po_number')));

        $companyAddress = $this->Address->find('list',array('fields' => array('address1','address1','foreign_key')));

        $this->loadModel('Sales.ClientOrder');
        $this->ClientOrder->bindDelivery();

        $clientsOrder = $this->ClientOrder->find('first', array(
                                        'conditions' => array('ClientOrderDeliverySchedule.uuid' => $clientsOrderUuid
                                        )));    
 
        if ($this->request->is(array('post', 'put'))) {

            $this->request->data['DeliveryDetail']['remaining_quantity'] = ($this->request->data['ClientOrderDeliverySchedule']['quantity']) - ($this->request->data['DeliveryDetail']['quantity']);
               
            $this->DeliveryDetail->saveDeliveryDetail($this->request->data,$userData['User']['id']);
                    
            $this->Session->setFlash(__('Delivery Receipt has been updated.'),'success');

            $this->redirect( array(
                 'controller' => 'deliveries', 
                 'action' => 'view',$clientsOrder['ClientOrderDeliverySchedule']['id'],
                                    $clientsOrder['QuotationDetail']['quotation_id'],
                                    $deliveryEdit['Delivery']['schedule_uuid']
            ));
                
            $this->Session->setFlash(__('Unable to update your post.'));
        }            

        $noPermissionSales = ' ';
        
        $this->set(compact('deliveryEdit', 'clientOrderData', 'clientsOrder', 'deliveryData', 'scheduleInfo', 'userData', 'companyAddress', 'noPermissionSales'));      
    }

    public function delivery_transmittal($dr_uuid = null,$schedule_uuid,$paper = null) {

        $userData = $this->Session->read('Auth');

        $this->loadModel('Sales.ClientOrder');

        $this->ClientOrder->bind(array('Quotation','ClientOrderDeliverySchedule','QuotationItemDetail','QuotationDetail','Product'));
        
        $this->loadModel('Sales.Company');

        $this->loadModel('Unit');

        $this->loadModel('Sales.Address');

        $companyAddress = $this->Address->find('list',array('fields' => array('address1','address1','foreign_key')));

        $units = $this->Unit->find('list',array('fields' => array('id','unit')));

        $this->Company->bind('Address');

        $this->Delivery->bindDelivery();
        $drData = $this->Delivery->find('first', array(
                                            'conditions' => array('Delivery.dr_uuid' => $dr_uuid
                                            )));
        
        $clientData = $this->ClientOrder->find('first', array(
                                            'conditions' => array('ClientOrder.uuid' => $drData['Delivery']['clients_order_id']
                                            )));
        
        $companyData = $this->Company->find('first', array(
                                            'conditions' => array('Company.id' => $clientData['ClientOrder']['company_id']
                                            )));

        $nameForm = "Delivery Receipt";

        $noPermissionSales = ' ';

        $this->set(compact('drData','clientData','companyData','units','nameForm', 'companyAddress', 'noPermissionSales'));
        
    }

    public function delivery_receipt($dr_uuid = null,$schedule_uuid,$paper = null) {

        $userData = $this->Session->read('Auth');

        $this->loadModel('Sales.ClientOrder');

        $this->ClientOrder->bind(array('Quotation','ClientOrderDeliverySchedule','QuotationItemDetail','QuotationDetail','Product'));
        
        $this->loadModel('Sales.Company');

        $this->loadModel('Unit');

        $this->loadModel('Sales.Address');

        $companyAddress = $this->Address->find('list',array('fields' => array('address1','address1','foreign_key')));

        $units = $this->Unit->find('list',array('fields' => array('id','unit')));

        $this->Company->bind('Address');

        $this->Delivery->bindDelivery();
        $drData = $this->Delivery->find('first', array(
                                            'conditions' => array('Delivery.dr_uuid' => $dr_uuid
                                            )));
        
        $clientData = $this->ClientOrder->find('first', array(
                                            'conditions' => array('ClientOrder.uuid' => $drData['Delivery']['clients_order_id']
                                            )));
        
        $companyData = $this->Company->find('first', array(
                                            'conditions' => array('Company.id' => $clientData['ClientOrder']['company_id']
                                            )));

        $nameForm = "Delivery Receipt"; 

        $noPermissionSales = ' ';

        $this->set(compact('drData','clientData','companyData','units','nameForm', 'companyAddress','noPermissionSales'));
    
    }

   public function delivery_transmittal_record() {

      $userData = $this->Session->read('Auth');

      $this->loadModel('Sales.ClientOrderDeliverySchedule');

      $this->loadModel('Sales.ClientOrder');

      $this->loadModel('Delivery.Transmittal');

      $this->Delivery->bindDelivery();

      $this->Transmittal->bind(array('Delivery','DeliveryDetail'));

      // $transmittalData = $this->Transmittal->find('all', array(
      //                                       'order' => 'Transmittal.id DESC'
      //                                   ));

      $this->Transmittal->recursive = 1;

        $limit = 5;

        $conditions = array();

        $this->Transmittal->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'fields' => array(
            'Transmittal.tr_uuid',
            'Transmittal.dr_uuid',
            'Transmittal.quantity', 
            'Transmittal.contact_person'
              ),
            'order' => 'Transmittal.id DESC',
        );

      $transmittalData = $this->paginate('Transmittal');

      $this->ClientOrder->bindDelivery();

      $clientOrderData = $this->ClientOrderDeliverySchedule->find('list',array('fields' => array('uuid','id')));

      $scheduleInfo = $this->ClientOrder->find('all');

      $noPermissionSales = ' ';

      $this->set(compact('noPermissionSales','transmittalData', 'scheduleInfo', 'clientOrderData'));     
        
}

    public function dr_record() {

        $userData = $this->Session->read('Auth');

        $this->loadModel('Sales.ClientOrderDeliverySchedule');

        $this->loadModel('Sales.ClientOrder');

        $this->loadModel('User');

        $this->loadModel('Delivery.DeliveryReceipt');

        $this->loadModel('Delivery.Delivery');

        $this->Delivery->bindDelivery();

        $this->DeliveryReceipt->bind('Delivery');

        $this->ClientOrder->bindDelivery();

        $userFName = $this->User->find('list',array('fields' => array('id','first_name')));

        $userLName = $this->User->find('list',array('fields' => array('id','last_name')));

        $noPermissionSales = ' ';

        $this->DeliveryReceipt->bind('Delivery');

        $this->DeliveryReceipt->recursive = 1;

        $limit = 10;

        $conditions = array();
    
        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'fields' => array(
                'DeliveryReceipt.id', 
                'DeliveryReceipt.dr_uuid', 
                'DeliveryReceipt.schedule',
                'DeliveryReceipt.quantity',
                'DeliveryReceipt.location',
                'DeliveryReceipt.remarks',
                'DeliveryReceipt.printed_by',
                'DeliveryReceipt.printed',
                'DeliveryReceipt.type',
                'Delivery.id',
                'Delivery.schedule_uuid'
                ),
            'order' => 'DeliveryReceipt.id DESC',
        );

        $DRData = $this->paginate('DeliveryReceipt');

        $this->set(compact('noPermissionSales','DRData','userFName','userLName'));     
        
    }

    public function search_order($hint = null){

        $this->loadModel('Sales.ClientOrder');

        $this->loadModel('Sales.ClientOrderDeliverySchedule');

        $this->ClientOrder->bindDelivery();

        $clientsOrder = $this->ClientOrder->find('all',array(
                      'conditions' => array(
                        'OR' => array(
                        array('ClientOrder.po_number LIKE' => '%' . $hint . '%'),
                          array('Product.name LIKE' => '%' . $hint . '%'),
                          array('Company.company_name LIKE' => '%' . $hint . '%')
                          )
                        ),
                      'limit' => 10
                      )); 


        $deliveryData = $this->Delivery->find('list',array('fields' => array('schedule_uuid','status')));

        $this->Delivery->bindDelivery();
        $deliveryStatus = $this->Delivery->find('all');

        $deliveryList = $this->Delivery->find('list',array('fields' => array('schedule_uuid', 'dr_uuid')));

        $orderList = $this->DeliveryDetail->find('list',array('fields' => array('delivery_uuid', 'status')));

        $orderListHelper = $this->Delivery->find('list',array('fields' => array('clients_order_id', 'dr_uuid')));

        $orderDeliveryList = $this->ClientOrderDeliverySchedule->find('list',array('fields' => array('uuid', 'uuid')));

        $deliveryDetailList = $this->DeliveryDetail->find('list',array('fields' => array('delivery_uuid', 'delivered_quantity')));

        $this->set(compact('clientsOrder', 'deliveryStatus', 'deliveryList', 'orderListHelper', 'orderDeliveryList', 'deliveryDetailList' , 'deliveryData'));

        if ($hint == ' ') {
            $this->render('index');
        }else{
            $this->render('search_order');
        }
    }

    public function dr($dr_uuid = null,$schedule_uuid) {

    $this->loadModel('Sales.ClientOrder');

    $this->ClientOrder->bind(array('Quotation','ClientOrderDeliverySchedule','QuotationItemDetail','QuotationDetail','Product'));
    
    $this->loadModel('Sales.Company');

    $this->loadModel('Delivery.DeliveryReceipt');

    $this->loadModel('Unit');
    $units = $this->Unit->getList();

    $this->Company->bind('Address');

    $this->Delivery->bindDelivery();
    $drData = $this->Delivery->find('first', array(
                                        'conditions' => array('Delivery.dr_uuid' => $dr_uuid
                                        )));

    $clientData = $this->ClientOrder->find('first', array(
                                        'conditions' => array('ClientOrder.uuid' => $drData['Delivery']['clients_order_id']
                                        )));
    
    $companyData = $this->Company->find('first', array(
                                        'conditions' => array('Company.id' => $clientData['ClientOrder']['company_id']
                                        )));


    $userData = $this->Session->read('Auth');

    $this->Delivery->bindDelivery();
    $drDataHolder = $this->Delivery->find('first', array(
                                        'conditions' => array('Delivery.dr_uuid' => $dr_uuid
                                        )));

    $this->loadModel('User');

    $this->loadModel('Delivery.DeliveryReceipt');

    $this->Delivery->bindDelivery();

    $this->DeliveryReceipt->bind('Delivery');
  
    $DRRePrint = $this->DeliveryReceipt->find('all', array(
                                        'conditions' => array('DeliveryReceipt.dr_uuid' => $drData['Delivery']['dr_uuid'])
                                     ));

    $this->request->data['DeliveryReceipt']['printed_by'] = $userData['User']['id'];

    $this->request->data['DeliveryReceipt']['dr_uuid'] = $drData['Delivery']['dr_uuid'];

    $this->request->data['DeliveryReceipt']['schedule'] = $drData['DeliveryDetail']['schedule'];

    $this->request->data['DeliveryReceipt']['approved_by'] = $drData['DeliveryDetail']['created_by'];

    $this->request->data['DeliveryReceipt']['printed'] = date("y-m-d");

    if ($this->request->is(array('post', 'put'))) {

       // $this->request->data['DeliveryReceipt']['quantity'] = $drData['DeliveryDetail']['limit'];

        $this->request->data['DeliveryReceipt']['remarks'] = $this->request->data['DeliveryDetail']['remarks'];

        $this->request->data['DeliveryReceipt']['location'] = $this->request->data['DeliveryDetail']['location'];

        $this->request->data['DeliveryReceipt']['type'] = 'replacing';       
                  
    }else{  

       $this->request->data['DeliveryReceipt']['quantity'] = $drData['DeliveryDetail']['quantity'];

       $this->request->data['DeliveryReceipt']['location'] = $drData['DeliveryDetail']['location'];

       $this->request->data['DeliveryReceipt']['remarks'] = $drData['DeliveryDetail']['remarks'];

    }  

    $prepared = $userData;

    $approved = $this->User->find('first', array('fields' => array('id', 'first_name','last_name'),
                                                            'conditions' => array('User.id' => $drDataHolder['Delivery']['created_by'])
                                                            ));  

    if(empty($DRRePrint[0]['DeliveryReceipt']['dr_uuid']) OR (!empty($this->request->data['DeliveryReceipt']['type']))){

        if(!empty($this->request->data['DeliveryDetail']['new'])){

            $this->request->data['DeliveryReceipt']['dr_uuid'] = $this->request->data['DeliveryDetail']['delivery_uuid'];

            $idholder = $this->request->data['DeliveryDetail']['idholder'];

            if($this->request->data['DeliveryDetail']['delivery_uuid'] != $drData['Delivery']['dr_uuid']){

                $this->DeliveryDetail->id = $idholder;

                $this->DeliveryDetail->saveField('status', 5);

                unset($this->request->data['DeliveryDetail']['id']);

                $drQuantity = $this->request->data['DeliveryDetail']['delivered_quantity'];

                $drRemarks = $this->request->data['DeliveryDetail']['remarks'];

                $this->request->data['Delivery']['created_by'] = $drDataHolder['Delivery']['created_by'];

                $this->request->data['Delivery']['modified_by'] = $drDataHolder['Delivery']['modified_by'];

                $this->request->data['Delivery']['from'] = $this->request->data['Delivery']['dr_uuid'];

                $this->request->data['Delivery']['status'] = 1;

                $this->request->data['Delivery']['dr_uuid'] = $this->request->data['DeliveryDetail']['delivery_uuid'];

                $this->request->data['DeliveryDetail']['delivered_quantity'] = $drData['DeliveryDetail']['delivered_quantity'];

                $this->DeliveryDetail->saveDeliveryDetail($this->request->data);

                $this->Delivery->save($this->request->data['Delivery']);

            }else{ 

                $this->Session->setFlash(__('New Delivery Receipt Number is required.'), 'error');

                $this->redirect( array(
                  'controller' => 'deliveries',   
                  'action' => 'delivery_replacing'));
            }    
        }

        $this->DeliveryReceipt->save($this->request->data);   

        $this->Session->setFlash(__('DR has is now ready to print.'), 'success');
    }

    $this->set(compact('drData','clientData','companyData','units','approved','prepared', 'DRRePrint', 'drQuantity','drRemarks'));

   // $this->render('dr'); 

    }

    public function tr($dr_uuid = null,$schedule_uuid) {

    $this->loadModel('Delivery.Transmittal');

    $this->loadModel('Sales.ClientOrder');

    $this->ClientOrder->bind(array('Quotation','ClientOrderDeliverySchedule','QuotationItemDetail','QuotationDetail','Product'));
    
    $this->loadModel('Sales.Company');

    $this->loadModel('Unit');
    $units = $this->Unit->getList();

    $this->Company->bind('Address');

    //pr($this->request->data); exit;

    $TRdata = $this->Transmittal->find('first', array(
                    'conditions' => array(
                      'Transmittal.dr_uuid' => $dr_uuid
                    )));

    //pr($TRdata); exit;

    $TRRePrint = $this->Transmittal->find('all', array(
                                        'conditions' => array('Transmittal.dr_uuid' => $dr_uuid)
                                     ));

    //pr($TRRePrint); exit;

    if(!empty($this->request->data['DeliveryDetail']['quantity'])){

       $this->DeliveryDetail->save($this->request->data['DeliveryDetail']);

    }

    if(!empty($this->request->data)){

      $contactPerson = $this->request->data['Transmittal']['contact_person'];

      $quantityTransmittal = $this->request->data['Transmittal']['quantity'];

      $remarks = $this->request->data['Transmittal']['remarks'];

    }else{

      $contactPerson = $TRdata['Transmittal']['contact_person'];

      $quantityTransmittal = $TRdata['Transmittal']['quantity'];

      $remarks = $TRdata['Transmittal']['remarks'];

    }

    $this->Delivery->bindDelivery();
    $drData = $this->Delivery->find('first', array(
                                        'conditions' => array('Delivery.dr_uuid' => $dr_uuid
                                        )));

 
    $clientData = $this->ClientOrder->find('first', array(
                                        'conditions' => array('ClientOrder.uuid' => $drData['Delivery']['clients_order_id']
                                        )));
    
    $companyData = $this->Company->find('first', array(
                                        'conditions' => array('Company.id' => $clientData['ClientOrder']['company_id']
                                        )));


    $userData = $this->Session->read('Auth');

    $this->Delivery->bindDelivery();
    $drDataHolder = $this->Delivery->find('first', array(
                                        'conditions' => array('Delivery.dr_uuid' => $dr_uuid
                                        )));

    $this->loadModel('User');

    $prepared = $userData;


    $approved = $this->User->find('first', array('fields' => array('id', 'first_name','last_name'),
                                                            'conditions' => array('User.id' => $drDataHolder['DeliveryDetail']['created_by'])
                                                            ));
     // pr($approved); pr($prepared); exit;
    $this->set(compact('drData','clientData','companyData','units','approved','prepared', 'contactPerson', 'quantityTransmittal', 'remarks', 'TRRePrint'));

    if ($this->request->is(array('post', 'put'))) {

                 $this->request->data['Transmittal']['created_by'] = $userData['User']['id'];

                 $this->request->data['Transmittal']['type'] = 'replacing';

                 $this->Transmittal->save($this->request->data);               
                          
    }   
    // $this->render('delivery_replacing'); 
  }

    public function add_gatepass(){
        
        $userData = $this->Session->read('Auth');
        
        $this->loadModel('GatePass');
        $this->loadModel('GatePassAssistant');
        $this->loadModel('Sales.ClientOrder');
        $this->loadModel('Sales.Company');
        $this->loadModel('Driver');
        $this->loadModel('Assistant');
        $this->loadModel('Truck');
        $this->loadModel('Unit');
        
        $this->ClientOrder->bind(array('Quotation','ClientOrderDeliverySchedule','QuotationItemDetail','QuotationDetail','Product'));

        if (!empty($this->request->data)) {
            
            $gateId = $this->GatePass->saveGatepass($this->request->data,$userData['User']['id']);
            
            $this->GatePassAssistant->saveGatePassAssistant($this->request->data,$gateId,$userData['User']['id']);
            
            //$this->Session->setFlash(__('The Gate Pass successfully added.'), 'success');
            $gateData = $this->GatePass->findById($gateId);
            $assistData = $this->GatePassAssistant->find('all', array(
                                        'conditions' => array('GatePassAssistant.helper_id' => $gateId
                                        )));
            $driverList = $this->Driver->find('list', array(
                                        'fields' => array('id','full_name')));
            $assList = $this->Assistant->find('list', array(
                                        'fields' => array('id','full_name')));
            $truckList = $this->Truck->find('list', array(
                                        'fields' => array('id','truck_no')));

           // pr($this->request->data); 
           
            $productList = array();
            $productQuantity = array();
            $productUnit = array();

            foreach ($this->request->data['GatePass_uuid'] as $key => $value){
            
            //pr($value);
            $this->Delivery->bindDelivery();    

            $drData = $this->Delivery->find('first', array(
                                        'conditions' => array('Delivery.dr_uuid' => $value['ref_uuid']
                                        )));


            $this->ClientOrder->bindClientDelivery();

            $clientData = $this->ClientOrder->find('first', array(
                                        'conditions' => array('ClientOrder.uuid' => $drData['Delivery']['clients_order_id']
                                        )));

        
           // $this->request->data['ProductList'][$key] = $clientData['Product']['name'];
            array_push($productList, $clientData['Product']['name']);
            array_push($productQuantity, $drData['DeliveryDetail']['quantity']);
            array_push($productUnit, $clientData['QuotationItemDetail']['quantity_unit_id']);
        
            }

                 
           //  pr($productList); 
           //  pr($productQuantity);
           //  pr($productUnit);
           // exit;

            $units = $this->Unit->find('list',array('fields' => array('id','unit')));
            // pr($gateData);
            // pr($assistData);
            // pr($driverList);
            // pr($assList);
            // pr($drData);
            // pr($clientData);exit();

            $this->set(compact('truckList','units','gateData','assistData','driverList','assList','drData','clientData','productList','productQuantity','productUnit'));

            $this->render('print_gatepass');

            // $this->redirect( array(
            //      'controller' => 'deliveries',   
            //      'action' => 'view',$this->request->data['Direct']['one'],$this->request->data['Direct']['two'],$this->request->data['Direct']['three']
            // ));

        }
         
    }

     public function gate_pass($deliveryScheduleId = null, $quotationId = null,$clientsOrderUuid = null){

        $this->loadModel('Truck');

        $this->loadModel('Assistant');

        $this->loadModel('Driver');

        $dr_nos = $this->Delivery->find('all',array('conditions' => array('Delivery.schedule_uuid' => $clientsOrderUuid )));
        
        $truckList = $this->Truck->find('list',array('fields' => array('id', 'truck_no'),'order' => 'truck_no ASC'));
       
        foreach ($truckList as $key => $value) {

            $truckListUpper[$key] = ucwords(strtoupper($value));
           
        }

        $helperList = $this->Assistant->find('list',array('fields' => array('id', 'full_name'),'order' => 'full_name ASC'));

        foreach ($helperList as $key => $value) {

            $helperListUpper[$key] = ucwords($value);
           
        }

        $driverList = $this->Driver->find('list',array('fields' => array('id', 'full_name'),'order' => 'full_name ASC'));

        foreach ($driverList as $key => $value) {

            $driverListUpper[$key] = ucwords($value);
           
        }
        
        $noPermissionSales = ' ';
        
        $this->set(compact('noPermissionSales','truckListUpper','helperListUpper','driverListUpper','deliveryScheduleId','quotationId','clientsOrderUuid','dr_nos'));
    }

      public function view_dr($dr_id = null) {

        $userData = $this->Session->read('Auth');

        $this->loadModel('Delivery.DeliveryReceipt');

        $this->loadModel('User');

        //$this->Delivery->bindDeliveryView();

        $this->DeliveryReceipt->bindDelivery();

        $DeliveryReceiptData = $this->DeliveryReceipt->find('all',array('conditions' => array(
                                        'DeliveryReceipt.id' => $dr_id
                                        )));

        $printedFirstName = $this->User->find('list',array('fields' => array('id','first_name')));

        $printedLastName = $this->User->find('list',array('fields' => array('id','last_name')));

        $noPermissionSales = ' '; 

        $this->set(compact('DeliveryReceiptData','noPermissionSales', 'printedFirstName', 'printedLastName'));     
            
    }

     public function view_tr($tr_id = null) {

        $userData = $this->Session->read('Auth');

        $this->loadModel('Delivery.Transmittal');

        $this->loadModel('User');

        //$this->Delivery->bindDeliveryView();

        $this->Transmittal->bindTransmittalDelivery();

        $transmittalData = $this->Transmittal->find('all',array('conditions' => array(
                                        'Transmittal.id' => $tr_id
                                        )));
        //pr($transmittalData); exit;

        $printedFirstName = $this->User->find('list',array('fields' => array('id','first_name')));

        $printedLastName = $this->User->find('list',array('fields' => array('id','last_name')));

        $noPermissionSales = ' '; 

        $this->set(compact('transmittalData','noPermissionSales', 'printedFirstName', 'printedLastName'));     
            
    }

}