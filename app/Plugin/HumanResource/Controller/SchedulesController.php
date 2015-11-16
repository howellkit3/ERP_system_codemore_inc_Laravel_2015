<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


class SchedulesController  extends HumanResourceAppController {

	var $uses = array('HumanResource.Holiday');


	public function holiday(){

		$limit = 10;

		$conditions = array();

		$params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Holiday.start_date ASC',
	        );

		if (!empty($this->request->params['named']['calendar'])) {
			
			$params =  array(
	            'conditions' => $conditions,
	            'order' => 'Holiday.start_date ASC',
	        );
			
			$list = $this->Holiday->getAllHolidays($params);

		}

	 	if ( (empty($this->params['named']['model'])) ||  $this->params['named']['model'] == 'Holiday' ) {

	        $this->paginate = $params;

	        $holidays = $this->paginate();

	    }

	    $this->set(compact('holidays','list'));

	}

	public function calendar() {

		
		$conditions = array();


		$params =  array(
			'conditions' => $conditions,
			'order' => 'Holiday.start_date ASC',
		);

		$list = $this->Holiday->getAllHolidays($params);

		$this->set(compact('holidays','list'));

	}

	public function breaktime() {

		$this->loadModel('HumanResource.Breaktime');

		$limit = 10;

		$conditions = array();

		$params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Breaktime.from ASC',
	        );

		$this->paginate = $params;

	    $breaktime = $this->paginate('Breaktime');


	    $this->set(compact('breaktime'));

	}

	public function workshifts() {


		$this->loadModel('HumanResource.WorkShift');

		$this->loadModel('HumanResource.Overtime');

		$limit = 10;

		$conditions = array('WorkShift.overtime_id' => NULL);

		$params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id','overtime_id'),
	            'order' => 'WorkShift.from ASC',
	        );

		$this->paginate = $params;

	    $workshifts = $this->paginate('WorkShift');

	    $this->set(compact('workshifts'));


	}

	public function work_schedules($empId = null) {

		$this->loadModel('HumanResource.WorkSchedule');

		$this->loadModel('HumanResource.WorkShift');

		$this->loadModel('HumanResource.Employee');

        $employeeList = $this->Employee->find('list',array('fields' => array('id','fullname')));

        $workshiftList = $this->WorkShift->find('list',array('fields' => array('id','name')));

		//$limit = 10;
        $employee = array_flip( $employeeList);

		$conditions = array('WorkSchedule.model' => 'Employee','WorkSchedule.foreign_key' => current($employee) ,'WorkSchedule.overtime_id' => NULL);

		if (empty($this->request->data['date'])) {

			$date =  date('Y-m-01');
			$date2 = date('Y-m-t');

	
			$conditions =array('date(WorkSchedule.day) BETWEEN ? AND ?' => array($date,$date2));
		

		}
		$params =  array(
	            'conditions' => $conditions,
	           // 'limit' => $limit,
	            //'group' => array('WorkSchedule.foreign_key'),
	            'order' => 'WorkSChedule.day ASC',
	        );

		$this->paginate = $params;

		$this->WorkSchedule->bind(array('WorkShift','Employee'));

	    $workSchedules = $this->paginate('WorkSchedule');

		$defaults = !empty($this->params['named']['default']) ? $this->params['named']['default'] : '';

	    $this->set(compact('workSchedules','employeeList','workshiftList','date','empId','defaults','date2'));
	}

	public function view($id,$user_id = null) {

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.WorkSchedule');

		$this->loadModel('HumanResource.Holiday');
		

		$conditions = array('Holiday.year' => date('Y'));

		$holidays = $this->Holiday->find('all',array('conditions' => $conditions ,'order' =>  array('Holiday.start_date ASC'),'fields' => array('id','name','type','start_date','end_date','year') ));


		$workSchedule = $this->WorkSchedule->findById($id);

		$list = $this->WorkSchedule->getAllSchedules($user_id,$workSchedule,$holidays);

		if (!empty($list) ) {

			$list = json_encode($list);
		}

		$list = str_replace('[','',$list);
		$list = str_replace(']','',$list);
		
		$params['schedule_id'] = $id;
		$params['employee_id'] = $user_id;

		$this->set(compact('workshifts','list','params'));

		
	}




}