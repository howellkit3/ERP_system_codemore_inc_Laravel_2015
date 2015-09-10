<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class Deduction extends AppModel {

    public $useDbConfig = 'koufu_payrolls';

	public $recursive = -1;

	public $name = 'Deduction';

	public $actsAs = array('Containable');
    
    public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Employee' => array(
					'className' => 'Employee',
					'foreignKey' => false,
					'conditions' => array('Employee.id = Deduction.employee_id')
				),
				'Loan' => array(
					'className' => 'Loan',
					'foreignKey' => 'loan_id',
					//'conditions' => array('Loan.id = Deduction.employee_id')
				),				
			
			),
			'hasMany' => array(
				'Amortization' => array(
					'className' => 'Amortization',
					'foreignKey' => 'deduction_id',
					'conditions' => ''
				)
			)

		),false);

		$this->contain($model);
	}

}