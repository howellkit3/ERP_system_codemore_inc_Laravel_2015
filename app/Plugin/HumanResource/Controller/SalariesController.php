<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

App::import('Vendor', 'DOMPDF', true, array(), 'dompdf'.DS.'dompdf_config.inc.php', false);

//App::import('PHPWord', 'Vendor');
App::import('Vendor', 'PHPWord', array('file' => 'PHPWord'.DS.'PHPWord.php'));


class SalariesController  extends HumanResourceAppController {

	var $helpers = array('HumanResource.Salaries','HumanResource.PhpExcel','HumanResource.CustomEmployee','HumanResource.CustomText');

	public $components = array('HumanResource.SalaryComputation');

	public function index() {

		$date = date('Y-m-d');
		$search = '';
		$this->set(compact('date','search'));
	}

	public function settings(){

	}
	public function employee_settings($id = null) {

		$this->loadModel('HumanResource.Employee');
		
		if (!empty($this->request->data)) {

			if ($this->Salary->save($this->request->data['Salary'])) {

				$this->Session->setFlash('Salary Setting is now updated','success');
	 		
			} else {

				$this->Session->setFlash('There\'s an error saving','error');
			}

			$this->redirect( array(
			     'controller' => 'salaries', 
			     'action' => 'employee_settings',
			     $this->request->data['Salary']['employee_id']
			));
		}	
		if (!empty($id)) {


			$this->request->data = $this->Salary->find('first',array('conditions' => array('Salary.employee_id' => $id)));

			$employee = $this->Employee->find('first',array('conditions' => array('Employee.id' => $id)));

			$this->set(compact('employee'));

		}
	}

	public function calculate(){

		$this->loadModel('HumanResource.Department');

		$department = '';

		$departments = $this->Department->getList();

		$this->set(compact('departments','department'));
	}

	public function export(){

		$date = date('m-Y');
		$search = '';
		$this->set(compact('date','search'));
	}


	public function checkEmployeeGross() {

		if (!empty($this->request->data)) {
			$employeeId = $this->request->data['employee_id'];
			$dateRange = $this->request->data['date_range'];

			$salary = array(
					'first_half' => date('Y/m/01'). ' - '.date('Y/m/15') ,
					'second_half' => date('Y/m/15'). ' - '.date('Y/m/t')
			);

			$salaryDate = array();

			foreach ($salary as $key => $value) {

			
			if (strpos($dateRange, '-') !== false) {

					$date = explode('-',$value);

					$salaryDate[$key]['from'] = trim($date[0]);
					$salaryDate[$key]['to'] = trim($date[1]);

			} else {
				
				$date = explode('-',$value);

				$salaryDate[$key]['from'] = trim($date[0]);
				$salaryDate[$key]['to'] = trim($date[1]);

			}

			$salary[$key] = $this->compute_salaries($employeeId, $salaryDate[$key]);
			$salary[$key]['payroll_date'] = date('Y/m/01');

			}

			$this->set(compact('salary'));
			
			$this->render('Salaries/ajax/gross');
		}
	}



