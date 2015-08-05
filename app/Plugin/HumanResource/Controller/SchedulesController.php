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

		$conditions = array();

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

	public function work_schedules() {

		$this->loadModel('HumanResource.WorkSchedule');

		$this->loadModel('HumanResource.WorkShift');

		$this->loadModel('HumanResource.Employee');

        $employeeList = $this->Employee->find('list',array('fields' => array('id','fullname')));

        $workshiftList = $this->WorkShift->find('list',array('fields' => array('id','name')));

		$limit = 10;

		$conditions = array();

		$params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'WorkSChedule.day ASC',
	        );

		$this->paginate = $params;

		$this->WorkSchedule->bind(array('WorkShift','Employee'));

	    $workSchedules = $this->paginate('WorkSchedule');


	    $this->set(compact('workSchedules','employeeList','workshiftList'));


	}



}