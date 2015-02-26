<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class RequestDeliverySchedulesController extends SalesAppController {

	public function add($id = null) {

		$userData = $this->Session->read('Auth');

		if($this->request->is('post')){
            //pr($this->request->data);exit();
            if(!empty($this->request->data)){

                $this->RequestDeliverySchedule->addRequest($this->request->data, $userData['User']['id']);

                $this->loadModel('Delivery.Schedule');
                $this->Schedule->addSchedule($this->request->data, $userData['User']['id']);

                $this->loadModel('Ticket.JobTicketSummary');
                $this->JobTicketSummary->updateSchedule($this->request->data, $userData['User']['id']);

                $this->redirect( array(
		                             'controller' => 'RequestDeliverySchedules', 
		                             'action' => 'message',
		      
		        				));
            }
        }

        $this->loadModel('Sales.Quotation');
        $quotationId = $this->Quotation->find('first', array(
                                			'conditions'=> array(
                                			'id'=> $id
                                					)
                            					));

        $this->loadModel('Delivery.Schedule');
        $salesOrderIdHolder = $this->Schedule->find('first', array(
                                                    'conditions' => array(
                                                    'sales_order_id' => $quotationId['Quotation']['unique_id']
                                                        )
                                                    ));

        

        if(empty($salesOrderIdHolder)){
            $salesOrderId = Null;
        }
        else{
        
            $salesOrderId = $salesOrderIdHolder;
        }

		if( $salesOrderId['Schedule']['status'] == "Pending"){
			$this->redirect( array(
		                             'controller' => 'RequestDeliverySchedules', 
		                             'action' => 'message',
		                         ));

		}

		else if($salesOrderId['Schedule']['status'] == "Accepted"){
			$this->redirect( array(
		                             'controller' => 'RequestDeliverySchedules', 
		                             'action' => 'accept',$salesOrderId['Schedule']['sales_order_id']
		                         ));
		}

         $this->set(compact('quotationId'));
	}

	public function message(){

	}
	public function accept($id = null){

        $requestScheduleInfo = $this->RequestDeliverySchedule->find('first', array(
                                             				 		'conditions' => array(
                                             				 		'sales_order_id' => $id
                                              				  )
                                           				 ));

        $this->loadModel('Delivery.Schedule');
        // $this->loadModel('Delivery.TruckSchedule');
        $this->Schedule->bind(array('TruckSchedule'));
        $scheduleInfo = $this->Schedule->find('first',array(
        							  'conditions' => array(
        							  'Schedule.sales_order_id' => $id
        							  	)
        							));
        // pr($bind['TruckSchedule']['time_from']);exit();
        // $scheduleInfo = $this->TruckSchedule->find('first', array(
        //                      				  'conditions' => array(
        //                      				  'sales_order_id' => $id
        //                           				  )
        //                        				 ));
      

        $this->set(compact('requestScheduleInfo','scheduleInfo'));

	}
	
}