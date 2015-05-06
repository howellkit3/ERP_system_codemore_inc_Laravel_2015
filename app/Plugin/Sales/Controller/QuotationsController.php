<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');
App::uses('CakeEmail', 'Network/Email');
App::import('Vendor', 'DOMPDF', true, array(), 'dompdf'.DS.'dompdf_config.inc.php', false);


class QuotationsController extends SalesAppController {

	public $uses = array('Sales.Company','Sales.Quotation','Sales.Inquiry','Sales.Product','ContactPerson');
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

		$this->Quotation->bind(array('Inquiry','QuotationDetail','QuotationItemDetail','ProductDetail', 'Product'));

		$limit = 10;

		$conditions = array("OR" => array('Quotation.status NOT' => 'draft','Quotation.status' => NULL));

		if (!empty($this->params['named']['status'])) {

			$conditions = array('Quotation.status' => $this->params['named']['status']);
		}
	
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

		$this->loadModel('PaymentTermHolder');

		$this->loadModel('ItemCategoryHolder');

		$this->loadModel('ContactPerson');

		$this->loadModel('Unit');

		$this->loadModel('Currency');

		$itemCategoryData = $this->ItemCategoryHolder->find('list', array(
															'fields' => array('id', 'name'),
															'order' => array('ItemCategoryHolder.name' => 'ASC')
															));

		$this->Company->bind(array('Contact','Email','Address','ContactPerson'));

		$companyData = $this->Company->find('list', array(
															'fields' => array('id', 'company_name'),
															'order' => array('Company.company_name' => 'ASC')
															));

		$unitData = $this->Unit->find('list', array(
															'fields' => array('id', 'unit'),
															'order' => array('Unit.unit' => 'ASC')
															));

		$currencyData = $this->Currency->find('list', array(
															'fields' => array('id', 'name'),
															'order' => array('Currency.name' => 'ASC')
															));

		$paymentTermData = $this->PaymentTermHolder->find('list', array(
															'fields' => array('id', 'name'),
															'order' => array('PaymentTermHolder.name' => 'ASC')
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
			
			$this->set(compact('company','inquiry'));

		}else{

			$userData = $this->Session->read('Auth');

			$this->Company->bind(array('Contact','Email','Address','ContactPerson'));

			$companyData = $this->Company->find('list', array(
															'fields' => array('id', 'company_name'),
															'order' => array('Company.company_name' => 'ASC')
															));
			$paymentTermData = $this->PaymentTermHolder->find('list', array(
															'fields' => array('id', 'name'),
															'order' => array('PaymentTermHolder.name' => 'ASC')
															));
		}

		$this->set(compact('category','inquiryId','companyData','customField','itemCategoryData','paymentTermData','unitData','currencyData'));
		
	}

