<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class DeliveryDetail extends AppModel {

    public $useDbConfig = 'koufu_delivery_system';
    public $name = 'DeliveryDetail';
  

  public function saveDeliveryDetail($data = null, $auth = null){

		$this->create();

				$data['DeliveryDetail']['modified_by'] = $auth;
				
		$this->save($data);


	}
	
}