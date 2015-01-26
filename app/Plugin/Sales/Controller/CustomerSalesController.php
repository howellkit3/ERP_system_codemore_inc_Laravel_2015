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

	public $useDbConfig = 'koufu_sale';

	public $uses = array('Sales.Company,Sales.ContactPerson,Sales.Address,Sales.Contact,Sales.Email,Sales.Type');

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

		$this->loadModel('Sales.Address');

		$this->loadModel('Sales.Contact');

		$this->loadModel('Sales.Email');

		$this->loadModel('Sales.Type');

		$this->Company->bind(array('Address','Contact','Email','ContactPerson'));

		$this->Company->recursive = 0;

		// $conditions = array('Address.foreign_key' => $this->Session->read('Auth.Company.id'),
		// 				'Contact.foreign_key' => $this->Session->read('Auth.Company.id'),
		// 				'ContactPerson.company_id' =>$this->Session->read('Auth.Company.id'),
		// 				'Email.foreign_key' =>$this->Session->read('Auth.Company.id'),
		// 				);

		// $this->paginate = array(
		// 	'limit' => 8, 
		// 	'conditions' => $conditions,
		// 	'order' => array('Company.id DESC')		    
		// );


		// $company = $this->paginate();
	
		// $this->set(compact('company'));

		// pr($company);exit();
		$company = $this->Company->find('all',array(
    		'order' => array('Company.id DESC')));
		
		$this->set(compact('company'));
		//pr($company);exit();



	}

	public function add(){

		$userData = $this->Session->read('Auth');

		$this->loadModel('Sales.Company');
		$this->loadModel('Sales.ContactPerson');
		$this->loadModel('Sales.Address');
		$this->loadModel('Sales.Contact');
		$this->loadModel('Sales.Email');
		$this->loadModel('Sales.Type');

		if ($this->request->is('post')) {

			pr($this->request->data['Address']);
			exit();
			foreach($this->request->data['Address'] as $add) {
				pr($this->request->data['Address']);
				//loop for each person added
				
				// $add['id']=$address;
				// $this->Address->create();
				// $this->Address->save($add); bakit wala ung pangalawa,.,
			}
			exit();
            if (!empty($this->request->data)) {

            	$this->request->data['Company']['created_by'] = $userData['User']['id'];
            	$this->request->data['Company']['modified_by'] = $userData['User']['id'];
            	 
            	$this->Company->create();
            	
            	if ($this->Company->save($this->request->data)) {

            		$companyId = $this->Company->id;

            		$this->request->data['Address']['model'] = "Company";
		            $this->request->data['Address']['foreign_key'] = $companyId;
		            $this->request->data['Address']['type'] = $this->request->data['Address']['address_type'];
		            $this->request->data['Address']['created_by'] = $userData['User']['id'];
            		$this->request->data['Address']['modified_by'] = $userData['User']['id'];

		            $this->Address->create();

		            if($this->Address->save($this->request->data)){

		            	$this->request->data['Email']['model'] = "Company";
		            	$this->request->data['Email']['foreign_key'] = $companyId;
		            	$this->request->data['Email']['type'] = $this->request->data['Email']['email_type'];
		            	$this->request->data['Email']['created_by'] = $userData['User']['id'];
            			$this->request->data['Email']['modified_by'] = $userData['User']['id'];

		            	$this->Email->create();

		            	if($this->Email->save($this->request->data)){

		            		$this->request->data['Contact']['model'] = "Company";
			            	$this->request->data['Contact']['foreign_key'] = $companyId;
			            	$this->request->data['Contact']['type'] = $this->request->data['Contact']['number_type'];
			            	$this->request->data['Contact']['created_by'] = $userData['User']['id'];
	            			$this->request->data['Contact']['modified_by'] = $userData['User']['id'];

		            	
		            		$this->Contact->create();

		            		if($this->Contact->save($this->request->data)){

				            	$this->request->data['ContactPerson']['company_id'] = $companyId;
				            	$this->request->data['ContactPerson']['created_by'] = $userData['User']['id'];
		            			$this->request->data['ContactPerson']['modified_by'] = $userData['User']['id'];

		            			if($this->ContactPerson->save($this->request->data)){

		            				$contactId = $this->ContactPerson->id;

		            				$this->request->data['Address']['model'] = "Contact_person";
						            $this->request->data['Address']['foreign_key'] = $contactId	;
						            $this->request->data['Address']['type'] = $this->request->data['ContactPerson']['personAddress_type'];
						            $this->request->data['Address']['created_by'] = $userData['User']['id'];
				            		$this->request->data['Address']['modified_by'] = $userData['User']['id'];
				            		$this->request->data['Address']['address1'] = $this->request->data['ContactPerson']['address1'];
				            		$this->request->data['Address']['address2'] = $this->request->data['ContactPerson']['address2'];
				            		$this->request->data['Address']['city'] = $this->request->data['ContactPerson']['city'];
				            		$this->request->data['Address']['state_province'] = $this->request->data['ContactPerson']['state_province'];
				            		$this->request->data['Address']['zip_code'] = $this->request->data['ContactPerson']['zip_code'];
				            		$this->request->data['Address']['country'] = $this->request->data['ContactPerson']['country'];

				            		$this->Address->create();

				            		if($this->Address->save($this->request->data)){

				            			$this->request->data['Email']['model'] = "Contact_person";
						            	$this->request->data['Email']['foreign_key'] = $contactId;
						            	$this->request->data['Email']['type'] = $this->request->data['ContactPerson']['personEmail_type'];
						            	$this->request->data['Email']['created_by'] = $userData['User']['id'];
				            			$this->request->data['Email']['modified_by'] = $userData['User']['id'];
				            			$this->request->data['Email']['email'] = $this->request->data['ContactPerson']['email'];

				            			$this->Email->create();

				            			if($this->Email->save($this->request->data)){

					            			$this->request->data['Contact']['model'] = "Contact_person";
							            	$this->request->data['Contact']['foreign_key'] = $contactId;
							            	$this->request->data['Contact']['type'] = $this->request->data['ContactPerson']['personNumber_type'];
							            	$this->request->data['Contact']['created_by'] = $userData['User']['id'];
					            			$this->request->data['Contact']['modified_by'] = $userData['User']['id'];
					            			$this->request->data['Contact']['number'] = $this->request->data['ContactPerson']['number'];

					            			$this->Contact->create();
					            			$this->Contact->save($this->request->data);

					            			$this->Session->setFlash(__('Customer Info is successfully added in the system.'));
						            		$this->redirect(
							                    array('controller' => 'customer_sales', 'action' => 'add')
							                );

				            			}

				            		}

		            			}

		            		}
		            		
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
