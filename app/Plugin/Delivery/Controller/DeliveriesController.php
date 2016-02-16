<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');
App::import('Vendor', 'DOMPDF', true, array(), 'dompdf'.DS.'dompdf_config.inc.php', false);

class DeliveriesController extends DeliveryAppController {

   
    public $uses = array('Delivery.Delivery', 'Delivery.DeliveryDetail');
    public $helpers = array('Accounting.PhpExcel','Delivery.DeliveryFunction');
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

    public function apc_index() {

        $userData = $this->Session->read('Auth');

        $this->loadModel('Sales.ClientOrder');

        $this->loadModel('Ticket.JobTicket');

        $jobTicketData = $this->JobTicket->find('list',array('fields' => array('client_order_id', 'uuid')));

        $this->Delivery->bindDelivery();

        $deliveryStatus = $this->Delivery->find('all');        

        $this->ClientOrder->bind(array('ClientOrderDeliverySchedule', 'QuotationDetail','Company', 'Product'));

        $this->ClientOrder->recursive = 1;

        $limit = 10;

        $conditions = array('ClientOrder.company_id' => 3);
        
        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'fields' => array(
                'ClientOrder.uuid',
                'ClientOrder.po_number',
                'ClientOrder.id',
                'ClientOrder.company_id',
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
        
        $clientsOrder = $this->paginate('ClientOrder');

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

        $this->set(compact('noPermissionSales','clientsOrder','deliveryData', 'deliveryList', 'deliveryDetailList', 'clientsStatus', 'deliveryStatus', 'orderList', 'orderListHelper'));
    

    }

    public function add($deliveryScheduleId = null, $clientsOrderUuid = null){

        $userData = $this->Session->read('Auth');
      
        $this->loadModel('Sales.ClientOrderDeliverySchedule');

        $this->loadModel('Delivery.DeliveryReceipt');

        $this->loadModel('Delivery.DeliveryConnection');

        $this->ClientOrderDeliverySchedule->bind(array('ClientOrder'));

        $scheduleInfo = $this->ClientOrderDeliverySchedule->find('first', array(
                                                                         'conditions' => array(
                                                                          'ClientOrderDeliverySchedule.id' => $deliveryScheduleId
                                                                        )
                                                                    ));

        $DRdata = $this->Delivery->find('count', array(
                    'conditions' => array(
                      'Delivery.dr_uuid' => $this->request->data['Delivery']['dr_uuid'])
                    ));

        /* disable this so that they can have the same DR # */
        
        if (!empty($DRdata) && $DRdata >= 4) {

            $this->Session->setFlash(__('Their are already 4 items in that DR,Choose another or remove item on the DR'), 'error');
          
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
          //get latest delivery 
        $latestDelivery =  $this->Delivery->read(null, $this->id );
    
        $this->request->data['DeliveryDetail']['delivery_id'] = $latestDelivery['Delivery']['id'];

        $deliveryDetailId = $this->DeliveryDetail->saveDeliveryDetail($this->request->data,$userData['User']['id']);

        //save delivery connection

        $saveData['DeliveryConnection']['delivery_id'] =  $latestDelivery['Delivery']['id'];

        $saveData['DeliveryConnection']['delivery_details_id'] = $this->DeliveryDetail->id;  

        $saveData['DeliveryConnection']['dr_uuid'] =  $latestDelivery['Delivery']['dr_uuid']; 

        if($this->DeliveryConnection->saveDetail($saveData,$userData['User']['id'])) {

        } else {
          //  pr($this->DeliveryConnection->validationErrors);
        }

      
        //save delivery reciep number
       // $this->request->data['DeliveryReceipt']['dr_uuid'] = $latestDelivery['Delivery']['dr_uuid'];
       // $this->request->data['DeliveryReceipt']['delivery_id'] = $latestDelivery['Delivery']['id'];
       // $this->request->data['DeliveryReceipt']['location'] = $scheduleInfo['ClientOrderDeliverySchedule']['location'];
       // $this->request->data['DeliveryReceipt']['quantity'] = $scheduleInfo['ClientOrderDeliverySchedule']['quantity'];
       // $this->request->data['DeliveryReceipt']['created_by']  = $userData['User']['id'];

       // $this->DeliveryReceipt->saveDeliveryReceipt($this->request->data,$userData['User']['id']);
    
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

    public function view($deliveryScheduleId = null, $clientsOrderUuid = null, $clientUuid = null, $indicator = null) {

        //Configure::write('debug',2);
        
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
            FROM client_order_delivery_schedules AS ClientOrderDeliverySchedule
            LEFT JOIN client_orders AS ClientOrder
            ON ClientOrderDeliverySchedule.client_order_id = ClientOrder.id 
            LEFT JOIN koufu_ticketing.job_tickets AS JobTicket
            ON ClientOrderDeliverySchedule.client_order_id = JobTicket.client_order_id 
            LEFT JOIN quotation_item_details AS QuotationItemDetail
            ON ClientOrder.client_order_item_details_id = QuotationItemDetail.id
            LEFT JOIN quotation_details AS QuotationDetail
            ON ClientOrder.quotation_id = QuotationDetail.quotation_id
            LEFT JOIN products AS Product
            ON QuotationDetail.product_id = Product.id
            LEFT JOIN companies AS Company
            ON Company.id = ClientOrder.company_id
            LEFT JOIN addresses AS Address
            ON Address.foreign_key = Company.id
            WHERE  ClientOrderDeliverySchedule.uuid = "'.$clientsOrderUuid.'" ');

        foreach ($clientsOrder as $key => $value) {
            
            $clientsOrder =  $value;

        }

       $this->Delivery->bindDelivery();

        $deliveryConditions = array('Delivery.schedule_uuid' => $clientsOrderUuid,
                                               'Delivery.clients_order_id' => $clientUuid);

        $partial = $this->Delivery->find('all', array(
                                       'group' => 'Delivery.id',
                                       'conditions' => $deliveryConditions ,
                                       'order' => 'Delivery.id DESC'
                                   ));

    
        foreach ($partial as $key => $new) {
         $deliveryEdit[$key] = $new;

         //find delivery_details_id

            $detail = $this->DeliveryDetail->findBYId($new['Delivery']['id']);

            if (!empty($detail)) {
                $deliveryEdit[$key]['DeliveryDetail'] = $detail['DeliveryDetail'];
            }
             
        }

       // $this->Delivery->bindDelivery();
        
       //  $deliveryStatus = $this->Delivery->find('all');

       //  $deliveryList = $this->Delivery->find('list',array('fields' => array('schedule_uuid', 'dr_uuid')));

       //  $orderListHelper = $this->Delivery->find('list',array('fields' => array('clients_order_id', 'dr_uuid')));

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

        $this->set(compact('companyAddress','noPermissionSales','driverList','helperList','truckList','clientUuid','deliveryScheduleId','clientsOrderUuid','scheduleInfo','deliveryData', 'quantityInfo','deliveryDataID','deliveryDetailsData', 'deliveryEdit','deliveryList','deliveryStatus', 'orderListHelper', 'clientsOrder', 'drData', 'deliveryDetailsData', 'DeliveryReceiptData', 'measureList', 'indicator'));
        
    }

    public function add_schedule($idDelivery = null, $idDeliveryDetail = null,$deliveryScheduleId = null) {
        //pr($idDelivery);  pr($idDelividDeliveryeryDetail); pr($deliveryScheduleId);  pr($clientUuid); exit;
        
        //Configure::write('debug',2);


        $data = $this->request->data;

        $userData = $this->Session->read('Auth');

        $this->loadModel('Delivery.DeliveryDetail');

        $this->loadModel('Delivery.DeliveryConnection');

        $this->loadModel('Sales.ClientOrderDeliverySchedule');

        $this->loadModel('Sales.ClientOrder');

        $this->Delivery->bindDelivery();

        $deliveryData = $this->Delivery->find('all', array('conditions' => array(
                                  'Delivery.schedule_uuid' => $this->request->data['Delivery']['schedule_uuid']),
                                  'order' => 'Delivery.id DESC'));

        //get clientiorder  
        $this->ClientOrder->bind(array('ClientOrderDeliverySchedule'));

        $clientOrder = $this->ClientOrder->find('first',array(
                    'conditions' => array(
                                'ClientOrder.uuid' => $deliveryData[0]['Delivery']['clients_order_id']
                    ),
                    'fields' => array(
                        'id','uuid','company_id'
                    )
        ));


        if (!empty($this->request->data)) {

            $this->Delivery->id = $idDelivery;
            $this->DeliveryDetail->id = $idDeliveryDetail;

            $this->Delivery->bindDelivery();

            $DRdata = $this->Delivery->find('all', array(
                    'conditions' => array(
                      'Delivery.dr_uuid' => $this->request->data['Delivery']['dr_uuid'],
                        'Delivery.status NOT' => 2 
                      )
            ));

        
            $disableValidation = '';


            $data =  $this->request->data;

           // if (!empty($DRdata) && $DRdata['Delivery']['status'] == 1) {
            if (count( $DRdata ) > 4) {

                $this->Session->setFlash(__('There\re already 4 item in that DR'), 'error');
              
                $this->redirect( array(
                           'controller' => 'deliveries',   
                           'action' => 'view',
                            $data['ClientOrderDeliverySchedule']['delivery_schedule_id'],
                            $data['Delivery']['schedule_uuid'],
                            $data['Delivery']['clients_order_id']

                      ));  
            }

            $this->request->data['Delivery']['company_id'] = $deliveryData[0]['Delivery']['company_id']; 
            $this->request->data['DeliveryDetail']['delivery_uuid'] =  $this->request->data['Delivery']['dr_uuid']; 
            $this->request->data['DeliveryDetail']['created_by'] =  $userData['User']['id'];    
            $this->request->data['Delivery']['created_by'] = $idDelivery;
            $this->request->data['Delivery']['status'] =  '1';   
            $this->request->data['Delivery']['modified_by'] =  $userData['User']['id'];
            

            //pr($this->request->data); exit;
            $this->Delivery->saveDelivery($this->request->data,$userData['User']['id']);

            $this->request->data['DeliveryDetail']['delivery_id'] = $this->Delivery->id;

            $this->DeliveryDetail->saveDeliveryDetail($this->request->data,$userData['User']['id']);

            $saveData['DeliveryConnection']['id'] = null;
            $saveData['DeliveryConnection']['delivery_id'] = $this->Delivery->id;

            $saveData['DeliveryConnection']['delivery_details_id'] = $this->DeliveryDetail->id;

            $saveData['DeliveryConnection']['dr_uuid'] =  $this->request->data['Delivery']['dr_uuid']; 


            if( $this->DeliveryConnection->saveDetail($saveData,$userData['User']['id']) ) {

            } else {

                $this->Delivery->delete($idDelivery);

                $this->DeliveryDetail->delete($idDelivery);

                $this->Session->setFlash(__('There\'s an error saving the data'),'error');


                 $this->redirect( array(
                           'controller' => 'deliveries', 
                           'action' => 'view',
                             $data['ClientOrderDeliverySchedule']['delivery_schedule_id'],
                            $data['Delivery']['schedule_uuid'],
                            $data['Delivery']['clients_order_id']
                      ));
            
            }


  
            $this->Session->setFlash(__('Schedule has been updated.'),'success');


            //$deliveryScheduleId = null, $clientsOrderUuid = null, $clientUuid = null, $indicator = null)

            $this->redirect( array(
                           'controller' => 'deliveries', 
                           'action' => 'view',
                             $data['ClientOrderDeliverySchedule']['delivery_schedule_id'],
                            $data['Delivery']['schedule_uuid'],
                            $data['Delivery']['clients_order_id']
                      ));
            
            $this->Session->setFlash(__('Unable to update your post.'));
        

        $this->set(compact('scheduleInfo',  'deliveryData'));
        }
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

        $delivery_conditions = array('DeliveryDetail.delivery_uuid' => $dr_uuid );


        if (!empty($this->request->params['named']['delivery_id'])) {


            $this->Delivery->bindDeliveryById();

            $delivery_conditions = array_merge($delivery_conditions,array(
                            'Delivery.id' => $this->request->params['named']['delivery_id']
                ));

        } else {


            $this->Delivery->bindDelivery();
        }

        $deliveryEdit = $this->Delivery->find('first', array(
                                         'conditions' =>   $delivery_conditions 
                                    ));


        if (!empty($this->request->params['named']['delivery_id'])) {

            $this->Delivery->bindDeliveryById();

        } else {
            
            $this->Delivery->bindDelivery();
        }

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

            $data = $this->request->data;

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

        if (!empty($_GET['search'])) {

            $hint = $_GET['search'];
        }

    if (!empty($hint)) {

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
            OR Company.company_name LIKE "%'.$hint.'%" OR Product.name LIKE "%'.$hint.'%" OR ClientOrder.uuid LIKE "%'.$hint.'%"');
        

        // $deliveryData = $this->Delivery->find('list',array('fields' => array('schedule_uuid','status')));

        // $this->Delivery->bindDelivery();

        // $deliveryStatus = $this->Delivery->find('all',array('fields' => array(
        //     'DeliveryDetail.delivered_quantity','Delivery.id','DeliveryDetail.status',
        //     'Delivery.id','Delivery.dr_uuid','Delivery.schedule_uuid',
        //     'Delivery.clients_order_id'
        // ),
        //     'limit' => 5
        // ));

        // pr($deliveryStatus);
        // exit();

        // $deliveryList = $this->Delivery->find('list',array('fields' => array('schedule_uuid', 'dr_uuid')));

        // $orderListHelper = $this->Delivery->find('list',array('fields' => array('clients_order_id', 'dr_uuid')));

        $this->set(compact('clientsOrder','noPermissionSales',  'deliveryStatus', 'deliveryList', 'orderListHelper', 'orderDeliveryList', 'deliveryDetailList' , 'deliveryData', 'jobTicketData'));

        if ($hint == ' ') {
            $this->render('index');
        }else{
            $this->render('search_order');
        }
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


    public function multiple_dr($uuid = null) {
        
        if (!empty($uuid)) {

        $this->loadModel('Delivery.DeliveryConnection');
       
        $this->DeliveryConnection->bindDeliveryById();

        $drConditions =  array('DeliveryConnection.dr_uuid' => $uuid,'Delivery.status !=' => 2);

        $DRRePrint = $this->DeliveryConnection->find('all', array(
                                        'limit' => 4,
                                        'conditions' => $drConditions,
                                       // 'group' => array('Delivery.id')
                                     ));


        $toPrint = array();

        $this->loadModel('Sales.ClientOrder');

        $this->loadModel('Sales.Company');

        $this->loadModel('Accounting.SalesInvoice');

        $this->loadModel('Delivery.DeliveryReceipt');

        $this->loadModel('Delivery.Measure');

        $this->loadModel('Unit');

        $this->loadModel('User');

        $units = $this->Unit->getList();

        $this->Company->bind('Address');

        $userData = $this->Session->read('Auth');


        foreach ($DRRePrint as $key => $list) {
        
            $this->ClientOrder->bind(array('Quotation','ClientOrderDeliverySchedule','QuotationItemDetail','QuotationDetail','Product',));

            //clientOrder = 
            $toPrint[$key] = $list;

            $clientOrder = $this->ClientOrder->find('first', array(
                                            'conditions' => array('ClientOrder.uuid' => $list['Delivery']['clients_order_id']
                                            )));

            $toPrint[$key]['ClientOrder'] = $clientOrder;

            $toPrint[$key]['Company'] = $this->Company->find('first', array(
                                            'conditions' => array('Company.id' =>$clientOrder['ClientOrder']['company_id']
                                            )));


           // pr($clientOrder['ClientOrderDeliverySchedule'][0]);
                 //save delivery reciep number

           $this->request->data['DeliveryReceipt']['delivety_id'] = $list['Delivery']['id'];
           $this->request->data['DeliveryReceipt']['dr_uuid'] = $list['Delivery']['dr_uuid'];
           $this->request->data['DeliveryReceipt']['delivery_id'] = $list['Delivery']['id'];
           $this->request->data['DeliveryReceipt']['location'] = $clientOrder['ClientOrderDeliverySchedule'][0]['location'];
           $this->request->data['DeliveryReceipt']['quantity'] = $clientOrder['ClientOrderDeliverySchedule'][0]['quantity'];

           $this->request->data['DeliveryReceipt']['schedule'] = $clientOrder['ClientOrderDeliverySchedule'][0]['schedule'];
           $this->request->data['DeliveryReceipt']['created_by']  = $userData['User']['id'];
           $this->request->data['DeliveryReceipt']['printed_by']  = $userData['User']['id'];

           $this->request->data['DeliveryReceipt']['printed']  = date('Y-m-d H:i:s');

           $this->request->data['DeliveryReceipt']['aprroved_by']  = $list['DeliveryDetail']['created_by'];

           $this->DeliveryReceipt->saveDeliveryReceipt($this->request->data,$userData['User']['id']);
                                                      
          }

         // exit();
        }   
         $measureList = $this->Measure->find('list',array('fields' => array('id','name')));

       
        $prepared = $userData;
        $approved = $this->User->find('first', 
            array('fields' => array('id', 'first_name','last_name'),
                'conditions' => array('User.id' => $toPrint[0]['DeliveryDetail']['created_by'])));

        $this->set(compact('toPrint','approved','measureList','prepared','approved'));
        //to print
        $this->render('multiple_dr');
    }


     public function apc($dr_uuid = null,$schedule_uuid) {

        $this->loadModel('Sales.ClientOrder');

        $this->ClientOrder->bind(array('Quotation','QuotationDetail','ClientOrderDeliverySchedule','Product'));
        
        //$this->loadModel('Sales.Company');

        // $this->loadModel('Unit');
        // $units = $this->Unit->getList();

       // $this->Company->bindAddress();

        $this->Delivery->bindDeliveryView();
        $drData = $this->Delivery->find('first', array(
                                            'conditions' => array('Delivery.dr_uuid' => $dr_uuid),
                                            'fields' => array('Delivery.dr_uuid','Delivery.created_by','DeliveryDetail.location','DeliveryDetail.quantity','DeliveryDetail.measure','Delivery.clients_order_id')));

        $clientData = $this->ClientOrder->find('first', array(
                                            'conditions' => array('ClientOrder.uuid' => $drData['Delivery']['clients_order_id']),
                                            //'fields' => array('Product.name','ClientOrder.po_number','ClientOrder.company_id','ClientOrderDeliverySchedule.schedule')
                                            ));

        // $companyData = $this->Company->find('first', array(
        //                                     'conditions' => array('Company.id' => $clientData['ClientOrder']['company_id']),
        //                                     'fields' => array('Company.company_name', 'Address.address1')));



        $userData = $this->Session->read('Auth');

        $this->loadModel('User');

        $prepared = $userData['User']['id'];

        $this->loadModel('User');
        $fullname = $this->User->find('list',array('fields' => array('id','fullname')));

        $this->loadModel('Delivery.Measure');
        $measureList = $this->Measure->find('list',array('fields' => array('id','name')));

        $this->set(compact('companyData', 'clientData', 'drData', 'prepared', 'fullname', 'measureList'));

        $this->render('apc'); 

    }


    public function multiple_apc($dr_uuid = null,$schedule_uuid = null) {

        $this->loadModel('Delivery.DeliveryConnection');


        $this->DeliveryConnection->bindDeliveryById();

        $DRRePrint = array();


        $toPrint = array();

        $this->loadModel('Sales.ClientOrder');

        $this->loadModel('Sales.Company');

        $this->loadModel('Accounting.SalesInvoice');

        $this->loadModel('Delivery.DeliveryReceipt');

        $this->loadModel('Delivery.Measure');

        $this->loadModel('Unit');

        $this->loadModel('User');

        $units = $this->Unit->getList();

        $this->Company->bind('Address');

        $userData = $this->Session->read('Auth');
        
        if (!empty($dr_uuid)) {

        $drConditions =  array('DeliveryConnection.dr_uuid' => $dr_uuid,'Delivery.status !=' => 2);

        $DRRePrint = $this->DeliveryConnection->find('all', array(
                                'limit' => 4,
                                'conditions' => $drConditions,
                                   // 'group' => array('Delivery.id')
                             ));


        if (!empty( $DRRePrint)) {
          
            foreach ($DRRePrint as $key => $list) {
        
                $this->ClientOrder->bind(array('Quotation','ClientOrderDeliverySchedule','QuotationItemDetail','QuotationDetail','Product',));

                //clientOrder = 
                $toPrint[$key] = $list;

                $clientOrder = $this->ClientOrder->find('first', array(
                                                'conditions' => array('ClientOrder.uuid' => $list['Delivery']['clients_order_id']
                                                )));

                $toPrint[$key]['ClientOrder'] = $clientOrder;

                $toPrint[$key]['Company'] = $this->Company->find('first', array(
                                                'conditions' => array('Company.id' =>$clientOrder['ClientOrder']['company_id']
                                                )));


               // pr($clientOrder['ClientOrderDeliverySchedule'][0]);
                     //save delivery reciep number

               // $this->request->data['DeliveryReceipt']['delivety_id'] = $list['Delivery']['id'];
               // $this->request->data['DeliveryReceipt']['dr_uuid'] = $list['Delivery']['dr_uuid'];
               // $this->request->data['DeliveryReceipt']['delivery_id'] = $list['Delivery']['id'];
               // $this->request->data['DeliveryReceipt']['location'] = $clientOrder['ClientOrderDeliverySchedule'][0]['location'];
               // $this->request->data['DeliveryReceipt']['quantity'] = $clientOrder['ClientOrderDeliverySchedule'][0]['quantity'];

               // $this->request->data['DeliveryReceipt']['schedule'] = $clientOrder['ClientOrderDeliverySchedule'][0]['schedule'];
               // $this->request->data['DeliveryReceipt']['created_by']  = $userData['User']['id'];
               // $this->request->data['DeliveryReceipt']['printed_by']  = $userData['User']['id'];

               // $this->request->data['DeliveryReceipt']['printed']  = date('Y-m-d H:i:s');

               // $this->request->data['DeliveryReceipt']['aprroved_by']  = $list['DeliveryDetail']['created_by'];

               // $this->DeliveryReceipt->saveDeliveryReceipt($this->request->data,$userData['User']['id']);
                                                      
          }


        }

        $measureList = $this->Measure->find('list',array('fields' => array('id','name')));
        $prepared = $userData;
        $approved = $this->User->find('first', 
            array('fields' => array('id', 'first_name','last_name'),
                'conditions' => array('User.id' => $toPrint[0]['DeliveryDetail']['created_by'])));


        $this->set(compact('toPrint','approved','measureList','prepared','approved'));
        //to print
        $this->render('apc');
        }

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

                    }
                    
                }

                $units = $this->Unit->find('list',array('fields' => array('id','unit')));

                $this->set(compact('gateId','drlist','truckList','units','gateData','assistData','driverList','assList','drData','clientData','productList','productQuantity','productUnit', 'companyList', 'userData', 'approver', 'userList', 'userFnameList', 'userLnameList', 'driver', 'truck', 'remarks'));

                $this->render('print_gatepass');

    
            }
    }

     public function gate_pass($deliveryScheduleId = null, $quotationId = null,$companyId = null, $clientsOrderUuid = null){

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

        //$conditions = array('Delivery.created <=' => $end, 'Delivery.created >=' => $start , 'Delivery.company_id' => $companyId);
        $conditions = array('Delivery.company_id' => $companyId);

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



    function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
        $sort_col = array();
        foreach ($arr as $key=> $row) {
            $sort_col[$key] = $row;
        }

       return array_multisort($sort_col, $dir, $arr);
    }


    public function search_by_number() {

        Configure::write('debug',2);

        $this->loadModel('Sales.ClientOrderDeliverySchedule');

        $this->loadModel('Sales.ClientOrderDeliverySchedule');

        $this->loadModel('Sales.ClientOrder');

        $this->loadModel('Delivery.DeliveryConnection');

        $this->DeliveryConnection->bindDeliveryById();
        
        $conditions = array('DeliveryConnection.dr_uuid NOT' => '','DeliveryConnection.id NOT' => '');

        $limit = 10;

        // if (!empty($this->request->query('s'))) {
                
        //         $search = $this->request->query('s');

        //         $conditions = array_merge($conditions,array(
        //                 'Delivery.dr_uuid like' => '%'.$search.'%'
        //             ));
        // }
        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'order' => 'DeliveryConnection.dr_uuid DESC',
            //'group' => 'DeliveryConnection.dr_uuid'
        );

        $delivery = $this->paginate('DeliveryConnection');
        // exit();
      // $delivery = $this->array_sort_by_column($delivery, 'dr_uuid');
        $this->set(compact('delivery'));

        // if ($this->request->isAjax() && !empty($this->request->query('s'))) {

        //     $this->render('ajax/search_by_number');
        // }
    }

    public function index_status($status = null) {

        $userData = $this->Session->read('Auth');

        $this->loadModel('Sales.ClientOrderDeliverySchedule');

        $this->loadModel('Ticket.JobTicket');

        $jobTicketData = $this->JobTicket->find('list',array('fields' => array('client_order_id', 'uuid')));

        // $this->Delivery->bindDelivery();

     //  $deliveryStatus = $this->Delivery->find('all');        

        $orderDeliveryList = $this->ClientOrderDeliverySchedule->find('list',array('fields' => array('uuid', 'uuid')));

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

            $items = $this->Delivery->findBySched($value['ClientOrderDeliverySchedule']['uuid']);

            foreach ( $items as $key1 => $valueofDelivery){
    
                    $clientsOrder[$key]['DeliveryDetail']['quantity'] = $valueofDelivery['DeliveryDetail']['quantity'];
                    $clientsOrder[$key]['DeliveryDetail']['delivered_quantity'] = $valueofDelivery['DeliveryDetail']['delivered_quantity'];
                    $clientsOrder[$key]['Delivery']['status'] = $valueofDelivery['Delivery']['status'];
                    $clientsOrder[$key]['Delivery']['dr_uuid'] = $valueofDelivery['Delivery']['dr_uuid'];
                    $clientsOrder[$key]['DeliveryDetail']['status'] = $valueofDelivery['DeliveryDetail']['status'];

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

    public function terminate($id = null, $indicator = null) {

        $this->loadModel('Sales.ClientOrderDeliverySchedule');

        $this->ClientOrderDeliverySchedule->id = $id;

        $this->ClientOrderDeliverySchedule->saveField('status_id', 1);

        $this->Session->setFlash(__('Delivery has been remove to the list'), 'success');

        if(empty($indicator)){
      
            $this->redirect( array(
                'controller' => 'deliveries', 
                'action' => 'index'
                            ));

        }else{

            $this->redirect( array(
                'controller' => 'deliveries', 
                'action' => 'apc_index'
                            ));

        }

    }    

    public function test($status = null) {

        $this->loadModel('Sales.ClientOrderDeliverySchedule');

        $clientData = $this->ClientOrderDeliverySchedule->find('all');

        foreach ($clientData as $key => $value) {
        
            foreach ($deliveryStatus as $key => $valuedelivery) {
        
                if($value['ClientOrderDeliverySchedule']['uuid'] == $valuedelivery['Delivery']['schedule_uuid']){

                    pr($value); exit;

                }

            }


        }

    }

    public function dr_summary() {

        $this->loadModel('Sales.ClientOrder');

        $this->loadModel('Sales.Company');

         $this->loadModel('Sales.Product');

        $this->Delivery->bindDeliveryClientOrder();

        $limit = 15;

        $this->Delivery->recursive = 1;

        $conditions = array('Delivery.status' => 1,'Delivery.dr_uuid' => 't1');
        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'fields' => array(
                'Delivery.id',
                'Delivery.dr_uuid',
                'Delivery.status',
                'Delivery.company_id',
                'Delivery.clients_order_id', 
                'DeliveryDetail.schedule',
                'DeliveryDetail.id',
                'DeliveryDetail.quantity',
                'DeliveryDetail.delivered_quantity'),
            'order' => 'Delivery.id DESC',
            'group' => 'Delivery.id'
        );
        
        $deliveryData = $this->paginate('Delivery');

        $this->ClientOrder->bind(array('QuotationDetail','Product'));

        $clientOrderData = $this->ClientOrder->find('all', array(
                                       'fields' => array('ClientOrder.po_number',
                                        'ClientOrder.uuid',
                                        'Product.name' )
                                   ));

        foreach ($clientOrderData as $key => $clientValue) {

            foreach ($deliveryData as $key2 => $deliveryValue) {

                if($clientValue['ClientOrder']['uuid'] == $deliveryValue['Delivery']['clients_order_id']){

                    $deliveryData[$key2]['ClientOrder']['po_number'] = $clientValue['ClientOrder']['po_number'];

                    $deliveryData[$key2]['ClientOrder']['item_name'] = $clientValue['Product']['name'];

                }

            }
            
        }

        $productData = $this->Product->find('list',array('fields' => array('id','name'),
                                            'order' => 'Product.name ASc'));

        $companyData= $this->Company->find('list',array('fields' => array('id','company_name'),
                                            'order' => 'Company.company_name ASC'));

        $noPermissionSales = ' '; 

        $this->set(compact('noPermissionSales', 'deliveryData', 'PONumber', 'companyData', 'productData'));     
            
    }

    public function daterange_summary($from = null, $to = null, $product = null , $company = null, $export = null){

        if($product != "undefined"){

            if($from != "undefined" || $to != "undefined"){

                $condition = ' QuotationDetail.product_id ='.$product.'
                    AND (Delivery.created BETWEEN "'.$from.' 00:00:00'.'" AND "'.$to.' 00:00:00'.'") AND 
                    Delivery.status = 1';

            }else{

                $condition = ' QuotationDetail.product_id ='.$product.' AND 
                    Delivery.status = 1';

            }

        }else if($company != "undefined"){

            if($from != "undefined" || $to != "undefined"){

                $condition = ' ClientOrder.company_id ='.$company.'
                    AND (Delivery.created BETWEEN "'.$from.' 00:00:00'.'" AND "'.$to.' 00:00:00'.'") AND 
                    Delivery.status = 1';

            }else{

                $condition = ' ClientOrder.company_id ='.$company.' AND 
                    Delivery.status = 1';

            }

        }else{

            $condition = ' Delivery.created BETWEEN "'.$from.' 00:00:00'.'" AND "'.$to.' 00:00:00'.'" AND 
                    Delivery.status = 1';

        } 

        $order =' ORDER BY ClientOrder.po_number ASC';

        $deliveryData = $this->Delivery->query('SELECT Delivery.id,
                Delivery.dr_uuid, Delivery.company_id, Delivery.created,
                Delivery.clients_order_id, DeliveryDetail.schedule, DeliveryDetail.id,
                DeliveryDetail.quantity,DeliveryDetail.delivered_quantity ,Product.name,
                ClientOrder.po_number, Company.company_name , QuotationItemDetail.quantity , QuotationItemDetail.id
                FROM koufu_delivery.deliveries AS Delivery
                LEFT JOIN koufu_delivery.delivery_details AS DeliveryDetail
                ON Delivery.dr_uuid = DeliveryDetail.delivery_uuid
                LEFT JOIN koufu_sale.client_orders AS ClientOrder
                ON Delivery.clients_order_id = ClientOrder.uuid
                LEFT JOIN koufu_sale.quotation_details AS QuotationDetail
                ON ClientOrder.quotation_id = QuotationDetail.quotation_id
                LEFT JOIN koufu_sale.quotation_item_details AS QuotationItemDetail
                ON ClientOrder.client_order_item_details_id = QuotationItemDetail.id
                LEFT JOIN koufu_sale.products AS Product
                ON Product.id = QuotationDetail.product_id
                LEFT JOIN koufu_sale.companies AS Company
                ON Company.id = ClientOrder.company_id
                WHERE'. $condition.' GROUP BY Delivery.dr_uuid
                '. $order.'
                ');

        $noPermissionSales = ' '; 

        $this->set(compact('noPermissionSales', 'deliveryData', 'PONumber', 'companyData'));   

        if(!empty($export)){

            return $deliveryData;

        }else{

            $this->render('daterange_summary'); 

        }
        
    }
    
    public function export_dr() {


        if(!empty($this->request->data['from_date'])){

            $date = split("-", $this->request->data['from_date']);

            $date1 = trim($date[0]);

            $date2 = trim($date[1]); 

            $from = str_replace('/', '-', $date1);

            $to = str_replace('/', '-', $date2);

        }else{

            $from = 'undefined';

            $to = 'undefined';

        }

        if(!empty($this->request->data['SalesInvoice']['company_id'])){

            $company = $this->request->data['SalesInvoice']['company_id'];

        }else{

            $company = 'undefined';

        }

        if(!empty($this->request->data['SalesInvoice']['product_id'])){

            $product = $this->request->data['SalesInvoice']['product_id'];

        }else{

            $product = 'undefined';

        }

        $export = 1;

        $deliveryData = $this->daterange_summary($from, $to, $product, $company, $export);

        if((empty($this->request->data['from_date']) && empty($this->request->data['SalesInvoice']['company_id']) && empty($this->request->data['SalesInvoice']['product_id'])) || empty($deliveryData)){

            $this->Session->setFlash(__('Use the Filter or Check the Data before Export'), 'error');

            $this->redirect( array(
                'controller' => 'deliveries',   
                'action' => 'dr_summary'
            ));   

        }

        $noPermissionSales = ' '; 

        $this->set(compact('noPermissionSales', 'deliveryData'));   

        $this->render('export_dr');
        
    }

    public function check_dr_to_print() {

        $delivery = array('');
        
        if (!empty($this->request->data)) {
            
            $data = $this->request->data;

            $this->loadModel('Delivery.DeliveryConnection');

            $this->loadModel('Delivery.DeliveryDetail');

            $this->loadModel('Sales.ClientOrder');

            $this->loadModel('Sales.ClientOrderDeliverySchedule');
            
            $multiple = false;
            // $delivery = $this->DeliveryConnection->find('all',array(
            //     'conditions' => array('DeliveryConnection.dr_uuid' => $data['dr_uuid'])
            // ));functio

            $delivery = $this->DeliveryConnection->query('SELECT *
                FROM delivery_connection AS DeliveryConnection
                LEFT JOIN deliveries AS Delivery
                ON Delivery.id = DeliveryConnection.delivery_id 
                WHERE DeliveryConnection.dr_uuid = "'.$data['dr_uuid'].'" 
                AND Delivery.status != "2"
                ');


            if (!empty($delivery)) {

               
                $multiple = true;
            } else {
                
                $multiple = false;

                $this->DeliveryDetail->bind(array('Delivery'));

                $delivery[0] = $this->DeliveryDetail->find('first',array('conditions' => array(
                        'DeliveryDetail.delivery_uuid' => $data['dr_uuid']
                )));

                $this->ClientOrder->bindDelivery();

                $clientOrder =  $this->ClientOrder->find('first',array(
                        'conditions' => array(
                                'ClientOrder.uuid' => $delivery[0]['Delivery']['clients_order_id']
                            )
                ));

                $delivery[0]['ClientOrder'] = $clientOrder;

            }

            $count = count($delivery);

        }

        echo json_encode(array('result' => $delivery,'total' =>  $count ,'multiple' => $multiple ));

        exit();

    }

    

}