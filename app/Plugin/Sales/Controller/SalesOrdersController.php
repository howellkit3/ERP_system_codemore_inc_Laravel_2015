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

		$this->loadModel('Sales.Company');

		$this->Company->bind(array('Inquiry'));

		$companyData = $this->Company->find('list',array(
     		'fields' => array('id','company_name')));

		$inquiryId = $this->Company->Inquiry->find('list',array(
     		'fields' => array('company_id')));

		$quoteName = $this->Quotation->find('list',array('id','name'));
		
		$this->set(compact('salesOder','quoteName','companyData','inquiryId'));
	}

}