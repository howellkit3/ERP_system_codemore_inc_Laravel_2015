<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class ItemTypesController extends SalesAppController {

	public function add(){
		//$userData = $this->Session->read('Auth');
		
		if ($this->request->is('post')) {

            if (!empty($this->request->data)) {
                //pr($this->request->data);exit();
            	
            	$this->ItemType->saveType($this->request->data);

            	$this->redirect(
                    array('controller' => 'settings', 'action' => 'index')
                );
            	
			}
		}
	}
    
}