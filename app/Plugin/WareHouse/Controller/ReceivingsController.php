<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class ReceivingsController extends WareHouseAppController {

	public $uses = array('WareHouse.CustomField');

	public function index() {

		$this->loadModel('Purchasing.PurchaseOrder');

		$this->loadModel('Supplier');

		$supplierData = $this->Supplier->find('list', array('fields' => array('Supplier.id', 'Supplier.name')
																));

		$purchaseOrderData = $this->PurchaseOrder->find('all', array('conditions' => array('PurchaseOrder.status' => 1)));
	
		$this->set(compact('purchaseOrderData', 'supplierData'));

    }

    public function receive_order($id = null) {

    	$this->loadModel('WareHouse.ReceivedOrder');

    	$this->loadModel('Purchasing.PurchaseOrder');

		$userData = $this->Session->read('Auth');

		if ($this->request->is(array('post', 'put'))) {

			$this->ReceivedOrder->saveReceivedOrders($this->request->data['Receiving'],$userData['User']['id'],$id);

			$this->PurchaseOrder->id = $id;

			$this->PurchaseOrder->saveField('status', 11);

			$this->Session->setFlash(__('Order has been received'), 'success');
          
            $this->redirect( array(
                'controller' => 'receivings',   
                'action' => 'index'
            ));  

		}
	
		$this->set(compact());

    }

    public function receive($id = null) {

    	$this->loadModel('WareHouse.ReceivedOrder');

    	$this->loadModel('Supplier');

    	$this->loadModel('User');

    	$this->loadModel('User');

    	$this->loadModel('StatusFieldHolder');

		$userName = $this->User->find('list', array('fields' => array('User.id', 'User.fullname')
																));

		$supplierData = $this->Supplier->find('list', array('fields' => array('Supplier.id', 'Supplier.name')
																));

		$this->ReceivedOrder->bindReceive();

		$received_orders = $this->ReceivedOrder->find('all');

		//pr($received_orders); exit;
	
		$this->set(compact('received_orders', 'supplierData', 'userName'));

    }
	    	    

}