<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');
App::import('Vendor', 'DOMPDF', true, array(), 'dompdf'.DS.'dompdf_config.inc.php', false);

class RequestsController extends PurchasingAppController {

	public $helpers = array('Purchasing.Country');

	public $uses = array('Purchasing.Supplier');

	public function index() {

		$this->Supplier->bind(array('Address','Email','Contact','SupplierContactPerson'));

		$limit = 10;

		$conditions = array();

         $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'fields' => array('id', 'name', 'description','website','created','tin'),
            'order' => 'Supplier.created DESC',
        );

		$suppliers = $this->paginate();

		$this->set(compact('suppliers'));

	}

	public function create() {

		$userData = $this->Session->read('Auth');

		$this->loadModel('Purchasing.Request');

		$this->loadModel('Purchasing.RequestItem');

		$this->loadModel('Purchasing.PurchasingType');

	 	$purchasingTypeData = $this->PurchasingType->find('list', array(
														'fields' => array('PurchasingType.id', 'PurchasingType.name'),
														));

	 	$this->loadModel('Unit');

		$unitData = $this->Unit->find('list', array('fields' => array('id', 'unit'),
															'order' => array('Unit.unit' => 'ASC')
															));

		$this->loadModel('GeneralItem');

		$itemData = $this->GeneralItem->find('list', array('fields' => array('id', 'name'),
															'order' => array('GeneralItem.name' => 'ASC')
															));


	 	if ($this->request->is(array('post','put'))) {


			$requestUuid = $this->Request->saveRequest($this->request->data['Request'],$userData['User']['id']);

			$this->RequestItem->saveRequestItem($this->request->data ,$requestUuid);
		
	 		$this->Session->setFlash(__('Request has been added.'));

            $this->redirect( array(
                     'controller' => 'requests', 
                     'action' => 'request_list'
    
             ));

        }

		$this->set(compact('purchasingTypeData', 'unitData','itemData'));
			
	}


	public function request_list(){

		$this->loadModel('Purchasing.Request');

		$this->loadModel('StatusFieldHolder');

		$this->loadModel('User');

		$this->loadModel('Purchasing.PurchasingType');

		//$requestData = $this->Request->find('all', array('order' => array('Request.created' => 'DESC')));


		//waiting status

		$limit = 10;

		$conditions = array('Request.status_id' => 8);

		$params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Request.created DESC',
	    );

		$this->paginate = $params;

		$requestData = $this->paginate('Request');

		//approved status

		$limit = 10;

		$conditions = array('Request.status_id' => 1);

		$params1 =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Request.created DESC',
	    );

		$this->paginate = $params1;

		$approvedRequestData = $this->paginate('Request');
		
		$statusData = $this->StatusFieldHolder->find('list', array('fields' => array('id', 'status'),
															'order' => array('StatusFieldHolder.status' => 'ASC')
															));

		$userName = $this->User->find('list', array('fields' => array('id', 'fullname')
															));

		$type = $this->PurchasingType->find('list', array('fields' => array('id', 'name'),
															'order' => array('PurchasingType.id' => 'ASC')
															));

		$this->set(compact('requestData','statusData','type', 'userName', 'approvedRequestData'));
		
	}

	public function item_search($itemGroupId = null, $searchHint = null ,$dynamicId) {

    	//$this->bind->GeneralItem('ItemCategoryHolder','ItemTypeHolder');

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

    public function request_section($getCounter = null){

    	$this->loadModel('Unit');

		$unitData = $this->Unit->find('list', array('fields' => array('id', 'unit'),
															'order' => array('Unit.unit' => 'ASC')
															));

    	$this->set(compact('getCounter','unitData'));

		$this->render('request_section');

    }

    public function item_details($itemGroupId = null, $getCounter = null){
    	
    	$this->loadModel('GeneralItem');

    	$this->loadModel('CompoundSubstrate');

    	$this->loadModel('CorrugatedPaper');

    	$this->loadModel('Substrate');
    	
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
    	$this->set(compact('searchedProduct','ModelName','getCounter'));

    	$this->render('item_details');
		
    }

    public function view($requestId = null){

    	$userData = $this->Session->read('Auth');

    	$this->loadModel('Purchasing.Request');

		$this->loadModel('Purchasing.RequestItem');

		$this->loadModel('GeneralItem');

		$this->loadModel('Substrate');

		$this->loadModel('CorrugatedPaper');

		$this->loadModel('CompoundSubstrate');

    	$this->loadModel('Purchasing.PurchasingType');

	 	$purchasingTypeData = $this->PurchasingType->find('list', array(
														'fields' => array('PurchasingType.id', 'PurchasingType.name'),
														));

	 	$this->loadModel('Unit');

		$unitData = $this->Unit->find('list', array('fields' => array('id', 'unit'),
															'order' => array('Unit.unit' => 'ASC')
															));

    	$requestData = $this->Request->find('first', array('conditions' => array('Request.id' => $requestId)));
		
		$requestPurchasingItem = $this->RequestItem->find('all', array('conditions' => array('RequestItem.request_uuid' => $requestData['Request']['uuid'])));

	    foreach ($requestPurchasingItem as $key => $value) {
			
			if($value['RequestItem']['model'] == 'GeneralItem'){

	 			$itemData = $this->GeneralItem->find('list',array('fields' => array('id', 'name')));

	 			$requestPurchasingItem[$key]['RequestItem']['name'] = $itemData[$value['RequestItem']['foreign_key']];
	 		}

	 		if($value['RequestItem']['model'] == 'CorrugatedPaper'){

	 			$itemData = $this->CorrugatedPaper->find('list',array('fields' => array('id', 'name')));

	 			$requestPurchasingItem[$key]['RequestItem']['name'] = $itemData[$value['RequestItem']['foreign_key']];
	 		}

	 		if($value['RequestItem']['model'] == 'Substrate'){

	 			$itemData = $this->Substrate->find('list',array('fields' => array('id', 'name')));

	 			$requestPurchasingItem[$key]['RequestItem']['name'] = $itemData[$value['RequestItem']['foreign_key']];
	 		}

	 		if($value['RequestItem']['model'] == 'CompoundSubstrate'){

	 			$itemData = $this->CompoundSubstrate->find('list',array('fields' => array('id', 'name')));
	 			
	 			$requestPurchasingItem[$key]['RequestItem']['name'] = $itemData[$value['RequestItem']['foreign_key']];
	 		}

	    } 

	    $this->loadModel('User');

	    $preparedData = $this->User->find('first', array(
														'conditions' => array('User.id' => $requestData['Request']['prepared_by']),
														));
	    //pr($requestPurchasingItem);exit();
    	$this->set(compact('requestId','requestData','requestPurchasingItem','unitData','preparedData' , 'userData'));
    }

    public function edit($requestId = null){

    	$userData = $this->Session->read('Auth');

    	$this->loadModel('Purchasing.Request');

		$this->loadModel('Purchasing.RequestItem');

		$this->loadModel('GeneralItem');

		$this->loadModel('Substrate');

		$this->loadModel('CorrugatedPaper');

		$this->loadModel('CompoundSubstrate');

    	$this->loadModel('Purchasing.PurchasingType');

	 	$purchasingTypeData = $this->PurchasingType->find('list', array(
														'fields' => array('PurchasingType.id', 'PurchasingType.name'),
														));

	 	$this->loadModel('Unit');

		$unitData = $this->Unit->find('list', array('fields' => array('id', 'unit'),
															'order' => array('Unit.unit' => 'ASC')
															));

		$requestData = $this->Request->find('first', array('conditions' => array('Request.id' => $requestId)));
		
		$requestRequestItem = $this->RequestItem->find('all', array('conditions' => array('RequestItem.request_uuid' => $requestData['Request']['uuid'])));

		//pr($requestRequestItem); exit;

	    foreach ($requestRequestItem as $key => $value) {
			
			if($value['RequestItem']['model'] == 'GeneralItem'){

	 			$itemData = $this->GeneralItem->find('list',array('fields' => array('id', 'name')));

	 			$requestRequestItem[$key]['RequestItem']['name'] = $itemData[$value['RequestItem']['foreign_key']];
	 		}

	 		if($value['RequestItem']['model'] == 'CorrugatedPaper'){

	 			$itemData = $this->CorrugatedPaper->find('list',array('fields' => array('id', 'name')));

	 			$requestRequestItem[$key]['RequestItem']['name'] = $itemData[$value['RequestItem']['foreign_key']];
	 		}

	 		if($value['RequestItem']['model'] == 'Substrate'){

	 			$itemData = $this->Substrate->find('list',array('fields' => array('id', 'name')));

	 			$requestRequestItem[$key]['RequestItem']['name'] = $itemData[$value['RequestItem']['foreign_key']];
	 		}

	 		if($value['RequestItem']['model'] == 'CompoundSubstrate'){

	 			$itemData = $this->CompoundSubstrate->find('list',array('fields' => array('id', 'name')));
	 			
	 			$requestRequestItem[$key]['RequestItem']['name'] = $itemData[$value['RequestItem']['foreign_key']];
	 		}

	    } 

	    if ($this->request->is(array('post','put'))) {

	    //	pr($this->request->data); exit;

	    	foreach ($this->request->data['RequestItemIdHolder'] as $key => $value) {

    			
    			if (!empty($value['id'])) {

    				$this->RequestItem->delete($value['id']);

    			}
    			
    		}
	    	
			$requestUuid = $this->Request->saveRequest($this->request->data['Request'],$userData['User']['id']);

			$this->RequestItem->saveRequestItem($this->request->data ,$requestUuid);
		
	 		$this->Session->setFlash(__('Request has been updated.'));

            $this->redirect( array(
                     'controller' => 'requests', 
                     'action' => 'view',$requestId
    
             ));

        }
	  
	    $this->request->data = $requestData;

    	$this->set(compact('requestId','purchasingTypeData','unitData','requestRequestItem'));
    }

    public function approved($requestId = null){

    	$this->loadModel('Purchasing.Request');

    	$this->Request->id = $requestId;

    	$this->Request->saveField('status_id',1);

    	$this->Session->setFlash(__('Request has been approved.'));

        $this->redirect( array(
                 'controller' => 'requests', 
                 'action' => 'view', $requestId

         ));

    }

    public function create_order($requestId = null){

    	$userData = $this->Session->read('Auth');

    	$this->loadModel('PaymentTermHolder');

    	$this->loadModel('Purchasing.Request');

    	$this->loadModel('Purchasing.PurchaseOrder');

    	$this->loadModel('Purchasing.PurchasingType');

    	$this->loadModel('Purchasing.RequestItem');

    	$this->loadModel('GeneralItem');

		$this->loadModel('Substrate');

		$this->loadModel('CorrugatedPaper');

		$this->loadModel('CompoundSubstrate');

		//$this->Request->bind(array('Purchase'));

		// $purchaseOrderData = $this->PurchaseOrder->find('all', 'order' => array('PurchaseOrder.created' => 'ASC')
		// 													);

		$purchaseOrderData = $this->PurchaseOrder->find('first', array('fields' => array('id', 'po_number'),
															'order' => array('PurchaseOrder.created' => 'DESC')
															));

		
		//pr($purchaseOrderData); exit;
		//if($purchaseOrderData['PurchaseOrder']['po_number'] != 15100001){

			//$purchaseNumber = 15100001;

		//}else if($purchaseOrderData['PurchaseOrder']['po_number'] >= 15100001){

		$purchaseNumber = $purchaseOrderData['PurchaseOrder']['po_number'] + 1;

		//}

    	$requestData = $this->Request->find('first', array('conditions' => array('Request.id' => $requestId)));

    	$requestItem = $this->RequestItem->find('all', array('conditions' => array('RequestItem.request_uuid' => $requestData['Request']['uuid'])));

    	foreach ($requestItem as $key => $value) {
			
			if($value['RequestItem']['model'] == 'GeneralItem'){

	 			$itemData = $this->GeneralItem->find('list',array('fields' => array('id', 'name')));

	 			$requestItem[$key]['RequestItem']['name'] = $itemData[$value['RequestItem']['foreign_key']];
	 		}

	 		if($value['RequestItem']['model'] == 'CorrugatedPaper'){

	 			$itemData = $this->CorrugatedPaper->find('list',array('fields' => array('id', 'name')));

	 			$requestItem[$key]['RequestItem']['name'] = $itemData[$value['RequestItem']['foreign_key']];
	 		}

	 		if($value['RequestItem']['model'] == 'Substrate'){

	 			$itemData = $this->Substrate->find('list',array('fields' => array('id', 'name')));

	 			$requestItem[$key]['RequestItem']['name'] = $itemData[$value['RequestItem']['foreign_key']];
	 		}

	 		if($value['RequestItem']['model'] == 'CompoundSubstrate'){

	 			$itemData = $this->CompoundSubstrate->find('list',array('fields' => array('id', 'name')));
	 			
	 			$requestItem[$key]['RequestItem']['name'] = $itemData[$value['RequestItem']['foreign_key']];
	 		}

	    } 
    	
    	$supplierData = $this->Supplier->find('list', array(
														'fields' => array('Supplier.id', 'Supplier.name'),
														));

    	$this->loadModel('Unit');

		$unitData = $this->Unit->find('list', array('fields' => array('id', 'unit'),
															'order' => array('Unit.unit' => 'ASC')
															));
		$this->loadModel('Currency');

		$currencyData = $this->Currency->find('list', array('fields' => array('id', 'name'))
															);

    	$paymentTermData = $this->PaymentTermHolder->find('list', array(
														'fields' => array('PaymentTermHolder.id', 'PaymentTermHolder.name'),
														));

    	$type = $this->PurchasingType->find('list', array('fields' => array('id', 'name'),
															'order' => array('PurchasingType.id' => 'ASC')
															));

    	$this->set(compact('purchaseNumber','requestId','supplierData','paymentTermData','requestData','type','unitData','requestItem','currencyData'));

    }

    public function purchase_order(){

    	$userData = $this->Session->read('Auth');

    	$this->loadModel('Purchasing.PurchaseOrder');

    	$this->loadModel('Purchasing.Request');

    	$this->loadModel('Purchasing.RequestItem');

    	if (!empty($this->request->data)) {

    		$this->request->data['PurchaseOrder']['delivery_date'] = $this->request->data['PurchaseOrder']['deliveryDate'];

    		if(!empty($this->request->data['RequestItemIdHolder'])){
    		
	    		foreach ($this->request->data['RequestItemIdHolder'] as $key => $value) {

	    			
	    			if (!empty($value['id'])) {

	    				$this->RequestItem->delete($value['id']);

	    			}
	    			
	    		}
    		}
    		
    		$this->PurchaseOrder->savePurchaseOrder($this->request->data,$userData['User']['id']);

    		$this->RequestItem->saveRequestItemPrice($this->request->data);

    		$this->Request->id = $this->request->data['PurchaseOrder']['request_id'];

    		$this->Request->saveField('status_id',0);

    		$this->Session->setFlash(__('Purchase Order complete.'));

	        $this->redirect( array(
	                 'controller' => 'purchase_orders', 
	                 'action' => 'index'

	        ));

    	}

    }

    public function find_supplier_number($supplierId){

    	$this->layout = false;

    	$this->loadModel('Purchasing.Contact');

    	$this->loadModel('Purchasing.SupplierContactPerson');

		$contactNumber = $this->Contact->find('all', array(
										'conditions' => array(
										'Contact.foreign_key' => $supplierId,
										'Contact.model' => 'Supplier',
										), 
										'fields' => array(
											'id', 'number')
										));

		$contactPerson = $this->SupplierContactPerson->find('all', array(
										'conditions' => array(
										'SupplierContactPerson.supplier_id' => $supplierId,
										), 
										'fields' => array(
											'id', 'firstname','lastname')
										));

		$data = array();
		$data['contact'] = $contactNumber;
		$data['contactperson'] = $contactPerson;

		echo json_encode($data);

		$this->autoRender = false;

    }

    public function print_request($requestId = null) {

    	Configure::write('debug',0);

		$this->loadModel('Purchasing.Request');

		$this->loadModel('Purchasing.RequestItem');

		$this->loadModel('CorrugatedPaper');

		$this->loadModel('CompoundSubstrate');

		$this->loadModel('Substrate');

		$this->loadModel('GeneralItem');

		$this->loadModel('Unit');

		$request = $this->Request->find('first', array(
														'conditions' => array( 
															'Request.id' => $requestId)
													));

		$requestItem = $this->RequestItem->find('all', array(
														'conditions' => array( 
															'RequestItem.request_uuid' => $request['Request']['uuid'])
													));
		foreach($requestItem as $key=>$value) {

			if($value['RequestItem']['model'] == 'GeneralItem'){

	 			$itemData = $this->GeneralItem->find('list',array('fields' => array('id', 'name')));

	 			$requestRequestItem[$key]['RequestItem']['name'] = $itemData[$value['RequestItem']['foreign_key']];
	 		}

	 		if($value['RequestItem']['model'] == 'CorrugatedPaper'){

	 			$itemData = $this->CorrugatedPaper->find('list',array('fields' => array('id', 'name')));

	 			$requestRequestItem[$key]['RequestItem']['name'] = $itemData[$value['RequestItem']['foreign_key']];
	 	
	 		}

	 		if($value['RequestItem']['model'] == 'Substrate'){

	 			$itemData = $this->Substrate->find('list',array('fields' => array('id', 'name')));

	 			$requestRequestItem[$key]['RequestItem']['name'] = $itemData[$value['RequestItem']['foreign_key']];
	 	
	 		}

	 		if($value['RequestItem']['model'] == 'CompoundSubstrate'){

	 			$itemData = $this->CompoundSubstrate->find('list',array('fields' => array('id', 'name')));
	 			
	 			$requestRequestItem[$key]['RequestItem']['name'] = $itemData[$value['RequestItem']['foreign_key']];
	 	
	  		}

	  		
		}


		$unitData = $this->Unit->find('list',array('fields' => array('id', 'unit')));

		$userData = $this->Session->read('Auth');

		$preparedFName = $userData['User']['first_name'];

		$preparedLName = $userData['User']['last_name'];

		$preparedFullName = $preparedFName . ' ' . $preparedLName;

		$departmentRole = $userData['User']['role_id'];

		if($departmentRole == 10){

			$department = 'Warehouse';

		} else if ($departmentRole == 2 || $departmentRole == 3){

			$department = 'Sales';
		} else if ($departmentRole == 4 ){

			$department = 'Delivery';

		} else if ($departmentRole == 5 ){

			$department = 'Purchasing';

		} else if ($departmentRole == 6 || $departmentRole == 7 || $departmentRole == 8 || $departmentRole == 9 ){

			$department = 'Accounting';

		} else{

			$department = 'Management';
		}


		$view = new View(null, false);

		$view->set(compact('request', 'preparedFullName', 'department', 'requestItem', 'itemData', 'unitData', 'requestRequestItem'));
        
		$view->viewPath = 'Requests'.DS.'pdf';	
   
        $output = $view->render('print_request', false);
   	
        $dompdf = new DOMPDF();
        $dompdf->set_paper("A5");
        $dompdf->load_html(utf8_decode($output), Configure::read('App.encoding'));
        $dompdf->render();
        $canvas = $dompdf->get_canvas();
        $font = Font_Metrics::get_font("verdana", "bold");
        $canvas->page_text(16, 800, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, array(0,0,0));

        $output = $dompdf->output();
        $random = rand(0, 1000000) . '-' . time();
        if (empty($filename)) {
        	$filename = 'product-'.$request['Request']['uuid'].'-request'.time();
        }
      	$filePath = 'view_pdf/'.strtolower(Inflector::slug( $filename , '-')).'.pdf';
        $file_to_save = WWW_ROOT .DS. $filePath;
        	
        if ($dompdf->stream( $file_to_save, array( 'Attachment'=>0 ) )) {
        		unlink($file_to_save);
        }
        
        exit();
        

	}

	public function search_request($hint = null){

        $this->loadModel('Purchasing.Request');

		$this->loadModel('StatusFieldHolder');

		$this->loadModel('Purchasing.PurchasingType');

		$this->loadModel('User');

		$requestData = $this->Request->find('all', array('order' => array('Request.created' => 'DESC')));
		
		$userName = $this->User->find('list', array('fields' => array('id', 'fullname')
															));

		$statusData = $this->StatusFieldHolder->find('list', array('fields' => array('id', 'status'),
															'order' => array('StatusFieldHolder.status' => 'ASC')
															));
		$type = $this->PurchasingType->find('list', array('fields' => array('id', 'name'),
															'order' => array('PurchasingType.id' => 'ASC')
															));

        $requestData = $this->Request->find('all',array(
                      'conditions' => array(
                        'OR' => array(
                        array('Request.uuid LIKE' => '%' . $hint . '%'),
                        array('Request.name LIKE' => '%' . $hint . '%')
                          )
                        ),
                      'limit' => 10
                      )); 


       $this->set(compact('requestData', 'type','statusData', 'userName'));

        if ($hint == ' ') {
            $this->render('index');
        }else{
            $this->render('search_request');
        }
    }


    public function product_search($itemGroupId = null, $searchHint = null ,$dynamicId) {

    	$this->loadModel('GeneralItem');

    	$this->loadModel('Substrate');

    	$this->loadModel('CorrugatedPaper');

    	$this->loadModel('CompoundSubstrate');


    	if($itemGroupId == 1) {
    		$ModelName = 'GeneralItem';
    		$searchedProduct = $this->GeneralItem->find('all',array(
												'conditions' => array(
        										'GeneralItem.name LIKE' => '%' . $searchHint . '%',
        										 ),'limit' => 10));
    	}
    	if($itemGroupId == 2) {
    		$ModelName = 'Substrate';
    		$searchedProduct = $this->Substrate->find('all',array(
												'conditions' => array(
        										'Substrate.name LIKE' => '%' . $searchHint . '%',
        										 ),'limit' => 10));
    	}
    	if($itemGroupId == 3) {
    		$ModelName = 'CompoundSubstrate';
    		$searchedProduct = $this->CompoundSubstrate->find('all',array(
												'conditions' => array(
        										'CompoundSubstrate.name LIKE' => '%' . $searchHint . '%',
        										 ),'limit' => 10));
    	}
    	if($itemGroupId == 4) {
    		$ModelName = 'CorrugatedPaper';
    		$searchedProduct = $this->CorrugatedPaper->find('all',array(
												'conditions' => array(
        										'CorrugatedPaper.name LIKE' => '%' . $searchHint . '%',
        										 ),'limit' => 10));
    	}

    	//pr($searchedProduct); exit;

    	// foreach ($categoryData as $key => $list) {    		
    	// 	$categoryData[$key][$ModelName]['name'] = utf8_encode($list[$ModelName]['name']);    		
    	// }
    	//pr($categoryData);exit();
    	$this->set(compact('searchedProduct','ModelName','dynamicId'));
		$this->render('searched_item_details');

    }

    public function delete($id = null) {

    	if (!empty($id)) {

    		$this->loadModel('Purchasing.Request');

    		//update request

    		$status = 0;

    		$this->Request->id = $id;

    		if ( $this->Request->saveField('status', $status) ) {

    			$this->Session->setFlash(__('Request Termination sucess.'),'success');

    		} else {
    			$this->Session->setFlash(__('Request Termination Failes.'),'error');

    		}


	        $this->redirect( array(
	                 'controller' => 'requests', 
	                 'action' => 'request_list'

	        ));
    	}

    } 

    public function test($id = null) {

		$this->loadModel('Purchasing.Request');

		$this->loadModel('StatusFieldHolder');

		$this->loadModel('User');

		$this->loadModel('Purchasing.PurchasingType');

		$requestData = $this->Request->find('all', array('order' => array('Request.created' => 'DESC')));

		$statusData = $this->StatusFieldHolder->find('list', array('fields' => array('id', 'status'),
															'order' => array('StatusFieldHolder.status' => 'ASC')
															));

		$userName = $this->User->find('list', array('fields' => array('id', 'fullname')
															));

		$type = $this->PurchasingType->find('list', array('fields' => array('id', 'name'),
															'order' => array('PurchasingType.id' => 'ASC')
															));

		$this->set(compact('requestData','statusData','type', 'userName', 'approvedRequestData'));    

    } 

    public function index_status($status = null) {

    	$this->loadModel('Purchasing.Request');

		$this->loadModel('User');

		$this->loadModel('Purchasing.PurchasingType');

		if($status == 1){

			$limit = 10;

			$conditions = array('Request.status_id' => 8);

			$params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            'order' => 'Request.created DESC',
	   		);

			$this->paginate = $params;

			$waitingRequestData = $this->paginate('Request');

			$userName = $this->User->find('list', array('fields' => array('id', 'fullname')
															));

			$type = $this->PurchasingType->find('list', array('fields' => array('id', 'name'),
															'order' => array('PurchasingType.id' => 'ASC')
															));

			$this->set(compact('waitingRequestData','type', 'userName'));  

			$this->render('request_waiting');

		}


		if($status == 2){

			$limit = 10;

			$conditions = array('Request.status_id' => 1);

			$params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            'order' => 'Request.created DESC',
	   		);

			$this->paginate = $params;

			$approvedRequestData = $this->paginate('Request');

			$userName = $this->User->find('list', array('fields' => array('id', 'fullname')
															));

			$type = $this->PurchasingType->find('list', array('fields' => array('id', 'name'),
															'order' => array('PurchasingType.id' => 'ASC')
															));

			$this->set(compact('approvedRequestData','type', 'userName'));  

			$this->render('request_approved');

		}

		if($status == 3){

			$limit = 10;

			$conditions = array('Request.status_id' => 0);

			$params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            'order' => 'Request.created DESC',
	   		);

			$this->paginate = $params;

			$purchasedRequestData = $this->paginate('Request');

			$userName = $this->User->find('list', array('fields' => array('id', 'fullname')
															));

			$type = $this->PurchasingType->find('list', array('fields' => array('id', 'name'),
															'order' => array('PurchasingType.id' => 'ASC')
															));

			$this->set(compact('purchasedRequestData','type', 'userName'));  

			$this->render('request_purchased');

		}


		  

    } 

}