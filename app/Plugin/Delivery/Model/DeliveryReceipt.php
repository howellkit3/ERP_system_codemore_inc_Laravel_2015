<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class DeliveryReceipt extends AppModel {
	public $recursive = -1;
	
	public $actsAs = array('Containable');

    public $useDbConfig = 'koufu_delivery_system';
    
    public $name = 'DeliveryReceipt';

 //    public $validate = array(

	// 	'dr_uuid' => array(
			
	// 		'unique' => array(
	// 			'rule'    => 'isUnique',
	// 			'message' => 'Delivery receipt should be unique.'
	// 		),

	// 	)
		
	// );

	public function bind($model = array('Group')){

		$this->bindModel(array(
			'hasOne' => array(
				'Delivery' => array(
					'className' => 'Delivery.Delivery',
					'foreignKey' => false,
					'conditions' => 'DeliveryReceipt.dr_uuid = Delivery.dr_uuid '
				),
			)
		),false);

		$this->contain($model);
	}

	 

	
}