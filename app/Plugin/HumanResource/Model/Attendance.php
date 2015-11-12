<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Attendance extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Attendance';

    public $actsAs = array('Containable');

    	public $virtualFields = array(
			'concat_date' => 'CONCAT_WS(" ", DATE_FORMAT( Attendance.date ,"%Y-%m-%d"))'
		);
    
     public function bind($model = array('Group')){

 //     	public $virtualFields = array(
	// 	'date_' => 'CONCAT_WS(" ",Employee.last_name , Employee.middle_name , Employee.first_name  )',
	// );


		$this->bindModel(array(
				'belongsTo' => array (
					'WorkSchedule' => array(
						'className' => 'WorkSchedule',
						'foreignKey' => false,
						'conditions' => array('WorkSchedule.id = Attendance.schedule_id'),
						'dependent' => true,
					),
					
					'WorkShift' => array(
						'className' => 'WorkShift',
						'foreignKey' => false,
						'dependent' => false,
						'conditions' => array('WorkShift.id = WorkSchedule.work_shift_id')
					),
					'Employee' => array(
						'className' => 'Employee',
						'foreignKey' => false,
						'conditions' => array('Employee.id = Attendance.employee_id'),
						'dependent' => true,
					),
					
					'Overtime' => array(
						'className' => 'Overtime',
						'foreignKey' => false,
						'conditions' => array('Overtime.id = Attendance.overtime_id')
					),
					'MySchedule' => array(
						'className' => 'WorkSchedule',
						'foreignKey' => false,
						'conditions' => array(
							'MySchedule.model' => 'Employee',
							'MySchedule.foreign_key = Attendance.employee_id',
							'MySchedule.day BETWEEN DATE_FORMAT( Attendance.date ,"%Y-%m-%d") and DATE_FORMAT( Attendance.date ,"%Y-%m-%d")'
							),
					),
					'MyWorkshift' => array(
						'className' => 'WorkShift',
						'foreignKey' => false,
						'dependent' => false,
						'conditions' => array('MyWorkshift.id = MySchedule.work_shift_id')
					),
					'MyWorkShiftBreak' => array(
						'className' => 'WorkShiftBreak',
						'foreignKey' => false,
						'dependent' => false,
						'conditions' => array('MyWorkShiftBreak.workshift_id = MySchedule.work_shift_id')
					),
					 'MyBreakTime' => array(
						'className' => 'BreakTime',
						'foreignKey' => false,
						'dependent' => false,
						'conditions' => array('MyBreakTime.id = MyWorkShiftBreak.breaktime_id')
					),
					// 'WorkShiftBreak' => array(
					// 	'className' => 'WorkShiftBreak',
					// 	'foreignKey' => false,
					// 	'dependent' => false,
					// 	'conditions' => array('WorkShiftBreak.workshift_id = WorkSchedule.work_shift_id')
					// ),
					// 'BreakTime' => array(
					// 	'className' => 'BreakTime',
					// 	'foreignKey' => false,
					// 	'dependent' => false,
					// 	'conditions' => array('BreakTime.id = WorkShiftBreak.breaktime_id')
					// ),
					
				),			),false);

		$this->contain($model);
	}

	public function bindWorkshift() {
		
		$this->bindModel(array(
				'belongsTo' => array (
					'WorkSchedule' => array(
						'className' => 'WorkSchedule',
						'foreignKey' => false,
						'conditions' => array('WorkSchedule.id = Attendance.schedule_id'),
						'dependent' => true,
					),
					'WorkShift' => array(
						'className' => 'WorkShift',
						'foreignKey' => false,
						'dependent' => false,
						'conditions' => array('WorkShift.id = WorkSchedule.work_shift_id')
					),
					'WorkShiftBreak' => array(
						'className' => 'WorkShiftBreak',
						'foreignKey' => false,
						'dependent' => false,
						'conditions' => array('WorkShiftBreak.workshift_id = WorkSchedule.work_shift_id')
					),
					'BreakTime' => array(
						'className' => 'BreakTime',
						'foreignKey' => false,
						'dependent' => false,
						'conditions' => array('BreakTime.id = WorkShiftBreak.breaktime_id')
					),
				),
				'hasOne' => array(

					'OvertimeExcess' => array(
						'className' => 'OvertimeExcess',
						'foreignKey' => 'attendance_id',
						'dependent' => false,
					),
				)
		));
		$this->recursive = 1;
	}

	public function bindMyWorkshift() {


		$this->bindModel(array(
				'belongsTo' => array (
						
					// 'Overtime' => array(
					// 	'className' => 'Overtime',
					// 	'foreignKey' => false,
					// 	'conditions' => array('Overtime.id = Attendance.overtime_id')
					// ),
					'MySchedule' => array(
						'className' => 'WorkSchedule',
						'foreignKey' => false,
						'conditions' => array(
							'MySchedule.model' => 'Employee',
							'MySchedule.foreign_key = Attendance.employee_id',
							'MySchedule.day BETWEEN DATE_FORMAT( Attendance.in ,"%Y-%m-%d") and DATE_FORMAT( Attendance.in ,"%Y-%m-%d")'
							),
					),
					'MyWorkshift' => array(
						'className' => 'WorkShift',
						'foreignKey' => false,
						'dependent' => false,
						'conditions' => array('MyWorkshift.id = MySchedule.work_shift_id')
					),
					'MyWorkShiftBreak' => array(
						'className' => 'WorkShiftBreak',
						'foreignKey' => false,
						'dependent' => false,
						'conditions' => array('MyWorkShiftBreak.workshift_id = MySchedule.work_shift_id')
					),
					 'MyBreakTime' => array(
						'className' => 'BreakTime',
						'foreignKey' => false,
						'dependent' => false,
						'conditions' => array('MyBreakTime.id = MyWorkShiftBreak.breaktime_id')
					),
					 
					'Overtime' =>  array(
						'className' => 'Overtime',
						'foreignKey' => false,
						'dependent' => false,
						'conditions' => array('Overtime.id = Attendance.overtime_id')
					),
				),
				'hasOne' => array(

					'OvertimeExcess' => array(
						'className' => 'OvertimeExcess',
						'foreignKey' => 'attendance_id',
						'dependent' => false,
					),
				)
		));
		$this->recursive = 1;

	}


	public function saveRecord($data = null,$sched_id = null,$holidays = array()) {

		if (!empty($data)) {

			$sched = $attendance = array();

			$this->create();




			if (is_array($data) && !empty($data[0]['overtime_id'])) {

				//check overtime 

				foreach ($data as $key => $dataList) {
					//if overtime
					$sched['Attendance']['id'] = !empty($dataList['Attendance']['id']) ? $dataList['Attendance']['id'] : '';

					if ($dataList['overtime_id']) {

						
						$attendance = $this->find('first',array('conditions' => array(
							'employee_id' => $dataList['foreign_key'],
							'date(Attendance.date) BETWEEN ? AND ?' => array($dataList['day'],$dataList['day']), 
							//'schedule_id' => $dataList['id']
							)));

						$sched['Attendance']['id'] = !empty($attendance['Attendance']['id']) ? $attendance['Attendance']['id'] : '';
					}
					
					if ($dataList['model'] == 'Employee') {
					
						$sched['Attendance']['employee_id'] = $dataList['foreign_key'];
						
					}

					$sched['Attendance']['date'] = $dataList['day'];
					$sched['Attendance']['schedule_id'] = $dataList['id'];

					$sched['Attendance']['type'] = 'work';

					if ($dataList['overtime_id']) {

						$sched['Attendance']['type'] = 'overtime work';
						$sched['Attendance']['overtime_id'] = $dataList['overtime_id'];
					}

					$this->save($sched);	

				}

			}  else {

				if (!empty($data['type']) && $data['type'] == 'monthly') {

					$date = explode('-',$data['day']);

					$days1 = explode('/',trim($date[0]));
					$days2 = explode('/',trim($date[1]));

					ini_set('max_execution_time', 3600);
					ini_set('memory_input_time', 1024);
					ini_set('max_input_nesting_level', 1024);
					ini_set('memory_limit', '1024M');

					for ($days_count = $days1[2];$days_count <= $days2[2]; $days_count++) :

						$sched['Attendance']['id'] = !empty($data['Attendance']['id']) ? $data['Attendance']['id'] : '';

						if ($data['model'] == 'Employee') {
						
							$sched['Attendance']['employee_id'] = $data['foreign_key'];
							
						}

						$sched['Attendance']['date'] = $days1[0].'-'.$days1[1].'-'.sprintf("%02d",$days_count);
						$sched['Attendance']['schedule_id'] = $sched_id;
						$sched['Attendance']['type'] = 'work';
						$sched['Attendance']['is_holiday'] = 0;
						
						foreach ($holidays as $key => $holiday) {
							
							if ($sched['Attendance']['date'] >= $holiday['Holiday']['start_date'] && $sched['Attendance']['date'] <= $holiday['Holiday']['end_date'] ) {
								
								$sched['Attendance']['is_holiday'] = $holiday['Holiday']['id'];	
							} 
						}
 
						if ( date("w",strtotime($sched['Attendance']['date'])) == 0) {

							$sched['Attendance']['type'] = 'rest_day';

						}

						$this->save($sched);

				
					endfor;

				} else {
					

						$sched['Attendance']['id'] = !empty($data['Attendance']['id']) ? $data['Attendance']['id'] : '';

						if ($data['model'] == 'Employee') {
						
							$sched['Attendance']['employee_id'] = $data['foreign_key'];
							
						}

						$sched['Attendance']['date'] = $data['day'];
						$sched['Attendance']['schedule_id'] = $sched_id;
						$sched['Attendance']['type'] = 'work';



					return $this->save($sched['Attendance']);
				}
			


			}
			
		
			
		}
	}

	public function getAll($conditions = array(), $bind = array()){

		if (!empty($bind)) {
			$this->bind($bind);
		}
		return $this->find('all',array('conditions' => $conditions, 'order' => 'Attendance.date'));

	}

	public function getAttendance($data = null) {

		if (!empty($data)) {

			$login = !empty($data['Attendance']['time']) ? explode(',',$data['Attendance']['time']) : '';

			$date = date('Y-m-d',strtotime($login[0]));

			$conditions = array(
				'Attendance.date <=' => $date,
				'Attendance.date >=' => $date,
				'Attendance.employee_id' => $data['Attendance']['employee_id']
			);

			if (!empty($data['Attendance']['id'])) {
				$conditions = array('Attendance.id' => $data['Attendance']['id']);	
			}

			$attendance = $this->find('first',array('conditions' => $conditions));

			switch ($data['Attendance']['type']) {
				case 'in':
				$attendance['Attendance']['in'] = trim($date.$login[1]);
					break;
				case 'out':
				$attendance['Attendance']['out'] = trim($date.$login[1]);
					break;
			}
			
			$attendance['Attendance']['notes'] = $data['Attendance']['notes']; 
			$attendance['Attendance']['status'] = !empty($data['Attendance']['status']) ? $data['Attendance']['status'] : ''; 

	
			return $attendance;

		}

	}

		public function is_date( $str ){ 
		    $stamp = strtotime( $str ); 
		    if (!is_numeric($stamp)) 
		        return FALSE; 
		    $month = date( 'm', $stamp ); 
		    $day   = date( 'd', $stamp ); 
		    $year  = date( 'Y', $stamp ); 
		    if (checkdate($month, $day, $year)) 
		        return TRUE; 
		    return FALSE; 
		}

	public function computeAttendance($conditions = array()){


		if (!empty($conditions)) {
			
			$this->bindMyWorkshift();

			$attendances = $this->find('all',array('conditions' => $conditions,
				'order' => 'Attendance.out ASC',
				'fields' => array(
					'Attendance.id',
					'Attendance.date',
					'Attendance.schedule_id',
					'Attendance.type',
					'Attendance.is_holiday',
					'Attendance.leave_id',
					'Attendance.in',
					'Attendance.out',
					'Attendance.notes',
					'Attendance.status',
					'Attendance.overtime_id',
					'MySchedule.id',
					'MySchedule.model',
					'MySchedule.foreign_key',
					'MySchedule.work_shift_id',
					'MySchedule.day',
					'MySchedule.holiday',
					'MyWorkshift.id',
					'MyWorkshift.from',
					'MyWorkshift.to',
					'MyWorkShiftBreak.id',
					'MyWorkShiftBreak.workshift_id',
					'MyWorkShiftBreak.overtime_id',
					'MyWorkShiftBreak.breaktime_id',
					'MyBreakTime.id',
					'MyBreakTime.from',
					'MyBreakTime.to',
					'Overtime.id',
					'Overtime.date',
					'Overtime.from',
					'Overtime.to',
					'Overtime.employee_ids',
					'Overtime.status',
					'OvertimeExcess.id',
					'Overtime.id',
					'OvertimeExcess.employee_id',
					'OvertimeExcess.from',
					'OvertimeExcess.to'
				),
				'group' => 'Attendance.id'
			));

			foreach ($attendances as $key => $attendance) {

				
				if ($this->is_date($attendance['Attendance']['in']) && $this->is_date($attendance['Attendance']['out']) ) {

				
				// if (strtotime($attendance['Attendance']['in']) >= strtotime($attendance['WorkShift']['from']) && strtotime($attendance['Attendance']['out']) <= strtotime($attendance['WorkShift']['to'])) {
				if (strtotime($attendance['Attendance']['in']) >= strtotime($attendance['MyWorkshift']['from']) && strtotime($attendance['Attendance']['out']) <= strtotime($attendance['MyWorkshift']['to'])) {
						
						$from = new DateTime($attendance['Attendance']['in']);
						$to = new DateTime($attendance['Attendance']['out']);
						
						$attendances[$key]['total_hours'] =  $from->diff($to)->format('%h.%i'); 

						if (!empty($attendance['MyBreakTime']['id'])) {
							if (strtotime($attendance['Attendance']['out']) >= strtotime($attendance['MyBreakTime']['from']) && strtotime($attendance['Attendance']['out']) >= strtotime($attendance['MyBreakTime']['to'])) {
						
								$attendances[$key]['total_hours'] -= 1;
							}
						}
						
				}
			}

			}

			return $attendances;
		}
	}

	public function setLeave($leaveData = null) {


		if (!empty($leaveData)) {

		
			
					//$leave['id'] = $value['Attendance']['id'];
					// $leave['type'] = 'leave';
					// $leave['leave_id'] = $leaveData['Leave']['id'];	
					return $this->save($leaveData);
				
		}
	}

	public function createAttendance($data = null, $WorkSchedule = array()) {

		$Holiday = ClassRegistry::init('Holiday');

		$holidayList = $Holiday->find('all',array(
			'conditions' => array(),
			'order' => array('Holiday.start_date ASC')
		));


		$dateNow = date('Y-m-d');


		foreach ($holidayList as $key => $holiday) {
			
			if ($dateNow >= $holiday['Holiday']['start_date'] && $dateNow <= $holiday['Holiday']['end_date'] ) {
				
				$data['Attendance']['is_holiday'] = $holiday['Holiday']['id'];	
			} 
		}

		$data['Attendance']['schedule_id'] = !empty($WorkSchedule['WorkSchedule']['id']) ? $WorkSchedule['WorkSchedule']['id'] : 0 ;

		$data['Attendance'] = $data['Attendance'];

		 //date('Y-m-d').' 00:00:00';
		$date_in = date('Y-m-d').' 00:00:00';

		if (!empty($data['Attendance']['time_in'])) {
			$date_in = $data['Attendance']['time_in'];
			$data['Attendance']['in'] = date('Y-m-d H:i:s',strtotime($data['Attendance']['time_in'])); 

		}

		else if (!empty($data['Attendance']['time']) && $data['Attendance']['type'] == 'in') {

			$date_in = $data['Attendance']['time'];
			$data['Attendance']['in'] = date('Y-m-d H:i:s',strtotime($data['Attendance']['time'])); 
		
		}
		if (!empty($data['Attendance']['time_out'])) {
			//$date_in = $data['Attendance']['time_out'];
			$data['Attendance']['out'] = date('Y-m-d H:i:s',strtotime($data['Attendance']['time_out'])); 
		}

		else if (!empty($data['Attendance']['time']) && $data['Attendance']['type'] == 'out') {

		//	$date_in = $data['Attendance']['time'];
			$data['Attendance']['out'] = date('Y-m-d H:i:s',strtotime($data['Attendance']['time'])); 
		
		}

		if (empty($data['Attendance']['id'])) {

			$data['Attendance']['date'] = date('Y-m-d H:i:s',strtotime($date_in));
		}

		if ( date("w",strtotime($dateNow)) == 0) {

			$data['Attendance']['type'] = 'rest_day';

		} else {
			$data['Attendance']['type'] = 'work';
		}


		$attendance = $this->save($data);

		$attendance = $this->find('first',array(
			'conditions' => array('Attendance.id' => $this->id)
		));

		return $attendance;
		 

	}	
	
  }


