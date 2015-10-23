<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


class AttendancesController  extends HumanResourceAppController {

	var $helpers = array('HumanResource.PhpExcel','HumanResource.CustomTime');

	function beforeFilter() {
		parent::beforeFilter();
  		$this->Auth->allow('check_attendance');
 	}

	//,'HumanResource.CustomText'
	public function index() {

		//Configure::write('debug',2);

		$this->loadModel('HumanResource.WorkSchedule');

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.Workshift');

		$this->loadModel('HumanResource.WorkshiftBreak');

		$this->loadModel('HumanResource.Breaktime');

		$this->loadModel('HumanResource.Department');

		$this->loadModel('HumanResource.Overtime');

		$limit = 10;

		$query = $this->request->query;
		
		$search = '';

		$date = date('Y-m-d');

		$date2 = date('Y-m-d', strtotime($date . ' +1 day'));
		
		$conditions =array('date(Attendance.date) BETWEEN ? AND ?' => array($date,$date2));
		
		$conditions = array();

		if (!empty($query['data'])) {

			$conditions = array();
		}

		$dateSelected = '';

		if (!empty($query['data']['date'])) {

			//$fromDate =
			$dateSelected = $query['data']['date'];

			$date = explode('-', $query['data']['date']); 

			$date1 = date('Y-m-d',strtotime($date[0]));

			$date2 = date('Y-m-d',strtotime($date[1]));

			$conditions = array_merge($conditions,array(
  						'date(Attendance.date) BETWEEN ? AND ?' => array($date1,$date2), 
  			));

			$date = $query['data']['date'];
		}
	
		// $conditions = array(
		// 	'Attendance.date <=' => $date,
		//  	'Attendance.date >=' => $date
		// );

		$empId = '';

		if (!empty($query['employee_id'])) {

			$empId =$query['employee_id'];
			
			$conditions = array_merge($conditions,array(
					'Attendance.employee_id' => $empId
			));


		}

		if (!empty($query['data']['name'])) {

			$search = $query['data']['name'];
			
			$conditions = array_merge($conditions,array(
					'OR' => array(
					'Employee.first_name LIKE' => '%'.$search.'%',
					'Employee.last_name LIKE' => '%'.$search.'%',
					'Employee.middle_name' => '%'.$search.'%',
			)));
		}



		$this->Attendance->bind(array('Employee','Overtime','MySchedule','MyWorkshift','MyWorkShiftBreak','MyBreakTime'));

		//$this->Employee->virtualFields['totalItem'] = 'COUNT(`OrderDetail`.`order_id`)';
		//$conditions = array();

		$params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            'fields' => array(
	            	'id',
	            	'status',
	            	'created',
	            	'Employee.first_name',
	            	'Employee.last_name',
	            	'Employee.middle_name',
	            	'Employee.code',
	            	'Attendance.in',
	            	'Attendance.out',
	            	'Attendance.type',
	            	'Attendance.schedule_id',
	            	'Attendance.notes',
	            	'Attendance.date',
					'Attendance.overtime_id',
	            	'MySchedule.day',
	            	'MyWorkshift.from',
	            	'MyWorkshift.to',
	            	//'MyWorkshift.overtime_id',
	            	'MyWorkShiftBreak.breaktime_id',
	            	// /'MyWorkshift.ovetime_id',
	            	'MyBreakTime.from',
	            	'MyBreakTime.to',
	            	'Overtime.from',
	            	'Overtime.to',
	            	'Overtime.employee_ids',
	            	'Overtime.status'
					),
	           'group' => array('Attendance.date'),
	            'order' => 'Attendance.date ASC',
	    );

		$this->paginate = $params;
		
		$attendances = $this->paginate();


		if (!empty($_GET['test'])) {

			
			pr(	$attendances );

			exit();

		}
		
		
		$conditions = array();
		
		$departmentList =  $this->Department->find('list',array(
			'conditions' => $conditions,
			'fields' => array('id','department_position'),
			'group' => array('Department.id')
		));
		
