<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


class OvertimesController  extends HumanResourceAppController {

	var $helpers = array('HumanResource.CustomText','HumanResource.CustomTime');

	public function index() {

		$this->loadModel('HumanResource.Department');

		$date = date('Y-m-d');
		
		$department = '';

		$departments = $this->Department->getList();

		$limit = 10;

		$query = $this->request->query;
		
		$search = '';

		$date = date('Y-m-d');

		
		if (!empty($query['date'])) {
			$date = $query['date'];
		}
	
		$conditions = array(
			'Overtime.date <=' => $date,
		 	'Overtime.date >=' => $date
		);

		if (!empty($query['department_id'])) {
			
			$department = $query['department_id'];	

			$conditions = array_merge($conditions,array(
				'Overtime.department_id' => $department
			));
		}

		//$this->Attendance->bind(array('WorkSchedule','Employee','WorkShift'));

		
		$params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            'fields' => array(
	            	'id', 
	            	'date',
	            	'from',
	            	'to',
	            	'status',
	            	'approved_by',
	            	'audit_date',
	            	'Department.name'
	            	),
	            'order' => 'Overtime.date DESC',
	    );


		$this->paginate = $params;

		$this->Overtime->bind(array('Department'));

		$overtimes = $this->paginate();

		$this->set(compact('date','search','department','departments','overtimes'));
	}

	public function add() {

		$this->loadModel('HumanResource.Department');

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.BreakTime');

		$this->loadModel('HumanResource.Workshift');

		$this->loadModel('HumanResource.WorkshiftBreak');

		$this->loadModel('HumanResource.WorkSchedule');

		$this->loadModel('HumanResource.Position');

		$this->loadModel('HumanResource.Attendance');

		$date = date('Y-m-d');
		
		$search = '';

		$auth = $this->Session->read('Auth.User');

		if ($this->request->is('post')) {

			$this->Overtime->create();

			$data = $this->Overtime->formatData($this->request->data,$auth['id']);



			if ($this->Overtime->save($data)) {

				$overtime_id = $this->Overtime->id;
				//create worshift and schedule
				$workshift = $this->Workshift->createWorkshift($data,$overtime_id,$auth['id']);

				if (!empty($workshift['id'])) {
				//workhift break
				$workshiftBreak = $this->WorkshiftBreak->createWorkshiftBreak($data,$workshift['id'],$overtime_id,$auth['id']);

				}

				if (!empty($overtime_id)) {
				//workhift workschedule
				$workSchedule = $this->WorkSchedule->createSchedule($data,$workshift['id'],$overtime_id,$auth['id']);
				$attendance = $this->Attendance->saveRecord($workSchedule);
				
				}

				$this->Session->setFlash('Saving overtime successfully');
		 		
		 		$this->redirect( array(
                             'controller' => 'overtimes', 
                             'action' => 'index',
                             'tab' => 'overtimes',
                             'plugin' => 'human_resource'

                        ));


			} else  {

				$this->Session->setFlash('There\'s an error saving Overtime information');


			}

		}
		$departments = $this->Department->getList();

		$breaktimes = $this->BreakTime->find('all',array(
				'order' => 'BreakTime.from DESC',
				'limit' => 10

		));

		$this->Employee->bind(array('Position'));

		$employees = $this->Employee->find('all',array(
			'order' => array('Employee.last_name','Employee.code'),
			'fields' => array(
				'id',
				'Employee.first_name',
				'Employee.last_name',
				'Employee.middle_name',
				'Employee.position_id',
				'Employee.department_id',
				'Employee.image',
				'Position.name'
			),
			'group' => 'Employee.id' 
		));

		$this->set(compact('date','search','departments','breaktimes','employees'));

	}


	public function edit($id) {
		
		$this->loadModel('HumanResource.Department');

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.BreakTime');

		$this->loadModel('HumanResource.Workshift');

		$this->loadModel('HumanResource.WorkshiftBreak');

		$this->loadModel('HumanResource.WorkSchedule');

		$this->loadModel('HumanResource.Position');
		
		$this->loadModel('HumanResource.Attendance');

		$date = date('Y-m-d');
		
		$search = '';

		$departments = $this->Department->getList();

		$auth = $this->Session->read('Auth.User');

		if ($this->request->is('put')) {

			$this->Overtime->create();

			$data = $this->Overtime->formatData($this->request->data,$auth['id']);

			$overtime = $this->Overtime->findById($id);

			if ($this->Overtime->save($data)) {

				//create worshift and schedule
				$workshift = $this->Workshift->createWorkshift($data,$id,$auth['id']);

				if (!empty($workshift['id'])) {
				//workhift break
				$workshiftBreak = $this->WorkshiftBreak->createWorkshiftBreak($data,$workshift['id'],$id,$auth['id']);

				}

				if (!empty($id)) {
				//workhift workschedule
				$workSchedule = $this->WorkSchedule->createSchedule($data,$workshift['id'],$id,$auth['id']);
	
				$attendance = $this->Attendance->saveRecord($workSchedule);
				
				}

				$this->Session->setFlash('Saving overtime successfully');
		 		
		 		$this->redirect( array(
                             'controller' => 'overtimes', 
                             'action' => 'index',
                             'tab' => 'overtimes',
                             'plugin' => 'human_resource'

                        ));


			} else  {

				$this->Session->setFlash('There\'s an error saving Overtime information');


			}

		}

		if (!empty($id)) {

			//$this->Overtime->bind(array('WorkSchedule'));

			$this->request->data = $this->Overtime->findById($id);

			$this->WorkSchedule->bind(array('Employee','WorkShift'));

			$workSchedule = $this->WorkSchedule->find('all',array(
				'conditions' => array('WorkSchedule.overtime_id' => $id))
			);

			$workshiftBreaks = $this->WorkshiftBreak->find('list',array(
				'conditions' => array('WorkshiftBreak.workshift_id' => $workSchedule[0]['WorkShift']['id']),
				'fields' => array('id','breaktime_id')
				)); 
			$selectedEmployee = array_map(function($value) { return $value['Employee']['id']; },
                         $workSchedule);


		}

		$breaktimes = $this->BreakTime->find('all',array(
				'order' => 'BreakTime.from DESC',
				'limit' => 10

		));

		$this->Employee->bind(array('Position'));

		$employees = $this->Employee->find('all',array(
			'conditions' => array('Employee.department_id' => $this->request->data['Overtime']['department_id']),
			'order' => array('Employee.last_name','Employee.code') 
		));

		$this->set(compact('date','search','departments','breaktimes','employees','selectedEmployee','workshiftBreaks'));
	}
}