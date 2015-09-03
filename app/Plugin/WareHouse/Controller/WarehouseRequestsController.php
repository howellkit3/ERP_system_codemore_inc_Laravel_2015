<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');
App::import('Vendor', 'DOMPDF', true, array(), 'dompdf'.DS.'dompdf_config.inc.php', false);

class WarehouseRequestsController extends WareHouseAppController {

	public function index() {
	
		$this->loadModel('WareHouse.WarehouseRequest');

		$this->loadModel('StatusFieldHolder');

		$this->loadModel('User');

		$statusData = $this->StatusFieldHolder->find('list', array('fields' => array('id', 'status'),
															'order' => array('StatusFieldHolder.status' => 'ASC')
															));

		$userName = $this->User->find('list', array('fields' => array('User.id', 'User.fullname')));

		$this->loadModel('Unit');

		$unitData = $this->Unit->find('list', array('fields' => array('id', 'unit'),
															'order' => array('Unit.unit' => 'ASC')
															));

		$this->WarehouseRequest->bind('WarehouseRequestItem');		

		$requestData = $this->WarehouseRequest->find('all', array('order' => array('WarehouseRequest.created' => 'DESC')));

		foreach ($requestData as $key => $value) {

			foreach ($value['WarehouseRequestItem'] as $key1 => $valueOfRequest) {
				
				if($valueOfRequest['model'] == 'GeneralItem'){

					$this->loadModel('GeneralItem');

		 			$itemData = $this->GeneralItem->find('list',array('fields' => array('id', 'name')));

		 			$requestData[$key]['WarehouseRequestItem'][$key1]['name'] = $itemData[$valueOfRequest['foreign_key']];
		 		}

		 		if($valueOfRequest['model'] == 'CorrugatedPaper'){

		 			$this->loadModel('CorrugatedPaper');

		 			$itemData = $this->CorrugatedPaper->find('list',array('fields' => array('id', 'name')));

		 			$requestData[$key]['WarehouseRequestItem'][$key1]['name'] = $itemData[$valueOfRequest['foreign_key']];
		 		}

		 		if($valueOfRequest['model'] == 'Substrate'){

		 			$this->loadModel('Substrate');

		 			$itemData = $this->Substrate->find('list',array('fields' => array('id', 'name')));

		 			$requestData[$key]['WarehouseRequestItem'][$key1]['name'] = $itemData[$valueOfRequest['foreign_key']];
		 		}

		 		if($valueOfRequest['model'] == 'CompoundSubstrate'){

		 			$this->loadModel('CompoundSubstrate');

		 			$itemData = $this->CompoundSubstrate->find('list',array('fields' => array('id', 'name')));
		 			
		 			$requestData[$key]['WarehouseRequestItem'][$key1]['name'] = $itemData[$valueOfRequest['foreign_key']];
		 		}
		 	}
	    } 

		$this->set(compact('requestData','statusData','userName', 'unitData'));

    }

	public function create() {

		$userData = $this->Session->read('Auth');

		$this->loadModel('WareHouse.WarehouseRequest');

		$this->loadModel('WareHouse.WarehouseRequestItem');

	 	$this->loadModel('Unit');

		$unitData = $this->Unit->find('list', array('fields' => array('id', 'unit'),
															'order' => array('Unit.unit' => 'ASC')
															));

	 	if ($this->request->is(array('post','put'))) {

			$requestId = $this->WarehouseRequest->saveRequest($this->request->data['Request'],$userData['User']['id']);

			$this->WarehouseRequestItem->saveRequestItem($this->request->data ,$requestId);
		
	 		$this->Session->setFlash(__('Request has been added.'));

            $this->redirect( array(
                     'controller' => 'warehouse_requests', 
                     'action' => 'index'
    
             ));

        }

		$this->set(compact('unitData','itemData'));
			
	}


