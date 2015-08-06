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

			$info['employee_id'] = $data['employee_id'];
			$info['date'] = $data['date'];
			
			return $this->save($info);
		}
	}


}