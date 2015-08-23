<?php
App::uses('Component', 'Controller');

class SalaryComputationComponent extends Component 
{
    public function calculateBenifits($data = null , $pay_sched = null,$customDate = null, $updateDatabase = null, $models = array())
    {
        		
        	$SalaryReport = ClassRegistry::init('SalaryReport');

        	$Deduction = ClassRegistry::init('Deduction');

        	$OvertimeRate = ClassRegistry::init('OvertimeRate')->getOvertimeRate();
			$Holidays = ClassRegistry::init('Holiday');

			$holidays = $Holidays->find('all',array(
			'conditions' => array('Holiday.year' => date('Y',strtotime($customDate['start']))),
			'fields' => array('id','name','start_date','end_date','year','type')
			));

			$models['OvertimeRate'] = $OvertimeRate;
			$models['Holiday'] = $holidays;

        	if (!empty($data)) {

        		$salary = [];

        		foreach ($data as $key => $employee) {

        				$conditions = array('AND' => array(
        					'SalaryReport.employee_id' =>  $employee['Employee']['id'],
        					'SalaryReport.from >=' => $customDate['start'],
        					'SalaryReport.to <='=> $customDate['end']
        				));

        				$checkExisting = $SalaryReport->find('first',array(
        					'conditions' => $conditions
        				));
        				$models['GovernmentRecord'] = !empty($employee['GovernmentRecord']) ? $employee['GovernmentRecord'] : array();
        				$total_pay = 0;
        				$total_deduction = 0;
        				$gross = $this->gross_pay($employee['Attendance'],$employee['Salary'],8,$models);

        				$salary[$key]['id'] = !empty($checkExisting['SalaryReport']['id']) ? $checkExisting['SalaryReport']['id'] : '';
        				$salary[$key]['employee_id'] = $employee['Employee']['id'];
        				$salary[$key]['salary_type'] = ($pay_sched == 'first') ? 'first' : 'second';
        				$salary[$key]['from'] = $customDate['start'];
        				$salary[$key]['to'] = $customDate['end'];
        				$salary[$key]['days'] = $gross['days'];
      //   				$salary[$key]['total_hour_work'] = !empty( $gross['total_hours'] ) ?  $gross['total_hours'] : number_format(0,2);
      //   				$salary[$key]['gross_pay'] = $gross['gross']; 
						// $salary[$key]['ctpa'] = !empty($employee['Salary']['ctpa']) ? $gross['days'] * $employee['Salary']['ctpa'] : 0; 
						// $salary[$key]['sea'] = !empty($employee['Salary']['sea']) ? $gross['days'] * $employee['Salary']['sea'] : 0;
						// $salary[$key]['allowance'] = !empty($employee['Salary']['allowances'])  ? $employee['Salary']['allowances'] : 0;						
						// $salary[$key]['sss'] = $this->sss_pay($employee['Attendance'],$employee['Salary'],$pay_sched,$gross['gross']);
						// $salary[$key]['philhealth'] = $this->philhealth_pay($employee['Attendance'],$employee['Salary'],$pay_sched,$gross['gross']);
						// $salary[$key]['regular_work'] =  !empty($gross['regular']) ? $gross['regular'] : number_format(0,2) ;
						// $salary[$key]['regular_work_ot'] = !empty($gross['OT']) ? $gross['OT'] : number_format(0,2) ;
						// $salary[$key]['night_diff'] = number_format($gross['night_diff'],2);
						// $salary[$key]['night_diff'] = number_format($gross['night_diff_ot'],2);
						// $salary[$key]['legal_holiday'] =  !empty($gross['legal_holiday']) ? $gross['legal_holiday'] : number_format(0,2);
						// $salary[$key]['legal_holiday_work'] =  !empty($gross['legal_holiday_work']) ? $gross['legal_holiday_work'] : number_format(0,2);
						// $salary[$key]['legal_holiday_work_ot'] =  number_format(0,2);
						// $salary[$key]['legal_holiday_work_ot'] =  number_format(0,2);
        			
        				$salary[$key]['sss'] = $this->sss_pay($employee['Attendance'],$employee['Salary'],$pay_sched,$gross['gross'], $models );
						$salary[$key]['philhealth'] = $this->philhealth_pay($employee['Attendance'],$employee['Salary'],$pay_sched,$gross['gross'] , $models);
						$salary[$key]['pagibig'] = $this->pagibig_pay($employee['Attendance'],$employee['Salary'],$pay_sched,$gross['gross'] , $models);
						
						//ctpa 
						$salary[$key]['ctpa'] = !empty($employee['Salary']['ctpa']) ? $gross['days'] * $employee['Salary']['ctpa'] : 0; 
						$salary[$key]['sea'] = !empty($employee['Salary']['sea']) ? $gross['days'] * $employee['Salary']['sea'] : 0;
						

						foreach ($gross as $gross_key => $gross_value) {
							$salary[$key][$gross_key] = $gross_value;
						}

						//additional income 
						$salary[$key]['total_pay'] =  $gross['gross']; $total_pay = $gross['gross'];

						//ctpa computations = 
						$total_pay 	+= !empty($employee['Salary']['ctpa']) ? $employee['Salary']['ctpa'] : number_format(0,2);
						$total_pay  += !empty($employee['Salary']['sea']) ? $employee['Salary']['sea'] : number_format(0.2);

						$salary[$key]['gross_pay'] = $total_pay;
						$total_pay  += $employee['Salary']['allowances'];
						//check deductions 
						$deductions = $this->checkDeductions($employee['Employee']['id'],$customDate,$updateDatabase);

						if (!empty($deductions)) {

							foreach ($deductions as $deductionKey => $value) {
								$salary[$key][$value['type']] = $value['amount'];
								$total_deduction += $value['amount'];
							}							
						}

						$salary[$key]['total_deduction'] = $total_deduction; 
							
						$total_pay  -= $total_deduction;
						//$total_pay  -= $salary[$key]['sss'];
						$salary[$key]['total_pay'] = $total_pay;

        		}


        		return $salary;

        	}
    }


