<?php
class DeductionsController extends HumanResourceAppController {


	public function index($employee_id = null) {

		$this->loadModel('Payroll.Deduction');
		$this->loadModel('HumanResource.Employee');

		$conditions = array();
		$employeeList = $this->Employee->getList($conditions);	

		$limit = 10;

        if (!empty($this->request->data)) {
        		
			if (!empty($this->request->data['date_range'])) {

        			$dateRange = explode('-', $this->request->data['date_range'] );

        			$from = date('Y-m-d',strtotime(trim($dateRange[0])));
        			
        			$to = date('Y-m-d',strtotime(trim($dateRange[1])));

        			$conditions = array_merge($conditions,array(
						'date(Deduction.from) BETWEEN ? AND ?' => array($from,$to), 
					));
				}

				if (!empty($this->request->data['employee_id'])) {
					$conditions = array_merge($conditions,array('Deduction.employee_id' => $this->request->data['employee_id']));
				}
				if (!empty($this->request->data['employee_code'])) {

					$filter = $this->request->data['employee_code'];
					$employee = $this->Employee->find('first',array(
						'conditions' => array(
							'OR' => array (
								'Employee.code like' =>'%'.$filter.'%',
								'Employee.first_name like' => '%'.$filter .'%',
								'Employee.last_name like' => '%'.$filter.'%',
								'Employee.middle_name like' => '%'.$filter.'%'
							))
						));

					if (!empty($employee)) {
						$conditions = array_merge($conditions,array('Deduction.employee_id' => $employee['Employee']['id']));
					}
					
				}	
        }
        
        $conditions = array_merge($conditions, array('is_deleted' => 0));

        $params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Deduction.from ASC',
	    );

		$this->paginate = $params;

		$this->Deduction->bind(array('Employee'));

		$deductions = $this->paginate('Deduction');

		$this->set(compact('deductions','employeeList'));

		if ($this->request->is('ajax')) {

			$this->render('Deductions/ajax/index');
		}

	}
	public function view_amortization($deductionId = null) {

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('Payroll.Deduction');

		$this->loadModel('Payroll.Amortization');

		$this->loadModel('Payroll.Loan');


		if (!empty($deductionId)) {

		$this->Deduction->bind(array('Loan'));

		$deduction = $this->Deduction->findById($deductionId);

		$employees = $this->Employee->findById($deduction['Deduction']['employee_id']);

		$limit = 10;

		$conditions = array('Amortization.deduction_id' => $deductionId );
        
        $params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Amortization.payroll_date ASC',
	    );

		$this->paginate = $params;

		$amortizations = $this->paginate('Amortization');

		$this->set(compact('amortizations','deduction','employees'));
	//if ($this->request->is('ajax')) {
		$this->render('Deductions/ajax/view_amortizations');
		//}
		}
	}


	public function add() {

		$this->loadModel('Payroll.Deduction');

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('Payroll.Amortization');

		if ($this->request->is('post')) {

			$auth = $this->Session->read('Auth');

			$this->request->data['Deduction']['to'] = $this->request->data['Deduction']['from'];

			if ($this->request->data['Deduction']['mode'] == 'installment') {

				$time = explode('-', $this->request->data['Deduction']['from'] );
				$this->request->data['Deduction']['from'] = date('Y-m-d',strtotime(trim($time[0])));
				$this->request->data['Deduction']['to'] = date('Y-m-d',strtotime(trim($time[1])));

			}	

			if ( $this->Deduction->save($this->request->data) ) {

				//save amortization schedules
				$deductionId = $this->Deduction->id;

				if ($this->request->data['Deduction']['mode'] == 'once') {
					$this->request->data['Amortization'][0]['payroll_date'] = $this->request->data['Deduction']['from'];
					$this->request->data['Amortization'][0]['amount'] = $this->request->data['Deduction']['amount'];
					$this->request->data['Amortization'][0]['deduction'] = $this->request->data['Deduction']['amount'];

				}	

				$this->Amortization->saveDeductions($deductionId,$this->request->data,$auth['User']['id']);

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
	public function delete($id = null) {

		$this->loadModel('Payroll.Deduction');

		if (!empty($id)) {

			$this->Deduction->id = $id;

			if ($this->Deduction->saveField('is_deleted',1)) {

				$this->Session->setFlash('Deduction delete successfully','success');

			} else {

				$this->Session->setFlash('There\'s an error deleting data','error');

			}

			$this->redirect( array(
				     'controller' => 'salaries', 
				     'action' => 'deductions',
				));
		}
	}


}