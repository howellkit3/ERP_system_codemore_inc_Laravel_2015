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

		$conditions = array();
		$employees = $this->Employee->getList($conditions);

		$conditions = array();
		$workshifts = $this->Workshift->getList($conditions);

		$conditions = array('Holiday.year' => date('Y'));

		$holidays = $this->Holiday->find('all',array('conditions' => $conditions ,'order' =>  array('Holiday.start_date ASC'),'fields' => array('id','name','type','start_date','end_date','year') ));


		if ($this->request->is('post')) {	
				//save attendance
			$create_schedules = $this->WorkSchedule->formatData($this->request->data,$holidays);

			// pr($create_schedules);exit();

			// $conditionAttendance = array();

			// $conditionAttendance = array_merge($conditionAttendance,array('Attendance.in' => null));

			// $this->Attendance->find('all',)


			if ($this->WorkSchedule->saveAll($create_schedules['WorkSchedule'])) {

				$attendance = $this->Attendance->saveRecord($this->request->data['WorkSchedule'],$this->WorkSchedule->id,$holidays);

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

				$this->Session->setFlash('There\'s an error saving Schedule','success');

			}
			
		}

		$this->set(compact('employees','workshifts'));
	}

	public function edit($id = null) {


		if (!empty($id)) {

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.Workshift');


			if ($this->request->is('put')) {


				if ($this->WorkSchedule->save($this->request->data['WorkSchedule'])) {

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


		$conditions = array();
		$employees = $this->Employee->getList($conditions);

		$conditions = array();
		$workshifts = $this->Workshift->getList($conditions);
		
		$this->request->data = $this->WorkSchedule->findById($id);

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

}