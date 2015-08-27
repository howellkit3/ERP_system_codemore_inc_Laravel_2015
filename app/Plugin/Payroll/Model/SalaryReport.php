<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class SalaryReport extends AppModel {

    public $useDbConfig = 'koufu_payrolls';

    public $name = 'SalaryReport';

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

	public function createReport($salaryData = null,$auth = null) {

		if (!empty($salaryData)) {

			$report = array();

			foreach ($salaryData as $key => $value) {
				
				$report[$key]['employee_id'] = $value['employee_id'];
				$report[$key]['salary_type'] = $value['salary_type'];
				$report[$key]['days']	=	$value['days'];
				$report[$key]['from'] = $value['from'];
				$report[$key]['to'] = $value['to'];
				$report[$key]['gross'] = $value['gross'];
				$report[$key]['total_deduction'] = $value['total_deduction'];
				$report[$key]['allowances'] = !empty($value['allowances']) ? $value['allowances'] : 0 ;
				$report[$key]['incentives'] = !empty($value['incentives']) ? $value['incentives'] : 0;
				$report[$key]['total_pay'] = $value['total_pay'];
				$report[$key]['created_by'] = $auth['id'];
				$report[$key]['modified_by'] = $auth['id'];

			}

			return $this->saveAll($report);
		}
	}
}