	public function gross_pay($attendance = null,$salaries = null,$hours = 8, $models = array()) {

		$data['gross'] = number_format(0,2);
		$data['time_work'] = number_format(0,2);
		$data['days'] = 0;
		$data['total_hours'] = number_format(0,2);
		$data['hours_ot'] = number_format(0,2);
		$data['regular'] = number_format(0,2);
		$data['OT'] = number_format(0,2);
		$data['legal_holiday'] = number_format(0,2);
		$data['legal_holiday_work'] = number_format(0,2);
		$data['total'] =  number_format(0,2);
		$data['total_hours'] =  number_format(0,2);
		$data['hours_ot'] =  number_format(0,2);
		$data['regular'] =  number_format(0,2);
		$data['OT'] =  number_format(0,2);
		$data['night_diff'] =  number_format(0,2);
		$data['night_diff_ot'] =  number_format(0,2);
		$data['legal_holiday'] =  number_format(0,2);
		$data['legal_holiday_work'] =  number_format(0,2);
		$data['night_diff_legal_holiday'] =  number_format(0,2);
		$data['night_diff_legal_holiday_work'] =  number_format(0,2);
		$data['special_holday'] =  number_format(0,2);
		$data['special_holday_work'] =  number_format(0,2);
		$data['night_diff_special_holday'] =  number_format(0,2);
		$data['night_diff_special_holday_work'] =  number_format(0,2);
		$data['sunday_work'] =  number_format(0,2);
		$data['sunday_work_ot'] =  number_format(0,2);
		$data['night_diff_sunday_work'] =  number_format(0,2);
		$data['night_diff_sunday_work_ot'] =  number_format(0,2);

		if (!empty($attendance)) {

			foreach ($attendance as $key => $days) {
				//$data['time_work'] += $days['total_hours'];
				$work[$key] = $this->checkDays($days,$salaries, 8 , $models );

				foreach ( $work[$key] as $pay_keys => $list) {

						if (in_array($pay_keys,array('regular','OT','legal_holiday','legal_holiday_work','night_diff_legal_holiday', 'night_diff_legal_holiday_work', 'special_holday', 'special_holday_work', 'night_diff_special_holday', 'night_diff_special_holday_work','sunday_work','sunday_work_ot','night_diff_sunday_work','night_diff_sunday_work_ot'))) {
							$data[$pay_keys] += $list;
							$data['gross'] += $list;
						}
				}
				
			}

			$data['days'] = count($attendance);

		}
		return $data;
	}

