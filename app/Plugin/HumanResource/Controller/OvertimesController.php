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
			//'Overtime.date <=' => $date,
		 	'Overtime.date >=' => $date,
			'Overtime.status' => 'approved'
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
	            'order' => 'Overtime.date ASC',
	    );


		$this->paginate = $params;

		$this->Overtime->bind(array('Department'));

		$overtimes = $this->paginate();

		$this->set(compact('date','search','department','departments','overtimes'));
	}



	public function pendings() {

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
			//'Overtime.date <=' => $date,
		 	'Overtime.date >=' => $date,
		 	'Overtime.status' => ''
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
	            'order' => 'Overtime.date ASC',
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
				//$workshift = $this->Workshift->createWorkshift($data,$overtime_id,$auth['id']);

				//workhift break
				$workshiftBreak = $this->WorkshiftBreak->createWorkshiftBreak($data,0,$overtime_id,$auth['id']);
				
				//update overtime in attendance
				foreach ($data['Attendance']['id'] as $key => $value) {
					//$updateOverTime = $this->Attendance->find('first',array('conditions' => array('Attendance.id' => $value)));
					$this->Attendance->id = $value;
					$this->Attendance->savefield('overtime_id' , $overtime_id);
				}
			
				if (!empty($overtime_id)) {
				//workhift workschedule
				//$workSchedule = $this->WorkSchedule->createSchedule($data,$workshift['id'],$overtime_id,$auth['id']);
				//$attendance = $this->Attendance->saveRecord($workSchedule);

				
				}

				$this->Session->setFlash('Saving overtime successfully','success');
		 		
		 		$this->redirect( array(
                             'controller' => 'overtimes', 
                             'action' => 'pendings',
                             'tab' => 'pendings',
                             'plugin' => 'human_resource'

                        ));


			} else  {

				$this->Session->setFlash('There\'s an error saving Overtime information','error');


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
		//pr($employees);exit();
		$this->set(compact('date','search','departments','breaktimes','employees'));

	}


	public function edit($id) {


		$this->loadModel('HumanResource.Department');

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.Workshift');

		$this->loadModel('HumanResource.WorkSchedule');
		
		$this->loadModel('HumanResource.BreakTime');

		$this->loadModel('HumanResource.WorkshiftBreak');

		$this->loadModel('HumanResource.Position');
		
		$this->loadModel('HumanResource.Attendance');

		$this->loadModel('HumanResource.Overtime');

		$date = date('Y-m-d');
		
		$search = '';

		$departments = $this->Department->getList();

		$auth = $this->Session->read('Auth.User');	

		if ($this->request->is('put')) {

			//update overtime in attendance reset 0
			foreach ($this->request->data['Idholder']['id'] as $key => $value) {
				//$updateOverTime = $this->Attendance->find('first',array('conditions' => array('Attendance.id' => $value)));
				$this->Attendance->id = $value;
				$this->Attendance->savefield('overtime_id' , 0);
			}
			
			$this->Overtime->create();

			$data = $this->Overtime->formatData($this->request->data,$auth['id']);
			
			$overtime = $this->Overtime->findById($id);

			if ($this->Overtime->save($data)) {

				$this->Session->setFlash('Saving overtime successfully','success');

					if ($overtime['Overtime']['status'] == 'approved') {

						//$overtime = $this->Overtime->read(null,$otId);
						//create worshift and schedule
						$workshift = $this->Workshift->createWorkshift($overtime,$id,$auth['id']);

						if (!empty($workshift['id'])) {
						//workhift break
						$workshiftBreak = $this->WorkshiftBreak->createWorkshiftBreak($overtime,$workshift['id'],$id,$auth['id']);

						}

						

						if (!empty($id)) {
						//workhift workschedule
							$workSchedule = $this->WorkSchedule->createSchedule($overtime,$workshift['id'],$id,$auth['id']);

							//$attendance = $this->Attendance->saveRecord($workSchedule);

						}
			 		}

			 		//update overtime in attendance
					foreach ($data['Attendance']['id'] as $key => $value) {
						//$updateOverTime = $this->Attendance->find('first',array('conditions' => array('Attendance.id' => $value)));
						$this->Attendance->id = $value;
						$this->Attendance->savefield('overtime_id' , $id);
					}

		 			$this->redirect( array(
                             'controller' => 'overtimes', 
                             'action' => 'index',
                             'tab' => 'overtimes',
                             'plugin' => 'human_resource'

                        ));


			} else  {

				$this->Session->setFlash('There\'s an error saving Overtime information','error');


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
				'conditions' => array('WorkshiftBreak.overtime_id' => $id),
				'fields' => array('id','breaktime_id')
				)); 

			$selectedEmployee = (array)json_decode($this->request->data['Overtime']['employee_ids']);

		}

		$breaktimes = $this->BreakTime->find('all',array(
				'order' => 'BreakTime.from DESC',
				'limit' => 10

		));
		
		//$this->Employee->bind(array('Position'));
		$this->Attendance->bind(array('Employee'));

		$conditions = array();

		$conditions = array_merge($conditions,array('Attendance.date >=' => date('Y-m-d')));

		$conditions = array_merge($conditions,array('Attendance.in !=' => ' '));

		$conditions = array_merge($conditions,array('Employee.department_id' => $this->request->data['Overtime']['department_id']));

		$employees = $this->Attendance->find('all',array(
					'conditions' => $conditions,
					'order' => array('Employee.last_name','Employee.code'),
						'fields' => array(
					'id',
					'Employee.first_name',
					'Employee.last_name',
					'Employee.middle_name',
					'Employee.position_id',
					'Employee.department_id',
					'Employee.image',
					'Attendance.schedule_id',
					'Attendance.type',
					'Attendance.in',
					'Attendance.out'
					//'Position.name'
					),

				));
		$positionList = $this->Position->find('list',array('fields' => array('id','name')));
		//pr($employees);exit();
		// $employees = $this->Employee->find('all',array(
		// 	'conditions' => array('Employee.department_id' => $this->request->data['Overtime']['department_id']),
		// 	'order' => array('Employee.last_name','Employee.code') 
		// ));

		$this->set(compact('date','search','departments','breaktimes','employees','selectedEmployee','workshiftBreaks','positionList'));
	}


		public function view($id) {


		$this->loadModel('HumanResource.Department');

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.Workshift');

		$this->loadModel('HumanResource.WorkSchedule');
		
		$this->loadModel('HumanResource.BreakTime');

		$this->loadModel('HumanResource.WorkshiftBreak');

		$this->loadModel('HumanResource.Position');
		
		$this->loadModel('HumanResource.Attendance');

		$this->loadModel('HumanResource.Overtime');

		$date = date('Y-m-d');
		
		$search = '';

		$departments = $this->Department->getList();

		$auth = $this->Session->read('Auth.User');	

		if ($this->request->is('put')) {

			//update overtime in attendance reset 0
			foreach ($this->request->data['Idholder']['id'] as $key => $value) {
				//$updateOverTime = $this->Attendance->find('first',array('conditions' => array('Attendance.id' => $value)));
				$this->Attendance->id = $value;
				$this->Attendance->savefield('overtime_id' , 0);
			}
			
			$this->Overtime->create();

			$data = $this->Overtime->formatData($this->request->data,$auth['id']);
			
			$overtime = $this->Overtime->findById($id);

			if ($this->Overtime->save($data)) {

				$this->Session->setFlash('Saving overtime successfully','success');

					if ($overtime['Overtime']['status'] == 'approved') {

						//$overtime = $this->Overtime->read(null,$otId);
						//create worshift and schedule
						$workshift = $this->Workshift->createWorkshift($overtime,$id,$auth['id']);

						if (!empty($workshift['id'])) {
						//workhift break
						$workshiftBreak = $this->WorkshiftBreak->createWorkshiftBreak($overtime,$workshift['id'],$id,$auth['id']);

						}

						

						if (!empty($id)) {
						//workhift workschedule
							$workSchedule = $this->WorkSchedule->createSchedule($overtime,$workshift['id'],$id,$auth['id']);

							//$attendance = $this->Attendance->saveRecord($workSchedule);

						}
			 		}

			 		//update overtime in attendance
					foreach ($data['Attendance']['id'] as $key => $value) {
						//$updateOverTime = $this->Attendance->find('first',array('conditions' => array('Attendance.id' => $value)));
						$this->Attendance->id = $value;
						$this->Attendance->savefield('overtime_id' , $id);
					}

		 			$this->redirect( array(
                             'controller' => 'overtimes', 
                             'action' => 'index',
                             'tab' => 'overtimes',
                             'plugin' => 'human_resource'

                        ));


			} else  {

				$this->Session->setFlash('There\'s an error saving Overtime information','error');


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
				'conditions' => array('WorkshiftBreak.overtime_id' => $id),
				'fields' => array('id','breaktime_id')
				)); 

			$selectedEmployee = (array)json_decode($this->request->data['Overtime']['employee_ids']);

		}

		$breaktimes = $this->BreakTime->find('all',array(
				'order' => 'BreakTime.from DESC',
				'limit' => 10

		));
		
		//$this->Employee->bind(array('Position'));
		$this->Attendance->bind(array('Employee'));

		$conditions = array();

		$conditions = array_merge($conditions,array('Attendance.date >=' => date('Y-m-d')));

		$conditions = array_merge($conditions,array('Attendance.in !=' => ' '));

		$conditions = array_merge($conditions,array('Employee.department_id' => $this->request->data['Overtime']['department_id']));

		$employees = $this->Attendance->find('all',array(
					'conditions' => $conditions,
					'order' => array('Employee.last_name','Employee.code'),
						'fields' => array(
					'id',
					'Employee.first_name',
					'Employee.last_name',
					'Employee.middle_name',
					'Employee.position_id',
					'Employee.department_id',
					'Employee.image',
					'Attendance.schedule_id',
					'Attendance.type',
					'Attendance.in',
					'Attendance.out'
					//'Position.name'
					),

				));
		$positionList = $this->Position->find('list',array('fields' => array('id','name')));
		//pr($employees);exit();
		// $employees = $this->Employee->find('all',array(
		// 	'conditions' => array('Employee.department_id' => $this->request->data['Overtime']['department_id']),
		// 	'order' => array('Employee.last_name','Employee.code') 
		// ));

		$this->set(compact('date','search','departments','breaktimes','employees','selectedEmployee','workshiftBreaks','positionList'));
	}

	public function process($otId = null, $status = null) {

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.BreakTime');

		$this->loadModel('HumanResource.Workshift');

		$this->loadModel('HumanResource.WorkshiftBreak');

		$this->loadModel('HumanResource.WorkSchedule');

		$this->loadModel('HumanResource.Position');
		
		$this->loadModel('HumanResource.Attendance');

		$this->loadModel('HumanResource.DailyInfo');

		if (!empty($otId) && !empty($status)) {

			$this->Overtime->create();

			$auth = $this->Session->read('Auth.User');

			$overtime['Overtime']['id'] = $otId;
			$overtime['Overtime']['status'] = $status;

			if ($this->Overtime->save($overtime['Overtime'])) {

				if ($status == 'approved') {

					$overtime = $this->Overtime->read(null,$otId);
					//create worshift and schedule
					$workshift = $this->Workshift->createWorkshift($overtime,$otId,$auth['id']);

					if (!empty($workshift['id'])) {
					//workhift break
					$workshiftBreak = $this->WorkshiftBreak->createWorkshiftBreak($overtime,$workshift['id'],$otId,$auth['id']);

					}

					if (!empty($otId)) {
					//workhift workschedule
					$workSchedule = $this->WorkSchedule->createSchedule($overtime,$workshift['id'],$otId,$auth['id']);

					//$attendance = $this->Attendance->saveRecord($workSchedule);

					foreach($workSchedule as $data) :

						$data['employee_id'] = $data['foreign_key'];
						$data['date'] = $overtime['Overtime']['date'];
					// //must save daily info
						$dailynfo = $this->DailyInfo->saveDailyInfo($data);
					
					endforeach;
					
					$this->Session->setFlash('Saving overtime successfully','success');
				   
				   } 

				} else {


					$this->Session->setFlash('OT request rejected','error');	

				}

				$this->redirect( array(
                             'controller' => 'overtimes', 
                             'action' => 'index',
                             'tab' => 'overtimes',
                             'plugin' => 'human_resource'

                        ));
				
		
			}
			 else  {

				$this->Session->setFlash('There\'s an error saving Overtime information','error');

	
				// $this->redirect( array(
    //                          'controller' => 'overtimes', 
    //                          'action' => 'edit',
    //                          'tab' => 'overtimes',
    //                          'plugin' => 'human_resource',
    //                          $otId

    //                     ));

				}


			



		}

	}
}