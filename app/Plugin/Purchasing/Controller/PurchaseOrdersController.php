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
	            //'fields' => array('id', 'status','created'),
	            'order' => 'PurchaseOrder.created DESC',
	    );

		$this->paginate = $params;

		$purchaseOrderData = $this->paginate('PurchaseOrder');

    	$supplierData = $this->Supplier->find('list', array(
														'fields' => array('Supplier.id', 'Supplier.name'),
														));

    	$userName = $this->User->find('list', array('fields' => array('id', 'fullname')
															));

	//	$purchaseOrderData = $this->PurchaseOrder->find('all',array('order' => 'PurchaseOrder.id DESC'));

		$this->set(compact('purchaseOrderData','supplierData', 'userName'));

    }

    public function view($purchaseOrderid = null){

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

		//pr($currencyData); exit;
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
		
		$faxContactData = $this->Contact->find('first',array('conditions' => array('Contact.foreign_key' => $purchaseOrderData['PurchaseOrder']['supplier_id'], 'Contact.type' => 1),'order' => 'Contact.id DESC'));
		
		$telContactData = $this->Contact->find('first',array('conditions' => array('Contact.foreign_key' => $purchaseOrderData['PurchaseOrder']['supplier_id'], 'Contact.type' => 0),'order' => 'Contact.id DESC'));
		
		$requestData = $this->Request->find('first', array('conditions' => array('Request.id' => $purchaseOrderData['PurchaseOrder']['request_id'])));

		$purchaseItemData = $this->PurchasingItem->find('all', array('conditions' => array('PurchasingItem.request_uuid' => $requestData['Request']['uuid'])));

		if (empty($purchaseItemData)) {

    		$purchaseItemData = $this->RequestItem->find('all', array('conditions' => array('RequestItem.request_uuid' => $requestData['Request']['uuid'])));
    		$modelTable = 'RequestItem'; 
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
		
		$this->set(compact('modelTable','purchaseOrderData','supplierData','purchaseOrderid','unitData','paymentTermData','purchaseItemData','preparedData', 'currencyData', 'faxContactData', 'telContactData'));

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
    		
    		//pr($this->request->data); exit;

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

    	$this->PurchaseOrder->saveField('status',1);

    	$this->PurchaseOrder->saveField('order', $highest_order);

    	$this->Session->setFlash(__('Purchase Order has been approved.'));

        $this->redirect( array(
                 'controller' => 'purchase_orders', 
                 'action' => 'view',$purchaseOrderId

        ));

    }

    public function print_purchase_order($purchaseOrderId){

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

		$purchaseOrderData = $this->PurchaseOrder->find('first',array('conditions' => array('PurchaseOrder.id' => $purchaseOrderId),'order' => 'PurchaseOrder.id DESC'));

		$faxContactData = $this->Contact->find('first',array('conditions' => array('Contact.foreign_key' => $purchaseOrderData['PurchaseOrder']['supplier_id'], 'Contact.type' => 1),'order' => 'Contact.id DESC'));
		
		$telContactData = $this->Contact->find('first',array('conditions' => array('Contact.foreign_key' => $purchaseOrderData['PurchaseOrder']['supplier_id'], 'Contact.type' => 0),'order' => 'Contact.id DESC'));
		
		$requestData = $this->Request->find('first', array('conditions' => array('Request.id' => $purchaseOrderData['PurchaseOrder']['request_id'])));

		$purchaseItemData = $this->PurchasingItem->find('all', array('conditions' => array('PurchasingItem.request_uuid' => $requestData['Request']['uuid'])));

		if (empty($purchaseItemData)) {

    		$purchaseItemData = $this->RequestItem->find('all', array('conditions' => array('RequestItem.request_uuid' => $requestData['Request']['uuid'])));
    		$modelTable = 'RequestItem'; 
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

		$view->set(compact('modelTable','purchaseOrderData','supplierData','purchaseOrderId','unitData','paymentTermData','purchaseItemData','preparedData', 'currencyData', 'telContactData', 'faxContactData'));
		
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

    public function facial(){

    }

    public function search_order($hint = null){

    	$this->loadModel('Supplier');

    	$this->loadModel('User');

		$supplierData = $this->Supplier->find('list', array(
														'fields' => array('Supplier.id', 'Supplier.name'),
														));

        $joins = array(

               array('table'=>'koufu_system.users', 
                     'alias' => 'User',
                     'type'=>'left',
                     'conditions'=> array(
                     'User.id = PurchaseOrder.created_by'
               )),

               array('table'=>'koufu_system.suppliers', 
                     'alias' => 'Supplier',
                     'type'=>'left',
                     'conditions'=> array(
                     'Supplier.id = PurchaseOrder.supplier_id'
               )),
        );

        $this->PurchaseOrder->bind(array('User', 'Supplier'));

        $purchaseOrderData = $this->PurchaseOrder->find('all',array(
        			'joins'=>$joins,
                  	'conditions' => array(
                    'OR' => array(
                    array('PurchaseOrder.po_number LIKE' => '%' . $hint . '%'),
                    array('PurchaseOrder.name LIKE' => '%' . $hint . '%'),
                    array('User.first_name LIKE' => '%' . $hint . '%'),
                    array('User.last_name LIKE' => '%' . $hint . '%'),
                    array('Supplier.name LIKE' => '%' . $hint . '%')
                      )
                    ),
                //  'limit' => 10
                  )); 

		$userName = $this->User->find('list', array('fields' => array('id', 'fullname')));

     	$this->set(compact('purchaseOrderData','supplierData', 'userName'));

        if ($hint == ' ') {
            $this->render('index');
        }else{
            $this->render('search_order');
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


}