	public function checkDays ($data = null,$salaries = null,$hours = 8,$models = array()) {

	$days = array();
	
	//get regular days
	$days['total_hours'] = 0;
	$days['hours_ot'] = 0;
	$days['regular'] = 0;
	$days['OT'] = 0;
	$days['night_diff'] = 0;
	$days['night_diff_ot'] = 0;
	$days['legal_holiday'] = 0;
	$days['legal_holiday_work'] = 0;
	$days['night_diff_legal_holiday'] = 0;
	$days['night_diff_legal_holiday_work'] = 0;
	$days['special_holday'] = 0;
	$days['special_holday_work'] = 0;
	$days['night_diff_special_holday'] = 0;
	$days['night_diff_special_holday_work'] = 0;
	$days['sunday_work'] = 0;
	$days['sunday_work_ot'] = 0;
	$days['night_diff_sunday_work'] = 0;
	$days['night_diff_sunday_work_ot'] = 0;


	if (!empty($data['Attendance']['in']) && !empty($data['Attendance']['out']) ) {

		if (strtotime($data['Attendance']['in']) >= strtotime($data['WorkShift']['from'])) {
						
			$from = new DateTime($data['Attendance']['in']);

			$to = new DateTime($data['Attendance']['out']);

			if ($data['Attendance']['out'] > $data['WorkShift']['to']) {
				
				$to = new DateTime( $data['WorkShift']['to'] );

			}
						
			$days['total_hours'] =  $from->diff($to)->format('%h.%i'); 

			if (!empty($data['BreakTime']['id'])) {

				if (strtotime($data['Attendance']['out']) >= strtotime($data['BreakTime']['from']) && strtotime($data['Attendance']['out']) >= strtotime($data['BreakTime']['to'])) {
			
					$days['total_hours'] -= 1;
				}
			}						
		}

		if ($data['Attendance']['type'] == 'rest_day') {
			
			//sunday work is 1.3
			$days['sunday_work'] = ($salaries['basic_pay'] * $days['total_hours'] * 1.3) / $hours;	

			//check if OT
			if (!empty($data['Attendance']['overtime_id'])) {
					
					$data['hours_ot'] = 0;
					
					//$Overtime = ClassRegistry::init('Overtime');

					//$overtime = $Overtime->read(null,$data['Attendance']['overtime_id']);
					if  ($data['Attendance']['out'] > $data['WorkShift']['to']) {
						
						$from  =  new DateTime($data['WorkShift']['to']);
						$to  =  new DateTime($data['Attendance']['out']);

						$days['hours_ot'] =  $from->diff($to)->format('%h.%i'); 
					}

			//sunday work ot rate is 1.3
			$days['sunday_work_ot'] = ($salaries['basic_pay'] * $days['hours_ot'] * 1.3 * 1.3 ) / $hours;

			}

			//legal holiday
			$days['sunday_legal_holiday'] = ($salaries['basic_pay'] * $days['hours_ot'] * 2 * 1.3 ) / $hours;
			//legal holiday work
			$days['sunday_work_legal_holiday'] = ($salaries['basic_pay'] * $days['hours_ot'] * 2 * 1.3 ) / $hours;


		} else {

			$days['regular'] = ($salaries['basic_pay'] * $days['total_hours']) / $hours;

			//check if OT
			if (!empty($data['Attendance']['overtime_id'])) {
				$data['hours_ot'] = 0;
				$Overtime = ClassRegistry::init('Overtime');

				//$overtime = $Overtime->read(null,$data['Attendance']['overtime_id']);

				if  ($data['Attendance']['out'] > $data['WorkShift']['to']) {
					
					$from  =  new DateTime($data['WorkShift']['to']);
					$to  =  new DateTime($data['Attendance']['out']);

					$days['hours_ot'] =  $from->diff($to)->format('%h.%i'); 
				}
				
				//regular ot is 1.25	
				$days['OT'] = ($salaries['basic_pay'] * $days['hours_ot'] * 1.25 ) / $hours;

			}

		}
		

	}

	$today = date('Y-m-d',strtotime($data['Attendance']['date']));

	foreach ($models['Holiday'] as $holiday_key => $holiday) {
		
		if ($today >= $holiday['Holiday']['start_date'] && $today >= $holiday['Holiday']['end_date']) {
		
		$days['regular'] = 0.0;
		
		$days['OT'] = 0.0;

		//legal holiday
		if ($holiday['Holiday']['type'] == 'regular') {

			$days['legal_holiday'] = ($salaries['basic_pay'] * $hours ) / $hours;
		}

		if ($holiday['Holiday']['type'] == 'special') {

			$days['legal_holiday'] = ($salaries['basic_pay'] * $hours ) / $hours;
			
		}

		//if employee work in legal holiday
		if (!empty($data['Attendance']['in']) && !empty($data['Attendance']['out']) ) {

				if ($holiday['Holiday']['type'] == 'regular') {
					$days['legal_holiday_work'] = ($salaries['basic_pay'] * $days['total_hours']) / $hours;
				}

				if ($holiday['Holiday']['type'] == 'special') {
					$days['legal_holiday_work'] = ($salaries['basic_pay'] * $days['total_hours']) / $hours;
				}

			}

		}

	}
		
		return $days;


	}

