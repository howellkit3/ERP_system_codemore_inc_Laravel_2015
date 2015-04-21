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

		$this->Quotation->bind(array('Inquiry','QuotationDetail','QuotationItemDetail','ProductDetail'));

		$quotationData = $this->Quotation->find('all', array('order' => 'Quotation.id DESC','group' => 'Quotation.id'));

		$this->Company->bind(array('Inquiry'));

		$companyData = $this->Company->find('list',array(
     											'fields' => array(
     												'id','company_name')
     										));

		$inquiryId = $this->Company->Inquiry->find('list', array(
     													'fields' => array(
     														'company_id')
     												));



		$this->set(compact('companyData','quotationData','inquiryId','salesStatus'));

	}

	public function create($inquiryId = null) {

		$userData = $this->Session->read('Auth');

		if(!empty($inquiryId)){

			$this->Company->bind(array('Address','Contact','Email','Inquiry'));

			$inquiry = $this->Company->Inquiry->find('first', array(
		        										'conditions' => array(
		        											'Inquiry.id' => $inquiryId)
		    										));
			
		    $company = $this->Company->find('first', array(
		        'conditions' => array('Company.id' => $inquiry['Inquiry']['company_id'])
		    ));
			
			$this->set(compact('company','inquiry'));

		}else{

		
		
			$this->loadModel('ItemCategoryHolder');
			
			$itemCategoryData = $this->ItemCategoryHolder->find('list');

			$userData = $this->Session->read('Auth');

			$this->Company->bind(array('Contact','Email','Address','ContactPerson'));

			$companyData = $this->Company->find('list', array('fields' => array('id', 'company_name')));

			$this->set(compact('companyData','customField','itemCategoryData'));
		}

		$this->set(compact('category','inquiryId'));
		
	}

	public function add() {

		$userData = $this->Session->read('Auth');
		
		$this->Quotation->bind(array('QuotationDetail','QuotationItemDetail'));

		if ($this->request->is('post')) {

            if (!empty($this->request->data)) {
            	
            	if(!empty($this->request->data['Inquiry']['id'])){
            		
            		$this->Company->bind(array('Inquiry'));

            			$inquiryId = $this->request->data['Inquiry']['id'];

            			$inquiryCompanyId = $this->Company->Inquiry->find('first', array(
														  		  		'conditions' => array(
														  		  			'Inquiry.id' => $this->request->data['Inquiry']['id'])
																));
            			
            			$this->request->data['Quotation']['inquiry_id'] = $inquiryId;

            			$this->request->data['Quotation']['company_id'] = $inquiryCompanyId['Inquiry']['company_id'];

            			$this->id = $this->Quotation->addQuotation($this->request->data, $userData['User']['id']);

            			$this->Quotation->QuotationDetail->addQuotationDetail($this->request->data, $userData['User']['id'], $this->id);

            			$this->Quotation->QuotationItemDetail->addQuotationItemDetail($this->request->data, $this->id);

            		

            		
            	}else{


            			$companyId = $this->request->data['Company']['id'];

            			$this->request->data['Quotation']['company_id'] = $companyId;

            			$this->id = $this->Quotation->addQuotation($this->request->data, $userData['User']['id']);

            			$this->Quotation->QuotationDetail->addQuotationDetail($this->request->data, $userData['User']['id'], $this->id);

            			$this->Quotation->QuotationItemDetail->addQuotationItemDetail($this->request->data, $this->id);

            	}
            	
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
		$this->Quotation->bind(array('QuotationDetail','QuotationItemDetail','ClientOrder','ProductDetail'));

		$quotation = $this->Quotation->find('first', array(
														'conditions' => array( 
															'Quotation.id' => $quotationId)
													));

	
		$quotationDetailData = $this->Quotation->ClientOrder->find('first', array(
														'conditions' => array( 
															'ClientOrder.quotation_id' => $quotationId)
													));

		
		 if(!empty($clientOrder['ClientOrder'])) {

			$clientOrderCount = count($clientOrder['ClientOrder']['quotation_id']);
			
		} else {

			$clientOrderCount = 0;
		} 

		
		$this->loadModel('User');
		$user = $this->User->find('first', array(
									'conditions' => array(
										'User.id' => $userData['User']['id'] )
								));
		
		$this->set(compact('companyData','companyId', 'quotationSize', 'quotationOption','quotation','inquiryId','user','contactInfo','quotationFieldInfo','field','salesStatus', 'productName','clientOrderCount','quotationDetailData'));
		
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
        $this->Quotation->bind(array('QuotationItemDetail','QuotationDetail'));
        $users = $this->Quotation->find('all', array(
            'conditions' => array(
            'Quotation.uuid LIKE' => '%' . $_GET['term'] . '%',
            )));
        echo json_encode($this->_encode($users));
    }
    private function _encode($postData) {
        $temp = array();
        foreach ($postData as $user) {
            array_push($temp, array(
            'id' => $user['Quotation']['id'],
            'label' => $user['Quotation']['uuid'],
            'value' => $user['Quotation']['uuid'],
            ));
        }
        return $temp;
    }

    public function search(){

    	$userData = $this->Session->read('Auth');

  		$params = array(
						'keyword' =>$this->request->query('q'),
				  );

		$this->Quotation->bind(array('QuotationItemDetail','QuotationDetail'));

		$quotationData = $this->Quotation->find('all', array('conditions' => array('Quotation.uuid' => $params)));
		

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
			$cond=array( 'OR'=>array("Quotation.uuid LIKE '%$keyword%'")  );
		} else {
			$cond=array();
		}
		$quotationUniqueId = $this->Quotation->find('all',array('fields'=> array('Quotation.uuid'),'conditions' => $cond ));
		

		foreach ($quotationUniqueId as $json) {
			$data[] = array(
						'value' => $json['Quotation']['uuid'],
						 'label' => $json['Quotation']['uuid']
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