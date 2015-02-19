<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class ProductionSystemsController extends ProductionAppController {
	public function index() {
		//$userData = $this->Session->read('Auth');

		$scheduleData = $this->Schedule->find('all');

		$this->set(compact('scheduleData'));
    }


}