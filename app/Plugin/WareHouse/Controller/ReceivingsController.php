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
	
		$this->set(compact('purchaseOrderData', 'supplierData'));

    }

    public function receive_order($id = null, $requestUUID = null) {

    	$this->loadModel('WareHouse.ReceivedOrder');

    	$this->loadModel('WareHouse.ReceivedItem');

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

		$this->PurchaseOrder->bindReceive();

		$purchaseOrderData = $this->PurchaseOrder->find('first', array('conditions' => array('PurchaseOrder.id' => $id)));

		if(empty($requestData['PurchaseItem'])){

			$itemHolder = "RequestItem";

			$itemData = $this->RequestItem->find('all', array('conditions' => array('RequestItem.request_uuid' => $requestUUID)));

		}else{

			$itemHolder = "PurchaseItem";

			$itemData = $this->PurchaseItem->find('all', array('conditions' => array('RequestItem.request_uuid' => $requestUUID)));

		}

		$requestPurchasingItemArray = array();


		foreach ($itemData as $key => $value) {	

			if($value[$itemHolder]['model'] == 'GeneralItem'){

				$itemDetails = $this->GeneralItem->find('list', array('fields' => array('GeneralItem.id', 'GeneralItem.name')
																	));  

				$requestPurchasingItem[$key]['RequestItem']['name'] = $itemDetails[$value[$itemHolder]['foreign_key']];	

				$requestPurchasingItem[$key]['RequestItem']['foreign_key'] = $value[$itemHolder]['foreign_key'];

				$requestPurchasingItem[$key]['RequestItem']['model'] = $value[$itemHolder]['model'];

				array_push($requestPurchasingItemArray, $itemDetails[$value[$itemHolder]['foreign_key']]);

	        } 

	        if($value[$itemHolder]['model'] == 'Substrate'){

				$itemDetails = $this->Substrate->find('list', array('fields' => array('Substrate.id', 'Substrate.name')
																	));     

				$requestPurchasingItem[$key]['RequestItem']['name'] = $itemDetails[$value[$itemHolder]['foreign_key']]; 

				$requestPurchasingItem[$key]['RequestItem']['foreign_key'] = $value[$itemHolder]['foreign_key']; 

				$requestPurchasingItem[$key]['RequestItem']['model'] = $value[$itemHolder]['model'];

				array_push($requestPurchasingItemArray, $itemDetails[$value[$itemHolder]['foreign_key']]);                 
	        } 

	        if($value[$itemHolder]['model'] == 'CompoundSubstrate'){

				$itemDetails = $this->CompoundSubstrate->find('list', array('fields' => array('CompoundSubstrate.id', 'CompoundSubstrate.name')
																	)); 

				$requestPurchasingItem[$key]['RequestItem']['name'] = $itemDetails[$value[$itemHolder]['foreign_key']];

				$requestPurchasingItem[$key]['RequestItem']['foreign_key'] = $value[$itemHolder]['foreign_key'];

				$requestPurchasingItem[$key]['RequestItem']['model'] = $value[$itemHolder]['model'];

				array_push($requestPurchasingItemArray, $itemDetails[$value[$itemHolder]['foreign_key']]);


	        } 

	        if($value[$itemHolder]['model'] == 'CorrugatedPaper'){

				$itemDetails = $this->CorrugatedPaper->find('list', array('fields' => array('CorrugatedPaper.id', 'CorrugatedPaper.name')
																	));  

				$requestPurchasingItem[$key]['RequestItem']['name'] = $itemDetails[$value[$itemHolder]['foreign_key']]; 

				$requestPurchasingItem[$key]['RequestItem']['foreign_key'] = $value[$itemHolder]['foreign_key'];

				$requestPurchasingItem[$key]['RequestItem']['model'] = $value[$itemHolder]['model'];

				array_push($requestPurchasingItemArray, $itemDetails[$value[$itemHolder]['foreign_key']]);                        
	        } 

        }

		if (!empty($this->request->data)) {

			$itemId = $this->ReceivedOrder->saveReceivedOrders($this->request->data['ReceivedItems'],$userData['User']['id'],$id);

			$this->PurchaseOrder->id = $id;
			
			$this->ReceivedItem->saveReceivedItems($itemId, $this->request->data,$value[$itemHolder]['model']);

			$this->Session->setFlash(__('Order has been received'), 'success');
          
            $this->redirect( array(
                'controller' => 'receivings',   
                'action' => 'view', $id, $requestUUID
            ));  

		}
	
		$this->set(compact('requestData', 'requestPurchasingItem', 'purchaseOrderData', 'supplierData'));

    }

    public function receive($id = null) {

    	$this->loadModel('WareHouse.ReceivedOrder');

    	$this->loadModel('Supplier');

    	$this->loadModel('User');

    	$this->loadModel('Purchasing.Request');

    	$this->loadModel('Purchasing.PurchaseOrder');

		$userName = $this->User->find('list', array('fields' => array('User.id', 'User.fullname')
																));

		$supplierData = $this->Supplier->find('list', array('fields' => array('Supplier.id', 'Supplier.name')
																));

		$receiveData = $this->Request->find('list', array('fields' => array('Request.id', 'Request.uuid')
																));

		$userNameList = $this->User->find('list', array('fields' => array('User.id', 'User.fullname'),
														'conditions' => array( 
															'User.role_id' => 4)
													));

		$this->ReceivedOrder->bind();

		$received_orders = $this->ReceivedOrder->find('all');

		if(!empty($receiveData[$received_orders[0]['PurchaseOrder']['request_id']])){

			$uuid = $receiveData[$received_orders[0]['PurchaseOrder']['request_id']];

		}
	
		$this->set(compact('received_orders', 'supplierData', 'userName', 'uuid', 'userName', 'userNameList'));

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

		$this->loadModel('WareHouse.ReceivedOrder');

		$lastName = $this->User->find('list', array('fields' => array('User.id', 'User.last_name')
																));

		$firstName = $this->User->find('list', array('fields' => array('User.id', 'User.first_name')
																));

		$supplierData = $this->Supplier->find('list', array('fields' => array('Supplier.id', 'Supplier.name')
																));

		$purchaseOrderData = $this->PurchaseOrder->find('first', array('conditions' => array('PurchaseOrder.id' => $id)));

		$receivedOrderData = $this->ReceivedOrder->find('first', array('conditions' => array('ReceivedOrder.purchase_order_id' => $purchaseOrderData['PurchaseOrder']['id'])));

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


    	$this->set(compact('purchaseOrderData', 'supplierData', 'firstName', 'lastName', 'requestData', 'itemDetails', 'requestPurchasingItem', 'itemData', 'receivedOrderData'));

    }

    public function purchase_approve($id = null) {

		$userData = $this->Session->read('Auth');

		$this->loadModel('WareHouse.ReceivedOrder');

		$this->ReceivedOrder->id = $id;

		$this->ReceivedOrder->saveField('status_id', 1);

		$this->Session->setFlash(__('Delivered Order has been Closed'), 'success');
      
        $this->redirect( array(
            'controller' => 'receivings',   
            'action' => 'receive'
        ));  

    }

    public function in_record($id = null) {

    	//pr($id); 

    	$this->loadModel('WareHouse.ReceivedOrder');

    	$this->ReceivedOrder->bind(array('ReceivedItem'));

    	$receivedData = $this->ReceivedOrder->find('all', array('conditions' => array('ReceivedOrder.id' => $id)));
	
        pr($receivedData); exit;

    }


}