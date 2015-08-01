<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


App::uses('ImageUploader', 'Vendor');

class AgenciesController  extends HumanResourceAppController {


	public function add() {

		$this->loadModel('HumanResource.Agency');

		$auth = $this->Session->read('Auth.User');

		if(!empty($this->request->data)){
			
			$this->Agency->saveAgency($this->request->data,$auth['id']);

			//$save
	 		$this->Session->setFlash('Saving Agency information completed');
 		   	$this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'agency',
                     'tab' => 'agency'
                ));
		}

	}

	public function edit($id = null) {

		$this->loadModel('HumanResource.Agency');

		$auth = $this->Session->read('Auth.User');
		
		if(!empty($this->request->data)){
			
			$this->Agency->saveAgency($this->request->data,$auth['id']);

			//$save
	 		$this->Session->setFlash('Saving Agency information completed');
 		   	$this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'agency',
                     'tab' => 'agency'
                ));
		}
		
		if (!empty($id)) {

			$this->request->data = $this->Agency->findById($id);
		}
		
	}

	public function view($id = null ) {

		$this->loadModel('HumanResource.Agency');

		$auth = $this->Session->read('Auth.User');
		
		
		if (!empty($id)) {

			$agencyData = $this->Agency->findById($id);

		}

		$this->set(compact('agencyData'));

	}

	public function delete($id){

		$this->loadModel('HumanResource.Agency');

		if (!empty($id)) {

			if ($this->Agency->delete($id)) {
                $this->Session->setFlash(
                    __('Agency Successfully deleted.', h($id))
                );
            } else {
                $this->Session->setFlash(
                    __('Agency cannot be deleted.', h($id))
                );
            }

            return $this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'agency',
                     'tab' => 'agency',
                     'plugin' => 'human_resource'

                ));
		}
	}

}