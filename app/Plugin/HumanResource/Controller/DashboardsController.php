<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');
App::import('Vendor', 'DOMPDF', true, array(), 'dompdf'.DS.'dompdf_config.inc.php', false);


class DashboardsController  extends HumanResourceAppController {

	var $uses = array('HumanResource.Attendance','HumanResource.WorkSchedule','HumanResource.Absence');

	public function index() {

			$this->loadModel('HumanResource.WorkSchedule');

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.Workshift');
		
		$date = date('Y-m-d');

		$conditions = array(
			'Attendance.date <=' => $date,
		 	'Attendance.date >=' => $date
		);

		$this->Attendance->bind(array('WorkSchedule','Employee','WorkShift'));

		$attendances = $this->Attendance->find('all',array('conditions' => $conditions ,'limit' => 5));

	
		$conditions = array(
			'Absence.from >=' => $date,	
		);

		$absences = $this->Absence->find('all',array('conditions' => $conditions ,'limit' => 5));
	
		$this->set(compact('attendances','absences'));
	}

}