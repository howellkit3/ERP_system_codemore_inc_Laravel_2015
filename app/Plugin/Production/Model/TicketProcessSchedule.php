<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class TicketProcessSchedule extends AppModel {

    public $useDbConfig = 'koufu_production_system';
    public $name = 'TicketProcessSchedule';

     public $recursive = -1;
     
    public $actsAs = array('Containable');

    public function bind($model = array('Group')){

		// $this->bindModel(array(
		// 	'belongsTo' => array(
		// 		'JobTicket' => array(
		// 			'className' => 'Ticket.JobTicket',
		// 			'foreignKey' => 'job_ticket_id',
		// 			'dependent' => true,
		// 		),
		// 		'MachineLog' => array(
		// 			'className' => 'Production.MachineLog',
		// 			'foreignKey' => false,
		// 			'conditions' => 'MachineLog.machine_schedule_id = MachineSchedule.id' ,
		// 			'dependent' => true,
		// 		),
				
		// 	)
		// ),false);

		// $this->contain($model);
	}

	public function saveTicketProcessSchedule($data,$auth){

		$this->create();
		 
		$data['MachineSchedule']['created_by'] = $auth;
		$data['MachineSchedule']['modified_by'] = $auth;
		$data['MachineSchedule']['process_status'] = 1;
		$this->save($data);

		return $this->id;
		
	}
	
}