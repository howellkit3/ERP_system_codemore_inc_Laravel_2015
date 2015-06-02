<?php
	App::uses('AppController', 'Controller');
	App::uses('SessionComponent', 'Controller/Component');

	class CreateOrderController extends SalesAppController {

		public function beforeFilter() {

	        parent::beforeFilter();

	        $this->Auth->allow('add','index');

	        $this->loadModel('User');
	        $userData = $this->User->read(null,$this->Session->read('Auth.User.id'));//$this->Session->read('Auth');
	        $this->set(compact('userData'));

	    }
	    
		public $uses = array('Sales.QuotationOption','Sales.Quotation','Sales.Company','Sales.CreateOrder','Sales.SalesOrder','Sales.ClientOrder');

		public function add($quotationId = null, $salesOrderId = null){

			$quotationData = $this->Quotation->find('first', array(
													'conditions' => array(
														'id' => $quotationId
													)
												));
			

			$companyData = $this->Company->find('first', array(
													'conditions' => array(
														'id' => $quotationData['Quotation']['company_id']
													)
												));

			$this->set(compact('count','first','quotationData','companyData'));
		}

		public function get_quotation_options(){

			$data = $this->QuotationOption->find('all', array(
													'conditions' => array(
														'custom_fields_id' => array('3','4','6'),
														'position' => $this->request->data['position'],
														'quotation_id' => $this->request->data['quotation']
												)
											));
			$this->set(compact('data'));
		}

		public function insert(){
			$userData = $this->Session->read('Auth');
			if ($this->request->is('post')) {
				//pr();die;
				 if (!empty($this->request->data)) {
				 	$this->CreateOrder->saveOrder($this->request->data, $userData['User']['id']);
				 	$this->QuotationOption->updateOptions($this->request->data, $userData['User']['id']);
				 	$this->Quotation->approvedData($this->request->data['CreateOrder']['quotationId']);
				 	$this->SalesOrder->approvedData($this->request->data['CreateOrder']['quotationId'], $userData['User']['id'] );
				 	$this->Session->setFlash(__('Successfully Created Order.'));
	    			$this->redirect(
	            		array('controller' => 'sales_orders', 'action' => 'index')
	       			 );

				 }
			}
		}

		public function index($quotationId = null, $uuid = null){

			$this->loadModel('PaymentTermHolder');

			$this->loadModel('Sales.ContactPerson');

			$this->loadModel('Currency');
			
			$this->loadModel('Unit');

			$month = date("m"); 
		    $year = date("y");
		    $hour = date("H");
		    $minute = date("i");
		    $seconds = date("s");
		    $random = rand(1000, 10000);
		        
			$code =  $year. $month .$random;

			$currencies = $this->Currency->getList();

			$units = $this->Unit->getList();

			$paymentTerm = $this->PaymentTermHolder->find('list',array('fields' => array('id','name')));

			$this->Quotation->bind(array('QuotationItemDetail','QuotationDetailOrder','ContactPerson'));

			$quotationData = $this->Quotation->findById($quotationId);

			$this->Company->bind(array('Address' => array('fields' => array('id','address1','address2'))));

			$companyData = $this->Company->find('first', array(
													'conditions' => array('Company.id' => $quotationData['Quotation']['company_id'])
												));

			$productData = $this->Company->Product->find('first',array('fields' => array('id','name'),
											'conditions' => array('id' => $quotationData['QuotationDetailOrder'][0]['product_id'])));
			//pr($productData);exit();
			$this->set(compact('quotationData','companyData','paymentTerm','productData','currencies','units','code'));
		}

		public function find_item_detail($itemDetailId = null){

			$this->Quotation->bind(array('QuotationItemDetail'));

			$itemDetail = $this->Quotation->QuotationItemDetail->find('first',array('conditions' => array('QuotationItemDetail.id' => $itemDetailId)));

			echo json_encode($itemDetail);

			$this->autoRender = false;
		}

		public function order_create(){

			$userData = $this->Session->read('Auth');

			$this->loadModel('Ticket.JobTicket');

			$this->loadModel('Sales.ProductSpecification');
		
			if ($this->request->is('post')) {

	            if (!empty($this->request->data)) {
	            	
	            	$this->ClientOrder->bind(array('ClientOrderDeliverySchedule','ClientOrderItemDetail'));

	            	$clientOrderId = $this->ClientOrder->saveClientOrder($this->request->data, $userData['User']['id']);
	            	
	            	$this->ClientOrder->ClientOrderDeliverySchedule->saveClientOrderDeliverySchedule($this->request->data, $userData['User']['id'], $clientOrderId);
	            		
	            	$checkSpec = $this->ProductSpecification->find('first',array(
	            										'conditions' => array(
	            											'ProductSpecification.product_id' => 
	            													$this->request->data['Product']['id'])));

	            	if(empty($checkSpec)){

	            		$checkSpec = 0;
	      		
	            	}else{

	            		$checkSpec = 1;
	            		$this->JobTicket->saveTicket($this->request->data, $userData['User']['id'], $clientOrderId);
	            		
	            	}

	            	$this->Session->setFlash(__('Client Order was successfully added in the system.'));

	    			$this->redirect(
	            		array('controller' => 'create_order', 'action' => 'view_specs',$this->request->data['Product']['id'],$checkSpec,$clientOrderId)
	       			);
	            	
	            	


	            }
	        }
		}

		public function view_specs($productId = null,$ifSpec = null,$clientOrderId = null){

			$this->loadModel('Sales.Product');

			$this->loadModel('Sales.ProductSpecificationDetail');

			$this->loadModel('Unit');

			$this->loadModel('SubProcess');

			$this->loadModel('Process');

			$this->loadModel('Sales.Company');

			$this->loadModel('Sales.ProductSpecification');

			$clientOrderData = $this->ClientOrder->find('first',array('conditions' => array('ClientOrder.id' => $clientOrderId)));

			$subProcess = $this->SubProcess->find('list',
											array('fields' => 
												array('SubProcess.id',
												 	'SubProcess.name'
												 )
												));

			//set to cache in first load
			$unitData = Cache::read('unitData');
			
			if (!$unitData) {
				
				$unitData = $this->Unit->find('list', array('fields' => array('id', 'unit'),
																'order' => array('Unit.unit' => 'ASC')
																));

	            Cache::write('unitData', $unitData);
	        }

	        //set to cache in first load
			$companyData = Cache::read('companyData');
			
			//if (!$companyData) {
				$companyData = $this->Company->find('list', array(
	     											'fields' => array( 
	     												'id','company_name')
	     										));

	            Cache::write('companyData', $companyData);
	       	// }

	        $processData = $this->Process->find('list',
											array('fields' => 
												array('Process.id',
												 	'Process.name'
												 )
												));

			$productData = $this->Product->findById($productId);

			$specs = $this->ProductSpecification->find('first',array('conditions' => array('ProductSpecification.product_id' => $productData['Product']['id'])));
			//find if product has specs
			$formatDataSpecs = $this->ProductSpecificationDetail->findData($productData['Product']['uuid']);

			$this->set(compact('clientOrderData','companyData','processData','specs','productId','productData','clientOrderId','formatDataSpecs','unitData','subProcess'));

			if($ifSpec == 0){
				$this->render('view_specs_check');
			}
		}

		public function create_specs($productId = null, $clientOrderId = null){

			$this->loadModel('ItemCategoryHolder');

	        $this->loadModel('ItemTypeHolder');

	        $this->loadModel('Company');

	        $this->loadModel('Sales.ProductSpecificationDetail');

	        $this->loadModel('Sales.ProductSpecificationLabel');

			$this->loadModel('Sales.Product');

			$this->loadModel('Sales.ProductSpecification');
			
			$this->loadModel('Unit');

			$this->loadModel('SubProcess');

			$this->loadModel('Process');

			$clientOrderData = $this->ClientOrder->find('first',array('conditions' => array('ClientOrder.id' => $clientOrderId)));

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

			//set to cache in first load
			$companyData = Cache::read('companyData');
			
			//if (!$companyData) {
				$companyData = $this->Company->find('list', array(
	     											'fields' => array( 
	     												'id','company_name')
	     										));

	            Cache::write('companyData', $companyData);
	       	// }

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

			$productData = $this->Product->findById($productId);
			
			$specs = $this->ProductSpecification->find('first',array('conditions' => array('ProductSpecification.product_id' => $productId)));
			
			$this->set(compact('productData','clientOrderData','clientOrderId','subProcess','processData','specs','productId','unitData','product','productData','categoryData','nameTypeData','itemCategoryData', 'itemTypeData', 'companyData'));

		}

		public function create_specification(){

			$userData = $this->Session->read('Auth');

	    	$this->loadModel('Sales.ProductSpecificationDetail');

	    	$this->loadModel('Sales.ProductSpecificationLabel');

	    	$this->loadModel('Sales.ProductSpecificationPart');

	    	$this->loadModel('Sales.ProductSpecificationProcess');

	    	$this->loadModel('Sales.Product');

	    	$this->loadModel('Ticket.JobTicket');

	    	$this->loadModel('Sales.ProductSpecificationProcessHolder');

	    	$this->Product->bind(array('Sales.ProductSpecificationDetail','Sales.ProductSpecification'));

	    	$this->ProductSpecificationDetail->bind(array('Sales.ProductSpecificationLabel','Sales.ProductSpecificationPart','Sales.ProductSpecificationProcess'));
			
			if (!empty($this->request->data)) {
				
				$this->JobTicket->saveTicket($this->request->data['JobTicket'],$userData['User']['id'],$this->request->data['JobTicket']['ClientOrder']['id']);
				
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
	                __('Client Order Product specification successfully completed', 'success')
	            );
				return $this->redirect(array('controller' => 'create_order',
											 'action' => 'view_specs',$this->request->data['JobTicket']['Product']['id'],1,$this->request->data['JobTicket']['ClientOrder']['id']));
				
			}
		}


	}
?>
