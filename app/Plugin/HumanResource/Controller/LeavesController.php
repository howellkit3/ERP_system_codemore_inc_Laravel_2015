<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


App::uses('ImageUploader', 'Vendor');

class LeavesController  extends HumanResourceAppController {


	public function add() {

		$this->loadModel('HumanResource.Leave');

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.LeaveType');

		$auth = $this->Session->read('Auth.User');

		if(!empty($this->request->data)){
			
			// $dateRange = str_replace(' ', '', $this->request->data['Leave']['date_range']);
       
   //          $splitDate = split('-', $dateRange);
   //          $from = str_replace('/', '-', $splitDate[0]);
   //          $to = str_replace('/', '-', $splitDate[1]);

            // $this->request->data['Leave']['from'] = $from;
            // $this->request->data['Leave']['to'] = $to;
            $this->request->data['Leave']['status'] = 8;
            //pr($this->request->data);exit();
			$this->Leave->saveLeave($this->request->data,$auth['id']);

			//$save
	 		$this->Session->setFlash('Saving Leave information completed','success');
 		   	$this->redirect( array(
                 'controller' => 'attendances', 
                 'action' => 'leaves',
                 'tab' => 'leaves'
            ));
		}

		$conditions = array();
		$employees = $this->Employee->getList($conditions);

		$leavetypeList = $this->LeaveType->find('list',array('fields' => array('id','name')));

		$this->set(compact('employees','leavetypeList'));

	}

	public function edit($id = null) {

		$this->loadModel('HumanResource.Leave');

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.LeaveType');

		$auth = $this->Session->read('Auth.User');
		
		if(!empty($this->request->data)){

			// $dateRange = str_replace(' ', '', $this->request->data['Leave']['date_range']);
       
   //          $splitDate = split('-', $dateRange);
   //          $from = str_replace('/', '-', $splitDate[0]);
   //          $to = str_replace('/', '-', $splitDate[1]);

   //          $this->request->data['Leave']['from'] = $from;
   //          $this->request->data['Leave']['to'] = $to;
            $this->request->data['Leave']['status'] = 8;
			
			$this->Leave->saveLeave($this->request->data,$auth['id']);

			//$save
	 		$this->Session->setFlash('Saving Leave information completed','success');
 		   	$this->redirect( array(
                     'controller' => 'attendances', 
                     'action' => 'leaves',
                     'tab' => 'leaves'
                ));
		}
		
		if (!empty($id)) {

			$this->request->data = $this->Leave->findById($id);

			$from = new DateTime($this->request->data['Leave']['from'].'00:00:00');

			$to = new DateTime($this->request->data['Leave']['to'].'00:00:00');

			$diff = $from->diff($to);

			$note = $diff->d;
			$remainingHours = $diff->d * 8;
			
		}

		$employees = $this->Employee->getList();

		$leavetypeList = $this->LeaveType->find('list',array('fields' => array('id','name')));

		$limit = $this->LeaveType->find('list',array('fields' => array('id','limit')));

		$this->set(compact('employees','leavetypeList','limit','remainingHours','note'));

	}

	public function view($id = null ) {

		$this->loadModel('HumanResource.Leave');

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.Type');

		$this->Leave->bind(array('Employee','Type'));

		$auth = $this->Session->read('Auth.User');
		
		if (!empty($id)) {

			$leaveData = $this->Leave->findById($id);

		}

		$this->set(compact('leaveData'));

	}

	public function approved($leaveId = null){

		$this->loadModel('User');

		$userData = $this->User->read(null,$this->Session->read('Auth.User.id'));

		$this->Leave->id = $leaveId;
		$this->Leave->saveField('status', 1);
		$this->Leave->saveField('modified_by', $userData['User']['id']);
		
		$this->Session->setFlash(__('Leave Approved.'));

		exit();
	}

	public function limit_hours($leaveTypeId = null, $employeeId = null, $leaveID = null){

		$this->autoRender = false;

		$this->loadModel('HumanResource.Leave');

		$this->loadModel('HumanResource.LeaveType');

		$conditions = array();

		$conditions = array_merge($conditions,array('Leave.employee_id' => $employeeId));

		$conditions = array_merge($conditions,array('Leave.type_id' => $leaveTypeId));

		if (!empty($leaveID)) {
			$conditions = array_merge($conditions,array('Leave.id !=' => $leaveID));
		}

		$leaveData = $this->Leave->find('all',array('conditions' => array($conditions)));
		
		$leaveType = $this->LeaveType->find('first',array('fields' => array('id','limit'),'conditions' => array('LeaveType.id' => $leaveTypeId)));

	
		if (!empty($leaveData)) {

			// $data['remaining'] = 0;

			// $plusDay = 0;

			$days = 0;

			foreach ($leaveData as $key => $leaveList) {

				$from = new DateTime($leaveList['Leave']['from'].'00:00:00');

				$to = new DateTime($leaveList['Leave']['to'].'00:00:00');

				$diff = $from->diff($to);

				$days = $days + ($diff->d * 8);

			}

			$remainingHours = $leaveType['LeaveType']['limit'] - $days;
				
			$data['remaining'] = $remainingHours;

			$plusDay = $remainingHours;

		}else{

			$data['remaining'] = $leaveType['LeaveType']['limit'];

			$plusDay = $leaveType['LeaveType']['limit'];

		}

		$data['limit'] = $leaveType['LeaveType']['limit'];

		$dayPlus = $plusDay / 8;

		$data['plus_day'] = $dayPlus;

        echo json_encode($data);
		
	}

	public function export(){

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.LeaveType');

		$this->loadModel('HumanResource.Leave');
		
		$employeeId = $this->request->data['Leave']['employee_id'];
		$leaveType = $this->request->data['Leave']['type_id'];

		$this->Leave->bind(array('Employee','LeaveType'));

		$conditions = array();

    	if(!empty($employeeId)){

    		$conditions = array_merge($conditions,array('Leave.employee_id' => $employeeId));

    	}

    	if(!empty($leaveType)){

    		$conditions = array_merge($conditions,array('Leave.type_id' => $leaveType));

    	}
        	
        $leaveData = $this->Leave->find('all', array(
            'conditions' => $conditions,
            'order' => 'Leave.id ASC'
        ));
        
		$this->set(compact('leaveData'));

		$this->render('Leaves/xls/leave_report');

	}

	public function getmaxdate($datemin = null, $plusday = null){

		$this->autoRender = false;

		$date2 = date('Y-m-d', strtotime($datemin . ' +'.$plusday.' day'));

		echo json_encode($date2);
		

	}

}