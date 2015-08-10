<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


class ContractsController  extends HumanResourceAppController {

	//var $helpers = array('HumanResource.CustomText','HumanResource.Country');
	public $uses = array('HumanResource.Employee');

	public function index() {
		
		$this->loadModel('HumanResource.Contract');
		$this->Employee->bind(array('Position','Department','Status'));
		$employeeData = $this->Employee->find('all',array('order' => array('Employee.id' => 'ASC' )));
		
		$contract = $this->Contract->find('list',array('fields' => array('id','name')));
		
		$this->set(compact('employeeData','contract'));

	}

	public function view($id = null ) {

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.EmployeeAdditionalInformation');

		$this->loadModel('HumanResource.Address');

		$this->Employee->bind(array('Position','Department','EmployeeAdditionalInformation','Address','Status'));

		$auth = $this->Session->read('Auth.User');
		
		if (!empty($id)) {

			$employeeData = $this->Employee->findById($id);

		}
		//pr($employeeData);exit();
		$this->set(compact('employeeData'));
		
		//probational
		if ($employeeData['Employee']['contract_id'] == 1) {
			$this->render('prob_contract');
		}

	}

}