<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class QuotationController extends SalesAppController {

	public $uses = array('Sales.Company','Sales.Quotation');
	public $helper = array('Sales.Country');

	public function beforeFilter() {

        parent::beforeFilter();

        $userData = $this->Session->read('Auth');

        $this->Auth->allow('add','index');

        $this->set(compact('userData'));

    }
	    	    
	public function index() {

	}
	public function create($inquiryId = null) {

		$this->Company->bind(array('Address','Contact','Email','Inquiry'));

		$inquiry = $this->Company->Inquiry->find('first', array(
	        'conditions' => array('Inquiry.id' => $inquiryId)
	    ));
		
	    $company = $this->Company->find('first', array(
	        'conditions' => array('Company.id' => $inquiry['Inquiry']['company_id'])
	    ));
		
		$this->set(compact('company','inquiry'));
	}

	public function add() {

		$userData = $this->Session->read('Auth');
		
		if ($this->request->is('post')) {

            if (!empty($this->request->data)) {
            	$inquiryId = $this->request->data['Inquiry']['id'];
            	
            	$this->Quotation->addQuotation($this->request->data['Quotation'],$userData['User']['id'],$inquiryId);

            	// $this->Session->setFlash(__('Register Complete.'));
            	// $this->redirect(
             //        array('controller' => 'users', 'action' => 'login')
             //    );
            	//pr($this->request->data);exit();
            	echo "save";exit();
            }
        }
	}
}