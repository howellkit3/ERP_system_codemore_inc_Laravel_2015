<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class DeliveriesController extends DeliveryAppController {

    public function index() {
        $this->loadModel('Delivery.Schedule');
        $scheduleData = $this->Schedule->find('all');
        //pr($scheduleData);
        $this->set(compact('scheduleData'));
   }

   public function delivery_info(){

   		

   		
   }
   public function add($id = null){
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

        $count = $this->Delivery->find('count', array(
        									'conditions' => array(
        										'sales_order_id' => $id)
        								));

        if($count != 0){
        	$this->redirect( array(
                                 'controller' => 'deliveries', 
                                 'action' => 'delivery_info'
                            ));

        }
   		$this->loadModel('Delivery.Schedule');
        $scheduleInfo = $this->Schedule->find('first', array(
        											'condtions' => array(
        												'sales_order_id' => $id
        											)
        									));
        $this->set(compact('scheduleInfo'));
   }

   public function delivery_detail(){
   		$salesId = $this->Delivery->find('all', array(
   											'fields' => array(
   												' DISTINCT sales_order_id', 'status')
   										));
   		//pr($salesId);die;

   		$this->set(compact('salesId'));

   		
   }
     
}