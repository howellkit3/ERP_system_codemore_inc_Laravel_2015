<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Employee extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Employee';

    public $actsAs = array('Containable');
    
    public function bind($model = array('Group')){

		$this->bindModel(array(
			'hasOne' => array(
				'EmployeeAdditionalInformation' => array(
					'className' => 'EmployeeAdditionalInformation',
					'foreignKey' => 'employee_id',
					'dependent' => true
				)
			)
		),false);

		$this->contain($model);
	}

}