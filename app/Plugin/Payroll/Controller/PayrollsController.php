<?php
class PayrollsController extends PayrollAppController {


	public function settings() {

		$date = date('Y-m-d');

		$this->set(compact('date'));

	}

	public function checkExisting(){


		$query = $this->request->query;

		if (!empty($query['month']) && !empty($query['date'])) {

			$date = explode(':', $query['date'] );

			$from = date('Y-m-d',strtotime($date[0].'-'.$query['month'])); 

			$to = date('Y-m-d',strtotime($date[1].'-'.$query['month'])); 

			$conditions = array('Payroll.from' => $from ,'Payroll.to' => $to );

			$payroll = $this->Payroll->find('first',array('conditions' => $conditions ));
			
			echo json_encode($payroll);

			exit();
		}
	}

	public function getPayrollBy() {

		$query = $this->request->query;

		if (!empty($query['month']) ) {

			$limit = 10;

			$from = date('Y-m-d',strtotime('01-'.$query['month'])); 

			$to = date('Y-m-t',strtotime('31-'.$query['month'])); 

			$conditions = array('Payroll.from >=' => $from ,'Payroll.to <=' => $to );

			if (!empty($query['status']) && $query['status'] != 'undefined' ) {

				$conditions = array_merge($conditions,array('Payroll.status' => $query['status']));
			}

			$this->paginate = array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Payroll.date DESC',
	        );

	        $payrolls = $this->paginate('Payroll');

	        $this->set(compact('payrolls'));

			$this->render('Payrolls/ajax/payroll');

		}

	}


}