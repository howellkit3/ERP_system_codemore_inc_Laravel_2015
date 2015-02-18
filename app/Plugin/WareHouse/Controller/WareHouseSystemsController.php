<?php


class WareHouseSystemsController extends WareHouseAppController {

	public $useDbConfig = array('koufu_ware_house');
	public $uses = array('WareHouse.CustomField');

	public function beforeFilter() {

        parent::beforeFilter();

        $userData = $this->Session->read('Auth');

        $this->Auth->allow('index');

        $this->set(compact('userData'));

    }

	public function index(){

		

	}

}
