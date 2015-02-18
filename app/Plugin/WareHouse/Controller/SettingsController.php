<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class SettingsController extends WareHouseAppController {

	
	public $useDbConfig = array('koufu_ware_house');
	public $uses = array('WareHouse.CustomField');

	public function beforeFilter() {

        parent::beforeFilter();

        $userData = $this->Session->read('Auth');

        $this->Auth->allow('add','index');

        $this->set(compact('userData'));

    }
	    	    
	public function index() {

		$customField = $this->CustomField->find('all',array('order' => array('CustomField.id DESC')));
	
		$this->set(compact('customField'));

	}

}