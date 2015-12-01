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

            $this->loadModel('Production.ProcessDepartment');

            $this->loadModel('Sales.Company');

            $this->loadModel('Production.Machine');

            $this->loadModel('HumanResource.Employee');

            $this->loadModel('Sales.Product');

            $this->MachineLog->bindTicket();

            $logs = $this->MachineLog->findById($logId);

            $companyData = $this->Company->find('list',array('fields' => array('id','company_name')));

            $machineData = $this->Machine->find('list',array('fields' => array('id','name')));

            $processDepartmentData = $this->ProcessDepartment->find('list',array('fields' => array('id','name')));

            $conditions = array();
            
            $employees =  $this->Employee->getOperator('list',$conditions);   


            $ticketData = $this->JobTicket->query(
                "Select * from koufu_ticketing.job_tickets as JobTicket 
                LEFT JOIN koufu_sale.products as Product
                ON (Product.id = JobTicket.product_id) WHERE JobTicket.id = ".$logs['TicketProcessSchedule']['job_ticket_id']."
                LIMIT 1
                "
            );

            $ticketData = $ticketData[0];

            $this->set(compact('ticketData','logs','productName','machineData','companyData','employees','processDepartmentData'));

            $this->render('Machines/ajax/view_logs');
        }
    }

    public function save_logs() {

        if ($this->request->is('post')) {

            $this->loadModel('Production.Output');

            $this->loadModel('Production.OutputDetail');

            $this->loadModel('Production.MachineLog');

            $this->loadModel('Production.TicketProcessSchedule');

            $this->loadModel('Production.ProcessDepartment');

            $auth = $this->Session->read('Auth.User');

            $data = $this->request->data;

            if ($this->MachineLog->save( $data )) {

                //save Output
                $outputId = $this->Output->saveOutput( $data,$auth );


                if ($outputId) {
                    //save details
                    $this->OutputDetail->saveDetails($outputId,$this->request->data);
                }

                //$save
                $this->Session->setFlash('Saving Log Succesfully','success');

                $tab = '';

               if (!empty($data['Output']['department_process_id'])) {

                    $process = $this->ProcessDepartment->findById($data['Output']['department_process_id']);

                    $tab = strtolower(Inflector::slug($process['ProcessDepartment']['name'], '-'));
                }

                $this->redirect(array(
                    'controller' => 'jobs',
                    'action' => 'view_process',
                    $data['Output']['department_process_id'],
                    'tab' => $tab 

                ));

            } else {

                $this->Session->setFlash('There\'s an error saving process,error');

            }

            pr($this->request->data);
            exit();
        }
    }
}