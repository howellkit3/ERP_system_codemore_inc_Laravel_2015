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
					'foreignKey' => 'employee_id'),
				'SSS' => array(
					'className' => 'HumanResource.GovernmentRecord',
					'foreignKey' => 'sss_id',
				),
				'EmployeeAdditionalInformation' =>  array(
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

	public function computeSalary($params = array()) {

		if (!empty($params)) {
		
			$reports = '';

			$months = array( '01' => 'January','02' => 'February','03' => 'March','04' => 'April','05' => 'May','06' => 'June','07' => 'July','08' => 'August','09' =>'September', '10' =>'October','11' => 'November','12' => 'December');

			foreach ($months as $key => $list) {
					
					$conditions = array(
						'SalaryReport.employee_id' => $params['employee_id'],
					);

					$from = $params['year'].'-'.$key.'-01';
					$to = $params['year'].'-'.$key.'-31';

					$conditions = array_merge($conditions,array(
						'date(SalaryReport.from) BETWEEN ? AND ?' => array($from,$to), 
					));

				
					$reports[$list] = $this->find('all',array(
						'conditions' => $conditions,
						'order' => 'SalaryReport.from ASC'
					));


			}

			return $reports;
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