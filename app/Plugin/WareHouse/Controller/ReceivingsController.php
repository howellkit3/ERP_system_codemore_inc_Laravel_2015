<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class ReceivingsController extends WareHouseAppController {

	public $uses = array('WareHouse.CustomField');

	public function index() {

		$this->loadModel('Purchasing.PurchaseOrder');

		$this->loadModel('Purchasing.Request');

		$this->loadModel('WareHouse.ReceivedItem');

		$this->loadModel('Supplier');

		$supplierData = $this->Supplier->find('list', array('fields' => array('Supplier.id', 'Supplier.name')
																));

		$this->PurchaseOrder->bind(array('Request'));

		$purchaseOrderData = $this->PurchaseOrder->find('all', array('conditions' => array('PurchaseOrder.status' => 1, 'PurchaseOrder.receive_item_status' => null),
															'order' => array('PurchaseOrder.created' => 'DESC')
															));
		
		$quantityData = $this->ReceivedItem->find('list', array('fields' => array('ReceivedItem.delivered_order_id','ReceivedItem.quantity')
																));

		$originalQuantityData = $this->ReceivedItem->find('list', array('fields' => array('ReceivedItem.id', 'ReceivedItem.original_quantity')
																));
		//pr($quantityData); exit;
	//	pr($purchaseOrderData); exit;
		// foreach ($purchaseOrderData as $key => $purchaseValue){
		// 	$arrholder[$key] = array();
		// 	$arrholder2[$key] = array();
		// 	 foreach ($receivedItemsData as $key2 => $value){
		// 	 //	pr( $value); exit;
		// 		if($purchaseValue['ReceivedOrder']['id'] == $value['ReceivedItem']['received_orders_id']){

		// 			$quantity = $value['ReceivedItem']['quantity'];
		// 			$original_quantity = $value['ReceivedItem']['original_quantity'];
					
		// 			array_push($arrholder[$key], $quantity);
		// 			array_push($arrholder2[$key], $original_quantity);
		// 			//break;
		// 		}
		// 		//break;
		// 	}

		// } //pr($arrholder); exit;

		//pr($arrholder); exit;

		$this->set(compact('purchaseOrderData', 'supplierData'));

    }

    public function receive_order($id = null, $requestUUID = null) {

    	$this->loadModel('WareHouse.ReceivedOrder');

    	$this->loadModel('WareHouse.ReceivedItem');

    	$this->loadModel('Purchasing.PurchaseOrder');

    	$this->loadModel('Purchasing.Request');

    	$this->loadModel('Purchasing.PurchasingItem');

    	$this->loadModel('GeneralItem');

    	$this->loadModel('Substrate');

    	$this->loadModel('CorrugatedPaper');

    	$this->loadModel('CompoundSubstrate');

    	$this->loadModel('Purchasing.RequestItem');

    	$this->loadModel('WareHouse.DeliveredOrder');

    	$this->loadModel('Supplier');

    	$this->loadModel('Unit');

		$userData = $this->Session->read('Auth');

		$requestData = $this->PurchasingItem->find('first', array('conditions' => array('PurchasingItem.request_uuid' => $requestUUID)));

		$supplierData = $this->Supplier->find('list', array('fields' => array('Supplier.id', 'Supplier.name')
																));

		$unitData = $this->Unit->find('list', array('fields' => array('Unit.id', 'Unit.unit')
																));

		$unitType = $this->Unit->find('list', array('fields' => array('Unit.id', 'Unit.type_measure')
																));

		$this->PurchaseOrder->bindReceive();

		$purchaseOrderData = $this->PurchaseOrder->find('first', array('conditions' => array('PurchaseOrder.id' => $id)));
		
		$receivedOrderData = $this->ReceivedOrder->find('first', array('conditions' => array('ReceivedOrder.purchase_order_id' => $purchaseOrderData['PurchaseOrder']['id'])));
	

		if(empty($requestData['PurchasingItem'])){

			$itemHolder = "RequestItem";

			$itemData = $this->RequestItem->find('all', array('conditions' => array('RequestItem.request_uuid' => $requestUUID)));

		}else{

			$itemHolder = "PurchasingItem";

			$itemData = $this->PurchasingItem->find('all', array('conditions' => array('PurchasingItem.request_uuid' => $requestUUID)));

		}

		$requestPurchasingItemArray = array();

		$receivedItemData = $this->ReceivedItem->find('all', array('conditions' => array('ReceivedItem.received_orders_id' => $id)));
		//pr($receivedItemData); exit;
		foreach ($itemData as $key => $value) {	

			if($value[$itemHolder]['model'] == 'GeneralItem'){

				$arrayGoodQuantity = array();

				$arrayRejectQuantity = array();

				$itemDetails = $this->GeneralItem->find('list', array('fields' => array('GeneralItem.id', 'GeneralItem.name')
																	));  

				$requestPurchasingItem[$key][$itemHolder]['name'] = $itemDetails[$value[$itemHolder]['foreign_key']];	

				$requestPurchasingItem[$key][$itemHolder]['foreign_key'] = $value[$itemHolder]['foreign_key'];

				$requestPurchasingItem[$key][$itemHolder]['model'] = $value[$itemHolder]['model'];

				$requestPurchasingItem[$key][$itemHolder]['unit_price'] = $value[$itemHolder]['unit_price'];

				$requestPurchasingItem[$key][$itemHolder]['unit_id'] = $value[$itemHolder]['quantity_unit_id'];

				$requestPurchasingItem[$key][$itemHolder]['original_quantity'] = $value[$itemHolder]['quantity'];

				array_push($requestPurchasingItemArray, $itemDetails[$value[$itemHolder]['foreign_key']]);

				foreach ($receivedItemData as $key1 => $receivedValue) {	

					if($receivedValue['ReceivedItem']['model'] == 'GeneralItem' && $receivedValue['ReceivedItem']['foreign_key'] == $value[$itemHolder]['foreign_key']){

						$arrayGoodQuantity[$key1] = $receivedValue['ReceivedItem']['quantity'];

						$arrayRejectQuantity[$key1] = $receivedValue['ReceivedItem']['reject_quantity'];

					} 	

				}  		
						$requestPurchasingItem[$key][$itemHolder]['good_quantity'] = array_sum($arrayGoodQuantity);
						
						$requestPurchasingItem[$key][$itemHolder]['reject_quantity'] = array_sum($arrayRejectQuantity);
 	

	        } 

	        if($value[$itemHolder]['model'] == 'Substrate'){

	        	$arrayGoodQuantity = array();

				$arrayRejectQuantity = array();

				$itemDetails = $this->Substrate->find('list', array('fields' => array('Substrate.id', 'Substrate.name')
																	));     

				$requestPurchasingItem[$key][$itemHolder]['name'] = $itemDetails[$value[$itemHolder]['foreign_key']]; 

				$requestPurchasingItem[$key][$itemHolder]['foreign_key'] = $value[$itemHolder]['foreign_key']; 

				$requestPurchasingItem[$key][$itemHolder]['model'] = $value[$itemHolder]['model'];

				$requestPurchasingItem[$key][$itemHolder]['unit_price'] = $value[$itemHolder]['unit_price'];

				$requestPurchasingItem[$key][$itemHolder]['unit_id'] = $value[$itemHolder]['quantity_unit_id'];

				$requestPurchasingItem[$key][$itemHolder]['original_quantity'] = $value[$itemHolder]['quantity'];

				array_push($requestPurchasingItemArray, $itemDetails[$value[$itemHolder]['foreign_key']]);      

	        	foreach ($receivedItemData as $key1 => $receivedValue) {	

					if($receivedValue['ReceivedItem']['model'] == 'Substrate' && $receivedValue['ReceivedItem']['foreign_key'] == $value[$itemHolder]['foreign_key']){

						$arrayGoodQuantity[$key1] = $receivedValue['ReceivedItem']['quantity'];

						$arrayRejectQuantity[$key1] = $receivedValue['ReceivedItem']['reject_quantity'];

					} 	

				}  		 

						$requestPurchasingItem[$key][$itemHolder]['good_quantity'] = array_sum($arrayGoodQuantity);
						
						$requestPurchasingItem[$key][$itemHolder]['reject_quantity'] = array_sum($arrayRejectQuantity);
 	

	        } 

	        if($value[$itemHolder]['model'] == 'CompoundSubstrate'){

	        	$arrayGoodQuantity = array();

				$arrayRejectQuantity = array();

				$itemDetails = $this->CompoundSubstrate->find('list', array('fields' => array('CompoundSubstrate.id', 'CompoundSubstrate.name')
																	)); 

				$requestPurchasingItem[$key][$itemHolder]['name'] = $itemDetails[$value[$itemHolder]['foreign_key']];

				$requestPurchasingItem[$key][$itemHolder]['foreign_key'] = $value[$itemHolder]['foreign_key'];

				$requestPurchasingItem[$key][$itemHolder]['model'] = $value[$itemHolder]['model'];

				$requestPurchasingItem[$key][$itemHolder]['unit_price'] = $value[$itemHolder]['unit_price'];

				$requestPurchasingItem[$key][$itemHolder]['unit_id'] = $value[$itemHolder]['quantity_unit_id'];

				$requestPurchasingItem[$key][$itemHolder]['original_quantity'] = $value[$itemHolder]['quantity'];

				array_push($requestPurchasingItemArray, $itemDetails[$value[$itemHolder]['foreign_key']]);

				foreach ($receivedItemData as $key1 => $receivedValue) {	

					if($receivedValue['ReceivedItem']['model'] == 'CompoundSubstrate' && $receivedValue['ReceivedItem']['foreign_key'] == $value[$itemHolder]['foreign_key']){

						$arrayGoodQuantity[$key1] = $receivedValue['ReceivedItem']['quantity'];

						$arrayRejectQuantity[$key1] = $receivedValue['ReceivedItem']['reject_quantity'];
						
					} 	

				}  		

						$requestPurchasingItem[$key][$itemHolder]['good_quantity'] = array_sum($arrayGoodQuantity);
						
						$requestPurchasingItem[$key][$itemHolder]['reject_quantity'] = array_sum($arrayRejectQuantity);
 						
	        } 

	        if($value[$itemHolder]['model'] == 'CorrugatedPaper'){

	        	$arrayGoodQuantity = array();

				$arrayRejectQuantity = array();

				$itemDetails = $this->CorrugatedPaper->find('list', array('fields' => array('CorrugatedPaper.id', 'CorrugatedPaper.name')
																	));  

				$requestPurchasingItem[$key][$itemHolder]['name'] = $itemDetails[$value[$itemHolder]['foreign_key']]; 

				$requestPurchasingItem[$key][$itemHolder]['foreign_key'] = $value[$itemHolder]['foreign_key'];

				$requestPurchasingItem[$key][$itemHolder]['model'] = $value[$itemHolder]['model'];

				$requestPurchasingItem[$key][$itemHolder]['unit_price'] = $value[$itemHolder]['unit_price'];

				$requestPurchasingItem[$key][$itemHolder]['unit_id'] = $value[$itemHolder]['quantity_unit_id'];

				$requestPurchasingItem[$key][$itemHolder]['original_quantity'] = $value[$itemHolder]['quantity'];

				array_push($requestPurchasingItemArray, $itemDetails[$value[$itemHolder]['foreign_key']]);                        
	       
				foreach ($receivedItemData as $key1 => $receivedValue) {	

					if($receivedValue['ReceivedItem']['model'] == 'CorrugatedPaper' && $receivedValue['ReceivedItem']['foreign_key'] == $value[$itemHolder]['foreign_key']){

						$arrayGoodQuantity[$key1] = $receivedValue['ReceivedItem']['quantity'];

						$arrayRejectQuantity[$key1] = $receivedValue['ReceivedItem']['reject_quantity'];

					} 	

				}  		 

						$requestPurchasingItem[$key][$itemHolder]['good_quantity'] = array_sum($arrayGoodQuantity);
						
						$requestPurchasingItem[$key][$itemHolder]['reject_quantity'] = array_sum($arrayRejectQuantity);
 	
	        } 

        }

        
		if (!empty($this->request->data)) {

			//pr($this->request->data); exit;

			if(empty($this->request->data['requestPurchasingItem'])){
        	
	        	$this->Session->setFlash(__('No Items Selected'), 'error'); 
	          
	            $this->redirect( array(
	                'controller' => 'receivings',   
	                'action' => 'receive_order', $id, $requestUUID
	            ));  

        	}

			ksort($this->request->data['requestPurchasingItem']);

			$receivedData = $this->ReceivedOrder->find('first', array('conditions' => array('ReceivedOrder.purchase_order_id' => $id)));
				
			$this->PurchaseOrder->id = $id;

			if(empty($receivedData['ReceivedOrder']['id'])){

				$itemId = $this->ReceivedOrder->saveReceivedOrders($this->request->data['ReceivedItems'],$userData['User']['id'],$id);

				$this->PurchaseOrder->saveField('status_id', 10);

			}else{

				$itemId = $receivedData['ReceivedOrder']['id'];

			}

			

			$deliveryUUID = $this->DeliveredOrder->saveDeliveredOrder($userData['User']['id'], $itemId, $id, $this->request->data['DeliveredOrders']);

			$this->ReceivedItem->saveReceivedItems($itemId, $this->request->data, $deliveryUUID);

			$remaining = 0;

			foreach ($this->request->data['requestPurchasingItem'] as $key => $requestDataList){

				$remaining = $remaining + $requestDataList['quantity']; 

			}

			$totalRemaining = $this->request->data['Receivings']['remainingquantity'] - $remaining;

			if(!empty($this->request->data['Receivings']['receive_status']) || $totalRemaining <= 0){


				$this->PurchaseOrder->saveField('receive_item_status', 1);

			}

			$this->Session->setFlash(__('Order has been received'), 'success'); 
          
            $this->redirect( array(
                'controller' => 'receivings',   
                'action' => 'view', $id, $requestUUID,0
            ));  

		}
	
		$this->set(compact('requestData', 'requestPurchasingItem', 'purchaseOrderData', 'supplierData', 'unitData', 'unitType', 'itemHolder','receivedOrderData'));

    }

    public function receive() {

    	$this->loadModel('WareHouse.DeliveredOrder');

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

		$this->DeliveredOrder->bind('ReceivedItem', 'ReceivedOrder');

        $this->DeliveredOrder->recursive = 1;

        $limit = 10;

        $conditions = array();

        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'fields' => array(
                'ReceivedOrder.uuid',
                'ReceivedOrder.created',
                'ReceivedOrder.id',  
                'ReceivedOrder.status_id', 
                'ReceivedOrder.purchase_order_uuid', 
                'ReceivedOrder.supplier_id',
                // 'PurchaseOrder.uuid', 
                // 'PurchaseOrder.supplier_id', 
                // 'PurchaseOrder.request_id',
                'DeliveredOrder.uuid', 
                'DeliveredOrder.status_id',
                'DeliveredOrder.id',
                'DeliveredOrder.purchase_order_uuid',
                'DeliveredOrder.purchase_orders_id'),
            'order' => 'DeliveredOrder.id DESC',
        );

        $received_orders = $this->paginate('DeliveredOrder');

      	$purchaseOrderSupplierData = $this->PurchaseOrder->find('list', array('fields' => array('PurchaseOrder.id', 'PurchaseOrder.supplier_id')
																));

      	$purchaseOrderUUIDData = $this->PurchaseOrder->find('list', array('fields' => array('PurchaseOrder.id', 'PurchaseOrder.uuid')
																));

        if(!empty($received_orders[0]['PurchaseOrder']['request_id'])){

			$uuid = $receiveData[$received_orders[0]['PurchaseOrder']['request_id']];

		}

		$this->set(compact('received_orders', 'supplierData', 'userName', 'uuid', 'userName', 'userNameList', 'areaList', 'purchaseOrderUUIDData', 'purchaseOrderSupplierData'));

    }
	    	    
	 public function view($id = null, $requestUUID = null, $type = null) {

	 	$this->loadModel('Purchasing.PurchaseOrder');

	 	$this->loadModel('Purchasing.Request');

	 	$this->loadModel('Supplier');

	 	$this->loadModel('User');

	 	$this->loadModel('Unit');

	 	$this->loadModel('Purchasing.PurchasingItem');

		$this->loadModel('Purchasing.RequestItem');

		$this->loadModel('WareHouse.ReceivedOrder');

		$this->loadModel('WareHouse.ReceivedItem');

		$lastName = $this->User->find('list', array('fields' => array('User.id', 'User.last_name')
																));

		$firstName = $this->User->find('list', array('fields' => array('User.id', 'User.first_name')
																));

		$unitType = $this->Unit->find('list', array('fields' => array('Unit.id', 'Unit.type_measure')
																));

		$unitData = $this->Unit->find('list', array('fields' => array('Unit.id', 'Unit.unit')
																));

		$supplierData = $this->Supplier->find('list', array('fields' => array('Supplier.id', 'Supplier.name')
																));
		$this->PurchaseOrder->bind('DeliveredOrder');

		$purchaseOrderData = $this->PurchaseOrder->find('first', array('conditions' => array('PurchaseOrder.id' => $id)));

		$receivedOrderData = $this->ReceivedOrder->find('first', array('conditions' => array('ReceivedOrder.purchase_order_id' => $purchaseOrderData['PurchaseOrder']['id'])));
		//pr($purchaseOrderData); exit;
		$requestData = $this->PurchasingItem->find('first', array('conditions' => array('PurchasingItem.request_uuid' => $requestUUID)));

		if(empty($requestData['PurchasingItem'])){

			$itemHolder = "RequestItem";

			$itemData = $this->RequestItem->find('all', array('conditions' => array('RequestItem.request_uuid' => $requestUUID)));

		}else{

			$itemHolder = "PurchasingItem";

			$itemData = $this->PurchasingItem->find('all', array('conditions' => array('PurchasingItem.request_uuid' => $requestUUID)));

		}

		$receivedItemData = $this->ReceivedItem->find('all', array('conditions' => array('ReceivedItem.received_orders_id' => $id)));

		foreach ($itemData as $key1 => $value) {	

				if($value[$itemHolder]['model'] == 'GeneralItem'){

					$arrayGoodQuantity = array();

					$arrayRejectQuantity = array();

					$this->loadModel('GeneralItem');

					$itemDetails = $this->GeneralItem->find('list', array('fields' => array('GeneralItem.id', 'GeneralItem.name')
																		));  

					$requestPurchasingItem[$key1][$itemHolder]['name'] = !empty($itemDetails[$value[$itemHolder]['foreign_key']]) ? $itemDetails[$value[$itemHolder]['foreign_key']] : " ";	

					$requestPurchasingItem[$key1][$itemHolder]['model'] = $value[$itemHolder]['model'];

					$requestPurchasingItem[$key1][$itemHolder]['unit_id'] = $unitType[$value[$itemHolder]['quantity_unit_id']];
					
					$requestPurchasingItem[$key1][$itemHolder]['quantity'] = $value[$itemHolder]['quantity'];		

					foreach ($receivedItemData as $key => $receivedValue) {	

						if($receivedValue['ReceivedItem']['model'] == 'GeneralItem' && $receivedValue['ReceivedItem']['foreign_key'] == $value[$itemHolder]['foreign_key']){

							$arrayGoodQuantity[$key] = $receivedValue['ReceivedItem']['quantity'];

							$arrayRejectQuantity[$key] = $receivedValue['ReceivedItem']['reject_quantity'];

							$requestPurchasingItem[$key1][$itemHolder]['original_quantity'] = $receivedValue['ReceivedItem']['original_quantity'];	

						} 	

					}  		 

							$requestPurchasingItem[$key1][$itemHolder]['good_quantity'] = array_sum($arrayGoodQuantity);
							
							$requestPurchasingItem[$key1][$itemHolder]['reject_quantity'] = array_sum($arrayRejectQuantity);
 	
        			
		        } 

		        if($value[$itemHolder]['model'] == 'Substrate'){

		        	$arrayGoodQuantity = array();

					$arrayRejectQuantity = array();

					$this->loadModel('Substrate');

					$itemDetails = $this->Substrate->find('list', array('fields' => array('Substrate.id', 'Substrate.name')
																		));     

					$requestPurchasingItem[$key1][$itemHolder]['name'] = $itemDetails[$value[$itemHolder]['foreign_key']];  

					$requestPurchasingItem[$key1][$itemHolder]['model'] = $value[$itemHolder]['model'];

					$requestPurchasingItem[$key1][$itemHolder]['unit_id'] = $unitType[$value[$itemHolder]['quantity_unit_id']];

					$requestPurchasingItem[$key1][$itemHolder]['quantity'] = $value[$itemHolder]['quantity'];                 
		        
					foreach ($receivedItemData as $key => $receivedValue) {	

						if($receivedValue['ReceivedItem']['model'] == 'Substrate' && $receivedValue['ReceivedItem']['foreign_key'] == $value[$itemHolder]['foreign_key']){

							$arrayGoodQuantity[$key] = $receivedValue['ReceivedItem']['quantity'];

							$arrayRejectQuantity[$key] = $receivedValue['ReceivedItem']['reject_quantity'];

							$requestPurchasingItem[$key1][$itemHolder]['original_quantity'] = $receivedValue['ReceivedItem']['original_quantity'];	

						} 	

					}  		 

							$requestPurchasingItem[$key1][$itemHolder]['good_quantity'] = array_sum($arrayGoodQuantity);
							
							$requestPurchasingItem[$key1][$itemHolder]['reject_quantity'] = array_sum($arrayRejectQuantity);
 	
		        } 

		        if($value[$itemHolder]['model'] == 'CompoundSubstrate'){

		        	$arrayGoodQuantity = array();

					$arrayRejectQuantity = array();

					$this->loadModel('CompoundSubstrate');

					$itemDetails = $this->CompoundSubstrate->find('list', array('fields' => array('CompoundSubstrate.id', 'CompoundSubstrate.name')
																		)); 
					$requestPurchasingItem[$key1][$itemHolder]['name'] = $itemDetails[$value[$itemHolder]['foreign_key']];

					$requestPurchasingItem[$key1][$itemHolder]['model'] = $value[$itemHolder]['model'];

					$requestPurchasingItem[$key1][$itemHolder]['unit_id'] = $unitType[$value[$itemHolder]['quantity_unit_id']];

					$requestPurchasingItem[$key1][$itemHolder]['quantity'] = $value[$itemHolder]['quantity'];

					foreach ($receivedItemData as $key => $receivedValue) {	

						if($receivedValue['ReceivedItem']['model'] == 'CompoundSubstrate' && $receivedValue['ReceivedItem']['foreign_key'] == $value[$itemHolder]['foreign_key']){

							$arrayGoodQuantity[$key] = $receivedValue['ReceivedItem']['quantity'];

							$arrayRejectQuantity[$key] = $receivedValue['ReceivedItem']['reject_quantity'];

							$requestPurchasingItem[$key1][$itemHolder]['original_quantity'] = $receivedValue['ReceivedItem']['original_quantity'];	

						} 	

					}  		 

							$requestPurchasingItem[$key1][$itemHolder]['good_quantity'] = array_sum($arrayGoodQuantity);
							
							$requestPurchasingItem[$key1][$itemHolder]['reject_quantity'] = array_sum($arrayRejectQuantity);
 					
		        } 

		        if($value[$itemHolder]['model'] == 'CorrugatedPaper'){

		        	$arrayGoodQuantity = array();

					$arrayRejectQuantity = array();

					$this->loadModel('CorrugatedPaper');

					$itemDetails = $this->CorrugatedPaper->find('list', array('fields' => array('CorrugatedPaper.id', 'CorrugatedPaper.name')
																		));  

					$requestPurchasingItem[$key1][$itemHolder]['name'] = $itemDetails[$value[$itemHolder]['foreign_key']];       

					$requestPurchasingItem[$key1][$itemHolder]['model'] = $value[$itemHolder]['model'];

					$requestPurchasingItem[$key1][$itemHolder]['unit_id'] = $unitType[$value[$itemHolder]['quantity_unit_id']];
					
					$requestPurchasingItem[$key1][$itemHolder]['quantity'] = $value[$itemHolder]['quantity'];                    
		    		
		    		foreach ($receivedItemData as $key => $receivedValue) {	

						if($receivedValue['ReceivedItem']['model'] == 'CorrugatedPaper' && $receivedValue['ReceivedItem']['foreign_key'] == $value[$itemHolder]['foreign_key']){

							$arrayGoodQuantity[$key] = $receivedValue['ReceivedItem']['quantity'];

							$arrayRejectQuantity[$key] = $receivedValue['ReceivedItem']['reject_quantity'];

							$requestPurchasingItem[$key1][$itemHolder]['original_quantity'] = $receivedValue['ReceivedItem']['original_quantity'];	

						} 	

					}  		 

					$requestPurchasingItem[$key1][$itemHolder]['good_quantity'] = array_sum($arrayGoodQuantity);
					
					$requestPurchasingItem[$key1][$itemHolder]['reject_quantity'] = array_sum($arrayRejectQuantity);
 	
		    }


        }


   	$this->set(compact('unitData','purchaseOrderData', 'supplierData', 'firstName', 'lastName', 'requestData', 'itemDetails', 'requestPurchasingItem', 'itemData', 'receivedOrderData', 'type', 'requestItemData', 'itemHolder'));

    }

    public function view_receive($id = null, $requestUUID = null, $type = null) {

	 	$this->loadModel('Purchasing.PurchaseOrder');

	 	$this->loadModel('Purchasing.Request');

	 	$this->loadModel('Supplier');

	 	$this->loadModel('User');

	 	$this->loadModel('Unit');

	 	$this->loadModel('Area');

	 	$this->loadModel('Purchasing.PurchasingItem');

		$this->loadModel('Purchasing.RequestItem');

		$this->loadModel('WareHouse.DeliveredOrder');

		$lastName = $this->User->find('list', array('fields' => array('User.id', 'User.last_name')
																));

		$firstName = $this->User->find('list', array('fields' => array('User.id', 'User.first_name')
																));

		$unitData = $this->Unit->find('list', array('fields' => array('Unit.id', 'Unit.unit')
																));

		$unitType = $this->Unit->find('list', array('fields' => array('Unit.id', 'Unit.type_measure')
																));

		$supplierData = $this->Supplier->find('list', array('fields' => array('Supplier.id', 'Supplier.name')
																));

		$requestData = $this->Request->find('first', array('conditions' => array('Request.uuid' => $requestUUID)));
		
		$areaList = $this->Area->find('list', array('fields' => array('Area.id', 'Area.name')
		 														));

		$userNameList = $this->User->find('list', array('fields' => array('User.id', 'User.fullname'),
		 												'conditions' => array( 
		 													'User.role_id' => 4)));

		if(empty($requestData['PurchaseItem'])){

			$itemTypeHolder = "RequestItem";

			$itemData = $this->RequestItem->find('all', array('conditions' => array('RequestItem.request_uuid' => $requestUUID)));

		}else{

			$itemTypeHolder = "PurchaseItem";

			$itemData = $this->PurchaseItem->find('all', array('conditions' => array('RequestItem.request_uuid' => $requestUUID)));

		}

		$itemHolder = "ReceivedItem";


		$this->DeliveredOrder->bind('ReceivedItem', 'PurchaseOrder', 'ReceivedOrder', 'ReceivedReceiptItem');

		$receivedItemData = $this->DeliveredOrder->find('first', array('conditions' => array('DeliveredOrder.id' => $id)));
		
		//$purchaseOrderData = $this->PurchaseOrder->find('first', array('conditions' => array('PurchaseOrder.id' => $receivedItemData[0]['DeliveredOrder']['purchase_orders_id'] )));
		//pr($receivedItemData); exit;
		$deliveredDataID = $receivedItemData['DeliveredOrder']['id'];
	//	pr($receivedItemData); exit;
		//foreach ($receivedItemData as $key1 => $value) {

			if(empty($receivedItemData['ReceivedItem'])){

				$modelHolder = "ReceivedReceiptItem";

			}else{

				$modelHolder = "ReceivedItem";

			}

			foreach ($receivedItemData[$modelHolder] as $key => $valueOfValue) {	

				if($valueOfValue['model'] == 'GeneralItem'){

					$this->loadModel('GeneralItem');

					$itemDetails = $this->GeneralItem->find('list', array('fields' => array('GeneralItem.id', 'GeneralItem.name')
					 													));  

					$receiveItem[$key][$itemHolder]['id']	= $valueOfValue['id'];

					$receiveItem[$key][$itemHolder]['name'] = $itemDetails[$valueOfValue['foreign_key']];	

					$receiveItem[$key][$itemHolder]['model'] = $valueOfValue['model'];

					$receiveItem[$key][$itemHolder]['quantity'] = $valueOfValue['quantity'];	

					$receiveItem[$key][$itemHolder]['unit_id'] = $valueOfValue['quantity_unit_id'];	

					$receiveItem[$key][$itemHolder]['good_quantity'] = $valueOfValue['quantity'];

					if($modelHolder == 'ReceivedItem'){
					
						$receiveItem[$key][$itemHolder]['reject_quantity'] = $valueOfValue['reject_quantity'];

						$receiveItem[$key][$itemHolder]['unit_price'] = $valueOfValue['unit_price'];

						$receiveItem[$key][$itemHolder]['uuid'] = $valueOfValue['request_uuid'];

						$receiveItem[$key][$itemHolder]['original_quantity'] = $valueOfValue['original_quantity'];	

					}
        		
		        } 

		        if($valueOfValue['model'] == 'Substrate'){

		        	$this->loadModel('Substrate');

		        	$itemDetails = $this->Substrate->find('list', array('fields' => array('Substrate.id', 'Substrate.name')
					 													));  

		        	$receiveItem[$key][$itemHolder]['id']	= $valueOfValue['id'];

					$receiveItem[$key][$itemHolder]['name'] = $itemDetails[$valueOfValue['foreign_key']];	

					$receiveItem[$key][$itemHolder]['model'] = $valueOfValue['model'];

					$receiveItem[$key][$itemHolder]['quantity'] = $valueOfValue['quantity'];	

					$receiveItem[$key][$itemHolder]['unit_id'] = !empty($valueOfValue['quantity_unit_id']) ? $valueOfValue['quantity_unit_id'] : 14 ;	

					$receiveItem[$key][$itemHolder]['good_quantity'] = $valueOfValue['quantity'];

					if($modelHolder == 'ReceivedItem'){
					
						$receiveItem[$key][$itemHolder]['reject_quantity'] = $valueOfValue['reject_quantity'];

						$receiveItem[$key][$itemHolder]['unit_price'] = $valueOfValue['unit_price'];

						$receiveItem[$key][$itemHolder]['uuid'] = $valueOfValue['request_uuid'];

						$receiveItem[$key][$itemHolder]['original_quantity'] = $valueOfValue['original_quantity'];	

					}
 	
		        } 

		        if($valueOfValue['model'] == 'CompoundSubstrate'){

		        	$this->loadModel('CompoundSubstrate');

		        	$itemDetails = $this->CompoundSubstrate->find('list', array('fields' => array('CompoundSubstrate.id', 'CompoundSubstrate.name')
					 													));  

		        	$receiveItem[$key][$itemHolder]['id']	= $valueOfValue['id'];

					$receiveItem[$key][$itemHolder]['name'] = $itemDetails[$valueOfValue['foreign_key']];	

					$receiveItem[$key][$itemHolder]['model'] = $valueOfValue['model'];

					$receiveItem[$key][$itemHolder]['quantity'] = $valueOfValue['quantity'];	

					$receiveItem[$key][$itemHolder]['unit_id'] = !empty($valueOfValue['quantity_unit_id']) ? $valueOfValue['quantity_unit_id'] : 14 ;	

					$receiveItem[$key][$itemHolder]['good_quantity'] = $valueOfValue['quantity'];

					if($modelHolder == 'ReceivedItem'){
					
						$receiveItem[$key][$itemHolder]['reject_quantity'] = $valueOfValue['reject_quantity'];

						$receiveItem[$key][$itemHolder]['unit_price'] = $valueOfValue['unit_price'];

						$receiveItem[$key][$itemHolder]['uuid'] = $valueOfValue['request_uuid'];

						$receiveItem[$key][$itemHolder]['original_quantity'] = $valueOfValue['original_quantity'];	

					}
		        
		        } 

		        if($valueOfValue['model'] == 'CorrugatedPaper'){

		        	$this->loadModel('CorrugatedPaper');

		        	$itemDetails = $this->CorrugatedPaper->find('list', array('fields' => array('CorrugatedPaper.id', 'CorrugatedPaper.name')
					 													));  

		        	$receiveItem[$key][$itemHolder]['id']	= $valueOfValue['id'];

					$receiveItem[$key][$itemHolder]['name'] = $itemDetails[$valueOfValue['foreign_key']];	

					$receiveItem[$key][$itemHolder]['model'] = $valueOfValue['model'];

					$receiveItem[$key][$itemHolder]['quantity'] = $valueOfValue['quantity'];	

					$receiveItem[$key][$itemHolder]['unit_id'] = !empty($valueOfValue['quantity_unit_id']) ? $valueOfValue['quantity_unit_id'] : 14 ;	

					$receiveItem[$key][$itemHolder]['good_quantity'] = $valueOfValue['quantity'];

					if($modelHolder == 'ReceivedItem'){
					
						$receiveItem[$key][$itemHolder]['reject_quantity'] = $valueOfValue['reject_quantity'];

						$receiveItem[$key][$itemHolder]['unit_price'] = $valueOfValue['unit_price'];

						$receiveItem[$key][$itemHolder]['uuid'] = $valueOfValue['request_uuid'];

						$receiveItem[$key][$itemHolder]['original_quantity'] = $valueOfValue['original_quantity'];	

					}
		   		}	

        }


   	$this->set(compact('itemTypeHolder','unitData','purchaseOrderData','userName', 'supplierData', 'firstName', 'lastName', 'requestData', 'itemDetails', 'receiveItem', 'itemData', 'receivedOrderData', 'type', 'requestItemData', 'itemHolder', 'deliveredDataID', 'receivedItemData', 'areaList', 'userNameList'));

    }

    public function view_receive_edit($id = null, $requestUUID = null, $type = null) {

	 	$this->loadModel('Purchasing.PurchaseOrder');

	 	$this->loadModel('Purchasing.Request');

	 	$this->loadModel('Supplier');

	 	$this->loadModel('User');

	 	$this->loadModel('Unit');

	 	$this->loadModel('Area');

	 	$this->loadModel('Purchasing.PurchasingItem');

		$this->loadModel('Purchasing.RequestItem');

		$this->loadModel('WareHouse.DeliveredOrder');

		$lastName = $this->User->find('list', array('fields' => array('User.id', 'User.last_name')
																));

		$firstName = $this->User->find('list', array('fields' => array('User.id', 'User.first_name')
																));

		$unitData = $this->Unit->find('list', array('fields' => array('Unit.id', 'Unit.unit')
																));

		$unitType = $this->Unit->find('list', array('fields' => array('Unit.id', 'Unit.type_measure')
																));

		$supplierData = $this->Supplier->find('list', array('fields' => array('Supplier.id', 'Supplier.name')
																));

		$requestData = $this->Request->find('first', array('conditions' => array('Request.uuid' => $requestUUID)));
		
		$areaList = $this->Area->find('list', array('fields' => array('Area.id', 'Area.name')
		 														));

		$userNameList = $this->User->find('list', array('fields' => array('User.id', 'User.fullname'),
		 												'conditions' => array( 
		 													'User.role_id' => 4)));

		if(empty($requestData['PurchaseItem'])){

			$itemTypeHolder = "RequestItem";

			$itemData = $this->RequestItem->find('all', array('conditions' => array('RequestItem.request_uuid' => $requestUUID)));

		}else{

			$itemTypeHolder = "PurchaseItem";

			$itemData = $this->PurchaseItem->find('all', array('conditions' => array('RequestItem.request_uuid' => $requestUUID)));

		}

		$itemHolder = "ReceivedItem";


		$this->DeliveredOrder->bind('ReceivedItem', 'PurchaseOrder', 'ReceivedOrder', 'ReceivedReceiptItem');

		$receivedItemData = $this->DeliveredOrder->find('first', array('conditions' => array('DeliveredOrder.id' => $id)));
		
		//$purchaseOrderData = $this->PurchaseOrder->find('first', array('conditions' => array('PurchaseOrder.id' => $receivedItemData[0]['DeliveredOrder']['purchase_orders_id'] )));
		//pr($receivedItemData); exit;
		$deliveredDataID = $receivedItemData['DeliveredOrder']['id'];
	//	pr($receivedItemData); exit;
		//foreach ($receivedItemData as $key1 => $value) {

			if(empty($receivedItemData['ReceivedItem'])){

				$modelHolder = "ReceivedReceiptItem";

			}else{

				$modelHolder = "ReceivedItem";

			}

			foreach ($receivedItemData[$modelHolder] as $key => $valueOfValue) {	

				if($valueOfValue['model'] == 'GeneralItem'){

					$this->loadModel('GeneralItem');

					$itemDetails = $this->GeneralItem->find('list', array('fields' => array('GeneralItem.id', 'GeneralItem.name')
					 													));  

					$receiveItem[$key][$itemHolder]['id']	= $valueOfValue['id'];

					$receiveItem[$key][$itemHolder]['name'] = $itemDetails[$valueOfValue['foreign_key']];	

					$receiveItem[$key][$itemHolder]['model'] = $valueOfValue['model'];

					$receiveItem[$key][$itemHolder]['quantity'] = $valueOfValue['quantity'];	

					$receiveItem[$key][$itemHolder]['unit_id'] = $valueOfValue['quantity_unit_id'];	

					$receiveItem[$key][$itemHolder]['good_quantity'] = $valueOfValue['quantity'];

					if($modelHolder == 'ReceivedItem'){
					
						$receiveItem[$key][$itemHolder]['reject_quantity'] = $valueOfValue['reject_quantity'];

						$receiveItem[$key][$itemHolder]['unit_price'] = $valueOfValue['unit_price'];

						$receiveItem[$key][$itemHolder]['uuid'] = $valueOfValue['request_uuid'];

						$receiveItem[$key][$itemHolder]['original_quantity'] = $valueOfValue['original_quantity'];	

					}
        		
		        } 

		        if($valueOfValue['model'] == 'Substrate'){

		        	$this->loadModel('Substrate');

		        	$itemDetails = $this->Substrate->find('list', array('fields' => array('Substrate.id', 'Substrate.name')
					 													));  

		        	$receiveItem[$key][$itemHolder]['id']	= $valueOfValue['id'];

					$receiveItem[$key][$itemHolder]['name'] = $itemDetails[$valueOfValue['foreign_key']];	

					$receiveItem[$key][$itemHolder]['model'] = $valueOfValue['model'];

					$receiveItem[$key][$itemHolder]['quantity'] = $valueOfValue['quantity'];	

					$receiveItem[$key][$itemHolder]['unit_id'] = !empty($valueOfValue['quantity_unit_id']) ? $valueOfValue['quantity_unit_id'] : 14 ;	

					$receiveItem[$key][$itemHolder]['good_quantity'] = $valueOfValue['quantity'];

					if($modelHolder == 'ReceivedItem'){
					
						$receiveItem[$key][$itemHolder]['reject_quantity'] = $valueOfValue['reject_quantity'];

						$receiveItem[$key][$itemHolder]['unit_price'] = $valueOfValue['unit_price'];

						$receiveItem[$key][$itemHolder]['uuid'] = $valueOfValue['request_uuid'];

						$receiveItem[$key][$itemHolder]['original_quantity'] = $valueOfValue['original_quantity'];	

					}
 	
		        } 

		        if($valueOfValue['model'] == 'CompoundSubstrate'){

		        	$this->loadModel('CompoundSubstrate');

		        	$itemDetails = $this->CompoundSubstrate->find('list', array('fields' => array('CompoundSubstrate.id', 'CompoundSubstrate.name')
					 													));  

		        	$receiveItem[$key][$itemHolder]['id']	= $valueOfValue['id'];

					$receiveItem[$key][$itemHolder]['name'] = $itemDetails[$valueOfValue['foreign_key']];	

					$receiveItem[$key][$itemHolder]['model'] = $valueOfValue['model'];

					$receiveItem[$key][$itemHolder]['quantity'] = $valueOfValue['quantity'];	

					$receiveItem[$key][$itemHolder]['unit_id'] = !empty($valueOfValue['quantity_unit_id']) ? $valueOfValue['quantity_unit_id'] : 14 ;	

					$receiveItem[$key][$itemHolder]['good_quantity'] = $valueOfValue['quantity'];

					if($modelHolder == 'ReceivedItem'){
					
						$receiveItem[$key][$itemHolder]['reject_quantity'] = $valueOfValue['reject_quantity'];

						$receiveItem[$key][$itemHolder]['unit_price'] = $valueOfValue['unit_price'];

						$receiveItem[$key][$itemHolder]['uuid'] = $valueOfValue['request_uuid'];

						$receiveItem[$key][$itemHolder]['original_quantity'] = $valueOfValue['original_quantity'];	

					}
		        
		        } 

		        if($valueOfValue['model'] == 'CorrugatedPaper'){

		        	$this->loadModel('CorrugatedPaper');

		        	$itemDetails = $this->CorrugatedPaper->find('list', array('fields' => array('CorrugatedPaper.id', 'CorrugatedPaper.name')
					 													));  

		        	$receiveItem[$key][$itemHolder]['id']	= $valueOfValue['id'];

					$receiveItem[$key][$itemHolder]['name'] = $itemDetails[$valueOfValue['foreign_key']];	

					$receiveItem[$key][$itemHolder]['model'] = $valueOfValue['model'];

					$receiveItem[$key][$itemHolder]['quantity'] = $valueOfValue['quantity'];	

					$receiveItem[$key][$itemHolder]['unit_id'] = !empty($valueOfValue['quantity_unit_id']) ? $valueOfValue['quantity_unit_id'] : 14 ;	

					$receiveItem[$key][$itemHolder]['good_quantity'] = $valueOfValue['quantity'];

					if($modelHolder == 'ReceivedItem'){
					
						$receiveItem[$key][$itemHolder]['reject_quantity'] = $valueOfValue['reject_quantity'];

						$receiveItem[$key][$itemHolder]['unit_price'] = $valueOfValue['unit_price'];

						$receiveItem[$key][$itemHolder]['uuid'] = $valueOfValue['request_uuid'];

						$receiveItem[$key][$itemHolder]['original_quantity'] = $valueOfValue['original_quantity'];	

					}
		   		}	

        }


   	$this->set(compact('itemTypeHolder','unitData','purchaseOrderData','userName', 'supplierData', 'firstName', 'lastName', 'requestData', 'itemDetails', 'receiveItem', 'itemData', 'receivedOrderData', 'type', 'requestItemData', 'itemHolder', 'deliveredDataID', 'receivedItemData', 'areaList', 'userNameList'));

    }

    public function delivered_order_edit() {

    	//pr($this->request->data); exit;

	   	$userData = $this->Session->read('Auth');

		$this->loadModel('WareHouse.DeliveredOrder');

		$this->DeliveredOrder->id = $this->request->data['DeliveredOrder']['id'];

		$this->DeliveredOrder->saveField('dr_num', $this->request->data['DeliveredOrder']['dr_num']);

		$this->DeliveredOrder->saveField('si_num', $this->request->data['DeliveredOrder']['si_num']);

		$this->DeliveredOrder->saveField('purchase_order_uuid', $this->request->data['DeliveredOrder']['purchase_order_uuid']);

		$this->Session->setFlash(__('Delivery Details has been Updated'), 'success');
      
        $this->redirect( array(
            'controller' => 'receivings',   
            'action' => 'receive'
        )); 
	   		
    }


    public function purchase_approve($id = null) {

		$userData = $this->Session->read('Auth');

		$this->loadModel('WareHouse.DeliveredOrder');

		$this->DeliveredOrder->id = $id;

		$this->DeliveredOrder->saveField('status_id', 1);

		$this->Session->setFlash(__('Delivered Order has been Approved'), 'success');
      
        $this->redirect( array(
            'controller' => 'receivings',   
            'action' => 'view_receive',
            $id
        ));  

    }

    public function in_record($id = null, $DeliveredOrderId = null, $purchaseOrderId = null, $supplierId = null) {

    	$this->loadModel('WareHouse.DeliveredOrder');

    	$this->loadModel('Purchasing.PurchasingItem');

    	$userData = $this->Session->read('Auth');

    	$this->DeliveredOrder->bind('ReceivedItem', 'PurchaseOrder', 'ReceivedOrder', 'Request');

    	$receivedData = $this->DeliveredOrder->find('first', array('conditions' => array('DeliveredOrder.id' => $DeliveredOrderId)));	
    	
    	$itemHolder = "PurchasingItem";

    	if(!empty($receivedData['ReceivedItem'])){

    		$modelHolder = "ReceivedItem";

	    	$requestItemData = $this->PurchasingItem->find('all', array('conditions' => array('PurchasingItem.request_uuid' => $receivedData[$modelHolder][0]['request_uuid'])));

	    	if(empty($requestItemData)){

	    		$this->loadModel('Purchasing.RequestItem');

	    		$requestItemData = $this->RequestItem->find('all', array('conditions' => array('RequestItem.request_uuid' => $receivedData[$modelHolder][0]['request_uuid'])));

	    		$itemHolder = "RequestItem";

	    	}

	    	foreach ($receivedData['ReceivedItem'] as $key => $value) {	

	    		foreach ($requestItemData as $key1 => $valueOfRequestItem) {	

	    	 		if($value['model'] == 'GeneralItem' && $value['foreign_key'] == $valueOfRequestItem[$itemHolder]['foreign_key']){

	    	 			$receivedData['ReceivedItem'][$key]['size1'] = $valueOfRequestItem[$itemHolder]['size1'];

	    	 			$receivedData['ReceivedItem'][$key]['size1_unit_id'] = $valueOfRequestItem[$itemHolder]['size1_unit_id'];

	    	 			$receivedData['ReceivedItem'][$key]['size2'] = $valueOfRequestItem[$itemHolder]['size2'];

	    	 			$receivedData['ReceivedItem'][$key]['size2_unit_id'] = $valueOfRequestItem[$itemHolder]['size2_unit_id'];

	    	 			$receivedData['ReceivedItem'][$key]['size3'] = $valueOfRequestItem[$itemHolder]['size3'];

	    	 			$receivedData['ReceivedItem'][$key]['size3_unit_id'] = $valueOfRequestItem[$itemHolder]['size3_unit_id'];

	    	 			$receivedData['ReceivedItem'][$key]['quantity_unit_id'] = $valueOfRequestItem[$itemHolder]['quantity_unit_id'];

	    	 		}

	    	 		if($value['model'] == 'Substrate' && $value['foreign_key'] == $valueOfRequestItem[$itemHolder]['foreign_key']){

	    	 			$receivedData['ReceivedItem'][$key]['size1'] = $valueOfRequestItem[$itemHolder]['size1'];

	    	 			$receivedData['ReceivedItem'][$key]['size1_unit_id'] = $valueOfRequestItem[$itemHolder]['size1_unit_id'];

	    	 			$receivedData['ReceivedItem'][$key]['size2'] = $valueOfRequestItem[$itemHolder]['size2'];

	    	 			$receivedData['ReceivedItem'][$key]['size2_unit_id'] = $valueOfRequestItem[$itemHolder]['size2_unit_id'];

	    	 			$receivedData['ReceivedItem'][$key]['size3'] = $valueOfRequestItem[$itemHolder]['size3'];

	    	 			$receivedData['ReceivedItem'][$key]['size3_unit_id'] = $valueOfRequestItem[$itemHolder]['size3_unit_id'];

	    	 			$receivedData['ReceivedItem'][$key]['quantity_unit_id'] = $valueOfRequestItem[$itemHolder]['quantity_unit_id'];

	    	 		}

	    	 		if($value['model'] == 'CompoundSubstrate' && $value['foreign_key'] == $valueOfRequestItem[$itemHolder]['foreign_key']){

	    	 			$receivedData['ReceivedItem'][$key]['size1'] = $valueOfRequestItem[$itemHolder]['size1'];

	    	 			$receivedData['ReceivedItem'][$key]['size1_unit_id'] = $valueOfRequestItem[$itemHolder]['size1_unit_id'];

	    	 			$receivedData['ReceivedItem'][$key]['size2'] = $valueOfRequestItem[$itemHolder]['size2'];

	    	 			$receivedData['ReceivedItem'][$key]['size2_unit_id'] = $valueOfRequestItem[$itemHolder]['size2_unit_id'];

	    	 			$receivedData['ReceivedItem'][$key]['size3'] = $valueOfRequestItem[$itemHolder]['size3'];

	    	 			$receivedData['ReceivedItem'][$key]['size3_unit_id'] = $valueOfRequestItem[$itemHolder]['size3_unit_id'];

	    	 			$receivedData['ReceivedItem'][$key]['quantity_unit_id'] = $valueOfRequestItem[$itemHolder]['quantity_unit_id'];

	    	 		}

	    	 		if($value['model'] == 'CorrugatedPaper' && $value['foreign_key'] == $valueOfRequestItem[$itemHolder]['foreign_key']){

	    	 			$receivedData['ReceivedItem'][$key]['size1'] = $valueOfRequestItem[$itemHolder]['size1'];

	    	 			$receivedData['ReceivedItem'][$key]['size1_unit_id'] = $valueOfRequestItem[$itemHolder]['size1_unit_id'];

	    	 			$receivedData['ReceivedItem'][$key]['size2'] = $valueOfRequestItem[$itemHolder]['size2'];

	    	 			$receivedData['ReceivedItem'][$key]['size2_unit_id'] = $valueOfRequestItem[$itemHolder]['size2_unit_id'];

	    	 			$receivedData['ReceivedItem'][$key]['size3'] = $valueOfRequestItem[$itemHolder]['size3'];

	    	 			$receivedData['ReceivedItem'][$key]['size3_unit_id'] = $valueOfRequestItem[$itemHolder]['size3_unit_id'];

	    	 			$receivedData['ReceivedItem'][$key]['quantity_unit_id'] = $valueOfRequestItem[$itemHolder]['quantity_unit_id'];

	    	 		} 
	    	 			
	    	 	}

	    	 	$receiveDataHolder = $receivedData; 
	    	}
    	}else{

    		foreach ($receivedData['ReceivedReceiptItem'] as $key => $value) {	
    			
    			$receivedData['ReceivedItem'][$key]['delivered_order_id'] = $value['delivered_order_id'];
    			$receivedData['ReceivedItem'][$key]['received_orders_id'] = $value['received_orders_id'];
    			$receivedData['ReceivedItem'][$key]['model'] = $value['model']; 
    			$receivedData['ReceivedItem'][$key]['item_type'] = $value['item_type']; 
    			$receivedData['ReceivedItem'][$key]['foreign_key'] = $value['foreign_key'];
    			$receivedData['ReceivedItem'][$key]['quantity'] = $value['quantity'];
    			$receivedData['ReceivedItem'][$key]['quantity_unit_id'] = $value['quantity_unit_id'];
    			$receivedData['ReceivedItem'][$key]['number_of_boxes'] = $value['number_of_boxes'];
    			$receivedData['ReceivedItem'][$key]['quantity_per_boxes'] = $value['quantity_per_boxes'];
    			$receivedData['ReceivedItem'][$key]['lot'] = $value['lot'];
    			$receivedData['ReceivedItem'][$key]['remarks'] = $value['remarks'];
    		
    		}

    		$receiveDataHolder = $receivedData;

    	} 


		if (!empty($this->request->data)) {

			$this->loadModel('WareHouse.InRecord');

			$this->loadModel('WareHouse.ItemRecord');

			$this->loadModel('WareHouse.Stock');

			$stockData = $this->Stock->find('all');

			$this->DeliveredOrder->id = $DeliveredOrderId;

			$this->DeliveredOrder->saveField('status_id', 13);

			$inRecordId = $this->InRecord->saveInRecord($this->request->data['InRecord'],$receivedData['DeliveredOrder'],$userData['User']['id']);
			
			$this->ItemRecord->saveItemRecord($inRecordId, $receiveDataHolder['ReceivedItem']);

			foreach ($receiveDataHolder['ReceivedItem'] as $key => $value) {

				$conditions = array('Stock.model' => $value['model']);
				$conditions = array_merge($conditions,array('Stock.item_id' => $value['foreign_key']));

				$stockData = $this->Stock->find('first',array('conditions' => $conditions));

				if(!empty($stockData)){

					$receiveDataHolder['ReceivedItem'][$key]['id'] = $stockData['Stock']['id'];
					$receiveDataHolder['ReceivedItem'][$key]['addQuantity'] = $stockData['Stock']['quantity'];

				}else{

					$receiveDataHolder['ReceivedItem'][$key]['addQuantity'] = 0;
				}

			}
		
			$this->Stock->saveStock($receiveDataHolder, $this->request->data, $userData['User']['id'], $supplierId, $stockData);

			$this->Session->setFlash(__('Received Items has been moved to stocks'), 'success');
          
            $this->redirect( array(
                'controller' => 'warehouse_requests',   
                'action' => 'stock'
            ));  

		}
    }

    // public function out_record() {

    // 	$this->loadModel('Purchasing.Request');

    // 	$this->loadModel('User');

    // 	$this->loadModel('Role');

    // 	$this->Request->bind(array('PurchasingType', 'RequestItem'));

    // 	$requestData = $this->Request->find('all');

    // 	$userNameList = $this->User->find('list', array('fields' => array('User.id', 'User.fullname')));

    // 	$userRoleList = $this->User->find('list', array('fields' => array('User.id', 'User.role_id')));

    // 	$roleData = $this->Role->find('list', array('fields' => array('Role.id', 'Role.name')));

    // 	//pr($userRoleList); exit;

    // 	$this->set(compact('requestData', 'userNameList', 'userRoleList', 'roleData'));


    // }

    public function receive_receipt() {

    	$this->loadModel('Supplier');

    	$this->loadModel('Unit');

    	$this->loadModel('Purchasing.Address');

		$supplierData = $this->Supplier->find('list', array('fields' => array('Supplier.id', 'Supplier.name')
																,'order' => array('Supplier.name' => 'ASC')
															));

		$unitData = $this->Unit->find('list', array('fields' => array('Unit.id', 'Unit.unit')
																,'order' => array('Unit.unit' => 'ASC')
															));

		$supplierAddressData = $this->Address->find('list', array('fields' => array('Address.foreign_key', 'Address.address1')
																,'order' => array('Address.address1' => 'ASC')
															));

		if ($this->request->is(array('post','put'))) {
			//pr($this->request->data); exit;
			$userData = $this->Session->read('Auth');

			$this->loadModel('Purchasing.ReceivedItem');

			$this->loadModel('WareHouse.ReceivedOrder');

			$this->loadModel('WareHouse.DeliveredOrder');

			$this->loadModel('WareHouse.ReceivedReceiptItem');

			$id = 0;

			$itemId = $this->ReceivedOrder->saveReceivedOrders($this->request->data,$userData['User']['id'],$id);

			$deliveryUUID = $this->DeliveredOrder->saveDeliveredOrder($userData['User']['id'], $itemId, $id, $this->request->data['DeliveredOrder']);

			$this->ReceivedReceiptItem->saveReceivedReceiptItems($itemId, $this->request->data['ReceiveReceipt'], $deliveryUUID);

			$this->Session->setFlash(__('Receipt has been Received'), 'success');
          
            $this->redirect( array(
                'controller' => 'receivings',   
                'action' => 'receive_receipt'
            )); 

		}

		$this->set(compact('supplierData', 'unitData'));

    }

    public function for_flag($flag = null, $id = null) {

	//	$userData = $this->Session->read('Auth');

		$this->loadModel('Purchasing.PurchaseOrder');

		$this->PurchaseOrder->id = $id;

		$this->PurchaseOrder->saveField('receive_item_status', $flag);

		exit;

		//$this->Session->setFlash(__('Delivered Order has been Approved'), 'success');
      
        // $this->redirect( array(
        //     'controller' => 'receivings',   
        //     'action' => 'receive'
        // ));  

    }

    public function add_unit_price($id = null ,$deliveredId = null,  $uuid = null) {

    	$this->loadModel('WareHouse.ReceivedItem');

		$this->ReceivedItem->id = $id;

		$this->ReceivedItem->saveField('unit_price', $this->request->data['ReceivedItem']['unit_price']);

		$this->Session->setFlash(__('Unit Price has been added'), 'success');
      
        $this->redirect( array(
            'controller' => 'receivings',   
            'action' => 'view_receive',$deliveredId, $uuid
        ));  

    

    }


    

}