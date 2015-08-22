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

  	public function saveInRecord($receiveddata, $data, $auth){

  		$this->create();

  		$dataHolder['received_orders_id'] = $receiveddata['ReceivedOrder']['id'];
  		$dataHolder['remarks'] = $data['InRecord']['remarks'];
  		$dataHolder['storekeeper_id'] = $data['InRecord']['storekeeper'];
      $dataHolder['status_id'] = 12 ;
      $dataHolder['created_by'] = $auth;
      $dataHolder['modified_by'] = $auth;
  	
  		 		
  		$this->save($dataHolder);

  		return $this->id;

  	}

}