<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'App');
App::import('model','Sales.Company');
App::import('model','Sales.Customer');
/**
 * Sales Controller
 *
 */
class CustomersController extends SalesAppController {

	public $useDbConfig = 'koufu_sale';
	
	public $uses = array('Sales.Company,Sales.Customer');
	

	public function beforeFilter() {

        parent::beforeFilter();

        $this->Auth->allow('add','index','customers');
       
    }
	        
	public function index() {
		
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
		                    array('controller' => 'customers', 'action' => 'add')
		                );
		           
	            }else{

	            	echo "mmmm";exit();
	            }
            	
            	
            }
        }
		
	}

}