	public function add() {

		$userData = $this->Session->read('Auth');
		
		$this->Quotation->bind(array('QuotationDetail','QuotationItemDetail'));

		if ($this->request->is(array('post','put'))) {

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

            			$this->Quotation->bind(array('Inquiry','QuotationDetail','QuotationItemDetail','ProductDetail'));
            			
            			if(!empty($this->request->data['Company']['id'])){
            				$companyId = $this->request->data['Company']['id'];
            			}else{
            				$companyId = $this->request->data['Quotation']['company_id'];
            			}
            			
            			$this->request->data['Quotation']['company_id'] = $companyId;
            		
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

		$userData = $this->Session->read('Auth');

		$this->loadModel('PaymentTermHolder');

		$paymentTerm = $this->PaymentTermHolder->find('list',array('fields' => array('id','name')));

		$this->Company->bind(array('Address','Contact','Email','Inquiry','ContactPerson','Quotation'));



		$companyData = $this->Company->find('list', array(
     											'fields' => array( 
     												'id','company_name')
     										));

		$inquiryId = $this->Company->Inquiry->find('list', array(
     													'fields' => array(
     														'company_id')
     													));
		$this->loadModel('Currency');
		$currencies = $this->Currency->getList();

		$this->loadModel('Unit');
		$units = $this->Unit->getList();

		$this->ContactPerson->bind(array('Email'));

		$contactInfo = $this->ContactPerson->find('first', array(
																'conditions' => array( 
																	'ContactPerson.company_id' => $companyId 
																)
															));
		
		$this->Quotation->bind(array('QuotationDetail','QuotationItemDetail','ClientOrder','ProductDetail', 'Product'));


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

		
		$this->set(compact('units','currencies','paymentTerm','companyData','companyId', 'quotationSize', 'quotationOption','quotation','inquiryId','user','contactInfo','quotationFieldInfo','field','salesStatus', 'productName','clientOrderCount','quotationDetailData'));
		
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

		// Configure::write('debug',2);

		$userData = $this->Session->read('Auth');

		// $userData = $this->Session->read('Auth');
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


		$this->loadModel('Currency');
		$currencies = $this->Currency->getList();

		$this->loadModel('Unit');
		$units = $this->Unit->getList();



		$this->Quotation->bind(array('QuotationDetail','QuotationItemDetail','ClientOrder','ProductDetail'));

		$quotation = $this->Quotation->find('first', array(
														'conditions' => array( 
															'Quotation.id' => $quotationId)
													));

	
		$quotationDetailData = $this->Quotation->ClientOrder->find('first', array(
														'conditions' => array( 
															'ClientOrder.quotation_id' => $quotationId)
													));

		$user = ClassRegistry::init('User')->find('first', array(
									'conditions' => array(
										'User.id' => $userData['User']['id'] )
								));

		
		$this->set(compact('companyData','currencies','units','quotation','inquiryId','user','contactInfo','quotationFieldInfo','field','productName','user','quotationDetailData'));
	

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

		$this->loadModel('PaymentTermHolder');

		$this->loadModel('ItemCategoryHolder');

		$this->loadModel('ItemTypeHolder');

		$this->loadModel('Sales.Product');

		$this->loadModel('Unit');

		$this->loadModel('Currency');

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
		$this->set(compact('unitData','currencyData','companyData','customField','itemCategoryData', 'paymentTermData','itemTypeData','productData'));
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

	public function send_email($dest=null,$qouteId,$companyId){

		$quoteName = $this->Quotation->find('first',array('conditions' => array('Quotation.id' => $qouteId)));

		$email = new CakeEmail('mandrill');

		$email->to(Configure::read('defaultEmail'));

		$email->subject('Quotation form for'.$quoteName['Quotation']['name']);

		$attachment = $this->_createPdf($qouteId,$companyId);
		
		if ($attachment ) {

			$email->attachments(array($attachment));
			$email->send('Quotation send from koufucolorprinting.com');

			$file = new File(WWW_ROOT . DS . $attachment);
			$file->delete();
			$this->Session->setFlash(__('Quotation Successfully send.'));
			} else {

			$this->Session->setFlash(__('Error Sending.'));
		}

		return $this->redirect(array('controller' => 'quotations','action' => 'view',$qouteId,$companyId));
		
	}

	private function _createPdf($quotationId = null,$companyId = null) {

        $view = new View(null, false);

       // $this->layout = 'pdf';

		// Configure::write('debug',2);

		$userData = $this->Session->read('Auth');

		// $userData = $this->Session->read('Auth');
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


		$this->loadModel('Currency');
		$currencies = $this->Currency->getList();

		$this->loadModel('Unit');
		$units = $this->Unit->getList();

		$this->Quotation->bind(array('QuotationDetail','QuotationItemDetail','ClientOrder','ProductDetail'));

		$quotation = $this->Quotation->find('first', array(
														'conditions' => array( 
															'Quotation.id' => $quotationId)
													));

	
		$quotationDetailData = $this->Quotation->ClientOrder->find('first', array(
														'conditions' => array( 
															'ClientOrder.quotation_id' => $quotationId)
													));

		$user = ClassRegistry::init('User')->find('first', array(
									'conditions' => array(
										'User.id' => $userData['User']['id'] )
								));
	

 		$view->set(compact('companyData','units','currencies','quotation','inquiryId','user','contactInfo','quotationFieldInfo','field','productName','user','quotationDetailData'));
        
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
        $filePath = 'pdf/'.$quotation['Quotation']['name'].'-'.time().'.pdf';
        $file_to_save = WWW_ROOT .'/'. $filePath;
        
        file_put_contents($file_to_save, $output);

        return $filePath;

    }
}