	public function compute_salaries($employeeId = null, $dateRange = null){

		if (!empty($this->request->data)) {

			$this->loadModel('HumanResource.Attendance');
			$this->loadModel('HumanResource.Employee');
			$this->loadModel('HumanResource.Department');
			$this->loadModel('HumanResource.Position');
			$this->loadModel('HumanResource.Salary');
			$this->loadModel('HumanResource.GovernmentRecord');
			$this->loadModel('HumanResource.Holiday');	
			$this->loadModel('Payroll.SalaryReport');	
			$this->loadModel('Payroll.Payroll');	


			$emp_conditions = array();//array('Employee.status NOT' => array('1'));

			if (!empty($employeeId)) {
				array('Employee.id' => $employeeId);	
			}

			$this->Employee->bind(array('Salary','GovernmentRecord'));

			$employees = $this->Employee->find('all',array(
								'conditions' => $emp_conditions,
								'order' => array('Employee.last_name ASC'),
								'group' => array('Employee.id')
							));
			
			$conditions = array();

			if (!empty($this->request->data['range'])) {

				$query = $this->request->data['range'];

				$conditions = array('Attendance.in NOT' => '','Attendance.out NOT' => '');

				$days = explode(':', $query['days']);

				$date = explode('-', $query['month']);

				$customDate['start'] = $date[1].'-'.$date[0].'-'.sprintf("%02d", $days[0]);

				$customDate['end'] = $date[1].'-'.$date[0].'-'.sprintf("%02d", $days[1]);

				$payScheds = ( $days[0] == '16' ) ? 'second' : 'first';

				$conditions = array_merge($conditions,array(
						'Attendance.date >=' => $customDate['start'],
						'Attendance.date <=' => $customDate['end']
					));

			}

			if (!empty($dateRange) ) {


				$customDate['start'] = $dateRange['from'];
				$customDate['end'] = $dateRange['to'];

				$payScheds = ( $customDate['start'] == date('Y-m-15') ) ? 'second' : 'first';

				$conditions = array_merge($conditions,array(
						'Attendance.date >=' =>  $dateRange['from'],
						'Attendance.date <=' => $dateRange['to']
				));


			}
			

			foreach ($employees as $key => $emp) {

				if (!empty($emp['GovernmentRecord'])) {
					$employees[$key]['Agency'] = Set::classicExtract($emp['GovernmentRecord'], '{n}.agency_id');
				}
				
				$conditions =  array_merge($conditions,array('Attendance.employee_id' => $emp['Employee']['id']));

				$this->loadModel('HumanResource.WorkSchedule');

				$this->loadModel('HumanResource.WorkShift');

				$this->loadModel('HumanResource.WorkShiftBreak');

				$this->loadModel('HumanResource.BreakTime');

				$this->Attendance->bindWorkshift(); 

				$employees[$key]['Attendance'] = $this->Attendance->computeAttendance($conditions);
				
			}

			//$this->Components->load('HumanResource.SalaryComputation');
			$this->loadModel('Payroll.Deduction');
			$this->loadModel('Payroll.Amortization');			
			$this->loadModel('Payroll.OvertimeRate');
			$this->loadModel('Payroll.Contribution');
			$this->loadModel('Payroll.Loan');


			//taxes tables		
			$this->loadModel('Payroll.Tax');
			$this->loadModel('Payroll.TaxDeduction');
			$this->loadModel('Payroll.Wage');	


			$updateDatabase = false;


			$salaries = $this->SalaryComputation->calculateBenifits($employees,$payScheds,$customDate,$updateDatabase);


			//save for salary report
			if (!empty($salaries) && $updateDatabase) {

				$this->SalaryReport->saveAll($salaries);
			}

			$this->set(compact('employees','customDate','payScheds','salaries'));

		}

		$this->render('Salaries/ajax/calculate_salaries');
		//ajax
		if (!empty($dateRange) ) {
			
			return $salaries[0];

		}
		
	}

