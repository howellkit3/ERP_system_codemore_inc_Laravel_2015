<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


App::uses('ImageUploader', 'Vendor');

class StatusesController  extends HumanResourceAppController {


	public function add() {

		$this->loadModel('HumanResource.Status');

		$auth = $this->Session->read('Auth.User');

		if(!empty($this->request->data)){
			
			$this->Status->saveStatus($this->request->data,$auth['id']);

			//$save
	 		$this->Session->setFlash('Saving Status information completed');
 		   	$this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'status',
                     'tab' => 'status'
                ));
		}

	}

	public function edit($id = null) {

		$this->loadModel('HumanResource.Status');

		$auth = $this->Session->read('Auth.User');
		
		if(!empty($this->request->data)){
			
			$this->Status->saveStatus($this->request->data,$auth['id']);

			//$save
	 		$this->Session->setFlash('Saving Status information completed');
 		   	$this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'status',
                     'tab' => 'status'
                ));
		}
		
		if (!empty($id)) {

			$this->request->data = $this->Status->findById($id);

		}

	}

	public function view($id = null ) {

		$this->loadModel('HumanResource.Status');

		$auth = $this->Session->read('Auth.User');
		
		
		if (!empty($id)) {

			$statusData = $this->Status->findById($id);

		}

		$this->set(compact('statusData'));

	}

	public function delete($posId){

		$this->loadModel('HumanResource.Status');

		if (!empty($posId)) {

			if ($this->Position->delete($posId)) {
                $this->Session->setFlash(
                    __('Position Successfully deleted.', h($posId))
                );
            } else {
                $this->Session->setFlash(
                    __('Position cannot be deleted.', h($posId))
                );
            }

            return $this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'status',
                     'tab' => 'status',
                     'plugin' => 'human_resource'

                ));
		}
	}

}