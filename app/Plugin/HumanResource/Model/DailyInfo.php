<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class DailyInfo extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

	public $recursive = -1;

	public $name = 'DailyInfo';

	public $actsAs = array('Containable');
    
    public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Employee' => array(
					'className' => 'Employee',
					'foreignKey' => false,
					'conditions' => array('Employee.id = DailyInfo.employee_id')
				),
				
			),
			'hasMany' => array (
				'Attendance' => array(
					'className' => 'Attendance',
					'foreignKey' => false,
					'conditions' => array('Attendance.employee_id = DailyInfo.employee_id')
				))
		),false);

		$this->contain($model);
	}

	public function saveDailyInfo($data) {

		$info = [];

		if (!empty($data)) {

			if (!empty($data['type']) && $data['type'] == 'monthly') {
							
				$date = explode('-',$data['date']);

				$days1 = explode('/',trim($date[0]));
				$days2 = explode('/',trim($date[1]));

				ini_set('max_execution_time', 3600);
				ini_set('memory_input_time', 1024);
				ini_set('max_input_nesting_level', 1024);
				ini_set('memory_limit', '1024M');

				for ($days_count = $days1[2];$days_count <= $days2[2]; $days_count++) :
					$this->create();
					//$sched['Attendance']['date'] = $days1[0].'-'.$days1[1].'-'.sprintf("%02d",$days_count);
					$info['employee_id'] = $data['employee_id'];
					$info['date'] = $days1[0].'-'.$days1[1].'-'.sprintf("%02d",$days_count);
					$this->save($info);
					//pr($info);
				endfor;
				//exit;
			} else {
				
				$info['employee_id'] = $data['employee_id'];
				$info['date'] = $data['date'];
				$this->save($info);

				return $this->id;

			}

			
		}
	}


}