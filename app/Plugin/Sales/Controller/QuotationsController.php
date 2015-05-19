<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');
App::uses('CakeEmail', 'Network/Email');
App::import('Vendor', 'DOMPDF', true, array(), 'dompdf'.DS.'dompdf_config.inc.php', false);
App::import('Vendor','acl/Role');




class QuotationsController extends SalesAppController {

	public $uses = array('Sales.Quotation');
	public $helpers = array('Sales.Country','Sales.Status','Cache','Sales.DateFormat');
	public $useDbConfig = array('koufu_system');

	public $cacheAction = array(
        //'index' => '1 hour',
        //'view'	=> '1 hour'
    );

	public function beforeFilter() {

        parent::beforeFilter();

        $userData = $this->Session->read('Auth');

        $this->Auth->allow('add','index');

        $this->set(compact('userData'));

    }
	
	public function index() {
		
		$this->loadModel('Sales.Company');

		$this->loadModel('RolesPermission');

		$this->loadModel('Permission');

		$this->loadModel('Role');

		$this->loadModel('User');

		$userData = $this->Session->read('Auth');

		// $this->RolesPermission->bind(array('Role', 'Permission'));
		
		$rolesPermissionData = $this->RolesPermission->find('list', array(
														'fields' => array('RolesPermission.id', 'RolesPermission.permission_id'),
														'conditions' => array( 
															'RolesPermission.role_id' => $userData['User']['role_id'])
													));

		$this->Quotation->bind(array('Inquiry','QuotationDetail','QuotationItemDetail','ProductDetail', 'Product'));

		$limit = 10;

		$conditions = array();

		$this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'fields' => array(
            	'Quotation.id',
            	'Quotation.uuid', 
            	'Quotation.name',
            	'Quotation.inquiry_id',
            	'Quotation.validity',
            	'Quotation.status',
            	'Quotation.company_id',
            	'Product.name'

            ),
            'order' => 'Quotation.id DESC',
            'group' => 'Quotation.id'
        );

        $quotationData = $this->paginate('Quotation');

		$this->Company->bind(array('Inquiry'));

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
		$inquiryId = Cache::read('inquiryId');

		//if (!$inquiryId) {
			$inquiryId = $this->Company->Inquiry->find('list', array(
     													'fields' => array(
     														'id','company_id')
     													));

            Cache::write('inquiryId', $inquiryId);
       // }
		
