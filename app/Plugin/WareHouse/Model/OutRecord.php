<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class OutRecord extends AppModel {

    public $useDbConfig = 'koufu_warehouse';
    
  	public $name = 'OutRecord';

  	public function saveOutRecord($data, $requestID, $auth){

  	$this->create();

  	
  	$dataHolder['request_id'] = $requestID;
  	$dataHolder['remarks'] = $data['remarks'];
    $dataHolder['created_by'] = $auth;
    $dataHolder['modified_by'] = $auth;
  	

	$this->save($dataHolder);

	return $this->id;

  	}

}