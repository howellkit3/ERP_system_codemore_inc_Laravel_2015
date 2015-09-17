<?php


App::import('Vendor', 'PhpExcelReader', array('file' => 'PhpExcelReader'.DS.'excel_reader2.php'));


class DeductionsController extends PayrollAppController {


	public function index($employee_id = null) {

		$this->loadModel('Payroll.Deduction');
		$this->loadModel('HumanResource.Employee');

		$conditions = array();
		$employeeList = $this->Employee->getList($conditions);	

		$limit = 10;

        if (!empty($this->request->data)) {
				if (!empty($this->request->data['employee_id'])) {
					$conditions = array_merge($conditions,array('Deduction.employee_id' => $this->request->data['employee_id']));
				}
				if (!empty($this->request->data['employee_code'])) {
					$employee = $this->Employee->find('first',array('conditions' => array('Employee.code like' =>'%'.$this->request->data['employee_code'].'%')));

					if (!empty($employee)) {
						$conditions = array_merge($conditions,array('Deduction.employee_id' => $employee['Employee']['id']));
					}
					
				}	
        }

        $params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Deduction.from ASC',
	    );

		$this->paginate = $params;

		$this->Deduction->bind(array('Employee'));

		$deductions = $this->paginate('Deduction');
		//pr($deductions); exit();

		$this->set(compact('deductions','employeeList'));

		if ($this->request->is('ajax')) {

			$this->render('Deductions/ajax/index');
		}

	}
	public function view_amortization($deductionId = null) {

		$this->LoadModel('Payroll.Amortization');


		if (!empty($deductionId)) {

			$amortizations = $this->Amortization->find('all',array(
					'conditions' => array('Amortization.deduction_id' => $deductionId),
					'order' => array('Amortization.payroll_date ASC')

			));

			$this->set(compact('amortizations'));
		//if ($this->request->is('ajax')) {
			$this->render('Deductions/ajax/view_amortizations');
		//}
		}
	}

	public function edit($id = null) {

		$this->LoadModel('Payroll.Deduction');
		$this->loadModel('HumanResource.Employee');

		if ($this->request->is('put')) {


		}
		if (!empty($id)) {

			$this->request->data = $this->Deduction->findById($id);
		
		}

		$conditions = array();
		$employeeList = $this->Employee->getList($conditions);
		
		$this->set(compact('employeeList'));
			
	}

	public function bulk_upload() {

			if (!empty($this->request->data)) {

			$allowed = array('xls','xlsx');
			$filename = $this->request->data['Deduction']['file']['name'];
			$fileData = pathinfo($filename);

			if (!in_array( $fileData['extension'] , $allowed)) {

				$this->Session->setFlash('Invalid File Type','error');

				$this->redirect( array(
				     'controller' => 'salaries', 
				     'action' => 'deductions',
				     'plugin' => 'human_resource'
				));
			}

			$this->loadModel('HumanResource.Employee');

			$this->loadModel('Payroll.Deduction');
			
			$this->loadModel('Payroll.Amortization');

			$data = new Spreadsheet_Excel_Reader();

			$data->setOutputEncoding('CP1251');

			$excelReader = $data->read($this->data['Deduction']['file']['tmp_name']);
			
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

				if ($i > 1) {
					$xls_data['Deduction'][] = $row_data;
				}
			}

			$employeeData = array();

			if (!empty($xls_data['Deduction'])) {


			foreach ($xls_data['Deduction'] as $key => $list) {
				
				$employees = $this->Employee->find('first'); //$this->Employee->findbyCode(trim($list['Employee Code']),'first',array('id','first_name','last_name'));
				
				if (!empty($employees['Employee']['id'])) {

					$employeeData[$key]['id'] = '';
					$employeeData[$key]['employee_id'] = $employees['Employee']['id'];
					$employeeData[$key]['amount'] = $list['Amount'];

					if ($list['Deduction Mode'] == 1) {

						$employeeData[$key]['mode'] = 'installment';

						//count months and divide the payment

						//$date = explode('-',$query['range']);
					
						

					} else {

						$employeeData[$key]['mode'] = 'once';

						//save single date

					}
					$employeeData[$key]['from'] = date('Y-m-d',strtotime($list['From']));
					$employeeData[$key]['to'] = date('Y-m-d',strtotime($list['To']));
					$employeeData[$key]['reason'] =  $list['Reason'];
					$employeeData[$key]['status'] = $list['Status'];
				}

				if ($this->Deduction->save($employeeData[$key])) {

						$deductionLastId = $this->Deduction->id;

						if ($list['Deduction Mode'] == 1) {

						$start_date = date('Y-m-d',strtotime($list['From']));

						$end_date = date('Y-m-d',strtotime($list['To']));

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

						if (!empty($payment)) {
							
							$amortizationData = array();


							$total_payment = $list['Amount'] / count($payment);

							$total = $list['Amount'];

							foreach ($payment as $amkey => $pay) {

								$payment[$amkey]['deduction_id'] = $deductionLastId;

								$payment[$amkey]['amount'] = $total_payment;
								$payment[$amkey]['payroll_date'] = $pay['date'];
								$payment[$amkey]['deduction'] = $total;

								$payment[$amkey]['status'] = 0;
								$total = $total - $total_payment;

								$this->Amortization->save($payment[$amkey]);

							}

							
						}
						} else {

								$payment[$amkey]['deduction_id'] = $deductionLastId;

								$payment[$amkey]['amount'] = $total_payment;
								$payment[$amkey]['payroll_date'] = date('Y-m-d',strtotime($list['From']));
								$payment[$amkey]['deduction'] = $total;

								$payment[$amkey]['status'] = 0;
								$total = $total - $total_payment;

								$this->Amortization->save($payment[$amkey]);	

						}
				}
			}

			$this->Deduction->create();

			if (!empty($employeeData)) {

				if ($this->Deduction->saveAll($employeeData)) {

					
					//save adjustment
					$this->Session->setFlash('Deduction\'s save successfully','success');
				} else {

					$this->Session->setFlash('There\'s an error saving','error');

				}
			} 
			else {

					$this->Session->setFlash('No Employee Found','error');

			}
		}

			$this->redirect( array(
				     'controller' => 'salaries', 
				     'action' => 'deductions',
				     'plugin' => 'human_resource'
				));
		}

	}


}