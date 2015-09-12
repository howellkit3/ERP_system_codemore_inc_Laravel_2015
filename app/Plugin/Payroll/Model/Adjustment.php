<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Adjustment extends AppModel {

    public $useDbConfig = 'koufu_payrolls';

    public $name = 'Adjustment';
	
    public $actsAs = array('Containable');

	public function bind($model = array('Group')){

		 // $this->bindModel(array(
		 // 	'belongsTo' => array(
		 // 		'Employee' => array(
		 // 			'className' => 'Employee',
		 // 			'foreignKey' => 'employee_id',
		 // 			'dependent' => true
		 // 		))
		 // ),false);

		 // $this->contain($model);
	}


}