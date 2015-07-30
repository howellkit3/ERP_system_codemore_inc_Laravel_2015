<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


class CauseMemosController  extends HumanResourceAppController {

	public function index() {

	}

	public function add() {

		$this->loadModel('HumanResource.CauseMemo');

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.Violation');
		
		$employeeData = $this->Employee->find('list', array('fields' => array('id', 'full_name'),
															'order' => array('Employee.last_name' => 'ASC')
															));

		$violationData = $this->Violation->find('list', array('fields' => array('id', 'name'),
															'order' => array('Violation.id' => 'ASC')
															));

		$notedByEmployee = $this->Employee->find('list', array('fields' => array('id', 'fullname'),
															  'conditions' => array('Employee.department_id' => '6'),
                                                                'order' => 'Employee.last_name ASC'));
	
		$this->set(compact('employeeData', 'violationData', 'notedByEmployee'));
		

	}

	public function edit($id = null) {

	}


	public function delete($id = null) {

	}




}