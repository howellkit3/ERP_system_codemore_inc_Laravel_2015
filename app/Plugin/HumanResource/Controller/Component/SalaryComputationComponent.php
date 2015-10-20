<?php
App::uses('Component', 'Controller');

class SalaryComputationComponent extends Component 
{
    public function calculateBenifits($data = null , $pay_sched = null,$customDate = null, $updateDatabase = null, $payrollSettings = array())
    {
        		
        	$SalaryReport = ClassRegistry::init('SalaryReport');

        	$Deduction = ClassRegistry::init('Deduction');

        	$OvertimeRate = ClassRegistry::init('OvertimeRate')->getOvertimeRate();

			$Holidays = ClassRegistry::init('Holiday');

        	$Contibutions = ClassRegistry::init('Contribution');

        	$Wage = ClassRegistry::init('Wage');

        	$Overtime = ClassRegistry::init('Overtime');

        	$Adjustments = ClassRegistry::init('Adjustment');

			$holidays = $Holidays->find('all',array(
				'conditions' => array('Holiday.year' => date('Y',strtotime($customDate['start']))),
				'fields' => array('id','name','start_date','end_date','year','type')
			));

			$conditions = array(
				'date(Adjustment.payroll_date) BETWEEN ? AND ?' => array($customDate['start'],$customDate['end']), 
			);

			$adjustments = $Adjustments->find('all',array(
				'conditions' =>$conditions
			));

			//excess overtimne
			$minimumWage = $Wage->find('first', array(
				'conditions' => array('Wage.name like' => '%Minimum%')
			));


			$contributions = $Contibutions->find('list',array('fields' => array('id','schedules')));

			$models['OvertimeRate'] = $OvertimeRate;
			$models['Holiday'] = $holidays;
			$models['Contibution'] = $contributions;
			$workingDays = $this->workingDays($customDate);


        	if (!empty($data)) {

        		$salary = array();

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


        				$models['Salary'] = $employee['Salary'];

      //   				if ($employee['Salary']['employee_salary_type'] == 'daily') {

						// 	//$salary[$key] = $this->_dailyRate($employee,$models);
						// }
						// if ($employee['Salary']['employee_salary_type'] == 'monthly') {

						// 	$salary[$key] = $this->_monthlyRate($employee,$models,8,$workingDays,$payrollSettings);
						// } else {

						$salary[$key] = $this->_dailyRate($employee,$models);
						//}

        				$salary[$key]['id'] = !empty($checkExisting['SalaryReport']['id']) ? $checkExisting['SalaryReport']['id'] : '';
        				$salary[$key]['employee_id'] = $employee['Employee']['id'];
        				$salary[$key]['employee_salary_type'] = $employee['Salary']['employee_salary_type'];
        				$salary[$key]['salary_type'] = ($pay_sched == 'first') ? 'first' : 'second';
        				$salary[$key]['from'] = $customDate['start'];
        				$salary[$key]['to'] = $customDate['end'];
        				$salary[$key]['days'] = $gross['days'];
        				
        				if (!empty($salary[$key]['gross'])) {

        				//sss contribution
        				$contribution = $this->sss_pay($employee['Attendance'],$employee['Salary'],$pay_sched,$salary[$key]['gross'], $models);	
        				$salary[$key]['sss'] = !empty($contribution['sss_employees']) ? $contribution['sss_employees'] : 0;
        				$salary[$key]['sss_employer'] = !empty($contribution['sss_employer']) ? $contribution['sss_employer'] : 0;
        				$salary[$key]['sss_compensation'] = !empty($contribution['sss_compensation']) ? $contribution['sss_compensation'] : 0;
						$salary[$key]['sss_id'] = !empty($contribution['sss_id']) ? $contribution['sss_id'] : 0;

						
						$salary[$key]['philhealth'] = $this->philhealth_pay($employee['Attendance'],$employee['Salary'],$pay_sched,$salary[$key]['gross'],$models);
						$salary[$key]['pagibig'] = $this->pagibig_pay($employee['Attendance'],$employee['Salary'],$pay_sched,$salary[$key]['gross'] , $models );
        				} else {


        				//sss contribution
        			//	$contribution = $this->sss_pay($employee['Attendance'],$employee['Salary'],$pay_sched,$salary[$key]['gross'], $models);	
        				$salary[$key]['sss'] = 0;
        				$salary[$key]['sss_employer'] =  0;
        				$salary[$key]['sss_compensation'] =  0;
						$salary[$key]['sss_id'] =  0;

						
						$salary[$key]['philhealth'] = 0;
						$salary[$key]['pagibig'] =  0;
        				}
							
						//ctpa 
						$salary[$key]['ctpa'] = !empty($employee['Salary']['ctpa']) ? $gross['days'] * $employee['Salary']['ctpa'] : 0; 
						//sea
						$salary[$key]['sea'] = !empty($employee['Salary']['sea']) ? $gross['days'] * $employee['Salary']['sea'] : 0;
						$salary[$key]['allowances'] =  $employee['Salary']['allowances'];
						
						// foreach ($gross as $gross_key => $gross_value) {
						// 	$salary[$key][$gross_key] = $gross_value;
						// }

						// //additional income 
						// $salary[$key]['total_pay'] = $gross['gross']; 

					

						$total_pay = 
						$net_pay_no_tax = $salary[$key]['gross'];
					

						$salary[$key]['gross_pay'] = ( $salary[$key]['ctpa'] + $salary[$key]['sea']);
						$salary[$key]['gross_pay'] += $total_pay;


						$total_pay = $salary[$key]['gross_pay'];
						$salary[$key]['total_earnings']  = $salary[$key]['gross_pay'];
						$salary[$key]['total_earnings']  += $employee['Salary']['allowances'];
						$salary[$key]['total_earnings']  += !empty($employee['Salary']['incentives']) ? $employee['Salary']['incentives'] : 0.00;

						//check adjustments 

						$adjust = $this->_checkAdjustments($adjustments,$employee);	
						$salary[$key]['adjustment'] = $adjust['amount'];
						$salary[$key]['adjustment_ids'] = $adjust['ids'];
						$salary[$key]['total_earnings']  += !empty($salary[$key]['adjustment']) ? $salary[$key]['adjustment'] : 0.00;

						//total night diff
						$nightDiff = array(
							'night_diff',
							'night_diff_ot',
							'night_diff_legal_holiday',
							'night_diff_legal_holiday_work',
						//	'night_diff_legal_holiday_work_ot',
							'night_diff_sunday_work',
							//'night_diff_sunday_work_ot',
							'night_diff_special_holiday',
							'night_diff_special_holiday_work'
							//'night_diff_special_holiday_work_ot'
							);

						$nightDiffTotal = 0;
						$salary[$key]['night_diff_total'] = 0;

						foreach ($nightDiff as $nightkey => $night) {

							$salary[$key]['night_diff_total'] += $night;
							
						}
						
						//check deductions 
						$deductions = $this->checkDeductions($employee['Employee']['id'],$customDate,$updateDatabase);

						if (!empty($deductions)) {

							foreach ($deductions as $deductionKey => $value) {
								$salary[$key][strtolower(str_replace(' ','_',$value['name']))] = $value['amount'];
								$total_deduction += $value['amount'];
							}

						}

						$salary[$key]['total_deduction'] = $total_deduction; 
						
						// $salary[$key]['total_deduction'] += $salary[$key]['sss'];

						// $salary[$key]['total_deduction'] += $salary[$key]['philhealth'];

						// $salary[$key]['total_deduction'] += $salary[$key]['pagibig'];
						
						// //no tax
						$taxType = !empty($payrollSettings['Setting']['tax_pay']) ? $payrollSettings['Setting']['tax_pay'] : '';

						$salary[$key]['with_holding_tax'] = $this->computeTax($employee,$salary[$key]['gross_pay'],$taxType,$minimumWage);	

						//add tax
						$salary[$key]['total_deduction'] += $salary[$key]['with_holding_tax'];

						$total_pay  -= $salary[$key]['total_deduction'];

						$salary[$key]['net_pay'] = $total_pay;

						$total_pay  += $employee['Salary']['allowances'];

						//add irregular ot
						$total_pay += $salary[$key]['excess_ot'];


						$total_pay += $salary[$key]['adjustment'];

						//$total_pay  -= $salary[$key]['sss'];
						$salary[$key]['total_pay'] = $total_pay;
						$salary[$key]['Employee'] = $employee['Employee'];
						$salary[$key]['Department'] = !empty($employee['Department']) ? $employee['Department'] : array();
						$salary[$key]['Position']	= !empty($employee['Position']) ? $employee['Position'] : array();
						$salary[$key]['EmployeeAdditionalInformation']	= !empty($employee['EmployeeAdditionalInformation']) ? $employee['EmployeeAdditionalInformation'] : array();
        			
        		}

        		return $salary;
			}
    }

    private function workingDays($date = null) {


    	if (!empty($date)) {

	    	$from = date('Y-m-01',  strtotime($date['start']));
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

    	$days['total_hours'] = '0.00';

		$workshiftFrom = date('Y-m-d',strtotime($data['Attendance']['in'])).' '.$data['MyWorkshift']['from'];

		$today = date('Y-m-d',strtotime($data['Attendance']['in']));

		$logout = date('Y-m-d',strtotime($data['Attendance']['out']));

		if (!empty($data['Attendance']['in']) && !empty($data['Attendance']['out'])) {

		$in = strtotime($today.' '.$data['MyWorkshift']['from']);

		if  (!empty($data['MyWorkshift']['to'])) {

			$timeIn =  date('Y-m-d H:i:s',strtotime($data['Attendance']['in']));

			$inToday = strtotime($data['Attendance']['in']);
			
			$workSched = strtotime($today.' '.$data['MyWorkshift']['from']);


			$workEndToday = strtotime($today.' '.$data['MyWorkshift']['to']);
	

			if ($inToday <= $workEndToday) {

			
			if (strtotime($timeIn) > $in ) {

				$timeIn = date('Y-m-d H:i',strtotime($timeIn)).':00';

			} else {

				$timeIn = $today.' '.$data['MyWorkshift']['from'];
			}


			$timeOut = date('H:i:s',strtotime($data['Attendance']['out']));

			if (strtotime($timeOut) > strtotime($data['MyWorkshift']['to'])) {

				$timeOut = $logout.' '.$data['MyWorkshift']['to'];

			} else {
				
				$timeOut = date('Y-m-d',strtotime($data['Attendance']['in'])).' '.date('H:i',strtotime($timeOut)).':00';
			}

			// pr($data['Attendance']);

			// pr($timeIn);

			//pr($data);


		if (!empty($data['MyBreakTime']['id'])) {

			//#4 2nd shift
			// if ($data['MyWorkshift']['id'] != 4) {


			// }

			
			//substract lunchbreaktime

			$myBreakFrom = $today.' '. $data['MyBreakTime']['from'];
			
			$myBreakTo = $today.' '. $data['MyBreakTime']['to'];

			$breakHour = strtotime($data['MyBreakTime']['from']) + 3600;

			if (strtotime($timeOut) >= strtotime($myBreakFrom) && strtotime($timeOut) >= strtotime($myBreakTo)) {
			
					$timeOut = strtotime($timeOut) - 3600;
					$timeOut = date('Y-m-d',strtotime($data['Attendance']['in'])).' '.date('H:i:s',$timeOut);

			}

				$todayBreak =  $today.' '.date('H:i:s',$breakHour);


			if (strtotime($data['Attendance']['out']) >= strtotime($myBreakFrom) && strtotime($data['Attendance']['out']) <= strtotime($todayBreak)) {

				$timeOut = $today.' '.date('H:',strtotime($data['Attendance']['out'])).'00:00';


			}

		} else{

			if (strtotime($timeOut) > strtotime($data['MyWorkshift']['to'])) {
				$timeOut = strtotime($timeOut) - 3600;
				$timeOut = date('Y-m-d',strtotime($data['Attendance']['in'])).' '.date('H:i:s',$timeOut);
			}
		
		}

		


		$date1 = new DateTime($timeIn);
		$date2 = new DateTime($timeOut);

		 $days['total_hours'] = $date1->diff($date2)->format('%h.%i'); 

		//  pr($timeIn);
		//  pr($days['total_hours']);

		// // $days['total_ho`urs'] += $days['total_hours'];

		// pr($days['total_hours']);
	
		} else {

			//pr($data['Attendance']);
		}


		
		//if (strtotime($data['Attendance']['in']) >= strtotime($workshiftFrom) ) {
						
			// $from = new DateTime($data['Attendance']['in']);

			// $to = new DateTime($data['Attendance']['out']);


			// if ($data['Attendance']['out'] > $data['MyWorkshift']['to']) {
				
			// 	$to = new DateTime( $data['MyWorkshift']['to'] );
			// }
						
			// $days['total_hours'] =  $from->diff($to)->format('%h.%i'); 

			// $days['total_hours'] -= 1;

			// if (!empty($data['BreakTime']['id'])) {

			// 	if (strtotime($data['Attendance']['out']) >= strtotime($data['MyBreakTime']['from']) && strtotime($data['Attendance']['out']) >= strtotime($data['MyBreakTime']['to'])) {
			
			// 		$days['total_hours'] -= 1;
			// 	}
			// }

		}
		}
		


    	return $days['total_hours'];
    }

    private function _checkOvertime($days = null,$night = null) {

    	$data['total_hours'] = 0;
    	$data['night_diff'] = 0;
    	$overtime = 0;
    	$data['hours_ot'] = 0;

    	if (!empty($days['Attendance']['overtime_id'])) {
						
					
					$data['hours_ot'] = 0;

					$Overtime = ClassRegistry::init('Overtime');

					//$overtime = $Overtime->read(null,$data['Attendance']['overtime_id']);

					if (!empty($days['MyWorkshift']['to'] )) {


					//if  ( strtotime($days['Attendance']['out']) >= strtotime($days['Overtime']['to']) ) {
						
						$workshift = $days['Overtime']['from'];

						$from  =  $workshift; //new DateTime($workshift);

						$overtimeDate = date('Y-m-d',strtotime($days['Overtime']['to']));

						$overtimeIn = date('Y-m-d',strtotime($days['Attendance']['in']));

						if ($overtimeDate == $overtimeIn) {

						if (strtotime($days['Attendance']['out']) > strtotime($days['Overtime']['to'])) {

						$to  =  $days['Overtime']['to']; //new DateTime($days['Overtime']['to']);

						} else {

							$to  =  $days['Attendance']['out']; // new DateTime($days['Attendance']['out']);	
						}

						
						$from = new DateTime($from);

						$to = new DateTime($to);



						$data['total_hours'] =  $from->diff($to)->format('%h.%i');

						}
			
					//}
					
					//regular ot is 1.25	
						// if (!empty($data['hours_ot'])) {
						// 	$data['OT'] = ($employee['Salary']['basic_pay'] * $data['hours_ot'] * 1.25 ) / $hours;

						// } else {
						// 	$data['OT'] = 0;
						// }
					
					}


		}

  //   	if (!empty($days)) {

		// 		//check if OT
		// 		if (!empty($days['Attendance']['overtime_id'])) {

		// 				$Overtime = ClassRegistry::init('Overtime');

		// 				$overtime = $Overtime->read(null,$days['Attendance']['overtime_id']);

		// 			// //pr($days['Attendance']['overtime_id']);

		// 			if (!empty($days['MyWorkShift']['to'])) {

					
		// 			if  ( $days['Attendance']['out'] >= $overtime['Overtime']['from'] ) {
						
		// 				//add breatime before OT		
		// 				$from  =  new DateTime($overtime['Overtime']['from']);
						
		// 				$to  =  new DateTime($days['Attendance']['out']);

		// 				if (strtotime($days['Attendance']['out']) > strtotime($overtime['Overtime']['to'])) {

		// 					$to  =  new DateTime($overtime['Overtime']['to']);
		// 				}

		// 				$data['total_hours'] = $from->diff($to)->format('%h.%i'); 
		// 				//add breaktime
		// 				$data['total_hours'] -= 1;

		// 			}
					
		// 			//regular ot is 1.25
		// 			$data['total_hours'] = $data['total_hours'];

		// 			//night differential

		// 			$fromDate = date('Y-m-d',strtotime($days['Attendance']['date'])).' 22:00:00';

		// 			$from  =  new DateTime($fromDate);
		// 			$to  =  new DateTime($days['Attendance']['out']);

		// 			if ($days['Attendance']['out'] > $fromDate) {

		// 				if (strtotime($days['Attendance']['out']) > strtotime($overtime['Overtime']['to'])) {

		// 					$to  =  new DateTime($overtime['Overtime']['to']);
		// 				}

		// 				$data['night_diff'] = $from->diff($to)->format('%h.%i'); 
		// 				$data['night_diff'] -= 1;
		// 			}

		// 			}

		// 		}

		// }


		return $data;
    }

    private function _nightDiff($days = null) {
    	
    	$data['night_diff'] = 0;


    	if (!empty( $days['MyWorkshift']['to'])) {

    	if  ( $days['Attendance']['out'] > $days['MyWorkshift']['to'] ) {
			

			$today = date('Y-m-d',strtotime($days['Attendance']['in']));	

			$out = date('Y-m-d',strtotime($days['Attendance']['out']));	
			//starts from 10:00 pm
			$fromDate = $today .' 22:00:00';
				
			//$nighInn

			$nightIn = strtotime($fromDate);

			$timeIn =  date('Y-m-d H:i:s',strtotime($days['Attendance']['in']));

			$inToday = strtotime($days['Attendance']['in']);
			$outToday = strtotime($days['Attendance']['out']);
			
			$workSched = strtotime($today.' '.$days['MyWorkshift']['from']);

			$dateOut = date('Y-m-d', strtotime($days['Attendance']['out']));

			$workEndToday = strtotime($dateOut.' '.$days['MyWorkshift']['to']);
			
			if ($inToday <= $workEndToday && $outToday >= $nightIn) {

				if (strtotime($timeIn) > strtotime($days['MyWorkshift']['from'])) {

					$timeIn = date('Y-m-d H:i',strtotime($timeIn)).':00';

				} else {

					$timeIn = date('Y-m-d',strtotime($days['Attendance']['in'])).' '.$days['MyWorkshift']['from'];
				}

					$timeOut = date('H:i:s',strtotime($days['Attendance']['out']));

				if (strtotime($timeOut) > strtotime($days['MyWorkshift']['to'])) {

					$timeOut = $out.' '.$days['MyWorkshift']['to'];

				} else {
					
					$timeOut =  $out.' '.date('H:i',strtotime($timeOut)).':00';
				}

				//$data['night_diff'] = $from->diff($timeOut)->format('%h.%i'); 

						
				$date1 = new DateTime($fromDate);
				$date2 = new DateTime($timeOut);

				$data['night_diff'] = $date1->diff($date2)->format('%h.%i'); 


			}


		}

	}

		return $data['night_diff'];
				
    }


   function addWorkTime($times = array()) {

	$minutes = '';
    // loop throught all the times
    foreach ($times as $time) {
        list($hour, $minute) = explode('.', $time);
        $minutes += $hour * 60;
        $minutes += $minute;
    }

    $hours = floor($minutes / 60);
    $minutes -= $hours * 60;

    // returns the time already formatted
    return sprintf('%02d.%02d', $hours, $minutes);
}


	public function _getDifference($days) {

		if (!empty($days)) {

			$total = 0;

			$today = date('Y-m-d',strtotime($days['Attendance']['in']));

			if (!empty($days['MyWorkshift']['from']) && strtotime($days['Attendance']['in']) >= strtotime($today.' '.$days['MyWorkshift']['from']) ) {

				$dateIn = date('Y-m-d h:i:00',strtotime($days['Attendance']['in']));

				$timeIn = strtotime($dateIn); 
				
				$toTime = strtotime($today.' '.$days['MyWorkshift']['from']); 

				$total = abs($toTime - $timeIn);

				$total = round($total / 60);

			}

			return $total;

		}
	}

    private function _dailyRate($employee = null, $models = array() ,$hours = 8, $workingDays = 26 ) {

    	$countDays = 0;
     	$regular_days = 0;
     	$special_days = 0;
     	$legal_holiday_days = 0;
     	$sunday_days = 0;
     	$sunday_days_regular_holiday = 0;
		$sunday_days_special_holiday = 0;
		$legal_holiday_hours = 0;
		$special_holiday_hours = 0;
		$salary = array();

    	$data = array();

    	$data['gross'] = 0;
		$data['time_work'] = 0;
		$data['days'] = 0;
		$data['total_hours'] = 0;
		$data['hours_ot'] = 0;
		$data['regular'] = 0;
		$data['OT'] = 0;
		$data['legal_holiday'] = 0;
		$data['legal_holiday_work'] = 0;
		$data['legal_holiday_work_ot'] = 0;
		$data['total'] =  0;
		$data['total_hours'] =  0;
		$data['regular'] =  0;
		$data['OT'] =  0;
		$data['night_diff'] =  0;
		$data['night_diff_ot'] =  0;
		$data['legal_holiday'] =  0;
		$data['legal_holiday_work'] =  0;
		$data['night_diff_legal_holiday'] =  0;
		$data['night_diff_legal_holiday_work'] =  0;
		$data['special_holiday'] =  0;
		$data['special_holiday_work'] =  0;
		$data['special_holiday_work_ot'] =  0;
		$data['night_diff_special_holiday'] =  0;
		$data['night_diff_special_holiday_work'] =  0;
		$data['sunday_work'] =  0;
		$data['sunday_work_ot'] =  0;
		$data['night_diff_sunday_work'] =  0;
		$data['night_diff_sunday_work_ot'] =  0;
		$data['leave'] =  0;
		$data['sunday_legal_holiday'] =  0;
		$data['sunday_work_legal_holiday'] =  0;

    	$data['hours_regular'] = 0;
    	$data['hours_ot'] = 0;

    	$data['hours_night_diff'] = 0;
    	$data['hours_night_diff_ot'] = 0;

    	$data['hours_sunday_work'] = 0;
    	$data['hours_sunday_work_ot'] = 0;

    	$data['hours_sunday_night_diff'] = 0;
    	$data['hours_sunday_night_diff_ot'] = 0;

    	$data['sunday_ot'] = 0;

    	$data['hours_legal_holiday_work'] = 0;
    	$data['hours_legal_holiday_work_ot'] = 0;

    	$data['hours_legal_holiday_work_night_diff'] = 0;
    	$data['hours_legal_holiday_work_night_diff_ot'] = 0;

    	$data['hours_legal_holiday_sunday_work'] = 0;
    	$data['hours_legal_holiday_sunday_work_ot'] = 0;

    	$data['hours_legal_holiday_sunday_work_night_diff'] = 0;
    	$data['hours_legal_holiday_sunday_work_night_diff_ot'] = 0;

    	$data['hours_special_holiday_work'] = 0;
    	$data['hours_special_holiday_work_ot'] = 0;

    	$data['hours_special_holiday_work_night_diff'] = 0;
    	$data['hours_special_holiday_work_night_diff_ot'] = 0;

    	$data['hours_special_holiday_sunday_work'] = 0;
    	$data['hours_special_holiday_sunday_work_ot'] = 0;

    	$data['hours_special_holiday_sunday_work_night_diff'] = 0;
    	$data['hours_special_holiday_sunday_work_night_diff_ot'] = 0;
	
    	$data['excess_ot'] = 0;
    	$data['hours_excess_ot'] = 0;
    	$data['regular_OT'] = 0;


    	$data['sunday_ctpa'] = 0;
    	$data['sunday_sea'] = 0;

    	if (!empty($employee)) {

		$daysGet = array();

		$times = array();

		$differences = array();

		$timeSunday = array();

    	foreach ($employee['Attendance'] as $key => $days) {
    				
    			//$data['total_hours'] += $this->_total_hours($days);


    			//check if OT
				// if (!empty($days['Attendance']['overtime_id'])) {
						
					
				// 	$data['hours_ot'] = 0;

				// 	$Overtime = ClassRegistry::init('Overtime');

				// 	//$overtime = $Overtime->read(null,$data['Attendance']['overtime_id']);

				// 	if (!empty($days['MyWorkshift']['to'] )) {


				// 	//if  ( strtotime($days['Attendance']['out']) >= strtotime($days['Overtime']['to']) ) {
						
				// 		$workshift = $days['Overtime']['from'];

				// 		$from  = new DateTime($workshift);

					
				// 		if (strtotime($days['Attendance']['out']) > strtotime($days['Overtime']['to'])) {

				// 		$to  =  new DateTime($days['Overtime']['to']);

				// 		} else {

				// 			$to  =  new DateTime($days['Attendance']['out']);	
				// 		}


				// 		$data['hours_ot'] =  $from->diff($to)->format('%h.%i');

						
				// 	//}
					
				// 	//regular ot is 1.25	
				// 		if (!empty($data['hours_ot'])) {
				// 			$data['OT'] = ($employee['Salary']['basic_pay'] * $data['hours_ot'] * 1.25 ) / $hours;

				// 		} else {
				// 			$data['OT'] = 0;
				// 		}
					
				// 	}

				// }


				
				//holidays 
				$today = date('Y-m-d',strtotime($days['Attendance']['in']));

				$legal_holiday_work = 0.00;
				
				$special_holiday_work = 0.00;

				foreach ($models['Holiday'] as $holiday_key => $holiday) {

					if ($today >= $holiday['Holiday']['start_date'] && $today <= $holiday['Holiday']['end_date']) {	

						$daysGet[] = $today;

						if ($holiday['Holiday']['type'] == 'regular') {
									
									$legal_holiday_days++;

									$legal_holiday_work = $data['total_hours'];

									//check if sunday 
									if (date("w",strtotime($today)) == 0 ) {

										$data['hours_legal_holiday_sunday_work'] = $this->_total_hours($days);
										$overtime = $this->_checkOvertime($days);
										$data['hours_legal_holiday_sunday_work_ot'] = $overtime['total_hours'];


										//sunday legal holiday night_diff
										$data['hours_legal_holiday_sunday_work_night_diff'] += $this->_nightDiff($days);
										$data['hours_legal_holiday_sunday_work_night_diff_ot'] += $overtime['night_diff'];
										

									} else {

										$data['hours_legal_holiday_work'] = $this->_total_hours($days);
										$overtime = $this->_checkOvertime($days);
										$data['hours_legal_holiday_work_ot'] += $overtime['total_hours'];

										//sunday legal holiday night_diff
										$data['hours_legal_holiday_work_night_diff'] += $this->_nightDiff($days);
										$data['hours_legal_holiday_work_night_diff_ot'] += $overtime['night_diff'];

									}
									
								}

							if ($holiday['Holiday']['type'] == 'special') {
								
								$special_holiday_work = $data['total_hours'];
								$special_days++;
								
								if (date("w",strtotime($today)) == 0 ) {

									$data['hours_special_holiday_sunday_work'] = $this->_total_hours($days);
									$overtime = $this->_checkOvertime($days);
									$data['hours_special_holiday_sunday_work_ot'] = $overtime['total_hours'];

									//sunday special holiday night_diff
									$data['hours_special_holiday_sunday_work_night_diff'] += $this->_nightDiff($days);
									$data['hours_special_holiday_sunday_work_night_diff_ot'] += $overtime['night_diff'];

								} else {

									$data['hours_special_holiday_work'] = $this->_total_hours($days);
									$overtime = $this->_checkOvertime($days);
									$data['hours_special_holiday_work_ot'] += $overtime['total_hours'];

									//sunday special holiday night_diff
									$data['hours_special_holiday_work_night_diff'] += $this->_nightDiff($days);
									$data['hours_special_holiday_work_night_diff_ot'] += $overtime['night_diff'];
								}
							}
					}

				}
    			//check working days
				if (!empty($days['Attendance']['in']) && !empty($days['Attendance']['out'])) {


					$timeIn =  date('Y-m-d H:i:s',strtotime($days['Attendance']['in']));

					$inToday = strtotime($days['Attendance']['in']);

					$workSched = strtotime($today.' '.$days['MyWorkshift']['from']);


					$workEndToday = strtotime($today.' '.$days['MyWorkshift']['to']);


				}


    			//check if days is not holiday or sundays
				if (!in_array($today, $daysGet) && date("w",strtotime($today)) != 0) {

				

					$inToday = date('Y-m-d',strtotime($days['Attendance']['in']));
					//$data['hours_regular'] += $this->_total_hours($days);

					//$data['hours_regular'] += $this->_getDifference($days);

					$differences[$key]['minutes'] = $this->_getDifference($days);

					$differences[$key]['in'] = $days['Attendance']['in'];


					$differences[$key]['from'] = $inToday.' '.$days['MyWorkshift']['from'];

					//$times[] = $this->_total_hours($days);
					//regular_ot 
					$over = $this->_checkOvertime($days);

					$data['hours_ot'] += $over['total_hours'];

					$data['regular_OT'] += $over['total_hours'];


					//regular night differential

					if (!empty($days['Attendance']['in']) && !empty($days['Attendance']['out']) ) {
							
						$today = $days['MySchedule']['day'];

						$fromDate = $today .' 22:00:00';
						
						$myShift = $today.' '.$days['MyWorkshift']['from'];

						if (strtotime($myShift) >= $fromDate) {

							$data['hours_night_diff'] += $this->_nightDiff($days);

							$data['hours_night_diff_ot'] += $over['night_diff'];

						}
						
					
						$regular_days++;
						// if () {

						// }		
					}


		
				}

				//sunday work
				if (date("w",strtotime($today)) == 0 && !in_array($today, $daysGet)) {
							

					if (!empty($days['Attendance']['in']) && !empty($days['Attendance']['out'])) {

						$sunday_days++;	

						$data['hours_sunday_work'] += $this->_total_hours($days);

						//$timeSunday[] =  $this->_total_hours($days);

						//pr($data['hours_sunday_work']);
						//sunday_work_ot 
						$overtime = $this->_checkOvertime($days);
						$data['hours_sunday_work_ot'] += $overtime['total_hours'];

						if (!empty($days['Attendance']['in']) && !empty($days['Attendance']['out'])) {
						
							$data['hours_sunday_night_diff'] += $this->_nightDiff($days);

							$data['hours_sunday_night_diff_ot'] += $overtime['night_diff'];
						}

						$data['sunday_ctpa'] = !empty($models['Salary']['ctpa']) ? $models['Salary']['ctpa'] : 0;

						$data['sunday_sea'] = !empty($models['Salary']['sea']) ? $models['Salary']['sea'] : 0;
			

					}
				}	

			//check excess_ot on regular days
			$data['hours_excess_ot'] += $this->_excessOvertime($days);

    	}

		$data['regular'] = ($employee['Salary']['basic_pay'] * $data['hours_regular']) / $hours;

		// pr( $data['hours_regular'] );
		// pr($employee['Salary']['basic_pay']);

		// pr( $hours );
		//sunday work
		if ($data['hours_sunday_work'] > 0) {

			$data['sunday_work'] = ($employee['Salary']['basic_pay'] * $data['hours_sunday_work'] * 1.3 ) / $hours;

			if ( $data['hours_sunday_work_ot'] > 0) {

				$data['sunday_work_ot'] = ($employee['Salary']['basic_pay'] * $data['hours_sunday_work_ot'] * 1.3 * 1.3 ) / $hours;

			}

			//sunday night diff	
			if (  $data['hours_sunday_night_diff']  > 0) {
					$data['sunday_night_diff'] = ($employee['Salary']['basic_pay'] * $data['hours_sunday_night_diff'] * 1.3 * 0.1 ) / $hours;
			}
		
		}

		//legal holiday 
		if ($legal_holiday_days > 0) {
			
			$data['legal_holiday'] = ($employee['Salary']['basic_pay'] * $hours ) / $hours; //($employee['Salary']['basic_pay'] * $legal_holiday_hours ) /  ($workingDays * $hours);

			$data['legal_holiday_work'] = ($employee['Salary']['basic_pay'] * $data['hours_legal_holiday_work'] ) / $hours;  //($employee['Salary']['basic_pay'] * $legal_holiday_work )  / ($workingDays * 8);

			$data['legal_holiday_work_ot'] = ($employee['Salary']['basic_pay'] * $data['hours_legal_holiday_work_ot'] * 2.30 ) / $hours;

			if ($data['hours_legal_holiday_sunday_work']  > 0) {
				
			 	$data['legal_holiday_sunday_work'] = ($employee['Salary']['basic_pay'] * $data['hours_legal_holiday_sunday_work'] * 2 * 1.3 ) / $hours;
			}

			if ($data['hours_legal_holiday_sunday_work_night_diff'] > 0) {
				
				$data['legal_holiday_sunday_work_night_diff'] = ($employee['Salary']['basic_pay'] * $data['hours_legal_holiday_sunday_work_night_diff'] * 2.0 * 0.1 ) / $hours;
			}
			if ($data['hours_legal_holiday_sunday_work_night_diff_ot'] > 0) {

				$data['legal_holiday_sunday_work_night_diff_ot'] = ($employee['Salary']['basic_pay'] * $data['hours_legal_holiday_sunday_work_night_diff'] * 2.0 * 1.3 * 1.1 ) / $hours; 
			}
			
		
		}	
		//special holiday
		if ($special_days > 0) {

			
			//$data['special_holiday_new'] = ($employee['Salary']['basic_pay'] * $special_holiday_hours ) /  ($workingDays * $hours);
			if ( $data['special_holiday_work'] > 0 ) {

				$data['special_holiday_work'] = ($employee['Salary']['basic_pay'] * $data['hours_special_holiday_work'] * 1.3 ) /  $hours; //($workingDays * $hours); $daily * $data['hours_special_holiday_work']; //($employee['Salary']['basic_pay'] * $special_holiday_work )  / ($workingDays * 8);
			}

			if ( $data['hours_special_holiday_work_ot'] > 0 ) {

				$data['special_holiday_work_ot'] = ($employee['Salary']['basic_pay'] * $data['hours_special_holiday_work_ot'] * 1.3  * 1.3) /  $hours; 
			}

			if ( $data['hours_special_holiday_sunday_work'] > 0 ) {

				$data['special_holiday_work_ot'] = ($employee['Salary']['basic_pay'] * $data['hours_special_holiday_work_ot'] * 1.3  * 1.3) /  $hours; 
			}
			
		
			if ($data['hours_special_holiday_sunday_work']  > 0) {
				
				$data['special_holiday_sunday_work'] = ($employee['Salary']['basic_pay'] * $data['hours_special_holiday_work_ot'] * 1.5 ) /  $hours; 
			}

			if ($data['hours_special_holiday_sunday_work_night_diff'] > 0) {
				
				$data['special_holiday_sunday_work_night_diff'] = ($employee['Salary']['basic_pay'] * $data['hours_special_holiday_sunday_work_night_diff'] * 1.5 * 1.3 * 1.1 ) /  $hours; 
			}

			if ($data['hours_special_holiday_sunday_work_night_diff_ot'] > 0) {

				$data['special_holiday_sunday_work_night_diff_ot'] == ($employee['Salary']['basic_pay'] * $data['hours_special_holiday_sunday_work_night_diff'] * 2.6 * 1.3 * 1.1 ) /  $hours; 
			}
		
		}
 
		foreach ($data as $pay_keys => $list) {
			
			if (in_array($pay_keys,array('regular','OT','legal_holiday','legal_holiday_work','night_diff_legal_holiday', 'night_diff_legal_holiday_work', 'special_holiday', 'special_holiday_work', 'night_diff_special_holiday', 'night_diff_special_holiday_work','sunday_work','sunday_work_ot','night_diff_sunday_work','night_diff_sunday_work_ot','leave'))) {
							
						$data['gross'] += $list;
				}
		}


		if ($data['hours_regular'] > 0) {
				
				$countDays++;
		}


		$data['days'] = $countDays;

		//pr($data['hours_regular']);

		//excess overtime
		if ($data['hours_excess_ot'] > 0) {

			$data['excess_ot']  = ($employee['Salary']['basic_pay'] * $data['hours_excess_ot'] * 1.25) / $workingDays;
		
		}

		$data['gross'] = $data['gross'];

    	}


    	$data['hours_regular'] = ($regular_days * 8) - 0.127; //$this->addWorkTime($times);


    	$regularDays = ($regular_days * 8);
    	$data['hours_regular'] = ($regular_days * 8);

    	foreach ($differences as $key => $value) {
    	
    		$data['hours_regular'] -= '0.'.$value['minutes'];

    	}
    	// $data['hours_sunday_work'] = $this->addWorkTime($timeSunday);

    	return $data;
    }

    private function _excessOvertime($attendance = null) {

		//$data['hours_excess_ot'] += $this->_excessOvertime($days,$models['OvertimeExcess']);
    	$hours_excess = 0;

    	if (!empty($attendance['OvertimeExcess']['id'])) {

    		$hours_excess = $attendance['OvertimeExcess']['used_time'];
    	}
			
		return $hours_excess;
	}



     private function _monthlyRate($employee = null, $models = array() ,$hours = 8, $workingDays = 26,$payrollSettings = array()) {

     	$countDays = 0;
     	$regular_days = 0;
     	$special_days = 0;
     	$legal_holiday_days = 0;
     	$sunday_days = 0;
     	$sunday_days_regular_holiday = 0;
		$sunday_days_special_holiday = 0;
		$legal_holiday_hours = 0;
		$special_holiday_hours = 0;
		$salary = array();

    	if (!empty($employee)) {

    	$data['gross'] = 0;
		$data['time_work'] = 0;
		$data['days'] = 0;
		$data['total_hours'] = 0;
		$data['hours_ot'] = 0;
		$data['regular'] = 0;
		$data['OT'] = 0;
		$data['legal_holiday'] = 0;
		$data['legal_holiday_work'] = 0;
		$data['legal_holiday_work_ot'] = 0;
		$data['total'] =  0;
		$data['total_hours'] =  0;
		$data['hours_ot'] =  0;
		$data['regular'] =  0;
		$data['OT'] =  0;

		$data['night_diff'] =  0;

		$data['night_diff_ot'] =  0;
		$data['sunday_night_diff'] =  0;

		$data['legal_holiday'] =  0;
		$data['legal_holiday_work'] =  0;
		$data['night_diff_legal_holiday'] =  0;
		$data['night_diff_legal_holiday_work'] =  0;
		$data['special_holiday'] =  0;
		$data['special_holiday_work'] =  0;
		$data['special_holiday_work_ot'] =  0;
		$data['night_diff_special_holiday'] =  0;
		$data['night_diff_special_holiday_work'] =  0;
		$data['sunday_work'] =  0;
		$data['sunday_work_ot'] =  0;
		$data['night_diff_sunday_work'] =  0;
		$data['night_diff_sunday_work_ot'] =  0;
		$data['leave'] =  0;
		$data['sunday_legal_holiday'] =  0;
		$data['sunday_work_legal_holiday'] =  0;
		$data['regular_hours'] = 0;


    	$data['hours_regular'] = 0;

    	$data['hours_night_diff'] = 0;
    	$data['hours_night_diff_ot'] = 0;

    	$data['hours_sunday_work'] = 0;
    	$data['hours_sunday_work_ot'] = 0;

    	$data['hours_sunday_night_diff'] = 0;
    	$data['hours_sunday_night_diff_ot'] = 0;

    	$data['sunday_ot'] = 0;

    	$data['hours_legal_holiday_work'] = 0;
    	$data['hours_legal_holiday_work_ot'] = 0;

    	$data['hours_legal_holiday_work_night_diff'] = 0;
    	$data['hours_legal_holiday_work_night_diff_ot'] = 0;

    	$data['hours_legal_holiday_sunday_work'] = 0;
    	$data['hours_legal_holiday_sunday_work_ot'] = 0;

    	$data['hours_legal_holiday_sunday_work_night_diff'] = 0;
    	$data['hours_legal_holiday_sunday_work_night_diff_ot'] = 0;

    	$data['hours_special_holiday_work'] = 0;
    	$data['hours_special_holiday_work_ot'] = 0;

    	$data['hours_special_holiday_work_night_diff'] = 0;
    	$data['hours_special_holiday_work_night_diff_ot'] = 0;

    	$data['hours_special_holiday_sunday_work'] = 0;
    	$data['hours_special_holiday_sunday_work_ot'] = 0;

    	$data['hours_special_holiday_sunday_work_night_diff'] = 0;
    	$data['hours_special_holiday_sunday_work_night_diff_ot'] = 0;

    	$data['excess_ot'] = 0;
    	$data['hours_excess_ot'] = 0;

    	$times = array();
		
    	if (!empty($employee)) {

    	$hours_ot = 0;

    	if (!empty($employee['Attendance'])) {


		$daysGet = array();

    	foreach ($employee['Attendance'] as $key => $days) {

    			$data['total_hours'] = $this->_total_hours($days);

    			//check working days
				if (!empty($days['Attendance']['in']) && !empty($days['Attendance']['out'])) {
					$regular_days++;
				}

				//holidays 
				$today = date('Y-m-d',strtotime($days['Attendance']['date']));

				$legal_holiday_work = 0.00;
				$special_holiday_work = 0.00;

				foreach ($models['Holiday'] as $holiday_key => $holiday) {

					if ($today >= $holiday['Holiday']['start_date'] && $today <= $holiday['Holiday']['end_date']) {

							$daysGet[] = $today;

							// $data['regular'] = 0.0;
							// $data['OT'] = 0.0;

							//legal holiday
							if ($holiday['Holiday']['type'] == 'regular') {
								$legal_holiday_hours += $hours;
							}
							//special holiday
							if ($holiday['Holiday']['type'] == 'special') {

								$special_holiday_hours += $hours;
							}

							//if employee work in legal or special holiday 
							if (!empty($days['Attendance']['in']) && !empty($days['Attendance']['out']) ) {

								if ($holiday['Holiday']['type'] == 'regular') {
									
									$legal_holiday_days++;

									$legal_holiday_work = $data['total_hours'];

									//check if sunday 
									if (date("w",strtotime($today)) == 0 ) {

										$data['hours_legal_holiday_sunday_work'] = $this->_total_hours($days);
										$overtime = $this->_checkOvertime($days);
										$data['hours_legal_holiday_sunday_work_ot'] = $overtime['total_hours'];

										//sunday legal holiday night_diff
										$data['hours_legal_holiday_sunday_work_night_diff'] += $this->_nightDiff($days);
										$data['hours_legal_holiday_sunday_work_night_diff_ot'] += $overtime['night_diff'];
										
									} else {

										$data['hours_legal_holiday_work'] = $this->_total_hours($days);
										$overtime = $this->_checkOvertime($days);
										$data['hours_legal_holiday_work_ot'] += $overtime['total_hours'];

										//sunday legal holiday night_diff
										$data['hours_legal_holiday_work_night_diff'] += $this->_nightDiff($days);
										$data['hours_legal_holiday_work_night_diff_ot'] += $overtime['night_diff'];

									}
									

								}

								if ($holiday['Holiday']['type'] == 'special') {
									
									$special_holiday_work = $data['total_hours'];
									$special_days++;
									
									if (date("w",strtotime($today)) == 0 ) {

										$data['hours_special_holiday_sunday_work'] = $this->_total_hours($days);
										$overtime = $this->_checkOvertime($days);
										$data['hours_special_holiday_sunday_work_ot'] = $overtime['total_hours'];

										//sunday special holiday night_diff
										$data['hours_special_holiday_sunday_work_night_diff'] += $this->_nightDiff($days);
										$data['hours_special_holiday_sunday_work_night_diff_ot'] += $overtime['night_diff'];

									} else {

										$data['hours_special_holiday_work'] = $this->_total_hours($days);
										$overtime = $this->_checkOvertime($days);
										$data['hours_special_holiday_work_ot'] += $overtime['total_hours'];

										//sunday special holiday night_diff
										$data['hours_special_holiday_work_night_diff'] += $this->_nightDiff($days);
										$data['hours_special_holiday_work_night_diff_ot'] += $overtime['night_diff'];
									}
								}

							}

					}


				}
				
				//check if days is not holiday or sundays
				if (!in_array($today, $daysGet) && date("w",strtotime($today)) != 0) {

					$data['hours_regular'] += $this->_total_hours($days);

					$times[] = $this->_total_hours($days);
					//regular_ot 
					$overtime = $this->_checkOvertime($days);
					$data['hours_ot'] += $overtime['total_hours'];

					//regular night differential

					if (!empty($days['Attendance']['in']) && !empty($days['Attendance']['out'])) {
						
						$data['hours_night_diff'] += $this->_nightDiff($days);

						$data['hours_night_diff_ot'] += $overtime['night_diff'];
					}


				}
				//sunday work
				if (date("w",strtotime($today)) == 0 && in_array($today, $daysGet)) {
						
					if (!empty($days['Attendance']['in']) && !empty($days['Attendance']['out'])) {

						$sunday_days++;	
						$data['hours_sunday_work'] += $this->_total_hours($days);
						//sunday_work_ot 
						$overtime = $this->_checkOvertime($days);
						$data['hours_sunday_work_ot'] += $overtime['total_hours'];

						if (!empty($days['Attendance']['in']) && !empty($days['Attendance']['out'])) {
						
							$data['hours_sunday_night_diff'] += $this->_nightDiff($days);

							$data['hours_sunday_night_diff_ot'] += $overtime['night_diff'];
						}
			

					}
				}
		

		//check excess_ot on regular days
		$data['hours_excess_ot'] += $this->_excessOvertime($days);

    	}

    	
    }


    	$data['days'] = ($regular_days + $legal_holiday_days + $special_days);


    	if ($payrollSettings['Setting']['payment_type'] == 'month') {

	    	//daily 
			
			$data['regular'] = ( $employee['Salary']['basic_pay']  /  ($workingDays * $hours) ) * $data['hours_regular'];
			
			$data['OT'] = ( $employee['Salary']['basic_pay']  /  ($workingDays * $hours) )  *  $data['hours_ot'] * 1.25; //($employee['Salary']['basic_pay'] * $data['hours_ot'] * 1.25 ) /  ($workingDays * $hours);

			//night differential
			// if ( $data['hours_night_diff'] > 0) {

			// 		$data['night_diff'] = $daily * 0.10 * $data['hours_night_diff'];
			// 	}
				
			// if ( $data['hours_night_diff_ot'] > 0) {

			// 	$data['night_diff_ot'] = $daily * 1.25 * 1.1 * $data['hours_night_diff_ot'];

			// }


				//sunday work
			if ($sunday_days > 0) {

				$data['sunday_work'] =  ( $employee['Salary']['basic_pay']  /  ($workingDays * $hours) )  * $data['hours_sunday_work'] * 1.3;  //($employee['Salary']['basic_pay'] * $data['hours_sunday_work'] * 1.3) /  ($workingDays * $hours);

				$data['sunday_work_ot'] = ( $employee['Salary']['basic_pay']  /  ($workingDays * $hours) ) * $data['hours_sunday_work'] * 1.3 * 1.3;

				//sunday night diff
				$data['sunday_night_diff'] = ( $employee['Salary']['basic_pay']  /  ($workingDays * $hours) ) * $data['hours_sunday_night_diff'] * 1.3 * 0.1;
			}


			if ($legal_holiday_days > 0) {
			
				$data['legal_holiday'] = ($employee['Salary']['basic_pay'] /  ($workingDays * $hours)) * $hours;

				$data['legal_holiday_work'] = ($employee['Salary']['basic_pay'] / ($workingDays * $hours)) * $data['hours_legal_holiday_work']; //($employee['Salary']['basic_pay'] * $legal_holiday_work )  / ($workingDays * 8);

				$data['legal_holiday_work_ot'] = ($employee['Salary']['basic_pay'] / ($workingDays * $hours)) * $data['hours_sunday_work_ot'] * 2.30;

				//legal holiday sunday work
				if ($data['hours_legal_holiday_sunday_work']  > 0) {
					
					$data['legal_holiday_sunday_work'] = ($employee['Salary']['basic_pay'] / ($workingDays * $hours)) * $data['hours_legal_holiday_sunday_work'] * 2 * 1.3;
				}
				
				//legal holiday sunday ot
				if ($data['hours_legal_holiday_sunday_work_ot']  > 0) {
					
					$data['legal_holiday_sunday_work_ot'] = ($employee['Salary']['basic_pay'] / ($workingDays * $hours)) * $data['hours_legal_holiday_sunday_work_ot'] * 2.6 * 1.3;
				}

				//legal holiday work night diff
				if ($data['hours_legal_holiday_work_night_diff'] > 0) {

					$data['legal_holiday_work_night_diff'] = ($employee['Salary']['basic_pay'] / ($workingDays * $hours)) * $data['hours_legal_holiday_work_night_diff'] * 2.0 * 0.1;	
				}

				//legal holiday sunday work night diff
				if ($data['hours_legal_holiday_sunday_work_night_diff'] > 0) {

					$data['legal_holiday_sunday_work_night_diff'] = ($employee['Salary']['basic_pay'] / ($workingDays * $hours)) *  $data['hours_legal_holiday_sunday_work_night_diff'] * 2.6 * 1.3 * 1.1;//$daily * 2.6 * 1.3 * 1.1 * $data['hours_legal_holiday_sunday_work_night_diff'];
				}
				
				//legal holiday sunday work night diff ot	
				if ($data['hours_legal_holiday_sunday_work_night_diff_ot'] > 0) {

					$data['legal_holiday_sunday_work_night_diff_ot'] = ($employee['Salary']['basic_pay'] / ($workingDays * $hours)) *  $data['hours_legal_holiday_sunday_work_night_diff'] * 2.6 * 1.3 * 1.1;
				}
			
			//$data['legal_holiday_work_new'] = ($employee['Salary']['basic_pay'] * $legal_holiday_work )  / ($workingDays * 8);
			}

			if ($special_days > 0) {

				$data['special_holiday'] = ($employee['Salary']['basic_pay'] /  ($workingDays * $hours)) * $hours;

				//$data['special_holiday_new'] = ($employee['Salary']['basic_pay'] * $special_holiday_hours ) /  ($workingDays * $hours);

				$data['special_holiday_work'] = ($employee['Salary']['basic_pay'] /  ($workingDays * $hours)) * $data['hours_special_holiday_work']; //($employee['Salary']['basic_pay'] * $special_holiday_work )  / ($workingDays * 8);
				
				$data['special_holiday_work_ot'] = ($employee['Salary']['basic_pay'] / ($workingDays * $hours)) * $data['hours_special_holiday_work_ot'] * 1.3 * 1.3;

				if ($data['hours_special_holiday_sunday_work']  > 0) {
					
					$data['special_holiday_sunday_work'] = ($employee['Salary']['basic_pay'] /  ($workingDays * $hours)) * $data['hours_special_holiday_sunday_work'] * 1.5;
				}

				if ($data['hours_special_holiday_sunday_work_ot']  > 0) {
					
					$data['special_holiday_sunday_work_ot'] = ($employee['Salary']['basic_pay'] /  ($workingDays * $hours)) * $data['hours_special_holiday_sunday_work_ot'] * 1.3 * 1.3;
				}

				if ($data['hours_special_holiday_sunday_work_night_diff'] > 0) {
					
					$data['special_holiday_sunday_work_night_diff'] = ($employee['Salary']['basic_pay'] /  ($workingDays * $hours)) *  $data['hours_special_holiday_sunday_work_night_diff'] * 1.3 * 0.1;
				}

				if ($data['hours_special_holiday_sunday_work_night_diff_ot'] > 0) {

					$data['legal_special_sunday_work_night_diff_ot'] = ($employee['Salary']['basic_pay'] /  ($workingDays * $hours)) * $data['hours_special_holiday_sunday_work_night_diff_ot'] * 1.5 * 1.3 * 1.1;
				}
			}

			foreach ($data as $pay_keys => $list) {
				
				if (in_array($pay_keys,array('regular','OT','legal_holiday','legal_holiday_work','night_diff_legal_holiday', 'night_diff_legal_holiday_work', 'special_holiday', 'special_holiday_work', 'night_diff_special_holiday', 'night_diff_special_holiday_work','sunday_work','sunday_work_ot','night_diff_sunday_work','night_diff_sunday_work_ot','legal_special_sunday_work_night_diff_ot','leave'))) {
								
					$data['gross'] += $list;

				}
			}

			//excess overtime
			if ($data['hours_excess_ot'] > 0) {
				$data['excess_ot']  = ($employee['Salary']['basic_pay'] /  ($workingDays * $hours) ) * $data['hours_excess_ot'] * 1.25;
			}

 

    	} else {

    	$monthly = $employee['Salary']['basic_pay']  * 12 / 365 * 30.4165;
		
		//regular working hours = 48 hours per week
    	//96 per half month
    	//192 per month
    	$daily = $monthly / 192;

		//$data['regular'] = ($employee['Salary']['basic_pay'] * $data['total_hours']) /  ($workingDays * $hours);
		$data['regular'] = $daily * $data['hours_regular'];

		//$data['OT_new'] =  ($employee['Salary']['basic_pay'] * $data['hours_ot'] * 1.25 ) / ($workingDays * $hours);
		$data['OT'] = $daily * $data['hours_ot'] * 1.25;
		
		if ( $data['hours_night_diff'] > 0) {

			$data['night_diff'] = $daily * 0.10 * $data['hours_night_diff'];
		}
		
		if ( $data['hours_night_diff_ot'] > 0) {

			$data['night_diff_ot'] = $daily * 1.25 * 1.1 * $data['hours_night_diff_ot'];

		}

		//sunday work
		if ($sunday_days > 0) {

			$data['sunday_work'] = $daily * $data['hours_sunday_work'] * 1.3;

			$data['sunday_work_ot'] = $daily * $data['hours_sunday_work_ot'] * 1.3 * 1.3;

			//sunday night diff
			$data['sunday_night_diff'] = $daily * 1.3 * 0.1 * $data['hours_sunday_night_diff'];
		}

		if ($legal_holiday_days > 0) {
			
			$data['legal_holiday'] = $daily * $hours; //($employee['Salary']['basic_pay'] * $legal_holiday_hours ) /  ($workingDays * $hours);

			$data['legal_holiday_work'] = $daily * $data['hours_legal_holiday_work']; //($employee['Salary']['basic_pay'] * $legal_holiday_work )  / ($workingDays * 8);

			$data['legal_holiday_work_ot'] = $daily * $data['hours_sunday_work_ot'] * 2.30;

			//legal holiday sunday work
			if ($data['hours_legal_holiday_sunday_work']  > 0) {
				
				$data['legal_holiday_sunday_work'] = $daily * $data['hours_legal_holiday_sunday_work'] * 2 * 1.3;
			}
			
			//legal holiday sunday ot
			if ($data['hours_legal_holiday_sunday_work_ot']  > 0) {
				
				$data['legal_holiday_sunday_work_ot'] = $daily * $data['hours_legal_holiday_sunday_work_ot'] * 2.30;
			}

			//legal holiday work night diff
			if ($data['hours_legal_holiday_work_night_diff'] > 0) {

				$data['legal_holiday_sunday_work_night_diff'] = $daily * 2.0 * 0.1 * $data['hours_legal_holiday_work_night_diff'];
			}

			//legal holiday sunday work night diff
			if ($data['hours_legal_holiday_sunday_work_night_diff'] > 0) {

				$data['legal_holiday_sunday_work_night_diff'] = $daily * 2.6 * 1.3 * 1.1 * $data['hours_legal_holiday_sunday_work_night_diff'];
			}
			
			//legal holiday sunday work night diff ot	
			if ($data['hours_legal_holiday_sunday_work_night_diff_ot'] > 0) {

				$data['legal_holiday_sunday_work_night_diff_ot'] = $daily * 2.0 * 1.3 * 1.3 * $data['hours_legal_holiday_sunday_work_night_diff'];
			}
			
			//$data['legal_holiday_work_new'] = ($employee['Salary']['basic_pay'] * $legal_holiday_work )  / ($workingDays * 8);
		}	

		if ($special_days > 0) {

			$data['special_holiday'] = $daily * $special_holiday_hours;  

			//$data['special_holiday_new'] = ($employee['Salary']['basic_pay'] * $special_holiday_hours ) /  ($workingDays * $hours);

			$data['special_holiday_work'] = $daily * $data['hours_special_holiday_work']; //($employee['Salary']['basic_pay'] * $special_holiday_work )  / ($workingDays * 8);
			
			$data['special_holiday_work_ot'] = $daily * $data['hours_sunday_work_ot'] * 1.3 * 1.3;

			if ($data['hours_special_holiday_sunday_work']  > 0) {
				
				$data['special_holiday_sunday_work'] = $daily * $data['hours_special_holiday_sunday_work'] * 1.5;
			}

			// if ($data['hours_special_holiday_sunday_work_night_diff'] > 0) {
				
			// 	$data['special_holiday_sunday_work_night_diff'] = $daily * 2.0 * 0.1 * $data['hours_special_holiday_sunday_work_night_diff'];
			// }

			if ($data['hours_special_holiday_sunday_work_night_diff_ot'] > 0) {

				$data['legal_special_sunday_work_night_diff_ot'] = $daily * 1.5 * 1.3 * 1.31 * $data['hours_special_holiday_sunday_work_night_diff_ot'];
			}
		
		}
 
		foreach ($data as $pay_keys => $list) {
			
			if (in_array($pay_keys,array('regular','OT','legal_holiday','legal_holiday_work','night_diff_legal_holiday', 'night_diff_legal_holiday_work', 'special_holiday', 'special_holiday_work', 'night_diff_special_holiday', 'night_diff_special_holiday_work','sunday_work','sunday_work_ot','night_diff_sunday_work','night_diff_sunday_work_ot','leave'))) {
							
				$data['gross'] += $list;
			}
		}

		//excess overtime
		if ($data['hours_excess_ot'] > 0) {
			$data['excess_ot']  = ($employee['Salary']['basic_pay'] * $data['hours_excess_ot'] * 1.25) / $workingDays;
		}



    	}
    	//get daily rate
		
		$data['gross'] = $data['gross'];

    	}


		$data['hours_regular'] = $this->addWorkTime($times);

    }

    	return $data;
    }


	public function gross_pay($attendance = null,$salaries = null,$hours = 8, $models = array()) {

		$data['gross'] = 0;
		$data['time_work'] = 0;
		$data['days'] = 0;
		$data['total_hours'] = 0;
		$data['hours_ot'] = 0;
		$data['regular'] = 0;
		$data['OT'] = 0;
		$data['legal_holiday'] = 0;
		$data['legal_holiday_work'] = 0;
		$data['legal_holiday_work_ot'] = 0;
		$data['total'] =  0;
		$data['total_hours'] =  0;
		$data['hours_ot'] =  0;
		$data['regular'] =  0;
		$data['OT'] =  0;
		$data['night_diff'] =  0;
		$data['night_diff_ot'] =  0;
		$data['legal_holiday'] =  0;
		$data['legal_holiday_work'] =  0;
		$data['night_diff_legal_holiday'] =  0;
		$data['night_diff_legal_holiday_work'] =  0;
		$data['special_holiday'] =  0;
		$data['special_holiday_work'] =  0;
		$data['special_holiday_work_ot'] =  0;
		$data['night_diff_special_holiday'] =  0;
		$data['night_diff_special_holiday_work'] =  0;
		$data['sunday_work'] =  0;
		$data['sunday_work_ot'] =  0;
		$data['night_diff_sunday_work'] =  0;
		$data['night_diff_sunday_work_ot'] =  0;
		$data['leave'] =  0;
		$data['sunday_legal_holiday'] =  0;
		$data['sunday_work_legal_holiday'] =  0;


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
	$days['total_hours'] = 0;
	$days['hours_ot'] =  0;
	$days['regular'] =  0;
	$days['OT'] = 0;
	$days['night_diff'] = 0;
	$days['night_diff_ot'] = 0;
	$days['legal_holiday'] = 0;
	$days['legal_holiday_work'] = 0;
	$days['night_diff_legal_holiday'] = 0;
	$days['night_diff_legal_holiday_work'] = 0;
	$days['special_holiday'] = 0;
	$days['special_holiday_work'] = 0;
	$days['special_holiday_work_ot'] = 0;
	$days['night_diff_special_holiday'] = 0;
	$days['night_diff_special_holiday_work'] = 0;
	$days['sunday_work'] = 0;
	$days['sunday_work_ot'] = 0;
	$days['night_diff_sunday_work'] = 0;
	$days['night_diff_sunday_work_ot'] = 0;
	$days['leave'] = 0;
	
	//
	if (!empty($data['Attendance']['leave_id'])) {

		$days['leave'] = $salaries['basic_pay']; //($salaries['basic_pay'] * $days['total_hours'])	
	}


	if (!empty($data['Attendance']['in']) && !empty($data['Attendance']['out']) ) {

		if (strtotime($data['Attendance']['in']) >= strtotime($data['MyWorkshift']['from'])) {
						
			$from = new DateTime($data['Attendance']['in']);

			$to = new DateTime($data['Attendance']['out']);

			if ($data['Attendance']['out'] > $data['MyWorkshift']['to']) {
				
				$to = new DateTime( $data['MyWorkshift']['to'] );

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

			}


		} else {

			$days['regular'] = ($salaries['basic_pay'] * $days['total_hours']) / $hours;

			//check if OT
			if (!empty($data['Attendance']['overtime_id'])) {
				
				$data['hours_ot'] = 0;
				$Overtime = ClassRegistry::init('Overtime');

				//$overtime = $Overtime->read(null,$data['Attendance']['overtime_id']);

				if  ($data['Attendance']['out'] > $data['MyWorkshift']['to']) {
					
					$from  =  new DateTime($data['MyWorkshift']['to']);
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
		$employees = 0;
		$employer = 0;
		$compensation = 0;
		$pay = array();

		$pay['sss_employees'] = 0;
		$pay['sss_employer'] = 0;

		$pay['sss_compensation'] = 0;


		$government_record = array();

		if  (!empty($models['GovernmentRecord'])) {

			foreach ($models['GovernmentRecord'] as $key => $gov_values) {
			//pr($gov_values['agency_id']);	
			
				if ($gov_values['agency_id'] == 1) {
					
					$government_record[$gov_values['agency_id']] = $gov_values['value'];
				
				}
			
			}
		}
		

		// pr($government_record);
		$conditions = array();

		//contribution schedules 
		/*
		1. semi monthly equal
		2. first payroll
		3. second payroll
		*/



		if (!empty($models['Contibution'][1])) {

			$SssRange = ClassRegistry::init('Payroll.SssRange');


			switch ($models['Contibution'][1]) {
				case '1':

				if ( $gross_pay != 0 && (!empty($government_record[1])) ) {
						
						$conditions = array('SssRange.credits <=' => $gross_pay );
						
						$range = $SssRange->find('first',array('conditions' => $conditions, 'order' => 'SssRange.credits DESC'));




						$pay['sss_employees'] = !empty($range['SssRange']['employees']) ? $range['SssRange']['employees'] : $pay;
				}	
				break;

				case '2':

				if ( $gross_pay != 0 && (!empty($government_record[1])) && $sched == 'first' ) {
						
						$conditions = array('SssRange.credits <=' => $gross_pay );
						
						$range = $SssRange->find('first',array('conditions' => $conditions ,'order' => 'SssRange.credits DESC'));

							$pay['sss_employees'] = !empty($range['SssRange']['employees']) ? $range['SssRange']['employees'] : $pay;
				}
				case '3':	
				
				if ( $gross_pay != 0 && (!empty($government_record[1])) && $sched == 'second' ) {
						
						$conditions = array('SssRange.credits <=' => $gross_pay );
						
						$range = $SssRange->find('first',array('conditions' => $conditions ,'order' => 'SssRange.credits DESC'));

							$pay['sss_employees'] = !empty($range['SssRange']['employees']) ? $range['SssRange']['employees'] : $pay;
				}
				case '4':	
				
				if ( $gross_pay != 0 && (!empty($government_record[1]))) {
						
						$conditions = array('SssRange.credits <=' => $gross_pay );
						
						$range = $SssRange->find('first',array('conditions' => $conditions ,'order' => 'SssRange.credits DESC'));

							$pay['sss_employees'] = !empty($range['SssRange']['employees']) ? $range['SssRange']['employees'] : $pay;
				}
			}
		
		}

		 $pay['sss_employer'] = !empty($range['SssRange']['employers']) ? $range['SssRange']['employers'] : $employer;

		 $pay['sss_compensation'] = !empty($range['SssRange']['employee_compensations']) ? $range['SssRange']['employee_compensations'] : $compensation;

		foreach ($government_record as $key => $list) {
			
			//
			$pay['sss_id'] = $key;
		
		 //!empty($list['SssRange']['employee_compensations']) ? $range['SssRange']['employee_compensations'] : $compensation;
		}

		return $pay;
	}

	public function philhealth_pay($attendance = null,$salaries = null,$sched = 'first',$gross_pay = 0 ,$models = array()){

		//sss agency id = ;

		$pay = 0;
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

		$PhRange = ClassRegistry::init('Payroll.PhilHealthRange');

		if ( $gross_pay != 0 && (!empty($government_record[2])) ) {
				
				$conditions = array('PhilHealthRange.range_from >=' => $gross_pay);
				$range = $PhRange->find('first',array('conditions' => $conditions ));
				$pay = !empty($range['PhilHealthRange']['employee']) ? $range['PhilHealthRange']['employee'] : $pay;
			
		}

		return $pay;

	}


	public function pagibig_pay($attendance = null,$salaries = null,$sched = 'first',$gross_pay = 0,$models = array()){

		//pagibig agency id = 2;
		$pay = 0;
		$government_record = array();

		if  (!empty($models['GovernmentRecord'])) {

			foreach ($models['GovernmentRecord'] as $key => $gov_values) {
				$government_record[$gov_values['agency_id']] = $gov_values['value'];
			}
		}
		
		if ( $gross_pay != 0 && !empty($government_record['2'])) {
				
				// $phRange = ClassRegistry::init('PhilHealthRange');
				// $conditions = array('PhilHealthRange.range_from >=' => $gross_pay);
				// $range = $phRange->find('first',array('conditions' => $conditions ));
				// $pay = !empty($range['PhilHealthRange']['employee']) ? $range['PhilHealthRange']['employee'] : $pay;
				// $pay = $range['PhilHealthRange']['employees'];

			$pay = '100.00';
		}

		return $pay;

	}


	public function computeMonthlySalary($data = null){


			if (!empty($data)) {
				
				$empData = array();

				//sort by employee_id
				$sorted = array();

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
				
				$empData = array();

				//sort by employee_id
				$sorted = array();

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

			$conditions = array(
				'Deduction.from <=' => $customDate['start'],
				'Deduction.to >=' => date('Y-m-t',strtotime($customDate['end'])),
				'Deduction.employee_id' => $employee_id,
				'Deduction.is_deleted' => 0
				);

			$Deduction->bind(array('Loan'));

			$deductions = $Deduction->find('all',
				array(
					'conditions' => $conditions,
					'group' => array('Deduction.id') 
					)
				);
			

			$my_deductions = array();

			foreach ($deductions as $deduction_key => $deduct) {
				
				$my_deductions[$deduction_key]['id'] =  $deduct['Deduction']['id'];
				$my_deductions[$deduction_key]['type'] =  $deduct['Deduction']['type'];

				$my_deductions[$deduction_key]['name'] =  $deduct['Loan']['name'];
				$my_deductions[$deduction_key]['mode'] =  $deduct['Deduction']['mode'];
				$my_deductions[$deduction_key]['amount'] = 0;
				
				$conditions = array(
					'Amortization.payroll_date >=' => $customDate['start'] , 
					'Amortization.payroll_date <=' => $customDate['end'] ,
					'Amortization.deduction_id' => $deduct['Deduction']['id'],
					'Amortization.status' => 0
				);

				$amortizations = $Amortization->find('all',array('conditions' => $conditions ));	
		
				$amortizationIds = array();

				$deductAmount = 0;

				foreach ($amortizations as $amortization_key => $amortization) {

						$amortizationIds[] = $amortization['Amortization']['id'];

						$my_deductions[$deduction_key]['amount'] += $amortization['Amortization']['deduction'];

						$deductAmount += $my_deductions[$deduction_key]['amount'];

						if ($update == true) {
							
							$save['id'] = $amortization['Amortization']['id'];
							
							$save['balance'] = $amortization['Amortization']['balance'] + $my_deductions[$deduction_key]['amount'];

							if ($save['balance'] == $my_deductions[$deduction_key]['amount']) {
								
								$save['status'] = 1;
							}

							$Amortization->save($save);
						}
				}
				//check if no amortization left
				$amort = $Amortization->find('all',array( 
					'conditions' => array('Amortization.deduction_id' => $deduct['Deduction']['id'], 'status' => 0)));
					
				if (empty($amort) &&  $update == true) {

					$save['status'] = 1;
					
				}

				if ($update == true) {

					$save['id'] = $deduct['Deduction']['id'];
					$save['paid_amount'] = $deduct['Deduction']['paid_amount'] + $deductAmount;

					$Deduction->save($save);
				}


			}

			return $my_deductions;
			
		}
	}



	public function computeTax($data = null,$grossPay = null,$type = 'semi_monthly',$minimumWage = null) {

		
		$Tax = ClassRegistry::init('Tax');

		$TaxDeduction = ClassRegistry::init('TaxDeduction');

		$taxStatus = $data['Salary']['tax_status'];

		$total_tax = 0;

		$minimumWage['Wage']['amount'] = !empty($minimumWage) ? $minimumWage : '315.00';

		if (!empty($minimumWage)) {


		if ($data['Salary']['basic_pay'] >= $minimumWage['Wage']['amount']) {

				$code = 'Z';

				if (in_array($taxStatus,array('S','M'))) {
					$code = 'S_ME';
				}
				else if (in_array($taxStatus,array('S1','M1'))) {
					$code = 'S1_ME1';
				}
				else if (in_array($taxStatus,array('S2','M2'))) {
					$code = 'S2_ME2';
				}
				else if (in_array($taxStatus,array('S3','M3'))) {
					$code = 'S3_ME3';
				}
				else if (in_array($taxStatus,array('S4','M4'))) {
					$code = 'S4_ME4';
				} else {

				}

				$conditions = array('Tax.type' => $type, 'Tax.code' => $code);

				$taxes = $Tax->find('first',array('conditions' => $conditions )); 

				$count = 1;

				$range = 0;

				$taxKey = '';

				for ($i=1; $i < 8 ; $i++) { 
						
						//pr($taxes['Tax']['taxes_'.$i]);
					if ( ( $grossPay >= $taxes['Tax']['taxes_'.$i] ) && $grossPay > $taxes['Tax']['exempt_rate']) {
						$range = $taxes['Tax']['taxes_'.$i];
						$taxKey = $i;
					}
				}

				$conditions = array('TaxDeduction.type' => $type);

				$taxDeductList = $TaxDeduction->find('first',array('conditions' => $conditions));

				//computations
				if (!empty($taxKey)) {

					//$total_tax = $netPay - $range / $taxDeductList['TaxDeduction']['tax_'.$taxKey.'_percent'];
					$total_tax = (double)$grossPay - (double)$range;
					$total_tax = $total_tax * (str_replace('%','',$taxDeductList['TaxDeduction']['tax_'.$taxKey.'_percent']) / 100);
					$total_tax = $total_tax +  $taxDeductList['TaxDeduction']['tax_'.$taxKey];

				}

			}

		}

		return $total_tax;

	}

	private function  _checkAdjustments($adjustments = array(),$employee) {

		$adjust['amount'] = 0;

		$adjust['ids'] = '';

		if ( !empty($adjustments) ) {

			foreach ($adjustments as $key => $list) {
					
					if ($list['Adjustment']['employee_id'] == $employee['Employee']['id'] && $list['Adjustment']['is_process'] == 0) {
						
						$adjust['amount'] += $list['Adjustment']['amount'];	

						$adjust['ids'][] = $list['Adjustment']['id'];
					
					}
			}

			$adjust['ids'] = json_encode($adjust['ids']);
		}

		return $adjust;
	}


	public function getMonlyContibution($data = array(), $type = 'sss') {

	if (!empty($data)) {
				
				$empData = array();

				//sort by employee_id
				$sorted = array();

				foreach($data as $key => $item)
				{
					$sorted[$item['SalaryReport']['employee_id']][$key] = $item;
				}

				ksort($sorted, SORT_NUMERIC);


				foreach ($sorted as $sortedKey => $emp) {

					
						$empData[$sortedKey]['employee_id'] = $sortedKey;

						foreach ($emp as $empKey => $salary) {



						if ($type == 'sss') {

							if ($salary['SalaryReport']['salary_type'] == 'first') {
								$empData[$sortedKey]['SSS']['first_half'] = $salary['SalaryReport']['sss_employees'];
								$empData[$sortedKey]['SSS']['first_half_employer'] = $salary['SalaryReport']['sss_employers'];
								$empData[$sortedKey]['SSS']['number'] = $salary['SSS']['value'];
								$empData[$sortedKey]['SSS']['first_half_compensation'] = $salary['SalaryReport']['sss_employers'];
							}
							if ($salary['SalaryReport']['salary_type'] == 'second') {
								$empData[$sortedKey]['SSS']['second_half'] = $salary['SalaryReport']['sss_employees'];
								$empData[$sortedKey]['SSS']['second_half_employer'] = $salary['SalaryReport']['sss_employers'];
								$empData[$sortedKey]['SSS']['number'] = $salary['SSS']['value'];
								$empData[$sortedKey]['SSS']['second_half_compensation'] = $salary['SalaryReport']['sss_compensation'];
							}
							
						}

							$empData[$sortedKey]['Employee'] = $salary['Employee'];

							
						}				
				}


				return $empData;
			
			}
	}



}
?>