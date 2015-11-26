<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class TicketProcessSchedule extends AppModel {

    public $useDbConfig = 'koufu_production';

    public $name = 'TicketProcessSchedule';

     public $recursive = -1;
     
    public $actsAs = array('Containable');

    public $belongsTo = array(
    // 			'ProductSpecificationProcessHolder' => array(
				// 	'className' => 'Sales.ProductSpecificationProcessHolder',
				// 	'foreignKey' => false,
				// 	'dependent' => 'ProductSpecificationProcessHolder.id = TicketProcessSchedule.department_process_id',
				// ),
				'JobTicket' => array(
					'className' => 'Ticket.JobTicket',
					'foreignKey' => 'job_ticket_id',
					//'conditions' => 'JobTicket.id = TicketProcessSchedule.job_ticket_id'
				),
				'ClientOrder' => array(
					'className' => 'Sales.ClientOrder',
					'foreignKey' => false,
					'conditions' => array('ClientOrder.id' => 'JobTicket.client_order_id')
				),
				'RecievedTicket' => array(
					'className' => 'Production.RecievedTicket',
					'foreignKey' => false,
					'conditions' => 'RecievedTicket.job_ticket_id = TicketProcessSchedule.job_ticket_id'
				),
				'ProductSpecificationProcessHolder' => array(
					'className' => 'Sales.ProductSpecificationProcessHolder',
					'foreignKey' => 'product_specification_process_holder_id',
					//'conditions' => array('ProductSpecificationProcessHolder.id' => 'TicketProcessSchedule.product_specification_process_holder_id'),
					//'dependent' => true
				),
				'ProductSpecificationProcess' => array(
					'className' => 'Sales.ProductSpecificationProcess',
					//'foreignKey' => 'product_specification_process_id',
					'conditions' => array('ProductSpecificationProcess.id = ProductSpecificationProcessHolder.product_specification_process_id'),
					//'dependent' => true
				)
			);

    // public $hasOne = array(
				// 'ProductSpecificationProcessHolder' => array(
				// 	'className' => 'Sales.ProductSpecificationProcessHolder',
				// 	'foreignKey' => false,
				// 	'conditions' => 'ProductSpecificationProcessHolder.id = TicketProcessSchedule.product_specification_process_holder_id',
				// 	'dependent' => true
				// )

    // 	);

    public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'ProductSpecificationProcessHolder' => array(
					'className' => 'Sales.ProductSpecificationProcessHolder',
					'foreignKey' => false,
					'dependent' => 'ProductSpecificationProcessHolder.id = TicketProcessSchedule.department_process_id',
				),
				'JobTicket' => array(
					'className' => 'Ticket.JobTicket',
					//'foreignKey' => 'job_ticket_id',
					'conditions' => 'JobTicket.id = TicketProcessSchedule.job_ticket_id'
				),
				'ClientOrder' => array(
					'className' => 'Sales.ClientOrder',
					'foreignKey' => false,
					'conditions' => array('ClientOrder.id = JobTicket.client_order_id')
				),
				'RecievedTicket' => array(
					'className' => 'Production.RecievedTicket',
					'foreignKey' => false,
					'conditions' => 'RecievedTicket.job_ticket_id = TicketProcessSchedule.job_ticket_id'
				),
				
				
				
			),
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


						pr($ticketData);
						// if( $this->save($ticketData) ) {

						// 	$idHolder = $this->id;
						// 	$ticketID[] = $idHolder;
						// }
					
					}

					
				}

				exit();

			} else {


			if (!empty($data['TicketProcessSchedule']['department_process_id'])) {
				$ticketData = $data['TicketProcessSchedule'];
			 	$ticketData['job_ticket_id'] = $data['Ticket']['job_ticket_id'];
				$ticketData['created_by'] = $auth;
				$ticketData['modified_by'] = $auth;	

				pr($ticketData);

					if ($this->save($ticketData) ) {

						$idHolder = $this->id;
						array_push($ticketID, $idHolder);
					}
			}
			
			}	


		} 


		return $ticketID;
		
		
	}

	public function saveProcess($data = array(),$auth) {

		$ticketData = array();
		$lastId = array();
		if (!empty($data)) {

				$ticketData = $data['TicketProcessSchedule'];
				$ticketData['created_by'] = $auth;
				$ticketData['modified_by'] = $auth;	

				
				if ($this->save($ticketData)) {

					$lastId[] = $this->id;

				}


		}

		return $lastId;
	}
	
}