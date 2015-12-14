<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');
App::import('Vendor', 'DOMPDF', true, array(), 'dompdf'.DS.'dompdf_config.inc.php', false);


class DashboardsController  extends HumanResourceAppController {

	var $uses = array('HumanResource.Attendance','HumanResource.WorkSchedule','HumanResource.Absence');

	public function index() {

		$this->loadModel('HumanResource.WorkSchedule');

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.WorkShift');

		$this->loadModel('HumanResource.Holiday');
		
		$date = date('Y-m-d');

		$conditions = 	array('date(Attendance.date) BETWEEN ? AND ?' => array($date,$date));

		$this->Attendance->bind(array('WorkSchedule','Employee','WorkShift'));

		$attendances = $this->Attendance->find('all',array('conditions' => $conditions ,'limit' => 5, 'order' => array('Attendance.date DESC')));


		$this->Absence->bind(array('Employee'));
		
		$conditions = array();

		$absences = $this->Absence->find('all',array('conditions' => $conditions ,'limit' => 5,'order' => array('Absence.from DESC') ));

		$conditions = array('Holiday.start_date >=' => date('Y-m-d'));

		$holidays = $this->Holiday->find('all',array('conditions' => $conditions,'limit' => 5 ,'order' => array('Holiday.start_date ASC')));
		
		// pr($holidays);
		// exit();

		$conditions = array('Employee.status NOT' => 3 );

		if (!empty($departmentId)) {

			$conditions = array_merge($conditions,array(
					'Employee.department_id' => $departmentId
			));
		}

		$employees = $this->Employee->find('all',array(
			'conditions' => $conditions,
			'order' => array('Employee.last_name ASC'),
			'fields' => array('id','code','full_name','date_hired','status','contract_id'),
			'limit' => 10,
			));


		//check employee contract
		$contracts = $this->Employee->checkContract($employees);

		$this->set(compact('attendances','absences','holidays','employees','contracts'));
	}

}