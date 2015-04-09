<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class ProductsController extends SalesAppController {
	public $uses = array('Sales.Company','Sales.ItemCategoryHolder','Sales.ItemType','Sales.ProcessField');

	public function add($companyId = null){
		
		$userData = $this->Session->read('Auth');
        if($this->request->is('post')){

        	
            if(!empty($this->request->data)){
            	
            	
	        	 $productDetails = $this->request->data;
	        	 $this->loadModel('Sales.Product');
	             $productId = $this->Product->addProduct($productDetails, $userData['User']['id']);

	             $this->loadModel('Sales.ProductSpec');
	             $this->ProductSpec->addProductSpec($productDetails, $productId, $userData['User']['id']);

	             $this->Session->setFlash(__('Added Successfully.'));
	             $this->redirect( array(
	                                     'controller' => 'customer_sales', 
	                                     'action' => 'view',
	                                     $productDetails['Product']['companyId']
	                              
	                             ));
	            }
        }

		$itemCategory = $this->ItemCategory->find('list', array(
													'fields' => array(
														'id','category_name'),
													'conditions' => array(
														'status' => 'active'
												  		)
												));

		$processField = $this->ProcessField->find('all');
		
		
		$companyName = $this->Company->find('first', array(
												'conditions' => array(
													'id' =>  $companyId)
											));

		$this->loadModel('Sales.CustomField');
		$customField = $this->CustomField->find('list', array( 
													'fields' => array(
														'id', 'fieldlabel'),
													'conditions' => array( 
													'id NOT' => array(3,13,11)
													)
												));

		$this->set(compact('companyName','itemCategory','customField','processField'));

	}

	public function get_type($categoryId = null){
		$this->layout = false;
		$data = $this->ItemType->find('list', array(
											'conditions' => array(
									  			'category_id' => $categoryId),
									  		'fields' => array(
									  			'id','type_description')
									));
		echo json_encode($data);



		$this->autoRender = false;

	}
	public function get_product( $companyId = null){

		$this->layout = false;
		$this->loadModel('Sales.Product');
		$data = $this->Product->find('list', array(
										'fields' => array(
									  		'id','product_name'),
									  	'conditions' => array( 
											'company_id' => $companyId)
										));
	
		echo json_encode($data);



		$this->autoRender = false;

	}

	public function get_company_product($companyId = null){
		$this->layout = false;
	
		$this->loadModel('Sales.Product');
		$this->Product->bind(array('ItemType'));
		$company = $this->Product->find('list', array(
											'conditions' => array(
												'company_id' => $companyId),
											'fields' => array(
												'id','type_id')
										));
		echo json_encode($data);



		$this->autoRender = false;

	}
	public function get_product_spec($productId = null){
		$this->layout = false;
	
		$this->loadModel('Sales.Product');
		$this->Product->bind(array('ProductSpec'));
		$data = $this->Product->ProductSpec->find('all', array(
													'conditions' => array(
														'product_id' => $productId
													)
												));
		
		echo json_encode($data);



		$this->autoRender = false;

	}

	public function view($companyId = null,$productId){
		$itemCategory = $this->ItemCategory->find('list', array(
													'fields' => array(
														'id','category_name'),
													'conditions' => array(
														'status' => 'active'
												  		)
												));
		
		
		$this->loadModel('Sales.Company');
		$companyName = $this->Company->find('first', array(
												'conditions' => array(
													'id' =>  $companyId
												)
											));
		$this->loadModel('Sales.Product');
		$this->Product->bind(array('ProductSpec'));
		$productDetails = $this->Product->find('first', array(
													'conditions' => array(
														'id' => $productId
														)
													));

		$this->loadModel('Sales.CustomField');
		$customField = $this->CustomField->find('list',	array( 
													'fields' => array(
														'id', 'fieldlabel'),
													'conditions' => array( 
														'id NOT' => array(3,13,11)
													)
												));

		$this->set(compact('companyName','itemCategory','customField','productDetails'));

	}

	public function edit($companyId = null,$productId){
		$itemCategory = $this->ItemCategory->find('list', array(
													'fields' => array(
														'id','category_name'),
													'conditions' => array(
														'status' => 'active'
												  		)
												));
		
		$this->loadModel('Sales.Company');
		$companyName = $this->Company->find('first', array(
												'conditions' => array(
													'id' =>  $companyId
												)
											));
		$this->loadModel('Sales.Product');
		$this->Product->bind(array('ProductSpec'));
		$productDetails = $this->Product->find('first', array(
													'conditions' => array(
														'id' => $productId
														)
													));

		$this->loadModel('Sales.CustomField');
		$customField = $this->CustomField->find('list',	array( 
													'fields' => array(
														'id', 'fieldlabel'),
													'conditions' => array( 
														'id NOT' => array(3,13,11)
													)
												));

		$this->set(compact('companyName','itemCategory','customField','productDetails'));

	}

	public function saveProduct(){

		$userData = $this->Session->read('Auth');
        if($this->request->is('post')){

            if(!empty($this->request->data)){
            	
	        	 $productDetails = $this->request->data;
	        	 $this->loadModel('Sales.Product');
	             $productId = $this->Product->editProduct($productDetails, $userData['User']['id']);
	             $this->Session->setFlash(__(' Successfully Updated.'));
	             $this->redirect( array(
	                                     'controller' => 'customer_sales', 
	                                     'action' => 'view',
	                                     $productDetails['Product']['companyId']
	                              
	                             ));
	        }
        }
	}

	public function create($companyId = null){
		
		$userData = $this->Session->read('Auth');
		// $this->Company->bind(array('Product'));
		$companyName = $this->Company->find('first', array(
										'conditions' => array(
											'id' =>  $companyId)
									));
		
		$this->loadModel('ItemCategoryHolder');

		$this->ItemCategoryHolder->bind(array('ItemTypeHolder'));

		$itemCategoryData = $this->ItemCategoryHolder->find('list', array('fields' => array('id', 'name')));
		$itemTypeData = $this->ItemCategoryHolder->ItemTypeHolder->find('list', array('fields' => array('id', 'name')));

		//pr($itemCategoryData);exit();
		$this->set(compact('companyName','itemCategoryData','itemTypeData'));
	}

}