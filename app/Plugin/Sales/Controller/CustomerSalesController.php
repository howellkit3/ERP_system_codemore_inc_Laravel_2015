<?php
App::uses('AppController', 'Controller');

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



	public function add(){

		$this->loadModel('Sales.Company');

		$this->loadModel('Sales.Customer');

		if ($this->request->is('post')) {

            if (!empty($this->request->data)) {
            	 
            	$this->Company->create();
            	
            	if ($this->Company->save($this->request->data)) {

		            $this->request->data['Customer']['company_id'] = $this->Company->id;
		            $this->Customer->create();
		            $this->Customer->save($this->request->data);
		            	$this->Session->setFlash(__('Customer Info is successfully added in the system.'));
		            	$this->redirect(
		                    array('controller' => 'customer_sales', 'action' => 'add')
		                );
		           
	            }else{

	            	echo "mmmm";exit();
	            }
            	
            	
            }
        }

	}

	public function edit(){

	}

	public function custom_field(){
		

	}

	public function view(){
		
	}

}
