<?php
App::uses('AppController', 'Controller');

App::import('model','Sales.Company');
App::import('model','Sales.ContactPerson');
App::import('model','Sales.Address');
App::import('model','Sales.Contact');
/**
 * Sales Controller
 *
 */
class CustomerSalesController extends SalesAppController {

	public $useDbConfig = 'koufu_sale';

	public $uses = array('Sales.Company,Sales.ContactPerson,Sales.Address,Sales.Contact');

	public function beforeFilter() {

        parent::beforeFilter();

        $userData = $this->Session->read('Auth');

        $this->Auth->allow('add','index');

        $this->set(compact('userData'));
    }
	    
		    
	public function index() {

		$userData = $this->Session->read('Auth');

		$this->loadModel('Sales.Company');

		$this->loadModel('Sales.ContactPerson');

		$this->Company->bind(array('Customer'));

		$this->Company->recursive = 0;

		$company = $this->Company->find('all',array(
    		'order' => array('Company.id DESC')));
		
		$this->set(compact('company'));

	}

	public function add(){

		$this->loadModel('Sales.Company');
		$this->loadModel('Sales.ContactPerson');
		$this->loadModel('Sales.Address');
		$this->loadModel('Sales.Contact');

		if ($this->request->is('post')) {
			
			//pr($this->request->data);exit();

            if (!empty($this->request->data)) {
            	 
            	$this->Company->create();
            	
            	if ($this->Company->save($this->request->data)) {

		            $this->request->data['ContactPerson']['company_id'] = $this->Company->id;

		            $this->ContactPerson->create();

		            if($this->ContactPerson->save($this->request->data)){

		            	$this->request->data['Address']['company_id'] = $this->Company->id;

		            	$this->Address->create();
		            	if($this->Address->save($this->request->data)){
		            		$this->request->data['Contact']['company_id'] = $this->Company->id;
		            		$this->Contact->create();

		            		$this->Contact->save($this->request->data);

			            	$this->Session->setFlash(__('Customer Info is successfully added in the system.'));
			            	$this->redirect(
			                    array('controller' => 'customer_sales', 'action' => 'add')
			                );
		            	}
		            	
		            }
		            
		            	
		           
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
