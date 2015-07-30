<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Attendance extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Attendance';

    public $actsAs = array('Containable');
    
     public function bind($model = array('Group')){

		$this->bindModel(array(
			'hasMany' => array(

				
				),
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
				)
			),false);

		$this->contain($model);
	}



	public function saveRecord($data = null,$sched_id = null) {

		if (!empty($data)) {

			$sched = [];

			$sched['Attendance']['id'] = !empty($data['Attendance']['id']) ? $data['Attendance']['id'] : '';

			if ($data['model'] == 'Employee') {
			
			$sched['Attendance']['employee_id'] = $data['foreign_key'];
				
			}

			$sched['Attendance']['date'] = $data['day'];
			$sched['Attendance']['schedule_id'] = $sched_id;
			$sched['Attendance']['type']	= 'work';


			return $this->save($sched['Attendance']);
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

			$attendance = $this->find('first',array('conditions' => $conditions));

			switch ($data['Attendance']['type']) {
				case 'in':
				$attendance['Attendance']['in'] = trim($login[1]);
					break;
				case 'out':
				$attendance['Attendance']['out'] = trim($login[1]);
					break;
			}

			$attendance['Attendance']['notes'] = $data['Attendance']['notes']; 

	
			return $attendance;

		}

	}
	
  }
