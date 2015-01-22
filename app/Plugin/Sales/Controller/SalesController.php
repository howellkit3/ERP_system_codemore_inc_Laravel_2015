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
class SalesController extends SalesAppController {

/**
 * Scaffold
 *
 * @var mixed
 */
	//public $scaffold;
		
	public $useDbConfig = 'koufu_sale';
	public $uses = array('Sales.Company,Sales.Customer');

	// public $paginate = array(
 //        'limit' => 25,
 //        'conditions' => array('status' => '1'),
 //        'order' => array('Sale.company_name' => 'asc' )
 //    );

	public function beforeFilter() {

        parent::beforeFilter();


        $userData = $this->Session->read('Auth');

        $this->Auth->allow('add','index');

        //$this->Company->bind(array('Customer'));
        //$Company = $this->Company->find('list');

        $this->set(compact('userData'));
    }
	    
		    
	public function index() {

		$userData = $this->Session->read('Auth');

		//$this->Company->Customer->setDataSource('koufu_sale');

		$this->loadModel('Sales.Company');

		$this->loadModel('Sales.Customer');

		$this->Company->bind(array('Customer'));

		$this->Company->recursive = 0;

		$company = $this->Company->find('all');
		
		$this->set(compact('company'));
		
	}

}
