<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


App::uses('ImageUploader', 'Vendor');

class LeaveTypesController  extends HumanResourceAppController {


	public function add() {

		$this->loadModel('HumanResource.LeaveType');

		$auth = $this->Session->read('Auth.User');

		if(!empty($this->request->data)){
			
            //pr($this->request->data);exit();
			$this->LeaveType->saveLeaveType($this->request->data,$auth['id']);

			//$save
	 		$this->Session->setFlash('Saving Leave Type information completed','success');
 		   	$this->redirect( array(
                 'controller' => 'settings', 
                 'action' => 'leave_types',
                 'tab' => 'leave_types'
            ));
		}

	}

	public function edit($id = null) {

		$this->loadModel('HumanResource.LeaveType');

		$auth = $this->Session->read('Auth.User');
		
		if(!empty($this->request->data)){

			$this->LeaveType->saveLeaveType($this->request->data,$auth['id']);

			//$save
	 		$this->Session->setFlash('Saving Leave Type information completed','success');
 		   	$this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'leave_types',
                     'tab' => 'leave_types'
                ));
		}
		
		if (!empty($id)) {

			$this->request->data = $this->LeaveType->findById($id);

		}

	}

	public function view($id = null ) {

		$this->loadModel('HumanResource.LeaveType');

		$auth = $this->Session->read('Auth.User');
		
		if (!empty($id)) {

			$leaveTypeData = $this->LeaveType->findById($id);

		}

		$this->set(compact('leaveTypeData'));

	}

	public function delete($id){

		$this->loadModel('HumanResource.LeaveType');

		if (!empty($id)) {

			if ($this->LeaveType->delete($id)) {
                $this->Session->setFlash(
                    __('Leave Type Successfully deleted.', h($id))
                );
            } else {
                $this->Session->setFlash(
                    __('LeaveT ype cannot be deleted.', h($id))
                );
            }

            return $this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'leave_types',
                     'tab' => 'leave_types',
                     'plugin' => 'human_resource'

                ));
		}
	}
}