		$this->set(compact('companyData','quotationData','inquiryId','salesStatus','rolesPermissionData'));

	}

	public function create($inquiryId = null) {

		$userData = $this->Session->read('Auth');

		$this->loadModel('Sales.PaymentTermHolder');

		$this->loadModel('ItemCategoryHolder');

		$this->loadModel('Sales.ContactPerson');

		$this->loadModel('Unit');

		$this->loadModel('Currency');

		$this->loadModel('Sales.Company');

		//set to cache in first load
		$itemCategoryData = Cache::read('itemCategoryData');

		if (!$itemCategoryData) {

			$itemCategoryData = $this->ItemCategoryHolder->find('list', array(
															'fields' => array('id', 'name'),
															'order' => array('ItemCategoryHolder.name' => 'ASC')
															));

            Cache::write('itemCategoryData', $itemCategoryData);
        }

		$this->Company->bind(array('Contact','Email','Address','ContactPerson'));

		//set to cache in first load


		$companyData = Cache::read('companyData');

		// if (!$companyData) {

			$companyData = $this->Company->find('list', array(
     											'fields' => array( 'id','company_name'),
     											'order' => array('Company.company_name' => 'ASC')
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


		   //set to cache in first load
		$currencyData = Cache::read('currencyData');
		
		//if (!$currencyData) {

			$currencyData = $this->Currency->find('list', array('fields' => array('id', 'name'),
															'order' => array('Currency.name' => 'ASC')
															));

            Cache::write('currencyData', $currencyData);
       // }

        //set to cache in first load
		$paymentTermData = Cache::read('paymentTerms');
		
		if (!$paymentTermData) {
            $paymentTermData = $this->PaymentTermHolder->getList(null,array('id','name'));
            Cache::write('paymentTerms', $paymentTermData);
        }

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

			 $userData = $this->Session->read('Auth');
		}

		$this->set(compact('category','inquiryId','companyData','customField','itemCategoryData','paymentTermData','unitData','currencyData'));
		
	}

	public function add() {

		$userData = $this->Session->read('Auth');
		
		$this->Quotation->bind(array('QuotationDetail','QuotationItemDetail'));

		if ($this->request->is(array('post','put'))) {

            if (!empty($this->request->data)) {

            	if (!empty($this->request->data['submit']) && $this->request->data['submit'] == 'Save as Draft') {
            			$this->request->data['Quotation']['status'] = 'draft';	
            			}
           		
				if(!empty($this->request->data['Inquiry']['id'])){
            			$this->loadModel('Sales.Company');
            			$this->Company->bind(array('Inquiry'));
            			
            			$inquiryId = $this->request->data['Inquiry']['id'];

            			$inquiryCompanyId = $this->Company->Inquiry->find('first', array(
														  		  		'conditions' => array(
														  		  			'Inquiry.id' => $this->request->data['Inquiry']['id'])
																));
            			
            			$this->request->data['Quotation']['inquiry_id'] = $inquiryId;

            			$this->request->data['Quotation']['company_id'] = $inquiryCompanyId['Inquiry']['company_id'];
						
						$this->id = $this->Quotation->addQuotation($this->request->data, $userData['User']['id']);

            			$this->Quotation->bind(array('Inquiry','QuotationDetail','QuotationItemDetail','ProductDetail'));
            			
            			$this->Quotation->QuotationDetail->addQuotationDetail($this->request->data, $userData['User']['id'], $this->id);

            			$this->Quotation->QuotationItemDetail->addQuotationItemDetail($this->request->data, $this->id);
         		
            	}else{

            			
            			if(!empty($this->request->data['Company']['id'])){
            				$companyId = $this->request->data['Company']['id'];
            			}else{
            				$companyId = $this->request->data['Quotation']['company_id'];
            			}
            			
            			$this->request->data['Quotation']['company_id'] = $companyId;

            		
            			$this->id = $this->Quotation->addQuotation($this->request->data, $userData['User']['id']);

            			$this->Quotation->bind(array('Inquiry','QuotationDetail','QuotationItemDetail','ProductDetail'));
            			
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

	public function add2() {

		$userData = $this->Session->read('Auth');
		
		$this->Quotation->bind(array('QuotationDetail','QuotationItemDetail'));

		if ($this->request->is(array('post','put'))) {

            if (!empty($this->request->data)) {
           

            	if(!empty($this->request->data['Inquiry']['id'])){

            		echo "ddd";
            		
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

            			echo "tt";

            			$this->Quotation->bind(array('Inquiry','QuotationDetail','QuotationItemDetail','ProductDetail'));

            			//pr($this->request->data); exit;

            			//$companyId = $this->request->data['Company']['id'];

            			//pr($companyId);

            			//$this->request->data['Quotation']['company_id'] = $companyId;

            			//echo 'before the method clal';
            			$this->id = $this->Quotation->addQuotation($this->request->data, $userData['User']['id']);

            			$QuotationDetail = ClassRegistry::init('Sales.QuotationDetail');
            			$QuotationItemDetail = ClassRegistry::init('Sales.QuotationItemDetail');


            			$QuotationDetail->addQuotationDetail($this->request->data, $userData['User']['id'], $this->id);

            			$QuotationItemDetail->addQuotationItemDetail($this->request->data, $this->id);
            		

            	}
            	
            	$this->Session->setFlash(__('Quotation Complete.'));

            	$this->redirect(
                    array('controller' => 'quotations', 'action' => 'index')
                );
            	
            }
        }
	}

	public function view($quotationId,$companyId){

		$this->loadModel('Sales.PaymentTermHolder');
		
		$this->loadModel('Sales.Company');
		
		$this->loadModel('Currency');
		
		$this->loadModel('Unit');
		
		$this->loadModel('Sales.ContactPerson');

		$this->loadModel('RolesPermission');

		$this->loadModel('User');

		

		$userData = $this->User->read(null,$this->Session->read('Auth.User.id'));

		//start///call Role permission
		$actionName = 'View Quotation';
		$this->_rolePermission($actionName);
		//end///call Role permission

		$this->loadModel('User');

		

		$rolesPermissionData = $this->RolesPermission->find('list', array(
														'conditions' => array( 
															'RolesPermission.role_id' => $userData['User']['role_id'])
													));
		

		$paymentTerm = Cache::read('paymentTerms');
		
		if (!$paymentTerm) {
            $paymentTerm = $this->PaymentTermHolder->getList(null,array('id','name'));
            Cache::write('paymentTerms', $paymentTerm);
        }

		$this->Company->bind(array('Address','Contact','Email','Inquiry','ContactPerson','Quotation'));

		//set to cache in first load
		$companyData = Cache::read('companyData');
		
		if (!$companyData) {
			
			$companyData = $this->Company->find('list', array(
     											'fields' => array( 
     												'id','company_name')
     										));

            Cache::write('companyData', $companyData);
        }


        //set to cache in first load
		$inquiryId = Cache::read('inquiryId');
		
		if (!$inquiryId) {
			
			$inquiryId = $this->Company->Inquiry->find('list', array(
     													'fields' => array(
     														'company_id')
     													));

            Cache::write('inquiryId', $inquiryId);
        }

		
		$currencies = $this->Currency->getList();

		$units = $this->Unit->getList();
	
		$this->ContactPerson->bind(array('Email'));

		$contactInfo = $this->ContactPerson->find('first', array(
																'conditions' => array( 
																	'ContactPerson.company_id' => $companyId 
																)
															));
		
		$this->Quotation->bind(array('QuotationDetail',
			'QuotationItemDetail',
			'ClientOrder',
			'ProductDetail', 
			'Product',
			'ContactPerson',
			'Approver' => array('fields' => array('user_id')),
			'ContactPersonEmail' => array('fields' => array('email'))
			));
		
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
		$approverId = $this->Quotation->Approver->find('list',array('conditions' => array('Approver.foreign_key' => $quotationId),'fields' => array('id','user_id')));
		
		$approvedUser = $this->User->find('first', array(
									'conditions' => array(
										'User.id' => $approverId ),
									'fields' => array(
										'User.id','User.first_name','User.last_name')
								));

		$user = $this->User->find('first', array(
									'conditions' => array(
										'User.id' => $userData['User']['id'] )
								));
		
		$this->set(compact('approvedUser','units','currencies','paymentTerm','companyData','companyId', 'quotationSize', 'quotationOption','quotation','inquiryId','user','contactInfo','quotationFieldInfo','field','salesStatus', 'productName','clientOrderCount','quotationDetailData', 'rolesPermissionData'));
		
	}

	public function approved($quotationId = null){

		$this->loadModel('User');
		$userData = $this->User->read(null,$this->Session->read('Auth.User.id'));

		//start///call Role permission
		$actionName = 'Approve Quotation';
		$this->_rolePermission($actionName);
		//end///call Role permission

		$this->loadModel('Sales.Approver');

		$this->Approver->approverData($quotationId,$userData['User']['id']);

		$this->Quotation->approvedData($quotationId);

		$this->Session->setFlash(__('Quotation Approved.'));
    	$this->redirect(
            array('controller' => 'quotations', 'action' => 'index')
        );

	}

	public function print_word($quotationId = null,$companyId = null) {
		
		//$this->layout = 'pdf';

		$this->loadModel('Sales.Company');

		$this->loadModel('Sales.PaymentTermHolder');

		// Configure::write('debug',2);

		$userData = $this->Session->read('Auth');

		// $userData = $this->Session->read('Auth');
		$this->Company->bind(array('Address','Contact','Email','Inquiry','Quotation'));

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

		$paymentTerm = Cache::read('paymentTerms');
		
		if (!$paymentTerm) {
            $paymentTerm = $this->PaymentTermHolder->getList(null,array('id','name'));
            Cache::write('paymentTerms', $paymentTerm);
        }

		$this->loadModel('Currency');
		$currencies = $this->Currency->getList();

		$this->loadModel('Unit');
		$units = $this->Unit->getList();



		$this->Quotation->bind(array('QuotationDetail',
							'QuotationItemDetail',
							'ClientOrder',
							'ProductDetail',
							'ContactPerson',
							'Product',
							'Approver' => array('fields' => array('user_id'))
							));

		$quotation = $this->Quotation->find('first', array(
														'conditions' => array( 
															'Quotation.id' => $quotationId)
													));

	
		$quotationDetailData = $this->Quotation->ClientOrder->find('first', array(
														'conditions' => array( 
															'ClientOrder.quotation_id' => $quotationId)
													));
		$this->loadModel('User');
		$approverId = $this->Quotation->Approver->find('list',array('conditions' => array('Approver.foreign_key' => $quotationId),'fields' => array('id','user_id')));
		
		$approvedUser = $this->User->find('first', array(
									'conditions' => array(
										'User.id' => $approverId ),
									'fields' => array(
										'User.id','User.first_name','User.last_name')
								));

		$user = ClassRegistry::init('User')->find('first', array(
									'conditions' => array(
										'User.id' => $userData['User']['id'] )
								));
		$view = new View(null, false);
		//$this->set(compact('companyData','currencies','units','quotation','inquiryId','user','contactInfo','quotationFieldInfo','field','productName','user','quotationDetailData'));
		
		$view->set(compact('paymentTerm','approvedUser','companyData','units','currencies','quotation','inquiryId','user','contactInfo','quotationFieldInfo','field','productName','user','quotationDetailData'));
        
		
		$view->viewPath = 'Quotations'.DS.'pdf';	
   
        $output = $view->render('print_word', false);
   	
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
        	$filename = 'product-'.$quotation['ProductDetail']['name'].'-quotation'.time();
        }
      	$filePath = 'view_pdf/'.strtolower(Inflector::slug( $filename , '-')).'.pdf';
        $file_to_save = WWW_ROOT .DS. $filePath;
        	
        if ($dompdf->stream( $file_to_save, array( 'Attachment'=>0 ) )) {
        		unlink($file_to_save);
        }
        
        exit();
        

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

	public function edit($quotationId = null,$companyId = null){
		
		$this->loadModel('User');
		$userData = $this->User->read(null,$this->Session->read('Auth.User.id'));

		//start///call Role permission
		$actionName = 'Edit Quotation';
		$this->_rolePermission($actionName);
		//end///call Role permission

		$this->loadModel('PaymentTermHolder');

		$this->loadModel('ItemCategoryHolder');

		$this->loadModel('ItemTypeHolder');

		$this->loadModel('Sales.Product');

		$this->loadModel('Unit');

		$this->loadModel('Currency');
		
		$this->loadModel('Sales.Company');

		$this->Quotation->bind(array('QuotationItemDetail'));

		$itemDetailData = $this->Quotation->QuotationItemDetail->find('all',
														array('conditions' => 
														array('QuotationItemDetail.quotation_id' => $quotationId)));

		$unitData = $this->Unit->find('list', array(
												'fields' => array('id', 'unit'),
												'order' => array('Unit.unit' => 'ASC')
												));

		$currencyData = $this->Currency->find('list', array(
												'fields' => array('id', 'name'),
												'order' => array('Currency.name' => 'ASC')
												));

		$userData = $this->Session->read('Auth');
			
		$itemCategoryData = $this->ItemCategoryHolder->find('list', array(
															'fields' => array('id', 'name'),
															'order' => array('ItemCategoryHolder.name' => 'ASC')
															));

		$itemTypeData = $this->ItemTypeHolder->find('first', array(
															//'conditions' => array('ItemTypeHolder.item_category_holder_id' => 'ItemCategoryHolder.id'),
															'fields' => array('id', 'name'),
															'order' => array('ItemTypeHolder.name' => 'ASC')
															));

		$paymentTermData = $this->PaymentTermHolder->find('list', array(
															'fields' => array('id', 'name'),
															'order' => array('PaymentTermHolder.name' => 'ASC')
															));

		$productData = $this->Product->find('list', array(
															'fields' => array('id', 'name'),
															//'conditions' => array('Product.id' => 'QuotationDetail.product_id'),
															'order' => array('Product.name' => 'ASC')
															));

		if(!empty($quotationId)){
			$this->Quotation->bind(array('QuotationDetail','QuotationItemDetail'));
			//$this->request->data = $this->Quotation->read(null,$quotationId);

			$userData = $this->Session->read('Auth');

			$this->Company->bind(array('Contact','Email','Address','ContactPerson'));

			$companyData = $this->Company->find('list', array(
															'fields' => array('id', 'company_name'),
															'order' => array('Company.company_name' => 'ASC')
															));

			$post = $this->Quotation->findById($quotationId);

		            if (!$post) {
		                throw new NotFoundException(__('Invalid post'));
		            }

		            
		            if ($this->request->is(array('post', 'put'))) {
		                $this->Quotation->id = $quotationId;
		                $this->Quotation->QuotationDetail->quotation_id = $quotationId;
		                $this->Quotation->QuotationItemDetail->quotation_id = $quotationId;

		               // pr($this->request->data); exit;

		                if ($this->Quotation->save($this->request->data)) {
		                    $this->Quotation->save($this->request->data);
		              		$this->Quotation->QuotationDetail->save($this->request->data, $userData['User']['id'], $this->id);
            				$this->Quotation->QuotationItemDetail->save($this->request->data, $this->id);	
		                    $this->Session->setFlash(__('Quotation has been updated.'));
		                    return $this->redirect(array('action' => 'view'));
		                }
		                $this->Session->setFlash(__('Unable to update your post.'));
		            }

		            if (!$this->request->data) {
		                $this->request->data = $post;
		            }
		
		     }

		    // pr($productData); exit;
		$this->set(compact('itemDetailData','unitData','currencyData','companyData','customField','itemCategoryData', 'paymentTermData','itemTypeData','productData'));
	}

		//pr($this->request->data);

	

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

	public function drafts($id = null) {

		  if (!$id) {
		                throw new NotFoundException(__('Quotation Not Found'));
		 } else {
		 	$this->Quotation->id = $id;
		 	if( $this->Quotation->saveField('status', 'draft') ) {
		 		$this->Session->setFlash(__('Quotation Save as Draft.'));

		 	} else {
		 		$this->Session->setFlash(__('Error updating Quotation.'));

		 	}
		 	$this->redirect(
            array('controller' => 'quotations', 'action' => 'index')
        	);
			//$this->Quotation->update()
		 }

	}

	public function send_email($dest=null,$qouteId = null,$companyId = null){

		if (!empty($this->request->data)) {

			$qouteId = $this->request->data['Quotation']['id'];
			$companyId = $this->request->data['Quotation']['company_id'];

			if (!empty($this->request->data['Quotation']['emails'])) {

				$email_cc = explode(',',$this->request->data['Quotation']['emails']);

				$valid_email_cc = array();

				foreach ($email_cc as $key => $email) {
					if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
						$valid_email_cc[] = $email;
					}

				}
		}
		$to = $this->request->data['Quotation']['to'];
	
		if (!empty($this->request->data['Quotation']['to']) && !filter_var($to, FILTER_VALIDATE_EMAIL) === false)  {
			
			$email = new CakeEmail('mandrill');

			$email->from(Configure::read('defaultEmail'));

			$email->to($to);
			if (!empty($valid_email_cc)) {

				$email->cc($valid_email_cc);
			}
			
			$email->subject($this->request->data['Quotation']['subject']);

		
			$filename =  $this->request->data['Quotation']['pdf'];
			$attachment = $this->_createPdf($qouteId,$companyId,$filename);

			if ($attachment ) {

					$email->attachments(array($attachment));
					
					$message = $this->request->data['Quotation']['message'];
					 
					$email->viewVars(compact('message'));

                    $email->template('simple_message');

                    if (isset($template)) {
                         $Email->template($template);
                    }

                    $email->emailFormat('html');
					
					$email->send();

					$file = new File(WWW_ROOT . DS . $attachment);
					
					$file->delete();
					
					$this->Session->setFlash(__('Quotation Successfully send.'),'success');
					
					} else {

						$this->Session->setFlash(__('Sending emails failed, Please try again'),'error');
					}
			}
			else {
				$this->Session->setFlash(__('Sending emails failed, Please use valid email address'),'error');
			}
		}
		return $this->redirect(array('controller' => 'quotations','action' => 'view',$qouteId,$companyId));
		
	}

	private function _createPdf($quotationId = null,$companyId = null, $filename = null) {

        $view = new View(null, false);

		$userData = $this->Session->read('Auth');

		$this->loadModel('Sales.Company');
		$this->loadModel('Sales.PaymentTermHolder');
		// $userData = $this->Session->read('Auth');
		$this->Company->bind(array('Address','Contact','Email','Inquiry','Quotation'));

		$paymentTerm = Cache::read('paymentTerms');
		
		if (!$paymentTerm) {
            $paymentTerm = $this->PaymentTermHolder->getList(null,array('id','name'));
            Cache::write('paymentTerms', $paymentTerm);
        }

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

		$this->loadModel('Currency');
		$currencies = $this->Currency->getList();
	
		$this->loadModel('Unit');
		$units = $this->Unit->getList();

		$this->Quotation->bind(array('QuotationDetail',
					'QuotationItemDetail',
					'ClientOrder',
					'ProductDetail',
					'ContactPerson',
					'Product',
					'Approver' => array('fields' => array('user_id'))
					));

		$quotation = $this->Quotation->find('first', array(
														'conditions' => array( 
															'Quotation.id' => $quotationId)
													));

		$quotationDetailData = $this->Quotation->ClientOrder->find('first', array(
														'conditions' => array( 
															'ClientOrder.quotation_id' => $quotationId)
													));

		$this->loadModel('User');

		$approverId = $this->Quotation->Approver->find('list',array('conditions' => array('Approver.foreign_key' => $quotationId),'fields' => array('id','user_id')));
		
		$approvedUser = $this->User->find('first', array(
									'conditions' => array(
										'User.id' => $approverId ),
									'fields' => array(
										'User.id','User.first_name','User.last_name')
								));

		$user = ClassRegistry::init('User')->find('first', array(
									'conditions' => array(
										'User.id' => $userData['User']['id'] )
								));
	

 		$view->set(compact('paymentTerm','approvedUser','companyData','units','currencies','quotation','inquiryId','user','contactInfo','quotationFieldInfo','field','productName','user','quotationDetailData'));
        
       	$view->viewPath = 'Quotations'.DS.'pdf';	
   
        $output = $view->render('print_word', false);
   	
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
        	$filename = 'product-'.$quotation['ProductDetail']['name'].'-quotation'.time();
        }
      	$filePath = 'pdf/'.Inflector::slug( $filename , '-').'.pdf';
        $file_to_save = WWW_ROOT .'/'. $filePath;
        
        file_put_contents($file_to_save, $output);

        return $filePath;

    }

    private function _rolePermission($pagePermissionName = null){

    	//start// this method is for the permission of all user.. bienskie//
    	$this->loadModel('User');

		$userData = $this->User->read(null,$this->Session->read('Auth.User.id'));

		$this->loadModel('Permission');

		//***if ever needed****
		// $permissionData = $this->Permission->find('list',array('fields' => array('id','name')));
		// $permissionArray = array();
		// foreach ($permissionData as $key => $permName) {
		// 	array_push($permissionArray, $permName);
		// }
		// if (in_array($pagePerm, $permissionArray)) {
		//     $confirm=1;
		// }
		//*********************bienskie

		$checkRole = new Role();
		
		$hasPermission = $checkRole->getRolePerms($userData['User']['role_id']);

		$confirm = 0;
		
		foreach ($hasPermission as $key => $pagePerm) {
			
			if($pagePerm == $pagePermissionName){
				
				$confirm=1;
			}

		}
		
		if($confirm == 0){

			$this->Session->setFlash(__('You dont have permission to access this module.'),'error');

	    	$this->redirect(
	            array('controller' => 'quotations', 'action' => 'index')
	        );
		} 
		//end// this method is for the permission of all user.. bienskie//

    }
}