	public function export_salaries_report($type = null) {

		$query = $this->request->query;


		if (!empty($this->request->query)) {

			$this->loadModel('HumanResource.Attendance');
			$this->loadModel('HumanResource.Employee');
			$this->loadModel('HumanResource.Salary');
			$this->loadModel('HumanResource.GovernmentRecord');

			$this->loadModel('HumanResource.EmployeeAdditionalInformation');

			$emp_conditions = array(); //array('Employee.status NOT' => array('1'));

			$this->Employee->bind(array('Salary','GovernmentRecord','Department','EmployeeAdditionalInformation'));

			if (!empty($query['departments'])) {
				$emp_conditions = array_merge($emp_conditions, array(
						'Department.id' => $query['departments']
				));
			}
			if (!empty($query['bank_acount'])) {
					
					switch ($query['bank_acount']) {
						case 'yes':
								$emp_conditions = array_merge($emp_conditions, 
									array('EmployeeAdditionalInformation.bank_account_number NOT' => '')
									  
								);
							break;
						case 'no':
								$emp_conditions = array_merge($emp_conditions, array(
									'EmployeeAdditionalInformation.bank_account_number' => ''
								));
						break;	
					}
				
			}

			$employees = $this->Employee->find('all',array(
								'conditions' => $emp_conditions,
								'order' => array('Employee.last_name ASC'),
								'group' => array('Employee.id')
							));


			$conditions = array('Attendance.in NOT' => '','Attendance.out NOT' => '');

			if (!empty($this->request->query['from']) && !empty($this->request->query['to'])) {

				$customDate['start'] = $this->request->query['from'];
				$customDate['end'] = $this->request->query['to'];


				$payScheds = ( date('d',strtotime($customDate['start'])) >= '16' ) ? 'second' : 'first';

				//$payrollDate = date('F',strtotime($customDate['start'])).'-'.implode('-',$days).','.date('Y',strtotime($customDate['start']));

				$conditions = array_merge($conditions,array(
					'Attendance.date >=' => $customDate['start'],
					'Attendance.date <=' => $customDate['end']
				));



			} else {

			$days = explode(':', $query['days']);

			$date = explode('-', $query['month']);

			$customDate['start'] = $date[1].'-'.$date[0].'-'.sprintf("%02d", $days[0]);

			$customDate['end'] = $date[1].'-'.$date[0].'-'.sprintf("%02d", $days[1]);

			$payScheds = ( $days[0] == '16' ) ? 'second' : 'first';

			$payrollDate = date('F',strtotime($customDate['start'])).'-'.implode('-',$days).','.date('Y',strtotime($customDate['start']));

			$conditions = array_merge($conditions,array(
					'Attendance.date >=' => $customDate['start'],
					'Attendance.date <=' => $customDate['end']
				));


			}

			
			foreach ($employees as $key => $emp) {
				
				if (!empty($emp['GovernmentRecord'])) {
					$employees[$key]['Agency'] = Set::classicExtract($emp['GovernmentRecord'], '{n}.agency_id');
				}

				$conditions =  array_merge($conditions,array('Attendance.employee_id' => $emp['Employee']['id']));

				$this->loadModel('HumanResource.WorkSchedule');

				$this->loadModel('HumanResource.WorkShift');

				$this->loadModel('HumanResource.WorkShiftBreak');

				$this->loadModel('HumanResource.BreakTime');

				//$this->Attendance->bind(array('WorkSchedule','WorkShift','WorkShiftBreak','BreakTime'));

				$this->Attendance->bindWorkshift(); 

				$employees[$key]['Attendance'] = $this->Attendance->computeAttendance($conditions);
				
			}

			$this->loadModel('HumanResource.SalaryReport');

			$this->loadModel('Payroll.Deduction');

			$this->loadModel('Payroll.Amortization');

			$this->loadModel('HumanResource.Holiday');

			$this->loadModel('Payroll.OvertimeRate');

			$this->loadModel('Payroll.Wage');

			$this->loadModel('Payroll.Loan');

			$this->loadModel('Payroll.Contribution');

			$updateDatabase = true;

			$salaries = $this->SalaryComputation->calculateBenifits($employees,$payScheds,$customDate,$updateDatabase);

		//	pr($salaries); exit();
			//save for salary report
			// if (!empty($salaries) && $updateDatabase) {

			// 	$this->SalaryReport->saveAll($salaries);
			// }

			$this->loadModel('Payroll.Payroll');
			if (!empty($query['id'])) {
				$payroll = $this->Payroll->findById($query['id']);
			}


			$deductions = $this->Loan->find('list',array('fields' => array('id','name')));


			$payTypes = array(
				'Earnings' => array('regular_work','regular_work_ot','regular_holiday','regular_holiday_work','regular_holiday_work_ot','ctpa','sea','allowance'),
				'Deductions' => array('uniform','penalty','total_deduction')
			);

			$this->set(compact('employees','customDate','payScheds','days','date','payrollDate','salaries','payTypes','payroll','deductions'));

			if (!empty($query['type'])) {

				$type = $query['type'];
			}

			switch ($type) {

			case 'payslip':
			
				//$this->render('Salaries/payslip/payslip');
				
				//$this->layout = 'pdf';

				$view = new View(null, false);

				$view->set(compact('salaries','payroll','payrollDate','deductions'));

				$view->viewPath = 'Salaries'.DS.'pdf';	

				$view->viewPath = 'Salaries'.DS.'pdf';	
		   	
		        $output = $view->render('payslip', false);

		        $dompdf = new DOMPDF();
		        $dompdf->set_paper("A5",'portrait');
		        $dompdf->load_html(utf8_decode($output), Configure::read('App.encoding'));
		        $dompdf->render();
		        $canvas = $dompdf->get_canvas();
		        $font = Font_Metrics::get_font("helvetica", "bold");
		        $canvas->page_text(16, 800, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, array(0,0,0));

		        $output = $dompdf->output();
		        $random = rand(0, 1000000) . '-' . time();

		        if (empty($filename)) {
		        	$filename = 'payslip-record'.time();
		        }
		      	$filePath = $filename.'.pdf';

		        $file_to_save = WWW_ROOT .DS. $filePath;
		        	
		        if ($dompdf->stream( $file_to_save, array( 'Attachment'=>0 ) )) {
		        		
		        		unlink($file_to_save);
		        }

                break; 	
            case 'xls':
				$this->render('Salaries/xls/salaries_report');
                break;
            case 'csv':
                $this->layout = false;
                $this->render('csv/export');
                break;
            case 'pdf':

                $this->layout = 'pdf';

                if (!empty($data)) {
                    $this->render('sales_report');
                } else {
					$this->render('export'); 
                }

                ini_set('memory_limit', '512M');

                break;
            
        }

		}

	
        exit();
       

	}

	public function sss_table() {

		$this->loadModel('Payroll.SssRange');
		$conditions = array();
		$ranges = $this->SssRange->find('all',array(
			'conditions' => $conditions,
			'order' => array('SssRange.range_from ASC')
		 ));

		$this->set(compact('ranges'));
		$this->render('/Salaries/sss_table');

	}

