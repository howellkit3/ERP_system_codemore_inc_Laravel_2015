<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');
App::import('Vendor', 'DOMPDF', true, array(), 'dompdf'.DS.'dompdf_config.inc.php', false);

class DeliveriesController extends DeliveryAppController {

  //   var $paginate = array( 
  //       'ClientOrder' => array( 
  //               'limit' => 10,
  //                //'fields' => array('ClientOrder.uuid', 'Company.company_name', 'created','ItemCategoryHolder.name'),
  //               //, 
  //               'order' => 'ClientOrder.id DESC'
  //           ),
  // ); 

  public $uses = array('Delivery.Delivery', 'Delivery.DeliveryDetail');

   public $paginate = array(
    'limit' => 10
    );

  public function index() {

        $this->loadModel('Sales.ClientOrder');

        $this->loadModel('Sales.ClientOrderDeliverySchedule');

        $deliveryData = $this->Delivery->find('list',array('fields' => array('schedule_uuid','status')));

        $this->ClientOrder->bindDelivery();

        $clientsOrder = $this->ClientOrder->find('all', array(
                                        'order' => 'ClientOrderDeliverySchedule.id DESC'
                                        ));  
        
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

        $limit = 10;

        $conditions = array();

        $this->ClientOrder->paginate = array(
            'conditions' => $conditions,
            'limit' => '1',
            'fields' => array(
              'ClientOrder.uuid',
              'ClientOrder.po_number',
              'Company.company_name',  
              'Product.name', 
              'ClientOrderDeliverySchedule.quantity', 
              'ClientOrderDeliverySchedule.location', 
              'ClientOrderDeliverySchedule.schedule'
              ),
            'order' => 'ClientOrderDeliverySchedule.id DESC',
        );

        $clientsOrders = $this->paginate('ClientOrder');

        $this->set(compact('clientsOrder','deliveryData', 'deliveryList', 'deliveryDetailList', 'clientsStatus', 'deliveryStatus', 'orderList', 'orderListHelper', 'orderDeliveryList'));
   }

   public function delivery_info($id = null, $location = null){

      $url = $location;
      $this->loadModel('Delivery.Schedule');

      $scheduleInfo = $this->Schedule->find('first', array(
                              'condtions' => array(
                                'sales_order_id' => $id
                              )
                          ));

      $this->loadModel('Delivery.Delivery');
      $detailValue = $this->Delivery->Find('all', array(
                                              'conditions' => array(
                                                  'sales_order_id' => $id),
                                              'order' => array(
                                                  'delivery_details_id ASC'
                                                )

                                          ));
      
      $status = $this->Delivery->find('first', array(
                                          'fields' => array(
                                              'DISTINCT status'),
                                          'conditions' => array(
                                              'sales_order_id' => $id
                                            )
                                        ));

      $this->loadModel('Delivery.DeliveryDetail');
      $deliveryDetail = $this->DeliveryDetail->find('list', array('fields' => array('id', 'description')));
      
      $this->set(compact('scheduleInfo','deliveryDetail','detailValue', 'url', 'status'));

   		
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
        $this->request->data['Delivery']['status']  = 'Approved';
        $this->request->data['DeliveryDetail']['location']  = $scheduleInfo['ClientOrderDeliverySchedule']['location'];
        $this->request->data['DeliveryDetail']['quantity']  = $scheduleInfo['ClientOrderDeliverySchedule']['quantity'];
        $this->request->data['DeliveryDetail']['schedule']  = $scheduleInfo['ClientOrderDeliverySchedule']['schedule'];
        $this->request->data['DeliveryDetail']['created_by']  = $userData['User']['id'];
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

       // 

        $this->set(compact('scheduleInfo'));
        
   }

