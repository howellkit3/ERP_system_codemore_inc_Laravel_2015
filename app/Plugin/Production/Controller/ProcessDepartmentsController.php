<?php

App::uses('AppController', 'Controller');

class ProcessDepartmentsController extends AppController {

	public function add() {

		if ($this->request->is('post')) {

			if ($this->ProcessDepartment->save($this->request->data)) {

				//$save
	 			$this->Session->setFlash('Saving Process information completed','success');

	 			$this->redirect(array(
	 				'controller' => 'settings',
	 				'action' => 'processes'
	 			));

			} else {

	 			$this->Session->setFlash('There\'s an error saving process,error');

			}


		}
	}

	public function edit($id) {

		if ($this->request->is('put')) {

			if ($this->ProcessDepartment->save($this->request->data)) {

				//$save
	 			$this->Session->setFlash('Saving Process information completed','success');

	 			$this->redirect(array(
	 				'controller' => 'settings',
	 				'action' => 'processes'
	 			));

			} else {

	 			$this->Session->setFlash('There\'s an error saving process,error');

			}


		}

		if  (!empty($id)) {


			$this->request->data = $this->ProcessDepartment->findById($id);

		}
	}

	public function delete($id = null)	 {

		if (!empty($id)) {

			if ($this->ProcessDepartment->delete($id)) {

				//$save
	 			$this->Session->setFlash('Delete Process Succesfully','success');

			} else {
				
				$this->Session->setFlash('There\'s an error deleting data,error');
			}

		}
	}



}
