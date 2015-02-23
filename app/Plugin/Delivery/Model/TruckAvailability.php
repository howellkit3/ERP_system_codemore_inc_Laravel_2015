<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class TruckAvailability extends AppModel {
	public $recursive = -1;
	
	public $actsAs = array('Containable');

    public $useDbConfig = 'koufu_delivery_system';
    public $name = 'TruckAvailability';
    
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
				'Truck' => array(
					'className' => 'Delivery.Truck',
					'foreignKey' => 'truck_id',
					'dependent' => true
				),
				
			)
		),false);

		$this->contain($model);
	}

	public function addSchedule($data,$auth){
		//pr($data);exit();
		$this->create();
		$data['TruckAvailability']['truck_id'] = $data['TruckAvailabilities']['truckPlateNumber'];
		$data['TruckAvailability']['sales_order_id'] = $data['TruckAvailabilities']['sales_order_id'];
		$data['TruckAvailability']['location'] = $data['TruckAvailabilities']['location'];
		$data['TruckAvailability']['date'] = $data['TruckAvailabilities']['schedule'];
		$data['TruckAvailability']['time_from'] = $data['TruckAvailabilities']['timeFrom'];
		$data['TruckAvailability']['time_to'] = $data['TruckAvailabilities']['timeTo'];
		$data['TruckAvailability']['created_by'] = $auth;
		$data['TruckAvailability']['modified_by'] = $auth;
		$this->save($data);

		return $this->id;
		

	}
	
}