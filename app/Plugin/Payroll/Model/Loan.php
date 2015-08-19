<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class Loan extends AppModel {

    public $useDbConfig = 'koufu_payrolls';

	public $recursive = -1;

	public $name = 'Loan';

	public $actsAs = array('Containable');
    
    public function bind($model = array('Group')){
		
		// $this->bindModel(array(
		// 	'belongsTo' => array(
		// 		'Employee' => array(
		// 			'className' => 'Employee',
		// 			'foreignKey' => false,
		// 			'conditions' => array('Employee.id = Deduction.employee_id')
		// 		),
				
		// 	),
		// ),false);

		// $this->contain($model);
	}

}