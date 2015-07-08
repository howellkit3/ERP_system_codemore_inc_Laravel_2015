<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class RequestStock extends AppModel {

    public $useDbConfig = 'koufu_warehouse';
    
  	public $name = 'RequestStock';

	public $recursive = -1;

	public $actsAs = array('Containable');

	public $validate = array(
		'description' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
			),
		),

	);
	
	public function addrequeststock($data, $auth){
		$data['created_by'] = $auth;
		$data['modified_by'] = $auth; 
		$data['po'] = rand(0,999).'-'.time();
		$this->save($data);
		return $this->id;

	}
	public function updateSave($data){

		$this->save($data);
	}

}