<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


class WorkSchedulesController  extends HumanResourceAppController {

	//var $helpers = array('HumanResource.CustomText','HumanResource.Country','HumanResource.BreakTime');
	var $helpers = array('HumanResource.PhpExcel','HumanResource.CustomText');
	//,'HumanResource.Country'
	public function add() {

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.Attendance');

		$this->loadModel('HumanResource.DailyInfo');

		$this->loadModel('HumanResource.Workshift');

		$this->loadModel('HumanResource.Holiday');

		$this->loadModel('HumanResource.OvertimeLimit');

		$this->loadModel('HumanResource.Department');

		$this->loadModel('User');

		$conditions = array('overtime_id' => NULL);
		$workshifts = $this->Workshift->getList($conditions);

		$conditions = array('Holiday.year' => date('Y'));

		$auth = $this->Session->read('Auth.User');

		$holidays = $this->Holiday->find('all',array('conditions' => $conditions ,'order' =>  array('Holiday.start_date ASC'),'fields' => array('id','name','type','start_date','end_date','year') ));
		
		$dpConditions = array();

		if ($auth['in_charge'] == 1) {

				$dpHelds = json_decode($auth['departments_handle']);

				$dpConditions = array('Department.id' => $dpHelds);

			
				///$departmentIds = array();
				//$departmentList = array();

				/* foreach ($departments as $key => $list) {
					$departmentList[$list['Department']['id']] = $list['Department']['department_position'];
					$departmentIds[] = $list['Department']['id'];
				} */
		}

		$departmentList = $this->Department->find('all',array('conditions' => $dpConditions,'fields' => array('id','name','description','notes','department_position')));


		$conditions = array();

		if (!empty($dpHelds )) {

			$conditions = array('Employee.department_id' => $dpHelds);
		}

		$employees = $this->Employee->getList($conditions);


			/* foreach ($departments as $key => $list) {
					$departmentList[$list['Department']['id']] = $list['Department']['department_position'];
					$departmentIds[] = $list['Department']['id'];
				} */

		//$departmentList = $this->Department->find('list',array('fields' => array('id','notes')));


		if ($this->request->is('post')) {	
			//save attendance
			
			$create_schedules = $this->WorkSchedule->formatData($this->request->data,$holidays);
			// $conditionAttendance = array();

			// $conditionAttendance = array_merge($conditionAttendance,array('Attendance.in' => null));

			// $this->Attendance->find('all',)



			if (!empty($create_schedules)) {

				if (!empty($this->request->data['WorkSchedule']['empId'])) {


						//pr( $create_schedules['WorkSchedule'] );

					foreach ($create_schedules['WorkSchedule'] as $key => $value)  :


						$save = $this->WorkSchedule->saveAll($value,array('deep' => true ));

					endforeach;

					if ($save) {

						$this->Session->setFlash('Work Schedule saved successfully','success');
				 		   
				 		   	$this->redirect( array(
			                         'controller' => 'schedules', 
			                         'action' => 'work_schedules',
			                         'tab'	=> 'work_schedules'
			                    ));
					} else {

						$this->Session->setFlash('There\'s an error saving Schedule','error');

					}
						
				} else {


						if ($this->WorkSchedule->saveAll($create_schedules['WorkSchedule'],array('deep' => true ))) {

							//$attendance = $this->Attendance->saveRecord($this->request->data['WorkSchedule'],$this->WorkSchedule->id,$holidays);
							
							//create ovetime limit
							$this->OvertimeLimit->createLimit($this->request->data['WorkSchedule'],$auth);
							
							$data['employee_id'] = $this->request->data['WorkSchedule']['foreign_key'];
							$data['date'] = $this->request->data['WorkSchedule']['day'];
							$data['type'] = $this->request->data['WorkSchedule']['type'];
							//must save daily info
							$dailynfo = $this->DailyInfo->saveDailyInfo($data);

							$this->Session->setFlash('Work Schedule saved successfully','success');
				 		   
				 		   	$this->redirect( array(
			                         'controller' => 'schedules', 
			                         'action' => 'work_schedules',
			                         'tab'	=> 'work_schedules'
			                    ));
						} else  {

							$this->Session->setFlash('There\'s an error saving Schedule','error');

						}

				}
				
		} else {
				$this->Session->setFlash('There\'s an error saving Schedule','error');
		}
			
			
		}

		$this->set(compact('employees','workshifts','departmentList'));
	}

