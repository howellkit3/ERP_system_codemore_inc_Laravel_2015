<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


class AttendancesController  extends HumanResourceAppController {

	var $helpers = array('HumanResource.PhpExcel','HumanResource.CustomTime');
	//,'HumanResource.CustomText'
	public function index() {

		$this->loadModel('HumanResource.WorkSchedule');

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.Workshift');

		$this->loadModel('HumanResource.Department');

		$this->loadModel('HumanResource.Overtime');

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

		$this->Attendance->bind(array('WorkSchedule','Employee','WorkShift','Overtime'));

		//$conditions = array();
		$params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Attendance.date ASC',
	    );

		$this->paginate = $params;
		
		$attendances = $this->paginate();
		
		$departmentList = $this->Department->getList();

		$this->set(compact('attendances','date','search','departmentList','employeeList'));

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

				if ($this->request->is('ajax')) {

					if (!empty($attendance['Attendance']['in'])) {

						$attendance['Attendance']['in'] = date('h:i a',strtotime($attendance['Attendance']['in']));
					}

					if (!empty($attendance['Attendance']['out'])) {

						$attendance['Attendance']['out'] = date('h:i a',strtotime($attendance['Attendance']['out']));

						$attendance['Attendance']['duration'] = $this->_getDuration($attendance['Attendance']['in'],$attendance['Attendance']['out']);
					}
					 
					echo json_encode($attendance);

					exit();
				}	
			}

			$this->Session->setFlash('Time in successfully','success');

			$this->redirect( array(
                         'controller' => 'attendances', 
                         'action' => 'timekeep',
                         'tab' => 'timekeep',
                         'plugin' => 'human_resource'

                    ));	

			} else {

				$this->Session->setFlash('There\'s an error saving data','error');
			
			}
	}
}


