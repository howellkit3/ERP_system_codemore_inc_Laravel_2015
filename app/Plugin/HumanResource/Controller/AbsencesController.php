<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


class AbsencesController  extends HumanResourceAppController {

	var $helpers = array('HumanResource.CustomText','HumanResource.CustomTime');

	public function add() {


		$auth = $this->Session->read('Auth.User');

		$this->loadModel('HumanResource.Employee');

		$date = date('Y-m-d');
		$search = '';

		if ($this->request->is('post')) {

			$data = $this->Absence->formatData($this->request->data,$auth['id']);


			if ($this->Absence->save($data)) {

			$this->Session->setFlash('Absence save successfully');

			$this->redirect( array(
                         'controller' => 'attendances', 
                         'action' => 'absences',
                         'tab' => 'absences',
                         'plugin' => 'human_resource'

                    ));	

			} else {

				$this->Session->setFlash('There\'s an error saving data');
			
			}
		}


		$conditions = array();
		$employees = $this->Employee->getList($conditions);



		$this->set(compact('date','search','employees'));
	}

}