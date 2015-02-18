<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class ProductionSystemsController extends ProductionAppController {
	public function index() {


    }

    public function add() {
    	$userData = $this->Session->read('Auth');
    	$this->loadModel('Sales.Company');
    	$this->Company->bind(array('Quotation'));
    	$companyData = $this->Company->find('list',array('fields' => array('id','company_name')));
    	// pr($companyData);
    	//$companyOrder = $this->Company->find('list',array('conditions' => array('')));
    	$this->set(compact('companyData'));
    	if($this->request->is('post')){
    		$this->Production->addScheduled($this->request->data,$userData['User']['id']);
			pr($this->request->data);
    	exit();
    	}
    	
    }

    public function find_data($id = null) {
		$this->loadModel('Sales.Company');
		$this->layout = false;
		$this->Company->bind(array('Quotation','Inquiry'));
		//$uniqueId = $this->Company->find('all');
		$inquiryData = $this->Company->Inquiry->find('list',array(
														'fields' => array(
															'id','company_id')));
		 //$companyData = $this->Company->find('list',array(
		// 												'fields' => array(
		// 													'id','company_name')));
		$uniqueId = $this->Company->Quotation->find('first', array(
										'conditions'=> array(
														'Quotation.company_id' => $id,
														)
				
										));
		//$data =$this->Company->find('first', array('conditions' => array('Company.id' => $id),'fields' => array('id', 'company_name')));
		echo json_encode($uniqueId);
		//echo json_encode($inquiryData);

		$this->autoRender = false;

		// $inquiryData = $this->Inquiry->find('all',
		// 	array(
  //   			'order' => array('Inquiry.id DESC'),
  //   			'contain' => array(
  //   				'Quotation' => array(
  //   					'conditions' => array('Quotation.inquiry_id' => 'Inquiry.id')
  //   				)
  //   			)
  //   		)
  //   	);

	}
	 
}