<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class Company extends AppModel {

	//public $useTable = 'companies'; // name of the database table 
    public $useDbConfig = 'koufu_sale';

	public $recursive = -1;
	
	public $actsAs = array('Containable');

	public function bind($model = array('Group')){

		$this->bindModel(array(
			'hasMany' => array(
				'Customer' => array(
					'className' => 'Customer',
					'foreignKey' => 'company_id',
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
	
	public $validate = array(

		'company_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'company_address' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'state_province' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'company_contact' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'firstname' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),	
		'lastname' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),	
		'email' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'contact_number' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'address' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
	
	);
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
	// 	// pr($data);exit();
	// 	// $customerInfo = ClassRegistry::init('Sale');
	// 	// // $passReal = $data['User']['password'];
	// 	// $customerInfo->save($data); 
	// 	// // return $this->saveField('password_real', $passReal);
	// 	// return true;
	// }
	
}
