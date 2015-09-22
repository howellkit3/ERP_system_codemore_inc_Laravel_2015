<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class OvertimeExcess extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'OvertimeExcess';

    var $useTable = 'overtime_excess';

    public $actsAs = array('Containable');

      public function bind($model = array('Group')){

		$this->bindModel(
			array(
			'belongsTo' => array(
				'Employee' => array(
					'className' => 'Employee',
					'foreignKey' => 'employee_id')
								)
			),false);

		$this->contain($model);
	}
    

    public function saveExcess($overtimeLimit = null,$attendance = null,$auth = null){

    	if (!empty($overtimeLimit)) {

    		$overtime = array();
			$overtime['overtime_id'] = $attendance['Attendance']['overtime_id'];
			$overtime['employee_id'] = $attendance['Attendance']['employee_id'];
			$overtime['attendance_id'] = $attendance['Attendance']['id'];
    		$overtime['from'] = $attendance['Attendance']['in'];
    		$overtime['to'] = $attendance['Attendance']['out'];
    		$overtime['used_time'] = $overtimeLimit['OvertimeLimit']['used'];
    		$overtime['created_by'] = $auth['id'];
    		$overtime['modified_by'] = $auth['id'];

    		
    		return $this->save($overtime);
		}
    }

}