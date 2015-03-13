<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class RequestStocksController extends WareHouseAppController {

	public $useDbConfig = array('koufu_ware_house','koufu_purchasing');
	public $uses = array('WareHouse.RequestStock');

	public function index(){
		$resquestList = $this->RequestStock->find('all');
	
		$this->set(compact('resquestList'));

	}

	public function add(){
		$userData = $this->Session->read('Auth');
		$this->set(compact('supplierName'));

		if ($this->request->is('post')) {
			if (!empty($this->request->data)) {		
				$data = $this->request->data['RequestStocks'];
				$this->RequestStock->addrequeststock($data, $userData['User']['id']);

            	$this->Session->setFlash(__('New Customer Information Added.'));
            	$this->redirect( array('controller' => 'request_stocks', 'action' => 'index'));
            } else{
	            	$this->Session->setFlash(__('The invalid data. Please, try again.'));
	        }
            	
        }
	}

	public function edit($id = null){
		
		if ($this->request->is('post')) {
			 if ($this->RequestStock->save($this->request->data)) {
		            // Set a session flash message and redirect.
		            $this->Session->setFlash('Stock updated!');
		           $this->redirect( array('controller' => 'request_stocks', 'action' => 'index'));
		        }
		} else {
			if ($id) {
				$data = $this->RequestStock->findById($id);
					$this->set(compact('data'));
			
			}
		}

	}
	public function delete($id = null){


		if ($this->RequestStock->delete($id)) {
			
			$this->Session->setFlash(__('Request Stock info has been deleted successfully.'),'success');
			$this->redirect(
				array('controller' => 'request_stocks', 'action' => 'index')
			);
		
		} else {
			
			$this->Session->setFlash(__('Error Deleting Information.'),'error');
			$this->redirect(
					array('controller' => 'request_stocks', 'action' => 'index')
				);
			
		}

	}

}
