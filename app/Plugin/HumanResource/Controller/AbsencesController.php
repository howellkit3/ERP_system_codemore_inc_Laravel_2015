<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


class AbsencesController  extends HumanResourceAppController {

	var $helpers = array('HumanResource.CustomText','HumanResource.CustomTime');

	public function add() {


		$this->loadModel('HumanResource.Employee');

		$date = date('Y-m-d');
		$search = '';

		$conditions = array();
		$employees = $this->Employee->getList($conditions);

		$this->set(compact('date','search','employees'));
	}

}