	public function edit($id = null) {


		if (!empty($id)) {


		//check if in_charghe
		$auth = $this->Session->read('Auth.User');


		$this->loadModel('HumanResource.Department');

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.Workshift');


			if ($this->request->is('put')) {




				if ($this->WorkSchedule->save($this->request->data['WorkSchedule'])) {

					$in_charge  = !empty($this->request->data['WorkSchedule']['in_charge']) && $this->request->data['WorkSchedule']['in_charge'] == 1  ? 1 : '';

					if (!empty($in_charge) && $in_charge == 1) {
						$this->redirect( array(
	                             'controller' => 'work_schedules', 
	                             'action' => 'schedules',
	                             'tab'	=> 'schedules',
	                             'in_charge' => $in_charge,
	                             'default' => $this->request->data['WorkSchedule']['foreign_key']
	                        ));
					} else {

						$this->redirect( array(
	                             'controller' => 'schedules', 
	                             'action' => 'work_schedules',
	                             'tab'	=> 'work_schedules',
	                             'in_charge' => $in_charge
	                        ));
					}
					$this->Session->setFlash('Work Schedule saved successfully','success');
			 		   
				} else  {

					$this->Session->setFlash('There\'s an error saving Schedule','error');

				}



			}



		if (!empty($auth['in_charge']) && $auth['in_charge'] == 1 && empty($this->params['named']['in_charge'])) {

				  $this->redirect( array(
	                             'controller' => 'work_schedules', 
	                             'action' => 'edit',
	                             'in_charge' => 1,
	                             'tab'	=> 'work_schedules',

	                             $id,
	                        ));
		}


		$conditions = array();
		$employees = $this->Employee->getList($conditions);

		$conditions = array('overtime_id' => NULL);
		$workshifts = $this->Workshift->getList($conditions);
		
		$this->request->data = $this->WorkSchedule->findById($id);

		$departmentList = $this->Department->find('list',array('fields' => array('id','name')));


		$this->set(compact('employees','workshifts'));

		} else {

			$this->redirect( array(
                             'controller' => 'schedules', 
                             'action' => 'work_schedules',
                             'tab'	=> 'work_schedules'
                        ));
		}
	}

	public function delete($id = null) {


		if (!empty($id)) {

			if ($this->WorkSchedule->delete($id)) {
                $this->Session->setFlash(
                    __('Successfully deleted.', h($id))
                );
            } else {
                $this->Session->setFlash(
                    __('WorkShift cannot be deleted.', h($id))
                );
            }

            return $this->redirect( array(
                             'controller' => 'schedules', 
                             'action' => 'work_schedules',
                             'tab' => 'work_schedules',
                             'plugin' => 'human_resource'

                        ));
		}
 
	}

	public function export(){

		$employeeId = $this->request->data['WorkSchedule']['employee_id'];
		$workShiftId = $this->request->data['WorkSchedule']['work_shift_id'];

		$this->loadModel('HumanResource.Position');

		$this->loadModel('HumanResource.Department');

		$this->WorkSchedule->bind(array('Employee','WorkShift'));

		$conditions = array('WorkSchedule.model ' => 'Employee');

    	if(!empty($workShiftId)){

    		$conditions = array_merge($conditions,array('WorkSchedule.work_shift_id' => $workShiftId));

    	}

    	if(!empty($employeeId)){

    		$conditions = array_merge($conditions,array('WorkSchedule.foreign_key' => $employeeId));

    	}
        	
        $workScheduleData = $this->WorkSchedule->find('all', array(
            'conditions' => $conditions,
            'order' => 'WorkSchedule.id ASC'
        ));
		
		$positionList = $this->Position->find('list',array('field' => array('id','name')));

		$departmentList = $this->Department->find('list',array('field' => array('id','name')));

		$this->set(compact('workScheduleData','departmentList','positionList'));

		$this->render('WorkSchedules/xls/work_shift_report');
	}

	public function findByEmployeeId($id = null) {


		if (!empty($id)) {

		$this->loadModel('HumanResource.WorkSchedule');

		//$limit = 10;
		$conditions = array('WorkSchedule.model' => 'Employee','WorkSchedule.foreign_key' => $id );

		$params =  array(
	            'conditions' => $conditions,
	           // 'limit' => $limit,
	            //'group' => array('WorkSchedule.foreign_key'),
	            'order' => 'WorkSChedule.day ASC',
	        );

		$this->paginate = $params;

		$this->WorkSchedule->bind(array('WorkShift','Employee'));

	    $workSchedules = $this->WorkSchedule->find('all',$params);

	    $this->set(compact('workSchedules'));

	    $this->render('WorkSchedules/ajax/work_schedules');


		}
	}


