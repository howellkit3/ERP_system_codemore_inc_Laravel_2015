<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


class CauseMemosController  extends HumanResourceAppController {

	public function index() {

		$this->loadModel('HumanResource.Violation');

		$this->loadModel('HumanResource.DisciplinaryAction');

		$this->loadModel('HumanResource.CauseMemo');

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.Violation');

		$this->loadModel('User');

		$violationData = $this->Violation->find('all');

		$disciplinaryActionData = $this->DisciplinaryAction->find('all');

		$causeMemoData = $this->CauseMemo->find('all');

		$UserCreated = $this->User->find('list', array('fields' => array('id', 'fullname')
															));

		$employeeName = $this->Employee->find('list', array('fields' => array('id', 'fullname')
															));

		$violationTableData= $this->Violation->find('list', array('fields' => array('id', 'name')
															));

	
		$this->set(compact('violationData', 'UserCreated', 'disciplinaryActionData', 'causeMemoData', 'employeeName', 'violationTableData'));

	}

	public function add() {

		$userData = $this->Session->read('Auth');

		$this->loadModel('HumanResource.CauseMemo');

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.Violation');

		$this->loadModel('HumanResource.DisciplinaryAction');
		
		$employeeData = $this->Employee->find('list', array('fields' => array('id', 'full_name'),
															'order' => array('Employee.last_name' => 'ASC')
															));

		$violationData = $this->Violation->find('list', array('fields' => array('id', 'name'),
															'order' => array('Violation.id' => 'ASC')
															));

		$notedByEmployee = $this->Employee->find('list', array('fields' => array('id', 'fullname'),
															  'conditions' => array('Employee.department_id' => '6'),
                                                                'order' => 'Employee.last_name ASC'));

		$disciplinaryData = $this->DisciplinaryAction->find('list', array('fields' => array('id', 'name'),
                                                                'order' => 'DisciplinaryAction.id ASC'));

		if ($this->request->is(array('post', 'put'))) {

			$this->CauseMemo->saveCauseMemo($this->request->data,$userData['User']['id']);

			$this->Session->setFlash(__('Cause Memo has been saved'), 'success');
          
            $this->redirect( array(
                'controller' => 'cause_memos',   
                'action' => 'index'
            ));  

		}
	
		$this->set(compact('employeeData', 'violationData', 'notedByEmployee', 'disciplinaryData'));
		

	}

	public function edit($id = null) {

	}


	public function delete($id = null) {

	}

	public function add_violation($id = null) {

		$userData = $this->Session->read('Auth');

		$this->loadModel('HumanResource.DisciplinaryAction');

		$this->loadModel('HumanResource.Violation');

		$disciplinaryData = $this->DisciplinaryAction->find('list', array('fields' => array('id', 'name'),
                                                                'order' => 'DisciplinaryAction.id ASC'));

		if ($this->request->is(array('post', 'put'))) {

			$this->Violation->saveViolation($this->request->data,$userData['User']['id']);

			$this->Session->setFlash(__('Violation has been saved'), 'success');
          
            $this->redirect( array(
                'controller' => 'cause_memos',   
                'action' => 'index'
            ));  

		}

		$this->set(compact('disciplinaryData'));

	}

	public function add_disciplinary_action($id = null) {

		$userData = $this->Session->read('Auth');

		$this->loadModel('HumanResource.DisciplinaryAction');

		$this->loadModel('HumanResource.Violation');

		$disciplinaryData = $this->DisciplinaryAction->find('list', array('fields' => array('id', 'name'),
                                                                'order' => 'DisciplinaryAction.id ASC'));

		$violationData = $this->Violation->find('list', array('fields' => array('id', 'name'),
															'order' => array('Violation.id' => 'ASC')
															));

		if ($this->request->is(array('post', 'put'))) {

			$this->DisciplinaryAction->saveDisciplinaryAction($this->request->data,$userData['User']['id']);

			$this->Session->setFlash(__('Disciplinary Action has been saved'), 'success');
          
            $this->redirect( array(
                'controller' => 'cause_memos',   
                'action' => 'index'
            ));  

		}

		$this->set(compact('disciplinaryData', 'violationData'));


	}




}