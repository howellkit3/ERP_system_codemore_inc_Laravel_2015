<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Wage extends AppModel {

    public $useDbConfig = 'koufu_payrolls';

    public $name = 'Wage';

    public $actsAs = array('Containable');

 	 public function bind($model = array('Group')){
 	 	
		// $this->bindModel(
		// 	array(
		// 	'belongsTo' => array(
		// 		'Employee' => array(
		// 			'className' => 'HumanResource.Employee',
		// 			'foreignKey' => 'employee_id')
		// 						)
		// 	),false);

		// $this->contain($model);
	}
}