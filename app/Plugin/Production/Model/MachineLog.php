<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class MachineLog extends AppModel {

    public $useDbConfig = 'koufu_production';
    public $name = 'MachineLog';

     public $recursive = -1;
     
    public $actsAs = array('Containable');

 //    public function bind($model = array('Group')){

	// 	$this->bindModel(array(
	// 		'belongsTo' => array(
	// 			'JobTicket' => array(
	// 				'className' => 'Ticket.JobTicket',
	// 				'foreignKey' => 'job_ticket_id',
	// 				'dependent' => true,
	// 			),
	// 		)
	// 	),false);

	// 	$this->contain($model);
	// }

	public function bindTicket() {
		$this->bindModel(array(
			'belongsTo' => array(
				'TicketProcessSchedule' => array(
					'className' => 'Production.TicketProcessSchedule',
					'foreignKey' => false,
					'conditions' => 'TicketProcessSchedule.id = MachineLog.ticket_process_schedule_id'
				),
			)
		));
		$this->recursive = 1;
		//$this->contain($giveMeTheTableRelationship);
	}

	public function saveMachineLog($ticketProcessScheduleID = null, $auth =null){

		$ids = array();	
		foreach ($ticketProcessScheduleID as $key => $value) {
			
			$this->create();

			// $timeHolder = date("H:i:s");
				

			// pr();


			$data['MachineLog']['ticket_process_schedule_id'] = $value;
			//$data['MachineLog']['start'] = $timeHolder;
			$data['MachineLog']['start_by'] = $auth;
			//pr($data); exit;
			$id = $this->save($data);

		} 

		return $ids;
	}

	public function saveLog($data,$auth){

		$this->create();
		 
		$data['Machine']['created_by'] = $auth;
		$data['Machine']['modified_by'] = $auth;
		$this->save($data);

		return $this->id;
		

	}
	
}