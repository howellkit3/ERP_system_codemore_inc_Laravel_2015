<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class QuotationsController extends SalesAppController {

	public $uses = array('Sales.Company','Sales.Quotation','Sales.Inquiry','Sales.Product');
	public $helper = array('Sales.Country');
	public $useDbConfig = array('koufu_system');

	public function beforeFilter() {

        parent::beforeFilter();

        $userData = $this->Session->read('Auth');

        $this->Auth->allow('add','index');

        $this->set(compact('userData'));

    }
	    	    
	public function index() {

		$userData = $this->Session->read('Auth');

		$this->Quotation->bind(array('Product','QuotationField'));
		$quotationData = $this->Quotation->find('all', array('order' => 'Quotation.id DESC'));
		

		$this->Company->bind(array('Inquiry'));

		$inquiryId = $this->Company->Inquiry->find('list', array(
     													'fields' => array(
     														'company_id')
     												));
	
	 	$companyData = $this->Company->find('list',array(
     											'fields' => array(
     												'id','company_name')
     										));

	 	$this->loadModel('Sales.SalesOrder');

	 	$salesStatus = $this->SalesOrder->find('list',array('fields' => array('quotation_id','id')));

		$this->set(compact('companyData','quotationData','inquiryId','salesStatus'));

	}

	public function create($inquiryId = null) {



		$userData = $this->Session->read('Auth');
		$this->loadModel('Sales.CustomField');

		$customField = $this->CustomField->find('list', array(
													'fields' => array('id', 'fieldlabel'),
													'conditions' => array(
														'id NOT' => array('2','3','4','5','6')
														)
													));

		$this->loadModel('Sales.ItemCategory');
		$this->ItemCategory->bind(array('ItemType'));
		$category = $this->ItemCategory->find('list', array(
												'fields' => array(
											 		'id','category_name'),
												'conditions' => array(
													'status' => 'active')
											));

		if(!empty($inquiryId)){

			$this->Company->bind(array('Address','Contact','Email','Inquiry'));

			$inquiry = $this->Company->Inquiry->find('first', array(
		        										'conditions' => array(
		        											'Inquiry.id' => $inquiryId)
		    										));
			
		    $company = $this->Company->find('first', array(
		        'conditions' => array('Company.id' => $inquiry['Inquiry']['company_id'])
		    ));
			
			$this->set(compact('company','inquiry','customField'));

		}else{

			$userData = $this->Session->read('Auth');

			$this->Company->bind(array('Contact','Email','Address','ContactPerson'));

			$companyData = $this->Company->find('list', array('fields' => array('id', 'company_name')));

			$this->set(compact('companyData','customField'));
		}
		$this->set(compact('category'));
		
	}

	public function add() {

		$userData = $this->Session->read('Auth');
		
		$this->Quotation->bind(array('QuotationField'));

		if ($this->request->is('post')) {
			//pr($this->request->data);die;
			

            if (!empty($this->request->data)) {


            	if(!empty($this->request->data['Inquiry']['id'])){
            	
            		if(!empty($this->request->data['Quotation']['product'])){
            			$this->Company->bind(array('Inquiry'));
		            	$bindData = $this->Company->Inquiry->find('first', array(
														  		  		'conditions' => array(
														  		  			'Inquiry.id' => $this->request->data['Inquiry']['id'])
																));

		            	$companyName = $this->Company->find('first', array(
		            											'conditions' => array(
		            													'id' => $bindData['Inquiry']['company_id'])
		            									));


		            	
	            		$inquiryId = $this->request->data['Inquiry']['id'];
	            		$quotationId = $this->Quotation->addInquiryQuotation($this->request->data['Quotation'],$userData['User']['id'],$inquiryId);

	            		$quotationUniqueId = $this->Quotation->find('first', array(
	            														'conditions' => array(
	            															'product_id' => $this->request->data['Quotation']['product'])
	            													));
	            			
            		}
            		else{

            			$this->Company->bind(array('Inquiry'));
		            	$bindData = $this->Company->Inquiry->find('first', array(
														  		  		'conditions' => array(
														  		  			'Inquiry.id' => $this->request->data['Inquiry']['id'])
																));

		            	$companyName = $this->Company->find('first', array(
		            											'conditions' => array(
		            													'id' => $bindData['Inquiry']['company_id'])
		            									));
		            	$productDetails= array($companyName['Company']['id'],$this->request->data['Quotation']['txtproduct']);
		            	
	             		$productId = $this->Product->addQuotationProduct($productDetails, $userData['User']['id']);

	            		$inquiryId = $this->request->data['Inquiry']['id'];
	            		$quotationId = $this->Quotation->addNewInquiryQuotation($productId, $userData['User']['id'], $inquiryId);

	            		$quotationUniqueId = $this->Quotation->find('first', array(
	            														'conditions' => array(
	            															'product_id' => $this->request->data['Quotation']['product'])
	            													));

            		}

            		
            	}else{

            		if(!empty($this->request->data['Quotation']['product'])){

            			$companyId = $this->request->data['Company']['id'];
	            		$companyName = $this->Company->find('first', array(
		            											'conditions' => array(
		            												'id' =>$this->request->data['Company']['id'])
		            									));

	            		$quotationId = $this->Quotation->addCompanyQuotation($this->request->data['Quotation'],$userData['User']['id'],$companyId);
	            		$quotationUniqueId = $this->Quotation->find('first', array(
	            														'conditions' => array(
	            															'product_id' => $this->request->data['Quotation']['product'])
	            													));

            		}
            		else{
            			$companyId = $this->request->data['Company']['id'];
            			$productDetails= array($this->request->data['Company']['id'],$this->request->data['Quotation']['txtproduct']);
            			
	             		$productId = $this->Product->addQuotationProduct($productDetails, $userData['User']['id']);
	             		

	             		$quotationId = $this->Quotation->addNewCompanyQuotation($productId, $userData['User']['id'], $productDetails);
	            		$quotationUniqueId = $this->Quotation->find('first', array(
	            														'conditions' => array(
	            															'product_id' => $productId)
	            													));

            		
            		}


            		
					
            	}



            	$this->Quotation->bind(array('QuotationField'));

            	$this->Quotation->QuotationField->saveQuotationField($this->request->data, $quotationId,$userData['User']['id']);
            	
            	
            	$this->Session->setFlash(__('Quotation Complete.'));
            	$this->redirect(
                    array('controller' => 'quotations', 'action' => 'index')
                );
            	
            }
        }
	}

	public function view($quotationId,$companyId){

		$userData = $this->Session->read('Auth');

		$this->Company->bind(array('Address','Contact','Email','Inquiry','ContactPerson','Quotation'));

		$quotation = $this->Company->Quotation->find('first', array(
														'conditions' => array( 
															'Quotation.id' => $quotationId)
													));

		$companyData = $this->Company->find('list', array(
     											'fields' => array( 
     												'id','company_name')
     										));

		$inquiryId = $this->Company->Inquiry->find('list', array(
     													'fields' => array(
     														'company_id')
     													));

		$contactInfo = $this->Company->ContactPerson->find('first', array(
																'conditions' => array( 
																	'ContactPerson.company_id' => $companyId 
																)
															));

		$this->Quotation->bind(array('QuotationField','SalesOrder','Product'));

		$salesStatus = $this->Quotation->SalesOrder->find('first',array('conditions' => array('SalesOrder.quotation_id' => $quotationId)));

		$quotationFieldInfo = $this->Quotation->QuotationField->find('all', array(
																		'conditions' => array( 
																			'QuotationField.quotation_id' => $quotationId 
																			)
																		));
		
		

		$this->Quotation->QuotationField->bind(array('CustomField'));

		$customField = $this->Quotation->QuotationField->CustomField->find('all', array(
														'fields' => array(
															'id', 'fieldlabel')
														
														));


		$customValue = $this->Quotation->QuotationField->find('list', array(
																	'fields' =>array(
																		'custom_fields_id','description'),
																	'conditions' => array(
																		'quotation_id' => $quotationId

																	)
																));
		

		

		$field = $this->Quotation->QuotationField->CustomField->find('list', array(
																		'fields' => array(
																			'id','fieldlabel')
																	));
		
		$this->loadModel('User');
		$user = $this->User->find('first', array(
									'conditions' => array(
										'User.id' => $userData['User']['id'] )
								));
		
		$this->Quotation->bind(array('Product'));

		$productName = $this->Quotation->find('first', array(
													'conditions' => array(
														'Quotation.id' => $quotationId
														)
													));
		
		$this->set(compact('companyData','companyId', 'customField', 'customValue',
			'quotation','inquiryId','user','contactInfo',
			'quotationFieldInfo','field','salesStatus', 'productName'));
		
	}

	public function approved($quotationId = null){

		$this->Quotation->approvedData($quotationId);

		$this->Session->setFlash(__('Quotation Approved.'));
    	$this->redirect(
            array('controller' => 'quotations', 'action' => 'index')
        );

	}

	public function print_word($quotationId = null,$companyId = null) {

		$this->layout = 'pdf';

		Configure::write('debug',2);

		$userData = $this->Session->read('Auth');

		$userData = $this->Session->read('Auth');

		$this->Quotation->bind(array('Product'));
		$productName = $this->Quotation->find('first', array(
													'conditions' => array(
														'Quotation.id' => $quotationId
														)
													));

		$this->Company->bind(array('Address','Contact','Email','Inquiry','ContactPerson','Quotation'));

		$quotation = $this->Company->Quotation->find('first', array(
														'conditions' => array('
																Quotation.id' => $quotationId)
														));

		$companyData = $this->Company->find('list',array(
     											'fields' => array('id','company_name')
     										));

		$inquiryId = $this->Company->Inquiry->find('list',array(
     													'fields' => array('company_id')
     												));

		$contactInfo = $this->Company->ContactPerson->find('first',array(
																'conditions' => array(
																	'ContactPerson.company_id' => $companyId )
															));

		$this->Quotation->bind(array('QuotationField'));

		$quotationFieldInfo = $this->Quotation->QuotationField->find('all',array(
																		'conditions' => array(
																			'QuotationField.quotation_id' => $quotationId )
																	));

		$this->Quotation->QuotationField->bind(array('CustomField'));

		$field = $this->Quotation->QuotationField->CustomField->find('list',array(
																		'fields' => array('id','fieldlabel')
																	));
		
		$this->loadModel('User');
		$user = $this->User->find('first',array(
										'conditions' => array(
											'User.id' => $userData['User']['id'] )
									));

		$this->set(compact('companyData','quotation','inquiryId','user','contactInfo','quotationFieldInfo','field','productName'));
	

	}

	public function delete($quotationId = null){

		$this->Quotation->bind(array('QuotationField','SalesOrder'));

		$this->Quotation->SalesOrder->deleteSalesOrder($quotationId);

		$quotationData = $this->Quotation->QuotationField->find('all', array(
																	'conditions' => array(
																		'QuotationField.quotation_id' => $quotationId)
																));

		$this->Quotation->QuotationField->deleteQuoteFields($quotationId);

		$this->Quotation->delete($quotationId);
		
		$this->Session->setFlash(__('Quotation Deleted.'));

    	$this->redirect(
			array('controller' => 'quotations', 'action' => 'index')
		);
		
	}

	public function create_order($quotationId = null,$uniqueId = null){

		$userData = $this->Session->read('Auth');

		$this->Quotation->bind(array('SalesOrder'));
		
		$this->Quotation->SalesOrder->approvedData($quotationId,$userData['User']['id']);

		$this->loadModel('Ticket.Ticket');

		$this->Ticket->saveUniqueId($uniqueId,$userData['User']['id']);
		
		$this->redirect(
            array('controller' => 'sales_orders', 'action' => 'index')
        );
	}

	public function edit($quotationId = null , $companyId){
		if($this->request->is('post')){
			$this->Quotation->edit($this->request->data,$quotationId);
			$this->redirect(array('controller' => 'quotations', 'action' => 'view',$quotationId,$companyId)
        	);
		}
		
		$this->Company->bind(array(
			'Address',
			'Contact',
			'Email'
		));

		$company = $this->Company->find('first', array(
	        								'conditions' => array(
	        									'Company.id' => $companyId)
	    								));

	    $this->Quotation->bind(array('QuotationField'));

	    $quotation = $this->Quotation->find('first', array(
	        									'conditions' => array(
	        										'Quotation.id' => $quotationId)
	   										 ));

	    $this->Quotation->bind(array('Product'));
		$productName = $this->Quotation->find('first', array(
													'conditions' => array(
														'Quotation.id' => $quotationId
														)
													));
		//pr($productName);die;

	   	$this->loadModel('Sales.CustomField');
		$customField = $this->CustomField->find('list', array('fields' => array('id', 'fieldlabel')));
	   
		if (!$this->request->data) {

	        $this->request->data = am($company,$quotation);
	        
	    }
	    $this->set(compact('customField','quotationId','companyId','productName'));
	}

	// public function auto_complete() {
	// 	$this->Quotation->bind(array('QuotationField'));
 //        $terms = $this->Quotation->find('all', array(
 //            'conditions' => array(
 //                'Quotation.unique_id LIKE' => $this->params['url']['autoCompleteText'].'%'
 //            ),
 //            'fields' => array('unique_id'),
 //            'limit' => 3,
 //            'recursive'=>-1,
 //        ));
 //        $uniqueId = Set::Extract($terms,'{n}.Quotation.unique_id');
 //        $this->set('uniqueId', $terms);
 //        $this->layout = 'ajax';    
 //    } 

	public function autoComplete() {
        $this->autoRender = false;
        $this->Quotation->bind(array('QuotationField'));
        $users = $this->Quotation->find('all', array(
            'conditions' => array(
            'Quotation.unique_id LIKE' => '%' . $_GET['term'] . '%',
            )));
        echo json_encode($this->_encode($users));
    }
    private function _encode($postData) {
        $temp = array();
        foreach ($postData as $user) {
            array_push($temp, array(
            'id' => $user['Quotation']['id'],
            'label' => $user['Quotation']['unique_id'],
            'value' => $user['Quotation']['unique_id'],
            ));
        }
        return $temp;
    }

    public function search(){

    	$userData = $this->Session->read('Auth');

  		$params = array(
						'keyword' =>$this->request->query('q'),
				  );

		$this->Quotation->bind(array('Product','QuotationField'));

		$quotationData = $this->Quotation->find('all', array('conditions' => array('Quotation.unique_id' => $params)));
		

		$this->Company->bind(array('Inquiry'));

		$inquiryId = $this->Company->Inquiry->find('list', array(
     													'fields' => array(
     														'company_id')
     												));
	
	 	$companyData = $this->Company->find('list',array(
     											'fields' => array(
     												'id','company_name')
     										));

	 	$this->loadModel('Sales.SalesOrder');

	 	$salesStatus = $this->SalesOrder->find('list',array('fields' => array('quotation_id','id')));

		$this->set(compact('companyData','quotationData','inquiryId','salesStatus'));

		
		
		
		
	}

	public function ajax_search(){
		
		$this->autoRender = false; 
	    $this->request->onlyAllow('ajax');
		
		$keyword = $this->request->query('term');
		
		if ( !empty($keyword) ){
			$cond=array( 'OR'=>array("Quotation.unique_id LIKE '%$keyword%'")  );
		} else {
			$cond=array();
		}
		$quotationUniqueId = $this->Quotation->find('all',array('fields'=> array('Quotation.unique_id'),'conditions' => $cond ));
		

		foreach ($quotationUniqueId as $json) {
			$data[] = array(
						'value' => $json['Quotation']['unique_id'],
						 'label' => $json['Quotation']['unique_id']
					);
		}

		return json_encode($data);
	}

	public function status($id = null ,$quotationId = null){

		$this->Quotation->updateStatus($id,$quotationId);
		$this->redirect(
            array('controller' => 'quotations', 'action' => 'index')
        );
	}
}