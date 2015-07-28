<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


class WorkSchedulesController  extends HumanResourceAppController {

	var $helpers = array('HumanResource.CustomText','HumanResource.Country','HumanResource.BreakTime');

	public function add() {


		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.Workshift');

		$conditions = array();

		$employees = $this->Employee->getList($conditions);

		$conditions = array();
		$workshifts = $this->Workshift->getList($conditions);



		if ($this->request->is('post')) {


			if ($this->WorkSchedule->save($this->request->data['WorkSchedule'])) {

				$this->Session->setFlash('Work Schedule saved successfully');
		 		   $this->redirect( array(
                             'controller' => 'schedules', 
                             'action' => 'work_schedules',
                             'tab'	=> 'work_schedules'
                        ));
			} else  {

				$this->Session->setFlash('There\'s an error saving Schedule');

			}
			
		}

		$this->set(compact('employees','workshifts'));
	}

	public function edit($id = null) {


		if (!empty($id)) {

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.Workshift');


			if ($this->request->is('put')) {


				if ($this->WorkSchedule->save($this->request->data['WorkSchedule'])) {

					$this->Session->setFlash('Work Schedule saved successfully');
			 		   $this->redirect( array(
	                             'controller' => 'schedules', 
	                             'action' => 'work_schedules',
	                             'tab'	=> 'work_schedules'
	                        ));
				} else  {

					$this->Session->setFlash('There\'s an error saving Schedule');

				}



			}


		$conditions = array();
		$employees = $this->Employee->getList($conditions);

		$conditions = array();
		$workshifts = $this->Workshift->getList($conditions);
		
		$this->request->data = $this->WorkSchedule->findById($id);

		$this->set(compact('employees','workshifts'));

		} else {

			$this->redirect( array(
                             'controller' => 'schedules', 
                             'action' => 'work_schedules',
                             'tab'	=> 'work_schedules'
                        ));
		}
	}

	public function delete($id = null) {


		if (!empty($id)) {

			if ($this->WorkSchedule->delete($id)) {
                $this->Session->setFlash(
                    __('Successfully deleted.', h($id))
                );
            } else {
                $this->Session->setFlash(
                    __('WorkShift cannot be deleted.', h($id))
                );
            }

            return $this->redirect( array(
                             'controller' => 'schedules', 
                             'action' => 'work_schedules',
                             'tab' => 'work_schedules',
                             'plugin' => 'human_resource'

                        ));
		}
 
}

}