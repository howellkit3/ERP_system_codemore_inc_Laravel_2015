<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Schedule extends AppModel {
	public $recursive = -1;
	
	public $actsAs = array('Containable');

    public $useDbConfig = 'koufu_delivery_system';
    public $name = 'Schedule';
    
	public $validate = array(
        'description' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message'=>'Select Company',
			),
		),
		
		'schedule_from' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
			),
		),

		'schedule_to' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
			),
		),

    );

    public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Truck' => array(
					'className' => 'Delivery.Truck',
					'foreignKey' => 'truck_id',
					'dependent' => true
				),
				'TruckAvailability' => array(
					'className' => 'Delivery.TruckAvailability',
					'foreignKey' => false,
					'conditions' => 'TruckAvailability.truck_id = Truck.id'
				),
			)
		),false);

		$this->contain($model);
	}

	public function addSchedule($data,$auth){
		// pr($data);exit();
		$this->create();
		$data['Schedule']['status'] = 'Pending';
		$data['Schedule']['created_by'] = $auth;
		$data['Schedule']['modified_by'] = $auth;
		$this->save($data);

		return $this->id;
		

	}
	public function updateStatus($id,$action){
		//pr($id);exit();
		$this->id = $this->find('first',array(
									'conditions' => array(
														'sales_order_id' => $id
														)
									));
		//$salesOrderId = $scheduleQuery['Schedule']['sales_order_id'];
		if ($this->id) {
		    $this->saveField('status', $action);

		}

		return $this->id;
		
		//pr($salesOrderId);exit();

	}
	
}