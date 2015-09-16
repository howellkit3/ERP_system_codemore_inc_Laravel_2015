<?php
App::uses('AppModel', 'Model');

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
					'foreignKey' => 'employee_id'),
				'EmployeeAdditionalInformation' => array(
					'className' => 'HumanResource.EmployeeAdditionalInformation',
					'foreignKey' => 'employee_id'),
				'SssRecord' => array(
					'className' => 'HumanResource.GovernmentRecord',
					'foreignKey' => 'employee_id',
					'conditions' => array('SssRecord.agency_id' => 1)
					),
				'Position' => array(
					'className' => 'HumanResource.Position',
					'foreignKey' => false,
					'conditions' => array('Position.id = Employee.position_id')
					),
				)
			),false);

		$this->contain($model);
	}

	public function getTotalContribution($data = null,$agency = null){

		if (!empty($agency)) {
			
			$arr = array();

			foreach($data as $key => $item)
			{
				$arr[$item['SalaryReport']['employee_id']][$key] = $item;
			}

			ksort($arr, SORT_NUMERIC);

			return $arr;
		}
	}

	public function createMultipleReport($salaryData = null,$auth = null) {


		if (!empty($salaryData)) {

			$report = array();

			foreach ($salaryData as $key => $value) {

				if ($value['employee_salary_type'] == 'monthly') {

					$report[$key]['basic_pay_month'] = $value['regular'];
					$report[$key]['basic_pay_month'] += $value['special_holiday'];
					$report[$key]['basic_pay_month'] += $value['sunday_work'];
					$report[$key]['basic_pay_month'] += $value['legal_holiday'];
					$report[$key]['basic_pay_month'] += $value['leave'];	

				} else {

					$report[$key]['basic_pay_month'] = $value['regular'];
					$report[$key]['basic_pay_month'] += $value['leave'];	

				}
	
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

				//SSS
				$report[$key]['sss_id'] = !empty($value['sss_id']) ? $value['sss_id'] : '';
				$report[$key]['sss_employees'] = $value['sss'];
				$report[$key]['sss_employers'] = $value['sss_employer'];
				$report[$key]['sss_compensation'] = $value['sss_compensation'];

			}

			if ($this->saveAll($report) ) {
				return true;
			} else {
				return false;
			}

			//return 
		}
	}
}