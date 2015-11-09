<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class TicketProcessSchedule extends AppModel {

    public $useDbConfig = 'koufu_production';
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
		
		$ticketID = array();	



	
		$idHolder = array();

		foreach ($data['TicketProcessSchedule'] as $mainKey => $value) {
				
			$this->create();

			if (is_array($value)) {

				$ticketData = array();
				
				foreach ($value as $key => $innerValue) {

					if (!empty($innerValue['department_process_id'])) {

						

						$ticketData[$key]= $innerValue;
						$ticketData[$key]['job_ticket_id'] = $data['Ticket']['job_ticket_id'];

						$ticketData[$key]['component_id'] = $mainKey;


						if ($this->save($ticketData[$key]) ) {

							$idHolder = $this->id;
							array_push($ticketID, $idHolder);
						}

					}



				}
			} else {


			if (!empty($data['department_process_id'])) {

			 	$ticketData['job_ticket_id'] = $data['Ticket']['job_ticket_id'];
				$ticketData['created_by'] = $auth;
				$ticketData['modified_by'] = $auth;	

					if ($this->save($ticketData) ) {

						$idHolder = $this->id;
						array_push($ticketID, $idHolder);
					}
			}
			
			}	


		} 


		return $ticketID;
		
		
	}
	
}