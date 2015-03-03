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
            	//pr($this->request->data);
            	
            	$productDetails = $this->request->data;
            	$this->loadModel('Sales.Product');
                $this->Product->addProduct($productDetails, $userData['User']['id']);
                $this->redirect( array(
                                     'controller' => 'customer_sales', 
                                     'action' => 'view',
                                     $productDetails['Product']['companyId']
                              
                                ));
            }
        }

		$itemCategory = $this->ItemCategory->find('list', 
														array(
												  'fields' =>
												  		array(
												  	'id','category_name'
												  			),
												  'conditions' => 
												  		array(
												  'status' => 'active'
												  		)

												));
		
		//pr($itemCategory);exit();
		$companyName = $this->Company->find('first', 
													array(
											'conditions' => 
													array(
											'id' =>  $companyId
												)
											));
		$this->set(compact('companyName','itemCategory'));

	}

	public function get_type($categoryId = null){
		$this->layout = false;
		$data = $this->ItemType->find('list', 
											array(
									  'conditions' => 
									  		array(
									  'category_id' => $categoryId
									  		),
									  'fields' =>
											array(
									  'id','type_description'
											)
										));
		//pr($data);exit();
		
		echo json_encode($data);



		$this->autoRender = false;

	}
	public function get_product($typeId = null, $companyId = null){

		$this->layout = false;
		$this->loadModel('Sales.Product');
		$data = $this->Product->find('list', 
											array(
									  'fields' =>
											array(
									  'id','product_name'
											),
									  'conditions' => 
									  		array(
									  'type_id' => $typeId, 
									  'company_id' => $companyId
									  		)
										));
		//pr($data);exit();
		
		echo json_encode($data);



		$this->autoRender = false;

	}

	public function get_company_product($companyId = null){
		$this->layout = false;
	
		$this->loadModel('Sales.Product');
		$this->Product->bind(array('ItemType'));
		$company = $this->Product->find('list', 
											array(
										'conditions' => 
											array(
										'company_id' => $companyId
											),
										'fields' => 
											array(
										'id','type_id'

											)
										));


		pr($company);exit();
		// $type = $this->ItemType->find('all', 
		// 									array(
		// 							  'conditions' => 
		// 							  		array(
		// 							  'id' =>$company
		// 							  )

		// 							));
		// pr($type);exit();
		
		echo json_encode($data);



		$this->autoRender = false;

	}

}