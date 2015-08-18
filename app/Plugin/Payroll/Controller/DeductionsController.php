<?php
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


}