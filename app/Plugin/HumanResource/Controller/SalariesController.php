<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


App::import('Vendor', 'DOMPDF', true, array(), 'dompdf'.DS.'dompdf_config.inc.php', false);

//App::import('PHPWord', 'Vendor');

App::import('Vendor', 'PHPWord', array('file' => 'PHPWord'.DS.'PHPWord.php'));
//App::import('Vendor', 'PHPWord', array('file' => 'PHPWord'.DS.'src'.DS.'PhpWord'.DS.'PhpWord.php'));


class SalariesController  extends HumanResourceAppController {

	var $helpers = array('HumanResource.Salaries','HumanResource.PhpExcel');

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

	public function compute_salaries(){

		if (!empty($this->request->data)) {

			$this->loadModel('HumanResource.Attendance');
			$this->loadModel('HumanResource.Employee');
			$this->loadModel('HumanResource.Salary');
			$this->loadModel('HumanResource.GovernmentRecord');

			$emp_conditions = array();//array('Employee.status NOT' => array('1'));
			$this->Employee->bind(array('Salary','GovernmentRecord'));

			$employees = $this->Employee->find('all',array(
								'conditions' => $emp_conditions,
								'order' => array('Employee.last_name ASC'),
								'group' => array('Employee.id')
							));

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

			//$this->Components->load('HumanResource.SalaryComputation');

			$this->loadModel('HumanResource.SalaryReport');

			$this->loadModel('Payroll.Deduction');

			$this->loadModel('Payroll.Amorization');

			$this->loadModel('HumanResource.Holiday');

			$updateDatabase = false;

			$salaries = $this->SalaryComputation->calculateBenifits($employees,$payScheds,$customDate,$updateDatabase);

			//save for salary report
			if (!empty($salaries) && $updateDatabase) {

				$this->SalaryReport->saveAll($salaries);
			}

			$this->set(compact('employees','customDate','payScheds','salaries'));

		}

		$this->render('Salaries/ajax/calculate_salaries');

	}

	public function export_salaries_report($type) {

		$query = $this->request->query;

		if (!empty($this->request->query)) {

			$this->loadModel('HumanResource.Attendance');
			$this->loadModel('HumanResource.Employee');
			$this->loadModel('HumanResource.Salary');
			$this->loadModel('HumanResource.GovernmentRecord');

			$emp_conditions = array(); //array('Employee.status NOT' => array('1'));

			$this->Employee->bind(array('Salary','GovernmentRecord'));

			$employees = $this->Employee->find('all',array(
								'conditions' => $emp_conditions,
								'order' => array('Employee.last_name ASC'),
								'group' => array('Employee.id')
							));

			$conditions = array('Attendance.in NOT' => '','Attendance.out NOT' => '');

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

			$this->loadModel('Payroll.Amorization');

			$this->loadModel('HumanResource.Holiday');

			$updateDatabase = true;

			$salaries = $this->SalaryComputation->calculateBenifits($employees,$payScheds,$customDate,$updateDatabase);

			//save for salary report
			if (!empty($salaries) && $updateDatabase) {

				$this->SalaryReport->saveAll($salaries);
			}

			$payTypes = array(
				'Earnings' => array('regular_work','regular_work_ot','regular_holiday','regular_holiday_work','regular_holiday_work_ot','ctpa','sea','allowance'),
				'Deductions' => array('uniform','penalty','total_deduction')
			);

			$this->set(compact('employees','customDate','payScheds','days','date','payrollDate','salaries','payTypes'));

				//pr($salaries); exit();
			switch ($type) {


			case 'payslip':
				$this->render('Salaries/payslip/payslip');
                break; 	
            case 'excel':
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

		$this->loadModel('SssRange');
		$conditions = array();
		$ranges = $this->SssRange->find('all',array(
			'conditions' => $conditions,
			'order' => array('SssRange.range_from ASC')
		 ));

		$this->set(compact('ranges'));
		$this->render('/Salaries/sss_table');

	}

	public function philhealth_table() {

	 	$this->loadModel('PhilHealthRange');

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
		$this->loadModel('HumanResource.Employee');

		$conditions = array();
		$employeeList = $this->Employee->getList($conditions);	

		$limit = 10;
		$defaultId = current(array_flip($employeeList));

        $conditions = array('Deduction.employee_id' => $defaultId);	

        $params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Deduction.from ASC',
	    );

		$this->paginate = $params;

		$this->Deduction->bind(array('Employee'));

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

		$this->set(compact('employeeList'));
	}

	public function reports(){
		
		$date = date('m-Y');


		$this->set(compact('date'));

		$this->render('Salaries/reports/reports');
	}

	public function getSalaries() {

		$query = $this->request->query;

		if (!empty($query)) {

			$this->Components->load('HumanResource.SalaryComputation');

			$this->loadModel('HumanResource.SalaryReport');

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

					$payment[$key]['less'] = number_format($total_payment,2);
					$payment[$key]['deduction'] = number_format($total,2);
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


}