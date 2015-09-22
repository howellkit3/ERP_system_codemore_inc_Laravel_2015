<?php
class AdjustmentsController extends HumanResourceAppController {

	public function index($employee_id = null) {

		$this->loadModel('Payroll.Adjustment');
		$this->loadModel('HumanResource.Employee');
		$data = $this->request->data;

		$this->Adjustment->bind(array('Employee'));

		$conditions = array();

		$limit = 5;

		if (!empty($data['employee_code'])) {
			
			
			$employee = $this->Employee->find('first',array('conditions' => array('Employee.code like' =>'%'.$data['employee_code'].'%')));

			if (!empty($employee)) {
			$conditions = array_merge($conditions,array('Adjustment.employee_id' => $employee['Employee']['id']));
			}
		}

		if (!empty($data['employee_id'])) {

			$conditions  = array_merge($conditions,array(
					'Adjustment.employee_id' => $data['employee_id']
			));
		}

		if (!empty($data['range'])) {

			$date = explode('-', $data['range']);

			$from = date('Y-m-d',strtotime(trim($date[0])));
			$to = date('Y-m-d',strtotime(trim($date[1])));	

			$conditions = array_merge($conditions,array(
				'date(Adjustment.payroll_date) BETWEEN ? AND ?' => array($from,$to), 
			));

		}

		//pr($conditions); exit();

		$limit = 10;

        $params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Adjustment.payroll_date ASC',
	    );

		$this->paginate = $params;

		$adjustments = $this->paginate('Adjustment');

		$this->set(compact('adjustments'));

		$this->render('Adjustments/ajax/index');

	}

}