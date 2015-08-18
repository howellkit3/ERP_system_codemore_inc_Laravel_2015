<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Amortization extends AppModel {

    public $useDbConfig = 'koufu_payrolls';

    public $name = 'Amortization';
	

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


	public function saveDeductions($deductionId = null,$data = null,$authId = null) {

		if (!empty($data)) {
			
			$amortization = array();

			foreach ($data['Amortization'] as $key => $value) {
					
					$amortization[$key] = $value;	
					$amortization[$key]['deduction_id'] = $deductionId;
					$amortization[$key]['created_by'] = $authId;
					$amortization[$key]['modified_by'] = $authId;
			
			}

			$this->saveAll($amortization);

			return $amortization;
		}

    }
}