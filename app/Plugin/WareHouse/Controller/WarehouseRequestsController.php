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

			$requestUuid = $this->WarehouseRequest->saveRequest($this->request->data['Request'],$userData['User']['id']);

			$this->RequestItem->saveRequestItem($this->request->data ,$requestUuid);
		
	 		$this->Session->setFlash(__('Request has been added.'));

            $this->redirect( array(
                     'controller' => 'warehouse_requests', 
                     'action' => 'index'
    
             ));

        }

		$this->set(compact('unitData','itemData'));
			
	}

	public function view($id = null) {

		$this->loadModel('WareHouse.WarehouseRequest');

		$this->loadModel('User');

		$warehouseRequestData = $this->WarehouseRequest->find('first', array('conditions' => array('WarehouseRequest.id' => $id)));

		$fullname = $this->User->find('list', array('fields' => array('id', 'fullname')
															));

		//pr($fullname); exit;

		$this->set(compact('warehouseRequestData','fullname'));

	}

	public function outrecord($requestID = null) {

		//pr($requestID); exit;

	}

}