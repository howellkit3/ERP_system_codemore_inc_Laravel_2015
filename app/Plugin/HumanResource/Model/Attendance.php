<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Attendance extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Attendance';

    public $actsAs = array('Containable');
    
     public function bind($model = array('Group')){

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
					)
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
					
				)
			),false);

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
			)));
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
						
						$attendance = $this->find('first',array('conditions' => array('employee_id' => $dataList['foreign_key'], 'schedule_id' => $dataList['id'])));

						pr($attendance);
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

	public function computeAttendance($conditions = array()){


		if (!empty($conditions)) {
			
			$attendances = $this->find('all',array('conditions' => $conditions));

			foreach ($attendances as $key => $attendance) {

				// if (strtotime($attendance['Attendance']['in']) >= strtotime($attendance['WorkShift']['from']) && strtotime($attendance['Attendance']['out']) <= strtotime($attendance['WorkShift']['to'])) {
				if (strtotime($attendance['Attendance']['in']) >= strtotime($attendance['WorkShift']['from']) && strtotime($attendance['Attendance']['out']) <= strtotime($attendance['WorkShift']['to'])) {
						
						$from = new DateTime($attendance['Attendance']['in']);
						$to = new DateTime($attendance['Attendance']['out']);
						
						$attendances[$key]['total_hours'] =  $from->diff($to)->format('%h.%i'); 

						if (!empty($attendance['BreakTime']['id'])) {
							if (strtotime($attendance['Attendance']['out']) >= strtotime($attendance['BreakTime']['from']) && strtotime($attendance['Attendance']['out']) >= strtotime($attendance['BreakTime']['to'])) {
						
								$attendances[$key]['total_hours'] -= 1;
							}
						}


						
				}

			}

			return $attendances;
		}
	}

	public function setLeave($leaveData = null) {


		if (!empty($leaveData)) {

			$attendances = $this->find('all',array(
				'conditions' => array(
					'date >=' => $leaveData['Leave']['from'],
					'date <=' => $leaveData['Leave']['to'],
					'employee_id' => $leaveData['Leave']['employee_id']
				),
				'fields' => array(
					'Attendance.id',
					'Attendance.employee_id',
					'Attendance.date'
				)

			));

			$leave = array();

			foreach ($attendances as $key => $value) {
					
				if ( date("w",strtotime($value['Attendance']['date'])) != 0) {
					$leave['id'] = $value['Attendance']['id'];
					$leave['type'] = 'leave';
					$leave['leave_id'] = $leaveData['Leave']['id'];
					$this->save($leave);
				}	
			}
		}
	}
	
  }