		$conditions = array();

		$employeeList = $this->Employee->getList($conditions);


		$this->set(compact('attendances','date','empId','search','departmentList','employeeList','dateSelected','empId'));

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
			//'Attendance.date <=' => $date,
			 'Attendance.date >=' => $date
		);

		$attendance = $this->Attendance->getAll($conditions,array('Employee'));

		$employees = array();

		foreach ($attendance as $key => $people) {

			if ($people['Attendance']['out'] == '00:00:00' || empty($people['Attendance']['out'])) {
				$employees[$people['Employee']['id']] = $people['Employee']['full_name'];
			}
			
		}
		// pr($employees);
		// pr($conditions); exit();

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


	public function add($timekeep = false) {
	
		$this->loadModel('HumanResource.Timekeep');

		$this->loadModel('HumanResource.DailyInfo');

		$this->loadModel('HumanResource.WorkSchedule');

		$this->loadModel('HumanResource.Workshift');

		$this->loadModel('HumanResource.WorkShiftBreak');

		$this->loadModel('HumanResource.BreakTime');

		$this->loadModel('HumanResource.OvertimeLimit');

		$this->loadModel('HumanResource.OvertimeExcess');

		$this->loadModel('HumanResource.Overtime');

		$this->loadModel('HumanResource.Employee');

		$auth = $this->Session->read('Auth.User');

		if (!empty($this->request->data)) {

			$data = $this->request->data;

			// $this->Attendance->bind(array('Overtime'));	
			
			// $attendance = $this->Attendance->getAttendance($this->request->data);

			// if (!empty($attendance)) {
				
			// 	$attendance['Attendance']['modified_by'] = $auth['id'];
			// }

			$this->LoadModel('HumanResource.Holiday');	

			$this->LoadModel('HumanResource.WorkSchedule');		

			if (!empty($data['Attendance']['time'])) {

				$dateSplit = explode(' ', $data['Attendance']['time']);	
			}
			if (!empty($data['Attendance']['time_in'])) {

				$dateSplit = explode(' ', $data['Attendance']['time_in']);	
			}
			if (!empty($data['Attendance']['time_out'])) {

				$dateSplit = explode(' ', $data['Attendance']['time_out']);	
			}



			$WorkSchedule = $this->WorkSchedule->find('first',array(
					'conditions' => array(
					'WorkSchedule.model' => 'Employee',
					'WorkSchedule.foreign_key'=> $data['Attendance']['employee_id'],
					'WorkSchedule.day' => $dateSplit[0]
				)
			));

			/* if (empty($WorkSchedule['WorkSchedule']['id'])) {

				//rediect  
				$this->Session->setFlash('You dont have schedule for today','error');

				$this->redirect( array(
                         'controller' => 'attendances', 
                         'action' => 'index',
                         'tab' => 'attendance',
                         'plugin' => 'human_resource'
				));
			} */


		
			if ($this->Timekeep->saveTime($data,null,$auth['id'])) {

			//create attendance
			$attendance = $this->Attendance->createAttendance($data,$WorkSchedule);	

			//update attendance
			if (!empty($attendance)) {

				$rawAttendance = $attendance;

				$this->Attendance->save($attendance);

				if ($this->request->is('ajax')) {


					if (!empty($attendance['Attendance']['in'])) {

						$attendance['Attendance']['in'] = date('H:i a',strtotime($attendance['Attendance']['in']));
					}

					if (!empty($attendance['Attendance']['out'])) {

						$attendance['Attendance']['out'] = date('H:i a',strtotime($attendance['Attendance']['out']));

						$attendance['Attendance']['duration'] = $this->_getDuration($rawAttendance['Attendance']['in'],$rawAttendance['Attendance']['out']);
					
					}

					echo json_encode($attendance);
					exit();
				}

				if (!empty($attendance['Attendance']['out'])) {

						//update daily info
						$this->Attendance->bindWorkshift();

						
						if (!empty($data['Attendance']['id'])) {
							$callAttendance = $this->Attendance->findById($data['Attendance']['id']);

						}
						

						//$this->DailyInfo->updateDailyInfo($attendance,$attendance['Attendance']['employee_id'],$attendance['Attendance']['date']);	

						if (!empty($attendance['Attendance']['overtime_id'])) {
							
							//check if its overtime
							$overtime = $this->OvertimeLimit->checkIfConsumed($attendance);

							$limit = '';

							if (!empty($overtime['OvertimeLimit']['id'])) {

								$limit = $this->OvertimeExcess->saveExcess($overtime,$attendance,$auth);
							}

						}

				}

			}

			$this->Session->setFlash('Time in successfully','success');

			if (!empty($timekeep)) {

			$this->redirect( array(
                         'controller' => 'attendances', 
                         'action' => 'timekeep',
                         'tab' => 'timekeep',
                         'plugin' => 'human_resource'

                    ));

			} else {

				if (!empty($this->params['named']['return'])) {


	            	$return = base64_decode($this->params['named']['return']);
	            	
	            	$return = str_replace('/koufunet','',$return);

	            	$this->redirect($return);
            	
				} else {

						$this->redirect( array(
	                         'controller' => 'attendances', 
	                         'action' => 'index',
	                         'plugin' => 'human_resource'

	                    ));


				}

				
			}

			} else {

				$this->Session->setFlash('There\'s an error saving data','error');
			
			}
	}
}


