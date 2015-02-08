<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class SalesOrdersController extends SalesAppController {

	public $uses = array('Sales.Quotation');

	public function beforeFilter() {

        parent::beforeFilter();

        $userData = $this->Session->read('Auth');

        $this->Auth->allow('index');

        $this->set(compact('userData'));

    }
	    	    
	public function index() {

		$userData = $this->Session->read('Auth');

		$this->Quotation->bind(array('SalesOrder'));
		$this->Quotation->SalesOrder->bind(array('Quotation'));
		
		$salesOder = $this->Quotation->SalesOrder->find('all');

		$quoteName = $this->Quotation->find('list',array('id','name'));

		$this->set(compact('salesOder','quoteName'));
	}

}