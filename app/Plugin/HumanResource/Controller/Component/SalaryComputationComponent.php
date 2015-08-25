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

        	$Contibutions = ClassRegistry::init('Contribution');

			$holidays = $Holidays->find('all',array(
			'conditions' => array('Holiday.year' => date('Y',strtotime($customDate['start']))),
			'fields' => array('id','name','start_date','end_date','year','type')
			));

			$contributions = $Contibutions->find('list',array('fields' => array('id','schedules')));

			$models['OvertimeRate'] = $OvertimeRate;
			$models['Holiday'] = $holidays;
			$models['Contibution'] = $contributions;

			$workingDays = $this->workingDays($customDate);

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

        				if ($employee['Salary']['employee_salary_type'] == 'daily') {

							$salary[$key] = $this->_dailyRate($employee,$models);
						}
						if ($employee['Salary']['employee_salary_type'] == 'monthly') {

							$salary[$key] = $this->_monthlyRate($employee,$models,8,$workingDays);
						}



        				$salary[$key]['id'] = !empty($checkExisting['SalaryReport']['id']) ? $checkExisting['SalaryReport']['id'] : '';
        				$salary[$key]['employee_id'] = $employee['Employee']['id'];
        				$salary[$key]['salary_type'] = ($pay_sched == 'first') ? 'first' : 'second';
        				$salary[$key]['from'] = $customDate['start'];
        				$salary[$key]['to'] = $customDate['end'];
        				$salary[$key]['days'] = $gross['days'];

      //   				$salary[$key]['sss'] = $this->sss_pay($employee['Attendance'],$employee['Salary'],$pay_sched,$gross['gross'], $models );
						// $salary[$key]['philhealth'] = $this->philhealth_pay($employee['Attendance'],$employee['Salary'],$pay_sched,$gross['gross'] , $models);
						// $salary[$key]['pagibig'] = $this->pagibig_pay($employee['Attendance'],$employee['Salary'],$pay_sched,$gross['gross'] , $models );
						
						// //ctpa 
						// $salary[$key]['ctpa'] = !empty($employee['Salary']['ctpa']) ? $gross['days'] * $employee['Salary']['ctpa'] : 0; 
						// //sea
						// $salary[$key]['sea'] = !empty($employee['Salary']['sea']) ? $gross['days'] * $employee['Salary']['sea'] : 0;
						
						// $salary[$key]['allowances'] =  $employee['Salary']['allowances'];
						
						// foreach ($gross as $gross_key => $gross_value) {
						// 	$salary[$key][$gross_key] = $gross_value;
						// }

						// //additional income 
						// $salary[$key]['total_pay'] = $gross['gross']; 

						// $total_pay = $gross['gross'];

						// //ctpa computations = 
						// $total_pay 	+= !empty($employee['Salary']['ctpa']) ? $salary[$key]['ctpa'] : number_format(0,2);
						// $total_pay  += !empty($employee['Salary']['sea']) ? $salary[$key]['sea'] : number_format(0.2);

						// $salary[$key]['gross_pay'] = $total_pay;
						
						// $salary[$key]['total_earnings']  = $total_pay;
						// $salary[$key]['total_earnings']  += $employee['Salary']['allowances'];
						// $salary[$key]['total_earnings']  += !empty($employee['Salary']['incentives']) ? $employee['Salary']['incentives'] : 0.00;


						// //check deductions 
						// $deductions = $this->checkDeductions($employee['Employee']['id'],$customDate,$updateDatabase);

						// if (!empty($deductions)) {

						// 	foreach ($deductions as $deductionKey => $value) {
						// 		$salary[$key][$value['type']] = $value['amount'];
						// 		$total_deduction += $value['amount'];
						// 	}							
						// }


						// $salary[$key]['total_deduction'] = $total_deduction; 

						// $salary[$key]['total_deduction'] += $salary[$key]['sss'];

						// $salary[$key]['total_deduction'] += $salary[$key]['philhealth'];

						// $salary[$key]['total_deduction'] += $salary[$key]['pagibig'];
							
						// $total_pay  -= $salary[$key]['total_deduction'];

						// $salary[$key]['net_pay'] = $total_pay;

						// $total_pay  += $employee['Salary']['allowances'];

						// //$total_pay  -= $salary[$key]['sss'];
						$salary[$key]['total_pay'] = $total_pay;
						$salary[$key]['Employee'] = $employee['Employee'];
						$salary[$key]['Department'] = !empty($employee['Department']) ? $employee['Department'] : array();
						$salary[$key]['Position']	= !empty($employee['Position']) ? $employee['Position'] : array();


        		}

        	
        		return $salary;

        	}



        	exit();
    }

        private function workingDays($date = null) {


    	if (!empty($date)) {

	    	$from = date('Y-m-01',  strtotime($date['start']) );
	    	$to = date('Y-m-t',  strtotime($date['end']) );

			$datetime1 = new DateTime($from);

			$datetime2 = new DateTime($to);
			$interval = $datetime1->diff($datetime2);

			$working_days = 0;
			
			for($i=0; $i<=$interval->d; $i++){
					$modif = $datetime1->modify('+1 day');
					$weekday = $datetime1->format('w');

				if($weekday != 0 ){ // 0 for Sunday and 6 for Saturday
					$working_days++;  
				}

			}

			return $working_days;
    	}
    }


    private function _total_hours($data = null){ 

    	$days['total_hours'] = 0.00;

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

    	return $days['total_hours'];
    }	

    private function _dailyRate($employee = null, $models = array() ,$hours = 8, $workingDays = 26 ) {

    	$countDays = 0;

    	$data = array();

    	$data['gross'] = number_format(0,2);
		$data['time_work'] = number_format(0,2);
		$data['days'] = 0;
		$data['total_hours'] = number_format(0,2);
		$data['hours_ot'] = number_format(0,2);
		$data['regular'] = number_format(0,2);
		$data['OT'] = number_format(0,2);
		$data['legal_holiday'] = number_format(0,2);
		$data['legal_holiday_work'] = number_format(0,2);
		$data['legal_holiday_work_ot'] = number_format(0,2);
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
		$data['special_holiday'] =  number_format(0,2);
		$data['special_holiday_work'] =  number_format(0,2);
		$data['special_holiday_work_ot'] =  number_format(0,2);
		$data['night_diff_special_holiday'] =  number_format(0,2);
		$data['night_diff_special_holiday_work'] =  number_format(0,2);
		$data['sunday_work'] =  number_format(0,2);
		$data['sunday_work_ot'] =  number_format(0,2);
		$data['night_diff_sunday_work'] =  number_format(0,2);
		$data['night_diff_sunday_work_ot'] =  number_format(0,2);
		$data['leave'] =  number_format(0,2);
		$data['sunday_legal_holiday'] =  number_format(0,2);
		$data['sunday_work_legal_holiday'] =  number_format(0,2);

    	if (!empty($employee)) {

    	foreach ($employee['Attendance'] as $key => $days) {
    				
    			$data['total_hours'] += $this->_total_hours($days);

    			//check if OT
				if (!empty($days['Attendance']['overtime_id'])) {
					
					$data['hours_ot'] = number_format(0,2);

					$Overtime = ClassRegistry::init('Overtime');

					//$overtime = $Overtime->read(null,$data['Attendance']['overtime_id']);

					if  ( $days['Attendance']['out'] > $data['WorkShift']['to'] ) {
						
						$from  =  new DateTime($data['WorkShift']['to']);
						$to  =  new DateTime($data['Attendance']['out']);

						$days['hours_ot'] =  $from->diff($to)->format('%h.%i'); 
					}
					
					//regular ot is 1.25	
					$data['OT'] = ($employee['Salary']['basic_pay'] * $days['hours_ot'] * 1.25 ) / $hours;

				}

				//holidays 
				$today = date('Y-m-d',strtotime($days['Attendance']['date']));

				foreach ($models['Holiday'] as $holiday_key => $holiday) {

					if ($today >= $holiday['Holiday']['start_date'] && $today <= $holiday['Holiday']['end_date']) {

					$data['regular'] = 0.0;

					$data['OT'] = 0.0;

					//legal holiday
					if ($holiday['Holiday']['type'] == 'regular') {

						$data['legal_holiday'] = ($salaries['basic_pay'] * $hours ) / $hours;
					}

					//if employee work in legal or special holiday holiday
					if (!empty($days['Attendance']['in']) && !empty($days['Attendance']['out']) ) {

						if ($holiday['Holiday']['type'] == 'regular') {

							$data['legal_holiday_work'] = ($salaries['basic_pay'] * $days['total_hours']) / $hours;
						
						}

					}

					}

				}
    			//check working days
				if (!empty($days['Attendance']['in']) && !empty($days['Attendance']['out'])) {

					$countDays++;

				}
    			
    	}


		$regular = ($employee['Salary']['basic_pay'] * $data['total_hours']) / $hours;

		$data['regular'] = $regular;
 
		foreach ($data as $pay_keys => $list) {
			
			if (in_array($pay_keys,array('regular','OT','legal_holiday','legal_holiday_work','night_diff_legal_holiday', 'night_diff_legal_holiday_work', 'special_holiday', 'special_holiday_work', 'night_diff_special_holiday', 'night_diff_special_holiday_work','sunday_work','sunday_work_ot','night_diff_sunday_work','night_diff_sunday_work_ot','leave'))) {
							
						$data['gross'] += $list;
				}
		}


		$data['days'] = $countDays;

		$data['gross'] = number_format($data['gross'],2);

    	}

    	return $data;
    }


     private function _monthlyRate($employee = null, $models = array() ,$hours = 8, $workingDays = 26) {

     	$countDays = 0;
     	$regular_days = 0;
     	$special_days = 0;
     	$legal_holiday_days = 0;


		$legal_holiday_hours = 0;

		$special_holiday_hours = 0;

    	$salary = array();

    	if (!empty($employee)) {

    	$data['gross'] = number_format(0,2);
		$data['time_work'] = number_format(0,2);
		$data['days'] = 0;
		$data['total_hours'] = number_format(0,2);
		$data['hours_ot'] = number_format(0,2);
		$data['regular'] = number_format(0,2);
		$data['OT'] = number_format(0,2);
		$data['legal_holiday'] = number_format(0,2);
		$data['legal_holiday_work'] = number_format(0,2);
		$data['legal_holiday_work_ot'] = number_format(0,2);
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
		$data['special_holiday'] =  number_format(0,2);
		$data['special_holiday_work'] =  number_format(0,2);
		$data['special_holiday_work_ot'] =  number_format(0,2);
		$data['night_diff_special_holiday'] =  number_format(0,2);
		$data['night_diff_special_holiday_work'] =  number_format(0,2);
		$data['sunday_work'] =  number_format(0,2);
		$data['sunday_work_ot'] =  number_format(0,2);
		$data['night_diff_sunday_work'] =  number_format(0,2);
		$data['night_diff_sunday_work_ot'] =  number_format(0,2);
		$data['leave'] =  number_format(0,2);
		$data['sunday_legal_holiday'] =  number_format(0,2);
		$data['sunday_work_legal_holiday'] =  number_format(0,2);

	

    	if (!empty($employee)) {

    	$hours_ot = 0;

    	foreach ($employee['Attendance'] as $key => $days) {


    			//check working days
				if (!empty($days['Attendance']['in']) && !empty($days['Attendance']['out'])) {

					$regular_days++;

				}
    					
    			$data['total_hours'] += $this->_total_hours($days);

    			//check if OT
				if (!empty($days['Attendance']['overtime_id'])) {
					
					$data['hours_ot'] = number_format(0,2);

					$Overtime = ClassRegistry::init('Overtime');

					//$overtime = $Overtime->read(null,$data['Attendance']['overtime_id']);

					if  ( $days['Attendance']['out'] > $data['WorkShift']['to'] ) {
						
						$from  =  new DateTime($data['WorkShift']['to']);
						$to  =  new DateTime($data['Attendance']['out']);

						$days['hours_ot'] =  $from->diff($to)->format('%h.%i'); 
					}
					
					//regular ot is 1.25
					$hours_ot += $days['hours_ot'];

					

				}

				//holidays 
				$today = date('Y-m-d',strtotime($days['Attendance']['date']));

				$legal_holiday_work = 0.00;
				$special_holiday_work = 0.00;

				foreach ($models['Holiday'] as $holiday_key => $holiday) {

					if ($today >= $holiday['Holiday']['start_date'] && $today <= $holiday['Holiday']['end_date']) {

					$data['regular'] = 0.0;

					$data['OT'] = 0.0;

					//legal holiday
					if ($holiday['Holiday']['type'] == 'regular') {

						$legal_holiday_hours += $hours;
					}
					if ($holiday['Holiday']['type'] == 'special') {

						$special_holiday_hours += $hours;
					}

					//if employee work in legal or special holiday holiday
					if (!empty($days['Attendance']['in']) && !empty($days['Attendance']['out']) ) {

						if ($holiday['Holiday']['type'] == 'regular') {

							$legal_holiday_work = $data['total_hours'];
							$legal_holiday_days++;
						
						}
						if ($holiday['Holiday']['type'] == 'special') {

							$special_holiday_work = $data['total_hours'];
							$special_days++;
						}

					}

					}

				}
    		
    			
    	}

		$data['days'] = ($regular_days + $legal_holiday_days + $special_days);


		$data['regular'] = ($employee['Salary']['basic_pay'] * $data['total_hours']) /  ($workingDays * $hours);

		$data['OT'] = ($employee['Salary']['basic_pay'] * $hours_ot * 1.25 ) /  ($workingDays * $hours);

		

		if ($legal_holiday_days > 0) {
			
			$data['legal_holiday'] = ($employee['Salary']['basic_pay'] * $legal_holiday_hours ) /  ($workingDays * $hours);

			$data['legal_holiday_work'] = ($employee['Salary']['basic_pay'] * $legal_holiday_work )  / ($workingDays * 8);
		}

		if ($special_days > 0) {

			$data['special_holiday'] = ($employee['Salary']['basic_pay'] * $special_holiday_hours ) /  ($workingDays * $hours);

			$data['special_holiday_work'] = ($employee['Salary']['basic_pay'] * $special_holiday_work )  / ($workingDays * 8);
		}
 
		foreach ($data as $pay_keys => $list) {
			
			if (in_array($pay_keys,array('regular','OT','legal_holiday','legal_holiday_work','night_diff_legal_holiday', 'night_diff_legal_holiday_work', 'special_holiday', 'special_holiday_work', 'night_diff_special_holiday', 'night_diff_special_holiday_work','sunday_work','sunday_work_ot','night_diff_sunday_work','night_diff_sunday_work_ot','leave'))) {
							
						$data['gross'] += $list;
				}
		}


		$data['gross'] = number_format($data['gross'],2);

    	}

    }

    	return $data;
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
		$data['legal_holiday_work_ot'] = number_format(0,2);
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
		$data['special_holiday'] =  number_format(0,2);
		$data['special_holiday_work'] =  number_format(0,2);
		$data['special_holiday_work_ot'] =  number_format(0,2);
		$data['night_diff_special_holiday'] =  number_format(0,2);
		$data['night_diff_special_holiday_work'] =  number_format(0,2);
		$data['sunday_work'] =  number_format(0,2);
		$data['sunday_work_ot'] =  number_format(0,2);
		$data['night_diff_sunday_work'] =  number_format(0,2);
		$data['night_diff_sunday_work_ot'] =  number_format(0,2);
		$data['leave'] =  number_format(0,2);
		$data['sunday_legal_holiday'] =  number_format(0,2);
		$data['sunday_work_legal_holiday'] =  number_format(0,2);


		if (!empty($attendance)) {
			$countDays = 0;
			foreach ($attendance as $key => $days) {

				//$data['time_work'] += $days['total_hours'];
				$work[$key] = $this->checkDays($days,$salaries, 8 , $models );

				foreach ( $work[$key] as $pay_keys => $list) {

						//if (in_array($pay_keys,array('total_hours','regular','OT','legal_holiday','legal_holiday_work','night_diff_legal_holiday', 'night_diff_legal_holiday_work', 'special_holday', 'special_holday_work', 'night_diff_special_holday', 'night_diff_special_holday_work','sunday_work','sunday_work_ot','night_diff_sunday_work','night_diff_sunday_work_ot','leave'))) {
							$data[$pay_keys] += $list;
						if (in_array($pay_keys,array('regular','OT','legal_holiday','legal_holiday_work','night_diff_legal_holiday', 'night_diff_legal_holiday_work', 'special_holiday', 'special_holiday_work', 'night_diff_special_holiday', 'night_diff_special_holiday_work','sunday_work','sunday_work_ot','night_diff_sunday_work','night_diff_sunday_work_ot','leave'))) {
								
							$data['gross'] += $list;
						}
				}
				//check working days
				if (!empty($days['Attendance']['in']) && !empty($days['Attendance']['out'])) {
					$countDays++;
				}
				
			}

			$data['days'] = $countDays;

		}

		return $data;
	}

	public function checkDays ($data = null,$salaries = null,$hours = 8,$models = array()) {

	$days = array();
	
	//get regular days
	$days['total_hours'] = number_format(0,2);
	$days['hours_ot'] =  number_format(0,2);
	$days['regular'] =  number_format(0,2);
	$days['OT'] = number_format(0,2);
	$days['night_diff'] = number_format(0,2);
	$days['night_diff_ot'] = number_format(0,2);
	$days['legal_holiday'] = number_format(0,2);
	$days['legal_holiday_work'] = number_format(0,2);
	$days['night_diff_legal_holiday'] = number_format(0,2);
	$days['night_diff_legal_holiday_work'] = number_format(0,2);
	$days['special_holiday'] = number_format(0,2);
	$days['special_holiday_work'] = number_format(0,2);
	$days['special_holiday_work_ot'] = number_format(0,2);
	$days['night_diff_special_holiday'] = number_format(0,2);
	$days['night_diff_special_holiday_work'] = number_format(0,2);
	$days['sunday_work'] = number_format(0,2);
	$days['sunday_work_ot'] = number_format(0,2);
	$days['night_diff_sunday_work'] = number_format(0,2);
	$days['night_diff_sunday_work_ot'] = number_format(0,2);
	$days['leave'] = number_format(0,2);
	
	//
	if (!empty($data['Attendance']['leave_id'])) {

		$days['leave'] = $salaries['basic_pay']; //($salaries['basic_pay'] * $days['total_hours'])	
	}


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

		//sunday work is nonly for monthly employee

		if ($data['Attendance']['type'] == 'rest_day') {

			if (!empty($salaries['employee_salary_type']) && $salaries['employee_salary_type'] == 'monthly') {

				//sunday work is 1.3
				$days['sunday_work'] = ( $salaries['basic_pay'] * $days['total_hours'] * 1.3 ) / $hours;	

				//check if OT
				if (!empty($data['Attendance']['overtime_id'])) {
						
						$data['hours_ot'] = number_format(0,2);
						
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

			}


		} else {

			$days['regular'] = ($salaries['basic_pay'] * $days['total_hours']) / $hours;

			//check if OT
			if (!empty($data['Attendance']['overtime_id'])) {
				
				$data['hours_ot'] = number_format(0,2);
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
		
		if ($today >= $holiday['Holiday']['start_date'] && $today <= $holiday['Holiday']['end_date']) {
		
		$days['regular'] = 0.0;
		
		$days['OT'] = 0.0;

		//legal holiday
		if ($holiday['Holiday']['type'] == 'regular') {

			$days['legal_holiday'] = ($salaries['basic_pay'] * $hours ) / $hours;
		}

		if ($holiday['Holiday']['type'] == 'special') {

			if (!empty($salaries['employee_salary_type']) && $salaries['employee_salary_type'] == 'monthly') {

				$days['special_holiday'] = ($salaries['basic_pay'] * $hours ) / $hours;
			}
			
		}

		//if employee work in legal or special holiday holiday
		if (!empty($data['Attendance']['in']) && !empty($data['Attendance']['out']) ) {

				if ($holiday['Holiday']['type'] == 'regular') {
					$days['legal_holiday_work'] = ($salaries['basic_pay'] * $days['total_hours']) / $hours;
				}

				if (!empty($salaries['employee_salary_type']) && $salaries['employee_salary_type'] == 'monthly') {

					if ($holiday['Holiday']['type'] == 'special') {
						$days['special_holiday_work'] = ($salaries['basic_pay'] * $days['total_hours']) / $hours;
					}
				}

			}

		}

	}

	//pr($days); 
		
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
		$conditions = array();

		//contribution schedules 
		/*
		1. semi monthly equal
		2. first payroll
		3. second payroll
		*/
		if (!empty($models['Contibution'][1])) {

			switch ($models['Contibution'][1]) {
				case '1':
					
				if ( $gross_pay != 0 && (!empty($government_record[1])) ) {
						
						$SssRange = ClassRegistry::init('SssRange');
						
						$conditions = array('SssRange.range_from <=' => $gross_pay, 'SssRange.range_to >=' => $gross_pay);
						
						$range = $SssRange->find('first',array('conditions' => $conditions ));

						$pay = !empty($range['SssRange']['employees']) ? $range['SssRange']['employees'] : $pay;
				}	

				break;
				case '2':

				if ( $gross_pay != 0 && (!empty($government_record[1])) && $sched == 'first' ) {
						
						$SssRange = ClassRegistry::init('SssRange');
						
						$conditions = array('SssRange.range_from <=' => $gross_pay, 'SssRange.range_to >=' => $gross_pay);
						
						$range = $SssRange->find('first',array('conditions' => $conditions ));

						$pay = !empty($range['SssRange']['employees']) ? $range['SssRange']['employees'] : $pay;
				}
				case '3':	
				
				if ( $gross_pay != 0 && (!empty($government_record[1])) && $sched == 'second' ) {
						
						$SssRange = ClassRegistry::init('SssRange');
						
						$conditions = array('SssRange.range_from <=' => $gross_pay, 'SssRange.range_to >=' => $gross_pay);
						
						$range = $SssRange->find('first',array('conditions' => $conditions ));

						$pay = !empty($range['SssRange']['employees']) ? $range['SssRange']['employees'] : $pay;
				}
				case '4':	
				
				if ( $gross_pay != 0 && (!empty($government_record[1]))) {
						
						$SssRange = ClassRegistry::init('SssRange');
						
						$conditions = array('SssRange.range_from <=' => $gross_pay, 'SssRange.range_to >=' => $gross_pay);
						
						$range = $SssRange->find('first',array('conditions' => $conditions ));

						$pay = !empty($range['SssRange']['employees']) ? $range['SssRange']['employees'] : $pay;
				}
				default:
					# code...
					break;
			}
		
		

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

		//contribution schedules 
		/*
		1. semi monthly equal
		2. first payroll
		3. second payroll
		*/


		if (!empty($models['Contibution'][1])) {


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

	public function computeYearlySalary($data = null){


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
						$empData[$sortedKey]['total_deduction'] = 0;
						$empData[$sortedKey]['total_pay'] = 0;

						foreach ($emp as $empKey => $salary) {

							$empData[$sortedKey]['Employee'] = $salary['Employee'];
							$empData[$sortedKey]['total_deduction'] += $salary['SalaryReport']['total_deduction'];
							$empData[$sortedKey]['total_pay'] += $salary['SalaryReport']['total_pay'];		
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