<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


class SettingsController  extends HumanResourceAppController {


	var $helpers = array('HumanResource.CustomText','HumanResource.Country');

	public function department() {

		$this->loadModel('HumanResource.Department');

		$limit = 10;

        $conditions = array();

        $this->paginate = array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Department.name ASC',
	        );

	    $departmentData = $this->paginate('Department');

		$this->set(compact('departmentData'));

	}

	public function position() {

		$this->loadModel('HumanResource.Position');

		$limit = 10;

        $conditions = array();

        $this->paginate = array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Position.id DESC',
	        );

	    $positionData = $this->paginate('Position');

		$this->set(compact('positionData'));

	}

	public function status() {

		$this->loadModel('HumanResource.Status');

		$limit = 10;

        $conditions = array();

        $this->paginate = array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Status.id DESC',
	        );

	    $statusData = $this->paginate('Status');

		$this->set(compact('statusData'));

	}

	public function agency() {

		$this->loadModel('HumanResource.Agency');

		$limit = 10;

        $conditions = array();

        $this->paginate = array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Agency.id DESC',
	        );

	    $agencyData = $this->paginate('Agency');

		$this->set(compact('agencyData'));

	}

	public function tool() {

		$this->loadModel('HumanResource.Tool');

		$limit = 10;

        $conditions = array();

        $this->paginate = array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Tool.id DESC',
	        );

	    $toolData = $this->paginate('Tool');

		$this->set(compact('toolData'));

	}

	public function category() {

		$this->loadModel('HumanResource.Category');

		$limit = 10;

        $conditions = array();

        $this->paginate = array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Category.id DESC',
	        );

	    $categoryData = $this->paginate('Category');

		$this->set(compact('categoryData'));

	}

	public function type() {

		$this->loadModel('HumanResource.Type');

		$this->loadModel('HumanResource.Category');

		$categoryList = $this->Category->find('list',array('fields' => array('id','name')));

		$limit = 10;

        $conditions = array();

        $this->paginate = array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Type.id DESC',
	        );

	    $typeData = $this->paginate('Type');

		$this->set(compact('typeData','categoryList'));

	}

	public function leave_types() {

		$this->loadModel('HumanResource.LeaveType');

		$limit = 10;

        $conditions = array();

        $this->paginate = array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'LeaveType.id DESC',
	        );

	    $leavetypeData = $this->paginate('LeaveType');
	    
		$this->set(compact('leavetypeData'));

	}
	
}