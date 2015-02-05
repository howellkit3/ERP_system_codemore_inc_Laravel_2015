<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class QuotationsController extends SalesAppController {

	public $uses = array('Sales.Company','Sales.Quotation');
	public $helper = array('Sales.Country');

	public function beforeFilter() {

        parent::beforeFilter();

        $userData = $this->Session->read('Auth');

        $this->Auth->allow('add','index');

        $this->set(compact('userData'));

    }
	    	    
	public function index() {

		$userData = $this->Session->read('Auth');
		
		$this->Company->bind(array('Inquiry'));

		$this->Company->Inquiry->bind(array('Quotation'));

		$quotationData = $this->Company->Inquiry->find('all',array(
    		'order' => array('Inquiry.id DESC')));

		$companyData = $this->Company->find('list',array(
    		'fields' => array('id','company_name')));

		$this->set(compact('companyData','quotationData'));
		//pr($quotationData);exit();
	
	}
	public function create($inquiryId = null) {

		$userData = $this->Session->read('Auth');

		if(!empty($inquiryId)){

			$this->loadModel('Sales.CustomField');

			$customField = $this->CustomField->find('list', array('fields' => array('id', 'fieldlabel')));

			$this->Company->bind(array('Address','Contact','Email','Inquiry'));

			$inquiry = $this->Company->Inquiry->find('first', array(
		        'conditions' => array('Inquiry.id' => $inquiryId)
		    ));
			
		    $company = $this->Company->find('first', array(
		        'conditions' => array('Company.id' => $inquiry['Inquiry']['company_id'])
		    ));
			
			$this->set(compact('company','inquiry','customField'));

		}
		
	}

	public function add() {

		$userData = $this->Session->read('Auth');
		
		if ($this->request->is('post')) {

            if (!empty($this->request->data)) {

            	$inquiryId = $this->request->data['Inquiry']['id'];
            	
            	$this->Quotation->addQuotation($this->request->data['Quotation'],$userData['User']['id'],$inquiryId);

            	$this->Session->setFlash(__('Register Complete.'));
            	$this->redirect(
                    array('controller' => 'quotations', 'action' => 'index')
                );
            	
            }
        }
	}

	public function view($inquiryId){

		$this->Company->bind(array('Address','Contact','Email','Inquiry','ContactPerson'));
		$this->Company->Inquiry->bind(array('Quotation'));

		$inquiry = $this->Company->Inquiry->find('first', array(
	        'conditions' => array('Inquiry.id' => $inquiryId)
	    ));
		$this->Quotation->bind(array('CustomField'));
		$field = $this->Quotation->CustomField->find('list',array('fields' => array('id','fieldlabel')));
	    $company = $this->Company->find('first', array(
	        'conditions' => array('Company.id' => $inquiry['Inquiry']['company_id'])
	    ));
		$this->set(compact('company','inquiry','field'));
		
	}
}