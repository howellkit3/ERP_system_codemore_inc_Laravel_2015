<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class ProductsController extends SalesAppController {
	public $uses = array('Sales.Company','Sales.ItemCategory','Sales.ItemType');

	public function add($companyId = null){
		
		$userData = $this->Session->read('Auth');
        if($this->request->is('post')){

        	//pr($id);exit();
            if(!empty($this->request->data)){
            	//pr($this->request->data);die;
            	
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
		
		//pr($itemCategory);exit();
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

		//pr($customField );
		$this->set(compact('companyName','itemCategory','customField'));

	}

	public function get_type($categoryId = null){
		$this->layout = false;
		$data = $this->ItemType->find('list', array(
											'conditions' => array(
									  			'category_id' => $categoryId),
									  		'fields' => array(
									  			'id','type_description')
									));
		//pr($data);exit();
		
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
		//pr($data);exit();
		
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


		//pr($company);exit();
		
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
														'id', 'fieldlabel'
														),
													'conditions' => array( 
														'id NOT' => array(3,13,11)
													)
												));

		//pr($customField );
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

}