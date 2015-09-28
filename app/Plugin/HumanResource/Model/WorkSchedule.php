<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class WorkSchedule extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'WorkSchedule';

    public $actsAs = array('Containable');


     public function bind($model = array('Group')){

		$this->bindModel(array(
			'hasOne' => array(
				'WorkShift' => array(
					'className' => 'HumanResource.WorkShift',
					'foreignKey' => false,
					'conditions' => array('WorkShift.id = WorkSchedule.work_shift_id'),
					'dependent' => true
				),
			
			),
			'belongsTo' => array(
				'Employee' => array(
					'className' => 'HumanResource.Employee',
					'foreignKey' => false,
					'conditions' => array('Employee.id = WorkSchedule.foreign_key'),
					'dependent' => true
				),
				'WorkShift' => array(
					'className' => 'HumanResource.WorkShift',
					'foreignKey' => false,
					'conditions' => array('WorkShift.id = WorkSchedule.work_shift_id'),
					'dependent' => true
				),

				),
		),false);

		$this->contain($model);
	}


	public function createSchedule($data = null, $workShiftId = null,$overtimeId = null,$authId = null) {

		$schedule = array();

		if (!empty($data)) {

			$this->create();

			$employeeSchedules = $this->find('list',array(
				'conditions' => array('WorkSchedule.model' => 'Employee','WorkSchedule.overtime_id' => $overtimeId ),
				'fields' => array('foreign_key','id')
				));
			
			$flipped = array_flip($employeeSchedules);

			if (!empty($data['Overtime']['employee_ids'])) {

				$employees = (array)json_decode($data['Overtime']['employee_ids']);

				foreach ($employees as $key => $employee) {
							$schedule[$key]['id'] = in_array($employee,$flipped) ? $employeeSchedules[$employee] : '';
							$schedule[$key]['model'] = 'Employee';
							$schedule[$key]['foreign_key'] = $employee;
						
						if (!empty($overtimeId)) {

							$schedule[$key]['overtime_id'] = $overtimeId;
						
						}

							$schedule[$key]['work_shift_id'] = $workShiftId;
							$schedule[$key]['day'] = $data['Overtime']['date'];
							$this->save($schedule[$key]);
							$schedule[$key]['id'] = $this->id;
					
				}
				
				return $schedule;

			}
		
		}
	}

	public function formatData($data = null,$holidays = null) {


		if (!empty($data)) {

			$sched = array();
			$keys = 0;

			if ($data['WorkSchedule']['type'] == 'monthly') {

				$date = explode('-',$data['WorkSchedule']['day']);
				
				$start_date = date('Y-m-d',strtotime(trim($date[0])));
				$end_date = date('Y-m-d',strtotime(trim($date[1])));

				$conditions = array(
				'WorkSchedule.foreign_key' => $data['WorkSchedule']['foreign_key'],
				'date(WorkSchedule.day) BETWEEN ? AND ?' => array($start_date,$end_date)
				);
				//check available schedules
				$myschedules = $this->find('list',array('conditions' => $conditions,
				'fields' => array('id','day')

				));


					// $data['WorkSchedule']['id'] = !empty($data['WorkSchedule']['id']) ? $data['WorkSchedule']['id'] : '';
					// $data['WorkSchedule']['from'] = date('Y-m-d',strtotime($date[0]));
					// $data['WorkSchedule']['to'] = date('Y-m-d',strtotime($date[1]));	

					$keys = 0;

					while (strtotime($start_date) <= strtotime($end_date)) {

						if (!in_array( $start_date ,$myschedules)) {


						$timestamp = strtotime($start_date);
						

						if ( date("w",strtotime($start_date)) != 0) {

 							$sched['WorkSchedule'][$keys] = $data['WorkSchedule'];
							$sched['WorkSchedule'][$keys]['id'] = !empty($data['WorkSchedule']['id']) ? $data['WorkSchedule']['id'] : '';
 							$sched['WorkSchedule'][$keys]['day'] = $start_date;
 							$sched['WorkSchedule'][$keys]['type'] = 'Work';


						} else if (date("w",strtotime($start_date)) == 0) {

							$sched['WorkSchedule'][$keys] = $data['WorkSchedule'];
							$sched['WorkSchedule'][$keys]['id'] = !empty($data['WorkSchedule']['id']) ? $data['WorkSchedule']['id'] : '';

 							$sched['WorkSchedule'][$keys]['day'] = $start_date;

 							$sched['WorkSchedule'][$keys]['type'] = 'Rest Day';

						}

						foreach ($holidays as $key => $holiday) {

								if ($start_date >= $holiday['Holiday']['start_date'] && $start_date <= $holiday['Holiday']['end_date'] ) {

									$sched['WorkSchedule'][$keys]['type'] = $holiday['Holiday']['type'];
									$sched['WorkSchedule'][$keys]['holiday'] = $holiday['Holiday']['id'];
								} 

						}


 							$sched['WorkSchedule'][$keys]['from'] = $start_date;
							$sched['WorkSchedule'][$keys]['to'] = $start_date;


						$keys++;

						

					}


					$start_date = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)));
						
					}


					// for ( $days_count = $days1[2];$days_count <= $days2[2]; $days_count++ ) :

					// 	$checkDate = $days1[0].'-'.$days1[1].'-'.sprintf("%02d",$days_count);

					// 	if ( date("w",strtotime($checkDate)) != 0) {

 				// 			$sched['WorkSchedule'][$keys] = $data['WorkSchedule'];
					// 		$sched['WorkSchedule'][$keys]['id'] = !empty($data['WorkSchedule']['id']) ? $data['WorkSchedule']['id'] : '';

 				// 			$sched['WorkSchedule'][$keys]['day'] = $days1[0].'-'.$days1[1].'-'.sprintf("%02d",$days_count);

 				// 			$sched['WorkSchedule'][$keys]['type'] = 'Work';

					// 	} else if (date("w",strtotime($checkDate)) == 0) {

					// 		$sched['WorkSchedule'][$keys] = $data['WorkSchedule'];
					// 		$sched['WorkSchedule'][$keys]['id'] = !empty($data['WorkSchedule']['id']) ? $data['WorkSchedule']['id'] : '';

 				// 			$sched['WorkSchedule'][$keys]['day'] = $days1[0].'-'.$days1[1].'-'.sprintf("%02d",$days_count);

 				// 			$sched['WorkSchedule'][$keys]['type'] = 'Rest Day';

					// 	}

					// foreach ($holidays as $key => $holiday) {

					// 		if ($checkDate >= $holiday['Holiday']['start_date'] && $checkDate <= $holiday['Holiday']['end_date'] ) {

					// 			$sched['WorkSchedule'][$keys]['type'] = $holiday['Holiday']['type'];
					// 			$sched['WorkSchedule'][$keys]['holiday'] = $holiday['Holiday']['id'];
					// 		} 

					// }


					// $keys++;
					// endfor;

			} else {

				$checkDate = $data['WorkSchedule']['day'];


				$conditions = array(
				'WorkSchedule.foreign_key' => $data['WorkSchedule']['foreign_key'],
				'date(WorkSchedule.day) BETWEEN ? AND ?' => array($checkDate,$checkDate)
				);
				//check available schedules
				$myschedules = $this->find('list',array('conditions' => $conditions,
				'fields' => array('id','day')

				));

				if (!in_array($checkDate, $myschedules)) {

				
				if ( date("w",strtotime($checkDate)) != 0) {

						$sched['WorkSchedule'][$keys] = $data['WorkSchedule'];
						$sched['WorkSchedule'][$keys]['id'] = !empty($data['WorkSchedule']['id']) ? $data['WorkSchedule']['id'] : '';

							$sched['WorkSchedule'][$keys]['day'] = $checkDate;

							$sched['WorkSchedule'][$keys]['type'] = 'Work';

					} else if (date("w",strtotime($checkDate)) == 0) {

						$sched['WorkSchedule'][$keys] = $data['WorkSchedule'];
						$sched['WorkSchedule'][$keys]['id'] = !empty($data['WorkSchedule']['id']) ? $data['WorkSchedule']['id'] : '';
						$sched['WorkSchedule'][$keys]['day'] = $checkDate;
						$sched['WorkSchedule'][$keys]['type'] = 'Rest Day';

					}

				foreach ($holidays as $key => $holiday) {

						if ($checkDate >= $holiday['Holiday']['start_date'] && $checkDate <= $holiday['Holiday']['end_date'] ) {

							$sched['WorkSchedule'][$keys]['type'] = $holiday['Holiday']['type'];
							$sched['WorkSchedule'][$keys]['holiday'] = $holiday['Holiday']['id'];
						} 

				}
			} 

			}


			return $sched;
		}
	}


	public function getAllSchedules($empId = null,$workSched = null,$holidays = null) {

		if (!empty($empId)) {

			$this->bind(array('WorkShift'));

			$schedules = $this->find('all',array(
				'conditions' => array('WorkSchedule.model' => 'Employee' , 
					'WorkSchedule.foreign_key' => $empId ),
				'order' => array('WorkSchedule.day ASC')
				));

			
			$list_key = 0;	

			//pr($schedules); exit();

			foreach ($schedules as $key => $workshift) {

						if (!empty($workshift['WorkShift']['from']) && $workshift['WorkShift']['from'] != '00-00-00') {
								
								$dateNow = $workshift['WorkSchedule']['day'];
									
								if ( date("w",strtotime($dateNow)) != 0) { 
									
									$list[$list_key]['title'] = date('h:i a',strtotime($workshift['WorkShift']['from'])) . ' - ' .  date('h:i a',strtotime($workshift['WorkShift']['to']));
									$list[$list_key]['start'] =	$workshift['WorkSchedule']['day'].' '.$workshift['WorkShift']['from'];
									$list[$list_key]['end']  = $workshift['WorkSchedule']['day'].' '.$workshift['WorkShift']['to'];
									$list[$list_key]['color'] = '#257e4a';

								} 

								foreach ($holidays as $key => $holiday) {

									if ($dateNow >= $holiday['Holiday']['start_date'] && $dateNow <= $holiday['Holiday']['end_date'] ) {

											$list[$list_key]['title'] = date('h:i a',strtotime($workshift['WorkShift']['from'])) . ' - ' .  date('h:i a',strtotime($workshift['WorkShift']['to']));
											$$list[$list_key]['start'] =	$workshift['WorkSchedule']['day'].' '.$workshift['WorkShift']['from'];
											$list[$list_key]['end']  = $workshift['WorkSchedule']['day'].' '.$workshift['WorkShift']['to'];
											$list[$list_key]['color'] = '#F57821';
									} 
								}



								if (date("w",strtotime($dateNow)) == 0) {
									$list[$list_key]['title'] = 'Rest Day';
									$list[$list_key]['start'] =	$workshift['WorkSchedule']['day'].' '.$workshift['WorkShift']['from'];
									$list[$list_key]['end']  = $workshift['WorkSchedule']['day'].' '.$workshift['WorkShift']['to'];
									$list[$list_key]['color'] = '#6237A5';
								}



								if (!empty($workSched)) {

									if ($dateNow == $workSched['WorkSchedule']['day']) {
										$list[$list_key]['className'] = 'selected_date';
									}
									
								}
						

								
							
						}

					$list_key++;
					}


					return $list;

		}
	}

  }
