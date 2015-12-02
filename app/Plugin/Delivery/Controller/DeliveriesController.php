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

        if ($userData['User']['role_id'] == 3 || $userData['User']['role_id'] == 6 || $userData['User']['role_id'] == 9) {

            $noPermissionSales = 'disabled not-active';

        }else{
            $noPermissionSales = ' ';
        }

         $this->set(compact('noPermissionSales','clientsOrder','deliveryData', 'deliveryList', 'deliveryDetailList', 'clientsStatus', 'deliveryStatus', 'orderList', 'orderListHelper', 'orderDeliveryList'));
    }

    public function add($deliveryScheduleId = null, $clientsOrderUuid = null){

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
                'action' => 'view',
                $deliveryScheduleId,
                $scheduleInfo['ClientOrderDeliverySchedule']['uuid'],
                $scheduleInfo['ClientOrder']['uuid']
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
        $this->request->data['Delivery']['company_id']  = $scheduleInfo['ClientOrder']['company_id'];
        
        $Scheddate = $scheduleInfo['ClientOrderDeliverySchedule']['schedule'];

        $this->Delivery->create();

        $this->id = $this->Delivery->saveDelivery($this->request->data,$userData['User']['id']);

        $this->DeliveryDetail->saveDeliveryDetail($this->request->data,$userData['User']['id']);

        $this->Session->setFlash(__('Delivery receipt was issued'));

        $this->redirect(

            array('controller' => 'deliveries', 'action' => 'view',
               $deliveryScheduleId,
                $scheduleInfo['ClientOrderDeliverySchedule']['uuid'],
                $scheduleInfo['ClientOrder']['uuid'])

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

    public function view($deliveryScheduleId = null, $clientsOrderUuid = null, $clientUuid = null) {

        $this->loadModel('Sales.ClientOrderDeliverySchedule');

        $this->loadModel('Sales.Address');

        $this->loadModel('Delivery.Measure');

        $clientsOrder = $this->ClientOrderDeliverySchedule->query('SELECT ClientOrder.id, ClientOrder.client_order_item_details_id,
            ClientOrder.po_number, ClientOrder.company_id, ClientOrder.quotation_id,  ClientOrder.uuid,
            ClientOrderDeliverySchedule.id, ClientOrderDeliverySchedule.client_order_id,ClientOrderDeliverySchedule.modified,
            ClientOrderDeliverySchedule.schedule,ClientOrderDeliverySchedule.location,
            ClientOrderDeliverySchedule.quantity,ClientOrderDeliverySchedule.uuid
            ,ClientOrderDeliverySchedule.delivery_type, 
            JobTicket.client_order_id , JobTicket.uuid , QuotationItemDetail.id, QuotationItemDetail.quantity,
            QuotationDetail.quotation_id, QuotationDetail.product_id, Product.id,Product.name,
            Company.id, Company.company_name, Address.foreign_key
            FROM koufu_sale.client_order_delivery_schedules AS ClientOrderDeliverySchedule
            LEFT JOIN koufu_sale.client_orders AS ClientOrder
            ON ClientOrderDeliverySchedule.client_order_id = ClientOrder.id 
            LEFT JOIN koufu_ticketing.job_tickets AS JobTicket
            ON ClientOrderDeliverySchedule.client_order_id = JobTicket.client_order_id 
            LEFT JOIN koufu_sale.quotation_item_details AS QuotationItemDetail
            ON ClientOrder.client_order_item_details_id = QuotationItemDetail.id
            LEFT JOIN koufu_sale.quotation_details AS QuotationDetail
            ON ClientOrder.quotation_id = QuotationDetail.quotation_id
            LEFT JOIN koufu_sale.products AS Product
            ON QuotationDetail.product_id = Product.id
            LEFT JOIN koufu_sale.companies AS Company
            ON Company.id = ClientOrder.company_id
            LEFT JOIN koufu_sale.addresses AS Address
            ON Address.foreign_key = Company.id
            -- INNER JOIN koufu_delivery.deliveries AS Delivery
            -- ON Delivery.schedule_uuid = ClientOrderDeliverySchedule.uuid
            -- INNER JOIN koufu_delivery.delivery_details AS DeliveryDetail
            -- ON Delivery.dr_uuid = DeliveryDetail.delivery_uuid 
            -- INNER JOIN koufu_delivery.deliveries AS Delivery
            -- ON Delivery.schedule_uuid = ClientOrderDeliverySchedule.uuid
            -- LEFT OUTER JOIN koufu_delivery.deliveries AS DeliveryDetail
            -- ON Delivery.dr_uuid = DeliveryDetail.delivery_uuid 
            WHERE ClientOrder.uuid = "'.$clientUuid.'" AND ClientOrderDeliverySchedule.uuid = "'.$clientsOrderUuid.'" ');

        foreach ($clientsOrder as $key => $value) {
            
            $clientsOrder =  $value;

        }

        $this->Delivery->bindDelivery();

        $deliveryConditions = array('Delivery.schedule_uuid' => $clientsOrderUuid,
                                               'Delivery.clients_order_id' => $clientUuid);



        $deliveryEdit = $this->Delivery->find('all', array(
                                       'group' => 'Delivery.dr_uuid',
                                       'conditions' => $deliveryConditions ,
                                       'order' => 'Delivery.id DESC'
                                   ));

        $this->Delivery->bindDelivery();
        
        $deliveryStatus = $this->Delivery->find('all');

        $deliveryList = $this->Delivery->find('list',array('fields' => array('schedule_uuid', 'dr_uuid')));

        $orderListHelper = $this->Delivery->find('list',array('fields' => array('clients_order_id', 'dr_uuid')));

        $companyAddress = $this->Address->find('list',array('fields' => array('address1','address1','foreign_key')));
 
        $measureList = $this->Measure->find('list',array('fields' => array('id', 'name'))); 

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

        $this->set(compact('companyAddress','noPermissionSales','driverList','helperList','truckList','clientUuid','deliveryScheduleId','clientsOrderUuid','scheduleInfo','deliveryData', 'quantityInfo','deliveryDataID','deliveryDetailsData', 'deliveryEdit','deliveryList','deliveryStatus', 'orderListHelper', 'clientsOrder', 'drData', 'deliveryDetailsData', 'DeliveryReceiptData', 'measureList'));
        
    }

    public function add_schedule($idDelivery = null, $idDeliveryDetail = null,$deliveryScheduleId = null) {
        //pr($idDelivery);  pr($idDelividDeliveryeryDetail); pr($deliveryScheduleId);  pr($clientUuid); exit;
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

            $this->Delivery->bindDelivery();

            $DRdata = $this->Delivery->find('first', array(
                    'conditions' => array(
                      'Delivery.dr_uuid' => $this->request->data['Delivery']['dr_uuid'],
                       'Delivery.status NOT' => 2 
                      )
                ));


            $disableValidation = '';

           // if (!empty($DRdata) && $DRdata['Delivery']['status'] == 1) {

            if (!empty($DRdata) && $DRdata['Delivery']['status'] == 1 ) {

                $this->Session->setFlash(__('The Delivery Receipt No. already exists'), 'error');
              
                $this->redirect( array(
                           'controller' => 'deliveries',   
                           'action' => 'view',$idDeliveryDetail,$deliveryScheduleId,$deliveryScheduleId
                      ));  
            }// } else if (!empty($DRdata) && $DRdata['DeliveryDetail']['status'] == 2) {

            //     $disableValidation = 1;

            //      $this->request->data['Delivery']['id'] = $DRdata['Delivery']['id'];
            //         $this->request->data['DeliveryDetail']['id'] = $DRdata['DeliveryDetail']['id'];
            //       $this->request->data['DeliveryDetail']['status'] = 1;

            // }

            $this->request->data['Delivery']['company_id'] = $deliveryData['Delivery']['company_id']; 
            $this->request->data['DeliveryDetail']['delivery_uuid'] =  $this->request->data['Delivery']['dr_uuid']; 
            $this->request->data['DeliveryDetail']['created_by'] =  $userData['User']['id'];    
            $this->request->data['Delivery']['status'] =  '1';   
            $this->request->data['Delivery']['modified_by'] =  $userData['User']['id']; 

            //pr($this->request->data); exit;

            $data =  $this->request->data;

            $this->Delivery->saveDelivery($this->request->data,$userData['User']['id']);

            $this->DeliveryDetail->saveDeliveryDetail($this->request->data,$userData['User']['id']);
  
            $this->Session->setFlash(__('Schedule has been updated.'),'success');
            $this->redirect( array(
                           'controller' => 'deliveries', 
                           'action' => 'view',
                           $idDeliveryDetail,
                           $data['Delivery']['schedule_uuid'],
                           $data['Delivery']['clients_order_id']
                           
                           
                      ));
            
            $this->Session->setFlash(__('Unable to update your post.'));
        }

        $this->set(compact('scheduleInfo',  'deliveryData'));
        
    }

    public function delivery_return($deliveryScheduleId = null,$clientsOrderUuid =null,$clientUuid = null) {

        $userData = $this->Session->read('Auth');

        if ($this->request->is(array('post', 'put'))) {

            // if($this->request->data['DeliveryDetail']['quantity'] == $this->request->data['DeliveryDetail']['delivered_quantity']){

            //     $this->request->data['DeliveryDetail']['status'] =  '4'; 

            // }else{

                $this->request->data['DeliveryDetail']['status'] =  '3';

            
            //}
             //pr($this->request->data); exit;

            if(!empty($this->request->data['DeliveryDetail']['from_replacing'])){     

                if($this->request->data['DeliveryDetail']['from_replacing'] = 'replacing'){

                    $this->request->data['DeliveryDetail']['delivered_quantity'] =  $this->request->data['DeliveryDetail']['delivered'] + $this->request->data['DeliveryDetail']['delivered_quantity'];

                    $this->DeliveryDetail->id = $this->request->data['DeliveryDetail']['id'];

                }
            }

            if(!empty($this->request->data['DeliveryDetail']['holder'])){  

                $this->request->data['DeliveryDetail']['quantity'] = $this->request->data['DeliveryDetail']['holder'];

            }

            
            $this->DeliveryDetail->saveDeliveryDetail($this->request->data,$userData['User']['id']);

            $this->Session->setFlash(__('Delivered quantity has been recorded.'),'success');

            $this->redirect( array(
                           'controller' => 'deliveries', 
                           'action' => 'view',$deliveryScheduleId,$quotationId,$clientsOrderUuid,$clientUuid
                      ));
            
        }
       
    }

    public function delivery_replacing() {

        $userData = $this->Session->read('Auth');

        //$this->loadModel('Sales.ClientOrderDeliverySchedule');

      //  $this->loadModel('Delivery.DeliveryReceipt');

        $this->loadModel('Delivery.Transmittal');

        $this->loadModel('Sales.ClientOrder');

        $this->Delivery->bindDeliveryClientOrder();
      
        $deliveryEdit = $this->Delivery->find('all', array(
                                             'conditions' => array(
                                            'DeliveryDetail.quantity != DeliveryDetail.delivered_quantity' , "DeliveryDetail.status !=" => "5"),
                                            'order' => 'DeliveryDetail.modified DESC'
                                           // 'fields' => array('DISTINCT Delivery.dr_uuid', 'DeliveryDetail.schedule','DeliveryDetail.location', 'DeliveryDetail.quantity','DeliveryDetail.delivered_quantity', 'DeliveryDetail.status', 'DeliveryReceipt.type', 'Delivery.schedule_uuid','DeliveryDetail.id', 'Transmittal.type' ,'DeliveryDetail.delivery_uuid'),
                                        ));

  
        //$this->DeliveryReceipt->bindDelivery();

       // $DeliveryReceiptData =  $this->DeliveryReceipt->find('all');

         $this->Transmittal->bindDelivery();

         $TransmittalData =  $this->Transmittal->find('all');

        // pr($TranmisttalData); exit;

        

        $this->Delivery->bindDeliveryClientOrder();

        // $limit = 1;

        // $conditions =  array('DeliveryDetail.quantity != DeliveryDetail.delivered_quantity' , 'DeliveryDetail.status !=' => '5');
        // //pr($conditions ); exit;
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
        //pr($deliveryEdit ); exit;
        $noPermissionSales = ' '; 

        $this->set(compact('noPermissionSales','deliveryEdit', 'scheduleInfo', 'clientOrderData', 'DeliveryReceiptData', 'TransmittalData'));     
            
    }

    public function delivery_edit($dr_uuid = null, $clientsOrderUuid = null,$clientuuId = null) {

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
                                    $deliveryEdit['Delivery']['schedule_uuid'],
                                    $deliveryEdit['Delivery']['clients_order_id']
            ));
                
            $this->Session->setFlash(__('Unable to update your post.'));
        }            

        $noPermissionSales = ' ';
        
        $this->set(compact('deliveryEdit', 'clientOrderData', 'clientsOrder', 'deliveryData', 'scheduleInfo', 'userData', 'companyAddress', 'noPermissionSales','clientsOrderUuid'));      
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

        $this->loadModel('Delivery.Measure');

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

        $measureList = $this->Measure->find('list',array('fields' => array('id', 'name'))); 

        $nameForm = "Delivery Receipt"; 

        $noPermissionSales = ' ';

        $this->set(compact('drData','clientData','companyData','units','nameForm', 'companyAddress','noPermissionSales', 'measureList'));
    
    }

   public function delivery_transmittal_record() {

      $userData = $this->Session->read('Auth');

      // $this->loadModel('Sales.ClientOrderDeliverySchedule');

      // $this->loadModel('Sales.ClientOrder');

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

      // $this->ClientOrder->bindDelivery();

      // $clientOrderData = $this->ClientOrderDeliverySchedule->find('list',array('fields' => array('uuid','id')));

      // $scheduleInfo = $this->ClientOrder->find('all');

      $noPermissionSales = ' ';

      $this->set(compact('noPermissionSales','transmittalData', 'scheduleInfo', 'clientOrderData'));     
        
}

    public function dr_record() {

        $userData = $this->Session->read('Auth');

        $this->loadModel('User');

        $this->loadModel('Delivery.DeliveryReceipt');

        $this->loadModel('Sales.ClientOrderDeliverySchedule');

        $userFName = $this->User->find('list',array('fields' => array('id','first_name')));

        $userLName = $this->User->find('list',array('fields' => array('id','last_name')));

        $noPermissionSales = ' ';

        $this->DeliveryReceipt->bindDelivery();

        $this->DeliveryReceipt->recursive = 1;

        $limit = 10;

        $conditions = "";
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
                'Delivery.schedule_uuid',
                'Delivery.clients_order_id',
                'DeliveryDetail.id',
                ),
            'order' => 'DeliveryReceipt.id DESC',
        );

        $DRData = $this->paginate('DeliveryReceipt');

        $this->ClientOrderDeliverySchedule->bind(array('ClientOrder', 'QuotationDetail','Company', 'Product'));

        $clientOrderData = $this->ClientOrderDeliverySchedule->find('all');

       // pr($clientOrderData); exit;
        foreach ($clientOrderData as $key1 => $value){

            foreach ($DRData as $key => $valueOfDelivery){

                if($value['ClientOrder']['uuid'] == $valueOfDelivery['Delivery']['clients_order_id']){

                    $DRData[$key]['Product']['name'] = $value['Product']['name'];

                    $DRData[$key]['Company']['name'] = $value['Company']['company_name'];

                    $DRData[$key]['ClientOrder']['po_number'] = $value['ClientOrder']['po_number'];

                }

            } 

        }

        $this->set(compact('noPermissionSales','DRData','userFName','userLName'));     
        
    }

    public function search_order($hint = null){

        $userData = $this->Session->read('Auth');

        $this->loadModel('Sales.ClientOrderDeliverySchedule');
        
        if ($userData['User']['role_id'] == 3 || $userData['User']['role_id'] == 6 || $userData['User']['role_id'] == 9) {

            $noPermissionSales = 'disabled not-active';

        }else{

            $noPermissionSales = ' ';

        }

      $clientsOrder = $this->ClientOrderDeliverySchedule->query('SELECT 
            ClientOrder.id, ClientOrder.client_order_item_details_id,
            ClientOrder.po_number, ClientOrder.company_id, ClientOrder.quotation_id,  ClientOrder.uuid, ClientOrder.status_id,
            ClientOrderDeliverySchedule.id, ClientOrderDeliverySchedule.client_order_id,ClientOrderDeliverySchedule.modified,
            ClientOrderDeliverySchedule.schedule,ClientOrderDeliverySchedule.location,
            ClientOrderDeliverySchedule.quantity,ClientOrderDeliverySchedule.uuid
            ,ClientOrderDeliverySchedule.delivery_type, ClientOrderDeliverySchedule.status_id,
            JobTicket.client_order_id , JobTicket.uuid , QuotationDetail.quotation_id, Product.id,Product.name,
            Company.id, Company.company_name
            FROM koufu_sale.client_order_delivery_schedules AS ClientOrderDeliverySchedule
            LEFT JOIN koufu_sale.client_orders AS ClientOrder
            ON ClientOrder.id = ClientOrderDeliverySchedule.client_order_id
            LEFT JOIN koufu_ticketing.job_tickets AS JobTicket
            ON JobTicket.client_order_id = ClientOrderDeliverySchedule.client_order_id
            LEFT JOIN koufu_sale.companies AS Company
            ON ClientOrder.company_id = Company.id 
            LEFT JOIN koufu_sale.quotation_details AS QuotationDetail
            ON ClientOrder.quotation_id = QuotationDetail.quotation_id
            LEFT JOIN koufu_sale.products AS Product
            ON Product.id = QuotationDetail.product_id
            WHERE JobTicket.uuid LIKE "%'.$hint.'%" OR ClientOrder.po_number LIKE "%'.$hint.'%"
            OR Company.company_name LIKE "%'.$hint.'%" OR Product.name LIKE "%'.$hint.'%" OR ClientOrder.uuid LIKE "%'.$hint.'%" LIMIT 10 ');

        $deliveryData = $this->Delivery->find('list',array('fields' => array('schedule_uuid','status')));

        $this->Delivery->bindDelivery();
        $deliveryStatus = $this->Delivery->find('all');

        $deliveryList = $this->Delivery->find('list',array('fields' => array('schedule_uuid', 'dr_uuid')));

        $orderListHelper = $this->Delivery->find('list',array('fields' => array('clients_order_id', 'dr_uuid')));

        $this->set(compact('clientsOrder','noPermissionSales',  'deliveryStatus', 'deliveryList', 'orderListHelper', 'orderDeliveryList', 'deliveryDetailList' , 'deliveryData', 'jobTicketData'));

        if ($hint == ' ') {
            $this->render('index');
        }else{
            $this->render('search_order');
        }
    }

    public function search_delivery_receipt($hint = null){

        $userData = $this->Session->read('Auth');

        $this->loadModel('User');

        $this->loadModel('Delivery.DeliveryReceipt');

        $this->loadModel('Sales.ClientOrderDeliverySchedule');

        $userFName = $this->User->find('list',array('fields' => array('id','first_name')));

        $userLName = $this->User->find('list',array('fields' => array('id','last_name')));

        $this->DeliveryReceipt->bindDelivery();

        $this->DeliveryReceipt->recursive = 1;

        $noPermissionSales = ' ';

        $DRData = $this->DeliveryReceipt->find('all',array(
                      'conditions' => array(
                        'OR' => array(
                        array('DeliveryReceipt.dr_uuid LIKE' => '%' . $hint . '%'),
                        array('DeliveryReceipt.schedule LIKE' => '%' . $hint . '%'),
                        array('DeliveryReceipt.location LIKE' => '%' . $hint . '%'),
                        array('DeliveryReceipt.quantity LIKE' => '%' . $hint . '%')
                          )
                        ),
                      'limit' => 10
                      )); 

        $this->ClientOrderDeliverySchedule->bind(array('ClientOrder', 'QuotationDetail','Company', 'Product'));

        $clientOrderData = $this->ClientOrderDeliverySchedule->find('all');

        
        foreach ($clientOrderData as $key1 => $value){

            foreach ($DRData as $key => $valueOfDelivery){

                if($value['ClientOrder']['uuid'] == $valueOfDelivery['Delivery']['clients_order_id']){

                    $DRData[$key]['Product']['name'] = $value['Product']['name'];

                    $DRData[$key]['Company']['name'] = $value['Company']['company_name'];

                    $DRData[$key]['ClientOrder']['po_number'] = $value['ClientOrder']['po_number'];


                }

            } 

        }

        $this->set(compact('noPermissionSales','DRData','userFName','userLName'));  

        if ($hint == ' ') {
            $this->render('index');
        }else{
            $this->render('search_delivery_receipt');
        }
    }

    public function dr($dr_uuid = null,$schedule_uuid = null, $client_id = null) {

        //pr($client_uuid); exit;

        $this->loadModel('Sales.ClientOrder');

        $this->ClientOrder->bind(array('Quotation','ClientOrderDeliverySchedule','QuotationItemDetail','QuotationDetail','Product'));
        
        $this->loadModel('Sales.Company');

        $this->loadModel('Accounting.SalesInvoice');

        $this->loadModel('Delivery.DeliveryReceipt');

        $this->loadModel('Unit');
        $units = $this->Unit->getList();

        $this->Company->bind('Address');
       
        $this->Delivery->bindDelivery();
        $drData = $this->Delivery->find('first', array(
                                            'conditions' => array('Delivery.dr_uuid' => $dr_uuid, 'Delivery.schedule_uuid' => $schedule_uuid
                                            )));

        $clientData = $this->ClientOrder->find('first', array(
                                            'conditions' => array('ClientOrder.id' => $client_id
                                            )));
    
        $companyData = $this->Company->find('first', array(
                                            'conditions' => array('Company.id' => $clientData['ClientOrder']['company_id']
                                            )));

        $userData = $this->Session->read('Auth');

        $this->Delivery->bindDelivery();
        $drDataHolder = $this->Delivery->find('first', array(
                                            'conditions' => array('Delivery.dr_uuid' => $dr_uuid
                                            )));

        $this->loadModel('Delivery.Measure');

        $measureList = $this->Measure->find('list',array('fields' => array('id', 'name')));

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

            $accountingData = $this->SalesInvoice->find('first', array(
                                            'conditions' => array('SalesInvoice.dr_uuid' => $dr_uuid
                                            )));

            if(!empty($accountingData['SalesInvoice']['id'])){
        
                if($accountingData['SalesInvoice']['id']){

                    $idAccounting = $accountingData['SalesInvoice']['id'];

                }

            }

            if(!empty($this->request->data['DeliveryDetail']['new'])){

                $this->request->data['DeliveryReceipt']['dr_uuid'] = $this->request->data['DeliveryDetail']['delivery_uuid'];

                $idholder = $this->request->data['DeliveryDetail']['idholder'];

                if($this->request->data['DeliveryDetail']['delivery_uuid'] != $drData['Delivery']['dr_uuid']){

                    $this->DeliveryDetail->id = $idholder;

                    $this->DeliveryDetail->saveField('status', 5);

                    if(!empty($idAccounting)){

                        $this->SalesInvoice->id = $idAccounting;

                        $this->SalesInvoice->saveField('status', 5);

                    }

                    unset($this->request->data['DeliveryDetail']['id']);

                    $drQuantity = $this->request->data['DeliveryDetail']['delivered_quantity'];

                    $drRemarks = $this->request->data['DeliveryDetail']['remarks'];

                    $this->request->data['Delivery']['created_by'] = $drDataHolder['Delivery']['created_by'];

                    $this->request->data['Delivery']['modified_by'] = $drDataHolder['Delivery']['modified_by'];

                    $this->request->data['Delivery']['from'] = $this->request->data['Delivery']['dr_uuid'];

                    $this->request->data['Delivery']['status'] = 1;

                    $this->request->data['Delivery']['company_id'] = $this->request->data['Delivery']['company_id'];

                    $this->request->data['Delivery']['dr_uuid'] = $this->request->data['DeliveryDetail']['delivery_uuid'];

                    $this->request->data['DeliveryDetail']['status'] = 11;

                    $this->request->data['DeliveryDetail']['delivered_quantity'] = $drData['DeliveryDetail']['delivered_quantity'];
                   // pr($this->request->data); exit;
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

        $this->set(compact('drData','clientData','companyData','units','approved','prepared', 'DRRePrint', 'drQuantity','drRemarks', 'measureList'));

        $this->render('dr'); 

    }

     public function apc($dr_uuid = null,$schedule_uuid) {

        $this->loadModel('Sales.ClientOrder');

        $this->ClientOrder->bind(array('Quotation','ClientOrderDeliverySchedule','QuotationItemDetail','QuotationDetail','Product'));
        
        $this->loadModel('Sales.Company');

        $this->loadModel('Accounting.SalesInvoice');

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

        $this->loadModel('Delivery.Measure');

        $measureList = $this->Measure->find('list',array('fields' => array('id', 'name')));

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

        $prepared = $userData;

        $approved = $this->User->find('first', array('fields' => array('id', 'first_name','last_name'),
                                                                'conditions' => array('User.id' => $drDataHolder['Delivery']['created_by'])
                                                                ));  

        $this->set(compact('drData','clientData','companyData','units','approved','prepared', 'DRRePrint', 'drQuantity','drRemarks', 'measureList'));

        $this->render('apc'); 

    }

    public function tr($dr_uuid = null,$schedule_uuid) {

        $this->loadModel('Delivery.Transmittal');

        $this->loadModel('Sales.ClientOrder');

        $this->ClientOrder->bind(array('Quotation','ClientOrderDeliverySchedule','QuotationItemDetail','QuotationDetail','Product'));
        
        $this->loadModel('Sales.Company');

        $this->loadModel('Unit');
        $units = $this->Unit->getList();

        $this->Company->bind('Address');

        $TRdata = $this->Transmittal->find('first', array(
                        'conditions' => array(
                          'Transmittal.dr_uuid' => $dr_uuid
                        )));

        $TRRePrint = $this->Transmittal->find('all', array(
                                            'conditions' => array('Transmittal.dr_uuid' => $dr_uuid)
                                         ));

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

        // $this->request->data['DeliveryDetail']['delivered_quantity'] = $this->request->data['Transmittal']['quantity'] + $drData['DeliveryDetail']['delivered_quantity'];

        // $this->DeliveryDetail->id = $drData['DeliveryDetail']['id'];

        if(!empty($this->request->data['DeliveryDetail']['delivered_quantity'])){

            $this->DeliveryDetail->save($this->request->data['DeliveryDetail']);

            //$this->DeliveryDetail->saveField('delivered_quantity', $this->request->data['DeliveryDetail']['delivered_quantity']);

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


        if ($this->request->is(array('post', 'put'))) {

            $this->request->data['Transmittal']['created_by'] = $userData['User']['id'];

             $this->request->data['Transmittal']['type'] = 'replacing';

            $this->Transmittal->save($this->request->data);               
                              
        }   

         $this->set(compact('drData','clientData','companyData','units','approved','prepared', 'contactPerson', 'quantityTransmittal', 'remarks', 'TRRePrint'));

        // $this->render('delivery_replacing'); 
      }

        public function add_gatepass(){
            
            $userData = $this->Session->read('Auth');
            
            $this->loadModel('GatePass');
            $this->loadModel('GatePassTruck');
            $this->loadModel('GatePassAssistant');
            $this->loadModel('Sales.ClientOrder');
            $this->loadModel('Sales.Company');
            $this->loadModel('Driver');
            $this->loadModel('Assistant');
            $this->loadModel('Truck');
            $this->loadModel('Unit');
            $this->loadModel('User');
            
            $this->ClientOrder->bind(array('Quotation','ClientOrderDeliverySchedule','QuotationItemDetail','QuotationDetail','Product'));

            if (!empty($this->request->data)) {

                //pr($userData['User']['id']); exit;

                $gateId = $this->GatePassTruck->saveGatePassTruck($this->request->data,$userData['User']['id']);
                
                $gatepassId = $this->GatePass->saveGatepass($this->request->data,$userData['User']['id'], $gateId);

                $this->GatePassAssistant->saveGatePassAssistant($this->request->data,$gateId,$userData['User']['id']);
                
                //$this->Session->setFlash(__('The Gate Pass successfully added.'), 'success');
               
                $gateData = $this->GatePass->find('all',array('conditions' => array('GatePass.id' => $gatepassId)));
                
                $assistData = $this->GatePassAssistant->find('all', array(
                                            'conditions' => array('GatePassAssistant.gatepass_truck_id' => $gateId
                                            )));

                $companyList = $this->Company->find('list', array(
                                            'fields' => array('id','company_name')));

                $driverList = $this->Driver->find('list', array(
                                            'fields' => array('id','full_name')));

                $assList = $this->Assistant->find('list', array(
                                            'fields' => array('id','full_name')));

                $truckList = $this->Truck->find('list', array(
                                            'fields' => array('id','truck_no')));

                $userFnameList = $this->User->find('list', array(
                                            'fields' => array('id','first_name')));

                $userLnameList = $this->User->find('list', array(
                                            'fields' => array('id','last_name')));

                //pr($userList); exit;

                $approver = $this->request->data['GatePassTruck']['approver_id'];

                $driver = $this->request->data['GatePassTruck']['driver_id'];

                $truck = $this->request->data['GatePassTruck']['truck_id'];

                $remarks = $this->request->data['GatePassTruck']['remarks'];

                // pr($truckList[$truck]); pr($driverList[$driver]);exit;

                // $productList = array();
                // $productQuantity = array();
                // $productUnit = array();
                
                if(!empty($gateData)){

                    foreach ($gateData as $key => $value){

                        $this->Delivery->bindDelivery();    

                        $drData = $this->Delivery->find('first', array(
                                                    'conditions' => array('Delivery.dr_uuid' => $value['GatePass']['ref_uuid']
                                                    )));

                        $this->ClientOrder->bindClientDelivery();

                        $clientData = $this->ClientOrder->find('first', array(
                                                    'conditions' => array('ClientOrder.uuid' => $drData['Delivery']['clients_order_id']
                                                    )));

                        $gateData[$key]['ClientOrder'] = $clientData['Product']['name'];

                        $gateData[$key]['DeliveryDetail'] = $drData['DeliveryDetail']['quantity'];

                        $gateData[$key]['QuotationItemDetail'] = $clientData['QuotationItemDetail']['quantity_unit_id'];

                        // array_push($productList, $clientData['Product']['name']);
                        // array_push($productQuantity, $drData['DeliveryDetail']['quantity']);
                        // array_push($productUnit, $clientData['QuotationItemDetail']['quantity_unit_id']);
                
                    }
                    
                }

                $units = $this->Unit->find('list',array('fields' => array('id','unit')));

                $this->set(compact('gateId','drlist','truckList','units','gateData','assistData','driverList','assList','drData','clientData','productList','productQuantity','productUnit', 'companyList', 'userData', 'approver', 'userList', 'userFnameList', 'userLnameList', 'driver', 'truck', 'remarks'));

                $this->render('print_gatepass');

    
            }
         
    }

     public function gate_pass($deliveryScheduleId = null, $quotationId = null,$clientsOrderUuid = null, $companyId = null,$clientUuid = null){

        $this->loadModel('Truck');

        $this->loadModel('Assistant');

        $this->loadModel('Driver');

        $this->loadModel('User');

        $this->loadModel('Sales.ClientOrderDeliverySchedule');

        $this->loadModel('Sales.ClientOrder');

        $ClientDeliveryUUIDList = $this->ClientOrderDeliverySchedule->find('list',array('fields' => array('uuid', 'client_order_id')));

        $ClientDeliveryList = $this->ClientOrder->find('list',array('fields' => array('id', 'company_id')));

        $start = date('Y-m-d');
        $end = date('Y-m-d', strtotime('+1 day'));

        $conditions = array('Delivery.created <=' => $end, 'Delivery.created >=' => $start , 'Delivery.company_id' => $companyId);

        $dr_nos = $this->Delivery->find('all',array('conditions' =>  $conditions));

        $deliveryUserData = $this->User->find('all',array('conditions' =>  array('User.role_id' => 4
                                            )));

        $deliveryUserFName = $this->User->find('list',array('fields' => array('id', 'fullname'),'conditions' =>  array('User.role_id' => 5
                                            )));


        foreach ($deliveryUserFName as $key => $value) {

            $deliveryUserFName[$key] = ucwords($value);
           
        }

    
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
        
        $this->set(compact('deliveryUserFName','noPermissionSales','truckListUpper','helperListUpper','driverListUpper','deliveryScheduleId','quotationId','clientsOrderUuid','dr_nos', 'deliveryUserData', 'deliveryUserFNameUpper', 'deliveryUserLNameUpper','clientUuid'));
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


    public function remove_dr_sched($id = null,$deliveryScheduleId = null, $quotationId = null, $clientsOrderUuid = null, $clientUuid = null) {

        if (!empty($id)) {

            $this->loadModel('Delivery.DeliveryDetail');

            $this->Delivery->bindDelivery();

            $deliverives = $this->Delivery->find('first',array(
                        'conditions' => array(
                                'Delivery.dr_uuid' => $id 
                    )
            ));

            $this->loadModel('Delivery.DeliveryDetail');

            $this->loadModel('Delivery.DeliveryReceipt');

            $deliveryUUID = $deliverives['Delivery']['dr_uuid'];  
            $detailsUUID = $deliverives['DeliveryDetail']['delivery_uuid'];

            //set to delete
            $deliverives['Delivery']['status'] = 2;

            $deliverives['DeliveryDetail']['status'] = 4;

            $deliverives['Delivery']['dr_uuid'] = 'X' . $deliveryUUID;

            $deliverives['DeliveryDetail']['delivery_uuid'] = 'X' . $deliveryUUID;

            $deliverives['DeliveryReceipt']['dr_uuid'] = 'X' . $deliveryUUID;

             
            $this->Delivery->create();

            if ($this->Delivery->save($deliverives)) {

                $this->DeliveryDetail->save($deliverives['DeliveryDetail']);

                $this->DeliveryReceipt->save($deliverives['DeliveryReceipt']);

               $this->Session->setFlash(__('Delivery Scheddate Successfully deleted'), 'success');
     
                   
            } else  {

                  $this->Session->setFlash(__('There\'s an error removing the data'), 'error');

            }

             $this->redirect( array(
                        'controller' => 'deliveries',   
                        'action' => 'view',$deliveryScheduleId,
                        $quotationId,$clientsOrderUuid,$clientUuid


                    ));  
        }
    }


    public function index_status($status = null) {

        $userData = $this->Session->read('Auth');

        $this->loadModel('Sales.ClientOrderDeliverySchedule');

        $this->loadModel('Ticket.JobTicket');

        $jobTicketData = $this->JobTicket->find('list',array('fields' => array('client_order_id', 'uuid')));

        $this->Delivery->bindDelivery();

        $deliveryStatus = $this->Delivery->find('all');        

        //$orderDeliveryList = $this->ClientOrderDeliverySchedule->find('list',array('fields' => array('uuid', 'uuid')));

        $this->ClientOrderDeliverySchedule->bind(array('ClientOrder', 'QuotationDetail','Company', 'Product'));

        $this->ClientOrderDeliverySchedule->recursive = 1;

        $limit = 10;

        $conditions = "";
        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'fields' => array(
                'ClientOrder.uuid',
                'ClientOrder.po_number',
                'ClientOrder.id',
                'ClientOrder.status_id',
                'Company.company_name',  
                'Product.name', 
                'ClientOrderDeliverySchedule.quantity', 
                'ClientOrderDeliverySchedule.status_id', 
                'ClientOrderDeliverySchedule.location', 
                'ClientOrderDeliverySchedule.schedule',
                'ClientOrderDeliverySchedule.uuid',
                'ClientOrderDeliverySchedule.id',
                'QuotationDetail.quotation_id'),
            'order' => 'ClientOrder.id DESC',
        );

        $clientsOrder = $this->paginate('ClientOrderDeliverySchedule');

        foreach ($clientsOrder as $key => $value){

            foreach ($deliveryStatus as $key1 => $valueofDelivery){
    
                if($value['ClientOrderDeliverySchedule']['uuid'] == $valueofDelivery['Delivery']['schedule_uuid']){


                    $clientsOrder[$key]['DeliveryDetail']['quantity'] = $valueofDelivery['DeliveryDetail']['quantity'];
                    $clientsOrder[$key]['DeliveryDetail']['delivered_quantity'] = $valueofDelivery['DeliveryDetail']['delivered_quantity'];
                    $clientsOrder[$key]['Delivery']['status'] = $valueofDelivery['Delivery']['status'];
                    $clientsOrder[$key]['Delivery']['dr_uuid'] = $valueofDelivery['Delivery']['dr_uuid'];
                    $clientsOrder[$key]['DeliveryDetail']['status'] = $valueofDelivery['DeliveryDetail']['status'];

                }
            }
        }

        if ($userData['User']['role_id'] == 3 || $userData['User']['role_id'] == 6 || $userData['User']['role_id'] == 9) {

            $noPermissionSales = 'disabled not-active';

        }else{

            $noPermissionSales = ' ';
        }

        $this->set(compact('noPermissionSales','clientsOrder','deliveryData', 'deliveryList', 'deliveryDetailList', 'clientsStatus', 'deliveryStatus', 'orderList', 'orderListHelper', 'jobTicketData'));

        if($status == 1){

            $this->render('index_waiting');
        }

         if($status == 2){

            $this->render('index_due');
        }

         if($status == 3){

            $this->render('index_approved');
        }

         if($status == 4){

            $this->render('index_closed');
        }

         if($status == 5){

            $this->render('index_completed');
        }

    } 

    public function terminate($id = null) {

        $this->loadModel('Sales.ClientOrderDeliverySchedule');

        $this->ClientOrderDeliverySchedule->id = $id;

        $this->ClientOrderDeliverySchedule->saveField('status_id', 1);

        $this->Session->setFlash(__('Delivery has been remove to the list'), 'success');
      
        $this->redirect( array(
            'controller' => 'deliveries', 
            'action' => 'index'
                        ));

    }    

    public function test($status = null) {

        $userData = $this->Session->read('Auth');

        $this->loadModel('Sales.ClientOrderDeliverySchedule');

        $this->Delivery->bindDelivery();

        $deliveryData = $this->Delivery->find('all');

        $this->ClientOrderDeliverySchedule->bind(array('ClientOrder'));

        $clientsOrder = $this->ClientOrderDeliverySchedule->find('all',array('fields' => array('ClientOrderDeliverySchedule.id','ClientOrderDeliverySchedule.uuid','ClientOrder.uuid', 'ClientOrder.id')));

            foreach ($clientsOrder as $key => $value){

                foreach ($deliveryData as $key1 => $valueofDelivery){
        
                    if($value['ClientOrderDeliverySchedule']['uuid'] == $valueofDelivery['Delivery']['schedule_uuid']){


                        $clientsOrder[$key]['DeliveryDetail']['quantity'] = $valueofDelivery['DeliveryDetail']['quantity'];
                        $clientsOrder[$key]['DeliveryDetail']['delivered_quantity'] = $valueofDelivery['DeliveryDetail']['delivered_quantity'];
                        $clientsOrder[$key]['Delivery']['status'] = $valueofDelivery['Delivery']['status'];
                        $clientsOrder[$key]['Delivery']['dr_uuid'] = $valueofDelivery['Delivery']['dr_uuid'];
                        $clientsOrder[$key]['DeliveryDetail']['status'] = $valueofDelivery['DeliveryDetail']['status'];


                    }

                }
            }

       // pr($clientsOrder); exit;

        $this->loadModel('Delivery.DrHolder');

        //$this->Delivery->bindDelivery();

       // $deliveryData = $this->Delivery->find('all');

        $this->id = $this->DrHolder->saveDelivery($clientsOrder,$userData['User']['id']);


    }


}