private function _getDuration($time1 = null,$time2 = null){


		if (!empty($time1) && $time2) {

		$date = date('Y-m-d');
		$date1 = new DateTime($date.' '.$time1);
		$date2 = new DateTime($date.' '.$time2);

		$interval = $date1->diff($date2);

		$difference = '';

			if ($interval->d != 0){

				$days = ($interval->d > 1) ? 'days' : 'day';
				$difference	.= $interval->d  .' '.$days;
			}
			else{
				if ($interval->h != 0){

					$difference .= $interval->h  . ' hours';
				} 
			}

			if ($interval->d == 0 && $interval->invert == 0 && $interval->i != 0) {
				if ($interval->h != 0) {
				  $difference .= ' & ';
				}
				$minutes = ' min';

				if ($interval->i > 1) {
					$minutes = ' mins';
				}
				$difference .= $interval->i  .$minutes;
			}

		return $difference;
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
					
					$this->Session->setFlash('Saving workshift information successfully','success');
		 		  	
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

	public function absences() {

		$limit = 10;

		$this->loadModel('HumanResource.Absence');

		$this->loadModel('HumanResource.Employee');

		$employees = $this->Employee->getList();

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

		$this->set(compact('absences','date','search','employees'));
		
	}



public function getEmployeeData($attendaceId = null,$date = null) {

	$this->layout = false;
	
	if (!empty($attendaceId)) {

		$this->loadModel('HumanResource.WorkSchedule');

		$this->loadModel('HumanResource.Workshift');

		$this->loadModel('HumanResource.Employee');
		
		if (empty($date)){

			$date = date('Y-m-d');
		}

		$conditions = array(
		'Attendance.date <=' => $date,
		 'Attendance.date >=' => $date,
		 'Attendance.id' => $attendaceId,
		);

		$this->Attendance->bind(array('Employee','WorkSchedule','WorkShift'));

		$attendance = $this->Attendance->find('first',array(
			'conditions' => $conditions
		));

		$this->set(compact('attendance'));

		$this->render('Attendances/ajax/timekeep');
	}

}




public function daily_info() {

	$this->loadModel('HumanResource.DailyInfo');

	$this->loadModel('HumanResource.Employee');

	$this->loadModel('HumanResource.Attendance');

	$search = '';

	$date = date('Y-m-d');

	$limit = 10;

	$query = $this->request->query;
		
	$search = '';

	$this->DailyInfo->bind(array('Employee'));
	//$conditions = array('DailyInfo.date >=' => $date , 'DailyInfo.date <=' => $date);
	if (!empty($query['data']['date'])) {
			$date = $query['data']['date'];
	}
	
	$conditions = array(
		'DailyInfo.date <=' => $date,
	 	'DailyInfo.date >=' => $date
	);

	if (!empty($query['data']['name'])) {
			$search = $query['data']['name'];
			$conditions = array_merge($conditions,array(
					'OR' => array(
					'Employee.first_name LIKE' => '%'.$search.'%',
					'Employee.last_name LIKE' => '%'.$search.'%',
					'Employee.middle_name' => '%'.$search.'%',
					'Employee.code' => $search
			)));
	}

	$params =  array(
            'conditions' => $conditions,
            'limit' => $limit,
            //'fields' => array('id', 'status','created'),
            'order' => 'DailyInfo.date ASC',
            'group' => 'DailyInfo.id'
    );

	$this->paginate = $params;
	
	$dailyInfos = $this->paginate('DailyInfo');

	//pr($dailyInfos); exit();

	$this->set(compact('dailyInfos','search','date'));

}
	public function export() {

		$this->loadModel('HumanResource.WorkSchedule');

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.Workshift');

		$this->loadModel('HumanResource.Department');

		$departmentList = $this->Department->find('list',array('fields' => array('id','name')));
		
		$departmentId = $this->request->data['Attendance']['department_id'];
		//$employeeId = $this->request->data['Attendance']['employee_id'];
		$fromDate = $this->request->data['Attendance']['from_date'];

		$this->Attendance->bind(array('WorkSchedule','Employee','WorkShift'));

		$conditions = array();

    	if(!empty($departmentId)){

    		$conditions = array_merge($conditions,array('Employee.department_id' => $departmentId));

    	}

    	// if(!empty($employeeId)){

    	// 	$conditions = array_merge($conditions,array('Attendance.employee_id' => $employeeId));

    	// }

    	if(!empty($fromDate)){

    		$conditions = array_merge($conditions,array('Attendance.date' => $fromDate.' '.'00:00:00'));

    	}
        	
        $attendanceData = $this->Attendance->find('all', array(
            'conditions' => $conditions,
            'order' => 'Attendance.id ASC'
        ));
        
		$this->set(compact('attendanceData','departmentList','departmentId'));

		$this->render('Attendances/xls/attendance_report');
	}

	public function getAllAttendance() {

		$this->layout = false;

		if ($this->request->is('ajax')) {

			$query = $this->request->query;

			if (!empty($query['range']) && !empty($query['empdId'])) {

				$conditions = array('Attendance.employee_id' => $query['empdId']);

				$days = explode(':', $query['range']);

				$date = explode('-', $query['month']);

				$start = $date[1].'-'.$date[0].'-'.sprintf("%02d", $days[0]);

				$end = $date[1].'-'.$date[0].'-'.sprintf("%02d", $days[1]);

				$conditions = array_merge($conditions,array(
					'Attendance.date >=' => $start,
					'Attendance.date <=' => $end
				));
			}

			$attendance = $this->Attendance->find('all',array('conditions' => $conditions));
			
			
		}

		$this->set(compact('attendance'));

		$this->render('Attendances/ajax/days_work');

	}

	public function leaves(){

		$this->loadModel('HumanResource.Leave');

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.LeaveType');

		$employees = $this->Employee->getList();

		$leaveType = $this->LeaveType->find('list',array('fields' => array('id','name')));

		$this->Leave->bind(array('Employee','LeaveType'));
		$limit = 10;

		$conditions = array();

		$params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id','overtime_id'),
	            'order' => 'Leave.from ASC',
	        );

		$this->paginate = $params;

	    $leaveData = $this->paginate('Leave');
	    
	    $this->set(compact('leaveData','employees','leaveType'));

	}

	public function export_dailyinfo(){

		$this->loadModel('HumanResource.DailyInfo');

		$this->loadModel('HumanResource.Employee');
		
		$fromDate = $this->request->data['Attendance']['from_date'];

		$this->DailyInfo->bind(array('Employee'));

		$conditions = array();

    	if(!empty($fromDate)){

    		$conditions = array_merge($conditions,array('DailyInfo.date' => $fromDate.' '.'00:00:00'));

    	}
        	
        $dailyinfoData = $this->DailyInfo->find('all', array(
            'conditions' => $conditions,
            'order' => 'DailyInfo.id ASC'
        ));
        
		$this->set(compact('dailyinfoData'));

		$this->render('Attendances/xls/dailyinfo_report');

	}

}