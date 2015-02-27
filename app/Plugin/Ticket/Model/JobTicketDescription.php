<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */

class JobTicketDescription extends AppModel {
	public $useDbConfig = 'koufu_ticketing_system';

	public $actsAs = array('Containable');
    public $name = 'JobTicketDescription';

     public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'JobTicketSummary' => array(
					'className' => 'Delivery.JobTicketSummary',
					'foreignKey' => 'detail_id',
					'dependent' => true
				),


			)
		),false);

		$this->contain($model);
	}

}