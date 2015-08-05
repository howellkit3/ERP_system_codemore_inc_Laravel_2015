<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


class WorkShiftsController  extends HumanResourceAppController {

	var $helpers = array('HumanResource.CustomText','HumanResource.Country','HumanResource.BreakTime');

	public function add() {


		$this->loadModel('HumanResource.BreakTime');
		
		$auth = $this->Session->read('Auth.User');

		if ($this->request->is('post')) {

				$this->loadModel('HumanResource.Workshift');

				$this->loadModel('HumanResource.WorkShiftBreak');

				$this->Workshift->create();

				$this->request->data['WorkShift']['created_by'] =
				$this->request->data['WorkShift']['modified_by'] = $auth['id'];


				if ($this->Workshift->save($this->request->data['WorkShift'])) {

					$this->Workshift->bind(array('WorkShiftBreak'));
					//save BreakTime
					$data['WorkShiftBreak'] = $this->Workshift->WorkShiftBreak->saveBreaks($this->request->data,$this->Workshift->id,$auth['id']);
					
					$this->Session->setFlash('Saving Workshift information successfully','success');
		 		  	
		 		  	$this->redirect( array(
                             'controller' => 'schedules', 
                             'action' => 'workshifts',
                             'tab' => 'workshifts',
                             'plugin' => 'human_resource'

                        ));	

				} else {

					$this->Session->setFlash('There\'s an error saving Workshift information','error');
				
				}
		}


		$breaktimes = $this->BreakTime->find('all',array(
				'order' => 'BreakTime.from DESC',
				'limit' => 10

		));

		$this->set(compact('breaktimes'));
	}

public function edit($id = null) {


		$this->loadModel('HumanResource.BreakTime');

		$this->loadModel('HumanResource.Workshift');
		
		$this->loadModel('HumanResource.WorkShiftBreak');
		
		$auth = $this->Session->read('Auth.User');

		if (!empty($this->request->data)) {

				$this->Workshift->create();

				$this->request->data['WorkShift']['created_by'] =
				$this->request->data['WorkShift']['modified_by'] = $auth['id'];

				if ($this->Workshift->save($this->request->data['WorkShift'])) {

					$this->Workshift->bind(array('WorkShiftBreak'));
					//save BreakTime
					$data['WorkShiftBreak'] = $this->Workshift->WorkShiftBreak->saveBreaks($this->request->data,$this->Workshift->id,$auth['id']);
					
					$this->Session->setFlash('Saving Workshift information successfully','success');
		 		  	
		 		  	$this->redirect( array(
                             'controller' => 'schedules', 
                             'action' => 'workshifts',
                             'tab' => 'workshifts',
                             'plugin' => 'human_resource'

                        ));	

				} else {

					$this->Session->setFlash('There\'s an error saving Workshift information','error');
				
				}
		}

		if (!empty($id)) {

			$this->WorkShift->bind(array('WorkShiftBreak'));

			$this->request->data = $this->WorkShift->findById($id);

			$breaks = Set::classicExtract($this->request->data['WorkShiftBreak'], '{n}.breaktime_id');

			//pr($this->request->data); exit();
		}


		$breaktimes = $this->BreakTime->find('all',array(
				'order' => 'BreakTime.from DESC',
				'limit' => 10

		));

		$this->set(compact('breaktimes','breaks'));
	}


public function delete($id = null) {


		$this->loadModel('HumanResource.Workshift');

		if (!empty($id)) {

			if ($this->Workshift->delete($id)) {
                $this->Session->setFlash(
                    __('Successfully deleted.', h($id))
                );
            } else {
                $this->Session->setFlash(
                    __('WorkShift cannot be deleted.', h($id))
                );
            }

            return  $this->redirect( array(
                             'controller' => 'schedules', 
                             'action' => 'workshifts',
                             'tab' => 'workshifts',
                             'plugin' => 'human_resource'

                        ));
		}
 
}


}