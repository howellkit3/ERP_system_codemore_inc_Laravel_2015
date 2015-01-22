<?php
App::uses('SalesAppController', 'Customers.Controller');
App::uses('AppController', 'Controller');
App::import('Controller', 'App');
App::import('model','Sales.Company');
App::import('model','Sales.Customer');
/**
 * Sales Controller
 *
 */
class CustomersController extends SalesAppController {

	var $uses = array('Sales.Company,Sales.Customer');
	

	public $useDbConfig = 'koufu_sale';
	//public $uses = array('Sales.Company,Sales.Customer');
	// public $paginate = array(
 //        'limit' => 25,
 //        'conditions' => array('status' => '1'),
 //        'order' => array('Sale.company_name' => 'asc' )
 //    );

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add','index','customers');
        //$this->Customer->bind(array('Company'));
    }
	        
	public function index() {
		// $this->Company->setDataSource('koufu_sale');
		// $this->loadModel('Sales.Company');
		if ($this->request->is('post')) {

			pr($this->request->data);exit();
		}
		
	}

	public function add(){
		//echo "bakit";exit();
		//$this->Company->setDataSource('koufu_sale');
		//$this->Customer->setDataSource('koufu_sale');
		//$this->loadModel('Sales.Company');
		//$this->loadModel('Sales.Customer');
		//$this->Company->bind('Customer');
		//pr($this->request->data);exit();
		if ($this->request->is('post')) {

			pr($this->request->data);exit();

            if (!empty($this->request->data)) {
            	 
            	//$this->Company->create();
            	$oo = $this->Company->save($this->request->data);
            	if ($this->Company->save($this->request->data)) {

            		pr($oo);
            		echo "yes";exit();
            		
		            $this->request->data['Customer']['company_id'] = $this->Company->id;
		            $this->Customer->create();
		            $this->Company->Customer->saveAll($this->request->data['Customer']);
		            	 $this->Session->setFlash(__('Customer Info is successfully added in the system.'));
		            	$this->redirect(
		                    array('controller' => 'customers', 'action' => 'add','plugin' => 'sales')
		                );
		           
	            }else{

	            	echo "mmmm";exit();
	            }
            	
            	
            }
        }
		
	}

}
