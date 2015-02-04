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
	
	}

	public function custom_field() {

		$userData = $this->Session->read('Auth');
		
		if ($this->request->is('post')) {

            if (!empty($this->request->data)) {
            	
            	$this->CustomField->savelabel($this->request->data,$userData['User']['id']);

            	$this->Session->setFlash(__('Register Complete.'));
            	$this->redirect(
                    array('controller' => 'settings', 'action' => 'custom_field')
                );
            	
			}
		}
	}
	
}