	public function search_schedules() {

		$query = $this->request->query;

		if (!empty($query)) {

			$conditions = array();

			if (!empty($query['employee_id'])) {

				$conditions  = array_merge($conditions, array('WorkSchedule.model' => 'Employee','WorkSchedule.foreign_key' => $query['employee_id']));
			}

	

			if (!empty($query['from']) && !empty($query['to'])) {

				// $conditions  = array_merge($conditions,array(
				// 	'WorkSchedule.from >=' => $query['from'],
				// 	'WorkSchedule.to <=' => $query['to'],
				// 	));

				$conditions = array_merge($conditions,array(
					'date(WorkSchedule.day) BETWEEN ? AND ?' => array($query['from'],$query['to']), 
				));
			}

			$params['conditions'] = $conditions;
			$params['order'] = array('WorkSchedule.day ASC');

			$this->WorkSchedule->bind(array('WorkShift','Employee'));

	    	$workSchedules = $this->WorkSchedule->find('all',$params);
	    	
	    	$this->set(compact('workSchedules'));

	  		$this->render('WorkSchedules/ajax/work_schedules');
  
		}
	}


	public function change_schedule($empId = null) {


		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.Attendance');

		$this->loadModel('HumanResource.DailyInfo');

		$this->loadModel('HumanResource.Workshift');

		$this->loadModel('HumanResource.Holiday');

		$this->loadModel('HumanResource.OvertimeLimit');

		$conditions = array();
		$employees = $this->Employee->getList($conditions);

		$conditions = array('overtime_id' => NULL);

		$workshifts = $this->Workshift->getList($conditions);

		$conditions = array('Holiday.year' => date('Y'));

		$auth = $this->Session->read('Auth.User');

		$holidays = $this->Holiday->find('all',array('conditions' => $conditions ,'order' =>  array('Holiday.start_date ASC'),'fields' => array('id','name','type','start_date','end_date','year') ));


		if ($this->request->is('post')) {	
				//save attendance
			$create_schedules = $this->WorkSchedule->formatData($this->request->data,$holidays);

			//pr($create_schedules);exit();

			// $conditionAttendance = array();

			// $conditionAttendance = array_merge($conditionAttendance,array('Attendance.in' => null));

			// $this->Attendance->find('all',)


			if (!empty($create_schedules)) {

				if ($this->WorkSchedule->saveAll($create_schedules['WorkSchedule'])) {

				//$attendance = $this->Attendance->saveRecord($this->request->data['WorkSchedule'],$this->WorkSchedule->id,$holidays);
				
				//create ovetime limit
				$this->OvertimeLimit->createLimit($this->request->data['WorkSchedule'],$auth);
				
				$data['employee_id'] = $this->request->data['WorkSchedule']['foreign_key'];
				$data['date'] = $this->request->data['WorkSchedule']['day'];
				$data['type'] = $this->request->data['WorkSchedule']['type'];
				//must save daily info
				$dailynfo = $this->DailyInfo->saveDailyInfo($data);

				$this->Session->setFlash('Work Schedule saved successfully','success');

				$in_charge  = !empty($this->request->data['WorkSchedule']['in_charge']) && $this->request->data['WorkSchedule']['in_charge'] == 1  ? 1 : '';

					
				if (!empty($in_charge) && $in_charge == 1) {
						$this->redirect( array(
				                 'controller' => 'work_schedules', 
				                 'action' => 'schedules',
				                 'tab'	=> 'schedules',
				                 'in_charge' => $in_charge,
				                 'default' => $this->request->data['WorkSchedule']['foreign_key']
				            ));
					} else {
					   
				   	$this->redirect( array(
				         'controller' => 'schedules', 
				         'action' => 'work_schedules',
				         'tab'	=> 'work_schedules',
				         'default' => $this->request->data['WorkSchedule']['foreign_key']
				    ));

				   }
			} else  {

				$this->Session->setFlash('There\'s an error saving Schedule','error');

			}
		} else {
				$this->Session->setFlash('There\'s an error saving Schedule','error');
		}
			
			
		}

		$this->set(compact('employees','workshifts','empId'));

	}


	public function schedules() {

		$date = date('Y-m-d');

		$this->loadModel('HumanResource.Department');

		$this->loadModel('HumanResource.Employee');

		$limit = 10;

		$userData = $this->Session->read('Auth.User');

		$conditions = array();

		if ($userData['in_charge'] == 1) {	


			//departIds 

			$departments = json_decode($userData['departments_handle']);
			$conditions = array_merge($conditions,array('Department.id' => $departments));
		}

		$departments = $this->Department->find('all',array('conditions' => $conditions,'fields' => array('id','name','description','department_position')));

		$departmentIds = array();
		$departmentList = array();

		foreach ($departments as $key => $list) {
			$departmentList[$list['Department']['id']] = $list['Department']['department_position'];
			$departmentIds[] = $list['Department']['id'];
		}

		$conditions = array('Employee.department_id' => $departmentIds);

		$employeeList = $this->Employee->getList($conditions);

		$defaults = !empty($this->params['named']['default']) ? $this->params['named']['default'] : '';

		$this->set(compact('employeeList','date','departments','departmentList','defaults'));

		//schedules for productions

		//$this->render('WorkSchedule/add');
	}

}