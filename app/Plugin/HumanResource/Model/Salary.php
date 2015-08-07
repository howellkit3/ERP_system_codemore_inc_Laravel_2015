<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Salary extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Salary';

    public $actsAs = array('Containable');

 	 public function bind($model = array('Group')){

		$this->bindModel(array(
			'Employee' => array(
				'Tooling' => array(
					'className' => 'HumanResource.Employee',
					'foreignKey' => 'employee_id',
				))
		),false);

		$this->contain($model);
	}
}