<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Tax extends AppModel {

    public $useDbConfig = 'koufu_payrolls';

    var $useTable = 'taxes';

    public $name = 'Tax';

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