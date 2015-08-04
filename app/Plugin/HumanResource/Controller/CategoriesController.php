<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


App::uses('ImageUploader', 'Vendor');

class CategoriesController  extends HumanResourceAppController {


	public function add() {

		$this->loadModel('HumanResource.Category');

		$auth = $this->Session->read('Auth.User');

		if(!empty($this->request->data)){
			
			$this->Category->saveCategory($this->request->data,$auth['id']);

			//$save
	 		$this->Session->setFlash('Saving Category information completed','success');
 		   	$this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'category',
                     'tab' => 'category'
                ));
		}

	}

	public function edit($id = null) {

		$this->loadModel('HumanResource.Category');

		$auth = $this->Session->read('Auth.User');
		
		if(!empty($this->request->data)){
			
			$this->Category->saveCategory($this->request->data,$auth['id']);

			//$save
	 		$this->Session->setFlash('Saving Category information completed','success');
 		   	$this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'category',
                     'tab' => 'category'
                ));
		}
		
		if (!empty($id)) {

			$this->request->data = $this->Category->findById($id);

		}

	}

	public function view($id = null ) {

		$this->loadModel('HumanResource.Category');

		$auth = $this->Session->read('Auth.User');
		
		
		if (!empty($id)) {

			$categoryData = $this->Category->findById($id);

		}

		$this->set(compact('categoryData'));

	}

	public function delete($posId){

		$this->loadModel('HumanResource.Category');

		if (!empty($posId)) {

			if ($this->Category->delete($posId)) {
                $this->Session->setFlash(
                    __('Category Successfully deleted.', h($posId))
                );
            } else {
                $this->Session->setFlash(
                    __('Category cannot be deleted.', h($posId))
                );
            }

            return $this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'category',
                     'tab' => 'category',
                     'plugin' => 'human_resource'

                ));
		}
	}

}