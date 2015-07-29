<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


class SettingsController  extends HumanResourceAppController {


	var $helpers = array('HumanResource.CustomText','HumanResource.Country');

	public function index() {

		$this->loadModel('HumanResource.Department');

		$this->loadModel('HumanResource.Position');

		$positionData = $this->Position->find('all',array('order' =>array('Position.id DESC')));

		$limit = 10;

        $conditions = array();

        $this->paginate = array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Department.id DESC',
	        );

	    $departmentData = $this->paginate('Department');

		$this->set(compact('departmentData','positionData'));

	}

	public function department() {

		$this->loadModel('HumanResource.Department');

		$auth = $this->Session->read('Auth.User');

		if(!empty($this->request->data)){
			
			$this->Department->saveDepartment($this->request->data,$auth['id']);

			//$save
	 		$this->Session->setFlash('Saving department information completed');
 		   	$this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'index'
                ));
		}

	}

	public function edit_department($departmentid = null) {

		$this->loadModel('HumanResource.Department');

		$auth = $this->Session->read('Auth.User');
		
		if(!empty($this->request->data)){
			
			$this->Department->saveDepartment($this->request->data,$auth['id']);

			//$save
	 		$this->Session->setFlash('Saving department information completed');
 		   	$this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'index'
                ));
		}
		
		if (!empty($departmentid)) {

			$this->request->data = $this->Department->findById($departmentid);

		}

	}

	public function view_department($departmentid = null) {

		$this->loadModel('HumanResource.Department');

		$auth = $this->Session->read('Auth.User');
		
		
		if (!empty($departmentid)) {

			$departmentData = $this->Department->findById($departmentid);

		}

		$this->set(compact('departmentData'));

	}

	public function delete_department($deptId){

		$this->loadModel('HumanResource.Department');

		if (!empty($deptId)) {

			if ($this->Department->delete($deptId)) {
                $this->Session->setFlash(
                    __('Department Successfully deleted.', h($deptId))
                );
            } else {
                $this->Session->setFlash(
                    __('Department cannot be deleted.', h($deptId))
                );
            }

            return $this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'index',
                     // 'tab' => 'work_schedules',
                     'plugin' => 'human_resource'

                ));
		}
	}

	public function position() {

		$this->loadModel('HumanResource.Position');

		$auth = $this->Session->read('Auth.User');

		if(!empty($this->request->data)){
			
			$this->Position->savePosition($this->request->data,$auth['id']);

			//$save
	 		$this->Session->setFlash('Saving Position information completed');
 		   	$this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'index',
                     'tab' => 'position'
                ));
		}

	}

	public function view_position($positionid = null) {

		$this->loadModel('HumanResource.Position');

		$auth = $this->Session->read('Auth.User');
		
		
		if (!empty($positionid)) {

			$positionData = $this->Position->findById($positionid);

		}

		$this->set(compact('positionData'));

	}

	public function edit_position($positionid = null) {

		$this->loadModel('HumanResource.Position');

		$auth = $this->Session->read('Auth.User');
		
		if(!empty($this->request->data)){
			
			$this->Position->savePosition($this->request->data,$auth['id']);

			//$save
	 		$this->Session->setFlash('Saving Position information completed');
 		   	$this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'index',
                     'tab' => 'position'
                ));
		}
		
		if (!empty($positionid)) {

			$this->request->data = $this->Position->findById($positionid);

		}

	}

	public function delete_position($posId){

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
                     'action' => 'index',
                     'tab' => 'position',
                     'plugin' => 'human_resource'

                ));
		}
	}
}