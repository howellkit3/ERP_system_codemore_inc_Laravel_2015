<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class TicketingSystemsController extends TicketAppController {

	public $uses = array('Ticket.Ticket');

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

	
		
	
	}

}
