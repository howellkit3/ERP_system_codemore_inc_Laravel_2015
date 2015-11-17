<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class OutputsController extends ProductionAppController {

    public function view_schedules($id = null) {

    	if (!empty($id)) {

    		$this->loadModel('Production.TicketProcessSchedule');

    		$this->loadModel('Ticket.JobTicket');

    		 $this->loadModel('Sales.Company');

            $this->loadModel('Production.Machine');

            $this->loadModel('Production.MachineLog');

            $this->loadModel('Sales.Product');

            $companyData = $this->Company->find('list',array('fields' => array('id','company_name')));

            $machineData = $this->Machine->find('list',array('fields' => array('id','name')));

            $productName = $this->Product->find('list',array('fields' => array('id','name')));

    		$this->Output->bind(array('TicketProcessSchedule','JobTicket','MachineLog'));

    		$output = $this->Output->findById($id);

    		$this->set(compact('output','companyData','machineData','productName'));

			$this->render('Outputs/ajax/view_logs');

    	}

    }

    public function save_logs(){

    	    if ($this->request->is('post')) {

            $this->loadModel('Production.Output');

            $this->loadModel('Production.MachineLog');

            $this->loadModel('Production.TicketProcessSchedule');


            $this->loadModel('Production.ProcessDepartment');


            $auth = $this->Session->read('Auth.User');

            $data = $this->request->data;

            if (!empty($this->request->data['MachineLog']['status'])) {

                $data['Output']['status'] = $this->request->data['MachineLog']['status'];
            }

            if ($this->Output->save( $data )) {

                //save Output
                $this->MachineLog->saveLog( $data,$auth );

                //$save
                $this->Session->setFlash('Saving Log Succesfully','success');

                $tab = '';

               if (!empty($data['Output']['department_process_id'])) {

                    $process = $this->ProcessDepartment->findById($data['Output']['department_process_id']);

                    $tab = strtolower(Inflector::slug($process['ProcessDepartment']['name'], '-'));
                }

                $this->TicketProcessSchedule->id = $data['Output']['ticket_process_schedule_id'];
                 $this->TicketProcessSchedule->savefield('status' , $overtime_id);
                

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