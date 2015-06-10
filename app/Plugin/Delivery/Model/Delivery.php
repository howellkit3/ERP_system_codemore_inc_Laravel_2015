<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Delivery extends AppModel {
	public $recursive = -1;
	
	public $actsAs = array('Containable');

    public $useDbConfig = 'koufu_delivery_system';
    
    public $name = 'Delivery';

    public $validate = array(

		'dr_uuid' => array(
			
			 'Numeric' => array(
                'rule' => 'Numeric',
                'required' => true,
                'message' => 'Delivery Receipt should be numbers only'
            )				
		)
	);

    
	public function saveDelivery($data = null, $auth = null){

		$this->create();

						
				$data['Delivery']['created_by'] = $auth;
				$data['Delivery']['modified_by'] = $auth;
				
		$this->save($data);


		// $this->create();
		// $data['Delivery']['sales_order_id'] = $data['Delivery']['sales_order_id'];
		// $data['Delivery']['delivery_details_id'] = $deliveryId;
		// if($deliveryId == "1"){
		// 	$data['Delivery']['description'] = $data['Delivery']['delivered_date'];
			
		// }
		// else if($deliveryId == "2"){
		// 	$data['Delivery']['description'] = $data['Delivery']['del_quantity'];
		// }
		// else if($deliveryId == "3"){
		// 	$data['Delivery']['description'] = $data['Delivery']['qty_accepted'];
		// }
		// else if($deliveryId == "4"){
		// 	$data['Delivery']['description'] = $data['Delivery']['qty_rejected'];
		// }
		// $data['Delivery']['status'] = $status;
		// $data['Delivery']['created_by'] = $auth;
		// $data['Delivery']['modified_by'] = $auth;
		// $this->save($data);

		// return $this->id;

	}

	public function bindDelivery() {
		$this->bindModel(array(
			'hasOne' => array(
				'DeliveryDetail' => array(
					'className' => 'Delivery.DeliveryDetail',
					'foreignKey' => false,
					'conditions' => 'Delivery.dr_uuid = DeliveryDetail.delivery_uuid'
				),		
			)
		));
		$this->recursive = 1;
		//$this->contain($giveMeTheTableRelationship);
	}

	// public function bind($model = array('Group')){

	// 	$this->bindModel(array(
			
	// 		'hasMany' => array(
	// 			'DeliveryDetail' => array(
	// 				'className' => 'Delivery.DeliveryDetail',
	// 				'foreignKey' => false,
	//  				'conditions' => 'DeliveryDetail.delivery_uuid = Delivery.dr_uuid ' 
	// 			),
				
	// 		),
	// 	),false);

	// 	$this->contain($model);
	// }

	
}