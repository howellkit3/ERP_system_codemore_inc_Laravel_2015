<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Timekeep extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Timekeep';

    public $actsAs = array('Containable');
    
     public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Employee' => array(
					'className' => 'Employee',
					'foreignKey' => false,
					'conditions' => array('Employee.id = Timekeep.employee_id'),
					'dependent' => true,
				))
		),false);

		$this->contain($model);
	}
	

	public function saveTime($data = null,$attendance_id = null,$authId = null) {
		
		if (!empty($data)) {
			
			$time = array();

			$date = !empty($data['Attendance']['time']) ? explode(' ',$data['Attendance']['time']) : '';

	
			$time['Timekeep']['employee_id'] = $data['Attendance']['employee_id'];
			$time['Timekeep']['date'] = !empty($date[0]) ? date('Y-m-d',strtotime($date[0])) : date('Y-m-d');
			$time['Timekeep']['time'] = !empty($date[1]) ? trim($date[1]) : date('h:i:ss');
			$time['Timekeep']['notes'] = $data['Attendance']['notes'];
			$time['Timekeep']['type'] = $data['Attendance']['type'];
			$time['Timekeep']['created_by'] = $authId;
			$time['Timekeep']['modified_by'] = $authId;
			
			return $this->save($time);
		
		}
	}

  }
