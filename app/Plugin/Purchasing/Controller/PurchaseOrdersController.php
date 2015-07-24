<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class PurchaseOrdersController extends PurchasingAppController {

	public $uses = array('Purchasing.PurchaseOrder');

	public $helpers = array('Accounting.PhpExcel');

	public function index(){

		$this->loadModel('Supplier');

    	$supplierData = $this->Supplier->find('list', array(
														'fields' => array('Supplier.id', 'Supplier.name'),
														));

		$purchaseOrderData = $this->PurchaseOrder->find('all',array('order' => 'PurchaseOrder.id DESC'));

		$this->set(compact('purchaseOrderData','supplierData'));

    }

    public function view($purchaseOrderid = null){

		$this->loadModel('Supplier');

		$this->loadModel('Purchasing.Request');

		$this->loadModel('Purchasing.PurchasingItem');

		$this->loadModel('GeneralItem');

		$this->loadModel('Substrate');

		$this->loadModel('CorrugatedPaper');

		$this->loadModel('CompoundSubstrate');

		$this->loadModel('Unit');

		$this->loadModel('Sales.PaymentTermHolder');

		$unitData = $this->Unit->find('list', array('fields' => array('id', 'unit'),
															'order' => array('Unit.unit' => 'ASC')
															));
		//set to cache in first load
		$paymentTermData = Cache::read('paymentTerms');
		
		if (!$paymentTermData) {
            $paymentTermData = $this->PaymentTermHolder->getList(null,array('id','name'));
            Cache::write('paymentTerms', $paymentTermData);
        }
		
    	$supplierData = $this->Supplier->find('list', array(
														'fields' => array('Supplier.id', 'Supplier.name'),
														));

        $this->PurchaseOrder->bind(array('Contact','SupplierContactPerson'));

		$purchaseOrderData = $this->PurchaseOrder->find('first',array('conditions' => array('PurchaseOrder.id' => $purchaseOrderid),'order' => 'PurchaseOrder.id DESC'));

		$requestData = $this->Request->find('first', array('conditions' => array('Request.id' => $purchaseOrderData['PurchaseOrder']['request_id'])));

		$purchaseItemData = $this->PurchasingItem->find('all', array('conditions' => array('PurchasingItem.request_uuid' => $requestData['Request']['uuid'])));

		foreach ($purchaseItemData as $key => $value) {
			
			if($value['PurchasingItem']['model'] == 'GeneralItem'){

	 			$itemData = $this->GeneralItem->find('list',array('fields' => array('id', 'name')));

	 			$purchaseItemData[$key]['PurchasingItem']['name'] = $itemData[$value['PurchasingItem']['foreign_key']];
	 		}

	 		if($value['PurchasingItem']['model'] == 'CorrugatedPaper'){

	 			$itemData = $this->CorrugatedPaper->find('list',array('fields' => array('id', 'name')));

	 			$purchaseItemData[$key]['PurchasingItem']['name'] = $itemData[$value['PurchasingItem']['foreign_key']];
	 		}

	 		if($value['PurchasingItem']['model'] == 'Substrate'){

	 			$itemData = $this->Substrate->find('list',array('fields' => array('id', 'name')));

	 			$purchaseItemData[$key]['PurchasingItem']['name'] = $itemData[$value['PurchasingItem']['foreign_key']];
	 		}

	 		if($value['PurchasingItem']['model'] == 'CompoundSubstrate'){

	 			$itemData = $this->CompoundSubstrate->find('list',array('fields' => array('id', 'name')));
	 			
	 			$purchaseItemData[$key]['PurchasingItem']['name'] = $itemData[$value['PurchasingItem']['foreign_key']];
	 		}

	    } 

	    $this->loadModel('User');

	    $preparedData = $this->User->find('first', array(
														'conditions' => array('User.id' => $purchaseOrderData['PurchaseOrder']['created_by']),
														));
		
		$this->set(compact('purchaseOrderData','supplierData','purchaseOrderid','unitData','paymentTermData','purchaseItemData','preparedData'));

    }

    public function edit($purchaseOrderId){

    	$this->loadModel('Sales.PaymentTermHolder');

    	$this->loadModel('Purchasing.PurchasingType');

    	$this->loadModel('Purchasing.PurchasingItem');

    	$this->loadModel('Purchasing.Request');

    	$this->loadModel('GeneralItem');

		$this->loadModel('Substrate');

		$this->loadModel('CorrugatedPaper');

		$this->loadModel('CompoundSubstrate');

    	$this->PurchaseOrder->bind(array('Contact','SupplierContactPerson','Request','Supplier'));

    	$purchaseOrderData = $this->PurchaseOrder->find('first', array(
														'conditions' => array('PurchaseOrder.id' => $purchaseOrderId),
														));

    	$requestData = $this->Request->find('first', array('conditions' => array('Request.id' => $purchaseOrderData['PurchaseOrder']['request_id'])));

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

    	$contactData = $this->PurchaseOrder->Contact->find('list',array(
    									'conditions' => array(
    										'model' => 'Supplier',
    										'foreign_key' => $purchaseOrderData['PurchaseOrder']['supplier_id']
    										),
    									'fields' => array('id','number')
    									));

    	$supplierContactPersonData = $this->PurchaseOrder->SupplierContactPerson->find('list',array(
    									'conditions' => array(
    										'supplier_id' => $purchaseOrderData['PurchaseOrder']['supplier_id']
    										),
    									'fields' => array('id','fullnameContact')
    									));

    	$type = $this->PurchasingType->find('list', array('fields' => array('id', 'name'),
															'order' => array('PurchasingType.id' => 'ASC')
															));
    	
    	//set to cache in first load
		$paymentTermData = Cache::read('paymentTerms');
		
		if (!$paymentTermData) {
            $paymentTermData = $this->PaymentTermHolder->getList(null,array('id','name'));
            Cache::write('paymentTerms', $paymentTermData);
        }

        $userData = $this->Session->read('Auth');

    	if (!empty($this->request->data)) {

    		$this->request->data['PurchaseOrder']['version'] = $this->request->data['PurchaseOrder']['version'] + 1 ;

    		$this->PurchaseOrder->savePurchaseOrder($this->request->data,$userData['User']['id']);

    		$this->PurchasingItem->savePurchasingItemPrice($this->request->data);

    		$this->Session->setFlash(__('Purchase Order updated.'));

	        $this->redirect( array(
	                 'controller' => 'purchase_orders', 
	                 'action' => 'view',$purchaseOrderId

	        ));

    	}

    	$this->loadModel('Unit');

		$unitData = $this->Unit->find('list', array('fields' => array('id', 'unit'),
															'order' => array('Unit.unit' => 'ASC')
															));

    	$this->request->data = $purchaseOrderData;
    	
    	$this->set(compact('unitData','purchaseOrderId','supplierData','paymentTermData','purchaseOrderData','contactData','supplierContactPersonData','type','requestPurchasingItem'));
    }

    public function approved($purchaseOrderId){

    	$this->PurchaseOrder->id = $purchaseOrderId;

    	$this->PurchaseOrder->saveField('status',1);

    	$this->Session->setFlash(__('Purchase Order has been approved.'));

        $this->redirect( array(
                 'controller' => 'purchase_orders', 
                 'action' => 'view',$purchaseOrderId

        ));

    }

    public function print_purchase_order($purchaseOrderId){

    	$output = $this->render('print_purchase_order');

    }

    public function facial(){

    	

    }
}