<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class RecievedTicket extends AppModel {

    public $useDbConfig = 'koufu_production';

    public $name = 'RecievedTicket';

    public $recursive = -1;
     
    public $actsAs = array('Containable');

    public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'JobTicket' => array(
					'className' => 'Ticket.JobTicket',
					'foreignKey' => 'job_ticket_id',
					'dependent' => true,
				),
			)
		),false);

		$this->contain($model);
	}

}