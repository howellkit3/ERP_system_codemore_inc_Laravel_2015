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

		$requestData = $this->WarehouseRequest->find('all', array('order' => array('WarehouseRequest.created' => 'DESC')));


		$this->set(compact('requestData','statusData','userName'));

    }

	public function create() {

		$userData = $this->Session->read('Auth');

		$this->loadModel('WareHouse.WarehouseRequest');

		$this->loadModel('WareHouse.RequestItem');

	 	$this->loadModel('Unit');

		$unitData = $this->Unit->find('list', array('fields' => array('id', 'unit'),
															'order' => array('Unit.unit' => 'ASC')
															));

	 	if ($this->request->is(array('post','put'))) {

			$requestId = $this->WarehouseRequest->saveRequest($this->request->data['Request'],$userData['User']['id']);

			$this->RequestItem->saveRequestItem($this->request->data ,$requestId);
		
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

	 	$this->loadModel('Unit');

	 	$this->loadModel('Role');

		$unitData = $this->Unit->find('list', array('fields' => array('id', 'unit'),
															'order' => array('Unit.unit' => 'ASC')
															));

		$roleData = $this->Role->find('list', array('fields' => array('id', 'name'),
															'order' => array('Role.name' => 'ASC')
															));

    	$this->WarehouseRequest->bind('RequestItem');
		
		$requestData = $this->WarehouseRequest->find('first', array('conditions' => array('WarehouseRequest.id' => $id)));

	    foreach ($requestData['RequestItem'] as $key => $value) {
			
			if($value['model'] == 'GeneralItem'){

				$this->loadModel('GeneralItem');

	 			$itemData = $this->GeneralItem->find('list',array('fields' => array('id', 'name')));

	 			$requestData['RequestItem'][$key]['name'] = $itemData[$value['foreign_key']];
	 		}

	 		if($value['model'] == 'CorrugatedPaper'){

	 			$this->loadModel('CorrugatedPaper');

	 			$itemData = $this->CorrugatedPaper->find('list',array('fields' => array('id', 'name')));

	 			$requestData['RequestItem'][$key]['name'] = $itemData[$value['foreign_key']];
	 		}

	 		if($value['model'] == 'Substrate'){

	 			$this->loadModel('Substrate');

	 			$itemData = $this->Substrate->find('list',array('fields' => array('id', 'name')));

	 			$requestData['RequestItem'][$key]['name'] = $itemData[$value['foreign_key']];
	 		}

	 		if($value['model'] == 'CompoundSubstrate'){

	 			$this->loadModel('CompoundSubstrate');

	 			$itemData = $this->CompoundSubstrate->find('list',array('fields' => array('id', 'name')));
	 			
	 			$requestData['RequestItem'][$key]['name'] = $itemData[$value['foreign_key']];
	 		}

	    } 


	    $this->loadModel('User');

	    $preparedData = $this->User->find('first', array(
														'conditions' => array('User.id' => $requestData['WarehouseRequest']['created_by']),
														));
	    
    	$this->set(compact('requestId','requestData','userData','unitData','preparedData', 'roleData'));
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

		$this->loadModel('WareHouse.RequestItem');

		$this->loadModel('Unit');

		$this->WarehouseRequest->bind('RequestItem');

		$request = $this->WarehouseRequest->find('first', array(
														'conditions' => array( 
															'WarehouseRequest.id' => $requestID)
													));
		
		foreach($request['RequestItem'] as $key=>$value) {

			if($value['model'] == 'GeneralItem'){

				$this->loadModel('GeneralItem');

	 			$itemData = $this->GeneralItem->find('list',array('fields' => array('id', 'name')));

	 			$request['RequestItem'][$key]['name'] = $itemData[$value['foreign_key']];
	 		}

	 		if($value['model'] == 'CorrugatedPaper'){

	 			$this->loadModel('CorrugatedPaper');

	 			$itemData = $this->CorrugatedPaper->find('list',array('fields' => array('id', 'name')));

	 			$request['RequestItem'][$key]['name'] = $itemData[$value['foreign_key']];
	 	
	 		}

	 		if($value['model'] == 'Substrate'){

	 			$this->loadModel('Substrate');

	 			$itemData = $this->Substrate->find('list',array('fields' => array('id', 'name')));

	 			$request['RequestItem'][$key]['name'] = $itemData[$value['foreign_key']];
	 	
	 		}

	 		if($value['model'] == 'CompoundSubstrate'){

	 			$this->loadModel('CompoundSubstrate');

	 			$itemData = $this->CompoundSubstrate->find('list',array('fields' => array('id', 'name')));
	 			
	 			$request['RequestItem'][$key]['name'] = $itemData[$value['foreign_key']];
	 	
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

		$view->set(compact('request', 'preparedFullName', 'department', 'requestItem', 'itemData', 'unitData'));
        
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

		$this->loadModel('WareHouse.RequestItem');

	 	$this->loadModel('Unit');

	 	$this->WarehouseRequest->bind('RequestItem');

	 	$request = $this->WarehouseRequest->find('first', array(
														'conditions' => array( 
															'WarehouseRequest.id' => $requestID)
													));

	 	foreach ($request['RequestItem'] as $key => $value) {
			
			if($value['model'] == 'GeneralItem'){

				$this->loadModel('GeneralItem');

	 			$itemData = $this->GeneralItem->find('list',array('fields' => array('id', 'name')));

	 			$request['RequestItem'][$key]['name'] = $itemData[$value['foreign_key']];
	 		}

	 		if($value['model'] == 'CorrugatedPaper'){

	 			$this->loadModel('CorrugatedPaper');

	 			$itemData = $this->CorrugatedPaper->find('list',array('fields' => array('id', 'name')));

	 			$request['RequestItem'][$key]['name'] = $itemData[$value['foreign_key']];
	 		}

	 		if($value['model'] == 'Substrate'){

	 			$this->loadModel('Substrate');

	 			$itemData = $this->Substrate->find('list',array('fields' => array('id', 'name')));

	 			$request['RequestItem'][$key]['name'] = $itemData[$value['foreign_key']];
	 		}

	 		if($value['model'] == 'CompoundSubstrate'){

	 			$this->loadModel('CompoundSubstrate');

	 			$itemData = $this->CompoundSubstrate->find('list',array('fields' => array('id', 'name')));
	 			
	 			$request['RequestItem'][$key]['name'] = $itemData[$value['foreign_key']];
	 		}

	    } 

	  //  pr($request); exit;

		$unitData = $this->Unit->find('list', array('fields' => array('id', 'unit'),
															'order' => array('Unit.unit' => 'ASC')
															));


	 	if ($this->request->is(array('post','put'))) {

	 		pr($this->request->data); exit;

			$requestId = $this->WarehouseRequest->saveRequest($this->request->data['Request'],$userData['User']['id']);

			$this->RequestItem->saveRequestItem($this->request->data ,$requestId);
		
	 		$this->Session->setFlash(__('Request has been added.'));

            $this->redirect( array(
                     'controller' => 'warehouse_requests', 
                     'action' => 'index'
    
             ));

        }

		$this->set(compact('unitData','itemData', 'request'));
			
	 }

}