public function delete($id = null) {

		if (!empty($id)) {

			if ($this->Attendance->delete($id)) {
                $this->Session->setFlash(
                    __('Successfully deleted.', h($id))
                );
            } else {
                $this->Session->setFlash(
                    __('Attendance cannot be deleted.', h($id))
                );
            }

            if (!empty($this->params['named']['return'])) {
            	$return = base64_decode($this->params['named']['return']);
            	
            	$return = str_replace('/koufunet','',$return);
            	
            	return $this->redirect($return);

            } else {

            	return  $this->redirect( array(
                             'controller' => 'attendances', 
                             'action' => 'index',
                             'tab' => 'attendance',
                             'plugin' => 'human_resource'

                        ));
            }
           
		}
}

private function _getDuration($time1 = null,$time2 = null){


		if (!empty($time1) && $time2) {

		$date = date('Y-m-d');

	
		$date1 = new DateTime($time1);
		$date2 = new DateTime($time2);

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

		$this->loadModel('HumanResource.Overtime');
		
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

		$this->Attendance->bind(array('WorkSchedule','Employee','WorkShift','Overtime'));

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
	
	$query = $this->request->data;

	if (!empty($query['attendanceId'])) {

		$this->loadModel('HumanResource.WorkSchedule');

		$this->loadModel('HumanResource.Workshift');

		$this->loadModel('HumanResource.Employee');
		
		$conditions = array(
		 'Attendance.id' => $query['attendanceId'],
		);

		$attendance = $this->Attendance->find('first',array(
			'conditions' => $conditions
		));


		$date = date('Y-m-d');

		if (!empty($attendance['Attendance']['in'])){
			$date = date('Y-m-d',strtotime($attendance['Attendance']['in']));
		}

	
		$conditions = array_merge($conditions,array(
						'date(Attendance.date) BETWEEN ? AND ?' => array($date,$date), 
						 'Attendance.id' => $query['attendanceId'],
			));

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

	public function export_attendance() {

		Configure::write('debug',0);

		$this->loadModel('HumanResource.WorkSchedule');

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.Workshift');

		$this->loadModel('HumanResource.WorkShiftBreak');

		$this->loadModel('HumanResource.BreakTime');

		$this->loadModel('HumanResource.Department');

		$conditions = array();

		$selectedDate = date('Y-m-d');

		if (!empty($this->request->data)) {


		if (!empty($this->request->data['date'])) {

			$selectedDate = $this->request->data['date'];

			$dateSplit = explode('-',$this->request->data['date']);
			$date1 = trim($dateSplit[0]);
			$date2 = trim($dateSplit[1]);
			$date1 = date('Y-m-d',strtotime($date1));
			$date2 = date('Y-m-d',strtotime($date2));
			
			$conditions = array_merge($conditions,array('date(Attendance.date) BETWEEN ? AND ?' => array($date1,$date2)));
		
		}

		

		if (!empty($this->request->data['search'])) {

			$search = $this->request->data['search'];

			$conditions = array_merge($conditions,array(
					'Attendance.employee_id' => $search
			));

		}
			
			$this->Attendance->bind(array('Employee','MySchedule','MyWorkshift','MyWorkShiftBreak','MyBreakTime'));

    	}

    	$conditions = array_merge($conditions,array(
    		'Attendance.in NOT' => "",
    		'Attendance.out NOT' => ''

    	));



    	
        $attendanceData = $this->Attendance->find('all', array(
          'conditions' => $conditions,
            // 'order' => 'Attendance.out DESC',
            // 'group' => 'Attendance.id',

	        'group' => array('Attendance.date'),
	        'order' => 'Attendance.out DESC',
            //'fields'=> array('Attendance.in','Attendance.out')
        ));


 
        //check duplicity

    //     foreach ($attendanceData as $key => $value) {
        
    //     	if (!empty($value['Attendance']['in']) && !empty($value['Attendance']['out'])) {

    //     		$dateIn = date('Y-m-d',strtotime($value['Attendance']['in']));

    //     		$dateOut = date('Y-m-d',strtotime($value['Attendance']['out']));

    //     		$timeIn = $dateIn;

    //     		$workIn = $dateOut.' '.$value['MyWorkshift']['from'];

    //     		$workOut = $dateOut.' '.$value['MyWorkshift']['to'];	

				// if (strtotime($timeIn) >= strtotime($workIn)) {

				// 	// $workshift = 

	   //      	}


    //     	} else {

    //     		unset($attendanceData[$key]);
    //     	}

        	
    //     }




    	$this->set(compact('attendanceData','selectedDate'));

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

	public function findExisting($employee_id = null,$date = null) {

		$this->autoRender = false;

		$query = $this->request->query;

		if (!empty($query['employee_id'])) {

			if (!empty($query['date'])) {

				$dateSplit = explode(' ',$query['date']);
		
				$date = trim($dateSplit[0]);

			} else {

				$date = date('Y-m-d');

				$date2 = date('Y-m-d', strtotime($date . ' +1 day'));
			}

			$conditions = array(
				'Attendance.date <=' => $date,
				'Attendance.date >=' => $date,
				'Attendance.employee_id' => $query['employee_id'],
			);

			$timekeep = $this->Attendance->find('first',array(
				'conditions' => $conditions
			));

			if (!empty($timekeep)) {

				return  json_encode($timekeep['Attendance']);	
			}

			return json_encode($timekeep);	

		}
	}


	public function irreg_ot() {

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.Attendance');

		$this->loadModel('HumanResource.OvertimeLimit');

		$this->loadModel('HumanResource.OvertimeExcess');

		$date = date('Y-m-d');

		$search = '';
		
		$limit = 10;
		
		$conditions = array();

		if (!empty($this->request->query)) {

			$query = $this->request->query;

				if (!empty($query['data']['date'])) {

					$date = explode('-', $query['data']['date']);
					
					$conditions = array_merge($conditions,array(
					'OvertimeExcess.from >=' => date('Y-m-d 00:00:00', strtotime(trim($date[0]))),
					//'OvertimeExcess.to <=' => date('Y-m-d 00:00:00', strtotime(trim($date[1])))
					));

					$date = $query['data']['date'];
				}
				
				if (!empty($query['data']['name'])) {
						$search = $query['data']['name'];
						$conditions = array_merge($conditions,array(
								'OR' => array(
								'Employee.first_name LIKE' => '%'.$search.'%',
								'Employee.last_name LIKE' => '%'.$search.'%',
								'Employee.middle_name' => '%'.$search.'%',
						)));
				}
							
		} else {

			$conditions = array('OvertimeExcess.from >=' => $date);
		}

		$params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'OvertimeExcess.from ASC',
	    );

		$this->paginate = $params;

		$this->OvertimeExcess->bind(array('Employee'));
		
		$overtimes = $this->paginate('OvertimeExcess');

		//pr($overtimes); exit();

		$this->set(compact('date','overtimes','search'));

	}

	public function edit_attendance($id = null) {

		$this->layout = false;

		$this->loadModel('HumanResource.Employee');

		$query = $this->request->query;

		if (!empty($this->request->data)) {

			$data = $this->request->data;

			$data['Attendance']['in'] = !empty($this->request->data['Attendance']['in']) ? $this->request->data['Attendance']['in'] : '';

			$data['Attendance']['out'] = !empty($this->request->data['Attendance']['out']) ? $this->request->data['Attendance']['out'] : '';
			


			if ($this->Attendance->save($data)) {

				if ($this->request->is('ajax'))  {

					$save = true;
				}  else {

					$this->Session->setFlash('Time Sucessfully updated','success');
				} 

				
			} else {

				if ($this->request->is('ajax'))  {

					$save = false;
				}  else {

						$this->Session->setFlash('There\'s an error updating attendance','success');
				} 

			

			}


			if ($this->request->is('ajax'))  {



					$attendance = $this->Attendance->read(null,$id);



					if (!empty($attendance['Attendance']['in'])) {

						$attendance['Attendance']['in'] = date('y/m/d h:i a',strtotime($attendance['Attendance']['in']));

					} else {

						$attendance['Attendance']['in'] = '';
					}


					if (!empty($attendance['Attendance']['out'])) {

						$attendance['Attendance']['out'] = date('y/m/d h:i a',strtotime($attendance['Attendance']['out']));

					} else {

							$attendance['Attendance']['out'] = '';
					}

				
					echo json_encode($attendance);

					exit();

				}  else {

					
				
				$this->redirect( array(
	                         'controller' => 'attendances', 
	                         'action' => 'index',
	                         'tab' => 'attendance',
	                         'plugin' => 'human_resource'
					));
				} 


		}

		$attendance  = array();

		if (!empty($query['attendanceId'])) {

			$this->Attendance->bind(array('Employee'));

			$attendance = $this->request->data = $this->Attendance->find('first',array(
				'conditions' => array('Attendance.id' => $id)
			));
	
		
		}

		$this->set(compact('attendance'));

		$this->render('Attendances/ajax/edit_attendance');

	}

	public function check_attendance() {


		$this->loadModel('HumanResource.WorkSchedule');

		$this->loadModel('HumanResource.Workshift');

		$this->loadModel('HumanResource.WorkshiftBreak');

		$this->loadModel('HumanResource.Breaktime');

		$this->loadModel('HumanResource.Overtime');

		$this->Attendance->bind(array('MySchedule','MyWorkshift','Overtime'));

		$dateNow = date('Y-m-d');

		$tomorrow = date('Y-m-d',strtotime($dateNow . "+1 days"));

		$conditions = 	array(
			'date(Attendance.date) BETWEEN ? AND ?' => array($dateNow,$tomorrow),
			'Attendance.in NOT' => NULL
			);

		$this->Attendance->bind(array('MySchedule','MyWorkshift'));

		$attendances = $this->Attendance->find('all',array('conditions' => $conditions));

		$attendanceData = array();

		foreach ($attendances as $key => $attnd) {
			
					$attendanceData = $attnd['Attendance'];
				//morning shift	
				if ($attnd['MyWorkshift']['from'] = '08:00:00') {

					if (empty($attnd['Attendance']['out']) && empty($attnd['Attendance']['overtime_id'])) {

						$attendanceData['out'] = 'n/a';

						if ( $this->Attendance->save($attendanceData)) {

							echo "no timeout for : ". $attendanceData['id'];

							echo "<br>";
						}

					}
				}
		}

		exit();
	}

}	

