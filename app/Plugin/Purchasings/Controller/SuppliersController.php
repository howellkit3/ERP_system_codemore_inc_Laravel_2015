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

            	$this->Supplier->bind(array('Address'));

            	pr($this->request->data);


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

}