<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Truck extends AppModel {
	public $recursive = -1;
	
	public $actsAs = array('Containable');

    public $useDbConfig = 'koufu_delivery_system';
    public $name = 'Truck';
    
	// public $validate = array(
 //        'description' => array(
	// 		'notEmpty' => array(
	// 			'rule' => array('notEmpty'),
	// 			'message'=>'Select Company',
	// 		),
	// 	),
		
	// 	'schedule_from' => array(
	// 		'notEmpty' => array(
	// 			'rule' => array('notEmpty'),
	// 			'message' => 'Required fields.',
	// 		),
	// 	),

	// 	'schedule_to' => array(
	// 		'notEmpty' => array(
	// 			'rule' => array('notEmpty'),
	// 			'message' => 'Required fields.',
	// 		),
	// 	),

 //    );

    public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Delivery' => array(
					'className' => 'Delivery.Delivery',
					'foreignKey' => 'truck_id',
					'dependent' => true
				),
				
			),
			'hasMany' => array(
				'TruckAvailability' => array(
					'className' => 'Delivery.TruckAvailability',
					'foreignKey' => 'truck_id',
					'dependent' => true
				),
				
			),
		),false);

		$this->contain($model);
	}

	// public function addSchedule($data,$auth){
	// 	$this->create();
		 
	// 	$data['Schedule']['created_by'] = $auth;
	// 	$data['Schedule']['modified_by'] = $auth;
	// 	$this->save($data);

	// 	return $this->id;
		

	// }
	
}