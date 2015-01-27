<?php
App::uses('AppController', 'Controller');

App::import('model','Sales.Company');
App::import('model','Sales.ContactPerson');
App::import('model','Sales.Address');
App::import('model','Sales.Contact');
App::import('model','Sales.Type');
App::import('model','Sales.Email');
/**
 * Sales Controller
 *
 */
class CustomerSalesController extends SalesAppController {

	public $uses = array('Sales.Company');

	public function beforeFilter() {

        parent::beforeFilter();

        $userData = $this->Session->read('Auth');

        $this->Auth->allow('add','index');

        $this->set(compact('userData'));

    }
	    	    
	public function index() {

		$userData = $this->Session->read('Auth');

		$this->Company->bind(array('ContactPerson'));

		$this->Company->recursive = 1;

		$company = $this->Company->find('all',array(
    		'order' => array('Company.id DESC')));

		$this->set(compact('company'));
	
	}

	public function add(){

		$userData = $this->Session->read('Auth');

		if ($this->request->is('post')) {

			pr($this->data);

            if (!empty($this->request->data)) {
					
            	$this->request->data = $this->Company->formatData($this->request->data,$userData['User']['id']);

            	$this->request->data['Company']['created_by'] = $userData['User']['id'];
            	$this->request->data['Company']['modified_by'] = $userData['User']['id'];
            	//pr($this->request->data);exit();
            	$this->Company->create();
            	
            	$this->Company->bind(array('Address','Contact'));

            	if ($this->Company->saveAssociated($this->request->data)) {
            		echo "saveAll";exit();
                  
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
