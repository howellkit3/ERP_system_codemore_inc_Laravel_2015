<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class ItemCategoriesController extends SalesAppController {

	public function add(){
		$userData = $this->Session->read('Auth');
		
		if ($this->request->is('post')) {

            if (!empty($this->request->data)) {
            	
            	$this->ItemCategory->saveCategory($this->request->data,$userData['User']['id']);

            	$this->Session->setFlash(__('Added Successfully.'));
            	$this->redirect( array(
                                'controller' => 'settings', 
                                'action' => 'index'
                                )
                            );
            	
			}
		}
	}

    public function delete_item($categoryName = null){

            $this->ItemCategory->deleteItem($categoryName);
            $this->Session->setFlash(__('Deleted Successfully.'));
            $this->redirect(
                    array('controller' => 'settings', 'action' => 'index')
                        );

        
    }
}