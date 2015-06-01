<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class JobTicket extends AppModel {

    public $useDbConfig = 'koufu_ticketing';

    public $name = 'JobTicket';

	// public $recursive = -1;

	// public $actsAs = array('Containable');

	// public function bind($model = array('Group')){

	// 	$this->bindModel(array(
	// 		'belongsTo' => array(
	// 			'Company' => array(
	// 				'className' => 'Company',
	// 				'foreignKey' => 'foreign_key',
	// 				'dependent' => true
	// 			),
	// 			'Contactperson' => array(
	// 				'className' => 'Company',
	// 				'foreignKey' => 'Contactperson',
	// 				'dependent' => true
	// 			)
	// 		)
	// 	));

	// 	$this->contain($model);
	// }

	public $validate = array(

		'unique_id' => array(
			'unique' => array(
				'rule'    => 'isUnique',
				'message' => 'This Ticket Unique Id has already been taken.'
			)
		),
	
	);

	public function saveUniqueId($uniqueId = null, $auth = null){

		$this->create();

		if($this->save(array('unique_id' =>$uniqueId ,'status' => '0','job_ticket_id' => '1','created_by' =>$auth,'modified_by' =>$auth))){
			
        	return $this->id;

        }
	}

	
	public function updateStatus($ticketId){
		
		$this->id = $this->find('first',array(
			'conditions' => array(
				'Ticket.id' => $ticketId
				)
			));

		if ($this->id) {
		    $this->saveField('status', 1);

		}

		return $this->id;

	}

	public function finishedJob($ticketId){

		$ticketQuery = $this->id = $this->find('first',array(
			'conditions' => array(
				'Ticket.id' => $ticketId
				)
			)); 
		$jobTicketId = $ticketQuery['Ticket']['job_ticket_id'] + 1;
		//pr($jobTicketId);

		if ($this->id) {
			    $this->save(array('status' =>0,
		     				'job_ticket_id' =>$jobTicketId 
		    ));

		 }

		  return $this->id;

	}

	public function saveTicket($clientData = null,$auth = null,$clientOrderId = null){
		
		$month = date("m"); 
	    $year = date("y");
	    $hour = date("H");
	    $minute = date("i");
	    $seconds = date("s");
	    $random = rand(1000, 10000);

	    $code =  $year. $month .$random;
	    $this->create();

	    $data[$this->name]['uuid'] = $code;
	    $data[$this->name]['product_id'] = $productUuid;
	    $data[$this->name]['created_by'] = $auth;
	    $data[$this->name]['modified_by'] = $auth;

	    $this->save($data);

	    return $this->id;


	}

}
