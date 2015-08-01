<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


class ToolingsController  extends HumanResourceAppController {

	var $helpers = array('HumanResource.CustomText','HumanResource.Country');

	public function assign() {

		$this->loadModel('HumanResource.Tool');

		if ($this->request->is('post')) {

			$this->Tooling->create();

			if ($this->Tooling->save($this->request->data)) {

				$this->Session->setFlash(__('Assign tool successfully'),success);
					//$this->Session->setFlash('Saving employee information successfully');
		 		   $this->redirect( array(
	                         'controller' => 'employees', 
	                         'action' => 'index',
	                         'plugin' => 'human_resource',
	                         'tab' => 'tab-tooling'
	                    ));

			} else {

				$this->session->setFlash(__('There\'s an error saving tools'),error);
			}
		}

		$tools = $this->Tool->find('all');

		$this->set(compact($tools));


	}
	


}