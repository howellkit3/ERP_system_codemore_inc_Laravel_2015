<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

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

		$this->loadModel('GeneralItem');

		$itemData = $this->GeneralItem->find('list', array('fields' => array('id', 'name'),
															'order' => array('GeneralItem.name' => 'ASC')
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

	// public function view($id = null) {

	// 	$this->loadModel('WareHouse.WarehouseRequest');

	// 	$this->loadModel('User');

	// 	$fullname = $this->User->find('list', array('fields' => array('id', 'fullname')
	// 														));

	// 	$this->WarehouseRequest->bind('RequestItem');

	// 	$requestData = $this->WarehouseRequest->find('first', array('conditions' => array('WarehouseRequest.id' => $id)));

	// 	$this->set(compact('warehouseRequestData','fullname', 'requestData'));
	// }

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

	public function outrecord($requestID = null) {


	}

}