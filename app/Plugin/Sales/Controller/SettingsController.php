<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class SettingsController extends SalesAppController {

	public $uses = array('Sales.CustomField');
	public $helper = array('Sales.Country');

	public function beforeFilter() {

        parent::beforeFilter();

        $userData = $this->Session->read('Auth');

        $this->Auth->allow('add','index');

        $this->set(compact('userData'));

    }
	    	    
	public function index() {

		$customField = $this->CustomField->find('all',array('order' => array('CustomField.id DESC')));

		//pr($customField);exit();

		$this->set(compact('customField'));

	}

	public function custom_field() {

		$userData = $this->Session->read('Auth');
		
		if ($this->request->is('post')) {

            if (!empty($this->request->data)) {
            	
            	$this->CustomField->savelabel($this->request->data,$userData['User']['id']);

            	$this->Session->setFlash(__('Register Complete.'));
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
	
}