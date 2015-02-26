<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class JobTicketSummariesController extends TicketAppController {

	public function index($id = null){
		$this->JobTicketSummary->bind(array('JobTicketDescription','JobTicketDetail'));
		
		$companyDetails = $this->JobTicketSummary->JobTicketDetail->find('first', array(
											  'conditions' => array(
											  'JobTicketDetail.unique_id' => $id

											  	)
											));
		
		$description = $this->JobTicketSummary->find('all', array(
											  'conditions' => array(
											  'detail_id' => $companyDetails['JobTicketDetail']['id']

											  	)
											));
		$this->loadModel('Sales.Quotation');
		$quotationId = $this->Quotation->find('first',
													array(
											   'conditions' => 
											   		array(
											   	'unique_id' => $companyDetails['JobTicketDetail']['unique_id']
											   	)
											));
		
		$this->set(compact('companyDetails','description','quotationId'));


	}

}