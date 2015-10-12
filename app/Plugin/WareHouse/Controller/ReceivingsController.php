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

		$purchaseOrderData = $this->PurchaseOrder->find('all', array('conditions' => array('PurchaseOrder.status' => 1),
															'order' => array('PurchaseOrder.id' => 'DESC')
															));
	
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

		$this->PurchaseOrder->bindReceive();

		$purchaseOrderData = $this->PurchaseOrder->find('first', array('conditions' => array('PurchaseOrder.id' => $id)));

		if(empty($requestData['PurchasingItem'])){

			$itemHolder = "RequestItem";

			$itemData = $this->RequestItem->find('all', array('conditions' => array('RequestItem.request_uuid' => $requestUUID)));

		}else{

			$itemHolder = "PurchasingItem";

			$itemData = $this->PurchasingItem->find('all', array('conditions' => array('PurchasingItem.request_uuid' => $requestUUID)));

		}

		$requestPurchasingItemArray = array();

		$receivedItemData = $this->ReceivedItem->find('all', array('conditions' => array('ReceivedItem.received_orders_id' => $id)));

		foreach ($itemData as $key => $value) {	

			if($value[$itemHolder]['model'] == 'GeneralItem'){

				$arrayGoodQuantity = array();

				$arrayRejectQuantity = array();

				$itemDetails = $this->GeneralItem->find('list', array('fields' => array('GeneralItem.id', 'GeneralItem.name')
																	));  

				$requestPurchasingItem[$key][$itemHolder]['name'] = $itemDetails[$value[$itemHolder]['foreign_key']];	

				$requestPurchasingItem[$key][$itemHolder]['foreign_key'] = $value[$itemHolder]['foreign_key'];

				$requestPurchasingItem[$key][$itemHolder]['model'] = $value[$itemHolder]['model'];

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

			ksort($this->request->data['requestPurchasingItem']);

			$receivedData = $this->ReceivedOrder->find('first', array('conditions' => array('ReceivedOrder.purchase_order_id' => $id)));

			if(empty($receivedData['ReceivedOrder']['id'])){

				$itemId = $this->ReceivedOrder->saveReceivedOrders($this->request->data['ReceivedItems'],$userData['User']['id'],$id);

				$this->PurchaseOrder->id = $id;

				$this->PurchaseOrder->saveField('status_id', 10);

			}else{

				$itemId = $receivedData['ReceivedOrder']['id'];

			}

			$deliveryUUID = $this->DeliveredOrder->saveDeliveredOrder($userData['User']['id'], $itemId, $id);

			$this->ReceivedItem->saveReceivedItems($itemId, $this->request->data, $deliveryUUID);

			$this->Session->setFlash(__('Order has been received'), 'success'); 
          
            $this->redirect( array(
                'controller' => 'receivings',   
                'action' => 'view', $id, $requestUUID,0
            ));  

		}
	
		$this->set(compact('requestData', 'requestPurchasingItem', 'purchaseOrderData', 'supplierData', 'unitData', 'itemHolder'));

    }

    public function receive($id = null) {

    	$this->loadModel('WareHouse.DeliveredOrder');

    	//$this->loadModel('Area');

    	$this->loadModel('Supplier');

    	$this->loadModel('User');

    	$this->loadModel('Purchasing.Request');

    	$this->loadModel('Purchasing.PurchaseOrder');

		$userName = $this->User->find('list', array('fields' => array('User.id', 'User.fullname')
																));

		$supplierData = $this->Supplier->find('list', array('fields' => array('Supplier.id', 'Supplier.name')
																));

		// $areaList = $this->Area->find('list', array('fields' => array('Area.id', 'Area.name')
		// 														));

		$receiveData = $this->Request->find('list', array('fields' => array('Request.id', 'Request.uuid')
																));

		// $userNameList = $this->User->find('list', array('fields' => array('User.id', 'User.fullname'),
		// 												'conditions' => array( 
		// 													'User.role_id' => 4)));

		

		//$received_orders = $this->DeliveredOrder->find('all',array('order' => 'DeliveredOrder.id DESC'));

	
		$this->DeliveredOrder->bind('ReceivedItem', 'PurchaseOrder', 'ReceivedOrder');

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
                // 'PurchaseOrder.uuid', 
                // 'PurchaseOrder.supplier_id', 
                // 'PurchaseOrder.request_id',
                'DeliveredOrder.uuid', 
                'DeliveredOrder.status_id',
                'DeliveredOrder.id',
                'DeliveredOrder.purchase_orders_id'),
            'order' => 'DeliveredOrder.id DESC',
        );

        $received_orders = $this->paginate('DeliveredOrder');

        if(!empty($received_orders[0]['PurchaseOrder']['request_id'])){

			$uuid = $receiveData[$received_orders[0]['PurchaseOrder']['request_id']];

		}

		$this->set(compact('received_orders', 'supplierData', 'userName', 'uuid', 'userName', 'userNameList', 'areaList'));

    }
	    	    
	 public function view($id = null, $requestUUID = null, $type = null) {

	 	$this->loadModel('Purchasing.PurchaseOrder');

	 	$this->loadModel('Purchasing.Request');

	 	$this->loadModel('Supplier');

	 	$this->loadModel('User');

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

					$requestPurchasingItem[$key1][$itemHolder]['name'] = $itemDetails[$value[$itemHolder]['foreign_key']];	

					$requestPurchasingItem[$key1][$itemHolder]['model'] = $value[$itemHolder]['model'];

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
       //pr($requestPurchasingItem);  exit;

   	$this->set(compact('purchaseOrderData', 'supplierData', 'firstName', 'lastName', 'requestData', 'itemDetails', 'requestPurchasingItem', 'itemData', 'receivedOrderData', 'type', 'requestItemData', 'itemHolder'));

    }

    public function view_receive($id = null, $requestUUID = null, $type = null) {

	 	$this->loadModel('Purchasing.PurchaseOrder');

	 	$this->loadModel('Purchasing.Request');

	 	$this->loadModel('Supplier');

	 	$this->loadModel('User');

	 	$this->loadModel('Area');

	 	$this->loadModel('Purchasing.PurchasingItem');

		$this->loadModel('Purchasing.RequestItem');

		$this->loadModel('WareHouse.ReceivedOrder');

		$this->loadModel('WareHouse.ReceivedItem');

		$this->loadModel('WareHouse.DeliveredOrder');

		$lastName = $this->User->find('list', array('fields' => array('User.id', 'User.last_name')
																));

		$firstName = $this->User->find('list', array('fields' => array('User.id', 'User.first_name')
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

			$itemHolder = "ReceivedItem";

			$itemData = $this->RequestItem->find('all', array('conditions' => array('RequestItem.request_uuid' => $requestUUID)));

		}else{

			$itemHolder = "ReceivedItem";

			$itemData = $this->PurchaseItem->find('all', array('conditions' => array('RequestItem.request_uuid' => $requestUUID)));

		}

		$this->DeliveredOrder->bind('ReceivedItem', 'PurchaseOrder', 'ReceivedOrder');

		$receivedItemData = $this->DeliveredOrder->find('all', array('conditions' => array('DeliveredOrder.id' => $id)));
		
	//	pr($receivedItemData); exit;

		$deliveredDataID = $receivedItemData[0]['DeliveredOrder']['id'];

		foreach ($receivedItemData as $key1 => $value) {

			foreach ($value['ReceivedItem'] as $key => $valueOfValue) {	

				if($valueOfValue['model'] == 'GeneralItem'){

					$this->loadModel('GeneralItem');

					$itemDetails = $this->GeneralItem->find('list', array('fields' => array('GeneralItem.id', 'GeneralItem.name')
					 													));  

					$receiveItem[$key][$itemHolder]['name'] = $itemDetails[$valueOfValue['foreign_key']];	

					$receiveItem[$key][$itemHolder]['model'] = $valueOfValue['model'];

					$receiveItem[$key][$itemHolder]['quantity'] = $valueOfValue['quantity'];		

			 		$receiveItem[$key][$itemHolder]['original_quantity'] = $valueOfValue['original_quantity'];	

					$receiveItem[$key][$itemHolder]['good_quantity'] = $valueOfValue['quantity'];
					
					$receiveItem[$key][$itemHolder]['reject_quantity'] = $valueOfValue['reject_quantity'];


        			
		        } 

		        if($valueOfValue['model'] == 'Substrate'){

		        	$this->loadModel('Substrate');

		        	$itemDetails = $this->Substrate->find('list', array('fields' => array('Substrate.id', 'Substrate.name')
					 													));  

					$receiveItem[$key][$itemHolder]['name'] = $itemDetails[$valueOfValue['foreign_key']];	

					$receiveItem[$key][$itemHolder]['model'] = $valueOfValue['model'];

					$receiveItem[$key][$itemHolder]['quantity'] = $valueOfValue['quantity'];		

			 		$receiveItem[$key][$itemHolder]['original_quantity'] = $valueOfValue['original_quantity'];	

					$receiveItem[$key][$itemHolder]['good_quantity'] = $valueOfValue['quantity'];
					
					$receiveItem[$key][$itemHolder]['reject_quantity'] = $valueOfValue['reject_quantity'];

		        	
		        } 

		        if($valueOfValue['model'] == 'CompoundSubstrate'){

		        	$this->loadModel('CompoundSubstrate');

		        	$itemDetails = $this->CompoundSubstrate->find('list', array('fields' => array('CompoundSubstrate.id', 'CompoundSubstrate.name')
					 													));  

					$receiveItem[$key][$itemHolder]['name'] = $itemDetails[$valueOfValue['foreign_key']];	

					$receiveItem[$key][$itemHolder]['model'] = $valueOfValue['model'];

					$receiveItem[$key][$itemHolder]['quantity'] = $valueOfValue['quantity'];		

			 		$receiveItem[$key][$itemHolder]['original_quantity'] = $valueOfValue['original_quantity'];	

					$receiveItem[$key][$itemHolder]['good_quantity'] = $valueOfValue['quantity'];
					
					$receiveItem[$key][$itemHolder]['reject_quantity'] = $valueOfValue['reject_quantity'];

		        
		        } 

		        if($valueOfValue['model'] == 'CorrugatedPaper'){

		        	$this->loadModel('CorrugatedPaper');

		        	$itemDetails = $this->CorrugatedPaper->find('list', array('fields' => array('CorrugatedPaper.id', 'CorrugatedPaper.name')
					 													));  

					$receiveItem[$key][$itemHolder]['name'] = $itemDetails[$valueOfValue['foreign_key']];	

					$receiveItem[$key][$itemHolder]['model'] = $valueOfValue['model'];

					$receiveItem[$key][$itemHolder]['quantity'] = $valueOfValue['quantity'];		

			 		$receiveItem[$key][$itemHolder]['original_quantity'] = $valueOfValue['original_quantity'];	

					$receiveItem[$key][$itemHolder]['good_quantity'] = $valueOfValue['quantity'];
					
					$receiveItem[$key][$itemHolder]['reject_quantity'] = $valueOfValue['reject_quantity'];

		        
		   		 }
			}
        }


   	$this->set(compact('purchaseOrderData', 'supplierData', 'firstName', 'lastName', 'requestData', 'itemDetails', 'receiveItem', 'itemData', 'receivedOrderData', 'type', 'requestItemData', 'itemHolder', 'deliveredDataID', 'receivedItemData', 'areaList', 'userNameList'));

    }


    public function purchase_approve($id = null) {

		$userData = $this->Session->read('Auth');

		$this->loadModel('WareHouse.DeliveredOrder');

		$this->DeliveredOrder->id = $id;

		$this->DeliveredOrder->saveField('status_id', 1);

		$this->Session->setFlash(__('Delivered Order has been Approved'), 'success');
      
        $this->redirect( array(
            'controller' => 'receivings',   
            'action' => 'receive'
        ));  

    }

    public function in_record($id = null, $DeliveredOrderId = null, $purchaseOrderId = null, $supplierId = null) {

    	$this->loadModel('WareHouse.DeliveredOrder');

    	$this->loadModel('Purchasing.PurchasingItem');

    	$userData = $this->Session->read('Auth');

    	$this->DeliveredOrder->bind('ReceivedItem', 'PurchaseOrder', 'ReceivedOrder', 'Request');

    	$receivedData = $this->DeliveredOrder->find('first', array('conditions' => array('DeliveredOrder.id' => $DeliveredOrderId)));
    	
    	$requestItemData = $this->PurchasingItem->find('all', array('conditions' => array('PurchasingItem.request_uuid' => $receivedData['ReceivedItem'][0]['request_uuid'])));

    	$itemHolder = "PurchasingItem";

    	if(empty($requestItemData)){

    		$this->loadModel('Purchasing.RequestItem');

    		$requestItemData = $this->RequestItem->find('all', array('conditions' => array('RequestItem.request_uuid' => $receivedData['ReceivedItem'][0]['request_uuid'])));

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
    	 			
    	 	}$receiveDataHolder = $receivedData; 

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
                'controller' => 'receivings',   
                'action' => 'receive'
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

    	$this->loadModel('Purchasing.Address');

		$supplierData = $this->Supplier->find('list', array('fields' => array('Supplier.id', 'Supplier.name')
																,'order' => array('Supplier.name' => 'ASC')
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

			$deliveryUUID = $this->DeliveredOrder->saveDeliveredOrder($userData['User']['id'], $itemId, $id);

			$this->ReceivedReceiptItem->saveReceivedReceiptItems($itemId, $this->request->data, $deliveryUUID);

			$this->Session->setFlash(__('Receipt has been Received'), 'success');
          
            $this->redirect( array(
                'controller' => 'receivings',   
                'action' => 'receive_receipt'
            )); 

		}

		$this->set(compact('supplierData'));

    }

}