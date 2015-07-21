<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

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

		$this->loadModel('Purchasing.PurchasingItem');

		$this->loadModel('StatusFieldHolder');

		$this->loadModel('GeneralItem');

		$this->loadModel('Substrate');

		$this->loadModel('CorrugatedPaper');

		$this->loadModel('CompoundSubstrate');

		$this->loadModel('Purchasing.PurchasingType');

		$itemGroupData = $this->PurchasingItem->find('all');

		$this->Request->bind(array('PurchasingItem'));

		$requestData = $this->Request->find('all', array('order' => array('Request.created' => 'DESC')));
		
		foreach ($requestData as $key => $value) {
			
			foreach ($value['PurchasingItem'] as $key1 => $valueGroup) {

				if($valueGroup['model'] == 'GeneralItem'){

		 			$itemData = $this->GeneralItem->find('list',array('fields' => array('id', 'name')));

		 			$requestData[$key]['PurchasingItem'][$key1]['name'] = $itemData[$valueGroup['foreign_key']];
		 		}

		 		if($valueGroup['model'] == 'CorrugatedPaper'){

		 			$itemData = $this->CorrugatedPaper->find('list',array('fields' => array('id', 'name')));

		 			$requestData[$key]['PurchasingItem'][$key1]['name'] = $itemData[$valueGroup['foreign_key']];
		 		}

		 		if($valueGroup['model'] == 'Substrate'){

		 			$itemData = $this->Substrate->find('list',array('fields' => array('id', 'name')));

		 			$requestData[$key]['PurchasingItem'][$key1]['name'] = $itemData[$valueGroup['foreign_key']];
		 		}

		 		if($valueGroup['model'] == 'CompoundSubstrate'){

		 			$itemData = $this->CompoundSubstrate->find('list',array('fields' => array('id', 'name')));
		 			
		 			$requestData[$key]['PurchasingItem'][$key1]['name'] = $itemData[$valueGroup['foreign_key']];
		 		}
		 		
			}

	    } 
	    
		$statusData = $this->StatusFieldHolder->find('list', array('fields' => array('id', 'status'),
															'order' => array('StatusFieldHolder.status' => 'ASC')
															));
		$type = $this->PurchasingType->find('list', array('fields' => array('id', 'name'),
															'order' => array('PurchasingType.id' => 'ASC')
															));

		$this->set(compact('requestData','statusData', 'itemGroupData', 'itemData','type'));
		
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
	    //pr($requestPurchasingItem);exit();
    	$this->set(compact('requestId','requestData','requestPurchasingItem','unitData'));
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

    	$requestData = $this->Request->find('first', array('conditions' => array('Request.id' => $requestId)));

    	$supplierData = $this->Supplier->find('list', array(
														'fields' => array('Supplier.id', 'Supplier.name'),
														));

    	$paymentTermData = $this->PaymentTermHolder->find('list', array(
														'fields' => array('PaymentTermHolder.id', 'PaymentTermHolder.name'),
														));

    	$type = $this->PurchasingType->find('list', array('fields' => array('id', 'name'),
															'order' => array('PurchasingType.id' => 'ASC')
															));

    	$this->set(compact('requestId','supplierData','paymentTermData','requestData','type'));

    }

    public function purchase_order(){

    	$userData = $this->Session->read('Auth');

    	$this->loadModel('Purchasing.PurchaseOrder');

    	if (!empty($this->request->data)) {

    		$this->PurchaseOrder->savePurchaseOrder($this->request->data,$userData['User']['id']);

    		$this->Session->setFlash(__('Purchase Order complete.'));

	        $this->redirect( array(
	                 'controller' => 'requests', 
	                 'action' => 'purchase_order_list'

	        ));

    	}

    }

    public function purchase_order_list(){

    	$this->loadModel('Purchasing.PurchaseOrder');

    	$supplierData = $this->Supplier->find('list', array(
														'fields' => array('Supplier.id', 'Supplier.name'),
														));

		$purchaseOrderData = $this->PurchaseOrder->find('all',array('order' => 'PurchaseOrder.id DESC'));

		$this->set(compact('purchaseOrderData','supplierData'));

    }

}