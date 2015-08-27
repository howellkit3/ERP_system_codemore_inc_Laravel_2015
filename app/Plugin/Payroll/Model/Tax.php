<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Tax extends AppModel {

    public $useDbConfig = 'koufu_payrolls';

    var $useTable = 'taxes';

    public $name = 'Tax';

    public $actsAs = array('Containable');

 	 public function bind($model = array('Group')){
 	 	
		$this->bindModel(
			array(
			'belongsTo' => array(
				'TaxDeduction' => array(
					'className' => 'Payroll.TaxDeduction',
					'foreignKey' => false,
					'conditions' => array('TaxDeduction.type' => 'Tax.type')

					)
								)
			),false);

		$this->contain($model);
	}

	public function getDeductions($data = null) {

		if (!empty($data)) {
			
			$tax = array();

			foreach ($data as $key => $value) {
				
				$tax[$key] = $value;
				$deductions = $this->find('all',array('conditions' => array('Tax.type' => $value['TaxDeduction']['type'])));
			
				$tax[$key]['Tax'] = $deductions;
			}
		}

		return $tax;
		
	}
}