	public function philhealth_table() {

	 	$this->loadModel('Payroll.PhilHealthRange');

	    $conditions = array();

	    $ranges = $this->PhilHealthRange->find('all',array(
	        'conditions' => $conditions,
	        'order' => array('PhilHealthRange.range_from ASC')
	         ));

	    //pr($ranges); exit();
	    $this->set(compact('ranges'));

		$this->render('/Salaries/philhealth_table');

	}

	public function deductions() {

		$this->loadModel('Payroll.Deduction');
		$this->loadModel('Payroll.Loan');
		$this->loadModel('HumanResource.Employee');

		$conditions = array();
		$employeeList = $this->Employee->getList($conditions);	

		$limit = 10;
		$defaultId = current(array_flip($employeeList));

        $conditions = array('Deduction.employee_id' => $defaultId, 'Deduction.is_deleted' => 0);	

        $params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Deduction.from ASC',
	    );

		$this->paginate = $params;

		$this->Deduction->bind(array('Employee','Loan'));

		$deductions = $this->paginate('Deduction');

		$this->set(compact('deductions','employeeList','defaultId'));


	}

	public function deductions_add() {

		$this->loadModel('HumanResource.Deduction');

		$this->loadModel('HumanResource.Employee');

		if ($this->request->is('post')) {

			$this->request->data['Deduction']['to'] = $this->request->data['Deduction']['from'];

			if ($this->request->data['Deduction']['mode'] == 'installment') {

				$time = explode('-', $this->request->data['Deduction']['from'] );
				$this->request->data['Deduction']['from'] = date('Y-m-d',strtotime(trim($time[0])));
				$this->request->data['Deduction']['to'] = date('Y-m-d',strtotime(trim($time[1])));

			}

			if ( $this->Deduction->save($this->request->data) ) {

				//save amortization schedules
				$this->Session->setFlash('Deduction save successfully','success');

				$this->redirect( array(
				     'controller' => 'salaries', 
				     'action' => 'deductions',
				     $this->request->data['Salary']['employee_id']
				));
	 		
			} else {

				$this->Session->setFlash('There\'s an error saving','error');

			}

			
		}	

		$conditions = array();

		$employeeList = $this->Employee->getList($conditions);

		$this->loadModel('Payroll.Loan');

		$loanTypes = $this->Loan->find('list',array('order' => 'Loan.name ASC'));

		$this->set(compact('employeeList','loanTypes'));
	}

	public function reports(){
		
		$date = date('m-Y');

		$monthly = $this->_getMonthlyReport();

		$yearly = $this->_getYearlyReport();

	
		$this->set(compact('date','monthly','yearly'));

		$this->render('Salaries/reports/reports');
	}

	private function _getMonthlyReport($date = null) {

		$this->loadModel('Payroll.SalaryReport');

		$this->Components->load('HumanResource.SalaryComputation');

		$from =  date('Y-m-01');
		$to =  date('Y-m-t');

		if (!empty($date)) {
		
			$from = date('Y-m-d',strtotime('01-'.$date));
			$to =  date('Y-m-t',strtotime('01-'.$date));
		}

		$conditions = array('AND' => array(
			'SalaryReport.from >=' => $from,
			'SalaryReport.to <='=> $to
			));


		$this->SalaryReport->bind(array('Employee'));

		$salaries = $this->SalaryReport->find('all',array( 
		'conditions' => $conditions ,
		'group' => array('SalaryReport.id'), 
		));

		$employees = $this->SalaryComputation->computeMonthlySalary($salaries);

		return $employees;

	}


	private function _getYearlyReport($date = null) {

		$this->loadModel('Payroll.SalaryReport');

		$this->Components->load('HumanResource.SalaryComputation');

		$from =  date('Y-01-01');
		$to =  date('Y-12-t');

		if (!empty($date)) {

			$from =  date($date.'-01-01');
			$to =  date($date.'-12-t');

		}

		$conditions = array('AND' => array(
			'SalaryReport.from >=' => $from,
			'SalaryReport.to <='=> $to
			));

		$this->SalaryReport->bind(array('Employee'));

		$salaries = $this->SalaryReport->find('all',array( 
		'conditions' => $conditions ,
		'group' => array('SalaryReport.id'), 
		));

		$employees = $this->SalaryComputation->computeYearlySalary($salaries);

		return $employees;

	}


	public function getSalaries() {

		$query = $this->request->query;

		if (!empty($query)) {

			$this->Components->load('HumanResource.SalaryComputation');

			$this->loadModel('Payroll.SalaryReport');

			if ($query['type'] == 'monthly') {

			$conditions = array('AND' => array(
        					'SalaryReport.from >=' => date('Y-m-d',strtotime('01-'.$query['month'])),
        					'SalaryReport.to <='=> date('Y-m-d',strtotime('31-'.$query['month']))
        					));

			$this->SalaryReport->bind(array('Employee'));

			$salaries = $this->SalaryReport->find('all',array( 
				'conditions' => $conditions ,
				'group' => array('SalaryReport.id'), 
				));
	
			$employees = $this->SalaryComputation->computeMonthlySalary($salaries);

			$this->set(compact('employees'));				

			$this->render('Salaries/ajax/monthly_salaries');

			}

			if ($query['type'] == 'yearly') {


			$from =  date($query['year'].'-01-01');
			$to =  date($query['year'].'-12-t');



			$conditions = array('AND' => array(
			'SalaryReport.from >=' => $from,
			'SalaryReport.to <='=> $to
			));



			$this->SalaryReport->bind(array('Employee'));

			$salaries = $this->SalaryReport->find('all',array( 
			'conditions' => $conditions ,
			'group' => array('SalaryReport.id'), 
			));

			$employees = $this->SalaryComputation->computeYearlySalary($salaries);


			$this->set(compact('employees'));				

			$this->render('Salaries/ajax/yearly_salaries');

			}

		

		
		}
	}

	public function export_reports() {

		if (!empty($this->request->params['named']['type'])) {

			if ($this->request->params['named']['type'] == 'monthly') {

				$query = $this->request->query;

				if (!empty($query)) {

					$month = $query['month'];

					$employees = $this->_getMonthlyReport($month);

					$this->set(compact('employees','month'));

					$this->render('Salaries/xls/monthly_salary_reports');
				}

			}

			if ($this->request->params['named']['type'] == 'yearly') {

				$query = $this->request->query;

				if (!empty($query)) {

					$year = $query['year'];

					$employees = $this->_getYearlyReport($year);

					$this->set(compact('employees','year'));

					$this->render('Salaries/xls/yearly_salary_reports');
				}

			}
		}
		return $employees;
	}


	public function computeDeduction() {


		if (!empty($this->request->data)) {

			$query = $this->request->data;

			if (!empty($query['range'])) {

				$date = explode('-',$query['range']);
				
				$datetime1 = new DateTime(trim($date[0]));

				$datetime2 = new DateTime(trim($date[1]));

				$interval = $datetime1->diff($datetime2);	

				$days = $interval->days;

				$start_date = date('Y-m-d',strtotime($date[0]));

				$end_date = date('Y-m-d',strtotime($date[1]));

				$count = 1;

				$keys = 0;

				while (strtotime($start_date) <= strtotime($end_date)) {
						
					if (in_array($start_date, array(date('Y-m-15',strtotime($start_date)),date('Y-m-t',strtotime($start_date))))) {

						$payment[$keys]['date'] = $start_date;
						$count++;
						$keys++; 
					}

					$start_date = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)));

				}

				$total_payment = $query['amount'] / count($payment);

				$total = $query['amount'];

				foreach ($payment as $key => $pay) {

					$payment[$key]['less'] = $total_payment;
					$payment[$key]['deduction'] = $total;
					$total = $total - $total_payment;

				}
				//echo json_encode($payment);

				$this->set(compact('payment'));
				
				$this->render('Salaries/ajax/compute_deductions');
			}
		}
		//exit();
	}



	//reports 

	public function sss_reports( $type = null ) {

		$date = date('m-Y');
		$this->set(compact('date'));

		if (!empty($type) && $type == 'pdf') {

			$this->loadModel('HumanResource.SalaryReport');

			$query = $this->request->query;

	        $this->SalaryReport->bind(array('Employee','EmployeeAdditionalInformation','SssRecord','Position'));
	       	
	       	$start_date = date('Y-m-01',strtotime('01-'.$query['month']));

	       	$end_date = date('Y-m-t',strtotime('01-'.$query['month']));

	       	$conditions = array('SalaryReport.from >=' => $start_date, 'SalaryReport.to <=' => $end_date);

	       	//$this->SalaryReport->virtualFields['total_sss_contribution'] = 'SUM(SalaryReport.sss)';;

	       	$salary = $this->SalaryReport->find('all',array(
	       		'conditions' => $conditions,
	       		 'fields' => array(
	       		 	'SalaryReport.id',
	       		 	'SalaryReport.employee_id',
	       		 	'SalaryReport.sss',
	       		 	'SalaryReport.total_pay',
	       		 	'Employee.last_name',
	       		 	'Employee.middle_name',
	       		 	'Employee.first_name',
	       		 	'Employee.date_hired',
	       		 	'EmployeeAdditionalInformation.birthday',
	       		 	'SssRecord.value',
	       		 	'Position.name'
	       		 	),

	       		 ));

	       	$employees = $this->SalaryReport->getTotalContribution($salary,'sss');	      	
	      	
	      	//pr($employees); exit();

			$view = new View(null, false);

			$view->set(compact('employees'));

			$view->viewPath = 'Salaries'.DS.'pdf';	
	   	
	        $output = $view->render('sss_reports', false);
	   	
	        $dompdf = new DOMPDF();
	        $dompdf->set_paper("legal", 'landscape');
	        $dompdf->load_html(utf8_decode($output), Configure::read('App.encoding'));
	        $dompdf->render();
	        $canvas = $dompdf->get_canvas();
	        $font = Font_Metrics::get_font("helvetica", "bold");
	        $canvas->page_text(16, 800, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, array(0,0,0));

	        $output = $dompdf->output();
	        $random = rand(0, 1000000) . '-' . time();

	        if (empty($filename)) {
	        	$filename = 'product-'.time().'-quotation'.time();
	        }
	      	$filePath = 'view_pdf/'.strtolower(Inflector::slug( $filename , '-')).'.pdf';

	        $file_to_save = WWW_ROOT .DS. $filePath;
	        	
	        if ($dompdf->stream( $file_to_save, array( 'Attachment'=>0 ) )) {
	        		
	        		unlink($file_to_save);
	        
	        }

	    }
			
 		$this->render('Salaries/reports/sss_reports');

	}

	public function payroll() {

		$this->loadModel('Payroll.Payroll');

		$date = date('Y-m-d');	

		$limit = 10;

		$conditions = array();

        $params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Payroll.date DESC',
	    );

		$this->paginate = $params;

		//$this->Payroll->bind(array('Payroll'));

		$payrolls = $this->paginate('Payroll');

		$this->set(compact('date','payrolls'));
	}


	public function payroll_create() {

		$this->loadModel('Payroll.Payroll');

		$date = date('Y-m-d');		

		$this->set(compact('date'));	

		$auth = $this->Session->read('Auth.User');

		if ($this->request->is('post')) {

			$data = $this->Payroll->createPayroll($this->request->data,$auth);

				
			if ($this->Payroll->save($data)) {

				//make data save in file

                 $this->Session->setFlash(__('Saving data completed.'),'success');

                $this->redirect(
                    array('controller' => 'salaries', 'action' => 'payroll_view',$this->Payroll->id)
                );

            } else {

                    $this->Session->setFlash(__('There\'s an error saving data, Please try again'),'error');
            }

		}	
	}

	public function payroll_edit($id = null ) {

		$this->loadModel('Payroll.Payroll');

		$date = date('Y-m-d');		

		$this->set(compact('date'));	

		$auth = $this->Session->read('Auth.User');

		if ($this->request->is('put')) {

			$data = $this->Payroll->createPayroll($this->request->data,$auth);

			if ($this->Payroll->save($data)) {

                 $this->Session->setFlash(__('Saving data completed.'),'success');

                $this->redirect(
                    array('controller' => 'salaries', 'action' => 'payroll_view',$this->Payroll->id)
                );

            } else {

                    $this->Session->setFlash(__('There\'s an error saving data, Please try again'),'error');
            }

		}	

		if (!empty($id)) {

			
			$this->request->data =  $this->Payroll->findById($id);	

		}
	}

	public function payroll_view($id = null) {

		$this->loadModel('Payroll.Payroll');
		
		$this->loadModel('Payroll.Loan');

		$this->loadModel('HumanResource.Department');

		if (!empty($id)) {

			$payroll = $this->Payroll->findById($id);
			
			$departments = $this->Department->find('list',array('fields' => array('id','name')));

			if ($payroll['Payroll']['status'] == 'process') {

			$payroll['Payroll']['data'] = json_decode($payroll['Payroll']['data']);

			$data =  file_get_contents("salaries/files/payroll-".$id.".txt");

			$salaries = $this->Payroll->objectToArray(json_decode($data)); 

			$deductions = $this->Loan->find('list',array('fields' => array('id','name')));
		
			// pr($salaries);
			// exit();
			
			$salarySplit = array_chunk($salaries , 10);

			if (!empty($this->params['named']['page'])) {

				$salariesList = $salarySplit[$this->params['named']['page']];

			} else {

				$salariesList = $salarySplit[0];
			}

			} else {

				$salariesList = $this->_checkPayroll($payroll);
			
			}
			
		}
		
		$this->set(compact('salaries','payroll','pages','salarySplit','salariesList','deductions','departments'));

	}

	public function process_payroll($id = null){

		if (!empty($id)) {

			$auth = $this->Session->read('Auth.User');

			$this->loadModel('Payroll.Payroll');

			$this->loadModel('Payroll.SalaryReport');

			$payroll = $this->Payroll->findById($id);

			$salaries = $this->_checkPayroll($payroll);

			if ($salaries) {


				$this->loadModel('Payroll.SalaryReport');
				//save to salary report data

				if( $this->_createReport($salaries,$auth) ) {
					$salaries = $this->_checkPayroll($payroll,true);
				}

				$payroll['Payroll']['status'] = 'process';

				$json_data = json_encode($salaries);

				$folder_path = WWW_ROOT.'/salaries/files/';

				if (!file_exists($folder_path)) {
					mkdir($folder_path, 0777, true);
				}

				file_put_contents("salaries/files/payroll-".$id.".txt", $json_data);

			}

			if ($this->Payroll->save($payroll['Payroll']) ) {

				$this->Session->setFlash(__('Payroll Process Completed.'),'success');

			} else {

                 $this->Session->setFlash(__('There\'s an error Processing Payroll, Please try again'),'error');
			}

			 $this->redirect(
	                array('controller' => 'salaries', 'action' => 'payroll_view',$id)
	            );
		}

		$this->set(compact('salaries','payroll'));
	}


	private function _createReport($salaryData = null,$auth = null) {

		$this->loadModel('Payroll.SalaryReport');

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

			return $this->SalaryReport->saveAll($report);
		}
	}

	public function reject_payroll($id) {

		if (!empty($id)) {

            $this->loadModel('Payroll.Payroll');
           
            if ($this->Payroll->delete($id)) {

                $this->Session->setFlash(
                    __('Payroll have been rejected.', h($id)), 'success'
                );

            } else {
                $this->Session->setFlash(
                    __('There\'s an error deleting the data', h($id)),'error'
                );
            }

            return $this->redirect(array('action' => 'payroll','tab' => 'payroll'));
        
		}
	}

	private function _checkPayroll($payroll = null , $update = false ){

		if (!empty($payroll)) {

			$this->loadModel('HumanResource.Attendance');
			$this->loadModel('HumanResource.Employee');
			$this->loadModel('HumanResource.EmployeeAdditionalInformation');
			$this->loadModel('HumanResource.Department');
			$this->loadModel('HumanResource.Position');
			$this->loadModel('HumanResource.Salary');
			$this->loadModel('HumanResource.GovernmentRecord');
			$this->loadModel('HumanResource.WorkSchedule');
			$this->loadModel('HumanResource.WorkShift');
			$this->loadModel('HumanResource.WorkShiftBreak');
			$this->loadModel('HumanResource.BreakTime');

			$emp_conditions = array();//array('Employee.status NOT' => array('1'));
			$this->Employee->bind(array('Salary','GovernmentRecord','Department','Position','EmployeeAdditionalInformation'));

			$employees = $this->Employee->find('all',array(
								'conditions' => $emp_conditions,
								'order' => array('Employee.last_name ASC'),
								//'fields' => array('')
								'group' => array('Employee.id')
							));

			$customDate['start'] = $payroll['Payroll']['from'];

			$customDate['end'] = $payroll['Payroll']['to'];

			$days = explode('-', $customDate['start']);

			$payScheds = ( $days[2] == '16' ) ? 'second' : 'first';

			$conditions = array();

			$conditions = array_merge($conditions,array(
					'Attendance.date >=' => $customDate['start'],
					'Attendance.date <=' => $customDate['end'] 
				));

		if (!empty($employees)) {

			foreach ($employees as $key => $emp) {
				
				$conditions =  array_merge($conditions,array('Attendance.employee_id' => $emp['Employee']['id']));
				$this->Attendance->bindWorkshift(); 
				$employees[$key]['Attendance'] = $this->Attendance->computeAttendance($conditions);
				
			}

			//$this->Components->load('HumanResource.SalaryComputation');
			$this->loadModel('HumanResource.SalaryReport');
			$this->loadModel('HumanResource.Holiday');
			$this->loadModel('HumanResource.Overtime');
			$this->loadModel('Payroll.Deduction');
			$this->loadModel('Payroll.Amortization');			
			$this->loadModel('Payroll.OvertimeRate');
			$this->loadModel('Payroll.Contribution');
			$this->loadModel('Payroll.Loan');	
			//taxes tables		
			$this->loadModel('Payroll.Tax');
			$this->loadModel('Payroll.TaxDeduction');
			$this->loadModel('Payroll.Wage');			

			//$OvertimeRate = ClassRegistry::init('Amortization')->find('all');
			$updateDatabase = !empty($update) && $update == true ? true : false;
			
			$salaries = $this->SalaryComputation->calculateBenifits($employees,$payScheds,$customDate,$updateDatabase);
			}
			else {

				$this->Session->setFlash(__('There\'s an error Processing Payroll'),'error');
				$this->redirect(array('controller' => 'salaries','action' => 'payroll'));
			}

		} 

		return $salaries;
	}

	public function export_salaries($payroll_id = null, $type = 'excel') {


		$query = $this->request->query;


		if (!empty($query)) {

			if (!empty($query['id'])) {
				$payroll_id = $query['id'];
			}

			if (!empty($query['type'])) {
				$type = $query['type'];
			}

		}
		if (!empty($payroll_id)) {

			$this->loadModel('Payroll.Payroll');
			
			$this->loadModel('Payroll.Loan');

			$this->loadModel('HumanResource.Employee');

			$this->loadModel('HumanResource.EmployeeAdditionalInformation');

			$this->loadModel('HumanResource.Salary');

			$salaries = array();
			
			$payroll = $this->Payroll->findById($payroll_id);

			$payrollDate = date('F',strtotime($payroll['Payroll']['from'])).' '.date('d',strtotime($payroll['Payroll']['from'])).'-'.date('d',strtotime($payroll['Payroll']['to'])).' '. date('Y',strtotime($payroll['Payroll']['from'])) ;

			// $payroll['Payroll']['data'] = json_decode($payroll['Payroll']['data']);

			// $salaries = $this->Payroll->objectToArray($payroll['Payroll']['data']); 

			$data = file_get_contents("salaries/files/payroll-".$payroll_id.".txt");

			$salaries = $this->Payroll->objectToArray(json_decode($data)); 

			$this->Employee->bindPrimary();

			if (!empty($query)) {

				$emp_conditions = array();

				if (!empty($query['departments'])) {
					$emp_conditions = array_merge($emp_conditions, array(
							'Employee.department_id' => $query['departments']
					));
				}

				if (!empty($query['employee_type'])) {
					$emp_conditions = array_merge($emp_conditions, array(
							'Salary.employee_salary_type' => $query['employee_type']
					));
				}

				if (!empty($query['bank_acount'])) {
					
					switch ($query['bank_acount']) {
						case 'yes':
								$emp_conditions = array_merge($emp_conditions, 
									array('EmployeeAdditionalInformation.bank_account_number NOT' => '')
									  
								);
							break;
						case 'no':
								$emp_conditions = array_merge($emp_conditions, array(
									'EmployeeAdditionalInformation.bank_account_number' => ''
								));
						break;	
					}

				}

				$filterEmp = $this->Employee->filter($emp_conditions);
				$salaries = $this->Payroll->filterData($salaries,$filterEmp);
			}

			$deductions = $this->Loan->find('list',array('fields' => array('id','name')));
			
			ini_set('max_execution_time', 3600);
			ini_set('memory_input_time', 1024);
			ini_set('max_input_nesting_level', 1024);
			ini_set('memory_limit', '1024M');

			$this->set(compact('salaries','payroll','payrollDate','deductions'));

			switch ($type) {

				case 'payslip':

				$view = new View(null, false);

				$view->set(compact('salaries','payroll','payrollDate','deductions'));

				$view->viewPath = 'Salaries'.DS.'pdf';	

				$view->viewPath = 'Salaries'.DS.'pdf';	
		   	
		        $output = $view->render('payslip', false);

		        $dompdf = new DOMPDF();
		        $dompdf->set_paper("A5", 'portrait');
		        $dompdf->load_html(utf8_decode($output), Configure::read('App.encoding'));
		        $dompdf->render();
		        $canvas = $dompdf->get_canvas();
		        $font = Font_Metrics::get_font("helvetica", "bold");
		        $canvas->page_text(16, 800, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, array(0,0,0));

		        $output = $dompdf->output();
		        $random = rand(0, 1000000) . '-' . time();

		        if (empty($filename)) {
		        	$filename = 'payslip-record'.time();
		        }
		      	$filePath = $filename.'.pdf';

		        $file_to_save = WWW_ROOT .DS. $filePath;
		        	
		        if ($dompdf->stream( $file_to_save, array( 'Attachment'=>0 ) )) {
		        		
		        		unlink($file_to_save);
		        }

				$dompdf->render();
				 if ($dompdf->stream('payslip-'.$payroll['Payroll']['id'].'-'.str_replace(' ','-',strtolower($payrollDate)).'-'.time().'.pdf')){

				 	unlink($file_to_save);
				}

				exit();
                break; 	
            case 'excel':
				$this->render('Salaries/xls/salaries_report');
                break;
            case 'csv':

                break;
            case 'pdf':
				
			
                break;
            
        }

			$this->set(compact('payroll'));
		}	
	}

	public function tax_table(){

		$this->loadModel('Payroll.Tax');
		
		$this->loadModel('Payroll.TaxDeduction');

		$taxes = $this->TaxDeduction->find('all');
		
		$taxes = $this->Tax->getDeductions($taxes);

		$this->set(compact('taxes'));
	}



}