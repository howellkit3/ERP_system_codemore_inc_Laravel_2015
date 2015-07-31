<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


class AttendancesController  extends HumanResourceAppController {

	var $helpers = array('HumanResource.CustomText','HumanResource.CustomTime');

	public function index() {

		$this->loadModel('HumanResource.WorkSchedule');

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.Workshift');

		$limit = 10;

		$query = $this->request->query;
		
		$search = '';

		$date = date('Y-m-d');

		$date2 = date('Y-m-d', strtotime($date . ' +1 day'));

		if (!empty($query['data']['date'])) {
			$date = $query['data']['date'];
		}
	
		$conditions = array(
			'Attendance.date <=' => $date,
		 	'Attendance.date >=' => $date
		);

		if (!empty($query['data']['name'])) {
			$search = $query['data']['name'];
			$conditions = array_merge($conditions,array(
					'OR' => array(
					'Employee.first_name LIKE' => '%'.$search.'%',
					'Employee.last_name LIKE' => '%'.$search.'%',
					'Employee.middle_name' => '%'.$search.'%',
			)));
		}

		$this->Attendance->bind(array('WorkSchedule','Employee','WorkShift'));

		//$conditions = array();
		$params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Attendance.date ASC',
	    );


		$this->paginate = $params;

		$attendances = $this->paginate();

		$this->set(compact('attendances','date','search'));

	}

	public function timekeep() {

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.Timekeep');

		$limit = 10;

		$query = $this->request->query;


		$search = '';

	 	$date = date('Y-m-d');

		$date2 = date('Y-m-d', strtotime($date . ' +1 day'));


		if (!empty($query['date'])) {

			$date = $query['date'];

		}

		$conditions = array(
			'Attendance.date <=' => $date,
			 'Attendance.date >=' => $date
		);

		$attendance = $this->Attendance->getAll($conditions,array('Employee'));

		$employees = [];

		foreach ($attendance as $key => $people) {

			if ($people['Attendance']['out'] == '00:00:00' || empty($people['Attendance']['out'])) {
				$employees[$people['Employee']['id']] = $people['Employee']['full_name'];
			}
			
		}

		$conditions = array(
			'Timekeep.date <=' => $date,
			 'Timekeep.date >=' => $date
		);

		if (!empty($query['name'])) {
			$search = $query['name'];
			$conditions = array_merge($conditions,array(
				'OR' => array(
					'Employee.first_name LIKE' => '%'.$search.'%',
					'Employee.last_name LIKE' => '%'.$search.'%',
					'Employee.middle_name' => '%'.$search.'%',
			)));
		}

		$params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Timekeep.date ASC',
	    );

		$this->paginate = $params;

		$this->Timekeep->bind(array('Employee'));

		$timekeeps = $this->paginate('Timekeep');

		$this->set(compact('employees','timekeeps','date','search'));
	}

	public function view($id) {

		if (!empty($id)) {

			$date = date('Y-m-d');

			$this->loadModel('HumanResource.Employee');
			$this->loadModel('HumanResource.WorkSchedule');
			$this->loadModel('HumanResource.WorkShift');

			$this->Attendance->bind(array('WorkSchedule','Employee','WorkShift'));

			$attendances = $this->Attendance->find('all', array('conditions' => array('Attendance.id' => $id)));

			$conditions = array();
			$employees = $this->Employee->getList($conditions);


			$this->set(compact('attendances','date','employees'));
		}
		
	}


	public function add() {

		
		$this->loadModel('HumanResource.Timekeep');

		$auth = $this->Session->read('Auth.User');

		if (!empty($this->request->data)) {

			$data = $this->request->data;
			
			$attendance = $this->Attendance->getAttendance($this->request->data);

			if (!empty($attendance)) {
				
				$attendance['Attendance']['modified_by'] = $auth['id'];
			}

			if ($this->Timekeep->saveTime($data,null,$auth['id'])) {

			//update attendance
			if (!empty($attendance)) {
				$this->Attendance->save($attendance);

			}
			
			$this->Session->setFlash('Time in successfully');

			$this->redirect( array(
                         'controller' => 'attendances', 
                         'action' => 'timekeep',
                         'tab' => 'timekeep',
                         'plugin' => 'human_resource'

                    ));	

			} else {

				$this->Session->setFlash('There\'s an error saving data');
			
			}
	}
}

public function ajax_find() {

		$this->layout = false;
		
		$limit = 10;
		
		$query = $this->request->query;
			
		if (!empty($query)) {

			$this->loadModel('HumanResource.WorkSchedule');

			$this->loadModel('HumanResource.Employee');

			$this->loadModel('HumanResource.Workshift');

			
			if (!empty($query['from'])) {
				$date = $query['from'];
			}

			if (!empty($query['to'])) {
				$date2 = $query['to'];
			}


			$conditions = array(
				'Attendance.date >=' => $date,
				'Attendance.date <=' => $date2
			);


		if (!empty($query['employee_id'])) {
			$employee_id = $query['employee_id'];
			$conditions = array_merge($conditions,array(
					'Employee.id ' => $employee_id,

				));
		}


		$this->Attendance->bind(array('WorkSchedule','Employee','WorkShift'));

	//$conditions = array();
		$params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            'fields' => array(
	            	'Attendance.id', 
	            	'Attendance.in',
	            	'Attendance.out',
	            	'Attendance.notes',
	            	'Attendance.date',
	            	'Attendance.employee_id',
	            	'WorkSchedule.id',
	            	'WorkSchedule.model',
	            	'WorkSchedule.foreign_key',
	            	'WorkSchedule.type',
	            	'WorkShift.from',
	            	'WorkShift.to',
	            	'Employee.first_name',
	            	'Employee.last_name',
	            	'Employee.middle_name',
	            	'Employee.code',
	            	'created'),
	            'order' => 'Attendance.date ASC',
	    );


		$this->paginate = $params;

		$attendances = $this->paginate();

		$this->set(compact('attendances','date','search'));

		$this->render('ajax_view');

	}
		//exit();	

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
					$data['WorkShiftBreak'] = $this->Workshift->WorkShiftBreak->saveBreaks($this->request->data['WorkShift'],$this->Workshift->id,$auth['id']);
					
					$this->Session->setFlash('Saving Workshift information successfully');
		 		  	
		 		  	$this->redirect( array(
                             'controller' => 'schedules', 
                             'action' => 'workshifts',
                             'tab' => 'workshifts',
                             'plugin' => 'human_resource'

                        ));	

				} else {

					$this->Session->setFlash('There\'s an error saving Workshift information');
				
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

	public function absences() {

		$limit = 10;

		$this->loadModel('HumanResource.Absence');

		$this->loadModel('HumanResource.Employee');

		$date = date('Y-m-d');

		$search = '';


	 	$date = date('Y-m-d');

	 	$conditions = array();

	 	$query = $this->request->query;

		if (!empty($query['date'])) {

			$date = $query['date'];

			$conditions = array_merge($conditions,array(
				'Absence.from >=' => $date,	
				
			));

		}

		if (!empty($query['name'])) {

			$search = $query['name'];

			$conditions = array_merge($conditions,array(
				'OR' => array(
					'Employee.first_name LIKE' => '%'.$search.'%',
					'Employee.last_name LIKE' => '%'.$search.'%',
					'Employee.middle_name' => '%'.$search.'%',
			)));
		}

		$params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Absence.from ASC',
	    );

		$this->Absence->bind(array('Employee'));

		$this->paginate = $params;

		$absences = $this->paginate('Absence');

		$this->set(compact('absences','date','search'));
		
	}



}