	public function view($id = null){

    	$userData = $this->Session->read('Auth');

    	$this->loadModel('WareHouse.WarehouseRequest');

    	$this->loadModel('WareHouse.Stock');

	 	$this->loadModel('Unit');

	 	

	 	//pr($userData); exit;

		$unitData = $this->Unit->find('list', array('fields' => array('id', 'unit'),
															'order' => array('Unit.unit' => 'ASC')
															));


		if($userData['User']['role_id'] == 1 ){

			$roleName =  "Super Admin";

		} else if($userData['User']['role_id'] == 2){

			$roleName =  "CEO";

		} else if($userData['User']['role_id'] == 3 || $userData['User']['role_id'] == 8){

			$roleName =  "Sales";

		} else if($userData['User']['role_id'] == 4){

			$roleName =  "Warehouse";

		} else if($userData['User']['role_id'] == 5){

			$roleName =  "Delivery";

		} else if($userData['User']['role_id'] == 6 || $userData['User']['role_id'] == 9 || $userData['User']['role_id'] == 10 || $userData['User']['role_id'] == 11 ){

			$roleName =  "Accounting";

		} else if($userData['User']['role_id'] == 7){

			$roleName =  "Purchasing";

		} else if($userData['User']['role_id'] == 12){

			$roleName =  "Human Resource";

		} else {

			$roleName =  "Staff";
		}

    	$this->WarehouseRequest->bind('WarehouseRequestItem');
		
		$requestData = $this->WarehouseRequest->find('first', array('conditions' => array('WarehouseRequest.id' => $id)));

		$stockData = $this->Stock->find('all');

	    foreach ($requestData['WarehouseRequestItem'] as $key => $value) {

	    	foreach ($stockData as $key1 => $valueofStock) {

	    		if($valueofStock['Stock']['model'] == $value['model'] && $valueofStock['Stock']['item_id'] == $value['foreign_key']){

	    			$requestData['WarehouseRequestItem'][$key]['stock_quantity'] = $valueofStock['Stock']['quantity'];
	    			 
	    		}

	    	} 
			
			if($value['model'] == 'GeneralItem'){

				$this->loadModel('GeneralItem');

	 			$itemData = $this->GeneralItem->find('list',array('fields' => array('id', 'name')));

	 			$requestData['WarehouseRequestItem'][$key]['name'] = $itemData[$value['foreign_key']];
	 		}

	 		if($value['model'] == 'CorrugatedPaper'){

	 			$this->loadModel('CorrugatedPaper');

	 			$itemData = $this->CorrugatedPaper->find('list',array('fields' => array('id', 'name')));

	 			$requestData['WarehouseRequestItem'][$key]['name'] = $itemData[$value['foreign_key']];
	 		}

	 		if($value['model'] == 'Substrate'){

	 			$this->loadModel('Substrate');

	 			$itemData = $this->Substrate->find('list',array('fields' => array('id', 'name')));

	 			$requestData['WarehouseRequestItem'][$key]['name'] = $itemData[$value['foreign_key']];
	 		}

	 		if($value['model'] == 'CompoundSubstrate'){

	 			$this->loadModel('CompoundSubstrate');

	 			$itemData = $this->CompoundSubstrate->find('list',array('fields' => array('id', 'name')));
	 			
	 			$requestData['WarehouseRequestItem'][$key]['name'] = $itemData[$value['foreign_key']];
	 		}

	    } 


	    $this->loadModel('User');

	    $preparedData = $this->User->find('first', array(
														'conditions' => array('User.id' => $requestData['WarehouseRequest']['created_by']),
														));
	    
    	$this->set(compact('requestId','requestData','userData','unitData','preparedData','roleName'));
    }

	public function approve($requestID = null) {

		$this->loadModel('WareHouse.WarehouseRequest');

    	$this->WarehouseRequest->id = $requestID;

    	$this->WarehouseRequest->saveField('status_id',1);

    	$this->Session->setFlash(__('Request has been approved.'));

        $this->redirect( array(
                 'controller' => 'warehouse_requests', 
                 'action' => 'index'

         ));


	}


