<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class MachineSchedulesController extends ProductionAppController {

    public function add() {

        $auth = $this->Session->read('Auth.User');

        $this->loadModel('Ticket.JobTicket');

        $this->loadModel('Production.MachineLog');

    	if (!empty($this->request->data)) {
            
            $data = $this->request->data;
            
            //update status of jobticket
            $this->JobTicket->id = $data['MachineSchedule']['job_ticket_id'];
            $this->JobTicket->saveField('production_status',$data['MachineSchedule']['status_ticket']);

            $machineSchedID = $this->MachineSchedule->saveMachineSchedule($data,$auth['id']);

            $this->MachineLog->saveMachineLog($machineSchedID);

            if ($this->request->is('ajax')) {
                
                $ajaxData['JobTicket']['status'] = 1;
                $ajaxData['JobTicket']['id'] = $data['MachineSchedule']['job_ticket_id'];

                echo json_encode($ajaxData);
                exit();
            }
            
        }

    }

   
   
    
}