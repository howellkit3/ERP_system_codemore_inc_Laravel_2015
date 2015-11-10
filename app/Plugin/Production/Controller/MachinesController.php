<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class MachinesController extends ProductionAppController {

    public function add() {

    	$this->loadModel('Production.Department');

    	$this->loadModel('Production.Section');

        $this->loadModel('Production.MachineSpecification');

    	$departmentList = $this->Department->find('list',array('fields' => array('id','name')));

    	$sectionList = $this->Section->find('list',array('fields' => array('id','name')));

    	$auth = $this->Session->read('Auth.User');

        $this->loadModel('Production.ProcessDepartment');
        $processDepartmentData = $this->ProcessDepartment->find('list',array('fields' => array('id','name')));

		if(!empty($this->request->data)){
			
			$machineId = $this->Machine->saveMachine($this->request->data,$auth['id']);

            $this->MachineSpecification->saveMachineSpecification($this->request->data,$machineId,$auth['id']);

			//$save
	 		$this->Session->setFlash('Saving Machine information completed','success');

 		   	$this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'machines',
                     'tab' => 'machines'
                ));
		}

    	$this->set(compact('departmentList','sectionList','processDepartmentData'));

    }

    public function edit($id = null) {

        $this->loadModel('Production.Department');

        $this->loadModel('Production.Section');

        $departmentList = $this->Department->find('list',array('fields' => array('id','name')));

        $sectionList = $this->Section->find('list',array('fields' => array('id','name')));

        $auth = $this->Session->read('Auth.User');

        $this->loadModel('Production.ProcessDepartment');
        $processDepartmentData = $this->ProcessDepartment->find('list',array('fields' => array('id','name')));

        if(!empty($this->request->data)){
            
            $this->Machine->saveMachine($this->request->data,$auth['id']);

            //$save
            $this->Session->setFlash('Saving Machine information completed','success');
            $this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'machines',
                     'tab' => 'machines'
                ));
        }
        
        if (!empty($id)) {

            $this->request->data = $this->Machine->findById($id);

        }

        $this->set(compact('departmentList','sectionList','processDepartmentData'));

    }

    public function delete($posId){

        $this->loadModel('HumanResource.Machine');

        if (!empty($posId)) {

            if ($this->Machine->delete($posId)) {
                $this->Session->setFlash(
                    __('Machine Successfully deleted.', h($posId))
                );
            } else {
                $this->Session->setFlash(
                    __('Machine cannot be deleted.', h($posId))
                );
            }

            return $this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'machines',
                     'tab' => 'machines',
                     'plugin' => 'production'

                ));
        }
    }

    public function getMachineData($departmentProcessId = null){

        $this->autoRender = false; 

        $machineList = $this->Machine->find('all',array('conditions' => array('Machine.department_process_id' => $departmentProcessId),'fields' => array('id','no')));

        return json_encode($machineList);

    }
    

    public function view_schedules($logId = null) {

        if (!empty($logId)) {

            $this->loadModel('Production.MachineLog');

            $this->loadModel('Ticket.JobTicket');

            $this->loadModel('Production.TicketProcessSchedule');


            $this->loadModel('Sales.Company');

            $this->loadModel('Production.Machine');

            $this->loadModel('Sales.Product');

            $this->MachineLog->bindTicket();

            $logs = $this->MachineLog->findById($logId);

            $companyData = $this->Company->find('list',array('fields' => array('id','company_name')));

            $machineData = $this->Machine->find('list',array('fields' => array('id','name')));

            $productName = $this->Product->find('list',array('fields' => array('id','name')));

            $ticketData =$this->JobTicket->findById($logs['TicketProcessSchedule']['job_ticket_id']);


            $this->set(compact('ticketData','logs','productName','machineData','companyData'));

            $this->render('Machines/ajax/view_logs');
        }
    }
}