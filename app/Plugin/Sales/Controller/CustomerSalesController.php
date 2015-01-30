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

	public function person($personId = null){

		$this->Company->bind(array('Address','Contact','Email','ContactPerson'));

		$this->Company->recursive = 1;

		$contactPerson = $this->Company->ContactPerson->find('first', array(
	        'conditions' => array('ContactPerson.id' => $personId)
	    ));

	    $contactAddress = $this->Company->Address->find('all', array(
	        'conditions' => array('Address.foreign_key' => $personId,'Address.model' =>'ContactPerson')
	    ));

	    $contactNumber = $this->Company->Contact->find('all', array(
	        'conditions' => array('Contact.foreign_key' => $personId,'Contact.model' =>'ContactPerson')
	    ));

	     $contactEmail = $this->Company->Email->find('all', array(
	        'conditions' => array('Email.foreign_key' => $personId,'Email.model' =>'ContactPerson')
	    ));

		
		$this->set(compact('contactPerson','contactAddress','contactNumber','contactEmail'));
		

	}

	public function edit($companyId = null){

		$this->Company->bind(array(
			'Address',
			'Contact',
			'Email',
			'ContactPerson'
		));

		$company = $this->Company->find('first', array(
	        'conditions' => array('Company.id' => $companyId)
	    ));

		$this->Company->ContactPerson->bind(array('Address', 'Email', 'Contact'));

	    $contactPerson = $this->Company->ContactPerson->find('all', array(
	        'conditions' => array('ContactPerson.company_id' => $companyId)
	    ));

		if (!$this->request->data) {

			$holder = array();

			foreach($contactPerson as $key => $contact)
			{
				$holder['ContactPersonData'][$key] = $contact;
			}

	        $this->request->data = am($company, $holder);
	    }
		
	}

	public function delete($dataId = null, $personId = null){

		$this->Company->bind(array('ContactPerson','Contact','Email'));
		//$this->Company->ContactPerson->bind(array('Address', 'Email', 'Contact'));
		
		if ($this->Company->deleteAll($dataId)) {

			// if($this->Company->ContactPerson->delete($personId)){

			// 	$this->Session->setFlash(__('Customer Information Deleted.'));
			// 	$this->redirect(
			// 		array('controller' => 'customer_sales', 'action' => 'index')
			// 	);

			// }else{
			// 		echo "Company error";

			// 	$this->redirect(
			// 		array('controller' => 'customer_sales', 'action' => 'index')
			// 	);
			// 	$this->Session->setFlash(__('Error Deleting Information.'));
			// }

			$this->redirect(
					array('controller' => 'customer_sales', 'action' => 'index')
				);

		} else {
			echo "ContactPerson error";
			$this->Session->setFlash(__('Error Deleting Information.'));
			$this->redirect(
					array('controller' => 'customer_sales', 'action' => 'index')
				);
			
		}

	
	}

}
