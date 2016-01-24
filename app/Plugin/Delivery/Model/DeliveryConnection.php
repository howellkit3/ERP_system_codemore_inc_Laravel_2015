<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class DeliveryConnection extends AppModel {

    public $useDbConfig = 'koufu_delivery_system';
    public $name = 'DeliveryConnection';

    public $useTable = 'delivery_connection';

 //     public $validate = array(

	// 	'delivery_uuid' => array(
			
	// 		'unique' => array(
	// 			'rule'    => 'isUnique',
	// 			'message' => 'Delivery receipt should be unique.'
	// 		),

	// 	)
		
	// );

	public function bindDeliveryById() {

		$this->bindModel(array(
			'hasOne' => array(
				'DeliveryDetail' => array(
					'className' => 'Delivery.DeliveryDetail',
					'foreignKey' => false,
					'conditions' => 'DeliveryConnection.delivery_details_id = DeliveryDetail.id'
				),
				'Delivery' => array(
					'className' => 'Delivery.Delivery',
					'foreignKey' => false,
					'conditions' => array('Delivery.id = DeliveryConnection.delivery_id')
				),		
				'DeliveryReceipt' => array(
					'className' => 'Delivery.DeliveryReceipt',
					'foreignKey' => false,
					'conditions' => array('DeliveryConnection.delivery_receipt_id' => 'DeliveryReceipt.id')
				),
			
			),
			// 'hasMany' => array(
			// 	'DeliveryReceiptItem' => array(
			// 		'className' => 'Delivery.DeliveryReceipt',
			// 		'foreignKey' => false,
			// 		//'conditions' => array('DeliveryReceiptItem.dr_uuid' => 't3')
			// 	)	
			// )
		));
		$this->recursive = 1;

	}
  

  public function saveDetail($data = null, $auth = null,$novalidate = null){

		$this->create();

		$data['DeliveryConnection']['modified_by'] = $auth;
		
		$return;				

		if ($novalidate) {

			$this->validate = array();
		}

		if ($this->save($data)) {

			$return = true;
		} else {

			pr($this->validationErrors);
		}

		return $return;


	}
	
}