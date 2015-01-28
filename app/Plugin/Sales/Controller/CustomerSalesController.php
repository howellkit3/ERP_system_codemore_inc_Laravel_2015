<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class CustomerSalesController extends SalesAppController {

	public $uses = array('Sales.Company');
	public $helper = array('Sales.Country');

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
            if (!empty($this->request->data)) {

            	$this->Company->bind(array('Address','Contact','Email','ContactPerson'));

            	$this->request->data = $this->Company->formatData($this->request->data, $userData['User']['id']);

            	$this->request->data['Company']['created_by'] = $userData['User']['id'];
            	$this->request->data['Company']['modified_by'] = $userData['User']['id'];

            	if ($this->Company->saveAssociated($this->request->data)) {

            		$contactPersonId = $this->Company->ContactPerson->id;
					
            		$this->Company->Contact->saveContact($this->request->data['ContactPersonData'], $contactPersonId);
            		$this->Company->Address->saveContact($this->request->data['ContactPersonData'], $contactPersonId);
            		$this->Company->Email->saveContact($this->request->data['ContactPersonData'], $contactPersonId);
				
            		$this->Session->setFlash(__('Customer Information Complete.'));
	            	$this->redirect(
	                    array('controller' => 'customer_sales', 'action' => 'index')
	                );
                  
	            }else{

	            	echo "mmmm";exit();
	            }
            	
            }
        }

	}

	public function view($companyId = null){

		$this->Company->bind(array('Address','Contact','Email','ContactPerson'));

		$this->Company->recursive = 1;

		$company = $this->Company->find('first', array(
	        'conditions' => array('Company.id' => $companyId)
	    ));
		
		$this->set(compact('company'));

	}

	public function edit($companyId = null){

	}

	public function person($personId = null){
		

	}

	

}
