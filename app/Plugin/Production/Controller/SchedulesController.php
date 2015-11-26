<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class SchedulesController extends ProductionAppController {
	public function index() {
		$scheduleData = $this->Schedule->find('all');
		$this->set(compact('scheduleData'));
    }

    public function add() {
    	
    	$userData = $this->Session->read('Auth');
    	$this->loadModel('Sales.Company');
    	$this->Company->bind(array('Quotation'));
    	$companyData = $this->Company->find('list', array('fields' => array('id','company_name')));
    	

    	if($this->request->is('post')){
    		$this->loadModel('Production.Schedule');
    		$this->Schedule->addSchedule($this->request->data, $userData['User']['id']);
			$this->redirect(
         				array(
         					'controller' => 'schedules', 
            				'action' => 'index'
            			));
    
    	}

    	$this->set(compact('companyData'));
    	
    }

    public function find_data($id = null) {

		$this->loadModel('Sales.Company');
		
		$this->layout = false;
		
		$this->Company->bind(array('Quotation','Inquiry'));
		
		$inquiryData = $this->Company->Inquiry->find('first', array(
													 'condition' => array(
													 'Inquiry.company_id' => $id
															)
													));
		
		$uniqueId = $this->Company->Quotation->find('first', array(
													'conditions'=> array(
																		'Quotation.company_id' => $id
																		)
				
													));

		echo json_encode($uniqueId);
		
		$this->autoRender = false;
	}
	 
}