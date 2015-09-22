<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class CustomerSalesController extends SalesAppController {

	public $uses = array('Sales.Company');

	public $helper = array('Sales.Country');

	public function beforeFilter() {

        parent::beforeFilter();

        $this->Auth->allow('add','index');

        $this->loadModel('User');
        $userData = $this->User->read(null,$this->Session->read('Auth.User.id'));//$this->Session->read('Auth');

        $this->set(compact('userData'));

    }
	    	    
	public function index() {

		$this->loadModel('PaymentTermHolder');

		$paymentTermData = $this->PaymentTermHolder->find('list', array(
															'fields' => array('id', 'name'),
															'order' => array('PaymentTermHolder.name' => 'ASC')
															));

		$userData = $this->Session->read('Auth');

		$this->Company->bind(array(
			'ContactPerson' => array('fields' => array('firstname','middlename','lastname'))
			));

		$this->Company->recursive = 1;

		$limit = 10;

		$conditions = array();
	
		$this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'fields' => array(
            	'Company.id', 
            	'Company.uuid', 
            	'Company.company_name',
            	'Company.modified',
            	'Company.website',
            	'Company.tin',
            	'Company.created',
            	),
            'order' => 'Company.id DESC',
        );

		$company = $this->paginate('Company');

		//no permission sales/Receivable Staff/Accounting Head
	    if ($userData['User']['role_id'] == 6 || $userData['User']['role_id'] == 9 ) {

	        $noPermission = 'disabled not-active';

	    }else{
	    	$noPermission = ' ';
	    }

		$this->set(compact('company','paymentTermData','noPermission'));
		
	}

	public function add(){

		$this->loadModel('Sales.PaymentTermHolder');

		$userData = $this->Session->read('Auth');

		//set to cache in first load
		$paymentTermData = Cache::read('paymentTerms');
		
		if (!$paymentTermData) {
            $paymentTermData = $this->PaymentTermHolder->getList();
            Cache::write('paymentTerms', $paymentTermData);
        }

		if ($this->request->is('post')) {


            if (!empty($this->request->data)) {

            	$this->Company->bind(array('Address','Contact','Email','ContactPerson'));

            	$this->request->data = $this->Company->formatData($this->request->data, $userData['User']['id']);

            	$this->request->data['Company']['uuid'] = time();
            	
            	$this->request->data['Company']['created_by'] = $userData['User']['id'];
            	
            	$this->request->data['Company']['modified_by'] = $userData['User']['id'];

            	
            	if ($this->Company->saveAssociated($this->request->data)) {

            		if (!empty($this->request->data['ContactPersonData'])) {

            						
            				foreach ($this->request->data['ContactPersonData'] as $key => $contacts) {

            						//pr($contacts);

            						$contactPersonId = $this->Company->ContactPerson->saveContactMultiple($contacts, $this->Company->id);

	            					$this->Company->Contact->saveContactMultiple($contacts, $contactPersonId);

	            					$this->Company->Email->saveContactMultiple($contacts, $contactPersonId);	
            				}

						
            		}

					if($this->request->is('ajax')){
 							
 							echo $this->Company->getLastInsertID();
 							
 							exit();
					
					}
            		
            		$this->Session->setFlash(__('New Customer Information Added.'));

	            	$this->redirect(
	                    array('controller' => 'customer_sales', 'action' => 'index')
	                );
                  
	            } else {

	            	$this->Session->setFlash(
                        __('The invalid data. Please, try again.')
                    );
	           
	            }
            	
            }
        }

        $noPermission = ' ';

        $this->set(compact('paymentTermData', 'noPermission'));

	}

	public function update(){

		$userData = $this->Session->read('Auth');
	
		if ($this->request->is('post')) {
			//pr($this->request->data);die;
            if (!empty($this->request->data)) {

            	$this->Company->bind(array('Address','Contact','Email','ContactPerson'));
            	
            	$this->request->data = $this->Company->formatData($this->request->data, $userData['User']['id']);

            	$this->request->data['Company']['uuid'] = time();
            	$this->request->data['Company']['created_by'] = $userData['User']['id'];
            	$this->request->data['Company']['modified_by'] = $userData['User']['id'];



            	if ($this->Company->saveAssociated($this->request->data)) {

            		$lastId =  $this->Company->id;

			    if (!empty($this->request->data['ContactPersonData'])) {
										
					foreach ($this->request->data['ContactPersonData'] as $key => $contacts) {

						$contactPersonId = $this->Company->ContactPerson->saveContactMultiple($contacts, $lastId );

						$this->Company->Contact->saveContactMultiple($contacts, $contactPersonId);

						$this->Company->Email->saveContactMultiple($contacts, $contactPersonId);	
					}
				}		

					if($this->request->is('ajax')){
 							echo $this->Company->getLastInsertID();
 							exit();
					}
            		$this->Session->setFlash(__('Customer Information Succesfully updated.'));

	            	$this->redirect(
	                    array('controller' => 'customer_sales', 'action' => 'index')
	                );
                  
	            } else {

	            	$this->Session->setFlash(
                        __('The invalid data. Please, try again.')
                    );
	            }
            	
            }
        }

	}

	public function view($companyId = null){

		$this->loadModel('PaymentTermHolder');

		$this->loadModel('Sales.Product');

		$this->loadModel('ContactPerson');

		$this->loadModel('ItemCategoryHolder');

		$paymentTermData = $this->PaymentTermHolder->find('list', array(
															'fields' => array('id', 'name'),
															'order' => array('PaymentTermHolder.name' => 'ASC')
															));
		
		$this->Company->bind(array('Address','Contact','Email','ContactPerson','Product', 'PaymentTermHolder'));

		$this->Company->recursive = 1;

		$company = $this->Company->find('first', array(
	        'conditions' => array('Company.id' => $companyId)
	    ));

		$this->Company->ContactPerson->bind(array('Contact','Email'));

	    $contactPerson = $this->Company->ContactPerson->find('all', array(
	        'conditions' => array('ContactPerson.company_id' => $companyId)
	    ));
		 	
		$this->ItemCategoryHolder->bind(array('ItemTypeHolder'));

		$itemCategoryData = $this->ItemCategoryHolder->find('list', array(
															'fields' => array('id', 'name'),
															'order' => array('ItemCategoryHolder.name' => 'ASC')
															));
		$itemTypeData = $this->ItemCategoryHolder->ItemTypeHolder->find('list', array(
															'fields' => array('id', 'name'),
															'order' => array('ItemTypeHolder.name' => 'ASC')
															));
		$productData = $this->ItemCategoryHolder->ItemTypeHolder->find('list', array(
															'fields' => array('id', 'name'),
															'order' => array('ItemTypeHolder.name' => 'ASC')
															));


		$companyData = $this->Company->getList(array('id','company_name'),array('Company.id' => $company['Company']['id']));

		$noPermission = ' ';

		$this->set(compact('paymentTermData','company','contactPerson','itemCategoryData','itemTypeData', 'companyData', 'noPermission'));
		
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

		$this->loadModel('PaymentTermHolder');

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

	    $paymentTermData = $this->PaymentTermHolder->find('list', array(
													'fields' => array(
													'id','name'),
												  		)
												);
	 
		if (!$this->request->data) {

			$holder = array();

			foreach($contactPerson as $key => $contact)
			{
				$holder['ContactPersonData'][$key] = $contact;
			}

	        $this->request->data = am($company, $holder);
		}

		$noPermission = ' ';
 
		$this->set(compact('paymentTermData', 'noPermission'));
		
		
	}

	public function delete($dataId = null, $personId = null){

		$this->Company->bind(array('Contact','Email','Address','ContactPerson'));

		$personId = $this->Company->ContactPerson->find('first',
					array('conditions' => array('ContactPerson.company_id' => $dataId)));

		$contactId = $this->Company->Contact->find('first',
					array('conditions' => array('Contact.foreign_key' => $personId['ContactPerson']['id'])));

		$emailId = $this->Company->Email->find('first',
					array('conditions' => array('Email.foreign_key' => $personId['ContactPerson']['id'])));


		if ($this->Company->ContactPerson->delete($personId['ContactPerson']['id'])) {
			$this->Company->delete($dataId);
		
			$this->Company->Contact->deleteContact($personId['ContactPerson']['id']);
			$this->Company->Email->deleteEmail($personId['ContactPerson']['id']);
		
			$this->Session->setFlash(__('Successfully Deleted.'));
			$this->redirect(
				array('controller' => 'customer_sales', 'action' => 'index')
			);
		
		} else {
			
			$this->Session->setFlash(__('Error Deleting Information.'));
			$this->redirect(
					array('controller' => 'customer_sales', 'action' => 'index')
				);
			
		}

	}

	public function inquiry_form(){


		$this->loadModel('PaymentTermHolder');

		$userData = $this->Session->read('Auth');

		$paymentTermData = $this->PaymentTermHolder->find('list', array(
															'fields' => array('id', 'name'),
															'order' => array('PaymentTermHolder.name' => 'ASC')
															));

		$this->Company->bind(array('Contact','Email','Address','ContactPerson'));

		$companyData = $this->Company->find('list', array('fields' => array('id', 'company_name'),
															'order' => array('Company.company_name' => 'ASC')
															));

		$this->set(compact('paymentTermData','companyData')); 
		
		if ($this->request->is('post')) {

            if (!empty($this->request->data)) {

            	$this->Company->bind(array('Inquiry'));

            	$this->request->data = $this->Company->Inquiry->saveInquiry($this->request->data, $userData['User']['id']);

            	$this->Session->setFlash(__('Request Inquiry Success.'));
            	$this->redirect(
					array('controller' => 'customer_sales', 'action' => 'inquiry')
				);

            }
        }

        $noPermission = ' ';

        $this->set(compact('noPermission'));

	}

	public function inquiry(){

		$userData = $this->Session->read('Auth');

		$this->loadModel('Sales.Inquiry');

		$this->Inquiry->bind(array('Quotation'));

		$inquiryData = $this->Inquiry->find('all', array(
								    			'order' => array('Inquiry.id DESC'),
								    			'contain' => array(
								    				'Quotation' => array(
								    					'conditions' => array('Quotation.inquiry_id' => 'Inquiry.id')
								    				)
								    			)
								    		)
								    	);

		
		$companyData = $this->Company->find('list',array('fields' => array('id', 'company_name')));

		$noPermission = ' ';

		$this->set(compact('companyData','inquiryData','noPermission'));
		
	}

	public function review_inquiry($inquiryId = null){

		$this->Company->bind(array('Address','Contact','Email','Inquiry'));

		$inquiry = $this->Company->Inquiry->find('first', array(
	        'conditions' => array('Inquiry.id' => $inquiryId)
	    ));
		
	    $company = $this->Company->find('first', array(
	        'conditions' => array('Company.id' => $inquiry['Inquiry']['company_id'])
	    ));
		
		$noPermission = ' ';

		$this->set(compact('company','inquiry','noPermission'));
		
	}

	public function find_data($id = null) {
		
		$this->layout = false;
		$this->Company->bind(array('Contact','Email','Address'));

		$data =$this->Company->find('first', array(
										'conditions' => array(
											'Company.id' => $id), 
										'fields' => array(
											'id', 'company_name')
										));
		
		echo json_encode($data);



		$this->autoRender = false;

	}

	public function delete_inquiry($inquiryId = null){

		$this->loadModel('Sales.Quotation');

		$this->Company->bind(array('Inquiry'));

		$qouteCount = $this->Quotation->find('all',array(
												'conditions' => array(
														'Quotation.inquiry_id' => $inquiryId)
												));

		foreach ($qouteCount as $key => $value) {

			$this->Quotation->bind(array('QuotationField'));

			$quotationData = $this->Quotation->QuotationField->find('all',array(
																		'conditions' => array(
																				'QuotationField.quotation_id' => $value['Quotation']['id'])
																		));

			$this->Quotation->QuotationField->deleteQuoteFields($value['Quotation']['id']);

			$this->Quotation->delete($value['Quotation']['id']);
			
		}

		if ($this->Company->Inquiry->delete($inquiryId)) {
			
			$this->Session->setFlash(__('Inquiry Deleted.'));
            	$this->redirect(
					array('controller' => 'customer_sales', 'action' => 'inquiry')
				);
		} else {

			echo "error";exit();

		}
	}
	public function add_data(){

		$userData = $this->Session->read('Auth');
	
		if ($this->request->is('post')) {

            if (!empty($this->request->data)) {

            	$companyId = $this->request->data['Company']['id'];

            	$this->Company->bind(array('Address','Contact','Email','ContactPerson'));

            	if(!empty($this->request->data['Contact'])){
            		//pr($this->request->data);exit();
            		$this->Company->Contact->saveNumber($this->request->data, $companyId, $userData['User']['id']);
            		$this->Session->setFlash(__('Contact Successfully added in the system.'));
            	}
            	if(!empty($this->request->data['Address'])){
            		//pr($this->request->data);exit();
            		$this->Company->Address->saveAddress($this->request->data, $companyId, $userData['User']['id']);
            		$this->Session->setFlash(__('Address Successfully added in the system.'));
            	}
            	if(!empty($this->request->data['Email'])){
            		//pr($this->request->data);exit();
            		$this->Company->Email->saveEmail($this->request->data, $companyId, $userData['User']['id']);
            		$this->Session->setFlash(__('Email Successfully added in the system.'));
            	}
            	if(!empty($this->request->data['ContactPerson'])){
            		
            		$personId = $this->Company->ContactPerson->saveContactPerson($this->request->data, $companyId, $userData['User']['id']);
            		
            		$this->Company->Contact->saveNumber($this->request->data, $personId, $userData['User']['id']);

            		$this->Company->Email->saveEmail($this->request->data, $personId, $userData['User']['id']);

            		$this->Session->setFlash(__('Contact Person Successfully added in the system.'));
            	}
            	
            	$this->redirect(
					array('controller' => 'customer_sales', 'action' => 'view', $companyId)
				);
			}
		}
	}

	public function product_form(){
	
		$userData = $this->Session->read('Auth');

		$this->Company->bind(array('Contact','Email','Address','ContactPerson'));


		//$companyData = $this->Company->find('list', array('fields' => array('id', 'company_name')));

		$this->loadModel('ItemCategoryHolder');

		$categoryname = $this->ItemCategoryHolder->find('list', array('fields' => array('name')));

		$this->loadModel('StatusFieldHolder');

		$statusname = $this->StatusFieldHolder->find('list', array('fields' => array('status')));


		$this->set('categoryname', $categoryname);

		$this->set('statusname', $statusname);

		if ($this->request->is('post')) {

            if (!empty($this->request->data)) {

            	$this->Company->bind(array('Inquiry'));

            	$this->request->data = $this->Company->Inquiry->saveInquiry($this->request->data, $userData['User']['id']);

            	$this->Session->setFlash(__('Request Inquiry Success.'));
            	$this->redirect(
					array('controller' => 'customer_sales', 'action' => 'inquiry')
				);

            }
        }

	}

	public function add_product(){

		$userData = $this->Session->read('Auth');

		$this->loadModel('Sales.Inquiry');

		$this->Inquiry->bind(array('Quotation'));

		$inquiryData = $this->Inquiry->find('all', array(
								    			'order' => array('Inquiry.id DESC'),
								    			'contain' => array(
								    				'Quotation' => array(
								    					'conditions' => array('Quotation.inquiry_id' => 'Inquiry.id')
								    				)
								    			)
								    		)
								    	);
		
		$companyData = $this->Company->find('list',array('fields' => array('id', 'company_name')));

		$this->set(compact('companyData','inquiryData'));
		
	}

	public function search_customer($hint = null){

		$this->loadModel('Sales.Company');

		$this->Company->bind(array(
			'ContactPerson' => array('fields' => array('firstname','middlename','lastname'))
			));
		$companyData = $this->Company->find('all',array(
									'fields' => array(
										'Company.id',
						            	'Company.uuid', 
						            	'Company.company_name',
						            	'Company.website',
						            	'Company.tin',
						            	'Company.created'
						            	// 'ContactPerson.firstname',
						            	// 'ContactPerson.lastname'
										),
									'order' => 'Company.company_name ASC',
									'conditions' => array(
										'Company.company_name LIKE' => '%' . $hint . '%'
										// 'OR' => array(
											// array('Company.company_name LIKE' => '%' . $hint . '%'),
											// array('Quotation.uuid LIKE' => '%' . $hint . '%'),
											// array('Product.name LIKE' => '%' . $hint . '%')
										//	)
										),
									'limit' => 10
									));
		
		$this->set(compact('companyData','quotationData','inquiryId','salesStatus'));
		
		if ($hint == ' ') {
    		$this->render('index');
    	}else{
    		$this->render('search_customer');
    	}
	}
}
