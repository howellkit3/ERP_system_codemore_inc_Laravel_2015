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

		$this->loadModel('Purchasing.PurchasingItem');

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

			$this->PurchasingItem->savePurchasingItem($this->request->data ,$requestUuid);
		
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

		$this->loadModel('Purchasing.PurchasingType');

		$requestData = $this->Request->find('all', array('order' => array('Request.created' => 'DESC')));
		
		$statusData = $this->StatusFieldHolder->find('list', array('fields' => array('id', 'status'),
															'order' => array('StatusFieldHolder.status' => 'ASC')
															));
		$type = $this->PurchasingType->find('list', array('fields' => array('id', 'name'),
															'order' => array('PurchasingType.id' => 'ASC')
															));

		$this->set(compact('requestData','statusData','type'));
		
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

		$this->loadModel('Purchasing.PurchasingItem');

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
		
		$requestPurchasingItem = $this->PurchasingItem->find('all', array('conditions' => array('PurchasingItem.request_uuid' => $requestData['Request']['uuid'])));

	    foreach ($requestPurchasingItem as $key => $value) {
			
			if($value['PurchasingItem']['model'] == 'GeneralItem'){

	 			$itemData = $this->GeneralItem->find('list',array('fields' => array('id', 'name')));

	 			$requestPurchasingItem[$key]['PurchasingItem']['name'] = $itemData[$value['PurchasingItem']['foreign_key']];
	 		}

	 		if($value['PurchasingItem']['model'] == 'CorrugatedPaper'){

	 			$itemData = $this->CorrugatedPaper->find('list',array('fields' => array('id', 'name')));

	 			$requestPurchasingItem[$key]['PurchasingItem']['name'] = $itemData[$value['PurchasingItem']['foreign_key']];
	 		}

	 		if($value['PurchasingItem']['model'] == 'Substrate'){

	 			$itemData = $this->Substrate->find('list',array('fields' => array('id', 'name')));

	 			$requestPurchasingItem[$key]['PurchasingItem']['name'] = $itemData[$value['PurchasingItem']['foreign_key']];
	 		}

	 		if($value['PurchasingItem']['model'] == 'CompoundSubstrate'){

	 			$itemData = $this->CompoundSubstrate->find('list',array('fields' => array('id', 'name')));
	 			
	 			$requestPurchasingItem[$key]['PurchasingItem']['name'] = $itemData[$value['PurchasingItem']['foreign_key']];
	 		}

	    } 

	    $this->loadModel('User');

	    $preparedData = $this->User->find('first', array(
														'conditions' => array('User.id' => $requestData['Request']['prepared_by']),
														));
	    //pr($requestPurchasingItem);exit();
    	$this->set(compact('requestId','requestData','requestPurchasingItem','unitData','preparedData'));
    }

    public function edit($requestId = null){

    	$userData = $this->Session->read('Auth');

    	$this->loadModel('Purchasing.Request');

		$this->loadModel('Purchasing.PurchasingItem');

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
		
		$requestPurchasingItem = $this->PurchasingItem->find('all', array('conditions' => array('PurchasingItem.request_uuid' => $requestData['Request']['uuid'])));

	    foreach ($requestPurchasingItem as $key => $value) {
			
			if($value['PurchasingItem']['model'] == 'GeneralItem'){

	 			$itemData = $this->GeneralItem->find('list',array('fields' => array('id', 'name')));

	 			$requestPurchasingItem[$key]['PurchasingItem']['name'] = $itemData[$value['PurchasingItem']['foreign_key']];
	 		}

	 		if($value['PurchasingItem']['model'] == 'CorrugatedPaper'){

	 			$itemData = $this->CorrugatedPaper->find('list',array('fields' => array('id', 'name')));

	 			$requestPurchasingItem[$key]['PurchasingItem']['name'] = $itemData[$value['PurchasingItem']['foreign_key']];
	 		}

	 		if($value['PurchasingItem']['model'] == 'Substrate'){

	 			$itemData = $this->Substrate->find('list',array('fields' => array('id', 'name')));

	 			$requestPurchasingItem[$key]['PurchasingItem']['name'] = $itemData[$value['PurchasingItem']['foreign_key']];
	 		}

	 		if($value['PurchasingItem']['model'] == 'CompoundSubstrate'){

	 			$itemData = $this->CompoundSubstrate->find('list',array('fields' => array('id', 'name')));
	 			
	 			$requestPurchasingItem[$key]['PurchasingItem']['name'] = $itemData[$value['PurchasingItem']['foreign_key']];
	 		}

	    } 

	    if ($this->request->is(array('post','put'))) {

			$requestUuid = $this->Request->saveRequest($this->request->data['Request'],$userData['User']['id']);

			$this->PurchasingItem->savePurchasingItem($this->request->data ,$requestUuid);
		
	 		$this->Session->setFlash(__('Request has been updated.'));

            $this->redirect( array(
                     'controller' => 'requests', 
                     'action' => 'view',$requestId
    
             ));

        }
	  
	    $this->request->data = $requestData;

    	$this->set(compact('requestId','purchasingTypeData','unitData','requestPurchasingItem'));
    }

    public function approved($requestId = null){

    	$this->loadModel('Purchasing.Request');

    	$this->Request->id = $requestId;

    	$this->Request->saveField('status_id',1);

    	$this->Session->setFlash(__('Request has been approved.'));

        $this->redirect( array(
                 'controller' => 'requests', 
                 'action' => 'request_list'

         ));

    }

    public function create_order($requestId = null){

    	$userData = $this->Session->read('Auth');

    	$this->loadModel('PaymentTermHolder');

    	$this->loadModel('Purchasing.Request');

    	$this->loadModel('Purchasing.PurchasingType');

    	$this->loadModel('Purchasing.PurchasingItem');

    	$this->loadModel('GeneralItem');

		$this->loadModel('Substrate');

		$this->loadModel('CorrugatedPaper');

		$this->loadModel('CompoundSubstrate');

    	$requestData = $this->Request->find('first', array('conditions' => array('Request.id' => $requestId)));

    	$requestPurchasingItem = $this->PurchasingItem->find('all', array('conditions' => array('PurchasingItem.request_uuid' => $requestData['Request']['uuid'])));

    	foreach ($requestPurchasingItem as $key => $value) {
			
			if($value['PurchasingItem']['model'] == 'GeneralItem'){

	 			$itemData = $this->GeneralItem->find('list',array('fields' => array('id', 'name')));

	 			$requestPurchasingItem[$key]['PurchasingItem']['name'] = $itemData[$value['PurchasingItem']['foreign_key']];
	 		}

	 		if($value['PurchasingItem']['model'] == 'CorrugatedPaper'){

	 			$itemData = $this->CorrugatedPaper->find('list',array('fields' => array('id', 'name')));

	 			$requestPurchasingItem[$key]['PurchasingItem']['name'] = $itemData[$value['PurchasingItem']['foreign_key']];
	 		}

	 		if($value['PurchasingItem']['model'] == 'Substrate'){

	 			$itemData = $this->Substrate->find('list',array('fields' => array('id', 'name')));

	 			$requestPurchasingItem[$key]['PurchasingItem']['name'] = $itemData[$value['PurchasingItem']['foreign_key']];
	 		}

	 		if($value['PurchasingItem']['model'] == 'CompoundSubstrate'){

	 			$itemData = $this->CompoundSubstrate->find('list',array('fields' => array('id', 'name')));
	 			
	 			$requestPurchasingItem[$key]['PurchasingItem']['name'] = $itemData[$value['PurchasingItem']['foreign_key']];
	 		}

	    } 
    	
    	$supplierData = $this->Supplier->find('list', array(
														'fields' => array('Supplier.id', 'Supplier.name'),
														));

    	$this->loadModel('Unit');

		$unitData = $this->Unit->find('list', array('fields' => array('id', 'unit'),
															'order' => array('Unit.unit' => 'ASC')
															));

    	$paymentTermData = $this->PaymentTermHolder->find('list', array(
														'fields' => array('PaymentTermHolder.id', 'PaymentTermHolder.name'),
														));

    	$type = $this->PurchasingType->find('list', array('fields' => array('id', 'name'),
															'order' => array('PurchasingType.id' => 'ASC')
															));

    	$this->set(compact('requestId','supplierData','paymentTermData','requestData','type','unitData','requestPurchasingItem'));

    }

    public function purchase_order(){

    	$userData = $this->Session->read('Auth');

    	$this->loadModel('Purchasing.PurchaseOrder');

    	$this->loadModel('Purchasing.Request');

    	$this->loadModel('Purchasing.PurchasingItem');

    	if (!empty($this->request->data)) {
    		
    		$this->PurchaseOrder->savePurchaseOrder($this->request->data,$userData['User']['id']);

    		$this->PurchasingItem->savePurchasingItemPrice($this->request->data);

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

		$this->loadModel('Purchasing.Request');

		$request = $this->Request->find('first', array(
														'conditions' => array( 
															'Request.id' => $requestId)
													));
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

		//pr($request); exit;

		$view = new View(null, false);

		$view->set(compact('request', 'preparedFullName', 'department'));
        
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

}