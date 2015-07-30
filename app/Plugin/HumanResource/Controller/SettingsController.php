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
	            'order' => 'Department.id DESC',
	        );

	    $departmentData = $this->paginate('Department');

		$this->set(compact('departmentData'));

	}

	public function position() {

		$this->loadModel('HumanResource.Position');

		$positionData = $this->Position->find('all',array('order' =>array('Position.id DESC')));

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
	
}