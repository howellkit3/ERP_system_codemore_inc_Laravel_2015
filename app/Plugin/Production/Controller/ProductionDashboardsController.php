<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class ProductionDashboardsController extends ProductionAppController {
	
	public function index() {

		$this->loadModel('Production.TicketProcessSchedule');

		$this->loadModel('Ticket.JobTicket');

		$limit = 10;
		
		$conditions = array();

		$this->TicketProcessSchedule->bind(array('JobTicket'));

	
        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            //'fields' => array('id', 'status','created'),
            //'recursive' => -1,
            'order' => 'TicketProcessSchedule.id DESC',
        );

        $tickets = $this->paginate('TicketProcessSchedule');

        $this->set(compact('tickets'));

		// $this->set(compact('scheduleData'));
    }

    
}