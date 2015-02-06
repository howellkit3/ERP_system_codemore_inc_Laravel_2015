<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class PurchasingOrdersController extends SalesAppController {

	public $uses = array('Sales.Company');
	public $helper = array('Sales.Country');
	public $useDbConfig = array('koufu_system');

	public function beforeFilter() {

        parent::beforeFilter();

        $userData = $this->Session->read('Auth');

        $this->Auth->allow('add','index');

        $this->set(compact('userData'));

    }
	    	    
	public function index() {
	}
	
}