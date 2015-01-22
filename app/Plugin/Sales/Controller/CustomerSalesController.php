<?php
App::uses('SalesAppController', 'Sales.Controller');
App::uses('AppController', 'Controller');
App::import('Controller', 'App');
App::import('model','Sales.Company');
App::import('model','Sales.Customer');
/**
 * Sales Controller
 *
 */
class CustomerSalesController extends SalesAppController {


	public $useDbConfig = 'koufu_sale';

	public $uses = array('Sales.Company,Sales.Customer');

	public function beforeFilter() {

        parent::beforeFilter();

        $userData = $this->Session->read('Auth');

        $this->Auth->allow('add','index');

        $this->set(compact('userData'));
    }
	    
		    
	public function index() {

		$userData = $this->Session->read('Auth');

		$this->loadModel('Sales.Company');

		$this->loadModel('Sales.Customer');

		$this->Company->bind(array('Customer'));

		$this->Company->recursive = 0;

		$company = $this->Company->find('all');
		
		$this->set(compact('company'));
		
	}

}
