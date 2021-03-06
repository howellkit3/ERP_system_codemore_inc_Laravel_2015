<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');
App::import('Vendor', 'DOMPDF', true, array(), 'dompdf'.DS.'dompdf_config.inc.php', false);

class PurchaseOrdersController extends PurchasingAppController {

	public $uses = array('Purchasing.PurchaseOrder');

	public $helpers = array('Accounting.PhpExcel');

	public function index(){

		$this->loadModel('Supplier');

		$this->loadModel('User');

		$limit = 10;

		$conditions = array('NOT' => array('PurchaseOrder.status' => 5));

		$params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            'order' => 'PurchaseOrder.created DESC',
	    );

		$this->paginate = $params;

		$purchaseOrderData = $this->paginate('PurchaseOrder');

    	$supplierData = $this->Supplier->find('list', array(
														'fields' => array('Supplier.id', 'Supplier.name'),
														));

    	$userName = $this->User->find('list', array('fields' => array('id', 'fullname')
															));

		$this->set(compact('purchaseOrderData','supplierData', 'userName'));

    }

    public function view($purchaseOrderid = null, $bycash = null){

		$this->loadModel('Supplier');

		$this->loadModel('Purchasing.Request');

		$this->loadModel('Purchasing.PurchasingItem');

		$this->loadModel('Purchasing.RequestItem');

		$this->loadModel('Purchasing.Contact');

		$this->loadModel('GeneralItem');

		$this->loadModel('Substrate');

		$this->loadModel('CorrugatedPaper');

		$this->loadModel('CompoundSubstrate');

		$this->loadModel('Unit');

		$this->loadModel('Currency');

		$this->loadModel('Sales.PaymentTermHolder');

		$unitData = $this->Unit->find('list', array('fields' => array('id', 'unit'),
															'order' => array('Unit.unit' => 'ASC')
															));

		$currencyData = $this->Currency->find('list', array('fields' => array('id', 'name'),
															'order' => array('Currency.name' => 'ASC')
															));

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
		
		$faxContactData = $this->Contact->find('first',array('conditions' => array('Contact.foreign_key' => $purchaseOrderData['PurchaseOrder']['supplier_id'], 'Contact.type' => 1),'order' => 'Contact.id DESC'));
		
		$telContactData = $this->Contact->find('first',array('conditions' => array('Contact.foreign_key' => $purchaseOrderData['PurchaseOrder']['supplier_id'], 'Contact.type' => 0),'order' => 'Contact.id DESC'));
		
		$requestData = $this->Request->find('first', array('conditions' => array('Request.id' => $purchaseOrderData['PurchaseOrder']['request_id'])));

		$purchaseItemData = $this->PurchasingItem->find('all', array('conditions' => array('PurchasingItem.request_uuid' => $requestData['Request']['uuid'])));

		if (empty($purchaseItemData)) {

			if(!empty($purchaseOrderData['PurchaseOrder']['filed_number'])){

    			$purchaseItemData = $this->RequestItem->find('all', array('conditions' => array('RequestItem.request_uuid' => $requestData['Request']['uuid'],
    					'RequestItem.filed_number ' => $purchaseOrderData['PurchaseOrder']['filed_number'],
    					'RequestItem.status_id ' => 1
    			 )));
    			$modelTable = 'RequestItem'; 

    		}else{

    			$purchaseItemData = $this->RequestItem->find('all', array('conditions' => array('RequestItem.request_uuid' => $requestData['Request']['uuid'], 
    					'RequestItem.status_id ' => 0)));
    			$modelTable = 'RequestItem'; 

    		}

    	} else { 

    		$modelTable = 'PurchasingItem'; 
    	}

		foreach ($purchaseItemData as $key => $value) {
			
			if($value[$modelTable]['model'] == 'GeneralItem'){

	 			$itemData = $this->GeneralItem->find('list',array('fields' => array('id', 'name')));

	 			$purchaseItemData[$key][$modelTable]['name'] = $itemData[$value[$modelTable]['foreign_key']];
	 		}

	 		if($value[$modelTable]['model'] == 'CorrugatedPaper'){

	 			$itemData = $this->CorrugatedPaper->find('list',array('fields' => array('id', 'name')));

	 			$purchaseItemData[$key][$modelTable]['name'] = $itemData[$value[$modelTable]['foreign_key']];
	 		}

	 		if($value[$modelTable]['model'] == 'Substrate'){

	 			$itemData = $this->Substrate->find('list',array('fields' => array('id', 'name')));

	 			$purchaseItemData[$key][$modelTable]['name'] = $itemData[$value[$modelTable]['foreign_key']];
	 		}

	 		if($value[$modelTable]['model'] == 'CompoundSubstrate'){

	 			$itemData = $this->CompoundSubstrate->find('list',array('fields' => array('id', 'name')));
	 			
	 			$purchaseItemData[$key][$modelTable]['name'] = $itemData[$value[$modelTable]['foreign_key']];
	 		}

	    } 

	    $this->loadModel('User');

	    $preparedData = $this->User->find('first', array(
														'conditions' => array('User.id' => $purchaseOrderData['PurchaseOrder']['created_by']),
														));
		
		$this->set(compact('modelTable','purchaseOrderData','supplierData','purchaseOrderid','unitData','paymentTermData','purchaseItemData','preparedData', 'currencyData', 'faxContactData', 'telContactData', 'bycash'));

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

		$this->loadModel('Purchasing.RequestItem');

    	$this->PurchaseOrder->bind(array('Contact','SupplierContactPerson','Request','Supplier'));

    	$purchaseOrderData = $this->PurchaseOrder->find('first', array(
														'conditions' => array('PurchaseOrder.id' => $purchaseOrderId),
														));

    	$requestData = $this->Request->find('first', array('conditions' => array('Request.id' => $purchaseOrderData['PurchaseOrder']['request_id'])));

    	$requestPurchasingItem = $this->PurchasingItem->find('all', array('conditions' => array('PurchasingItem.request_uuid' => $requestData['Request']['uuid'])));

    	if (empty($requestPurchasingItem)) {

    		$requestPurchasingItem = $this->RequestItem->find('all', array('conditions' => array('RequestItem.request_uuid' => $requestData['Request']['uuid'])));
    		$modelTable = 'RequestItem'; 

    	} else {

    		$modelTable = 'PurchasingItem'; 

    	}

    	foreach ($requestPurchasingItem as $key => $value) {
			
			if($value[$modelTable]['model'] == 'GeneralItem'){

	 			$itemData = $this->GeneralItem->find('list',array('fields' => array('id', 'name')));

	 			$requestPurchasingItem[$key][$modelTable]['name'] = $itemData[$value[$modelTable]['foreign_key']];
	 		}

	 		if($value[$modelTable]['model'] == 'CorrugatedPaper'){

	 			$itemData = $this->CorrugatedPaper->find('list',array('fields' => array('id', 'name')));

	 			$requestPurchasingItem[$key][$modelTable]['name'] = $itemData[$value[$modelTable]['foreign_key']];
	 		}

	 		if($value[$modelTable]['model'] == 'Substrate'){

	 			$itemData = $this->Substrate->find('list',array('fields' => array('id', 'name')));

	 			$requestPurchasingItem[$key][$modelTable]['name'] = $itemData[$value[$modelTable]['foreign_key']];
	 		}

	 		if($value[$modelTable]['model'] == 'CompoundSubstrate'){

	 			$itemData = $this->CompoundSubstrate->find('list',array('fields' => array('id', 'name')));
	 			
	 			$requestPurchasingItem[$key][$modelTable]['name'] = $itemData[$value[$modelTable]['foreign_key']];
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

    		foreach ($this->request->data['PurchasingItemIdHolder'] as $key => $value) {

    			
    			if (!empty($value['id'])) {

    				$this->PurchasingItem->delete($value['id']);

    			}
    			
    		}

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

		$this->loadModel('Currency');

		$currencyData = $this->Currency->find('list', array('fields' => array('id', 'name'))
															);

    	$this->request->data = $purchaseOrderData;
    	
    	$this->set(compact('modelTable','unitData','purchaseOrderId','supplierData','paymentTermData','purchaseOrderData','contactData','supplierContactPersonData','type','requestPurchasingItem','currencyData' ));
    }

    public function approved($purchaseOrderId){

    	$this->loadModel('Purchasing.PurchaseOrder');

    	$purchaseOrderList = $this->PurchaseOrder->find('all', array('fields' => array('PurchaseOrder.id', 'PurchaseOrder.order'),
															'order' => array('PurchaseOrder.id' => 'DESC')
															));

    	$array = array();

    	foreach ($purchaseOrderList as $key => $value) {

    		array_push($array, $value['PurchaseOrder']['order']);
    		
    	} 

    	$highest_order = max($array) + 1;

    	$this->PurchaseOrder->id = $purchaseOrderId;

    	$this->PurchaseOrder->saveField('receive_item_status',0);

    	$this->PurchaseOrder->saveField('status',1);

    	$this->PurchaseOrder->saveField('order', $highest_order);

    	$this->Session->setFlash(__('Purchase Order has been approved.'));

        $this->redirect( array(
                 'controller' => 'purchase_orders', 
                 'action' => 'view',$purchaseOrderId

        ));

    }

    public function print_purchase_order($purchaseOrderId, $bycash = null){

    	$this->loadModel('Supplier');

		$this->loadModel('Purchasing.Request');

		$this->loadModel('Purchasing.PurchasingItem');

		$this->loadModel('Purchasing.RequestItem');

		$this->loadModel('Purchasing.Contact');

		$this->loadModel('GeneralItem');

		$this->loadModel('Substrate');

		$this->loadModel('CorrugatedPaper');

		$this->loadModel('CompoundSubstrate');

		$this->loadModel('Unit');

		$this->loadModel('Currency');

		$this->loadModel('Sales.PaymentTermHolder');

		$unitData = $this->Unit->find('list', array('fields' => array('id', 'unit'),
															'order' => array('Unit.unit' => 'ASC')
															));
		$currencyData = $this->Currency->find('list', array('fields' => array('id', 'name'),
															'order' => array('Currency.name' => 'ASC')
															));

		$paymentTermData = Cache::read('paymentTerms');
		
		if (!$paymentTermData) {
            $paymentTermData = $this->PaymentTermHolder->getList(null,array('id','name'));
            Cache::write('paymentTerms', $paymentTermData);
        }
		
    	$supplierData = $this->Supplier->find('list', array(
														'fields' => array('Supplier.id', 'Supplier.name'),
														));

        $this->PurchaseOrder->bind(array('Contact','SupplierContactPerson'));

		$purchaseOrderData = $this->PurchaseOrder->find('first',array('conditions' => array('PurchaseOrder.id' => $purchaseOrderId),'order' => 'PurchaseOrder.id DESC'));

		$faxContactData = $this->Contact->find('first',array('conditions' => array('Contact.foreign_key' => $purchaseOrderData['PurchaseOrder']['supplier_id'], 'Contact.type' => 1),'order' => 'Contact.id DESC'));
		
		$telContactData = $this->Contact->find('first',array('conditions' => array('Contact.foreign_key' => $purchaseOrderData['PurchaseOrder']['supplier_id'], 'Contact.type' => 0),'order' => 'Contact.id DESC'));
		
		$requestData = $this->Request->find('first', array('conditions' => array('Request.id' => $purchaseOrderData['PurchaseOrder']['request_id'])));

		$purchaseItemData = $this->PurchasingItem->find('all', array('conditions' => array('PurchasingItem.request_uuid' => $requestData['Request']['uuid'])));

		if (empty($purchaseItemData)) {

    		if(!empty($purchaseOrderData['PurchaseOrder']['filed_number'])){

    			$purchaseItemData = $this->RequestItem->find('all', array('conditions' => array('RequestItem.request_uuid' => $requestData['Request']['uuid'],
    					'RequestItem.filed_number ' => $purchaseOrderData['PurchaseOrder']['filed_number'],
    					'RequestItem.status_id ' => 1
    			 )));
    			$modelTable = 'RequestItem'; 

    		}else{

    			$purchaseItemData = $this->RequestItem->find('all', array('conditions' => array('RequestItem.request_uuid' => $requestData['Request']['uuid'], 
    					'RequestItem.status_id ' => 0)));
    			$modelTable = 'RequestItem'; 

    		}
    	} else {
    		$modelTable = 'PurchasingItem'; 
    	}

		foreach ($purchaseItemData as $key => $value) {
			
			if($value[$modelTable]['model'] == 'GeneralItem'){

	 			$itemData = $this->GeneralItem->find('list',array('fields' => array('id', 'name')));

	 			$purchaseItemData[$key][$modelTable]['name'] = $itemData[$value[$modelTable]['foreign_key']];
	 		}

	 		if($value[$modelTable]['model'] == 'CorrugatedPaper'){

	 			$itemData = $this->CorrugatedPaper->find('list',array('fields' => array('id', 'name')));

	 			$purchaseItemData[$key][$modelTable]['name'] = $itemData[$value[$modelTable]['foreign_key']];
	 		}

	 		if($value[$modelTable]['model'] == 'Substrate'){

	 			$itemData = $this->Substrate->find('list',array('fields' => array('id', 'name')));

	 			$purchaseItemData[$key][$modelTable]['name'] = $itemData[$value[$modelTable]['foreign_key']];
	 		}

	 		if($value[$modelTable]['model'] == 'CompoundSubstrate'){

	 			$itemData = $this->CompoundSubstrate->find('list',array('fields' => array('id', 'name')));
	 			
	 			$purchaseItemData[$key][$modelTable]['name'] = $itemData[$value[$modelTable]['foreign_key']];
	 		}

	    } 

	    $this->loadModel('User');

	    $preparedData = $this->User->find('first', array(
														'conditions' => array('User.id' => $purchaseOrderData['PurchaseOrder']['created_by']),
														));

    	$view = new View(null, false);

		$view->set(compact('modelTable','purchaseOrderData','supplierData','purchaseOrderId','unitData','paymentTermData','purchaseItemData','preparedData', 'currencyData', 'telContactData', 'faxContactData', 'bycash'));
		
		$view->viewPath = 'PurchaseOrder'.DS.'pdf';	
   
        $output = $view->render('print_purchase_order', false);
   	
        $dompdf = new DOMPDF();
        //$dompdf->set_paper("A5");
        $dompdf->set_paper("A3", "landscape" ); 
        $dompdf->load_html(utf8_decode($output), Configure::read('App.encoding'));
        $dompdf->render();
        $canvas = $dompdf->get_canvas();
        $font = Font_Metrics::get_font("helvetica", "bold");
       // $canvas->page_text(16, 800, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, array(0,0,0));

        $output = $dompdf->output();
        $random = rand(0, 1000000) . '-' . time();
        if (empty($filename)) {
        	$filename = 'PurchaseOrder-'.$purchaseOrderId.'-order'.time();
        }
      	$filePath = 'view_pdf/'.strtolower(Inflector::slug( $filename , '-')).'.pdf';
        $file_to_save = WWW_ROOT .DS. $filePath;
        	
        if ($dompdf->stream( $file_to_save, array( 'Attachment'=>0 ) )) {
        		unlink($file_to_save);
        }
        
        exit();

    }

    public function search_order($hint = null, $status = null){

    	$this->loadModel('Supplier');

    	$this->loadModel('User');

    	if($status == 1){

			$supplierData = $this->Supplier->find('list', array(
															'fields' => array('Supplier.id', 'Supplier.name'),
															));

	        $purchaseOrderData = $this->PurchaseOrder->query('SELECT PurchaseOrder.po_number, PurchaseOrder.supplier_id, 
	        	PurchaseOrder.status, PurchaseOrder.id, PurchaseOrder.created_by, Request.uuid
                FROM koufu_purchasing.purchase_orders AS PurchaseOrder
                LEFT JOIN koufu_purchasing.requests AS Request
                ON PurchaseOrder.request_id = Request.id 
                WHERE PurchaseOrder.po_number LIKE "%'.$hint.'%" OR PurchaseOrder.name LIKE "%'.$hint.'%" AND PurchaseOrder.status = 8');

			$userName = $this->User->find('list', array('fields' => array('id', 'fullname')));

	     	$this->set(compact('purchaseOrderData','supplierData', 'userName'));

	        if ($hint == ' ') {
	            $this->render('index');
	        }else{
	            $this->render('search_order');
	        }
	    }

	    if($status == 2){

			$supplierData = $this->Supplier->find('list', array(
															'fields' => array('Supplier.id', 'Supplier.name'),
															));

	        $purchaseOrderData = $this->PurchaseOrder->query('SELECT PurchaseOrder.po_number, PurchaseOrder.supplier_id, 
	        	PurchaseOrder.status, PurchaseOrder.id, PurchaseOrder.created_by, Request.uuid
                FROM koufu_purchasing.purchase_orders AS PurchaseOrder
                LEFT JOIN koufu_purchasing.requests AS Request
                ON PurchaseOrder.request_id = Request.id 
                WHERE PurchaseOrder.po_number LIKE "%'.$hint.'%" OR PurchaseOrder.name LIKE "%'.$hint.'%" AND PurchaseOrder.status = 1');


			$userName = $this->User->find('list', array('fields' => array('id', 'fullname')));

	     	$this->set(compact('purchaseOrderData','supplierData', 'userName'));

	        if ($hint == ' ') {
	            $this->render('index');
	        }else{
	            $this->render('search_order');
	        }
	    }

	    if($status == 3){

			$supplierData = $this->Supplier->find('list', array(
															'fields' => array('Supplier.id', 'Supplier.name'),
															));

	        $purchaseOrderData = $this->PurchaseOrder->query('SELECT PurchaseOrder.po_number, PurchaseOrder.supplier_id, 
	        	PurchaseOrder.status, PurchaseOrder.id, PurchaseOrder.created_by, Request.uuid
                FROM koufu_purchasing.purchase_orders AS PurchaseOrder
                LEFT JOIN koufu_purchasing.requests AS Request
                ON PurchaseOrder.request_id = Request.id 
                WHERE PurchaseOrder.po_number LIKE "%'.$hint.'%" OR PurchaseOrder.name LIKE "%'.$hint.'%" AND PurchaseOrder.status = 11');


			$userName = $this->User->find('list', array('fields' => array('id', 'fullname')));

	     	$this->set(compact('purchaseOrderData','supplierData', 'userName'));

	        if ($hint == ' ') {
	            $this->render('index');
	        }else{
	            $this->render('search_order');
	        }
	    }
	       
    }

    public function delete($id = null){

    	$userData = $this->Session->read('Auth');

		$this->loadModel('Purchasing.PurchaseOrder');

		$this->PurchaseOrder->id = $id;

		$this->PurchaseOrder->saveField('status', 5);

		$this->Session->setFlash(__('Purchase Order has been removed'), 'success');
      
        $this->redirect( array(
            'controller' => 'purchase_orders',   
            'action' => 'index'
        ));  

    }

    public function index_status($status = null) {

		$this->loadModel('User');

		$this->PurchaseOrder->bind(array('Request'));

		if($status == 1){

			$this->loadModel('Supplier');

			$limit = 10;

			$conditions = array('NOT' => array('PurchaseOrder.status' => 5), 'PurchaseOrder.status' => 8);

			$params =  array(
		            'conditions' => $conditions,
		            'limit' => $limit,
		            'fields' => array('PurchaseOrder.id', 'PurchaseOrder.status','PurchaseOrder.created','Request.uuid',
		            	'PurchaseOrder.po_number', 'PurchaseOrder.supplier_id','PurchaseOrder.created_by','PurchaseOrder.status'),
		            'order' => 'PurchaseOrder.created DESC',
		    );

			$this->paginate = $params;

			$purchaseOrderData = $this->paginate('PurchaseOrder');

	    	$supplierData = $this->Supplier->find('list', array(
															'fields' => array('Supplier.id', 'Supplier.name'),
															));

	    	$userName = $this->User->find('list', array('fields' => array('id', 'fullname')
																));

			$this->set(compact('purchaseOrderData','supplierData', 'userName'));

			$this->render('purchase_order_waiting');

		}

		if($status == 2){

			$this->loadModel('Supplier');

			$limit = 10;

			$conditions = array('NOT' => array('PurchaseOrder.status' => 5), 'PurchaseOrder.status' => 1);

			$params =  array(
		            'conditions' => $conditions,
		            'limit' => $limit,
		            'fields' => array('PurchaseOrder.id', 'PurchaseOrder.status','PurchaseOrder.created','Request.uuid',
		            	'PurchaseOrder.po_number', 'PurchaseOrder.supplier_id','PurchaseOrder.created_by','PurchaseOrder.status'),
		            'order' => 'PurchaseOrder.created DESC',
		    );

			$this->paginate = $params;

			$purchaseOrderData = $this->paginate('PurchaseOrder');

	    	$supplierData = $this->Supplier->find('list', array(
															'fields' => array('Supplier.id', 'Supplier.name'),
															));

	    	$userName = $this->User->find('list', array('fields' => array('id', 'fullname')
																));

			$this->set(compact('purchaseOrderData','supplierData', 'userName'));

			$this->render('purchase_order_approved');

		}

		if($status == 3){

			$this->loadModel('Supplier');

			$limit = 10;

			$conditions = array('NOT' => array('PurchaseOrder.status' => 5), 'PurchaseOrder.status' => 11);

			$params =  array(
		            'conditions' => $conditions,
		            'limit' => $limit,
		            'fields' => array('PurchaseOrder.id', 'PurchaseOrder.status','PurchaseOrder.created','Request.uuid',
		            	'PurchaseOrder.po_number', 'PurchaseOrder.supplier_id','PurchaseOrder.created_by','PurchaseOrder.status'),
		            'order' => 'PurchaseOrder.created DESC',
		    );

			$this->paginate = $params;

			$purchaseOrderData = $this->paginate('PurchaseOrder');

	    	$supplierData = $this->Supplier->find('list', array(
															'fields' => array('Supplier.id', 'Supplier.name'),
															));

	    	$userName = $this->User->find('list', array('fields' => array('id', 'fullname')
																));

			$this->set(compact('purchaseOrderData','supplierData', 'userName'));

			$this->render('purchase_order_received');

		}

		if($status == 4){

			$limit = 10;

			$conditions = array('NOT' => array('PurchaseOrder.status' => 5), 'PurchaseOrder.status' => 12);
			$params =  array(
		            'conditions' => $conditions,
		            'limit' => $limit,
		            'order' => 'PurchaseOrder.created DESC',
		    );

			$this->paginate = $params;

			$purchaseOrderData = $this->paginate('PurchaseOrder');


	    	$userName = $this->User->find('list', array('fields' => array('id', 'fullname')
																));

			$this->set(compact('purchaseOrderData','supplierData', 'userName'));

			$this->render('purchase_order_receive_by_cash');

		}

    } 

    public function purchased_items(){

    	$this->loadModel('Purchasing.RequestItem');

    	$this->RequestItem->bindItem();

    	$limit = 10;

		$conditions = "";

		$params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            'fields' => array('RequestItem.id',
									'RequestItem.model',
									'RequestItem.foreign_key',
									'RequestItem.request_uuid',
									'RequestItem.quantity',
									'RequestItem.request_uuid',
									'RequestItem.pieces',
									'RequestItem.unit_price',
									'RequestItem.unit_price_unit_id',
									'PurchasingItem.id',
									'PurchasingItem.model',
									'PurchasingItem.foreign_key',
									'PurchasingItem.request_uuid',
									'PurchasingItem.quantity',
									'PurchasingItem.pieces',
									'PurchasingItem.unit_price',
									'PurchasingItem.unit_price_unit_id'));

		$this->paginate = $params;

		$requestItemData = $this->paginate('RequestItem');

    	foreach ($requestItemData as $key => $value) {

    		if(!empty($value['PurchasingItem']['id'])){

    			$modelTable = 'PurchasingItem';

    		}else{

    			$modelTable = 'RequestItem';

    		}
			
			if($value[$modelTable]['model'] == 'GeneralItem'){

				$this->loadModel('GeneralItem');

	 			$itemData = $this->GeneralItem->find('list',array('fields' => array('id', 'name')));

	 			$requestItemData[$key][$modelTable]['series'] = $key + 1;

	 			if(!empty($itemData[$value['RequestItem']['foreign_key']])){

	 				$requestItemData[$key][$modelTable]['name'] = $itemData[$value['RequestItem']['foreign_key']];

	 			}else{

	 				$requestItemData[$key][$modelTable]['name'] = $itemData[$value['PurchasingItem']['foreign_key']];

	 			}
	 		}

	 		if($value[$modelTable]['model'] == 'CorrugatedPaper'){

	 			$this->loadModel('CorrugatedPaper');

	 			$itemData = $this->CorrugatedPaper->find('list',array('fields' => array('id', 'name')));

	 			$requestItemData[$key][$modelTable]['series'] = $key + 1;

	 			if(!empty($itemData[$value['RequestItem']['foreign_key']])){

	 				$requestItemData[$key][$modelTable]['name'] = $itemData[$value['RequestItem']['foreign_key']];

	 			}else{

	 				$requestItemData[$key][$modelTable]['name'] = $itemData[$value['PurchasingItem']['foreign_key']];

	 			}
	 		}

	 		if($value[$modelTable]['model'] == 'Substrate'){

	 			$this->loadModel('Substrate');

	 			$itemData = $this->Substrate->find('list',array('fields' => array('id', 'name')));

	 			$requestItemData[$key][$modelTable]['series'] = $key + 1;

	 			if(!empty($itemData[$value['RequestItem']['foreign_key']])){

	 				$requestItemData[$key][$modelTable]['name'] = $itemData[$value['RequestItem']['foreign_key']];

	 			}else{

	 				$requestItemData[$key][$modelTable]['name'] = $itemData[$value['PurchasingItem']['foreign_key']];

	 			}
	 		}

	 		if($value[$modelTable]['model'] == 'CompoundSubstrate'){

	 			$this->loadModel('CompoundSubstrate');

	 			$itemData = $this->CompoundSubstrate->find('list',array('fields' => array('id', 'name')));

	 			$requestItemData[$key][$modelTable]['series'] = $key + 1;
	 			
	 			if(!empty($itemData[$value['RequestItem']['foreign_key']])){

	 				$requestItemData[$key][$modelTable]['name'] = $itemData[$value['RequestItem']['foreign_key']];

	 			}else{

	 				$requestItemData[$key][$modelTable]['name'] = $itemData[$value['PurchasingItem']['foreign_key']];

	 			}
	 		}
	    } 

	$this->loadModel('Purchasing.Request');

	$this->Request->bindRequest();

	$requestData = $this->Request->find('all', array('fields' => array('
									Request.id',
									'Request.uuid',
									'PurchaseOrder.request_id',
									'PurchaseOrder.supplier_id',
									'PurchaseOrder.po_number')));

	foreach ($requestItemData as $key => $value) {
		
		foreach ($requestData as $key2 => $value2) {

			if($value2['Request']['uuid'] == $value['RequestItem']['request_uuid']){

				$requestItemData[$key]['Request']['uuid'] = $value2['Request']['uuid'];
				$requestItemData[$key]['PurchaseOrder']['supplier_id'] = $value2['PurchaseOrder']['supplier_id'];
				$requestItemData[$key]['PurchaseOrder']['po_number'] = $value2['PurchaseOrder']['po_number'];

			}
		}
	}

	$this->loadModel('Supplier');

	$supplierData = $this->Supplier->find('list', array('fields' => array('Supplier.id', 'Supplier.name'),
														));

	$this->loadModel('Currency');
	$currencyData = $this->Currency->find('list', array('fields' => array('id', 'name'),
															'order' => array('Currency.name' => 'ASC')
															));

    $this->set(compact('requestItemData', 'modelTable', 'supplierData', 'currencyData'));

    }

    public function search_item($hint = null){

    	$this->loadModel('Purchasing.RequestItem');

    	$requestItemData = $this->RequestItem->query('SELECT Supplier.name, GeneralItem.name, Substrate.name,
    			CompoundSubstrate.name, CorrugatedPaper.name, RequestItem.request_uuid, RequestItem.unit_price_unit_id, Request.uuid,
    			PurchaseOrder.request_id, Request.id, RequestItem.foreign_key, GeneralItem.id, Substrate.id,
    			CompoundSubstrate.id, CorrugatedPaper.id, PurchaseOrder.supplier_id, Supplier.id, PurchasingItem.request_uuid, PurchasingItem.foreign_key,
    			PurchasingItem.unit_price_unit_id, PurchasingItem.pieces, RequestItem.pieces, PurchasingItem.unit_price, RequestItem.unit_price
                FROM koufu_purchasing.request_items AS RequestItem
                LEFT JOIN koufu_purchasing.requests AS Request
                ON RequestItem.request_uuid = Request.uuid 
                LEFT JOIN koufu_purchasing.purchase_orders AS PurchaseOrder
                ON PurchaseOrder.request_id = Request.id 
                LEFT JOIN koufu_system.general_items AS GeneralItem
                ON GeneralItem.id = RequestItem.foreign_key 
                	 AND RequestItem.model = "GeneralItem"
                LEFT JOIN koufu_system.substrates AS Substrate
                ON Substrate.id = RequestItem.foreign_key
                	AND RequestItem.model = "Substrate"
                LEFT JOIN koufu_system.compound_substrates AS CompoundSubstrate
                ON CompoundSubstrate.id = RequestItem.foreign_key
                	AND RequestItem.model = "CompoundSubstrate"
                LEFT JOIN koufu_system.corrugated_papers AS CorrugatedPaper
                ON CorrugatedPaper.id = RequestItem.foreign_key 
                	AND RequestItem.model = "CorrugatedPaper"
                LEFT JOIN koufu_system.suppliers AS Supplier
                ON PurchaseOrder.supplier_id = Supplier.id 
                LEFT JOIN koufu_purchasing.purchasing_items AS PurchasingItem
                ON PurchasingItem.request_uuid = Request.uuid
                WHERE Supplier.name LIKE "%'.$hint.'%" OR GeneralItem.name LIKE "%'.$hint.'%"
                OR Substrate.name LIKE "%'.$hint.'%" OR CompoundSubstrate.name LIKE "%'.$hint.'%"
                OR CorrugatedPaper.name LIKE "%'.$hint.'%"');

		foreach ($requestItemData as $key => $value) {
		
			if(!empty($value['PurchasingItem']['unit_price_unit_id'])){

				$requestItemData[$key]['model'] = 'PurchasingItem';

			}else{

				$requestItemData[$key]['model'] = 'PurchasingItem';
			}

			if(!empty($value['GeneralItem']['id'])){

				$requestItemData[$key]['modelItem'] = 'GeneralItem';

			}

			if(!empty($value['Substrate']['id'])){

				$requestItemData[$key]['modelItem'] = 'Substrate';

			}

			if(!empty($value['CompoundSubstrate']['id'])){

				$requestItemData[$key]['modelItem'] = 'CompoundSubstrate';

			}

			if(!empty($value['CorrugatedPaper']['id'])){

				$requestItemData[$key]['modelItem'] = 'CorrugatedPaper';

			}

		}

		//pr($requestItemData); exit;

		$this->loadModel('Supplier');
		$supplierData = $this->Supplier->find('list', array('fields' => array('Supplier.id', 'Supplier.name'),
															));

		$this->loadModel('Currency');
		$currencyData = $this->Currency->find('list', array('fields' => array('id', 'name'),
																'order' => array('Currency.name' => 'ASC')
																));


		$this->set(compact('requestItemData','supplierData','currencyData', 'modelTable'));

        $this->render('searched_purchase_item'); 

    }

}