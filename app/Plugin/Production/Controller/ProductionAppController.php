<?php

App::uses('AppController', 'Controller');

class ProductionAppController extends AppController {


	public function beforeFilter() {

		$this->loadModel('Production.ProcessDepartment');
		
		$conditions = array();
		
		$processesDpt = $this->ProcessDepartment->find('all',array(
			'conditions' => $conditions,
			'order' => array('ProcessDepartment.name ASC')

		));

		$userData = $this->Session->read('Auth');

		
		$this->set(compact('processesDpt','userData'));

		}

}
