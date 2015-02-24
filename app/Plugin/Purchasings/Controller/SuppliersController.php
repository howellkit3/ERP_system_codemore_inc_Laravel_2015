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
		
		$userData = $this->Session->read('Auth');

		if ($this->request->is('post')) {


            if (!empty($this->request->data)) {

            	$this->Supplier->bind(array('Address','Product','Permit','Email','Organization','Contact','ContactPerson'));

            	$user = $this->Session->read('Auth.User');

            	$this->request->data = $this->Supplier->formatData($this->request->data,$user['id']);

            	if ($this->Supplier->saveAssociated($this->request->data)) {
            		
            		$value = $this->Supplier->id.'-'.time();

            		$this->Supplier->updateModelField('unique_id',$value,$this->Supplier->id);

            	 	$contactPersonId = $this->Supplier->ContactPerson->saveContact($this->request->data['ContactPersonData'], $this->Supplier->id,$userData['User']['id']);
            		$this->Supplier->Contact->saveContact($this->request->data['ContactPersonData'], $contactPersonId);
            		$this->Supplier->Address->saveContact($this->request->data['ContactPersonData'], $contactPersonId);
            		$this->Supplier->Email->saveContact($this->request->data['ContactPersonData'], $contactPersonId);


	            	$this->Session->setFlash('Save Successfully','success');

	            	return $this->redirect(array('action' => 'index'));

	            } else {

	            	$this->Session->setFlash('There\'s a problem saving the data','error');
	            }
	            
	            exit();

			}
        }
		
	}
	public function view ($dataId = null) {

		if (!empty($dataId)) {

				$this->Supplier->bind(array('Address','Product','Permit','Email','Organization','Contact','ContactPerson'));

				$suppliers = $this->Supplier->findById($dataId);
				
				$this->set(compact('suppliers'));
		}

	}

	public function delete($dataId = null){

		$this->Supplier->bind(array('Address','Product','Permit','Email','Organization'));

		if ($this->Supplier->delete($dataId)) {
			
			$this->Session->setFlash(__('Supplier info has been deleted successfully.'),'success');
			$this->redirect(array('controller' => 'suppliers', 'action' => 'index'));
		
		} else {
			
			$this->Session->setFlash(__('Error Deleting Information.'),'error');
			$this->redirect( array('controller' => 'suppliers', 'action' => 'index'));
			
		}

	}

	public function edit($dataId = null) {

		$userData = $this->Session->read('Auth');

		if (!empty($this->request->data)) {



	        	$this->Supplier->bind(array('Address','Product','Permit','Email','Organization','Contact','ContactPerson'));

	        	$user = $this->Session->read('Auth.User');

	        	$this->request->data = $this->Supplier->formatData($this->request->data,$user['id']);

	        	
	        	if ($this->Supplier->saveAssociated($this->request->data)) {

	        		$contactPersonId = $this->Supplier->ContactPerson->saveContact($this->request->data['ContactPersonData'], $this->Supplier->id,$userData['User']['id']);
            		
            		$this->Supplier->Contact->saveContact($this->request->data['ContactPersonData'], $contactPersonId);
            		$this->Supplier->Address->saveContact($this->request->data['ContactPersonData'], $contactPersonId);
            		$this->Supplier->Email->saveContact($this->request->data['ContactPersonData'], $contactPersonId);


					$this->Session->setFlash('Edit Supplier Successfully','success');

	            	return $this->redirect(array('action' => 'index'));

	            } else {

	            	$this->Session->setFlash('There\'s a problem saving the data','error');
	            }
	          

		} else {


			if (!empty($dataId)) {

				$this->Supplier->bind(array('Address','Product','Permit','Email','Organization','Contact','ContactPerson'));

				$this->request->data = $this->Supplier->read(null,$dataId);

				$this->Supplier->ContactPerson->bind(array('Address', 'Email', 'Contact'));

			    $contactPerson = $this->Supplier->ContactPerson->find('first', array(
			        'conditions' => array('ContactPerson.supplier_id' => $dataId)
			    ));

			    $this->request->data['ContactPersonInfo'] =  $contactPerson;

			}
		}

	}


}