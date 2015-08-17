<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Leave extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Leave';

    public $actsAs = array('Containable');

    public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Employee' => array(
					'className' => 'Employee',
					'foreignKey' => false,
					'conditions' => array('Employee.id = Leave.employee_id')
				),
				'Type' => array(
					'className' => 'Type',
					'foreignKey' => false,
					'conditions' => array('Type.id = Leave.type_id')
				),
				
			)
			// 'hasMany' => array (
			// 	'Attendance' => array(
			// 		'className' => 'Attendance',
			// 		'foreignKey' => false,
			// 		'conditions' => array('Attendance.employee_id = DailyInfo.employee_id')
			// 	))
		),false);

		$this->contain($model);
	}

	public function saveLeave($leaveData = null , $userId){

		if (!empty($leaveData)) {

			$this->create();
			
			$leaveData['Leave']['id'] = !empty($leaveData['Leave']['id']) ? $leaveData['Leave']['id'] : '';

			$leaveData['Leave']['created_by'] = $userId;

			$leaveData['Leave']['modified_by'] = $userId;
			
			return $this->save($leaveData);
		}
		
	}

}