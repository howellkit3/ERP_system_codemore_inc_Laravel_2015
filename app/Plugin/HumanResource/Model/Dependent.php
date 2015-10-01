<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Dependent extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Dependent';

 	public function saveDependent($data = null,$employeeId = null,$auth = null){

 		if (!empty($data)) {

 			$record = array();

 			foreach ($data as $key => $values) {
 				$record[$key] = $values;
 				$record[$key]['employee_id'] = $employeeId;
 				$record[$key]['created_by'] = $auth;
 				$record[$key]['modified_by'] = $auth;
 				$this->save($record[$key]);
 			}
 			
			
 		}
 	}
}