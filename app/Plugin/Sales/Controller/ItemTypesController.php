<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class ItemTypesController extends SalesAppController {

    public function beforeFilter() {

        parent::beforeFilter();

        $this->Auth->allow('add','index');

        $this->loadModel('User');
        $userData = $this->User->read(null,$this->Session->read('Auth.User.id'));//$this->Session->read('Auth');
        $this->set(compact('userData'));

    }

	public function add(){
		
		if ($this->request->is('post')) {

            if (!empty($this->request->data)) {
            
            	
            	$this->ItemType->saveType($this->request->data);
                $this->Session->setFlash(__('Added Successfully.'));
            	$this->redirect(
                    array('controller' => 'settings', 'action' => 'index')
                );
            	
			}
		}
	}
    
}