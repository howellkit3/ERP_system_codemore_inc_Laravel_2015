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

		$schedule = [];

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


	

    
  }
