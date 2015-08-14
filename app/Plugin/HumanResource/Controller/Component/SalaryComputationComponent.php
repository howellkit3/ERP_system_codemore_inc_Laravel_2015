<?php
App::uses('Component', 'Controller');
//namespace App\Controller\Component;

//use Cake\Controller\Component;

class SalaryComputationComponent extends Component 
{
    public function calculateBenifits($data = null , $pay_sched = null,$customDate = null)
    {
        		
        	$SalaryReport = ClassRegistry::init('SalaryReport');
        	
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

        				$gross = $this->gross_pay($employee['Attendance'],$employee['Salary']);
        				$salary[$key]['id'] = !empty($checkExisting['SalaryReport']['id']) ? $checkExisting['SalaryReport']['id'] : '';
        				$salary[$key]['employee_id'] = $employee['Employee']['id'];
        				$salary[$key]['salary_type'] = ($pay_sched == 'first') ? 'first' : 'second';
        				$salary[$key]['from'] = $customDate['start'];
        				$salary[$key]['to'] = $customDate['end'];
        				$salary[$key]['days'] = $gross['days'];
        				$salary[$key]['total_hour_work'] = $gross['time_work'];

        				$salary[$key]['total_pay'] = $gross['gross'];


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
		
		if ( $gross_pay != 0 && in_array(1,$attendance['Agency'])) {
				
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
}
?>