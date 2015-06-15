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

        $deliveryData = $this->Delivery->find('list',array('fields' => array('schedule_uuid','status')));

        $this->ClientOrder->bindDelivery();

        $clientsOrder = $this->ClientOrder->find('all', array(
                                        'order' => 'ClientOrderDeliverySchedule.id DESC'
                                        ));     

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

        // $this->Delivery->bindDelivery();
        // $deliveryDetailsData = $this->Delivery->find('all', array(
        //                                  'conditions' => array(
        //                                   'Delivery.clients_order_id' => 'ClientOrder.uuid'
        //                                 )
        //                             ));
   
        $this->set(compact('clientsOrder','deliveryData', 'status', 'deliveryDetailsData'));
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


                //pr($this->request->data); exit;

                $this->Delivery->create();

                $this->id = $this->Delivery->saveDelivery($this->request->data,$userData['User']['id']);

                $this->DeliveryDetail->save($this->request->data);

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

        $this->Delivery->bindDelivery();
        $deliveryDetailsData = $this->Delivery->find('first',array('order' => 'Delivery.id DESC'));

        $this->Delivery->bindDelivery();
        $deliveryEdit = $this->Delivery->find('all', array(
                                         'conditions' => array(
                                        'Delivery.schedule_uuid' => $clientsOrderUuid
                                        )
                                    ));

         $deliveryData = $this->Delivery->find('first', array(
                                         'conditions' => array(
                                        'Delivery.schedule_uuid' => $scheduleInfo['ClientOrderDeliverySchedule']['uuid']
                                        )
                                    ));
        
        $quantityInfo = $this->ClientOrderDeliverySchedule->find('list',array('fields' => array('uuid','quantity')));

        $deliveryData = $this->Delivery->find('list',array('fields' => array('schedule_uuid','status')));

        $deliveryDataID = $this->Delivery->find('list',array('fields' => array('schedule_uuid','id')));

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


        $this->set(compact('deliveryScheduleId','quotationId','clientsOrderUuid','scheduleInfo',  'deliveryData', 'quantityInfo','deliveryDataID','deliveryDetailsData', 'deliveryEdit'));
        
}

 public function add_schedule($idDelivery = null,$idDeliveryDetail = null,$deliveryScheduleId = null, $quotationId = null, $clientsOrderUuid = null) {

      $userData = $this->Session->read('Auth');

      $this->loadModel('Delivery.DeliveryDetail');

      $this->loadModel('Sales.ClientOrder');

      $this->Delivery->bindDelivery();

      $deliveryData = $this->Delivery->find('first', array('conditions' => array(
                                                                          'Delivery.schedule_uuid' => $this->request->data['Delivery']['schedule_uuid']),
                                                                          'order' => 'Delivery.id DESC'));
      //pr($this->request->data['DeliveryDetail']['quantity']); exit;
        if ($this->request->is(array('post', 'put'))) {

            // $remainingQuantity = $deliveryData['DeliveryDetail']['remaining_quantity'];

            // $enteredQuantity =$this->request->data['DeliveryDetail']['quantity'];

            // $difference = $remainingQuantity - $enteredQuantity;

            //$this->request->data['DeliveryDetail']['delivered_quantity'] = $difference;

            $this->Delivery->id = $idDelivery;
            $this->DeliveryDetail->id = $idDeliveryDetail;

            $this->request->data['DeliveryDetail']['delivery_uuid'] =  $this->request->data['Delivery']['dr_uuid']; 
            $this->request->data['DeliveryDetail']['created_by'] =  $userData['User']['id'];    
            $this->request->data['Delivery']['status'] =  'Approved';   

                  
            //$this->ClientOrderDeliverySchedule->save($this->request->data);
            $this->Delivery->saveDelivery($this->request->data,$userData['User']['id']);
            $this->DeliveryDetail->saveDeliveryDetail($this->request->data,$userData['User']['id']);
            //$this->Delivery->saveDelivery($this->request->data,$userData['User']['id']);
            $this->Session->setFlash(__('Schedule has been updated.'),'success');
            $this->redirect( array(
                           'controller' => 'deliveries', 
                           'action' => 'view',$deliveryScheduleId,$quotationId,$clientsOrderUuid
                      ));
            
            $this->Session->setFlash(__('Unable to update your post.'));
            }

        $this->set(compact('scheduleInfo',  'deliveryData'));
        
}

public function delivery_plan() {

       
        
}


public function add_delivery() {

       
        
}

public function delivery_edit($dr_uuid = null, $clientsOrderUuid = null) {

  $userData = $this->Session->read('Auth');

  $this->loadModel('Sales.ClientOrder');

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

  $this->loadModel('Sales.ClientOrder');
  $this->ClientOrder->bindDelivery();

  $clientsOrder = $this->ClientOrder->find('first', array(
                                        'conditions' => array('ClientOrderDeliverySchedule.uuid' => $clientsOrderUuid
                                        )));    
  //pr($clientsOrder); exit;
 
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
        
  $this->set(compact('deliveryEdit', 'clientOrderData', 'clientsOrder', 'deliveryData', 'scheduleInfo'));      
}


public function print_dr($dr_uuid = null,$schedule_uuid) {

    $this->loadModel('Sales.ClientOrder');
    $this->ClientOrder->bind('ClientOrderDeliverySchedule');

    $this->loadModel('Sales.Company');
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
    
    $view = new View(null, false);
    
    $view->set(compact('drData','clientData','companyData'));
      
    $view->viewPath = 'Deliveries'.DS.'pdf';  
   
        $output = $view->render('print_dr', false);
     
        $dompdf = new DOMPDF();
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



}