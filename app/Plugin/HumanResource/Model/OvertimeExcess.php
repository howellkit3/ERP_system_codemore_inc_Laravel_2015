<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class OvertimeExcess extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'OvertimeExcess';

    var $useTable = 'overtime_excess';

    public $actsAs = array('Containable');

    

    public function saveExcess($overtimeLimit = null,$attendance = null,$auth = null){

    	if (!empty($data)) {

    		$overtime = array();
			$overtime['overtime_id'] = $attendance['Attendance']['overtime_id'];
    		$overtime['from'] = $attendance['Attendance']['in'];
    		$overtime['to'] = $attendance['Attendance']['out'];
    		$overtime['used_time'] = $overtimeLimit['OvertimeLimit']['used'];
    		$overtime['created_by'] = $auth['id'];
    		$overtime['modified_by'] = $auth['id'];

    		return $this->save($overtime);
		}
    }

}