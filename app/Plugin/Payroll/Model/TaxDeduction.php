<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class TaxDeduction extends AppModel {

    public $useDbConfig = 'koufu_payrolls';

    public $name = 'TaxDeduction';

    var $useTable = 'taxes_deductions';

    public $actsAs = array('Containable');

 	 public function bind($model = array('Group')){
 	 	
		$this->bindModel(
			array(
			'belongsTo' => array(
				'Employee' => array(
					'className' => 'HumanResource.Employee',
					'foreignKey' => 'employee_id')
								)
			),false);

		$this->contain($model);
	}
}