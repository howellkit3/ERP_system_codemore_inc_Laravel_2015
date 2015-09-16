<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class GovernmentRecord extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'GovernmentRecord';

     public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Employee' => array(
					'className' => 'Employee',
					'foreignKey' => false,
					'conditions' => array('Employee.id = GovernmentRecord.employee_id')
				),
				
				
			)
		),false);

		$this->contain($model);
	}

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