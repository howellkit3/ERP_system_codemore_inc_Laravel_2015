<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class TicketingSystemsController extends TicketAppController {

	public $uses = array('Ticket.JobTicket');

	public $helpers = array('Sales.Country','Sales.Status','Cache','Sales.DateFormat');

	public function beforeFilter() {

        parent::beforeFilter();

        $userData = $this->Session->read('Auth');

        $this->Auth->allow('index');

        $this->set(compact('userData'));

    }
	    	    
	public function index() {

		$userData = $this->Session->read('Auth');

		$this->loadModel('Sales.Product');

		$ticketData = $this->JobTicket->find('all',array('order' => array('JobTicket.id DESC')));

		$productName = $this->Product->find('list',array('fields' => array('uuid','name')));

		$this->set(compact('ticketData','productName'));
	
	}

	public function view($ticketid = null) {

		$ticketData = $this->JobTicket->find('first', array('conditions' => array('JobTicket.id' =>$ticketid
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
		
		$userData = $this->Session->read('Auth');

		$this->loadModel('Sales.Product');

		//$productData = $this->Product->find('first',array('conditions' => array('Product.uuid' => $productUuid)));
		//pr($productData);exit();
		$this->JobTicket->saveTicket($productUuid,$userData['User']['id']);

		
		$this->Session->setFlash(
            __('Create Job Ticket successfully completed', 'success')
        );
        
		return $this->redirect(array('controller' => 'ticketing_systems', 'action' => 'index'));
	}

}
