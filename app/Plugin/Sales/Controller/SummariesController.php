	<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class SummariesController extends SalesAppController {

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

		$userData = $this->Session->read('Auth');
		// Customer info
		$this->Company->bind(array('ContactPerson'));

		$this->Company->recursive = 1;

		$company = $this->Company->find('all',array(
    		'order' => array('Company.id DESC')));

		$this->set(compact('company'));

		// Inquiry
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
}