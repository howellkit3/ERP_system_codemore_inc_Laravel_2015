<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


App::uses('ImageUploader', 'Vendor');

class PositionsController  extends HumanResourceAppController {


	public function add() {

		$this->loadModel('HumanResource.Position');

		$auth = $this->Session->read('Auth.User');

		if(!empty($this->request->data)){
			
			$this->Position->savePosition($this->request->data,$auth['id']);

			//$save
	 		$this->Session->setFlash('Saving Position information completed','success');
 		   	$this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'position',
                     'tab' => 'position'
                ));
		}

	}

	public function edit($id = null) {

		$this->loadModel('HumanResource.Position');

		$auth = $this->Session->read('Auth.User');
		
		if(!empty($this->request->data)){
			
			$this->Position->savePosition($this->request->data,$auth['id']);

			//$save
	 		$this->Session->setFlash('Saving Position information completed','success');
 		   	$this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'position',
                     'tab' => 'position'
                ));
		}
		
		if (!empty($id)) {

			$this->request->data = $this->Position->findById($id);

		}

	}

	public function view($id = null ) {

		$this->loadModel('HumanResource.Position');

		$auth = $this->Session->read('Auth.User');
		
		
		if (!empty($id)) {

			$positionData = $this->Position->findById($id);

		}

		$this->set(compact('positionData'));

	}

	public function delete($posId){

		$this->loadModel('HumanResource.Position');

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
                     'action' => 'position',
                     'tab' => 'position',
                     'plugin' => 'human_resource'

                ));
		}
	}

}