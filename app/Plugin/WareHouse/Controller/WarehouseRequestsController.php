<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class WarehouseRequestsController extends WareHouseAppController {

	public function index() {
	
		$this->loadModel('WareHouse.Request');

		$this->loadModel('StatusFieldHolder');

		$this->loadModel('User');

		$requestData = $this->Request->find('all', array('order' => array('Request.created' => 'DESC')));
		
		$statusData = $this->StatusFieldHolder->find('list', array('fields' => array('id', 'status'),
															'order' => array('StatusFieldHolder.status' => 'ASC')
															));

		$userName = $this->User->find('list', array('fields' => array('User.id', 'User.fullname')));

		$this->set(compact('requestData','statusData','userName'));

    }

	public function create() {

		$userData = $this->Session->read('Auth');

		$this->loadModel('WareHouse.Request');

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

			$requestUuid = $this->Request->saveRequest($this->request->data['Request'],$userData['User']['id']);

			$this->RequestItem->saveRequestItem($this->request->data ,$requestUuid);
		
	 		$this->Session->setFlash(__('Request has been added.'));

            $this->redirect( array(
                     'controller' => 'requests', 
                     'action' => 'index'
    
             ));

        }

		$this->set(compact('unitData','itemData'));
			
	}

	public function view() {


	}

	public function outrecord($requestID = null) {

		//pr($requestID); exit;

	}

}