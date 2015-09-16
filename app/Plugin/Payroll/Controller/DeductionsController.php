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
				
				$employees = $this->Employee->findbyCode($list['Employee Code'],'first',array('id','first_name','last_name'));
				
				if (!empty($employees['Employee']['id'])) {

					$employeeData[$key]['id'] = '';
					$employeeData[$key]['employee_id'] = $employees['Employee']['id'];
					$employeeData[$key]['amount'] = $list['Amount'];

					if ($list['Amount'] == 1) {

						$employeeData[$key]['mode'] = 'installment';

						//count months and divide the payment

					} else {

						$employeeData[$key]['mode'] = 'once';

						//save single date

					}
					$employeeData[$key]['from'] = date('Y-m-d',strtotime($list['From']));
					$employeeData[$key]['to'] = date('Y-m-d',strtotime($list['To']));
					$employeeData[$key]['reason'] =  $list['Reason'];
					$employeeData[$key]['status'] = $list['Status'];
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