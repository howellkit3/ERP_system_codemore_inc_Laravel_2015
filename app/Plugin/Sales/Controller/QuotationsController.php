<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class QuotationsController extends SalesAppController {

	public $uses = array('Sales.Company','Sales.Quotation');
	public $helper = array('Sales.Country');
	public $useDbConfig = array('koufu_system');

	public function beforeFilter() {

        parent::beforeFilter();

        $userData = $this->Session->read('Auth');

        $this->Auth->allow('add','index');

        $this->set(compact('userData'));

    }
	    	    
	public function index() {

		$userData = $this->Session->read('Auth');
		
		$quotationData = $this->Quotation->find('all');

		$this->Company->bind(array('Inquiry',));

		$inquiryId = $this->Company->Inquiry->find('list',array(
     		'fields' => array('company_id')));
	
	 	$companyData = $this->Company->find('list',array(
     		'fields' => array('id','company_name')));

		$this->set(compact('companyData','quotationData','inquiryId'));
		
	}
	public function create($inquiryId = null) {

		$userData = $this->Session->read('Auth');

		$this->loadModel('Sales.CustomField');

		$customField = $this->CustomField->find('list', array('fields' => array('id', 'fieldlabel')));

		if(!empty($inquiryId)){

			$this->Company->bind(array('Address','Contact','Email','Inquiry'));

			$inquiry = $this->Company->Inquiry->find('first', array(
		        'conditions' => array('Inquiry.id' => $inquiryId)
		    ));
			
		    $company = $this->Company->find('first', array(
		        'conditions' => array('Company.id' => $inquiry['Inquiry']['company_id'])
		    ));
			
			$this->set(compact('company','inquiry','customField'));

		}else{

			$userData = $this->Session->read('Auth');

			$this->Company->bind(array('Contact','Email','Address','ContactPerson'));

			$companyData = $this->Company->find('list', array('fields' => array('id', 'company_name')));

			$this->set(compact('companyData','customField'));
		}
		
	}

	public function add() {

		$userData = $this->Session->read('Auth');
		
		$this->Quotation->bind(array('QuotationField'));

		if ($this->request->is('post')) {

            if (!empty($this->request->data)) {
            	
            	if(!empty($this->request->data['Inquiry']['id'])){
            		$inquiryId = $this->request->data['Inquiry']['id'];
            		$quotationId = $this->Quotation->addInquiryQuotation($this->request->data['Quotation'],$userData['User']['id'],$inquiryId);
            		
            	}else{
            		$companyId = $this->request->data['Company']['id'];
            		$quotationId = $this->Quotation->addCompanyQuotation($this->request->data['Quotation'],$userData['User']['id'],$companyId);
					
            	}
            	
            	$this->Quotation->QuotationField->saveQuotationField($this->request->data,$quotationId,$userData['User']['id']);
        		
            	$this->Session->setFlash(__('Quotation Complete.'));
            	$this->redirect(
                    array('controller' => 'quotations', 'action' => 'index')
                );
            	
            }
        }
	}

	public function view($quotationId,$companyId){

		$userData = $this->Session->read('Auth');

		$this->Company->bind(array('Address','Contact','Email','Inquiry','ContactPerson','Quotation'));

		$quotation = $this->Company->Quotation->find('first',
				array('conditions' => 
						array('Quotation.id' => $quotationId)));

		$companyData = $this->Company->find('list',array(
     		'fields' => array('id','company_name')));

		$inquiryId = $this->Company->Inquiry->find('list',array(
     		'fields' => array('company_id')));

		$contactInfo = $this->Company->ContactPerson->find('first',array(
			'conditions' => array('ContactPerson.company_id' => $companyId )));

		$this->Quotation->bind(array('QuotationField'));

		$quotationFieldInfo = $this->Quotation->QuotationField->find('all',array(
			'conditions' => array('QuotationField.quotation_id' => $quotationId )));

		$this->Quotation->QuotationField->bind(array('CustomField'));

		$field = $this->Quotation->QuotationField->CustomField->find('list',array(
			'fields' => array('id','fieldlabel')));
		
		$this->loadModel('User');
		$user = $this->User->find('first',array('conditions' => array(
			'User.id' => $userData['User']['id'] )));

		$this->set(compact('companyData','companyId','quotation','inquiryId','user','contactInfo','quotationFieldInfo','field'));
		
	}

	public function approved($quotationId = null){

		$this->Quotation->approvedData($quotationId);

		$this->Session->setFlash(__('Quotation Approved.'));
    	$this->redirect(
            array('controller' => 'quotations', 'action' => 'index')
        );

	}

	public function print_word($quotationId = null,$companyId = null) {

			$this->layout = 'pdf';

		Configure::write('debug',2);

		$userData = $this->Session->read('Auth');

		$userData = $this->Session->read('Auth');

		$this->Company->bind(array('Address','Contact','Email','Inquiry','ContactPerson','Quotation'));

		$quotation = $this->Company->Quotation->find('first',
				array('conditions' => 
						array('Quotation.id' => $quotationId)));

		$companyData = $this->Company->find('list',array(
     		'fields' => array('id','company_name')));

		$inquiryId = $this->Company->Inquiry->find('list',array(
     		'fields' => array('company_id')));

		$contactInfo = $this->Company->ContactPerson->find('first',array(
			'conditions' => array('ContactPerson.company_id' => $companyId )));

		$this->Quotation->bind(array('QuotationField'));

		$quotationFieldInfo = $this->Quotation->QuotationField->find('all',array(
			'conditions' => array('QuotationField.quotation_id' => $quotationId )));

		$this->Quotation->QuotationField->bind(array('CustomField'));

		$field = $this->Quotation->QuotationField->CustomField->find('list',array(
			'fields' => array('id','fieldlabel')));
		
		$this->loadModel('User');
		$user = $this->User->find('first',array('conditions' => array(
			'User.id' => $userData['User']['id'] )));

		$this->set(compact('companyData','quotation','inquiryId','user','contactInfo','quotationFieldInfo','field'));
	
		//$this->render('/quotations/word/print_word');

	}

	public function delete($quotationId = null){

		$this->Quotation->bind(array('QuotationField'));

		$quotationData = $this->Quotation->QuotationField->find('all',array(
			'conditions' => array('QuotationField.quotation_id' => $quotationId)));

		$this->Quotation->QuotationField->deleteQuoteFields($quotationId);

		$this->Quotation->delete($quotationId);
		
		$this->Session->setFlash(__('Quotation Deleted.'));

    	$this->redirect(
			array('controller' => 'quotations', 'action' => 'index')
		);
		
	}

}