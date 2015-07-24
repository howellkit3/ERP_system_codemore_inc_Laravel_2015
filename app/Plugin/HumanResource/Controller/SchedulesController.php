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

		$limit = 10;

		$conditions = array();

		$params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'WorkShift.from ASC',
	        );

		$this->paginate = $params;

	    $workshifts = $this->paginate('WorkShift');

	    $this->set(compact('workshifts'));


	}



}