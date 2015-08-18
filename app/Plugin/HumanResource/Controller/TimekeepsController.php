<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


class TimekeepsController  extends HumanResourceAppController {


	var $helpers = array('HumanResource.CustomText','HumanResource.Country');

	public function delete($id = null) {

			if (!empty($id)) {

				if ($this->Timekeep->delete($id)) {
	                $this->Session->setFlash(
	                    __('Successfully deleted.', h($id))
	                );
	            } else {
	                $this->Session->setFlash(
	                    __('WorkShift cannot be deleted.', h($id))
	                );
	            }

	            return  $this->redirect( array(
	                             'controller' => 'attendances', 
	                             'action' => 'timekeep',
	                             'tab' => 'timekeep',
	                             'plugin' => 'human_resource'

	                        ));
			}
	 
	}

	public function findExisting($employee_id = null,$date = null) {

		$this->autoRender = false;

		if (!empty($employee_id)) {

			$date = date('Y-m-d');

			$date2 = date('Y-m-d', strtotime($date . ' +1 day'));

			$conditions = array(
			'Timekeep.date <=' => $date,
			 'Timekeep.date >=' => $date,
			 'Timekeep.employee_id' => $employee_id,
			);

			$timekeep = $this->Timekeep->find('first',array(
				'conditions' => $conditions

			));

			if (!empty($timekeep)) {

				return  json_encode($timekeep['Timekeep']);	
			}

			
			return json_encode($timekeep);	

		}
	}

	public function export() {

		$this->loadModel('HumanResource.Timekeep');

		$this->loadModel('HumanResource.Employee');

		$date = $this->request->data['TimeKeep']['from_date'];

		$this->Timekeep->bind(array('Employee'));

		$conditions = array();

    	if(!empty($date)){

    		$conditions = array_merge($conditions,array('TimeKeep.date' => $date.' '.'00:00:00'));

    	}
        	
        $timeKeepData = $this->Timekeep->find('all', array(
            'conditions' => $conditions,
            'order' => 'Timekeep.id ASC'
        ));
        
		$this->set(compact('timeKeepData'));

		$this->render('Timekeeps/xls/timekeep_report');
	}
	
}
