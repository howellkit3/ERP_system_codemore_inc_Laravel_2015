<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


class AbsencesController  extends HumanResourceAppController {

	var $helpers = array('HumanResource.CustomText','HumanResource.CustomTime');

	public function add() {


		$auth = $this->Session->read('Auth.User');

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.Type');

		$typeList = $this->Type->find('list',array('fields' => array('id','name')));

		$date = date('Y-m-d');
		$search = '';

		if ($this->request->is('post')) {

			$data = $this->Absence->formatData($this->request->data,$auth['id']);

			if ($this->Absence->save($data)) {

			$this->Session->setFlash('Absence save successfully');

			$this->redirect(array(
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



		$this->set(compact('date','search','employees','typeList'));
	}

	public function edit($id = null) {

		$auth = $this->Session->read('Auth.User');

		$this->loadModel('HumanResource.Employee');

		$date = date('Y-m-d');
		$search = '';


		if (!empty($id)) {


			if ($this->request->is('put')) {

				$data = $this->Absence->formatData($this->request->data,$auth['id']);

				if ($this->Absence->save($data)) {

				$this->Session->setFlash('Absence save successfully');

					$this->redirect(array(
		                         'controller' => 'attendances', 
		                         'action' => 'absences',
		                         'tab' => 'absences',
		                         'plugin' => 'human_resource'

		                    ));	

			
					return $this->redirect( array(
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

			$this->request->data = $this->Absence->findById($id);


		} else {

			$this->Session->setFlash('Invalid ID');

			return $this->redirect( array(
                         'controller' => 'attendances', 
                         'action' => 'absences',
                         'tab' => 'absences',
                         'plugin' => 'human_resource'

                    ));	
		}

		$this->set(compact('date','search','employees'));
	}

	public function computeTime(){
			
			$this->layout = false;
			
			if (!empty($this->request->query)) {
			
			$date1 = new DateTime($this->request->query('from'));
			$date2 = new DateTime($this->request->query('to'));

			$interval = $date1->diff($date2);

			json_encode($interval);

			// $difference = '';

			// 	if ($interval->d != 0){
			// 		$days = ($interval->d > 1) ? 'days' : 'day';
			// 		$difference	.= $interval->d  .' '.$days;
			// 	}
			// 	else{
			// 		if ($interval->h != 0){
			// 			$difference .= $interval->h  . ' hours';
			// 		} 
			// 	}

			// 	if ($interval->d == 0 && $interval->invert == 0 && $interval->i != 0) {
			// 		if ($interval->h != 0) {
			// 		  $difference .= ' & ';
			// 		}
			// 		$minutes = ' min';

			// 		if ($interval->i > 1) {
			// 			$minutes = ' mins';
			// 		}
			// 		$difference .= $interval->i  .$minutes;
			// 	}
		}
		exit();		
	}

}