   public function delivery_detail(){
   		$salesId = $this->Delivery->find('all', array(
   											'fields' => array(
   												' DISTINCT sales_order_id', 'status')
   										));

   		$this->set(compact('salesId'));

   		
   }
   public function message($id = null){
    $this->loadModel('Delivery.Schedule');
    $scheduleInfo = $this->Schedule->find('first', array(
                                               'conditions' => array(
                                                  'sales_order_id' => $id
                                              )
                                          ));

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

     // pr($this->request->data ); exit;

       $this->loadModel('Sales.ClientOrderDeliverySchedule');

       $this->loadModel('Sales.ClientOrder');

        $this->ClientOrder->bindDelivery();
        $scheduleInfo = $this->ClientOrder->find('first', array(
                                         'conditions' => array(
                                          'ClientOrderDeliverySchedule.id' => $deliveryScheduleId
                                        )
                                    ));

        //pr($scheduleInfo['ClientOrderDeliverySchedule']['uuid']); exit;

        $this->Delivery->bindDelivery();
        $deliveryDetailsData = $this->Delivery->find('first',array('order' => 'Delivery.id DESC'));

        //pr($deliveryScheduleId); exit;

         $deliveryData = $this->Delivery->find('first', array(
                                         'conditions' => array(
                                        'Delivery.schedule_uuid' => $clientsOrderUuid
                                        )
                                    ));

 
         $this->Delivery->bindDelivery();
         $deliveryEdit = $this->Delivery->find('all', array(
                                         'conditions' => array(
                                        'Delivery.schedule_uuid' => $clientsOrderUuid
                                        )
                                    ));

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


        $this->set(compact('deliveryScheduleId','quotationId','clientsOrderUuid','scheduleInfo','deliveryData', 'quantityInfo','deliveryDataID','deliveryDetailsData', 'deliveryEdit', 'deliveryDetailList','deliveryList','deliveryStatus', 'orderList', 'orderListHelper', 'orderDeliveryList'));
        
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
            $this->request->data['Delivery']['status'] =  'Approved';   
  
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

            if($this->request->data['DeliveryDetail']['quantity'] == $this->request->data['DeliveryDetail']['delivered_quantity']){

                $this->request->data['DeliveryDetail']['status'] =  'Completed'; 

            }else{

            $this->request->data['DeliveryDetail']['status'] =  'Incomplete';

            
        }

        if(!empty($this->request->data['DeliveryDetail']['from_replacing'])){     

          if($this->request->data['DeliveryDetail']['from_replacing'] = 'replacing'){

            $this->request->data['DeliveryDetail']['delivered_quantity'] =  $this->request->data['DeliveryDetail']['delivered'] + $this->request->data['DeliveryDetail']['delivered_quantity'];

          }
        }

        if(!empty($this->request->data['DeliveryDetail']['holder'])){  

            $this->request->data['DeliveryDetail']['quantity'] = $this->request->data['DeliveryDetail']['holder'];

        }
            //pr($this->request->data); exit;

            $this->DeliveryDetail->saveDeliveryDetail($this->request->data,$userData['User']['id']);

            $this->Session->setFlash(__('Schedule has been updated.'),'success');

            $this->redirect( array(
                           'controller' => 'deliveries', 
                           'action' => 'view',$deliveryScheduleId,$quotationId,$clientsOrderUuid
                      ));
            
           
            }
       
}

public function delivery_replacing() {

$userData = $this->Session->read('Auth');

  $this->loadModel('Sales.ClientOrderDeliverySchedule');

  $this->loadModel('Sales.ClientOrder');

  $this->Delivery->bindDelivery();
  
  $deliveryEdit = $this->Delivery->find('all', array(
                                         'conditions' => array(
                                        'DeliveryDetail.status' => 'Incomplete'),
                                        'order' => 'DeliveryDetail.modified DESC'
                                    ));

  $this->ClientOrder->bindDelivery();

  $clientOrderData = $this->ClientOrderDeliverySchedule->find('list',array('fields' => array('uuid','id')));

  $scheduleInfo = $this->ClientOrder->find('all');

  $this->set(compact('deliveryEdit', 'scheduleInfo', 'clientOrderData'));     
        
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
                  //$this->Delivery->id = $idDelivery;
                   
                  //pr($clientsOrder); exit;
                   //$this->request->data['DeliveryDetail']['id'] = $this->request->data['Idholder']['id'];
                    //pr($this->request->data); exit;
                    //$this->ClientOrderDeliverySchedule->save($this->request->data);
                    $this->DeliveryDetail->saveDeliveryDetail($this->request->data,$userData['User']['id']);
                    //$this->Delivery->saveDelivery($this->request->data,$userData['User']['id']);
                    $this->Session->setFlash(__('Schedule has been updated.'),'success');
                    $this->redirect( array(
                                 'controller' => 'deliveries', 
                                 'action' => 'view',$clientsOrder['ClientOrderDeliverySchedule']['id'],
                                                    $clientsOrder['QuotationDetail']['quotation_id'],
                                                    $deliveryEdit['Delivery']['schedule_uuid']
                            ));
                
                $this->Session->setFlash(__('Unable to update your post.'));
     }            
        
  $this->set(compact('deliveryEdit', 'clientOrderData', 'clientsOrder', 'deliveryData', 'scheduleInfo', 'userData', 'companyAddress'));      
}


