<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


App::uses('ImageUploader', 'Vendor');

class DepartmentsController  extends HumanResourceAppController {


	public function add() {

		$this->loadModel('HumanResource.Department');

		$auth = $this->Session->read('Auth.User');

		if(!empty($this->request->data)){
			
			$this->Department->saveDepartment($this->request->data,$auth['id']);
			//$save
	 		$this->Session->setFlash('Saving department information completed','success');
 		   	$this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'department'
                ));
		}

	}

	public function edit($id = null) {

		$this->loadModel('HumanResource.Department');

		$auth = $this->Session->read('Auth.User');
		
		if(!empty($this->request->data)){
			
			$this->Department->saveDepartment($this->request->data,$auth['id']);

			//$save
	 		$this->Session->setFlash('Saving department information completed','success');
 		   	$this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'department'
                ));
		}
		
		if (!empty($id)) {

			$this->request->data = $this->Department->findById($id);

		}

	}

	public function view($id = null ) {

		$this->loadModel('HumanResource.Department');

		$auth = $this->Session->read('Auth.User');
		
		
		if (!empty($id)) {

			$departmentData = $this->Department->findById($id);

		}

		$this->set(compact('departmentData'));

	}

	public function delete($deptId){

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
                     'action' => 'department',
                     // 'tab' => 'work_schedules',
                     'plugin' => 'human_resource'

                ));
		}
	}

	public function search() {

			$query = $this->request->query;

			$conditions = array();

			if (!empty($query['department'])) {

				$conditions = array('OR' => array(
							'Department.name LIKE' => '%'. $query['department'] . '%'
				));

			}

			$departmentData = $this->Department->find('all',array(
				'conditions' => $conditions,
				'order' => 'Department.name',
				'group' => 'Department.id'
			));

			$this->set(compact('departmentData'));

			if ($this->request->is('ajax')) {

				$this->render('Departments/ajax/search');
			}
	}

}