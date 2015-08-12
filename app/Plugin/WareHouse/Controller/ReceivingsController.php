<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class ReceivingsController extends WareHouseAppController {

	public $uses = array('WareHouse.CustomField');

	public function index() {

		$this->loadModel('Purchasing.PurchaseOrder');

		$this->loadModel('Purchasing.Request');

		$this->loadModel('Supplier');

		$supplierData = $this->Supplier->find('list', array('fields' => array('Supplier.id', 'Supplier.name')
																));
		$this->PurchaseOrder->bind(array('Request'));

		$purchaseOrderData = $this->PurchaseOrder->find('all', array('conditions' => array('PurchaseOrder.status' => 1)));

		//pr($purchaseOrderData); exit;
	
		$this->set(compact('purchaseOrderData', 'supplierData'));

    }

    public function receive_order($id = null, $requestUUID = null) {

    	$this->loadModel('WareHouse.ReceivedOrder');

    	$this->loadModel('Purchasing.PurchaseOrder');

    	$this->loadModel('Purchasing.Request');

    	$this->loadModel('GeneralItem');

    	$this->loadModel('Substrate');

    	$this->loadModel('CorrugatedPaper');

    	$this->loadModel('CompoundSubstrate');

    	$this->loadModel('Purchasing.RequestItem');

    	$this->loadModel('Supplier');

		$userData = $this->Session->read('Auth');

		$requestData = $this->Request->find('first', array('conditions' => array('Request.uuid' => $requestUUID)));

		$supplierData = $this->Supplier->find('list', array('fields' => array('Supplier.id', 'Supplier.name')
																));

		$purchaseOrderData = $this->PurchaseOrder->find('first', array('conditions' => array('PurchaseOrder.id' => $id)));

		if(empty($requestData['PurchaseItem'])){

			$itemHolder = "RequestItem";

			$itemData = $this->RequestItem->find('all', array('conditions' => array('RequestItem.request_uuid' => $requestUUID)));

		}else{

			$itemHolder = "PurchaseItem";

			$itemData = $this->PurchaseItem->find('all', array('conditions' => array('RequestItem.request_uuid' => $requestUUID)));

		}

		foreach ($itemData as $key => $value) {	

			if($value[$itemHolder]['model'] == 'GeneralItem'){

				$itemDetails = $this->GeneralItem->find('list', array('fields' => array('GeneralItem.id', 'GeneralItem.name')
																	));  

				$requestPurchasingItem[$key]['RequestItem']['name'] = $itemDetails[$value[$itemHolder]['foreign_key']];	

	        } 

	        if($value[$itemHolder]['model'] == 'Substrate'){

				$itemDetails = $this->Substrate->find('list', array('fields' => array('Substrate.id', 'Substrate.name')
																	));     

				$requestPurchasingItem[$key]['RequestItem']['name'] = $itemDetails[$value[$itemHolder]['foreign_key']];                   
	        } 

	        if($value[$itemHolder]['model'] == 'CompoundSubstrate'){

				$itemDetails = $this->CompoundSubstrate->find('list', array('fields' => array('CompoundSubstrate.id', 'CompoundSubstrate.name')
																	)); 

				$requestPurchasingItem[$key]['RequestItem']['name'] = $itemDetails[$value[$itemHolder]['foreign_key']];

	        } 

	        if($value[$itemHolder]['model'] == 'CorrugatedPaper'){

				$itemDetails = $this->CorrugatedPaper->find('list', array('fields' => array('CorrugatedPaper.id', 'CorrugatedPaper.name')
																	));  

				$requestPurchasingItem[$key]['RequestItem']['name'] = $itemDetails[$value[$itemHolder]['foreign_key']];                           
	        } 
        } 

		if ($this->request->is(array('post', 'put'))) {

			$this->ReceivedOrder->saveReceivedOrders($this->request->data['Receiving'],$userData['User']['id'],$id);

			$this->PurchaseOrder->id = $id;

			$this->PurchaseOrder->saveField('status', 11);

			$this->Session->setFlash(__('Order has been received'), 'success');
          
            $this->redirect( array(
                'controller' => 'receivings',   
                'action' => 'index'
            ));  

		}
	
		$this->set(compact('requestData', 'requestPurchasingItem', 'purchaseOrderData', 'supplierData'));

    }

    public function receive($id = null) {

    	$this->loadModel('WareHouse.ReceivedOrder');

    	$this->loadModel('Supplier');

    	$this->loadModel('User');

    	$this->loadModel('User');

    	$this->loadModel('StatusFieldHolder');

		$userName = $this->User->find('list', array('fields' => array('User.id', 'User.fullname')
																));

		$supplierData = $this->Supplier->find('list', array('fields' => array('Supplier.id', 'Supplier.name')
																));

		$this->ReceivedOrder->bindReceive();

		$received_orders = $this->ReceivedOrder->find('all');

		//pr($received_orders); exit;
	
		$this->set(compact('received_orders', 'supplierData', 'userName'));

    }
	    	    
	 public function view($id = null, $requestUUID = null) {

	 	$this->loadModel('Purchasing.PurchaseOrder');

	 	$this->loadModel('Purchasing.Request');

	 	$this->loadModel('Supplier');

	 	$this->loadModel('User');

	 	$this->loadModel('GeneralItem');

	 	$this->loadModel('Substrate');

	 	$this->loadModel('CorrugatedPaper');

	 	$this->loadModel('CompoundSubstrate');

	 	$this->loadModel('Purchasing.PurchasingItem');

		$this->loadModel('Purchasing.RequestItem');


		$lastName = $this->User->find('list', array('fields' => array('User.id', 'User.last_name')
																));

		$firstName = $this->User->find('list', array('fields' => array('User.id', 'User.first_name')
																));

		$supplierData = $this->Supplier->find('list', array('fields' => array('Supplier.id', 'Supplier.name')
																));

		$purchaseOrderData = $this->PurchaseOrder->find('first', array('conditions' => array('PurchaseOrder.id' => $id)));

		$requestData = $this->Request->find('first', array('conditions' => array('Request.uuid' => $requestUUID)));

		if(empty($requestData['PurchaseItem'])){

			$itemHolder = "RequestItem";

			$itemData = $this->RequestItem->find('all', array('conditions' => array('RequestItem.request_uuid' => $requestUUID)));

		}else{

			$itemHolder = "PurchaseItem";

			$itemData = $this->PurchaseItem->find('all', array('conditions' => array('RequestItem.request_uuid' => $requestUUID)));

		}

		foreach ($itemData as $key => $value) {	

			if($value[$itemHolder]['model'] == 'GeneralItem'){

				$itemDetails = $this->GeneralItem->find('list', array('fields' => array('GeneralItem.id', 'GeneralItem.name')
																	));  

				$requestPurchasingItem[$key]['RequestItem']['name'] = $itemDetails[$value[$itemHolder]['foreign_key']];	

	        } 

	        if($value[$itemHolder]['model'] == 'Substrate'){

				$itemDetails = $this->Substrate->find('list', array('fields' => array('Substrate.id', 'Substrate.name')
																	));     

				$requestPurchasingItem[$key]['RequestItem']['name'] = $itemDetails[$value[$itemHolder]['foreign_key']];                   
	        } 

	        if($value[$itemHolder]['model'] == 'CompoundSubstrate'){

				$itemDetails = $this->CompoundSubstrate->find('list', array('fields' => array('CompoundSubstrate.id', 'CompoundSubstrate.name')
																	)); 

				$requestPurchasingItem[$key]['RequestItem']['name'] = $itemDetails[$value[$itemHolder]['foreign_key']];

	        } 

	        if($value[$itemHolder]['model'] == 'CorrugatedPaper'){

				$itemDetails = $this->CorrugatedPaper->find('list', array('fields' => array('CorrugatedPaper.id', 'CorrugatedPaper.name')
																	));  

				$requestPurchasingItem[$key]['RequestItem']['name'] = $itemDetails[$value[$itemHolder]['foreign_key']];                           
	        } 
        } 


    	$this->set(compact('purchaseOrderData', 'supplierData', 'firstName', 'lastName', 'requestData', 'itemDetails', 'requestPurchasingItem', 'itemData'));

    }

}