	public function print_request($requestID = null) {

		$this->loadModel('WareHouse.WarehouseRequest');

		$this->loadModel('WareHouse.Stock');

		$this->loadModel('Unit');

		$this->WarehouseRequest->bind('WarehouseRequestItem');

		$request = $this->WarehouseRequest->find('first', array(
														'conditions' => array( 
															'WarehouseRequest.id' => $requestID)
													));

		$userData = $this->Session->read('Auth');

		$stockData = $this->Stock->find('all');

		if($userData['User']['role_id'] == 1 ){

			$roleName =  "Super Admin";

		} else if($userData['User']['role_id'] == 2){

			$roleName =  "CEO";

		} else if($userData['User']['role_id'] == 3 || $userData['User']['role_id'] == 8){

			$roleName =  "Sales";

		} else if($userData['User']['role_id'] == 4){

			$roleName =  "Warehouse";

		} else if($userData['User']['role_id'] == 5){

			$roleName =  "Delivery";

		} else if($userData['User']['role_id'] == 6 || $userData['User']['role_id'] == 9 || $userData['User']['role_id'] == 10 || $userData['User']['role_id'] == 11 ){

			$roleName =  "Accounting";

		} else if($userData['User']['role_id'] == 7){

			$roleName =  "Purchasing";

		} else if($userData['User']['role_id'] == 12){

			$roleName =  "Human Resource";

		} else {

			$roleName =  "Staff";
		}
		
		foreach($request['WarehouseRequestItem'] as $key=>$value) {

			foreach ($stockData as $key1 => $valueofStock) {

	    		if($valueofStock['Stock']['model'] == $value['model'] && $valueofStock['Stock']['item_id'] == $value['foreign_key']){

	    			$request['WarehouseRequestItem'][$key]['stock_quantity'] = $valueofStock['Stock']['quantity'];
	    			 
	    		}

	    	} 

			if($value['model'] == 'GeneralItem'){

				$this->loadModel('GeneralItem');

	 			$itemData = $this->GeneralItem->find('list',array('fields' => array('id', 'name')));

	 			$request['WarehouseRequestItem'][$key]['name'] = $itemData[$value['foreign_key']];
	 		}

	 		if($value['model'] == 'CorrugatedPaper'){

	 			$this->loadModel('CorrugatedPaper');

	 			$itemData = $this->CorrugatedPaper->find('list',array('fields' => array('id', 'name')));

	 			$request['WarehouseRequestItem'][$key]['name'] = $itemData[$value['foreign_key']];
	 	
	 		}

	 		if($value['model'] == 'Substrate'){

	 			$this->loadModel('Substrate');

	 			$itemData = $this->Substrate->find('list',array('fields' => array('id', 'name')));

	 			$request['WarehouseRequestItem'][$key]['name'] = $itemData[$value['foreign_key']];
	 	
	 		}

	 		if($value['model'] == 'CompoundSubstrate'){

	 			$this->loadModel('CompoundSubstrate');

	 			$itemData = $this->CompoundSubstrate->find('list',array('fields' => array('id', 'name')));
	 			
	 			$request['WarehouseRequestItem'][$key]['name'] = $itemData[$value['foreign_key']];
	 	
	  		}

	  		
		} 

		$unitData = $this->Unit->find('list',array('fields' => array('id', 'unit')));

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

		$view->set(compact('request', 'preparedFullName', 'department', 'requestItem', 'itemData', 'unitData', 'roleName'));
        
		$view->viewPath = 'WarehouseRequests'.DS.'pdf';	
   
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
        	$filename = 'product-'.$request['WarehouseRequest']['uuid'].'-request'.time();
        }
      	$filePath = 'view_pdf/'.strtolower(Inflector::slug( $filename , '-')).'.pdf';
        $file_to_save = WWW_ROOT .DS. $filePath;
        	
