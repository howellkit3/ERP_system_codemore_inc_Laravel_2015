<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class ProductsController extends SalesAppController {

	public $uses = array('Sales.Company','Sales.ItemCategoryHolder','Sales.ItemType','Sales.ProcessField');

	public $validate = array(

        'item_category_holder_id' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            ),
        ), 

        'item_type_holder_id' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            ),
        ), 

        'name' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            ),
        ), 

    
    );

	function beforeFilter() {
  		$this->myRandomNumber = rand(1,4);
	}

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

		$this->loadModel('ItemCategoryHolder');

		$this->loadModel('Sales.Company');

		$this->loadModel('Sales.Product');

		$this->loadModel('Sales.CustomField');



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

		 if (!$id) {

                throw new NotFoundException(__('Invalid post'));
            }

            $post = $this->ItemTypeHolder->findById($id,  array('order' => 'ItemTypeHolder.id DESC'));

            if (!$post) {
                throw new NotFoundException(__('Invalid post'));
            }

            if ($this->request->is(array('post', 'put'))) {
                $this->Product->id = $id;

                if ($this->Product->save($this->request->data)) {

                    $this->Product->save($this->request->data);
                    //$this->Product->bind(array('Product'));
                    //$this->Product->ItemCategoryHolder->save($this->request->data);
                    $this->Session->setFlash(__('Type has been updated.'));
                    return $this->redirect(array('action' => 'category'));
                }
                $this->Session->setFlash(__('Unable to update your post.'));
            }

            if (!$this->request->data) {
                $this->request->data = $post;
            }

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

	public function create_product($companyId = null){
		

		if ($this->request->is('post')) {

			$userData = $this->Session->read('Auth');
		 	$productDetails = $this->request->data;
        	 $this->loadModel('Sales.Product');
        	 $productDetails['Product']['uuid'] = time();

            if ($this->Product->save($productDetails)) {

	           	 $this->Session->setFlash(__('Products Successfully Added'));
	             $this->redirect( array(
	                                     'controller' => 'products', 
	                                     'action' => 'index',	                              
	                             ));
            } else {

            		 $this->Session->setFlash(__('There\'s an error saving your product'));	             	
            }
		}

		$userData = $this->Session->read('Auth');
		$companyName = $this->Company->find('first', array(
										'conditions' => array(
											'id' =>  $companyId)
									));
		
		$this->loadModel('ItemCategoryHolder');
		$this->ItemCategoryHolder->bind(array('ItemTypeHolder'));
		$itemCategoryData = $this->ItemCategoryHolder->find('list', array('fields' => array('id', 'name')));
		$itemTypeData = $this->ItemCategoryHolder->ItemTypeHolder->find('list', array('fields' => array('id', 'name')));
		$productData = $this->ItemCategoryHolder->ItemTypeHolder->find('list', array('fields' => array('id', 'name')));
		$this->set(compact('companyName','itemCategoryData','itemTypeData'));
	}

	public function index() {

		$this->loadModel('ItemCategoryHolder');

        $this->loadModel('ItemTypeHolder');

		//$userData = $this->Session->read('Auth');

		$this->loadModel('Sales.Product');

		$this->Product->recursive = 1;
		
		$itemCategoryData = $this->ItemCategoryHolder->find('list', array('fields' => array('id', 'name')));

		$itemTypeData = $this->ItemTypeHolder->find('list', array('fields' => array('id', 'name')));

		$nameTypeData = $this->ItemTypeHolder->find('all',  array('order' => 'ItemTypeHolder.id DESC'));

		$categoryData = $this->ItemCategoryHolder->find('all',  array('order' => 'ItemCategoryHolder.id DESC'));

		$productData = $this->Product->find('all',array(
    		'order' => array('Product.id DESC')));

		$this->set(compact('productData','categoryData','nameTypeData','itemCategoryData', 'itemTypeData'));

	}

	public function review_product($productId = null){

		$this->Company->bind(array('Address','Contact','Email','Inquiry'));

		$product = $this->Product->Inquiry->find('first', array(
	        'conditions' => array('Product.id' => $productId)
	    ));
		
		$this->set(compact('product'));		
	}

	public function delete_product($productId = null){

		$this->loadModel('Sales.Quotation');

		$this->Company->bind(array('Inquiry'));

		$qouteCount = $this->Quotation->find('all',array(
												'conditions' => array(
														'Quotation.inquiry_id' => $inquiryId)
												));

		foreach ($qouteCount as $key => $value) {

			$this->Quotation->bind(array('QuotationField'));

			$quotationData = $this->Quotation->QuotationField->find('all',array(
																		'conditions' => array(
																				'QuotationField.quotation_id' => $value['Quotation']['id'])
																		));

			$this->Quotation->QuotationField->deleteQuoteFields($value['Quotation']['id']);

			$this->Quotation->delete($value['Quotation']['id']);
			
		}

		if ($this->Company->Inquiry->delete($inquiryId)) {
			
			$this->Session->setFlash(__('Inquiry Deleted.'));
            	$this->redirect(
					array('controller' => 'customer_sales', 'action' => 'inquiry')
				);
		} else {

			echo "error";exit();

		}
	}

	 public function deleteProduct($id) {
      
       /* if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        } */

	   $this->loadModel('Sales.Product');
        if ($this->Product->delete($id)) {
            $this->Session->setFlash(
                __('Successfully deleted.', h($id))
            );
        } else {
            $this->Session->setFlash(
                __('The post cannot be deleted.', h($id))
            );
        }

        return $this->redirect(array(' controller' => 'products', 'action' => 'index'));
    }

    public function find_item($itemId = null){

    	$this->layout = false;
    	$this->loadModel('ItemCategoryHolder');
		$this->ItemCategoryHolder->bind(array('ItemTypeHolder'));

		$itemdata =$this->ItemCategoryHolder->ItemTypeHolder->find('all', array(
										'conditions' => array(
											'ItemTypeHolder.Item_category_holder_id' => $itemId), 
										'fields' => array(
											'id', 'name')
										));
	
		echo json_encode($itemdata);
		exit();

		$this->autoRender = false;
    	
    }
}