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
  
					$contactPersonId = $this->Company->ContactPerson->saveContact($this->request->data['ContactPersonData'], $this->Company->id,$userData['User']['id']);
            	
            		$this->Company->Contact->saveContact($this->request->data['ContactPersonData'], $contactPersonId);
            		$this->Company->Address->saveContact($this->request->data['ContactPersonData'], $contactPersonId);
            		$this->Company->Email->saveContact($this->request->data['ContactPersonData'], $contactPersonId);

					if($this->request->is('ajax')){
 							echo $this->Company->getLastInsertID();
 							exit();
					}
            		$this->Session->setFlash(__('New Customer Information Added.'));

	            	$this->redirect(
	                    array('controller' => 'customer_sales', 'action' => 'inquiry_form')
	                );
                  
	            }else{

	            	$this->Session->setFlash(
                        __('The invalid data. Please, try again.')
                    );
	            }
            	
            }
        }

	}

	public function view($companyId = null){

		
		$this->Company->bind(array('Address','Contact','Email','ContactPerson','Product'));

		$this->Company->recursive = 1;

		$company = $this->Company->find('first', array(
	        'conditions' => array('Company.id' => $companyId)
	    ));
		//pr($company);exit();
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
	    //pr($this->request->data);exit();
		
	}

	public function delete($dataId = null, $personId = null){

		$this->Company->bind(array('Contact','Email','Address','ContactPerson'));
		
		if ($this->Company->delete($dataId)) {
			
			$this->loadModel('Sales.Contact');
			$this->Contact->deleteContact($personId);

			$this->loadModel('Sales.Email');
			$this->Email->deleteEmail($personId);

			$this->loadModel('Sales.Address');
			$this->Address->deleteAddress($personId);

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

		$userData = $this->Session->read('Auth');

		$this->Company->bind(array('Contact','Email','Address','ContactPerson'));

		$companyData = $this->Company->find('list', array('fields' => array('id', 'company_name')));

		$this->set('companyData', $companyData);

		if ($this->request->is('post')) {
			pr($this->request->data);die;

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

	public function inquiry(){

		$userData = $this->Session->read('Auth');

		$this->loadModel('Sales.Inquiry');

		$this->Inquiry->bind(array('Quotation'));

		$inquiryData = $this->Inquiry->find('all',
			array(
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

	public function review_inquiry($inquiryId = null){

		$this->Company->bind(array('Address','Contact','Email','Inquiry'));

		$inquiry = $this->Company->Inquiry->find('first', array(
	        'conditions' => array('Inquiry.id' => $inquiryId)
	    ));
		
	    $company = $this->Company->find('first', array(
	        'conditions' => array('Company.id' => $inquiry['Inquiry']['company_id'])
	    ));
		
		$this->set(compact('company','inquiry'));
		//pr($company);exit();
	}

	public function find_data($id = null) {
		
		$this->layout = false;
		$this->Company->bind(array('Contact','Email','Address'));

		$data =$this->Company->find('first', array('conditions' => array('Company.id' => $id),'fields' => array('id', 'company_name')));
		
		echo json_encode($data);



		$this->autoRender = false;

	}

	public function delete_inquiry($inquiryId = null){

		$this->loadModel('Sales.Quotation');

		$this->Company->bind(array('Inquiry'));

		$qouteCount = $this->Quotation->find('all',array(
			'conditions' => array('Quotation.inquiry_id' => $inquiryId)));

		foreach ($qouteCount as $key => $value) {

			$this->Quotation->bind(array('QuotationField'));

			$quotationData = $this->Quotation->QuotationField->find('all',array(
				'conditions' => array('QuotationField.quotation_id' => $value['Quotation']['id'])));

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
}
