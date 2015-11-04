<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

App::import('Vendor', 'DOMPDF', true, array(), 'dompdf'.DS.'dompdf_config.inc.php', false);

//App::import('PHPWord', 'Vendor');
App::import('Vendor', 'PHPWord', array('file' => 'PHPWord'.DS.'PHPWord.php'));
//App::import('PHPReader', 'Vendor');
App::import('Vendor', 'PhpExcelReader', array('file' => 'PhpExcelReader'.DS.'excel_reader2.php'));


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
			$this->loadModel('Payroll.Setting');

			$this->loadModel('HumanResource.Overtime');
			$this->loadModel('HumanResource.OvertimeExcess');	


			$emp_conditions = array();//array('Employee.status NOT' => array('1'));

			if (!empty($employeeId)) {
			$emp_conditions = array('Employee.id' => $employeeId);	
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

			$this->loadModel('Payroll.Adjustment');	


			$updateDatabase = false;

			$payrollSettings = $this->Setting->find('first');

			$salaries = $this->SalaryComputation->calculateBenifits($employees,$payScheds,$customDate,$updateDatabase,$payrollSettings);


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

			//pr($salaries); exit();
			
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
		        // $dompdf->render();
		        $canvas = $dompdf->get_canvas();
		        $font = Font_Metrics::get_font("helvetica", "bold");
		        $canvas->page_text(16, 800, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, array(0,0,0));

		       // $output = $dompdf->output();
		       //  $random = rand(0, 1000000) . '-' . time();

		       //  if (empty($filename)) {
		       //  	$filename = 'payslip-record'.time();
		       //  }
		      	// $filePath = $filename.'.pdf';

		       //  $file_to_save = WWW_ROOT .DS. $filePath;
		        	
		       //  if ($dompdf->stream( $file_to_save, array( 'Attachment'=>0 ) )) {
		        		
		       //  		unlink($file_to_save);
		       //  }


				// Get the style section out of the HTML 
				$styles = $doc->getElementsByTagName('style'); 
				$style = $styles->item(0); 

				// Get all the divs with class page (separate pages) 
				$xpath = new DOMXPath($dompdf); 
				$pages = $xpath->query('//div[contains(@class, "page")]'); 

				// insert each page individually 
				foreach($pages as $page) { 
				    $html = $doc->saveXML($style) . $doc->saveXML($page); 
				    $dompdf->insert_html($html); 
				} 

				
				if ($dompdf->stream( $file_to_save, array( 'Attachment'=>0 ) )) {
		        		
		        	//	unlink($file_to_save);
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

	public function pagibig_table() {

	 	$this->loadModel('Payroll.PagibigRange');

	    $conditions = array();

	    $ranges = $this->PagibigRange->find('all',array(
	        'conditions' => $conditions,
	        'order' => array('PagibigRange.range_from ASC')
	    ));

	    $this->set(compact('ranges'));

		$this->render('/Salaries/pagibig_table');

	}

	public function adjustments() {


		$this->loadModel('HumanResource.Employee');

		$this->loadModel('Payroll.Adjustment');

		$conditions = array();

		$employeeList = $this->Employee->getList($conditions);

		$defaultId = current(array_flip($employeeList));

		$limit = 10;

		$conditions = array();

        $params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Adjustment.payroll_date ASC',
	    );

		$this->paginate = $params;

		$adjustments = $this->paginate('Adjustment');
		
		$this->set(compact('employeeList','defaultId','adjustments'));	
	}

	public function adjustments_add() {

		$this->loadModel('Payroll.Adjustment');

		$auth = $this->Session->read('Auth');

		if (!empty($this->request->data)) {

			if (!empty($this->request->data)) {
				$data = $this->request->data;

				$days = explode(':', $this->request->data['Adjustment']['days']);

				$date = $data['Adjustment']['year'].'-'.$data['Adjustment']['month'].'-'.sprintf("%02d", $days[0] );
				$this->request->data['Adjustment']['payroll_date'] = $date;
			}

			$this->request->data['Adjustment']['created_by'] = 
			$this->request->data['Adjustment']['modified_by'] = $auth['User']['id'];

			if ( $this->Adjustment->save($this->request->data) ) {

				//save adjustment
				$this->Session->setFlash('Adjustment save successfully','success');
			
			} else {

				$this->Session->setFlash('There\'s an error saving','error');

			}

			$this->redirect( array(
				     'controller' => 'salaries', 
				     'action' => 'adjustments',
				));
	 		

		}
	}

	public function adjustments_add_bulk() {

		if (!empty($this->request->data)) {

			$allowed = array('xls','xlsx');
			$filename = $this->request->data['Adjustment']['file']['name'];
			$fileData = pathinfo($filename);

			if (!in_array( $fileData['extension'] , $allowed)) {

				$this->Session->setFlash('Invalid File Type','error');

				$this->redirect( array(
				     'controller' => 'salaries', 
				     'action' => 'adjustments',
				));
			}

			$this->loadModel('HumanResource.Employee');

			$this->loadModel('Payroll.Adjustment');

			$data = new Spreadsheet_Excel_Reader();

			$data->setOutputEncoding('CP1251');

			$excelReader = $data->read($this->data['Adjustment']['file']['tmp_name']);
			$headings = array();

			$xls_data = array();

			for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
					$row_data = array();
					for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
						if($i == 1) {
						//this is the headings row, each column (j) is a header
							$headings[$j] = $data->sheets[0]['cells'][$i][$j];
						} else {
						//column of data
						$row_data[$headings[$j]] = isset($data->sheets[0]['cells'][$i][$j]) ? $data->sheets[0]['cells'][$i][$j] : '';
						}
					}

				if($i > 1) {
					$xls_data['Adjustment'][] = $row_data;
				}
			}

			$employeeData = array();

			foreach ($xls_data['Adjustment'] as $key => $list) {
				
				$employees = $this->Employee->findbyCode($list['Employee Code'],'first',array('id','first_name','last_name'));
				
				if (!empty($employees['Employee']['id'])) {

					$employeeData[$key]['id'] = '';
					$employeeData[$key]['employee_id'] = $employees['Employee']['id'];
					$employeeData[$key]['amount'] = $list['Amount'];
					$employeeData[$key]['reason'] =  $list['Reason'];
					$employeeData[$key]['payroll_date'] = date('Y-m-d',strtotime($list['Payroll-date']));
				}

			
			}

			$this->Adjustment->create();

			if (!empty($employeeData)) {

				if ($this->Adjustment->saveAll($employeeData)) {

					//save adjustment
					$this->Session->setFlash('Adjustment save successfully','success');
				} else {

					$this->Session->setFlash('There\'s an error saving','error');

				}
			} 
			else {

					$this->Session->setFlash('No Employee Found','error');

			}

			$this->redirect( array(
				     'controller' => 'salaries', 
				     'action' => 'adjustments',
				));
		}
	}
	public function adjustments_edit($id = null) {

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('Payroll.Adjustment');


		$auth = $this->Session->read('Auth');

		if (!empty($this->request->data)) {

			if (!empty($this->request->data)) {
				$data = $this->request->data;

				$days = explode(':', $this->request->data['Adjustment']['days']);

				$date = $data['Adjustment']['year'].'-'.$data['Adjustment']['month'].'-'.sprintf("%02d", $days[0] );
				$this->request->data['Adjustment']['payroll_date'] = $date;
			}

			$this->request->data['Adjustment']['created_by'] = 
			$this->request->data['Adjustment']['modified_by'] = $auth['User']['id'];

			if ( $this->Adjustment->save($this->request->data) ) {

				//save adjustment
				$this->Session->setFlash('Adjustment save successfully','success');
			
			} else {

				$this->Session->setFlash('There\'s an error saving','error');

			}

			$this->redirect( array(
				     'controller' => 'salaries', 
				     'action' => 'adjustments',
				));
		}

		$conditions = array();
		$employeeList = $this->Employee->getList($conditions);

		$this->loadModel('HumanResource.Employee');

		$defaultId = current(array_flip($employeeList));

		if (!empty($id)) {

			$this->request->data = $this->Adjustment->findById($id);
		}
		$this->set(compact('employeeList','defaultId'));
		$this->render('/Salaries/ajax/adjustments');
	}

	public function download_adjustment_excel() {

			$this->viewClass = 'Media';
			// Render app/webroot/files/example.docx
			$params = array(
			'id'        => 'mass_adjustment_template.xls',
			'name'      => 'mass_adjustment_template',
			'extension' => 'xlsx',
			'download'  => true,
	        'mimeType'  => array(
	            'xls' =>  "application/vnd.ms-excel"
	        ),
       		'path'      => 'files' . DS
			);
			$this->set($params);
	}


	public function download_deduction_excel() {

			$this->viewClass = 'Media';
			// Render app/webroot/files/example.docx
			$params = array(
			'id'        => 'mass_deduction_template.xls',
			'name'      => 'mass_deduction_template',
			'extension' => 'xlsx',
			'download'  => true,
	        'mimeType'  => array(
	            'xls' =>  "application/vnd.ms-excel"
	        ),
       		'path'      => 'files' . DS
			);
			$this->set($params);
	}

	public function adjustment_delete($id = null) {

		if (!empty($id)) {
		 
		 	$this->loadModel('Payroll.Adjustment');
           
            if ($this->Adjustment->delete($id)) {

                $this->Session->setFlash(
                    __('Adjustment have been deleted.', h($id)), 'success'
                );

            } else {

                $this->Session->setFlash(
                    __('There\'s an error deleting the data', h($id)),'error'
                );
            }

            return $this->redirect(array('action' => 'adjustments'));
		}
	}

	public function deductions() {

		$this->loadModel('Payroll.Deduction');

		$this->loadModel('Payroll.Loan');
		
		$this->loadModel('HumanResource.Employee');

		$conditions = array();
		
		$employeeList = $this->Employee->getList($conditions);	

		$limit = 10;
		$defaultId = current(array_flip($employeeList));

        $conditions = array('Deduction.is_deleted' => 0);	

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

	    $this->loadModel('HumanResource.Employee');

	    $this->loadModel('HumanResource.Status');

		if (!empty($this->params['named']['type']) && $this->params['named']['type'] == 'excel') {

				$query = $this->request->query;

				if (!empty($query['status'])) {
					
					$conditions = array(
							'Employee.status' => $this->request->query('status')
						);

				}
		
		}
	

		$limit = 10;

        $params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Employee.last_name ASC',
	            'group' => 'Employee.id'
	    );

		$this->paginate = $params;

		$employees =  $this->paginate('Employee');

		$status = $this->Status->getAllStatus();

		$this->set(compact('date','employees','status'));

		if (!empty($this->params['named']['type']) && $this->params['named']['type'] == 'excel') {

			$this->render('Salaries/xls/sss_report_list');

		} else {

			//$this->render('Salaries/reports/pagibig_report_lists');
			
 			$this->render('Salaries/reports/sss_reports');
		}
			

	}

	public function sss_get_contibution() {

		$this->Components->load('HumanResource.SalaryComputation');

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.Status');

		$this->loadModel('Payroll.SalaryReport');

		$this->render('Salaries/ajax/sss_contibution');

		$query = $this->request->query;

		$date = date('Y-m');

		$from = date('Y-m-01');

		$to = date('Y-m-t');
		
		$conditions = array();

		if (!empty($query['month'])) {

			$date = explode('-',$query['month']);

			$from = date('Y-m-01',strtotime(trim($date[1]).'-'.$date[0].'-01'));

			$to = date('Y-m-t',strtotime(trim($date[1]).'-'.$date[0].'-01'));

		}

		$conditions = array_merge($conditions,array(
			'date(SalaryReport.from) BETWEEN ? AND ?' => array($from,$to), 
		));


		$this->SalaryReport->bind(array('Employee','SSS'));

		$reports = $this->SalaryReport->find('all',array(
			'conditions' => $conditions
		));


		$statuses = $this->Status->getAllStatus();

		$employees = $this->SalaryComputation->getMonlyContibution($reports,'sss');

		$this->set(compact('employees','statuses'));

		$this->render('Salaries/ajax/sss_contibution');
	}
 	
	public function sss_report_lists($type = null) {

		$date = date('Y-m-d');

			$this->loadModel('HumanResource.EmployeeAdditionalInformation');

			$this->loadModel('HumanResource.GovernmentRecord');

			$this->loadModel('HumanResource.Employee');

			$this->loadModel('HumanResource.Status');

			$this->Employee->bindSSS(array('Status'));

			$conditions = array();

			if (!empty($type) && $type == 'excel') {

				$conditions = array(
						'Employee.status' => array('1','2')
					);
			} 

			$limit = 10;

	        $params =  array(
		            'conditions' => $conditions,
		            'limit' => $limit,
		            //'fields' => array('id', 'status','created'),
		            'order' => 'Employee.last_name ASC',
		            'group' => 'Employee.id'
		    );

			$this->paginate = $params;

			$employees =  $this->paginate('Employee');

			$statuses = $this->Status->getAllStatus();

			$this->set(compact('date','employees','statuses'));

			$this->render('Salaries/reports/sss_report_lists');
	}

	public function sss_report_contributions($type = null) {

	
		$this->loadModel('HumanResource.EmployeeAdditionalInformation');

		$this->loadModel('HumanResource.GovernmentRecord');

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.Status');
		
		$this->loadModel('Payroll.SalaryReport');

		$this->Employee->bindSSS(array('Status'));

		$conditions = array();

		$query = $_GET;

		if (!empty($query['month'])) {

			$date = explode('-',$query['month']);

			$from = date('Y-m-01',strtotime(trim($date[1]).'-'.$date[0].'-01'));

			$to = date('Y-m-t',strtotime(trim($date[1]).'-'.$date[0].'-01'));

			$conditions = array_merge($conditions,array(
			'date(SalaryReport.from) BETWEEN ? AND ?' => array($from,$to), 
		));


		}

		$this->SalaryReport->bind(array('Employee','SSS')); 
		
		$reports  = $this->SalaryReport->find('all',array(
			'conditions' => $conditions
		));


		$employees = $this->SalaryComputation->getMonlyContibution($reports,'sss');

		// pr($employees);
		// exit();

		$statuses = $this->Status->getAllStatus();

		$this->set(compact('date','employees','statuses'));

		$this->render('Salaries/xls/sss_contribution');
	}

	public function pagibig_reports() {

		$date = date('Y-m-d');

		$this->loadModel('HumanResource.EmployeeAdditionalInformation');

		$this->loadModel('HumanResource.GovernmentRecord');

		$this->loadModel('HumanResource.Employee');


		$this->loadModel('HumanResource.Status');
		
		$this->Employee->bindPagibig();
		
		$conditions = array(
				'Employee.status' => array('1','2')
		);

		if (!empty($this->params['named']['type']) && $this->params['named']['type'] == 'excel') {

				$query = $this->request->query;

				if (!empty($query['status'])) {
					
					$conditions = array(
							'Employee.status' => $this->request->query('status')
						);

				}
		
		}
	

		$limit = 10;

        $params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Employee.last_name ASC',
	            'group' => 'Employee.id'
	    );

		$this->paginate = $params;

		$employees =  $this->paginate('Employee');
		
		$status = $this->Status->getAllStatus();

		$this->set(compact('date','employees','status'));

		if (!empty($this->params['named']['type']) && $this->params['named']['type'] == 'excel') {

			$this->render('Salaries/xls/pagibig_report_list');

		} else {

			$this->render('Salaries/reports/pagibig_report_lists');
		}

	}

	public function reports_filter() {

		$query = $this->request->query;

		if (!empty($query)) {


		$this->loadModel('HumanResource.EmployeeAdditionalInformation');

		$this->loadModel('HumanResource.GovernmentRecord');

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.Status');

			switch ($query['type']) {
				case 'pagibig':
					$this->Employee->bindPagibig();
				break;
				case 'sss':
					$this->Employee->bindSSS();
				break;
			}

		$conditions = array();	

		if (!empty($query['status'])) {

			$conditions = array(
				'Employee.status' => $query['status']
			);
		}

		$limit = 10;

        $params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Employee.last_name ASC',
	            'group' => 'Employee.id'
	    );

		$this->paginate = $params;

		$employees =  $this->paginate('Employee');

		$status = $this->Status->getAllStatus();

		$this->set(compact('date','employees','status'));

		$this->render('Salaries/ajax/'.$query['type'].'_reports');

		}
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
	            'order' => 'Payroll.date ASC',
	    );

		$this->paginate = $params;

		//$this->Payroll->bind(array('Payroll'));

		$payrolls = $this->paginate('Payroll');

		$this->set(compact('date','payrolls'));
	}


	public function payroll_create() {


		$this->loadModel('HumanResource.Department');

		$this->loadModel('Payroll.Payroll');

		$date = date('Y-m-d');	

		$departments = $this->Department->find('list',array('fields' => array('id','notes')));

		$this->set(compact('date','departments'));	

		$auth = $this->Session->read('Auth.User');


		if ($this->request->is('post')) {

			$data = $this->Payroll->createPayroll($this->request->data,$auth);

			//redirect to employee selection
				
			if ($this->Payroll->save($data)) {

				//make data save in file
                $this->Session->setFlash(__('Saving data completed.'),'success');

                $departmentId = $this->request->data['Payroll']['department'];

                $this->redirect(
                    array('controller' => 'salaries', 'action' => 'employee_select',$this->Payroll->id, $departmentId )
                );

            } else {

                $this->Session->setFlash(__('There\'s an error saving data, Please try again'),'error');
            }

		}	
	}


	public function payroll_delete($id) {

	
		if (!empty($id)) {

			$this->loadModel('Payroll.Payroll');

			$this->loadModel('Payroll.SalaryReport');

			$payroll = $this->Payroll->read(null,$id);


			//check employees

			$employeeId = json_decode($payroll['Payroll']['employeeIds']);

			if ($this->Payroll->delete($id)) {

				//delete salary report
				$this->SalaryReport->deleteAll(array(
				'SalaryReport.from' => $payroll['Payroll']['from'],
				'SalaryReport.to' => $payroll['Payroll']['to'],
				'SalaryReport.employee_id' => $employeeId
			
			));

				$this->Session->setFlash(__('Payroll data delete successfully.'),'success');

			} else {

				  $this->Session->setFlash(__('There\'s an error deleting data, Please try again'),'error');
			}

		    $this->redirect(
                array('controller' => 'salaries', 'action' => 'payroll')
            );

		}

	}

	public function process_payroll_save() {
		
		if (!empty($this->request->data)) {

			$this->loadModel('Payroll.Payroll');


			$this->loadModel('Payroll.Loan');

			$data = $this->request->data;
			
			/* if( $this->process_payroll($data['Payroll']['payroll_id'],$data['Payroll']['emp'])) {

			} */

			$payrollData = array();

			$payroll = $this->Payroll->findById($data['Payroll']['payroll_id']);

			$payrollData['Payroll']['id'] = $data['Payroll']['payroll_id'];

			$payrollData['Payroll']['employeeIds'] = json_encode($data['Payroll']['emp']);

			$payrollData['Payroll']['status'] = 3;

			$this->Payroll->save($payrollData);

			$deductions = $this->Loan->find('all',array('fields' => array('id','name','description')));

			//exit();

			$salariesList = $this->_checkPayroll($payroll,false,$data['Payroll']['emp']);

			$this->set(compact('payroll','salariesList','deductions'));

			$this->render('Salaries/payroll_view');
				

			//	private function _checkPayroll($payroll = null , $update = false , $empConditions = array() ){
		}
	}

	public function employee_select($id = null,$departmentId = null) {

		$this->loadModel('Payroll.Payroll');

		$this->loadModel('HumanResource.Employee');

		if (!empty($id)) {

	
			$payroll = $this->Payroll->findById($id);

			//find employee by date
			//$employees = $this->Payroll->checkEmployee($payroll);

			$conditions = array();

			if (!empty($departmentId)) {

				$conditions = array_merge($conditions,array(
						'Employee.department_id' => $departmentId
				));
			}

			$employees = $this->Employee->find('all',array(
				'conditions' => $conditions,
				'order' => array('Employee.last_name ASC'),
				'fields' => array('id','code','full_name')
				));

			$this->set(compact('employees','payroll'));

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
			
			if ($payroll['Payroll']['status'] == 3) {
				  $this->redirect(
                    array(
                    	'controller' => 'salaries',
                    	'action' => 'employee_select',
                    	$payroll['Payroll']['id']
                    )
                );
			}
			$departments = $this->Department->find('list',array('fields' => array('id','name')));

			if ($payroll['Payroll']['status'] == 'process') {

			$payroll['Payroll']['data'] = json_decode($payroll['Payroll']['data']);

			if ($payroll['Payroll']['type'] == '13_month') {

				$data =  file_get_contents("salaries/files/payroll-thirteen-month-".$id.".txt");

				$salaries = $this->Payroll->objectToArray(json_decode($data)); 

			} else {

				$data =  file_get_contents("salaries/files/payroll-".$id.".txt");

				$salaries = $this->Payroll->objectToArray(json_decode($data)); 

			}

			
			$deductions = $this->Loan->find('all',array('fields' => array('id','name','description')));

			$salariesList = $salaries;


			// $salarySplit = array_chunk($salaries , 10);

			// if (!empty($this->params['named']['page'])) {

			// 	$salariesList = $salarySplit[$this->params['named']['page']];

			// } else {

			// 	$salariesList = $salarySplit[0];
			// }

			} else {

				$empIds = array();

				if (!empty($payroll['Payroll']['employeeIds'])) {

					$empIds = (array)json_decode($payroll['Payroll']['employeeIds']);

				}	

		
				switch ($payroll['Payroll']['type']) {
					case 'normal':
						$salariesList = $this->_checkPayroll($payroll,false,$empIds);

					case '13_month':
						$salariesList = $this->_checkThirteenPayroll($payroll,false,$empIds);

					break;
										
				}
			
			}

			
		}
		
		$this->set(compact('salaries','payroll','pages','salarySplit','salariesList','deductions','departments'));

		switch ($payroll['Payroll']['type']) {
					case 'normal':
						$this->render('Salaries/payroll_view');
					break;
					case '13_month':
					
						$this->render('Salaries/payroll_view_thirteen_month');

					break;
										
			}

	}

	public function process_payroll($id = null, $employeeId = array()){

		if (!empty($id)) {

			$auth = $this->Session->read('Auth.User');

			$this->loadModel('Payroll.Payroll');

			$this->loadModel('Payroll.SalaryReport');

			$this->loadModel('Payroll.Adjustment');

			$payroll = $this->Payroll->findById($id);

			if (!empty($payroll['Payroll']['employeeIds'])) {

				$employeeId = (array)json_decode($payroll['Payroll']['employeeIds']);
			}

			if ($payroll['Payroll']['type'] == '13_month') {

			 	$salaries = $this->_checkThirteenPayroll($payroll,$employeeId);
			 
			} else {
				
				$salaries = $this->_checkPayroll($payroll,null,$employeeId);
			}

			if ($salaries) {
				//save to salary report data

			 	if ($payroll['Payroll']['type'] == '13_month') {
				
					if ($this->SalaryReport->createMultipleReport($salaries,$auth)) {

						//$salaries = $this->_checkThirteenPayroll($payroll,true);
					}

					$payroll['Payroll']['status'] = 'process';

					$json_data = json_encode($salaries);

					$folder_path = WWW_ROOT.'/salaries/files/';

					if (!file_exists($folder_path)) {
						mkdir($folder_path, 0777, true);
					}

					file_put_contents("salaries/files/payroll-thirteen-month-".$id.".txt", $json_data);


				} else {



					if( $this->SalaryReport->createMultipleReport($salaries,$auth)) {

					
						$payroll['Payroll']['status'] = 'process';

						$json_data = json_encode($salaries);

						$folder_path = WWW_ROOT.'/salaries/files/';

						if (!file_exists($folder_path)) {
						mkdir($folder_path, 0777, true);
						}

						//update adjustments
						$this->Adjustment->updatePayroll($salaries);

						file_put_contents("salaries/files/payroll-".$id.".txt", $json_data);
					}

				}
				

			}

			if ($this->Payroll->save($payroll['Payroll']) ) {

				$this->Session->setFlash(__('Payroll Process Completed.'),'success');
				
				$this->redirect(
		                array('controller' => 'salaries', 'action' => 'payroll_view',$id)
		            );


			} else {

                 $this->Session->setFlash(__('There\'s an error Processing Payroll, Please try again'),'error');
			}

		
		}

		$this->set(compact('salaries','payroll'));
	}


	
	public function reject_payroll($id) {

		if (!empty($id)) {

            $this->loadModel('Payroll.Payroll');
           	
           	//find payroll
           	$payroll = $this->Payroll->read(null,$id);


            if ($this->Payroll->delete($id)) {

            	//delete salary report
				$this->SalaryReport->deleteAll(array(
				'SalaryReport.from' => $payroll['Payroll']['from'],
				'SalaryReport.to' => $payroll['Payroll']['to'],
				'SalaryReport.employee_id' => $employeeId
			
				));

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

	private function _checkPayroll($payroll = null , $update = false , $empConditions = array() ){
		
		$salaries = '';

		ini_set('max_execution_time', 300);

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

			$this->loadModel('HumanResource.Overtime');
			$this->loadModel('HumanResource.OvertimeExcess');

			$this->Employee->bind(array('Salary','GovernmentRecord','Department','Position','EmployeeAdditionalInformation'));	

			if (!empty($empConditions)) {

				$empConditions = array_merge($empConditions,array('Employee.id' => $empConditions));
			}

			$employees = $this->Employee->find('all',array(
								'conditions' => $empConditions,
								'order' => array('Employee.last_name ASC'),
								'fields' => array(
									'Employee.id',
									'Employee.code',
									'Employee.first_name',
									'Employee.middle_name',
									'Employee.last_name',
									'Employee.suffix',
									'Employee.full_name',
									'Position.name',
									'Position.id',
									'Department.id',
									'Department.name',
									'Department.description',
									'Salary.id',
									'Salary.wage',
									'Salary.tax_status',
									'Salary.basic_pay',
									'Salary.basic_pay_per_month',
									'Salary.ctpa',
									'Salary.sea',
									'Salary.allowances',
									'Salary.employee_salary_type',
									'Salary.tax_status',
									'EmployeeAdditionalInformation.id',
									'EmployeeAdditionalInformation.status'
									),
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
							$this->Attendance->bindMyWorkshift(); 
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

					$this->loadModel('Payroll.Adjustment');	

					//taxes tables		
					$this->loadModel('Payroll.Tax');
					$this->loadModel('Payroll.TaxDeduction');
					$this->loadModel('Payroll.Wage');
					$this->loadModel('Payroll.Setting');

					//$OvertimeRate = ClassRegistry::init('Amortization')->find('all');
					$updateDatabase = !empty($update) && $update == true ? true : false;

					$payrollSettings = $this->Setting->find('first');

					$salaries = $this->SalaryComputation->calculateBenifits($employees,$payScheds,$customDate,$updateDatabase,$payrollSettings);

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

			if ($payroll['Payroll']['type'] == '13_month') {

				$data = file_get_contents("salaries/files/payroll-thirteen-month-".$payroll_id.".txt");

			} else {

				$data = file_get_contents("salaries/files/payroll-".$payroll_id.".txt");
			}

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
		

			$deductions = $this->Loan->find('all',array('fields' => array('id','name','description')));
			
			ini_set('max_execution_time', 3600);
			ini_set('memory_input_time', 1024);
			ini_set('max_input_nesting_level', 1024);
			ini_set('memory_limit', '1024M');

			$this->set(compact('salaries','payroll','payrollDate','deductions'));

			switch ($type) {

				case 'payslip':

				//$this->render('Salaries/xls/payslip');
				
				$view = new View(null, false);

				$view->set(compact('salaries','payroll','payrollDate','deductions'));

				$view->viewPath = 'Salaries'.DS.'pdf';
		   	
		        $output = $view->render('payslip', false);

		        $dompdf = new DOMPDF();

		       	//$dompdf->set_paper("A4", 'portrait');

				$customPaper = array(0,0,235,370);
				$dompdf->set_paper($customPaper,'portrait');
		        
		        $dompdf->load_html(utf8_decode($output), Configure::read('App.encoding'));
		        
		        $dompdf->render();
		        
		        $canvas = $dompdf->get_canvas();
		        
		        $font = Font_Metrics::get_font("helvetica", "bold");
		        
		       // $canvas->page_text(16, 800, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, array(0,0,0));

		        $output = $dompdf->output();
		        $random = rand(0, 1000000) . '-' . time();

		        if (empty($filename)) {
		        	$filename = 'payslip-record'.time();
		        }

		      	$filePath = $filename.'.pdf';

		        $file_to_save = WWW_ROOT .DS. $filePath;
		        	
		  //       if ($dompdf->stream( $file_to_save, array( 'Attachment'=>0 ) )) {
		        		
		  //       		unlink($file_to_save);
		  //       }

				// $dompdf->render();

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

        $this->TaxDeduction->bind(array('Tax'));

        $taxes= $this->TaxDeduction->getByType('all');
		//$taxes = $this->Tax->getDeductions($taxes);

		$this->set(compact('taxes'));
	}

	public function view_sumarry() {

		if (!empty($this->request->data)) {
				
				$this->loadModel('HumanResource.Employee');

				$this->loadModel('Payroll.SalaryReport');

				$emp_conditions = array('Employee.id' => $this->request->data['employee_id']);

				$employees = $this->Employee->find('first',array(
							'conditions' => $emp_conditions,
							'order' => array('Employee.last_name ASC'),
							'group' => array('Employee.id'),
							'fields' => array('id','date_hired','full_name','code','first_name','middle_name','last_name'),
				));


				//get Salary in time	
				$params['employee_id']  = $employees['Employee']['id'];
				$params['year'] = $this->request->data['year'];
				$employees['Salaries'] = $this->SalaryReport->computeSalary($params);
				
		}

		//pr($employees); exit();

		$this->set(compact('employees'));

		$this->render('Salaries/ajax/monthly_summary');

	}

	public function _checkThirteenPayroll($payroll = null,$employeeId = null) {

	$this->loadModel('HumanResource.Attendance');

	$this->loadModel('HumanResource.Employee');

	$this->loadModel('HumanResource.Salary');

	$this->loadModel('HumanResource.Department');

	$this->loadModel('HumanResource.OvertimeExcess');

	$this->loadModel('Payroll.SalaryReport');

	$emp_conditions = array();

	if (!empty($employeeId)) {

		$emp_conditions = array_merge($emp_conditions,array('Employee.id' => $employeeId));
	}

	//array('Employee.status NOT' => array('1'));

	$this->Employee->bind(array('Salary','Department'));

	$employees = $this->Employee->find('all',array(
						'conditions' => $emp_conditions,
						'order' => array('Employee.last_name ASC'),
						'group' => array('Employee.id'),
						'fields' => array('id','date_hired','full_name','code','first_name','middle_name','last_name',
						'Salary.employee_salary_type',
						'Salary.basic_pay',
						'Department.name',
						'Department.prefix',
						'Department.id'
						),
		));


	$additional_fields = array(
				'gross','time_work','days','total_hours','hours_ot',
				'regular','OT','legal_holiday','legal_holiday_work',
				'legal_holiday_work_ot','total','night_diff','night_diff_ot',
				'sunday_night_diff','night_diff_legal_holiday','night_diff_legal_holiday_work',
				'special_holiday','special_holiday_work','special_holiday_work_ot','night_diff_special_holiday',
				'night_diff_special_holiday_work','sunday_work','sunday_work_ot','night_diff_sunday_work',
				'night_diff_sunday_work_ot','leave','sunday_legal_holiday','sunday_work_legal_holiday',
				'regular_hours','hours_regular','hours_night_diff','hours_night_diff_ot','hours_sunday_work','hours_sunday_work_ot',
				'hours_sunday_night_diff','hours_sunday_night_diff_ot','sunday_ot','hours_legal_holiday_work','hours_legal_holiday_work_ot',
				'hours_legal_holiday_work_night_diff','hours_legal_holiday_work_night_diff_ot','hours_legal_holiday_sunday_work',
				'hours_legal_holiday_sunday_work_ot','hours_legal_holiday_sunday_work_night_diff','hours_legal_holiday_sunday_work_night_diff_ot',
				'hours_special_holiday_work','hours_special_holiday_work_ot','hours_special_holiday_work_night_diff','hours_special_holiday_work_night_diff_ot',
				'hours_special_holiday_sunday_work','hours_special_holiday_sunday_work_ot','hours_special_holiday_sunday_work_night_diff','hours_special_holiday_sunday_work_night_diff_ot',
				'excess_ot','hours_excess_ot','id','employee_id','employee_salary_type','salary_type','from','to',
				'sss','philhealth','ctpa','sea','allowances','gross_pay','total_earnings','adjustment','adjustment_ids',
				'night_diff_total','total_deduction','with_holding_tax','net_pay','total_pay',
	);

	foreach ($employees as $key => $employee) {
			
		//get Salary in time	
		$params['employee_id']  = $employee['Employee']['id'];
		$params['year'] = $payroll['Payroll']['year'];

		foreach ($additional_fields as $fieldkey => $fields) {

			if ($fields == 'employee_id') {

				$employees[$key][$fields] = $employee['Employee']['id']; 

			}  else {

				$employees[$key][$fields] = 0;
			}

		}

		$employees[$key]['Salaries'] = $this->SalaryReport->computeSalary($params);

		$totalPay = 0;
		//compute total pay
		foreach($employees[$key]['Salaries'] as $salaryKey => $salary) {
				
			if (!empty($salary) && is_array($salary)) {

				foreach ($salary as $salaryKey => $monthly) {
						if (!empty($monthly)) {

								if (is_array($monthly)) {
									$totalPay += $monthly['SalaryReport']['basic_pay_month'];
								} else {

									$totalPay += $monthly['SalaryReport']['basic_pay_month'];
								}
						}
				}
			}

		
		}

		$employees[$key]['total_pay'] = $employees[$key]['thirteen_month'] = $totalPay / 12;

	}


	return $employees;
	}


	public function export_all_attendance() {


		$salaries = '';

		if (!empty($this->request->data)) {

			$data = $this->request->data;

			$month = date('m');

			if (!empty($data['Attendance']['month'])) {

				$month = $data['Attendance']['month'];
			}


			$monthDate = date('Y').'-'.$month.'-';

			if ($data['Payroll']['date'] == '1:15') {


				$date = array(
					'date1' => date($monthDate.'01'),
					'date2' => date($monthDate.'15')
					);
			} elseif ($data['Payroll']['date'] == '16:31') {

				$date = array(
					'date1' => date($monthDate.'16'),
					'date2' => date($monthDate.'t')
					);

			}

	
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

			$this->loadModel('HumanResource.Overtime');
			$this->loadModel('HumanResource.OvertimeExcess');
			
			$empConditions = array('Employee.status NOT' => '3');

			$this->Employee->bind(array('Salary','GovernmentRecord','Department','Position','EmployeeAdditionalInformation'));	

			// if (!empty($empConditions)) {

			// 	$empConditions = array_merge($empConditions,array('EmployeeAdditionalInformation.id' => $empConditions));
			// }

			if (!empty($this->request->data['Attendance']['department_id'])) {

				$empConditions = array_merge($empConditions,array(
						'Employee.department_id' => $this->request->data['Attendance']['department_id']
				));
			}

			$employees = $this->Employee->find('all',array(
								'conditions' => $empConditions,
								'order' => array('Employee.last_name ASC'),
								//'fields' => array('Employee.full_name','Employee.id'),	
								'group' => array('Employee.id')
							));


			$customDate['start'] = $date['date1'];

			$customDate['end'] = $date['date2'];

			$days = explode('-', $customDate['start']);

			$payScheds = ( $days[2] == '16' ) ? 'second' : 'first';


			$conditions = array();

			$conditions = array_merge($conditions,

				array('date(Attendance.date) BETWEEN ? AND ?' => array($customDate['start'],$customDate['end'])) );

			if (!empty($employees)) {

					foreach ($employees as $key => $emp) {
							
							$conditions =  array_merge($conditions,array('Attendance.employee_id' => $emp['Employee']['id']));
							$this->Attendance->bindMyWorkshift(); 
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

					$this->loadModel('Payroll.Adjustment');	

					//taxes tables		
					$this->loadModel('Payroll.Tax');
					$this->loadModel('Payroll.TaxDeduction');
					$this->loadModel('Payroll.Wage');
					$this->loadModel('Payroll.Setting');

					//$OvertimeRate = ClassRegistry::init('Amortization')->find('all');
					$updateDatabase = !empty($update) && $update == true ? true : false;

					$payrollSettings = $this->Setting->find('first');

					$salaries = $this->SalaryComputation->calculateBenifits($employees,$payScheds,$customDate,$updateDatabase,$payrollSettings);

			}
			else {

					// $this->Session->setFlash(__('There\'s an error Processing Payroll'),'error');
					// $this->redirect(array('controller' => 'salaries','action' => 'payroll'));
			}



			$this->set(compact('salaries'));

			$this->render('Attendances/xls/attendance_report_user');

			exit();

			
	}

	}
}