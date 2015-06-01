<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class TicketingSystemsController extends TicketAppController {

	public $uses = array('Ticket.Ticket');

	public $helpers = array('Sales.Country','Sales.Status','Cache','Sales.DateFormat');

	public function beforeFilter() {

        parent::beforeFilter();

        $userData = $this->Session->read('Auth');

        $this->Auth->allow('index');

        $this->set(compact('userData'));

    }
	    	    
	public function index() {

		$userData = $this->Session->read('Auth');

		$ticketData = $this->Ticket->find('all',array('order' => array('Ticket.id DESC')));

		$this->set(compact('ticketData'));
	
	}

	public function view($ticketid = null) {
		$ticketData = $this->Ticket->find('first', array('conditions' => array('Ticket.id' =>$ticketid
			)
			));
		
		$this->set(compact('ticketid','ticketData'));
	}

	public function updatePendingStatus($ticketId = null) {

		$this->Ticket->updateStatus($ticketId);

    	$this->redirect(

         array('controller' => 'ticketing_systems', 
            	'action' => 'view',
            	 $ticketId

          ));	
	}

	public function finishedJob($ticketId = null){

		 $this->Ticket->finishedJob($ticketId);

		 $this->redirect(

         array('controller' => 'ticketing_systems', 
             	'action' => 'view',
             	 $ticketId

          ));

	}

	public function create_ticket($productUuid = null){
		pr($productUuid);exit();
	}

}
