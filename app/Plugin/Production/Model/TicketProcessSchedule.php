<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class TicketProcessSchedule extends AppModel {

    public $useDbConfig = 'koufu_production';
    public $name = 'TicketProcessSchedule';

     public $recursive = -1;
     
    public $actsAs = array('Containable');

    public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'ProcessDepartment' => array(
					'className' => 'Production.ProcessDepartment',
					'foreignKey' => 'department_process_id',
					'dependent' => true,
				)
				)
		),false);

		$this->contain($model);
	}

	public function saveTicketProcessSchedule($data,$auth){
		
		$ticketID = array();	

		$idHolder = array();
		
		foreach ($data['TicketProcessSchedule'] as $mainKey => $value) {
				
			$this->create();

			if (is_array($value)) {

			
				
				foreach ($value as $key => $innerValue) {

						$ticketData = array();

					if (!empty($innerValue['department_process_id'])) {

						$ticketData = $innerValue;
						$ticketData['job_ticket_id'] = $data['Ticket']['job_ticket_id'];
						$ticketData['component_id'] = $mainKey;
						$ticketData['remarks'] = '';
						$ticketData['status'] = '';

						$ticketData['id'] = !empty($innerValue['id']) ? $innerValue['id'] : '';

						if( $this->save($ticketData) ) {

							$idHolder = $this->id;
							$ticketID[] = $idHolder;
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