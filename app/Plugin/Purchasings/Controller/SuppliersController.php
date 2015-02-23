<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class SuppliersController extends PurchasingsAppController {

	public function index() {

		$limit = 10;

		$conditions = array();

         $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'fields' => array('id', 'name', 'description','website','created'),
            'order' => 'Supplier.created DESC',
        );

		$suppliers = $this->paginate();

		$this->set(compact('suppliers'));

	}

	public function add() {

		if ($this->request->is('post')) {


            if (!empty($this->request->data)) {

            	$this->Supplier->bind(array('Address','Product','Permit','Email','Organization'));

            	$user = $this->Session->read('Auth.User');

            	$this->request->data = $this->Supplier->formatData($this->request->data,$user['id']);
            	
            	$this->Supplier->saveAssociated($this->request->data);	


	            if ($this->Supplier->saveAssociated($this->request->data)) {

	            	$this->Session->setFlash('Save Successfully','success');

	            	return $this->redirect(array('action' => 'index'));

	            } else {

	            	$this->Session->setFlash('There\'s a problem saving the data','error');
	            }
	            
	            exit();

			}
        }
		
	}

	public function delete($dataId = null){

		$this->Supplier->bind(array('Address','Product','Permit','Email','Organization'));

		if ($this->Supplier->delete($dataId)) {
			
			$this->Session->setFlash(__('Supplier info has been deleted successfully.'),'success');
			$this->redirect(
				array('controller' => 'suppliers', 'action' => 'index')
			);
		
		} else {
			
			$this->Session->setFlash(__('Error Deleting Information.'),'error');
			$this->redirect(
					array('controller' => 'suppliers', 'action' => 'index')
				);
			
		}

	}

	public function edit($dataId = null){

		if ($this->request->is('post')) {


		} else {


			if (!empty($dataId)) {

				$this->Supplier->bind(array('Address','Product','Permit','Email','Organization'));

				$this->request->data = $this->Supplier->read(null,$dataId);
			}
		}

	}


}