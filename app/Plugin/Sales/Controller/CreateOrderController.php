<?php
	App::uses('AppController', 'Controller');
	App::uses('SessionComponent', 'Controller/Component');

	class CreateOrderController extends SalesAppController {


		public $helpers = array('Sales.DateFormat');


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
		    $day = date("d");
		    $seconds = date("s");
		   
		    $timestamp = strtotime(date('h:i:s'));  
		    $code = $year . $month. substr($timestamp, 4); 

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
			$noPermission = ' '; 

			$this->set(compact('noPermission','quotationData','companyData','paymentTerm','productData','currencies','units','code'));
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

			$this->loadModel('Sales.QuotationItemDetail');

			//pr($this->request->data); exit;
			
			$query = $this->request->query;

			if ($this->request->is('post')) {

	            if (!empty($this->request->data)) {


	            	$data = $this->request->data;



	            	$this->ClientOrder->bind(array('ClientOrderDeliverySchedule','ClientOrderItemDetail'));
	            	
	            	if (!empty($query['job_ticket']) && $query['job_ticket'] == '0') {

	            			$this->request->data['ClientOrder']['job_ticket'] = 0;
					}

	            	$clientOrderId = $this->ClientOrder->saveClientOrder($this->request->data, $userData['User']['id']);
	            	
	            	$this->ClientOrder->ClientOrderDeliverySchedule->saveClientOrderDeliverySchedule($this->request->data, $userData['User']['id'], $clientOrderId);
	            		
	            	$specksData =  $checkSpec = $this->ProductSpecification->find('first',array(
	            										'conditions' => array(
	            											'ProductSpecification.product_id' => 
	            													$this->request->data['Product']['id'])));

	            	
	            	if(empty($checkSpec)){

	            		$checkSpec = 0;
	      		
	            	} else {

	            		$checkSpec = 1;


	            		//pr($query);

	            		if (!empty($query['job_ticket']) && $query['job_ticket'] == '1') {

	            			//echo '1';

	            			$this->JobTicket->saveTicket($this->request->data, $userData['User']['id'], $clientOrderId);
	            		}
	            		
	            	}

	            	//exit();



	            	//update quotation details
	            	$quotationDetails = $this->request->data['QuotationItemDetail'];

	            	$this->QuotationItemDetail->save($quotationDetails, array('validate'=>false, 'callbacks'=>false),$userData);


	            	//update productSpecification details
	            	$specificatonDetails = $specksData;
	            	$specificatonDetails['ProductSpecification']['quantity'] = $quotationDetails['quantity'];
	            	

	            	$this->ProductSpecification->save($specificatonDetails, array('validate'=>false, 'callbacks'=>false));


	            	$this->Session->setFlash(__('Client Order was successfully added in the system.'));

	    			$this->redirect(
	            		array('controller' => 'create_order', 'action' => 'view_specs',$data['Product']['id'],$checkSpec,$clientOrderId)
	       			);
	            	
	            	


	            }
	        }
		}

		public function create_ticket($productId = null, $clientOrderId = null, $po_number = null, $productUUID = null){

			$this->loadModel('Ticket.JobTicket');

			$userData = $this->Session->read('Auth');

			$data['Product']['id'] = $productId;
			$data['ClientOrder']['po_number'] = $po_number;

			$jobTicketID = $this->JobTicket->saveTicket($data, $userData['User']['id'], $clientOrderId);

			$this->Session->setFlash(
	                __('Client Order Product specification successfully completed', 'success')
	            );

			return $this->redirect(array('controller' => 'ticketing_systems',
						'action' => 'view',
						$productUUID,
						$jobTicketID,
						$clientOrderId,
						'plugin' => 'ticket'));

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

	        $this->Product->bindProduct();

			$productData = $this->Product->findById($productId);

			//pr($productData); exit();

			$specs = $this->ProductSpecification->find('first',array('conditions' => array('ProductSpecification.product_id' => $productData['Product']['id'])));
			
			//find if product has specs
			$formatDataSpecs = $this->ProductSpecificationDetail->findData($productData['Product']['uuid']);

			$noPermission = ' '; 

			$this->set(compact('noPermission','clientOrderData','companyData','processData','specs','productId','productData','clientOrderId','formatDataSpecs','unitData','subProcess'));

			if($ifSpec == 0){

				$this->render('view_specs_check');
			
			}
		}

		public function create_specs($productId = null, $clientOrderId = null){

			$this->loadModel('ItemCategoryHolder');

	        $this->loadModel('ItemTypeHolder');

	        $this->loadModel('Company');

	        $this->loadModel('Sales.ProductSpecificationDetail');

	        $this->loadModel('Sales.ProductSpecificationComponent');

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
			
			$noPermission = "";

			$this->set(compact('productData','clientOrderData','clientOrderId','subProcess','processData','specs','productId','unitData','product','productData','categoryData','nameTypeData','itemCategoryData', 'itemTypeData', 'companyData', 'noPermission'));

		}

		public function create_specificationsdfasdf(){

			$userData = $this->Session->read('Auth');

	    	$this->loadModel('Sales.ProductSpecificationDetail');

	    	$this->loadModel('Sales.ProductSpecificationComponent');

	    	$this->loadModel('Sales.ProductSpecificationPart');

	    	$this->loadModel('Sales.ProductSpecificationProcess');

	    	$this->loadModel('Sales.Product');

	    	$this->loadModel('Ticket.JobTicket');

	    	$this->loadModel('Sales.ProductSpecificationProcessHolder');

	    	$this->Product->bind(array('Sales.ProductSpecificationDetail','Sales.ProductSpecification'));

	    	$this->ProductSpecificationDetail->bind(array('Sales.ProductSpecificationComponent','Sales.ProductSpecificationPart','Sales.ProductSpecificationProcess'));
			
			if (!empty($this->request->data)) {
				// pr($this->request->data);exit();
				$this->JobTicket->saveTicket($this->request->data['JobTicket'],$userData['User']['id'],$this->request->data['JobTicket']['ClientOrder']['id']);
				
				if(!empty($this->request->data['IdHolder'])){
					
					$this->Product->ProductSpecification->delete($this->request->data['ProductSpecification']['id']);
					$this->ProductSpecificationComponent->deleteData($this->request->data['IdHolder']);
					$this->ProductSpecificationPart->deleteData($this->request->data['IdHolder']);
					$this->ProductSpecificationProcess->deleteData($this->request->data['IdHolder']);
					$this->ProductSpecificationProcessHolder->deleteData($this->request->data['IdHolder']);
					$this->ProductSpecificationDetail->deleteData($this->request->data['IdHolder']);
				}
				
				$specId = $this->Product->ProductSpecification->saveSpec($this->request->data,$userData['User']['id']);
				
				$componentArray = array();
				$partArray = array();
				$processArray = array();
				foreach ($this->request->data['ProductSpecificationDetail'] as $key => $value) {
					
					if($value == 'Component'){
						array_push($componentArray, $key);
					}
					if($value == 'Part'){
						array_push($partArray, $key);
					}
					if($value == 'Process'){
						array_push($processArray, $key);
					}
				}

				foreach ($this->request->data['ProductSpecificationComponent'] as $key => $value) {
					$this->request->data['ProductSpecificationComponent'][$key]['order'] = $componentArray[$key];
				}

				foreach ($this->request->data['ProductSpecificationPart'] as $key => $value) {
					$this->request->data['ProductSpecificationPart'][$key]['order'] = $partArray[$key];
				}

				foreach ($this->request->data['ProductSpecificationProcess'] as $key => $value) {
					$this->request->data['ProductSpecificationProcess'][$key]['order'] = $processArray[$key];
				}

				$getIds = array();

				$thisComponentIds = $this->ProductSpecificationComponent->saveComponent($this->request->data,$userData['User']['id'],$specId);
				$getIds = array_merge($getIds,$thisComponentIds);
				
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

		public function create_specification(){

	    	$userData = $this->Session->read('Auth');

	    	$this->loadModel('Sales.ProductSpecificationDetail');

	    	$this->loadModel('Sales.ProductSpecificationMainPanel');

	    	$this->loadModel('Sales.ProductSpecificationComponent');

	    	$this->loadModel('Sales.ProductSpecificationPart');

	    	$this->loadModel('Sales.ProductSpecificationProcess');

	    	$this->loadModel('Sales.Product');

	    	$this->loadModel('Ticket.JobTicket');

	    	$this->loadModel('Sales.ProductSpecificationProcessHolder');

	    	$this->Product->bind(array('Sales.ProductSpecificationDetail','Sales.ProductSpecification'));

	    	$this->ProductSpecificationDetail->bind(array('Sales.ProductSpecificationComponent','Sales.ProductSpecificationPart','Sales.ProductSpecificationProcess'));
					
			if (!empty($this->request->data)) {
				
				$this->JobTicket->saveTicket($this->request->data['JobTicket'],$userData['User']['id'],$this->request->data['JobTicket']['ClientOrder']['id']);
				
                                if(!empty($this->request->data['IdHolder'])){
					
					$this->Product->ProductSpecification->delete($this->request->data['ProductSpecification']['id']);
					$this->ProductSpecificationComponent->deleteData($this->request->data['IdHolder']);
					$this->ProductSpecificationPart->deleteData($this->request->data['IdHolder']);
					$this->ProductSpecificationProcess->deleteData($this->request->data['IdHolder']);
					$this->ProductSpecificationProcessHolder->deleteData($this->request->data['IdHolder']);
					$this->ProductSpecificationDetail->deleteData($this->request->data['IdHolder']);
				}
				

				$specId = $this->Product->ProductSpecification->saveSpec($this->request->data,$userData['User']['id']);
				
				//$mainPanelArray = array();
				$componentArray = array();
				$partArray = array();
				$processArray = array();
				if (!empty($this->request->data['ProductSpecificationDetail'])) {
				
					foreach ($this->request->data['ProductSpecificationDetail'] as $key => $value) {
						
						// if($value == 'MainPanel'){
						// 	array_push($mainPanelArray, $key);
						// }
						if($value == 'Component'){
							array_push($componentArray, $key);
						}
						if($value == 'Part'){
							array_push($partArray, $key);
						}
						if($value == 'Process'){
							array_push($processArray, $key);
						}
					}
				}
				
				// if (isset($this->request->data['ProductSpecificationMainPanel'])) {
					
				// 	$mainPanelData['ProductSpecificationMainPanel'] = array_values($this->request->data['ProductSpecificationMainPanel']);
					
				// 	foreach ($mainPanelData['ProductSpecificationMainPanel'] as $key => $value) {
						
				// 		$mainPanelData['ProductSpecificationMainPanel'][$key] = $value;
				// 		$mainPanelData['ProductSpecificationMainPanel'][$key]['order'] = $mainPanelArray[$key];
						
				// 	}
				// 	$mainPanelData['Product'] = $this->request->data['Product']['id'];
					
				// }
				
				if (isset($this->request->data['ProductSpecificationComponent'])) {
					
					$componentData['ProductSpecificationComponent'] = array_values($this->request->data['ProductSpecificationComponent']);
					
					foreach ($componentData['ProductSpecificationComponent'] as $key => $value) {
						
						$componentData['ProductSpecificationComponent'][$key] = $value;
						$componentData['ProductSpecificationComponent'][$key]['order'] = $componentArray[$key];
						
					}
					$componentData['Product'] = $this->request->data['Product']['id'];
					
				}
				
				if (isset($this->request->data['ProductSpecificationPart'])) {

					$partData['ProductSpecificationPart'] = array_values($this->request->data['ProductSpecificationPart']);
					
					foreach ($partData['ProductSpecificationPart'] as $key => $value) {
						
						if (isset($partArray[$key])) {
							
							$partData['ProductSpecificationPart'][$key] = $value;
							$partData['ProductSpecificationPart'][$key]['order'] = $partArray[$key];
							
						}
						
					}
					$partData['Product'] = $this->request->data['Product']['id'];
					
				}
				
				if (!empty($this->request->data['ProductSpecificationProcess'])) {

					$processData['ProductSpecificationProcess'] = array_values($this->request->data['ProductSpecificationProcess']);
					
					foreach ($processData['ProductSpecificationProcess'] as $key => $value) {

						if (isset($processArray[$key])) {
							$processData['ProductSpecificationProcess'][$key] = $value;
							$processData['ProductSpecificationProcess'][$key]['order'] = $processArray[$key];
						}
					}
					$processData['Product'] = $this->request->data['Product']['id'];

				}

				$getIds = array();

				// if (!empty($this->request->data['ProductSpecificationMainPanel'])) {

				// 	$thisMainPanelIds = $this->ProductSpecificationMainPanel->saveMainPanel($mainPanelData,$userData['User']['id'],$specId);

				// 	$getIds = array_merge($getIds,$thisMainPanelIds);
				// }

				if (!empty($this->request->data['ProductSpecificationComponent'])) {

					$thisComponentIds = $this->ProductSpecificationComponent->saveComponent($componentData,$userData['User']['id'],$specId);

					$getIds = array_merge($getIds,$thisComponentIds);
				}
				
				if (!empty($this->request->data['ProductSpecificationPart'])) {

					$thisPartIds = $this->ProductSpecificationPart->savePart($partData,$userData['User']['id'],$specId);
					
					$getIds = array_merge($getIds,$thisPartIds);

				}

				if (!empty($this->request->data['ProductSpecificationProcess'])) {

					$thisProcessIds = $this->ProductSpecificationProcess->saveProcess($processData,$userData['User']['id'],$specId);
					
					$getIds = array_merge($getIds,$thisProcessIds);

				}

				$saveArray = array();
				if (!empty($this->request->data['ProductSpecificationDetail'])) {
					foreach ($this->request->data['ProductSpecificationDetail'] as $key => $data) {

						if (!empty($getIds[$key])) {
							$newdata = split('-', $getIds[$key]);
							$saveArray[$key]['ProductSpecificationDetail']['model'] = $newdata[2];
							$saveArray[$key]['ProductSpecificationDetail']['order'] = $newdata[1];
							$saveArray[$key]['ProductSpecificationDetail']['foreign_key'] = $newdata[0];
						}
						
					}
				}

				if (!empty($saveArray)) {
					$this->ProductSpecificationDetail->saveSpecDetail($saveArray,$userData['User']['id'],$this->request->data['Product']['uuid']);
				}
				
				
				$this->Session->setFlash(
	                __('Client Order Product specification successfully completed', 'success')
	            );
				return $this->redirect(array('controller' => 'create_order',
											 'action' => 'view_specs',$this->request->data['JobTicket']['Product']['id'],1,$this->request->data['JobTicket']['ClientOrder']['id']));
				
			}

	    }
            
            public function reissue_ticket($productId = null,$ifSpec = null,$clientsOrderid = null) {
                  
                
                $this->loadModel('Ticket.JobTicket');
                
                $this->loadModel('Sales.Product');

                $this->loadModel('Sales.ProductSpecificationDetail');

                $this->loadModel('Unit');

                $this->loadModel('SubProcess');

                $this->loadModel('Process');

                $this->loadModel('Sales.Company');

                $this->loadModel('Sales.ProductSpecification');
                
                if (!empty($productId)) {
                    
                    //clientsOrder
                    $ClientsOrder = $this->ClientOrder->read(null,$clientsOrderid);
                        
                    //create new job ticket     
                    $data['JobTicket']['product_id'] = $productId;
                    $data['JobTicket']['clients_order_id'] = $clientsOrderid;
                    $data['JobTicket']['po_number'] =  $ClientsOrder['ClientOrder']['po_number'];
                    $data['JobTicket']['status_production_id'] = 0;
                     
                    if ( $this->JobTicket->save($data['JobTicket'])) {
                            
                       

			$clientOrderData = $this->ClientOrder->find('first',array('conditions' => array('ClientOrder.id' => $clientsOrderid)));

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

	        $this->Product->bindProduct();

			$productData = $this->Product->findById($productId);



			
			$specs = $this->ProductSpecification->find('first',array('conditions' => array('ProductSpecification.product_id' => $productData['Product']['id'])));
			
			//find if product has specs
			$formatDataSpecs = $this->ProductSpecificationDetail->findData($productData['Product']['uuid']);

			$noPermission = ' '; 


			$this->set(compact('noPermission','clientOrderData','companyData','processData','specs','productId','productData','clientOrderId','formatDataSpecs','unitData','subProcess'));

			if($ifSpec == 0){
				$this->render('view_specs_check');
			}
                        
                    }
                }
            }


	}
?>
