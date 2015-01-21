<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class Customer extends AppModel {

	public $useTable = 'companies'; // name of the database table 
    public $useDbConfig = 'koufu_sale';

	public $recursive = -1;

	public $actsAs = array('Containable');


	public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Company' => array(
					'className' => 'Company',
					'foreignKey' => 'customer_id',
					'dependent' => false,
					'conditions' => '',
					'fields' => '',
					'order' => '',
					'limit' => '',
					'offset' => '',
					'exclusive' => '',
					'finderQuery' => '',
					'counterQuery' => ''
				)
			)
		));

		$this->contain($model);
	}
	// public function beforeSave($options = array()) {
	//     // if (isset($this->data[$this->alias]['password'])) {
	//     //     $passwordHasher = new SimplePasswordHasher();
	//     //     $this->data[$this->alias]['password'] = $passwordHasher->hash(
	//     //         $this->data[$this->alias]['password']
	//     //     );
	//     // }

	//     // return true;
	// }
	// public function CustomerAction($data = null) {
	// 	pr($data);exit();
	// 	$customerInfo = ClassRegistry::init('Sale');
	// 	// $passReal = $data['User']['password'];
	// 	$customerInfo->save($data); 
	// 	// return $this->saveField('password_real', $passReal);
	// 	return true;
	// }
	
}
