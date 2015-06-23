<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Transmittal extends AppModel {
	public $recursive = -1;
	
	public $actsAs = array('Containable');

    public $useDbConfig = 'koufu_delivery_system';
    
    public $name = 'Transmittal';

    public $validate = array(

		'tr_uuid' => array(
			
			'unique' => array(
				'rule'    => 'isUnique',
				'message' => 'Delivery receipt should be unique.'
			),

		)
		
	);

	 public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Delivery' => array(
					'className' => 'Delivery.Delivery',
					'foreignKey' => false,
					'conditions' => array('Transmittal.dr_uuid = Delivery.dr_uuid'),
					'dependent' => true
				),

				'DeliveryDetail' => array(
					'className' => 'Delivery.DeliveryDetail',
					'foreignKey' => false,
					'conditions' => array('Delivery.dr_uuid = DeliveryDetail.delivery_uuid'),
					'dependent' => true
				),
				
			)
		),false);

		$this->contain($model);
	}

	
}