<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class SuppliersController extends PurchasingAppController {

	public $helpers = array('Purchasing.Country');

	public $uses = array('Purchasing.Supplier');

	public function index() {

		$this->Supplier->bind(array('Address','Email','Contact','SupplierContactPerson'));

		$limit = 10;

		$conditions = array();

         $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'fields' => array('id', 'name', 'description','website','created','tin'),
            'order' => 'Supplier.created DESC',
        );

		$suppliers = $this->paginate();

		$this->set(compact('suppliers'));

	}

	public function add() {
		
		$userData = $this->Session->read('Auth');

		if ($this->request->is('post')) {

            if (!empty($this->request->data)) {
            	
            	$this->Supplier->bind(array('Address','Email','Contact','SupplierContactPerson'));

            	$this->request->data = $this->Supplier->formatData($this->request->data,$userData['User']['id']);
            	$this->request->data['Supplier']['uuid'] = time();
            	$this->request->data['Supplier']['created_by'] = $userData['User']['id'];
            	$this->request->data['Supplier']['modified_by'] = $userData['User']['id'];

            	if ($this->Supplier->saveAssociated($this->request->data)) {
            		
            		$supplierId = $this->Supplier->id;

            	 	$contactPersonId = $this->Supplier->SupplierContactPerson->saveContact($this->request->data['ContactPersonData'], $supplierId,$userData['User']['id']);
            	   
                	$this->Supplier->Contact->saveContact($this->request->data['ContactPersonData'], $contactPersonId, $userData['User']['id']);
            		//$this->Supplier->Address->saveContact($this->request->data['ContactPersonData'], $contactPersonId);
            		$this->Supplier->Email->saveContact($this->request->data['ContactPersonData'], $contactPersonId,$userData['User']['id']);

	            	$this->Session->setFlash('Supplier Successfully save.','success');

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

				$this->Supplier->bind(array('Address','Email','Contact','SupplierContactPerson'));

				$suppliers = $this->Supplier->findById($dataId);
				
				$this->set(compact('suppliers'));
		}

	}

	public function delete($dataId = null){

		$this->Supplier->bind(array('Address','Email'));

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

        	$this->Supplier->bind(array('Address','Email','Contact','SupplierContactPerson'));

        	$user = $this->Session->read('Auth.User');

        	$this->request->data = $this->Supplier->formatData($this->request->data,$user['id']);



        	if ($this->Supplier->saveAssociated($this->request->data)) {

        
        		$contactPersonId = $this->Supplier->SupplierContactPerson->saveContact($this->request->data['ContactPersonData'], $this->Supplier->id,$userData['User']['id']);

                if ($contactPersonId) {

                    $this->Supplier->Contact->saveContact($this->request->data['ContactPersonData'], $contactPersonId);
                    //$this->Supplier->Address->saveContact($this->request->data['ContactPersonData'], $contactPersonId);
                    $this->Supplier->Email->saveContact($this->request->data['ContactPersonData'], $contactPersonId);  
                }
        		
				$this->Session->setFlash('Edit Supplier Successfully','success');

            	return $this->redirect(array('action' => 'index'));

            } else {

            	$this->Session->setFlash('There\'s a problem saving the data','error');
            }
	          

		} else {


			if (!empty($dataId)) {

				$this->Supplier->bind(array('Address','Email','Contact','SupplierContactPerson'));

				$this->request->data = $this->Supplier->read(null,$dataId);
				
				$this->Supplier->SupplierContactPerson->bind(array('Address', 'Email', 'Contact'));

			    $contactPerson = $this->Supplier->SupplierContactPerson->find('all', array(
			        'conditions' => array('SupplierContactPerson.supplier_id' => $dataId)
			    ));

				$this->request->data['ContactPersonData'] =  $contactPerson;
				//pr($this->request->data);exit();
			}
		}

	}

	public function add_data(){

		$userData = $this->Session->read('Auth');
	
		if ($this->request->is('post')) {

            if (!empty($this->request->data)) {

            	$supplierId = $this->request->data['Supplier']['id'];

            	$this->Supplier->bind(array('Address','Contact','Email','SupplierContactPerson'));

            	if(!empty($this->request->data['Contact'])){
            		//pr($this->request->data);exit();
            		$this->Supplier->Contact->saveNumber($this->request->data, $supplierId, $userData['User']['id']);
            		$this->Session->setFlash(__('Contact Successfully added in the system.'));
            	}
            	if(!empty($this->request->data['Address'])){
            		//pr($this->request->data);exit();
            		$this->Supplier->Address->saveAddress($this->request->data, $supplierId, $userData['User']['id']);
            		$this->Session->setFlash(__('Address Successfully added in the system.'));
            	}
            	if(!empty($this->request->data['Email'])){
            		//pr($this->request->data);exit();
            		$this->Supplier->Email->saveEmail($this->request->data, $supplierId, $userData['User']['id']);
            		$this->Session->setFlash(__('Email Successfully added in the system.'));
            	}
            	if(!empty($this->request->data['SupplierContactPerson'])){
            		
            		$personId = $this->Supplier->SupplierContactPerson->saveContactPerson($this->request->data, $supplierId, $userData['User']['id']);
            		
            		$this->Supplier->Contact->saveNumber($this->request->data, $personId, $userData['User']['id']);

            		$this->Supplier->Email->saveEmail($this->request->data, $personId, $userData['User']['id']);

            		$this->Session->setFlash(__('Contact Person Successfully added in the system.'));
            	}
            	
            	$this->redirect(
					array('controller' => 'suppliers', 'action' => 'view', $supplierId)
				);
			}
		}
	}

	public function search_supplier($hint = null){

        $this->Supplier->bind(array('Address','Email','Contact','SupplierContactPerson'));

        $suppliers = $this->Supplier->find('all',array(
                      'conditions' => array(
                        'OR' => array(
                        array('Supplier.name LIKE' => '%' . $hint . '%')
                          )
                        ),
                      'limit' => 10
                      )); 


       $this->set(compact('suppliers'));

        if ($hint == ' ') {
            $this->render('index');
        }else{
            $this->render('search_supplier');
        }
    }



}