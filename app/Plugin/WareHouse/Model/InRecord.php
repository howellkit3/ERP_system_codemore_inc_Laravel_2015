<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class InRecord extends AppModel {

    public $useDbConfig = 'koufu_warehouse';
    
  	public $name = 'InRecord';

  	public function saveInRecord($data, $auth, $order_id){

  		$this->create();

  		$data['storekeeper_id'] = $data['storekeeper'];
  		$data['created_by'] = $auth;
  		$data['modified_by'] = $auth;
  		$data['status_id'] = 12;
  		 		
  		$this->save($data);

  		return $this->id;

  	}

}