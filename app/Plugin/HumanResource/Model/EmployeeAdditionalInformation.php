<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class EmployeeAdditionalInformation extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'EmployeeAdditionalInformation';

   	public function saveInfo($employeeId = null,$data) {

   		$id = '';

   		if (!empty($data)) {

   			$data['employee_id'] = $employeeId;

   			if ($this->save($data)) {
   				return $this->id;
   			}

   		}
   		
   		return $id;
   	}

}