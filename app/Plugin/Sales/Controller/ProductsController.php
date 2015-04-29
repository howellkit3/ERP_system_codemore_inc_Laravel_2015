<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class ProductsController extends SalesAppController {

	public $uses = array('Sales.Company','ItemCategoryHolder','Sales.ItemCategoryHolder','Sales.ItemType','Sales.ProcessField','GeneralItem');
	
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

	public function create_product($companyId = null){
		

		if ($this->request->is('post')) {
				pr($this->request->data);
				exit();
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
		$companyData = $this->Company->getList(array('id','company_name'));
		$this->set(compact('itemCategoryData','itemTypeData', 'companyData'));
	}

	public function view($id){

		$this->loadModel('ItemCategoryHolder');

        $this->loadModel('ItemTypeHolder');

        $this->loadModel('Company');

		$this->loadModel('Sales.Product');

		$this->Product->recursive = 1;

		$product = $this->request->data =  $this->Product->findById($id);

		$this->request->data['Company'] = $this->Company->read(null,$product['Product']['company_id'])['Company'];

		$productData = $this->Product->find('all',array(
    		'order' => array('Product.id DESC')));	

		$this->set(compact('product','productData','categoryData','nameTypeData','itemCategoryData', 'itemTypeData', 'companyData'));


	}

	public function edit($id){

		$this->loadModel('ItemCategoryHolder');

		$this->loadModel('Sales.Company');

		$this->loadModel('Sales.Product');

		$this->loadModel('Sales.CustomField');


		 if (!$id) {

                throw new NotFoundException(__('Invalid post'));
            }

            $post = $this->Product->findById($id);

            if (!$post) {
                throw new NotFoundException(__('Invalid post'));
            }

            if ($this->request->is(array('post', 'put'))) {
                $this->Product->id = $id;

                if ($this->Product->save($this->request->data)) {

                    $this->Product->save($this->request->data);
                    $this->Session->setFlash(__('Product has been updated.'));
                    return $this->redirect(array('action' => 'index'));
                }
                $this->Session->setFlash(__('Unable to update your post.'));
            }

            if (!$this->request->data) {
                $this->request->data = $post;
            }

		$this->ItemCategoryHolder->bind(array('ItemTypeHolder'));
		$itemCategoryData = $this->ItemCategoryHolder->find('list', array('fields' => array('id', 'name')));
		$itemTypeData = $this->ItemCategoryHolder->ItemTypeHolder->find('list', array('fields' => array('id', 'name')));
		$companyData = $this->Company->getList(array('id','company_name'));
		$this->set(compact('itemCategoryData','itemTypeData','productData','productDetails','companyData'));
		$this->set(compact('companyName','itemCategoryData','itemTypeData', 'companyData'));

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

	

	public function index() {

		
		$this->loadModel('ItemCategoryHolder');

        $this->loadModel('ItemTypeHolder');

        $this->loadModel('Company');

		$this->loadModel('Sales.Product');

		$this->Product->recursive = 1;
		
		$itemCategoryData = $this->ItemCategoryHolder->find('list', array('fields' => array(
			'id', 'name')));

		$itemTypeData = $this->ItemTypeHolder->find('list', array('fields' => array(
			'id', 'name')));

		$nameTypeData = $this->ItemTypeHolder->find('all',  array(
			'order' => 'ItemTypeHolder.id DESC'));

		$categoryData = $this->ItemCategoryHolder->find('all',  array(
			'order' => 'ItemCategoryHolder.id DESC'));

		$companyData = $this->Company->getList(array('id','company_name'));

		$limit = 5;

		$conditions = array();
			
		$this->paginate = array(
            'conditions' => $conditions,
            'limit' => 3,
            //'fields' => array('id', 'name', 'created','modified'),
            'order' => 'Product.id DESC',
        );

        $productData = $this->paginate('Product');


		$this->set(compact('productData','categoryData','nameTypeData','itemCategoryData', 'itemTypeData', 'companyData'));

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

		$this->autoRender = false;
    	
    }
     public function find_categ($itemId = null){

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

		$this->autoRender = false;
    	
    }
     public function find_contact($itemId = null){

    	$this->layout = false;
    	$this->loadModel('ContactPerson');

		$itemdata =$this->ContactPerson->find('all', array(
										'conditions' => array(
											'ContactPerson.company_id' => $itemId), 
										'fields' => array(
											'id', 'firstname','lastname')
										));

		
		echo json_encode($itemdata);

		$this->autoRender = false;
    	
    }
    public function find_product($itemtypeid = null){

    	$this->autoRender = false;

    	$this->loadModel('Sales.Product');

    	$productData = $this->Product->find('all',array(
    										'conditions' => array(
											'Product.item_type_holder_id' => $itemtypeid),
											'fields' => array(
											'id', 'name')));
    	
    	$this->layout = false;

		echo json_encode($productData);

    	
    }

    public function find_dropdown($dropdownId = null){

    	$this->autoRender = false;

    	$this->ItemCategoryHolder->bind(array('ItemTypeHolder'));

    	$productData = array();

    	if($dropdownId == 0){

    		$generalData = $this->GeneralItem->find('list',array(
											'fields' => array(
											'id', 'category_id')));
    		

    		$categoryData = $this->ItemCategoryHolder->find('all',
    											array('fields' => 
    												array('ItemCategoryHolder.id',
    												 	'ItemCategoryHolder.name',
    												 	'ItemTypeHolder.id',
    												 	'ItemTypeHolder.name'
    												 ),
													'conditions' => array(
														'ItemCategoryHolder.id' => $generalData
													),
													'contains' => array('ItemTypeHolder')
													));

    		foreach ($categoryData as $key => $itemtypes) {
    			$productData['ItemTypeHolder'][] = 	$itemtypes['ItemTypeHolder'];
    		}
    	}

    	$this->layout = false;

		echo json_encode($productData);

    	
    }
}