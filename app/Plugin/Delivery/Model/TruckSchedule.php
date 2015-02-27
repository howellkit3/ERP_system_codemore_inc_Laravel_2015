<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class TruckSchedule extends AppModel {
	public $recursive = -1;
	
	public $actsAs = array('Containable');

    public $useDbConfig = 'koufu_delivery_system';
    public $name = 'TruckSchedule';
    
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

	public function addTruckSchedule($data,$auth){
		//pr($data);exit();
		$this->create();
		$data['TruckSchedule']['truck_id'] = $data['TruckSchedules']['truckPlateNumber'];
		$data['TruckSchedule']['sales_order_id'] = $data['TruckSchedules']['sales_order_id'];
		$data['TruckSchedule']['location'] = $data['TruckSchedules']['location'];
		$data['TruckSchedule']['date'] = $data['TruckSchedules']['schedule'];
		$data['TruckSchedule']['time_from'] = $data['TruckSchedules']['timeFrom'];
		$data['TruckSchedule']['time_to'] = $data['TruckSchedules']['timeTo'];
		$data['TruckSchedule']['created_by'] = $auth;
		$data['TruckSchedule']['modified_by'] = $auth;
		$this->save($data);

		return $this->id;
		

	}
	
}