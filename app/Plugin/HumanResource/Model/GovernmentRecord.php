<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class GovernmentRecord extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'GovernmentRecord';

 	public function saveRecord($data = null,$employeeId = null){

 		if (!empty($data)) {

 			$record = array();

 			foreach ($data as $key => $values) {
 				$record[$key] = $values;
 				$record[$key]['employee_id'] = $employeeId;
 
 			}
 			
			$this->saveAll($record);
 		}
 	}
}