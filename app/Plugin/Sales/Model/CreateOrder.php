<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class CreateOrder extends AppModel {

    public $useDbConfig = 'koufu_sale';
	
	public $recursive = -1;

	public $name = 'CreateOrder';

	public $actsAs = array('Containable');

	public function saveOrder($data, $auth){
		//pr($data);die;

		$this->create();
		$data['CreateOrder']['sales_order_id'] = $data['CreateOrder']['quotationNumber'];
		$data['CreateOrder']['created_by'] = $auth;
		$data['CreateOrder']['modified_by'] = $auth;
		$this->save($data);

		return $this->id;

	}

}