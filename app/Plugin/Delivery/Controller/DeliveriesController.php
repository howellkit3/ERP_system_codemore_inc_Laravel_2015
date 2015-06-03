<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class DeliveriesController extends DeliveryAppController {

    var $paginate = array( 
        'ClientOrder' => array( 
                 //'fields' => array('ClientOrder.uuid', 'Company.company_name', 'created','ItemCategoryHolder.name'),
                'limit' => 10//, 
                //'order' => 'ItemCategoryHolder.id DESC'
            ),
  ); 

  public $uses = array('Delivery.Delivery');

  public function index() {

        $this->loadModel('Sales.ClientOrder');

        $this->ClientOrder->bindDelivery();
        $clientsOrder = $this->ClientOrder->find('all', array(
                                        'order' => 'ClientOrderDeliverySchedule.id DESC'
                                        ));
        $deliveryData = $this->Delivery->find('list',array('fields' => array('schedule_uuid','status')));

      
        //$deliveryStatus = $this->Delivery->find('all');

       //pr($deliveryData); exit;
        
       
        /*$this->loadModel('Sales.ClientOrderDeliverySchedule');

        $this->loadModel('Sales.Company');

        $this->ClientOrderDeliverySchedule->bind(array('ClientOrder' , 'QuotationItemDetail' , 'Quotation'));

         $scheduleData = $this->ClientOrderDeliverySchedule->find('all', array(
                                        'order' => 'ClientOrderDeliverySchedule.id DESC'
                                        ));

        $companyData = $this->Company->find('list', array('fields' => 
                                                array('id',
                                                     'company_name'),
                                                    // 'conditions' => array(
                                                    // 'Company.id' => 'ClientOrder.company_id'),
                                                     ));

        //pr($companyData);exit();conditions' => array('Company.id' => 'ClientOrder.company_id*/
        $limit = 10;

        $conditions = array();

        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
           // 'fields' => array('ClientOrder.uuid', 'Company.company_name',  'Product.name', 'ClientOrder.po_number', 'QuotationItemDetail.quantity'),
            'order' => 'ClientOrder.id DESC',
        );

        $clientsOrders = $this->paginate('ClientOrder');
       
        //$this->set(compact('scheduleData', 'companyData'));
        $this->set(compact('clientsOrder','deliveryData', 'status'));
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
   public function add($id = null){

   		 $userData = $this->Session->read('Auth');
      
        $this->loadModel('Sales.ClientOrderDeliverySchedule');

        $this->ClientOrderDeliverySchedule->bind(array('ClientOrder'));
        
        $scheduleInfo = $this->ClientOrderDeliverySchedule->find('first', array(
                                                                         'conditions' => array(
                                                                          'ClientOrderDeliverySchedule.id' => $id
                                                                        )
                                                                    ));

        //pr($scheduleInfo); exit;
        $this->request->data['schedule_uuid'] = $scheduleInfo['ClientOrderDeliverySchedule']['uuid'];
        $this->request->data['clients_order_id']  = $scheduleInfo['ClientOrder']['uuid'];
        $this->request->data['status']  = 'Approved';
        
        
            
                //pr($userData['User']['id']); exit;

                $this->Delivery->create();

                $this->id = $this->Delivery->saveDelivery($this->request->data,$userData['User']['id']);

                $this->Session->setFlash(__('Delivery receipt was issued'));

                $this->redirect(

                    array('controller' => 'deliveries', 'action' => 'index')

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

    public function view($id = null) {

     // pr($this->request->data ); exit;

       $this->loadModel('Sales.ClientOrderDeliverySchedule');

       $this->loadModel('Sales.ClientOrder');

        $this->ClientOrder->bindDelivery();
        $scheduleInfo = $this->ClientOrder->find('first', array(
                                         'conditions' => array(
                                          'ClientOrderDeliverySchedule.id' => $id
                                        )
                                    ));
        $deliveryData = $this->Delivery->find('list',array('fields' => array('schedule_uuid','status')));


        if ($this->request->is(array('post', 'put'))) {

             // pr($this->request->data['ClientOrderDeliverySchedule']['id']); exit; 

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


        $this->set(compact('scheduleInfo',  'deliveryData'));
        
}

 public function edit($id = null) {

       $this->loadModel('Sales.ClientOrderDeliverySchedule');

       $this->loadModel('Sales.ClientOrder');

        if ($this->request->is(array('post', 'put'))) {

                $this->ClientOrderDeliverySchedule->id = $id;

                   // pr($this->request->data); exit;
               
                    $this->ClientOrderDeliverySchedule->save($this->request->data);
                    $this->Session->setFlash(__('Schedule has been updated.'),'success');
                    $this->redirect( array(
                                 'controller' => 'deliveries', 
                                 'action' => 'index'
                            ));
                
                $this->Session->setFlash(__('Unable to update your post.'));
            }


        $this->set(compact('scheduleInfo',  'deliveryData'));
        
}

}