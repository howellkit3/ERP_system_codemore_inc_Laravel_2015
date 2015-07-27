<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


class WorkSchedulesController  extends HumanResourceAppController {

	var $helpers = array('HumanResource.CustomText','HumanResource.Country','HumanResource.BreakTime');

	public function add() {


		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.Workshift');

		$conditions = array();

		$employees = $this->Employee->getList($conditions);

		$conditions = array();
		$workshifts = $this->Workshift->getList($conditions);



		if ($this->request->is('post')) {

		}

		$this->set(compact('employees','workshifts'));
	}

}