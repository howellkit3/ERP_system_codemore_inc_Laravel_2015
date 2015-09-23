<?php


class WareHouseSystemsController extends WareHouseAppController {

	public $useDbConfig = array('koufu_warehouse');
	public $uses = array('WareHouse.CustomField');

	public function dashboard() {

	}
	
	public function beforeFilter() {

        parent::beforeFilter();

        $userData = $this->Session->read('Auth');

        $this->Auth->allow('index');

        $this->set(compact('userData'));

    }

	public function index(){

	
	}
	
	public function settings() {

	}

	public function departments() {

	}
}
