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

		$purchaseOrderData = $this->PurchaseOrder->find('all', array('conditions' => array('PurchaseOrder.status' => 1),'order' => 'PurchaseOrder.created DESC'));
	
	

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

    	$this->loadModel('Purchasing.PurchasingItem');

    	$this->loadModel('Supplier');

    	$this->loadModel('Unit');

		$userData = $this->Session->read('Auth');

		$requestData = $this->Request->find('first', array('conditions' => array('Request.uuid' => $requestUUID)));

		$supplierData = $this->Supplier->find('list', array('fields' => array('Supplier.id', 'Supplier.name')
																));

		$unitData = $this->Unit->find('list', array('fields' => array('Unit.id', 'Unit.unit')
																));

		$this->PurchaseOrder->bindReceive();

		$purchaseOrderData = $this->PurchaseOrder->find('first', array('conditions' => array('PurchaseOrder.id' => $id)));

		$purchaseData = $this->PurchasingItem->find('all', array('conditions' => array('PurchasingItem.request_uuid' => $requestUUID)));

		if(empty($purchaseData[0]['PurchasingItem']['id'])){

			$itemHolder = "RequestItem";

			$itemData = $this->RequestItem->find('all', array('conditions' => array('RequestItem.request_uuid' => $requestUUID)));

		}else{

			$itemHolder = "PurchasingItem";

			$itemData = $this->PurchasingItem->find('all', array('conditions' => array('PurchasingItem.request_uuid' => $requestUUID)));

		}

		$receivedItemData = $this->ReceivedItem->find('all', array('conditions' => array('ReceivedItem.received_orders_id' => $purchaseOrderData['PurchaseOrder']['id'])));

		$requestPurchasingItemArray = array();


		foreach ($itemData as $key => $value) {	

			$foreignkeyHolder = $value[$itemHolder]['foreign_key'];

		    $modelHolder = $value[$itemHolder]['model'];

			if($modelHolder == 'GeneralItem'){

				$itemDetails = $this->GeneralItem->find('list', array('fields' => array('GeneralItem.id', 'GeneralItem.name')
																	));  

				$requestPurchasingItem[$key][$itemHolder]['name'] = $itemDetails[$value[$itemHolder]['foreign_key']];	

				$requestPurchasingItem[$key][$itemHolder]['foreign_key'] = $value[$itemHolder]['foreign_key'];

				$requestPurchasingItem[$key][$itemHolder]['model'] = $value[$itemHolder]['model'];

				$requestPurchasingItem[$key][$itemHolder]['original_quantity'] = $value[$itemHolder]['quantity'];


				array_push($requestPurchasingItemArray, $itemDetails[$value[$itemHolder]['foreign_key']]);

				foreach ($receivedItemData as $key2 => $receivedValue) {	

						$conditions = array(); 

		    			$deliveredQuantityArray = array();

						$conditions = array_merge($conditions, array('ReceivedItem.model' => $modelHolder, 'ReceivedItem.foreign_key' => $foreignkeyHolder ));

						$received_items_data = $this->ReceivedItem->find('all', array('conditions' => $conditions));


						foreach ($received_items_data as $key1 => $value) {

							array_push($deliveredQuantityArray, $value['ReceivedItem']['quantity']); 

						} 

						if($receivedValue['ReceivedItem']['model'] == 'GeneralItem' && $receivedValue['ReceivedItem']['foreign_key'] == $foreignkeyHolder){
							
							$requestPurchasingItem[$key][$itemHolder]['original_quantity'] = $receivedValue['ReceivedItem']['original_quantity'];	

							$requestPurchasingItem[$key][$itemHolder]['delivered_quantity'] = array_sum($deliveredQuantityArray);	

						}
        			}


	        } 

	        if($modelHolder == 'Substrate'){

				$itemDetails = $this->Substrate->find('list', array('fields' => array('Substrate.id', 'Substrate.name')
																	));     

				$requestPurchasingItem[$key][$itemHolder]['name'] = $itemDetails[$value[$itemHolder]['foreign_key']]; 

				$requestPurchasingItem[$key][$itemHolder]['foreign_key'] = $value[$itemHolder]['foreign_key']; 

				$requestPurchasingItem[$key][$itemHolder]['model'] = $value[$itemHolder]['model'];

				$requestPurchasingItem[$key][$itemHolder]['original_quantity'] = $value[$itemHolder]['quantity'];

				array_push($requestPurchasingItemArray, $itemDetails[$value[$itemHolder]['foreign_key']]);     

				foreach ($receivedItemData as $key2 => $receivedValue) {	

						$conditions = array(); 

		    			$deliveredQuantityArray = array();

						$conditions = array_merge($conditions, array('ReceivedItem.model' => $modelHolder, 'ReceivedItem.foreign_key' => $foreignkeyHolder ));

						$received_items_data = $this->ReceivedItem->find('all', array('conditions' => $conditions));


						foreach ($received_items_data as $key1 => $value) {

							array_push($deliveredQuantityArray, $value['ReceivedItem']['quantity']); 

						} 

						if($receivedValue['ReceivedItem']['model'] == 'Substrate' && $receivedValue['ReceivedItem']['foreign_key'] == $foreignkeyHolder){
							
							$requestPurchasingItem[$key][$itemHolder]['original_quantity'] = $receivedValue['ReceivedItem']['original_quantity'];	

							$requestPurchasingItem[$key][$itemHolder]['delivered_quantity'] = array_sum($deliveredQuantityArray);	

						}
        			} 


	        } 

	        if($modelHolder == 'CompoundSubstrate'){

				$itemDetails = $this->CompoundSubstrate->find('list', array('fields' => array('CompoundSubstrate.id', 'CompoundSubstrate.name')
																	)); 

				$requestPurchasingItem[$key][$itemHolder]['name'] = $itemDetails[$value[$itemHolder]['foreign_key']];

				$requestPurchasingItem[$key][$itemHolder]['foreign_key'] = $value[$itemHolder]['foreign_key'];

				$requestPurchasingItem[$key][$itemHolder]['model'] = $value[$itemHolder]['model'];

				$requestPurchasingItem[$key][$itemHolder]['original_quantity'] = $value[$itemHolder]['quantity'];

				array_push($requestPurchasingItemArray, $itemDetails[$value[$itemHolder]['foreign_key']]);

				foreach ($receivedItemData as $key2 => $receivedValue) {	

						$conditions = array(); 

		    			$deliveredQuantityArray = array();

						$conditions = array_merge($conditions, array('ReceivedItem.model' => $modelHolder, 'ReceivedItem.foreign_key' => $foreignkeyHolder ));

						$received_items_data = $this->ReceivedItem->find('all', array('conditions' => $conditions));


						foreach ($received_items_data as $key1 => $value) {

							array_push($deliveredQuantityArray, $value['ReceivedItem']['quantity']); 

						} 

						if($receivedValue['ReceivedItem']['model'] == 'CompoundSubstrate' && $receivedValue['ReceivedItem']['foreign_key'] == $foreignkeyHolder){
							
							$requestPurchasingItem[$key][$itemHolder]['original_quantity'] = $receivedValue['ReceivedItem']['original_quantity'];	

							$requestPurchasingItem[$key][$itemHolder]['delivered_quantity'] = array_sum($deliveredQuantityArray);	

						}
        			}

	        } 

	        if($modelHolder == 'CorrugatedPaper'){

				$itemDetails = $this->CorrugatedPaper->find('list', array('fields' => array('CorrugatedPaper.id', 'CorrugatedPaper.name')
																	));  

				$requestPurchasingItem[$key][$itemHolder]['name'] = $itemDetails[$value[$itemHolder]['foreign_key']]; 

				$requestPurchasingItem[$key][$itemHolder]['foreign_key'] = $value[$itemHolder]['foreign_key'];

				$requestPurchasingItem[$key][$itemHolder]['model'] = $value[$itemHolder]['model'];

				$requestPurchasingItem[$key][$itemHolder]['original_quantity'] = $value[$itemHolder]['quantity'];

				array_push($requestPurchasingItemArray, $itemDetails[$value[$itemHolder]['foreign_key']]);    

				foreach ($receivedItemData as $key2 => $receivedValue) {	

						$conditions = array(); 

		    			$deliveredQuantityArray = array();

						$conditions = array_merge($conditions, array('ReceivedItem.model' => $modelHolder, 'ReceivedItem.foreign_key' => $foreignkeyHolder ));

						$received_items_data = $this->ReceivedItem->find('all', array('conditions' => $conditions));


						foreach ($received_items_data as $key1 => $value) {

							array_push($deliveredQuantityArray, $value['ReceivedItem']['quantity']); 

						} 

						if($receivedValue['ReceivedItem']['model'] == 'CorrugatedPaper' && $receivedValue['ReceivedItem']['foreign_key'] == $foreignkeyHolder){
							
							$requestPurchasingItem[$key][$itemHolder]['original_quantity'] = $receivedValue['ReceivedItem']['original_quantity'];	

							$requestPurchasingItem[$key][$itemHolder]['delivered_quantity'] = array_sum($deliveredQuantityArray);	

						}
        			}                    
	        } 

        }

		if (!empty($this->request->data)) {

			ksort($this->request->data['requestPurchasingItem']);

			$receivedData = $this->ReceivedOrder->find('first', array('conditions' => array('ReceivedOrder.purchase_order_id' => $id)));

			if(empty($receivedData['ReceivedOrder']['id'])){

				$itemId = $this->ReceivedOrder->saveReceivedOrders($this->request->data['ReceivedItems'],$userData['User']['id'],$id);

				$this->PurchaseOrder->id = $id;

			//	$this->PurchaseOrder->saveField('status', 10);

			}else{


				$itemId = $receivedData['ReceivedOrder']['id'];

			}
			
			$this->ReceivedItem->saveReceivedItems($itemId, $this->request->data,$value[$itemHolder]['model']);

			$this->Session->setFlash(__('Order has been received'), 'success');
          
            $this->redirect( array(
                'controller' => 'receivings',   
                'action' => 'view', $id, $requestUUID,0
            ));  

		}


	
		$this->set(compact('requestData', 'requestPurchasingItem', 'purchaseOrderData', 'supplierData', 'unitData', 'itemHolder'));

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

		$conditions = array(); 

		$conditions = array_merge($conditions, array('ReceivedOrder.status_id' => array(11, 1)));

		$received_orders = $this->ReceivedOrder->find('all', array('conditions' => $conditions));

		if(!empty($received_orders[0]['PurchaseOrder']['request_id'])){

			$uuid = $receiveData[$received_orders[0]['PurchaseOrder']['request_id']];

		}
	
		$this->set(compact('received_orders', 'supplierData', 'userName', 'uuid', 'userName', 'userNameList'));

    }
	    	    
	 public function view($id = null, $requestUUID = null, $type = null) {

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

		$this->loadModel('WareHouse.ReceivedItem');

		$lastName = $this->User->find('list', array('fields' => array('User.id', 'User.last_name')
																));

		$firstName = $this->User->find('list', array('fields' => array('User.id', 'User.first_name')
																));

		$supplierData = $this->Supplier->find('list', array('fields' => array('Supplier.id', 'Supplier.name')
																));

		$purchaseOrderData = $this->PurchaseOrder->find('first', array('conditions' => array('PurchaseOrder.id' => $id)));

		$receivedOrderData = $this->ReceivedOrder->find('first', array('conditions' => array('ReceivedOrder.purchase_order_id' => $purchaseOrderData['PurchaseOrder']['id'])));

		$purchaseData = $this->PurchasingItem->find('all', array('conditions' => array('PurchasingItem.request_uuid' => $requestUUID)));

		if(empty($purchaseData[0]['PurchasingItem']['id'])){

			$itemHolder = "RequestItem";

			$itemData = $this->RequestItem->find('all', array('conditions' => array('RequestItem.request_uuid' => $requestUUID)));

		}else{

			$itemHolder = "PurchasingItem";

			$itemData = $this->PurchasingItem->find('all', array('conditions' => array('PurchasingItem.request_uuid' => $requestUUID)));

		}

		$receivedItemData = $this->ReceivedItem->find('all', array('conditions' => array('ReceivedItem.received_orders_id' => $purchaseOrderData['PurchaseOrder']['id'])));
		

		foreach ($itemData as $key1 => $value) {	

			$modelName = $value[$itemHolder]['model'];

				if($modelName == 'GeneralItem'){

					$foreignkeyHolder = $value[$itemHolder]['foreign_key'];

		        	$modelHolder = $value[$itemHolder]['model'];

					$itemDetails = $this->GeneralItem->find('list', array('fields' => array('GeneralItem.id', 'GeneralItem.name')
																		));  

					$requestPurchasingItem[$key1][$itemHolder]['name'] = $itemDetails[$value[$itemHolder]['foreign_key']];	

					$requestPurchasingItem[$key1][$itemHolder]['model'] = $value[$itemHolder]['model'];

					$requestPurchasingItem[$key1][$itemHolder]['quantity'] = $value[$itemHolder]['quantity'];	

					foreach ($receivedItemData as $key => $receivedValue) {	

						$conditions = array(); 

		    			$deliveredQuantityArray = array();

						$conditions = array_merge($conditions, array('ReceivedItem.model' => $modelHolder, 'ReceivedItem.foreign_key' => $foreignkeyHolder ));

						$received_items_data = $this->ReceivedItem->find('all', array('conditions' => $conditions));

						foreach ($received_items_data as $key => $value) {

							array_push($deliveredQuantityArray, $value['ReceivedItem']['quantity']);

						}

						if($receivedValue['ReceivedItem']['model'] == 'GeneralItem' && $receivedValue['ReceivedItem']['foreign_key'] == $foreignkeyHolder){
							
							$requestPurchasingItem[$key1][$itemHolder]['original_quantity'] = $receivedValue['ReceivedItem']['original_quantity'];	

							$requestPurchasingItem[$key1][$itemHolder]['delivered_quantity'] = array_sum($deliveredQuantityArray);	

						}
        			}
        			
		        } 

		        if($modelName == 'Substrate'){

		        	$foreignkeyHolder = $value[$itemHolder]['foreign_key'];

		        	$modelHolder = $value[$itemHolder]['model'];

					$itemDetails = $this->Substrate->find('list', array('fields' => array('Substrate.id', 'Substrate.name')
																		));     

					$requestPurchasingItem[$key1][$itemHolder]['name'] = $itemDetails[$value[$itemHolder]['foreign_key']];  

					$requestPurchasingItem[$key1][$itemHolder]['model'] = $value[$itemHolder]['model'];

					$requestPurchasingItem[$key1][$itemHolder]['quantity'] = $value[$itemHolder]['quantity'];                 
		        
					foreach ($receivedItemData as $key => $receivedValue) {	

						$conditions = array(); 

		    			$deliveredQuantityArray = array();

						$conditions = array_merge($conditions, array('ReceivedItem.model' => $modelHolder, 'ReceivedItem.foreign_key' => $foreignkeyHolder ));

						$received_items_data = $this->ReceivedItem->find('all', array('conditions' => $conditions));

						foreach ($received_items_data as $key => $value) {

							array_push($deliveredQuantityArray, $value['ReceivedItem']['quantity']);

						}


						if($receivedValue['ReceivedItem']['model'] == 'Substrate' && $receivedValue['ReceivedItem']['foreign_key'] == $foreignkeyHolder){

							$requestPurchasingItem[$key1][$itemHolder]['original_quantity'] = $receivedValue['ReceivedItem']['original_quantity'];	

							$requestPurchasingItem[$key1][$itemHolder]['delivered_quantity'] = array_sum($deliveredQuantityArray);
						}

        			}
		        } 

		        if($modelName == 'CompoundSubstrate'){

		        	$foreignkeyHolder = $value[$itemHolder]['foreign_key'];

		        	$modelHolder = $value[$itemHolder]['model'];

					$itemDetails = $this->CompoundSubstrate->find('list', array('fields' => array('CompoundSubstrate.id', 'CompoundSubstrate.name')
																		)); 

					$requestPurchasingItem[$key1][$itemHolder]['name'] = $itemDetails[$value[$itemHolder]['foreign_key']];

					$requestPurchasingItem[$key1][$itemHolder]['model'] = $value[$itemHolder]['model'];

					$requestPurchasingItem[$key1][$itemHolder]['quantity'] = $value[$itemHolder]['quantity'];

					foreach ($receivedItemData as $key => $receivedValue) {	

						$conditions = array(); 

		    			$deliveredQuantityArray = array();

						$conditions = array_merge($conditions, array('ReceivedItem.model' => $modelHolder, 'ReceivedItem.foreign_key' => $foreignkeyHolder ));

						$received_items_data = $this->ReceivedItem->find('all', array('conditions' => $conditions));

						foreach ($received_items_data as $key => $value) {

							array_push($deliveredQuantityArray, $value['ReceivedItem']['quantity']);

						}


						if($receivedValue['ReceivedItem']['model'] == 'CompoundSubstrate' && $receivedValue['ReceivedItem']['foreign_key'] == $foreignkeyHolder){

							$requestPurchasingItem[$key1][$itemHolder]['original_quantity'] = $receivedValue['ReceivedItem']['original_quantity'];	

							$requestPurchasingItem[$key1][$itemHolder]['delivered_quantity'] = array_sum($deliveredQuantityArray);
						}

        			}
		        } 

		        if($modelName == 'CorrugatedPaper'){

		        	$foreignkeyHolder = $value[$itemHolder]['foreign_key'];

		        	$modelHolder = $value[$itemHolder]['model'];

					$itemDetails = $this->CorrugatedPaper->find('list', array('fields' => array('CorrugatedPaper.id', 'CorrugatedPaper.name')
																		));  

					$requestPurchasingItem[$key1][$itemHolder]['name'] = $itemDetails[$value[$itemHolder]['foreign_key']];       

					$requestPurchasingItem[$key1][$itemHolder]['model'] = $value[$itemHolder]['model'];

					$requestPurchasingItem[$key1][$itemHolder]['quantity'] = $value[$itemHolder]['quantity'];   

		    		foreach ($receivedItemData as $key => $receivedValue) {	

		    			$conditions = array(); 

		    			$deliveredQuantityArray = array();

						$conditions = array_merge($conditions, array('ReceivedItem.model' => $modelHolder, 'ReceivedItem.foreign_key' => $foreignkeyHolder ));

						$received_items_data = $this->ReceivedItem->find('all', array('conditions' => $conditions));

						foreach ($received_items_data as $key => $value) {

							array_push($deliveredQuantityArray, $value['ReceivedItem']['quantity']);

						}

						if($receivedValue['ReceivedItem']['model'] == 'CorrugatedPaper' && $receivedValue['ReceivedItem']['foreign_key'] == $foreignkeyHolder){

							$requestPurchasingItem[$key1][$itemHolder]['original_quantity'] = $receivedValue['ReceivedItem']['original_quantity'];	

							$requestPurchasingItem[$key1][$itemHolder]['delivered_quantity'] = array_sum($deliveredQuantityArray);
						}

        			}

		    }


        }
 

   	$this->set(compact('purchaseOrderData', 'supplierData', 'firstName', 'lastName', 'requestData', 'itemDetails', 'requestPurchasingItem', 'itemData', 'receivedOrderData', 'type', 'requestItemData', 'itemHolder'));

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

    	$this->loadModel('WareHouse.ReceivedOrder');

    	$userData = $this->Session->read('Auth');

    	$this->ReceivedOrder->bind(array('ReceivedItem'));

    	$receivedData = $this->ReceivedOrder->find('first', array('conditions' => array('ReceivedOrder.id' => $id)));

		if (!empty($this->request->data)) {

			//pr($receivedData); exit;

			$this->loadModel('WareHouse.InRecord');

			$this->loadModel('WareHouse.ItemRecord');

			$this->loadModel('WareHouse.Stock');

			$idInRecord = $this->InRecord->saveInRecord($receivedData, $this->request->data, $userData['User']['id']);

			$this->ItemRecord->saveItemRecord($receivedData['ReceivedItem'], $idInRecord);
			
			$this->Stock->saveStock($receivedData, $this->request->data);

			$this->Session->setFlash(__('Received Items has been moved to stocks'), 'success');
          
            $this->redirect( array(
                'controller' => 'receivings',   
                'action' => 'receive'
            ));  

		}
    }

    public function out_record() {

    	$this->loadModel('Purchasing.Request');

    	$this->loadModel('User');

    	$this->loadModel('Role');

    	$userNameList = $this->User->find('list', array('fields' => array('User.id', 'User.fullname'))
													);

    	$userROleList = $this->User->find('list', array('fields' => array('User.id', 'User.role_id'))
													);

    	$roleData = $this->Role->find('list', array('fields' => array('Role.id', 'Role.name'))
													);

    	$this->Request->bind(array('PurchasingType'));

    	$requestData = $this->Request->find('all');

    	$this->set(compact('requestData', 'userNameList', 'roleData', 'userROleList'));


    }

}