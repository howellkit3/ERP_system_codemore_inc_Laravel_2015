<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class DeliveryDetail extends AppModel {

	public $recursive = -1;
	
	public $actsAs = array('Containable');

    public $useDbConfig = 'koufu_delivery_system';

    public $name = 'DeliveryDetail';

 //     public $validate = array(

	// 	'delivery_uuid' => array(
			
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
					'conditions' => 'Delivery.dr_uuid = DeliveryDetail.delivery_uuid'
				)
			)
		),false);

		$this->contain($model);
	}

  public function saveDeliveryDetail($data = null, $auth = null,$novalidate = null){

		$this->create();

		$data['DeliveryDetail']['modified_by'] = $auth;
				

		if ($novalidate) {

			$this->validate = array();
		}

		if ($this->save($data)) {

		} else {

			pr($this->validationErrors);
		}



	}
	
}