<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');
App::import('Vendor', 'DOMPDF', true, array(), 'dompdf'.DS.'dompdf_config.inc.php', false);

class ProductsController extends SalesAppController {

	public $uses = array('Sales.Company','Sales.Product','Process','GeneralItem','Substrate','CompoundSubstrate','CorrugatedPaper');
	
	function beforeFilter() {

        $this->Auth->allow('add','index');

  		$this->myRandomNumber = rand(1,4);

        $this->loadModel('User');
        $userData = $this->User->read(null,$this->Session->read('Auth.User.id'));//$this->Session->read('Auth');
        $this->set(compact('userData'));
	}


	public function index() {

		$userData = $this->Session->read('Auth');
		
		$this->loadModel('ItemCategoryHolder');

        $this->loadModel('ItemTypeHolder');

        $this->loadModel('Company');

		
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

		$limit = 10;

		$conditions = array();
			
		$this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            //'fields' => array('id', 'name', 'created','modified'),
            'order' => 'Product.id DESC',
        );

        $productData = $this->paginate('Product');


		$this->set(compact('productData','categoryData','nameTypeData','itemCategoryData', 'itemTypeData', 'companyData'));

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
									  		'id','name'),
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
				//pr($this->request->data);exit();
				$userData = $this->Session->read('Auth');
			 	$productDetails = $this->request->data;
	        	$this->loadModel('Sales.Product');

	        	$month = date("m"); 
			    $year = date("y");
			    $hour = date("H");
			    $minute = date("i");
			    $seconds = date("s");
			    $random = rand(1000, 10000);

			    $code =  $year. $month .$random;
	        	$productDetails['Product']['uuid'] = $code;

	           if ($this->Product->save($productDetails)) {


	           	 $this->Session->setFlash(__('Products Successfully Added'));

	           	 if (!empty($this->params['named']['redirect_uri'])) {

	           	 		 //$this->redirect(Router::url('/', true).$this->params['url']);

	           	 		 	$this->redirect( array(
	                                     'controller' => $this->params['named']['redirect_uri']['controller'], 
	                                     'action' => $this->params['named']['redirect_uri']['action'],
	                                     !empty( $this->params['named']['redirect_uri']['id'] )	?  $this->params['named']['redirect_uri']['id'] : ''                              
	                             ));
	           	 } else {
	           	 	 $this->redirect( array(
	                                     'controller' => 'products', 
	                                     'action' => 'index',	                              
	                             ));

	           	 }
	            
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
		$itemCategoryData = $this->ItemCategoryHolder->find('list', array(
															'fields' => array('id', 'name'),
															'order' => array('ItemCategoryHolder.name' => 'ASC')
															));
		$itemTypeData = $this->ItemCategoryHolder->ItemTypeHolder->find('list', array(
															'fields' => array('id', 'name'),
															'order' => array('ItemTypeHolder.name' => 'ASC')
															));
		$productData = $this->ItemCategoryHolder->ItemTypeHolder->find('list', array(
															'fields' => array('id', 'name'),
															'order' => array('ItemTypeHolder.name' => 'ASC')
															));
		$companyData = $this->Company->find('list', array(
															'fields' => array('id', 'company_name'),
															'order' => array('Company.company_name' => 'ASC')
															));
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

		$productData = $this->Product->find('first',array(
			'conditions' => array('id' => $id),
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
		$itemCategoryData = $this->ItemCategoryHolder->find('list', array(
															'fields' => array('id', 'name'),
															'order' => array('ItemCategoryHolder.name' => 'ASC')
															));
		$itemTypeData = $this->ItemCategoryHolder->ItemTypeHolder->find('list', array(
															'fields' => array('id', 'name'),
															'order' => array('ItemTypeHolder.name' => 'ASC')
															));
		$companyData = $this->Company->find('list', array(
															'fields' => array('id', 'company_name'),
															'order' => array('Company.company_name' => 'ASC')
															));
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
											'id', 'name'),
										'order' => array('ItemTypeHolder.name' => 'ASC')
										));

	

		
		echo json_encode($itemdata);

		$this->autoRender = false;
    	
    }

    public function find_contact($itemId = null){

    	$this->layout = false;
    	$this->loadModel('ContactPerson');

		$itemdata = $this->ContactPerson->find('all', array(
										'conditions' => array(
										'ContactPerson.company_id' => $itemId,
										'ContactPerson.firstname NOT' => NULL,
										'ContactPerson.lastname NOT' => NULL,
										), 
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
											'id', 'name'),
											'order' => array('Product.name' => 'ASC')
											));
    	
    	$this->layout = false;

		echo json_encode($productData);

    	
    }

    public function find_dropdown($dropdownId = null){

    	$this->autoRender = false;
    	$this->loadModel('ItemCategoryHolder');
    	$this->loadModel('ItemTypeHolder');

    	if($dropdownId == 1) {
    		$categoryData = $this->GeneralItem->find('list',array(
											'fields' => array(
											'id', 'category_id')));
    		$typeData = $this->GeneralItem->find('list',array(
											'fields' => array(
											'id', 'type_id')));
    		
    	}
    	if($dropdownId == 2) {
    		$categoryData = $this->Substrate->find('list',array(
											'fields' => array(
											'id', 'category_id')));
    		$typeData = $this->Substrate->find('list',array(
											'fields' => array(
											'id', 'type_id')));
    		
    	}
    	if($dropdownId == 3) {
    		$categoryData = $this->CompoundSubstrate->find('list',array(
											'fields' => array(
											'id', 'category_id')));
    		$typeData = $this->Substrate->find('list',array(
											'fields' => array(
											'id', 'type_id')));
    		
    	}
    	if($dropdownId == 4) {
    		$categoryData = $this->CorrugatedPaper->find('list',array(
											'fields' => array(
											'id', 'category_id')));
    		$typeData = $this->Substrate->find('list',array(
											'fields' => array(
											'id', 'type_id')));
    		
    	}
    
    	$categData =  array_flip($categoryData);
    	$typData =  array_flip($typeData);

		$flipCategData = array_flip($categData);
		$flipTypData = array_flip($typData);


		$categoryName = $this->ItemCategoryHolder->find('all',
											array('fields' => 
												array('ItemCategoryHolder.id',
												 	'ItemCategoryHolder.name'),
												'conditions' => array(
													'ItemCategoryHolder.id' => $flipCategData)
												));
		$TypeName = $this->ItemTypeHolder->find('all',
											array('fields' => 
												array('ItemTypeHolder.id',
												 	'ItemTypeHolder.name'),
												'conditions' => array(
													'ItemTypeHolder.id' => $flipTypData)
												));

		$cat['CategoryName'] = $categoryName;
		$typ['TypeName'] = $TypeName;
		$allData = array_merge($cat,$typ);
    	// pr($allData);exit();
    	$this->layout = false;

		echo json_encode($allData);

    }

    public function find_process(){

    	$this->autoRender = false;

    	$processData = $this->Process->find('all',
											array('fields' => 
												array('Process.id',
												 	'Process.name'
												 )
												));

    	$this->layout = false;

		echo json_encode($processData);
    }

    public function find_checkbox($processId = null){

    	$this->autoRender = false;

    	$this->Process->bind(array('SubProcess'));

    	$checkData = $this->Process->SubProcess->find('all',
											array('fields' => 
												array('SubProcess.id',
												 	'SubProcess.name'
												 ),
												'conditions' => array(
													'SubProcess.process_id' => $processId
												),
												));
  
    	$this->layout = false;

		echo json_encode($checkData);
    }

    public function label($varCounter,$realName){

    	$this->set(compact('varCounter','realName'));
		$this->render('label');

    }

    public function part($varCounter,$quantitySpec,$itemgroupName,$dynamicId,$category,$item,$counterData){

    	$this->loadModel('Unit');

		 //set to cache in first load
		$unitData = Cache::read('unitData');
		
		if (!$unitData) {
			
			$unitData = $this->Unit->find('list', array('fields' => array('id', 'unit'),
															'order' => array('Unit.unit' => 'ASC')
															));

            Cache::write('unitData', $unitData);
        }
    	$this->set(compact('unitData','varCounter','quantitySpec','itemgroupName','dynamicId','category','item','counterData'));
		$this->render('part');
		
    }

    public function process($process,$dynamicId){

    	$processData = $this->Process->find('list',
											array('fields' => 
												array('Process.id',
												 	'Process.name'
												 )
												));
    	$this->set(compact('process','dynamicId','processData'));
		$this->render('process');

    }

    public function specification($productId = null ){

    	$this->loadModel('ItemCategoryHolder');

        $this->loadModel('ItemTypeHolder');

        $this->loadModel('Company');

        $this->loadModel('Sales.ProductSpecificationDetail');

        $this->loadModel('Sales.ProductSpecificationLabel');

		$this->loadModel('Sales.Product');

		$this->loadModel('Sales.ProductSpecification');
		
		$this->loadModel('Unit');

		$this->loadModel('SubProcess');

		$subProcess = $this->SubProcess->find('list',
											array('fields' => 
												array('SubProcess.id',
												 	'SubProcess.name'
												 )
												));
		
		$processData = $this->Process->find('list',
											array('fields' => 
												array('Process.id',
												 	'Process.name'
												 )
												));

		// $this->
		//set to cache in first load
		$unitData = Cache::read('unitData');
		
		if (!$unitData) {
			
			$unitData = $this->Unit->find('list', array('fields' => array('id', 'unit'),
															'order' => array('Unit.unit' => 'ASC')
															));

            Cache::write('unitData', $unitData);
        }
       
		$this->Product->recursive = 1;

		$product = $this->request->data =  $this->Product->findById($productId);
		
		$specs = $this->ProductSpecification->find('first',array('conditions' => array('ProductSpecification.product_id' => $productId)));
		
		//find if product has specs
		$formatDataSpecs = $this->ProductSpecificationDetail->findData($product['Product']['uuid']);

		$this->request->data['Company'] = $this->Company->read(null,$product['Product']['company_id'])['Company'];

		$productData = $this->Product->find('all',array(
    		'order' => array('Product.id DESC')));	

		$this->set(compact('subProcess','processData','specs','formatDataSpecs','unitData','product','productData','categoryData','nameTypeData','itemCategoryData', 'itemTypeData', 'companyData'));

		if(!empty($formatDataSpecs)){
			$this->render('specification_edit');
		}

    }

    public function find_product_details($itemGroupId = null,$dynamicId){
    	
    	//$this->autoRender = false;
    	
    	if($itemGroupId == 1) {
    		$ModelName = 'GeneralItem';
    		$searchedProduct = $this->GeneralItem->find('all',array(
											'order' => 'GeneralItem.name ASC',
											'limit' => 10
											));
    		
    	}
    	if($itemGroupId == 2) {
    		$ModelName = 'Substrate';
    		$searchedProduct = $this->Substrate->find('all',array(
    										'order' => 'Substrate.name ASC',
    										'limit' => 10
											));
    		
    	}
    	if($itemGroupId == 3) {
    		$ModelName = 'CompoundSubstrate';
    		$searchedProduct = $this->CompoundSubstrate->find('all',array(
											'order' => 'CompoundSubstrate.name ASC',
											'limit' => 10
											));
    		
    	}
    	if($itemGroupId == 4) {
    		$ModelName = 'CorrugatedPaper';
    		$searchedProduct = $this->CorrugatedPaper->find('all',array(
											'order' => 'CorrugatedPaper.name ASC',
											'limit' => 10
											));
    		
    	}
    	//pr($searchedProduct);
    	$this->set(compact('searchedProduct','ModelName','dynamicId'));

    	$this->render('find_product_details');
		
    }

    public function unit_dropdown(){

    	$this->autoRender = false;

    	$this->loadModel('Unit');

    	$unitData = $this->Unit->find('all',array('fields' => array('id','unit')));

    	$this->layout = false;

		echo json_encode($unitData);
    }
    public function product_search($itemGroupId = null, $searchHint = null ,$dynamicId) {

    	//$this->bind->GeneralItem('ItemCategoryHolder','ItemTypeHolder');

    	if($itemGroupId == 1) {
    		$ModelName = 'GeneralItem';
    		$categoryData = $this->GeneralItem->find('all',array(
												'conditions' => array(
        										'GeneralItem.name LIKE' => '%' . $searchHint . '%',
        										 )));
    	}
    	if($itemGroupId == 2) {
    		$ModelName = 'Substrate';
    		$categoryData = $this->Substrate->find('all',array(
												'conditions' => array(
        										'Substrate.name LIKE' => '%' . $searchHint . '%',
        										 )));
    	}
    	if($itemGroupId == 3) {
    		$ModelName = 'CompoundSubstrate';
    		$categoryData = $this->CompoundSubstrate->find('all',array(
												'conditions' => array(
        										'CompoundSubstrate.name LIKE' => '%' . $searchHint . '%',
        										 )));
    	}
    	if($itemGroupId == 4) {
    		$ModelName = 'CorrugatedPaper';
    		$categoryData = $this->CorrugatedPaper->find('all',array(
												'conditions' => array(
        										'CorrugatedPaper.name LIKE' => '%' . $searchHint . '%',
        										 )));
    	}

    	// foreach ($categoryData as $key => $list) {    		
    	// 	$categoryData[$key][$ModelName]['name'] = utf8_encode($list[$ModelName]['name']);    		
    	// }
    	//pr($categoryData);exit();
    	$this->set(compact('categoryData','ModelName','dynamicId'));
		$this->render('product_search');

    }

    public function create_specification($productId){

    	$userData = $this->Session->read('Auth');

    	$this->loadModel('Sales.ProductSpecificationDetail');

    	$this->loadModel('Sales.ProductSpecificationLabel');

    	$this->loadModel('Sales.ProductSpecificationPart');

    	$this->loadModel('Sales.ProductSpecificationProcess');

    	$this->loadModel('Sales.Product');

    	$this->loadModel('Sales.ProductSpecificationProcessHolder');

    	$this->Product->bind(array('Sales.ProductSpecificationDetail','Sales.ProductSpecification'));

    	$this->ProductSpecificationDetail->bind(array('Sales.ProductSpecificationLabel','Sales.ProductSpecificationPart','Sales.ProductSpecificationProcess'));
		
		if (!empty($this->request->data)) {
			
			if(!empty($this->request->data['IdHolder'])){
				
				$this->Product->ProductSpecification->delete($this->request->data['ProductSpecification']['id']);
				$this->ProductSpecificationLabel->deleteData($this->request->data['IdHolder']);
				$this->ProductSpecificationPart->deleteData($this->request->data['IdHolder']);
				$this->ProductSpecificationProcess->deleteData($this->request->data['IdHolder']);
				$this->ProductSpecificationProcessHolder->deleteData($this->request->data['IdHolder']);
				$this->ProductSpecificationDetail->deleteData($this->request->data['IdHolder']);
			}
			
			$specId = $this->Product->ProductSpecification->saveSpec($this->request->data,$userData['User']['id']);
			
			$labelArray = array();
			$partArray = array();
			$processArray = array();
			foreach ($this->request->data['ProductSpecificationDetail'] as $key => $value) {
				
				if($value == 'Label'){
					array_push($labelArray, $key);
				}
				if($value == 'Part'){
					array_push($partArray, $key);
				}
				if($value == 'Process'){
					array_push($processArray, $key);
				}
			}

			foreach ($this->request->data['ProductSpecificationLabel'] as $key => $value) {
				$this->request->data['ProductSpecificationLabel'][$key]['order'] = $labelArray[$key];
			}

			foreach ($this->request->data['ProductSpecificationPart'] as $key => $value) {
				$this->request->data['ProductSpecificationPart'][$key]['order'] = $partArray[$key];
			}

			foreach ($this->request->data['ProductSpecificationProcess'] as $key => $value) {
				$this->request->data['ProductSpecificationProcess'][$key]['order'] = $processArray[$key];
			}

			$getIds = [];

			$thisLabelIds = $this->ProductSpecificationLabel->saveLabel($this->request->data,$userData['User']['id'],$specId);
			$getIds = array_merge($getIds,$thisLabelIds);
			
			$thisPartIds = $this->ProductSpecificationPart->savePart($this->request->data,$userData['User']['id'],$specId);
			$getIds = array_merge($getIds,$thisPartIds);
			
			$thisProcessIds = $this->ProductSpecificationProcess->saveProcess($this->request->data,$userData['User']['id'],$specId);
			$getIds = array_merge($getIds,$thisProcessIds);

			$saveArray = array();

			foreach ($this->request->data['ProductSpecificationDetail'] as $key => $data) {
				$newdata = split('-', $getIds[$key]);
				
				$saveArray[$key]['ProductSpecificationDetail']['model'] = $newdata[2];
				$saveArray[$key]['ProductSpecificationDetail']['order'] = $newdata[1];
				$saveArray[$key]['ProductSpecificationDetail']['foreign_key'] = $newdata[0];

			}
			
			$this->ProductSpecificationDetail->saveSpecDetail($saveArray,$userData['User']['id'],$this->request->data['Product']['uuid']);
			
			$this->Session->setFlash(
                __('Product specification successfully completed', 'success')
            );
			return $this->redirect(array('controller' => 'products', 'action' => 'index'));
			
			
		}

    }

    public function print_specs($productUuid = null){

    	$userData = $this->Session->read('Auth');

    	$this->loadModel('Sales.ProductSpecification');

    	$this->loadModel('Sales.ProductSpecificationDetail');

    	$this->loadModel('Sales.Company');

    	$this->loadModel('Unit');

    	$productData = $this->Product->find('first',array(
    		'conditions' => array('Product.uuid' => $productUuid)));

    	$specs = $this->ProductSpecification->find('first',array('conditions' => array('ProductSpecification.product_id' => $productData['Product']['id'])));

    	//find if product has specs
		$formatDataSpecs = $this->ProductSpecificationDetail->findData($productUuid);

		$this->loadModel('SubProcess');

		$subProcess = $this->SubProcess->find('list',
											array('fields' => 
												array('SubProcess.id',
												 	'SubProcess.name'
												 )
												));

		//set to cache in first load
		$companyData = Cache::read('companyData');
		
		//if (!$companyData) {
			$companyData = $this->Company->find('list', array(
     											'fields' => array( 
     												'id','company_name')
     										));

            Cache::write('companyData', $companyData);
       	// }

        //set to cache in first load
		$unitData = Cache::read('unitData');
		
		if (!$unitData) {
			
			$unitData = $this->Unit->find('list', array('fields' => array('id', 'unit'),
															'order' => array('Unit.unit' => 'ASC')
															));

            Cache::write('unitData', $unitData);
        }
		
    	$view = new View(null, false);
		//pr($formatDataSpecs);exit();
		$view->set(compact('formatDataSpecs','productData','specs','companyData','unitData','subProcess'));
        
		$view->viewPath = 'Products'.DS.'pdf';	
   
        $output = $view->render('print_specs', false);
   	
        $dompdf = new DOMPDF();
        $dompdf->set_paper("A4");
        $dompdf->load_html(utf8_decode($output), Configure::read('App.encoding'));
        $dompdf->render();
        $canvas = $dompdf->get_canvas();
        $font = Font_Metrics::get_font("helvetica", "bold");
        $canvas->page_text(16, 800, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, array(0,0,0));

        $output = $dompdf->output();
        $random = rand(0, 1000000) . '-' . time();
        if (empty($filename)) {
        	//$filename = 'product-'.$quotation['ProductDetail']['name'].'-quotation'.time();
        	$filename = 'product-'.$productUuid.'-specification'.time();
        }
      	$filePath = 'view_pdf/'.strtolower(Inflector::slug( $filename , '-')).'.pdf';
        $file_to_save = WWW_ROOT .DS. $filePath;
        	
        if ($dompdf->stream( $file_to_save, array( 'Attachment'=>0 ) )) {
        		unlink($file_to_save);
        }
        
        exit();
    }

}