        if ($dompdf->stream( $file_to_save, array( 'Attachment'=>0 ) )) {
        		unlink($file_to_save);
        }
        
        exit();
	}

	 public function edit_request($requestID = null) {

	 	$userData = $this->Session->read('Auth');

		$this->loadModel('WareHouse.WarehouseRequest');

		$this->loadModel('WareHouse.WarehouseRequestItem');

	 	$this->loadModel('Unit');

	 	$this->WarehouseRequest->bind('WarehouseRequestItem');

	 	$request = $this->WarehouseRequest->find('first', array(
														'conditions' => array( 
															'WarehouseRequest.id' => $requestID)
													));

	 	foreach ($request['WarehouseRequestItem'] as $key => $value) {
			
			if($value['model'] == 'GeneralItem'){

				$this->loadModel('GeneralItem');

	 			$itemData = $this->GeneralItem->find('list',array('fields' => array('id', 'name')));

	 			$request['WarehouseRequestItem'][$key]['name'] = $itemData[$value['foreign_key']];
	 		}

	 		if($value['model'] == 'CorrugatedPaper'){

	 			$this->loadModel('CorrugatedPaper');

	 			$itemData = $this->CorrugatedPaper->find('list',array('fields' => array('id', 'name')));

	 			$request['WarehouseRequestItem'][$key]['name'] = $itemData[$value['foreign_key']];
	 		}

	 		if($value['model'] == 'Substrate'){

	 			$this->loadModel('Substrate');

	 			$itemData = $this->Substrate->find('list',array('fields' => array('id', 'name')));

	 			$request['WarehouseRequestItem'][$key]['name'] = $itemData[$value['foreign_key']];
	 		}

	 		if($value['model'] == 'CompoundSubstrate'){

	 			$this->loadModel('CompoundSubstrate');

	 			$itemData = $this->CompoundSubstrate->find('list',array('fields' => array('id', 'name')));
	 			
	 			$request['WarehouseRequestItem'][$key]['name'] = $itemData[$value['foreign_key']];
	 		}

	    } 

		$unitData = $this->Unit->find('list', array('fields' => array('id', 'unit'),
															'order' => array('Unit.unit' => 'ASC')
															));

	 	if ($this->request->is(array('post','put'))) {


			$requestId = $this->WarehouseRequest->saveRequest($this->request->data['Request'],$userData['User']['id']);

			$this->WarehouseRequestItem->saveRequestItem($this->request->data ,$requestId);
		
	 		$this->Session->setFlash(__('Request has been added.'));

            $this->redirect( array(
                     'controller' => 'warehouse_requests', 
                     'action' => 'index'
    
             ));

        }

		$this->set(compact('unitData','itemData', 'request', 'requestID'));
			
	 }

	public function out_record($ID = null) {

		if(!empty($this->request->data['WarehouseRequestItem'])){

			if ($this->request->is(array('post','put'))) {

				$userData = $this->Session->read('Auth');

				$this->loadModel('WareHouse.OutRecord');

				$this->loadModel('WareHouse.ItemRecord');

				$this->loadModel('WareHouse.WarehouseRequestItem');

				$this->loadModel('WareHouse.WarehouseRequest');

				$this->loadModel('WareHouse.Stock');

				pr($this->request->data); exit;

				$requestId = $this->OutRecord->saveOutRecord($this->request->data['OutRecord'],$ID,$userData['User']['id']);

				$this->ItemRecord->saveOutItemRecord($this->request->data['WarehouseRequestItem'], $requestId);

				$stockData = $this->Stock->find('all');

				$condition = $this->Stock->saveOutRecordStock($this->request->data['WarehouseRequestItem'], $userData['User']['id'], $stockData );
				
				$this->WarehouseRequest->id = $ID;

	    		$this->WarehouseRequest->saveField('status_id',12);

				$this->Session->setFlash(__('Request Item has been deducted to stocks.'), 'success');

	            $this->redirect( array(
	                     'controller' => 'warehouse_requests', 
	                     'action' => 'index'
	    
	            ));
	        }
	    } else{

	    	$this->Session->setFlash(__('Unable to deduct the request items from stocks.'), 'error');

	        $this->redirect( array(
	                     'controller' => 'warehouse_requests', 
	                     'action' => 'index'));

	    }
	}

	public function stock() {

		$this->loadModel('WareHouse.Stock');

		$this->loadModel('Area');

		$stockData = $this->Stock->find('all');

		$areaData = $this->Area->find('list',array('fields' => array('id', 'name')));

		foreach ($stockData as $key => $value) {
			
			if($value['Stock']['model'] == 'GeneralItem'){

				$this->loadModel('GeneralItem');

	 			$itemData = $this->GeneralItem->find('list',array('fields' => array('id', 'name')));

	 			$stockData[$key]['Stock']['name'] = $itemData[$value['Stock']['item_id']];
	 		}

	 		if($value['Stock']['model'] == 'CorrugatedPaper'){

	 			$this->loadModel('CorrugatedPaper');

	 			$itemData = $this->CorrugatedPaper->find('list',array('fields' => array('id', 'name')));

	 			$stockData[$key]['Stock']['name'] = $itemData[$value['Stock']['item_id']];
	 		}

	 		if($value['Stock']['model'] == 'Substrate'){

	 			$this->loadModel('Substrate');

	 			$itemData = $this->Substrate->find('list',array('fields' => array('id', 'name')));

	 			$stockData[$key]['Stock']['name'] = $itemData[$value['Stock']['item_id']];
	 		}

	 		if($value['Stock']['model'] == 'CompoundSubstrate'){

	 			$this->loadModel('CompoundSubstrate');

	 			$itemData = $this->CompoundSubstrate->find('list',array('fields' => array('id', 'name')));
	 			
	 			$stockData[$key]['Stock']['name'] = $itemData[$value['Stock']['item_id']];
	 		}
	    } 

		$this->set(compact('stockData', 'areaData'));

	}

	public function stock_view($id = null){

		$this->loadModel('WareHouse.Stock');

		$this->loadModel('Unit');

		$this->loadModel('Area');

		$unitData = $this->Unit->find('list', array('fields' => array('id', 'unit'),
															'order' => array('Unit.unit' => 'ASC')
															));

		$areaData = $this->Area->find('list', array('fields' => array('id', 'name'),
															'order' => array('Area.id' => 'ASC')
															));

		$stockData = $this->Stock->find('first', array('conditions' => array('Stock.id' => $id)));

			if($stockData['Stock']['model'] == 'GeneralItem'){

				$this->loadModel('GeneralItem');

	 			$itemData = $this->GeneralItem->find('list',array('fields' => array('id', 'name')));

	 			$stockData['Stock']['name'] = $itemData[$stockData['Stock']['item_id']];
	 		}

	 		if($stockData['Stock']['model'] == 'CorrugatedPaper'){

	 			$this->loadModel('CorrugatedPaper');

	 			$itemData = $this->CorrugatedPaper->find('list',array('fields' => array('id', 'name')));

	 			$stockData['Stock']['name'] = $itemData[$stockData['Stock']['item_id']];
	 		}

	 		if($stockData['Stock']['model'] == 'Substrate'){

	 			$this->loadModel('Substrate');

	 			$itemData = $this->Substrate->find('list',array('fields' => array('id', 'name')));

	 			$stockData['Stock']['name'] = $itemData[$stockData['Stock']['item_id']];
	 		}

	 		if($stockData['Stock']['model'] == 'CompoundSubstrate'){

	 			$this->loadModel('CompoundSubstrate');

	 			$itemData = $this->CompoundSubstrate->find('list',array('fields' => array('id', 'name')));
	 			
	 			$stockData['Stock']['name'] = $itemData[$stockData['Stock']['item_id']];
	 		}

		$this->set(compact('stockData', 'unitData', 'areaData'));
    	
    }

}