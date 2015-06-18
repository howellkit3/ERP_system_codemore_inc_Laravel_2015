<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class DeliveryDetail extends AppModel {

    public $useDbConfig = 'koufu_delivery_system';
    public $name = 'DeliveryDetail';

     public $validate = array(

		'delivery_uuid' => array(
			
			'unique' => array(
				'rule'    => 'isUnique',
				'message' => 'Delivery receipt should be unique.'
			),

		)
		
	);
  

  public function saveDeliveryDetail($data = null, $auth = null){

		$this->create();

				$data['DeliveryDetail']['modified_by'] = $auth;
				
		$this->save($data);


	}
	
}