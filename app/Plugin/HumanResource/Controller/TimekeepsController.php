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
	exit();

}

public function getEmployeeData($employee_id = null, $data = null) {

	$this->layout = false;
	
	if (!empty($employee_id)) {

		$date = date('Y-m-d');

		$conditions = array(
		'Timekeep.date <=' => $date,
		 'Timekeep.date >=' => $date,
		 'Timekeep.employee_id' => $employee_id,
		);

		$this->bind(array('Employee'));

		$timekeep = $this->Timekeep->find('first',array(
			'conditions' => $conditions

		));

		$this->set(compact('timekeep'));

		$this->render('ajax/ajax_view');
	}	
}



}