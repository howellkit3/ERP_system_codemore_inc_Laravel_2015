<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class OvertimeDetail extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'OvertimeDetail';

    public $actsAs = array('Containable');


    public function saveDetails($data = array(),$overtimeId = null) {

    	if (!empty($data)) {

    		foreach ($data['OvertimeDetail'] as $key => $list) {
    		
    			$data['OvertimeDetail'][$key]['overtime_id'] = $overtimeId;

    		}	

    		if ($this->saveAll($data['OvertimeDetail'])) {

    			return true;
    		}
    	}
    }
}