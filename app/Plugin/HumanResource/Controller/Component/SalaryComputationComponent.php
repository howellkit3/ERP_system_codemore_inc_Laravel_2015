<?php
App::uses('Component', 'Controller');
//namespace App\Controller\Component;

//use Cake\Controller\Component;

class SalaryComputationComponent extends Component 
{
    public function calculateBenifits($data = null , $pay_sched = null,$customDate = null)
    {
        		
        	$SalaryReport = ClassRegistry::init('SalaryReport');
        	$Deduction = ClassRegistry::init('Deduction');
        	
        	if (!empty($data)) {

        		$salary = [];


        		foreach ($data as $key => $employee) {

        				$conditions = array('AND' => array(
        					'SalaryReport.employee_id' =>  $employee['Employee']['id'],
        					'SalaryReport.from >=' => $customDate['start'],
        					'SalaryReport.to <='=> $customDate['end']
        					));


        				$checkExisting = $SalaryReport->find('first',array(
        					'conditions' => $conditions,

        					));

        				$total_net_pay = 0;

        				$gross = $this->gross_pay($employee['Attendance'],$employee['Salary']);
        				$salary[$key]['id'] = !empty($checkExisting['SalaryReport']['id']) ? $checkExisting['SalaryReport']['id'] : '';
        				$salary[$key]['employee_id'] = $employee['Employee']['id'];
        				$salary[$key]['salary_type'] = ($pay_sched == 'first') ? 'first' : 'second';
        				$salary[$key]['from'] = $customDate['start'];
        				$salary[$key]['to'] = $customDate['end'];
        				$salary[$key]['days'] = $gross['days'];
        				$salary[$key]['total_hour_work'] = $gross['time_work'];
        				$salary[$key]['gross_pay'] = $gross['gross']; $total_net_pay = $gross['gross'];
						$salary[$key]['ctpa'] = !empty($employee['Salary']['ctpa']) ? $employee['Salary']['ctpa'] : 0; $total_net_pay += $employee['Salary']['ctpa'];
						$salary[$key]['sea'] = !empty($employee['Salary']['sea']) ? $employee['Salary']['sea'] : 0; $total_net_pay += $employee['Salary']['sea'];
						$salary[$key]['allowance'] = $employee['Salary']['allowances'];						
						$salary[$key]['sss'] = $this->sss_pay($employee['Attendance'],$employee['Salary'],$pay_sched,$gross['gross']);

						//check deductions 
						$deductions = $this->checkDeductions($employee['Employee']['id'],$customDate);

						if (!empty($deductions['All'])) {

							foreach ($deductions['All'] as $key => $value) {

								$salary[$key][$value['Deduction']['type']] = $value['Deduction']['amount'];
								//update deductions
								$Deduction->updateAll(
			                            array('Deduction.paid_amount' => 'Deduction.paid_amount+'.$value['Deduction']['amount']),                    
			                            array('Deduction.id' => $value['Deduction']['id'])
			                        );
								//$Deduction->save($saveDeduction);
							}

							$salary[$key]['total_deduction'] = $deductions['total_deduction'];
						}
						

						$salary[$key]['total_pay'] = $total_net_pay;

        		}


        		return $salary;

        	}
    }


	public function gross_pay($attendance = null,$salaries = null,$hours = 8) {

		$data['gross'] = number_format(0,2);
		$data['time_work'] = number_format(0,2);
		$data['days'] = 0;


		if (!empty($attendance)) {

			foreach ($attendance as $key => $days) {

				$data['time_work'] += $days['total_hours'];
			}

			$data['gross'] = ($salaries['basic_pay'] * $data['time_work']) / $hours;
			$data['days'] = count($attendance);

		}
		return $data;
	}

	public function sss_pay( $attendance = null,$salaries = null,$sched = 'first',$gross_pay = 0 ){
		//sss agency id = 1;

		$pay = number_format(0,2);
		
		if ( $gross_pay != 0 && (!empty($attendance['Agency']) && in_array(1,$attendance['Agency']) ) ) {
				
				$SssRange = ClassRegistry::init('SssRange');
				
				$conditions = array('SssRange.range_from <=' => $gross_pay, 'SssRange.range_to >=' => $gross_pay);
				
				$range = $SssRange->find('first',array('conditions' => $conditions ));

				$pay = !empty($range['SssRange']['employees']) ? $range['SssRange']['employees'] : $pay;
		}

		return $pay;

	}

	public function philhealth_pay($attendance = null,$salaries = null,$sched = 'first',$gross_pay = 0 ){

		//sss agency id = 2;

		$pay = number_format(0,2);
		
		if ( $gross_pay != 0 && in_array(2,$attendance['Agency'])) {
				
				$SssRange = ClassRegistry::init('PhilHealthRange');
				$conditions = array('PhilHealthRange.range_from >=' => $gross_pay);
				$range = $SssRange->find('first',array('conditions' => $conditions ));
				$pay = !empty($range['PhilHealthRange']['employee']) ? $range['PhilHealthRange']['employee'] : $pay;
				//$pay = $range['PhilHealthRange']['employees'];
		}

		return $pay;

	}


	public function computeMonthlySalary($data = null){


			if (!empty($data)) {
				
				$empData = [];

				//sort by employee_id
				$sorted = [];

				foreach($data as $key => $item)
				{
					$sorted[$item['SalaryReport']['employee_id']][$key] = $item;
				}

				ksort($sorted, SORT_NUMERIC);

				foreach ($sorted as $sortedKey => $emp) {
					
						$empData[$sortedKey]['employee_id'] = $sortedKey;
						$empData[$sortedKey]['first_half'] = '0.00';
						$empData[$sortedKey]['second_half'] = '0.00';

						foreach ($emp as $empKey => $salary) {

							$empData[$sortedKey]['Employee'] = $salary['Employee'];

							if ($salary['SalaryReport']['salary_type'] == 'first') {
								$empData[$sortedKey]['first_half'] = $salary['SalaryReport']['total_pay'];
							}
							if ($salary['SalaryReport']['salary_type'] == 'second') {
								$empData[$sortedKey]['second_half'] = $salary['SalaryReport']['total_pay'];
							}
							
						}				
				}


				return $empData;
			
			}

	}

	public function checkDeductions($employee_id = null,$customDate = null){


		if (!empty($employee_id)) {

			$Deduction = ClassRegistry::init('Deduction');

			$conditions = array('Deduction.from >=' => $customDate['start']);

			$deductions['All'] = $Deduction->find('all',array('conditions' => $conditions ));

			//pr($deductions); exit();

			$code = [];

			$dedcution = [];

			$amount = $deductions['total_deduction'] = number_format(0,2);

			foreach ($deductions['All'] as $key => $less) {

				$deductions['All'][$key] = $less;

				if ($less['Deduction']['amount'] != $less['Deduction']['paid_amount']) {

					if ($less['Deduction']['mode'] == 'installment') {
						
						$amount = $less['Deduction']['amount'] / $less['Deduction']['pay_split'];
						$deductions['All'][$key]['Deduction']['amount'] = $amount;

					}

					$deductions['total_deduction'] += $amount;
				
				}		
					
			}

			return $deductions;

		}

	}
}
?>