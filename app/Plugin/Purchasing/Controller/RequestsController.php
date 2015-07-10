<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class RequestsController extends PurchasingAppController {

	public $helpers = array('Purchasing.Country');

	public $uses = array('Purchasing.Supplier');

	public function index() {

		$this->Supplier->bind(array('Address','Email','Contact','SupplierContactPerson'));

		$limit = 10;

		$conditions = array();

         $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'fields' => array('id', 'name', 'description','website','created','tin'),
            'order' => 'Supplier.created DESC',
        );

		$suppliers = $this->paginate();

		$this->set(compact('suppliers'));

	}

	public function create() {

		$this->loadModel('Purchasing.PurchasingType');

	 	$purchasingTypeData = $this->PurchasingType->find('list', array(
														'fields' => array('PurchasingType.id', 'PurchasingType.name'),
														));

		$this->set(compact('purchasingTypeData'));
			
	}


	public function request_list(){
		
	}

}