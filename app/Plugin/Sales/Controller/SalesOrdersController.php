<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class SalesOrdersController extends SalesAppController {

	public $uses = array('Sales.Quotation','Sales.ClientOrder','Sales.Company');

	public function beforeFilter() {

        parent::beforeFilter();

        $userData = $this->Session->read('Auth');

        $this->Auth->allow('index');

        $this->set(compact('userData'));

    }
	    	    
	public function index() {

		$userData = $this->Session->read('Auth');

		$this->Quotation->bind(array('ClientOrder'));

		$clientOrder = $this->Quotation->ClientOrder->find('all', array('order' => 'ClientOrder.id DESC'));


		// pr($clientOrder);exit();
		$this->loadModel('Sales.Company');

		$this->Company->bind(array('Inquiry'));

		$companyData = $this->Company->find('list',array(
     											'fields' => array('id','company_name')
     										));

		$inquiryId = $this->Company->Inquiry->find('list',array(
     													'fields' => array('company_id')
     												));

		$quoteName = $this->Quotation->find('list',array('id','name'));
		
		$this->set(compact('clientOrder','quoteName','companyData','inquiryId'));
	}

	public function view($clientOrderId = null){

		$this->Quotation->bind(array('QuotationDetail','QuotationItemDetail'));

		$this->ClientOrder->bind(array('ClientOrderDeliverySchedule'));

		$clientOrderData = $this->ClientOrder->find('first',array('conditions' => array('ClientOrder.id' => $clientOrderId)));

		$quotationData = $this->Quotation->find('first',array('conditions' => array('Quotation.id' => $clientOrderData['ClientOrder']['quotation_id'])));

		$companyName = $this->Company->find('list',array(
     													'fields' => array('id','company_name')
     												));

		$quotationItemDetail = $this->Quotation->QuotationItemDetail->find('first',array('conditions' => array('QuotationItemDetail.id' => $clientOrderData['ClientOrder']['client_order_item_details_id'])));
		//pr($quotationItemDetail);exit();

		$this->set(compact('clientOrderData','quotationData','companyName','quotationItemDetail'));

	}

}