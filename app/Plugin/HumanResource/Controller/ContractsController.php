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
		//pr($employeeData);exit();
		$this->set(compact('employeeData','contract'));

	}

}