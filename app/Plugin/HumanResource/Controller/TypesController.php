<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


App::uses('ImageUploader', 'Vendor');

class TypesController  extends HumanResourceAppController {


	public function add() {

		$this->loadModel('HumanResource.Type');

		$this->loadModel('HumanResource.Category');

		$categoryList = $this->Category->find('list',array('fields' => array('id','name')));

		$auth = $this->Session->read('Auth.User');

		if(!empty($this->request->data)){
			
			$this->Type->saveType($this->request->data,$auth['id']);

			//$save
	 		$this->Session->setFlash('Saving Type information completed','success');
 		   	$this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'type',
                     'tab' => 'type'
                ));
		}

		$this->set(compact('categoryList'));

	}

	public function edit($id = null) {

		$this->loadModel('HumanResource.Type');

		$this->loadModel('HumanResource.Category');

		$categoryList = $this->Category->find('list',array('fields' => array('id','name')));

		$auth = $this->Session->read('Auth.User');
		
		if(!empty($this->request->data)){
			
			$this->Type->saveType($this->request->data,$auth['id']);

			//$save
	 		$this->Session->setFlash('Saving Type information completed','success');
 		   	$this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'type',
                     'tab' => 'type'
                ));
		}
		
		if (!empty($id)) {

			$this->request->data = $this->Type->findById($id);

		}

		$this->set(compact('categoryList'));

	}

	public function view($id = null ) {

		$this->loadModel('HumanResource.Type');

		$this->loadModel('HumanResource.Category');

		$categoryList = $this->Category->find('list',array('fields' => array('id','name')));

		$auth = $this->Session->read('Auth.User');
		
		
		if (!empty($id)) {

			$typeData = $this->Type->findById($id);

		}

		$this->set(compact('typeData','categoryList'));

	}

	public function delete($posId){

		$this->loadModel('HumanResource.Type');

		if (!empty($posId)) {

			if ($this->Type->delete($posId)) {
                $this->Session->setFlash(
                    __('Type Successfully deleted.', h($posId))
                );
            } else {
                $this->Session->setFlash(
                    __('Type cannot be deleted.', h($posId))
                );
            }

            return $this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'type',
                     'tab' => 'type',
                     'plugin' => 'human_resource'

                ));
		}
	}

}