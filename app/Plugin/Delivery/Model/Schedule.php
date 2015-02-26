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
				'TruckSchedule' => array(
					'className' => 'Delivery.TruckSchedule',
					'foreignKey' => false,
					'conditions' => 'TruckSchedule.truck_id = Schedule.truck_id'
				),
			)
		),false);

		$this->contain($model);
	}

	public function addSchedule($data,$auth){
		//pr($data);exit();
		$this->create();
		$data['Schedule']['sales_order_id'] = $data['RequestDeliverySchedule']['sales_order_id'];
		$data['Schedule']['schedule'] = $data['RequestDeliverySchedule']['schedule'];
		$data['Schedule']['location'] = $data['RequestDeliverySchedule']['location'];
		$data['Schedule']['quantity'] = $data['RequestDeliverySchedule']['quantity'];
		$data['Schedule']['status'] = 'Pending';
		$data['Schedule']['created_by'] = $auth;
		$data['Schedule']['modified_by'] = $auth;
		$this->save($data);

		return $this->id;
		

	}

	public function updateSchedule($data,$auth){
		pr($data);exit();
		$this->id = $this->find('first',array(
								'conditions' => array(
								'sales_order_id' => $id
									)
								));

		if($this->id){


		}

	}
	public function updateStatus($data,$auth){
		//pr($data);exit();
		$this->id = $this->find('first',array(
								'conditions' => array(
								'sales_order_id' => $data['TruckSchedules']['sales_order_id']
									)
								));
		if ($this->id) {

			    $this->save( array(
			    			'status' =>'Accepted',
		     				'truck_id' =>$data['TruckSchedules']['truckPlateNumber'], 
		     				'quantity' => $data['TruckSchedules']['quantity'],
		     				'schedule' => $data['TruckSchedules']['schedule'],
		    				));

		 }

		return $this->id;
		
		//pr($salesOrderId);exit();

	}
	
}