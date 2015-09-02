<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class MachineLog extends AppModel {

    public $useDbConfig = 'koufu_production_system';
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

	public function saveMachineLog($ticketProcessScheduleID = null, $auth =null){

		foreach ($ticketProcessScheduleID as $key => $value) {
			
			$this->create();

			$timeHolder = date("H:i:s");
			 
			$data['MachineLog']['ticket_process_schedule_id'] = $value;
			$data['MachineLog']['start'] = $timeHolder;
			$data['MachineLog']['start_by'] = $auth;
			//pr($data); exit;
			$this->save($data);

		} 
	}
	
}