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

		$this->set(compact('tools'));


	}

	public function view($id){

		$this->Tooling->bind(array('Employee','Tool'));

		$auth = $this->Session->read('Auth.User');
		
		
		if (!empty($id)) {

			$toolingData = $this->Tooling->findById($id);

		}
		
		$this->set(compact('toolingData'));
	}
	
	public function edit($id = null) {

		$this->loadModel('HumanResource.Tooling');

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.Tool');

		$toolList = $this->Tool->find('list',array('fields' => array('id','name')));

		$employee = $this->Employee->find('list',array('fields' => array('id','fullname')));

		$auth = $this->Session->read('Auth.User');
		
		if(!empty($this->request->data)){
			
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
		
		if (!empty($id)) {

			$this->request->data = $this->Tooling->findById($id);

			$tools = $this->request->data;
			$this->set(compact('tools','employee','toolList'));

		}

	}

}