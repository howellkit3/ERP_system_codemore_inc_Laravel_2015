<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class AccountingController extends AccountingAppController {

	public function index(){

		
		$this->loadModel('Delivery.Schedule');
        $scheduleData = $this->Schedule->find('all');

        $this->set(compact('scheduleData'));
	}
	public function add(){

		
		
	}
}