	public function sss_pay( $attendance = null,$salaries = null,$sched = 'first',$gross_pay = 0,$models = array()){
		

		//sss agency id = 1;
		$pay = number_format(0,2);
		$government_record = array();

		if  (!empty($models['GovernmentRecord'])) {

			foreach ($models['GovernmentRecord'] as $key => $gov_values) {
				$government_record[$gov_values['agency_id']] = $gov_values['value'];
			}
		}
		
		if ( $gross_pay != 0 && (!empty($government_record[1])) ) {
				
				$SssRange = ClassRegistry::init('SssRange');
				
				$conditions = array('SssRange.range_from <=' => $gross_pay, 'SssRange.range_to >=' => $gross_pay);
				
				$range = $SssRange->find('first',array('conditions' => $conditions ));

				$pay = !empty($range['SssRange']['employees']) ? $range['SssRange']['employees'] : $pay;
		}

		return $pay;

	}

	public function philhealth_pay($attendance = null,$salaries = null,$sched = 'first',$gross_pay = 0 ,$models = array()){

		//sss agency id = 2;

		$pay = number_format(0,2);
		$government_record = array();

		if  (!empty($models['GovernmentRecord'])) {

			foreach ($models['GovernmentRecord'] as $key => $gov_values) {
				$government_record[$gov_values['agency_id']] = $gov_values['value'];
			}
		}

		if ( $gross_pay != 0 && (!empty($government_record[2])) ) {
				
				$SssRange = ClassRegistry::init('PhilHealthRange');
				$conditions = array('PhilHealthRange.range_from >=' => $gross_pay);
				$range = $SssRange->find('first',array('conditions' => $conditions ));
				$pay = !empty($range['PhilHealthRange']['employee']) ? $range['PhilHealthRange']['employee'] : $pay;
			
		}

		return $pay;

	}


	public function pagibig_pay($attendance = null,$salaries = null,$sched = 'first',$gross_pay = 0,$models = array()){

		//sss agency id = 2;
		$pay = number_format(0,2);
		$government_record = array();

		if  (!empty($models['GovernmentRecord'])) {

			foreach ($models['GovernmentRecord'] as $key => $gov_values) {
				$government_record[$gov_values['agency_id']] = $gov_values['value'];
			}
		}
		
		if ( ($gross_pay != 0 && !empty($attendance['Agency'])) && in_array(2,$attendance['Agency'])) {
				
				$phRange = ClassRegistry::init('PhilHealthRange');
				$conditions = array('PhilHealthRange.range_from >=' => $gross_pay);
				$range = $phRange->find('first',array('conditions' => $conditions ));
				$pay = !empty($range['PhilHealthRange']['employee']) ? $range['PhilHealthRange']['employee'] : $pay;
				$pay = $range['PhilHealthRange']['employees'];
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

	public function checkDeductions($employee_id = null,$customDate = null , $update = false){

		if (!empty($employee_id)) {

			$Deduction = ClassRegistry::init('Payroll.Deduction');

			$Amortization = ClassRegistry::init('Payroll.Amortization');

			$conditions = array('Deduction.from >=' => $customDate['start'],'Deduction.to <=' => date('Y-m-t',strtotime($customDate['end'])),'Deduction.employee_id' => $employee_id );

			$deductions = $Deduction->find('all',array('conditions' => $conditions ));

			$my_deductions = array();

			foreach ($deductions as $deduction_key => $deduct) {
				
				$my_deductions[$deduction_key]['id'] =  $deduct['Deduction']['id'];
				$my_deductions[$deduction_key]['type'] =  $deduct['Deduction']['type'];
				$my_deductions[$deduction_key]['mode'] =  $deduct['Deduction']['mode'];
				$my_deductions[$deduction_key]['amount'] = 0;
				
				$conditions = array(
					'Amortization.payroll_date >=' => $customDate['start'] , 
					'Amortization.payroll_date <=' => $customDate['end'] ,
					'Amortization.deduction_id' => $deduct['Deduction']['id'],
					'Amortization.status' => 0
				);

				$amortizations = $Amortization->find('all',array('conditions' => $conditions ));	
		
				$amortizationIds = [];

				foreach ($amortizations as $amortization_key => $amortization) {
						$amortizationIds[] = 	$amortization['Amortization']['id'];
						$my_deductions[$deduction_key]['amount'] += $amortization['Amortization']['deduction'];
						if ($update == true) {
							$save['id'] = $amortization['Amortization']['id'];
							$save['status'] = 1;
							$Amortization->save($save);
						}
						
				}

				//check if no amortization left
				$amort = $Amortization->find('all',array( 
					'conditions' => array('Amortization.id' => $amortizationIds, 'status' => 0)));
					
				if (empty($amort) &&  $update == true) {

					$save['id'] = $deduct['Deduction']['id'];
					$save['status'] = 1;
					$Deduction->save($save);
				}

			}

			return $my_deductions;
			
		}
	}





}
?>