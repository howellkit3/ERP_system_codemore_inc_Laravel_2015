<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class JobTicketSummariesController extends TicketAppController {

	public function index($id = null){

		$summaryDetails = $this->JobTicketSummary->find('first', 
																array(
														'conditions' => 
																array(
														'unique_id' => $id
															)
														));


	}

}