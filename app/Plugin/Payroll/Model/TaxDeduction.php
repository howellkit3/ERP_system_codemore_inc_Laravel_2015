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
			'hasMany' => array(
				'Tax' => array(
					'className' => 'Payroll.Tax',
					'foreignKey' => false,
					'conditions' => array('Tax.type' => 'TaxDeduction.type')	
					)
								)
			),false);

		$this->contain($model);
	}

	public function getDeductions($data = null) {

		if (!empty($data)) {
			
			$tax = array();

			foreach ($data as $key => $value) {
				
				$tax[$key]['Tax'] = $value;
				$deductions = $this->find('all',array('conditions' => array('TaxDeduction.type' => $value['Tax']['type'])));
				$tax[$key]['TaxDeduction'] = $deductions['TaxDeduction'];
			}
		}

		return $tax;
		
	}
}