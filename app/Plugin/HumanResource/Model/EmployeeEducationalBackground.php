<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class EmployeeEducationalBackground extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'EmployeeEducationalBackground';

 	public function saveEducation($data = null,$employeeId = null,$auth = null){

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