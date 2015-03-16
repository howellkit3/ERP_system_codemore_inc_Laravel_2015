<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class TicketDeliveriesController extends TicketAppController {

	public function delivery_info($id = null) {


		$this->loadModel('Sales.Quotation');
		$this->Quotation->bind(array('QuotationField'));
		$ticketDetails = $this->Quotation->find('first', array(
														'conditions' => array(
															'unique_id' => $id
															)
														));
		$this->loadModel('Delivery.Schedule');
		$scheduleInfo = $this->Schedule->find('first', array(
		                              'condtions' => array(
		                                'sales_order_id' => $id
		                              )
		                          ));

	    $this->loadModel('Delivery.Delivery');
	    $detailValue = $this->Delivery->find('all', array(
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
	    $count = $this->Delivery->find('count', array(
                                          'conditions' => array(
                                            'sales_order_id' => $id)
                                        ));

        if($count == 0){
          $this->redirect( array(
                                 'controller' => 'ticketDeliveries', 
                                 'action' => 'message', 
                                 $id
                            ));

        }


	    $this->loadModel('Delivery.DeliveryDetail');
	    $deliveryDetail = $this->DeliveryDetail->find('list', array('fields' => array('id', 'description')));
	    
	    $this->set(compact('scheduleInfo','ticketDetails','deliveryDetail','detailValue', 'status'));
    }
    public function message($id = null){

    	$this->loadModel('Sales.Quotation');
		$this->Quotation->bind(array('QuotationField'));
		$ticketDetails = $this->Quotation->find('first', array(
														'conditions' => array(
															'unique_id' => $id
															)
														));
		$this->set(compact('ticketDetails'));

    }
}