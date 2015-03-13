<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class RequestDeliverySchedulesController extends SalesAppController {

	public function add($id = null, $location = null) {
        $path = $location;

		$userData = $this->Session->read('Auth');

		if($this->request->is('post')){

            

            if(!empty($this->request->data)){

                $requestData = $this->request->data;
                //pr($requestData);exit();
                
                $this->loadModel('Ticket.JobTicketDetail');
                $detailId = $this->JobTicketDetail->find('first', 
                                                                array(
                                                         'conditions' => 
                                                                array(
                                                         'unique_id' =>  $requestData['RequestDeliverySchedule']['sales_order_id']
                                                            )

                                                    ));

                $this->RequestDeliverySchedule->addRequest($requestData , $userData['User']['id']);

                $this->loadModel('Delivery.Schedule');
                $this->Schedule->addSchedule($requestData , $userData['User']['id']);

                $this->redirect( array(
		                             'controller' => 'RequestDeliverySchedules', 
		                             'action' => 'message'
                                     //'plugin' => 'sales'
		        				));
            }
        }

        $this->loadModel('Sales.Quotation');
        $quotationId = $this->Quotation->find('first', array(
                                			     'conditions'=>  array(
                                			         'id'=> $id)
                            					));

        $this->loadModel('Delivery.Schedule');
        $salesOrderIdHolder = $this->Schedule->find('first',   array(
                                                        'conditions' =>  array(
                                                            'sales_order_id' => $quotationId['Quotation']['unique_id'])
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
		else if(($salesOrderId['Schedule']['status'] == "Accepted") || ($salesOrderId['Schedule']['status'] == "Approved")){
			$this->redirect( array(
		                             'controller' => 'RequestDeliverySchedules', 
		                             'action' => 'accept',$salesOrderId['Schedule']['sales_order_id']
		                         ));
		}

        $this->loadModel('Sales.Company');
        $this->Company->bind(array('Address','Quotation'));
        $quotationCompany = $this->Company->Quotation->find('first', array(
                                                'conditions' => array(
                                                    'Quotation.id' => $id)
                                            ));
        $companyName = $this->Company->find('first', array(
                                                'conditions' => array(
                                                    'id' => $quotationCompany['Quotation']['company_id'])
                                            ));
        //pr($companyName);die;
        $this->loadModel('Sales.Quotation');
        $this->Quotation->bind(array('QuotationField'));
        $quantity = $this->Quotation->find('first', array(
                                                'conditions' => array(
                                                    'id' => $id
                                                        )
                                                    ));
        //pr($quantity);die;

         $this->set(compact('quotationId','path','companyName','quantity'));

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
        $this->Schedule->bind(array('TruckSchedule'));
        $scheduleInfo = $this->Schedule->find('first', array(
        							             'conditions' =>  array(
        							                 'Schedule.sales_order_id' => $id
        						                      )
        							         ));
      
        $this->set(compact('requestScheduleInfo','scheduleInfo'));

	}
	
}