public function print_dr($dr_uuid = null,$schedule_uuid) {

    $this->loadModel('Sales.ClientOrder');
    $this->ClientOrder->bind(array('Quotation','ClientOrderDeliverySchedule','QuotationItemDetail','QuotationDetail','Product'));
    //$this->ClientOrder->bindDelivery();
    $this->loadModel('Sales.Company');

    $this->loadModel('Unit');
    $units = $this->Unit->getList();

    $this->Company->bind('Address');

    $this->Delivery->bindDelivery();
    $drData = $this->Delivery->find('first', array(
                                        'conditions' => array('Delivery.dr_uuid' => $dr_uuid
                                        )));
    //pr('d');exit();
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

    $prepared = $this->User->find('first', array('fields' => array('id', 'first_name','last_name'),
                                                            'conditions' => array('User.id' => $drDataHolder['DeliveryDetail']['modified_by'])
                                                            ));


    $approved = $this->User->find('first', array('fields' => array('id', 'first_name','last_name'),
                                                            'conditions' => array('User.id' => $drDataHolder['DeliveryDetail']['created_by'])
                                                            ));


    
    $view = new View(null, false);
    
    $view->set(compact('drData','clientData','companyData','units','approved','prepared'));
      
    $view->viewPath = 'Deliveries'.DS.'pdf';  
   
    $output = $view->render('print_dr', false);
  
    $dompdf = new DOMPDF();
    mb_internal_encoding('UTF-8');
    def("DOMPDF_UNICODE_ENABLED", true);
    $dompdf->set_paper("A4");
    $dompdf->load_html(utf8_decode($output), Configure::read('App.encoding'));
    $dompdf->render();
    $canvas = $dompdf->get_canvas();
    $font = Font_Metrics::get_font("helvetica", "bold");
    $canvas->page_text(16, 800, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, array(0,0,0));

    $output = $dompdf->output();
    $random = rand(0, 1000000) . '-' . time();
    if (empty($filename)) {
      $filename = 'Delivery-'.$dr_uuid.'-data'.time();
    }
    $filePath = 'view_pdf/'.strtolower(Inflector::slug( $filename , '-')).'.pdf';
    $file_to_save = WWW_ROOT .DS. $filePath;
      
    if ($dompdf->stream( $file_to_save, array( 'Attachment'=>0 ) )) {
        unlink($file_to_save);
    }
    
    exit();
        
  }

  public function print_replacing($dr_uuid = null,$schedule_uuid, $paper = null) {

    $this->loadModel('Delivery.Transmittal');
    
    $this->loadModel('Sales.ClientOrder');

    $this->ClientOrder->bind(array('Quotation','ClientOrderDeliverySchedule','QuotationItemDetail','QuotationDetail','Product'));
    
    $this->loadModel('Sales.Company');

    $this->loadModel('Unit');
    $units = $this->Unit->getList();

    $this->Company->bind('Address');

    $this->Delivery->bindDelivery();
    $drData = $this->Delivery->find('first', array(
                                        'conditions' => array('Delivery.dr_uuid' => $dr_uuid
                                        )));
    //pr($this->request->data);exit();
    $clientData = $this->ClientOrder->find('first', array(
                                        'conditions' => array('ClientOrder.uuid' => $drData['Delivery']['clients_order_id']
                                        )));
    
    $companyData = $this->Company->find('first', array(
                                        'conditions' => array('Company.id' => $clientData['ClientOrder']['company_id']
                                        )));
    $this->loadModel('User');
    $prepared = $this->User->find('first', array('fields' => array('id', 'first_name','last_name'),
                                                            'conditions' => array('User.id' => $drData['DeliveryDetail']['modified_by'])
                                                            ));



    $approved = $this->User->find('first', array('fields' => array('id', 'first_name','last_name'),
                                                            'conditions' => array('User.id' => $drData['DeliveryDetail']['created_by'])
                                                            ));

    //pr($prepared); exit;

    if(!empty($this->request->data['DeliveryDetail']['quantity'])){

    $drQuantity = $this->request->data['DeliveryDetail']['quantity'];

    $this->DeliveryDetail->save($this->request->data['DeliveryDetail']);

    }

    if(!empty($this->request->data['Transmittal']['contact_person'])){

      $contactPerson = $this->request->data['Transmittal']['contact_person'];

      $quantityTransmittal = $this->request->data['Transmittal']['quantity'];

      $remarks = $this->request->data['Transmittal']['remarks'];

    }
   
    $userData = $this->Session->read('Auth');
    
    $view = new View(null, false);
    
    $view->set(compact('drData','clientData','companyData','units', 'prepared', 'approved', 'contactPerson', 'remarks', 'quantityTransmittal','drQuantity'));

      $view->viewPath = 'Deliveries'.DS.'pdf';  

        if ($this->request->data['Print']['form'] == 1 ){
       
          $output = $view->render('print_transmittal', false);

          if ($this->request->is(array('post', 'put'))) {

                $this->request->data['Transmittal']['created_by'] = $userData['User']['id'];

                $this->Transmittal->save($this->request->data);

                $this->Session->setFlash(__('Transmittal Form is ready now ready to print.'),'success');
                          
          }
    
        }else{

        //pr($this->request->data); exit;

        //$this->request->data['DeliveryDetail']['id'] = $userData['User']['id'];

        $output = $view->render('print_dr', false);

        }
        
      
        $dompdf = new DOMPDF();
        mb_internal_encoding('UTF-8');
        def("DOMPDF_UNICODE_ENABLED", true);
        $dompdf->set_paper("A4");
        $dompdf->load_html(utf8_decode($output), Configure::read('App.encoding'));
        $dompdf->render();
        $canvas = $dompdf->get_canvas();
        $font = Font_Metrics::get_font("helvetica", "bold");
        $canvas->page_text(16, 800, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, array(0,0,0));

        $output = $dompdf->output();
        $random = rand(0, 1000000) . '-' . time();
        if (empty($filename)) {
          $filename = 'Delivery-'.$dr_uuid.'-data'.time();
        }
        $filePath = 'view_pdf/'.strtolower(Inflector::slug( $filename , '-')).'.pdf';
        $file_to_save = WWW_ROOT .DS. $filePath;
          
        if ($dompdf->stream( $file_to_save, array( 'Attachment'=>0 ) )) {
            unlink($file_to_save);
        }
        
        exit();
  }      

  public function delivery_transmittal($dr_uuid = null,$schedule_uuid,$paper = null) {

    $userData = $this->Session->read('Auth');

    $this->loadModel('Sales.ClientOrder');

    $this->ClientOrder->bind(array('Quotation','ClientOrderDeliverySchedule','QuotationItemDetail','QuotationDetail','Product'));
    
    $this->loadModel('Sales.Company');

    $this->loadModel('Unit');

    $this->loadModel('Sales.Address');

    $companyAddress = $this->Address->find('list',array('fields' => array('address1','address1','foreign_key')));

   // $this->ClientOrder->bindDelivery();

   // $clientsOrder = $this->ClientOrder->find('first', array(
                                       // 'conditions' => array('ClientOrderDeliverySchedule.uuid' => $schedule_uuid
                                       // ))); 

    if($this->request->data['Delivery']['print'] == 1){

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

      $nameForm = "Transmittal";

    } else {

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

    }


    $this->set(compact('drData','clientData','companyData','units','nameForm', 'companyAddress'));
    
}

