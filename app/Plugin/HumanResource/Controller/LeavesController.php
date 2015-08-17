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
			
			$dateRange = str_replace(' ', '', $this->request->data['Leave']['date_range']);
       
            $splitDate = split('-', $dateRange);
            $from = str_replace('/', '-', $splitDate[0]);
            $to = str_replace('/', '-', $splitDate[1]);

            $this->request->data['Leave']['from'] = $from;
            $this->request->data['Leave']['to'] = $to;
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

			$dateRange = str_replace(' ', '', $this->request->data['Leave']['date_range']);
       
            $splitDate = split('-', $dateRange);
            $from = str_replace('/', '-', $splitDate[0]);
            $to = str_replace('/', '-', $splitDate[1]);

            $this->request->data['Leave']['from'] = $from;
            $this->request->data['Leave']['to'] = $to;
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

		}

		$conditions = array();
		$employees = $this->Employee->getList($conditions);

		$leavetypeList = $this->LeaveType->find('list',array('fields' => array('id','name')));

		$this->set(compact('employees','leavetypeList'));

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

}