<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class SettingsController extends SalesAppController {

	public $uses = array('Sales.CustomField','Sales.ItemCategory','Sales.ItemType','Sales.ProcessField');
	public $helper = array('Sales.Country');

	public function beforeFilter() {

        parent::beforeFilter();

        $userData = $this->Session->read('Auth');

        $this->Auth->allow('add','index');

        $this->set(compact('userData'));

    }
	    	    
	public function index() {

		$customField = $this->CustomField->find('all',array('order' => array('CustomField.id DESC')));
		$processField = $this->ProcessField->find('all',array('order' => array('ProcessField.id DESC')));
		
		$category = $this->ItemCategory->find('list', array(
											  'fields' => array(
											  'id', 'category_name'
											  		),
											  'conditions' => array(
											  'status' => 'active'

											  	)
												));
		$this->ItemCategory->bind(array('ItemType'));
		$type = $this->ItemCategory->find('all');


		$this->set(compact('customField','category','type','processField'));

	}

	public function custom_field() {

		$userData = $this->Session->read('Auth');
		
		if ($this->request->is('post')) {

            if (!empty($this->request->data)) {
            	
            	$this->CustomField->savelabel($this->request->data,$userData['User']['id']);

            	$this->redirect(
                    array('controller' => 'settings', 'action' => 'index')
                );
            	
			}
		}
	}

	public function process_field() {

		$userData = $this->Session->read('Auth');
		
		if ($this->request->is('post')) {

            if (!empty($this->request->data)) {
            	
            	$this->ProcessField->saveProcess($this->request->data,$userData['User']['id']);

            	$this->redirect(
                    array('controller' => 'settings', 'action' => 'index')
                );
            	
			}
		}
	}

	public function delete_field($fieldId = null){

		if($this->CustomField->delete($fieldId)){

			$this->Session->setFlash(__('Error Deleting Information.'));
			$this->redirect(
					array('controller' => 'settings', 'action' => 'index')
				);

		}

		
	}

	public function delete_process($fieldId = null){

		if($this->ProcessField->delete($fieldId)){

			$this->Session->setFlash(__('Process was successfully Deleted.'));
			$this->redirect(
					array('controller' => 'settings', 'action' => 'index')
				);

		}else{
			$this->Session->setFlash(__('Error Deleting Information.'));
			$this->redirect(
					array('controller' => 'settings', 'action' => 'index')
				);
		}

		
	}
	public function delete_item($fieldId = null){

		if($this->ItemType->delete($fieldId)){

			$this->Session->setFlash(__('Delete Information.'));
			$this->redirect(
					array('controller' => 'settings', 'action' => 'index')
				);

		}

		
	}
	
}