public function delivery_transmittal_record() {

  $userData = $this->Session->read('Auth');

  $this->loadModel('Sales.ClientOrderDeliverySchedule');

  $this->loadModel('Sales.ClientOrder');

  $this->loadModel('Delivery.Transmittal');

  $this->Delivery->bindDelivery();

  //$this->Transmittal->bind(array('Delivery', 'DeliveryDetail'));
  
  $transmittalData = $this->Transmittal->find('all', array(
                                        'order' => 'Transmittal.id DESC'
                                    ));

   //pr($transmittalData); exit;

  $this->ClientOrder->bindDelivery();

  $clientOrderData = $this->ClientOrderDeliverySchedule->find('list',array('fields' => array('uuid','id')));

  $scheduleInfo = $this->ClientOrder->find('all');

  $this->set(compact('transmittalData', 'scheduleInfo', 'clientOrderData'));     
        
}

public function search_order($hint = null){

    $this->loadModel('Sales.ClientOrder');

    $this->loadModel('Sales.ClientOrderDeliverySchedule');

    $this->ClientOrder->bindDelivery();

    $clientsOrder = $this->ClientOrder->find('all',array(
                  'conditions' => array(
                    'OR' => array(
                      array('ClientOrder.po_number LIKE' => '%' . $hint . '%'),
                      array('Product.name LIKE' => '%' . $hint . '%')
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

    $prepared = $this->User->find('first', array('fields' => array('id', 'first_name','last_name'),
                                                            'conditions' => array('User.id' => $drDataHolder['DeliveryDetail']['modified_by'])
                                                            ));


    $approved = $this->User->find('first', array('fields' => array('id', 'first_name','last_name'),
                                                            'conditions' => array('User.id' => $drDataHolder['DeliveryDetail']['created_by'])
                                                            ));

    //pr($drData); exit;

    $this->set(compact('drData','clientData','companyData','units','approved','prepared'));

   // $this->render('dr');

        
        
    }

}