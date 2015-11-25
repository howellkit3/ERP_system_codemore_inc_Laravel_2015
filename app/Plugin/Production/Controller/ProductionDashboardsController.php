<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class ProductionDashboardsController extends ProductionAppController {
	
	public function index() {

     //   $this->layout = 'test';

		$this->loadModel('Production.TicketProcessSchedule');

		// $this->loadModel('Production.RecievedTicket');

		$this->loadModel('Production.ProcessDepartment');

        $this->loadModel('Production.Machine');

		// $this->loadModel('Ticket.JobTicket');

		$this->loadModel('Sales.ClientOrder');

		$limit = 10;
		
		$conditions = array();

		//$this->TicketProcessSchedule->bind(array('JobTicket','RecievedTicket'));

        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            //'fields' => array('id', 'status','created'),
            //'recursive' => -1,
            'order' => 'RecievedTicket.created ASC',
            'contain' => array(
                'RecievedTicket',
                'JobTicket',
                'ProductSpecificationProcessHolder',
                'ProductSpecificationProcess'
                //'ProductSpecificationProcessHolder',
               //'ClientOrder'
            )
        );

        $tickets = $this->paginate('TicketProcessSchedule');

        //get ClientOrder
        $tickets = $this->ClientOrder->getClientOrder( $tickets );
       	    
       	$departmentProcess = $this->ProcessDepartment->find('list', array('fields' => array('id', 'name')));

       	$machineData = $this->Machine->find('list',array('fields' => array('id','name')));

      
        if (!empty($_GET['test'])) {
        	pr($tickets);
        	//exit();
        }
        
        $this->set(compact('tickets','departmentProcess','machineData'));

		// $this->set(compact('scheduleData'));
    }

    
}