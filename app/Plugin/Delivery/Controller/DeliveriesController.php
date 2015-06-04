<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class DeliveriesController extends DeliveryAppController {

  //   var $paginate = array( 
  //       'ClientOrderDeliverySchedule' => array( 
  //                //'fields' => array('ClientOrder.uuid', 'Company.company_name', 'created','ItemCategoryHolder.name'),
  //               'limit' => 10//, 
  //               //'order' => 'ItemCategoryHolder.id DESC'
  //           ),
  // ); 

  public function index() {

        $this->loadModel('Sales.ClientOrder');

        $this->ClientOrder->bindDelivery();
        $clientsOrder = $this->ClientOrder->find('all', array(
                                        'order' => 'ClientOrderDeliverySchedule.id DESC'
                                        ));
        
        //pr($clientsOrder); exit;

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

        //pr($companyData);exit();conditions' => array('Company.id' => 'ClientOrder.company_id
        $limit = 10;

        $conditions = array();

        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
           // 'fields' => array('ClientOrder.uuid', 'Company.company_name',  'Product.name', 'ClientOrder.po_number', 'QuotationItemDetail.quantity'),
            'order' => 'ClientOrderDeliverySchedule.id DESC',
        );*/

       // $scheduleData = $this->paginate('ClientOrderDeliverySchedule');
       
        //$this->set(compact('scheduleData', 'companyData'));
        $this->set(compact('clientsOrder'));
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
   public function add($id = null, $location = null){
   		$userData = $this->Session->read('Auth');
        if($this->request->is('post')){

            if(!empty($this->request->data)){
            	
            	$status ="";
            	if(!empty($this->request->data['Delivery']['qty_rejected'])){
            		$status = "With Reject Quantity";
            	}
            	else{
            		$status ="Complete Delivery" ;
            	}

            	for($dId = 0; $dId < 4; $dId++){
            		$this->Delivery->addDelivery($this->request->data, $dId + 1, $status, $userData['User']['id']);
            	}
	        	
	        	$this->Session->setFlash(__(' Successfully Added.'));
	        	$this->redirect( array(
                                 'controller' => 'deliveries', 
                                 'action' => 'index'
                            ));
	        }
        }
        $action = "";
        if(!empty($id)){
            $action = "index";

            $count = $this->Delivery->find('count', array(
                                          'conditions' => array(
                                            'sales_order_id' => $id)
                                        ));


            if($count != 0){
              $this->redirect( array(
                                     'controller' => 'deliveries', 
                                     'action' => 'delivery_info', 
                                     $id, $location
                                ));

            }

            $this->loadModel('Delivery.Schedule');
            $scheduleInfo = $this->Schedule->find('first', array(
                                                     'conditions' => array(
                                                        'sales_order_id' => $id
                                                    )
                                                ));

            if(($scheduleInfo['Schedule']['status'] == "Pending") || ($scheduleInfo['Schedule']['status'] == "Accepted")){
                $this->redirect( array(
                                       'controller' => 'deliveries', 
                                       'action' => 'message', $id
                                  ));
            }

        }
        else{
            $action = "delivery_detail";
            $this->loadModel('Delivery.Delivery');
            $salesId = $this->Delivery->find('list', array(
                                                'fields' => array(
                                                    'sales_order_id'
                                                  )
                                            ));


            $this->loadModel('Delivery.Schedule');
            $scheduleInfo = $this->Schedule->find('list', array(
                                                      'fields' => array(
                                                          'sales_order_id','sales_order_id'),
                                                      'conditions' => array(
                                                          'sales_order_id NOT' => $salesId,
                                                          'status' => 'Approved'
                                                        )
                                                    ));

        }

  
        $this->set(compact('scheduleInfo','action'));
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

        $this->loadModel('Sales.ClientOrder');

        $this->ClientOrder->bind(array('ClientOrderDeliverySchedule','Company', 'QuotationDetail','Product', 'QuotationItemDetail' ));

        $scheduleInfo = $this->ClientOrder->find('first');

        $this->set(compact( 'scheduleInfo' ));
        
}

  public function edit($id = null) {

          $this->loadModel('Sales.ClientOrder');

          $this->ClientOrder->bind(array('ClientOrderDeliverySchedule','Company', 'QuotationDetail','Product', 'QuotationItemDetail' ));

          $scheduleInfo = $this->ClientOrder->find('first');

          $this->set(compact( 'scheduleInfo' ));
          
  }

}