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
				'ContactPerson' => array(
					'className' => 'Sales.ContactPerson',
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
				),
				'Address' => array(
					'className' => 'Sales.Address',
					'foreignKey' => 'foreign_key',
					'dependent' => false,
					'conditions' => "model = 'Company'",
					'fields' => '',
					'order' => '',
					'limit' => '',
					'offset' => '',
					'exclusive' => '',
					'finderQuery' => '',
					'counterQuery' => ''
				),
				'Contact' => array(
					'className' => 'Contact',
					'foreignKey' => 'foreign_key',
					'dependent' => false,
					'conditions' => '',
					'fields' => '',
					'order' => '',
					'limit' => '',
					'offset' => '',
					'exclusive' => '',
					'finderQuery' => '',
					'counterQuery' => ''
				),
				'Email' => array(
					'className' => 'Email',
					'foreignKey' => 'foreign_key',
					'dependent' => false,
					'conditions' => '',
					'fields' => '',
					'order' => '',
					'limit' => '',
					'offset' => '',
					'exclusive' => '',
					'finderQuery' => '',
					'counterQuery' => ''
				),
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
		'street' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'company_email' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'company_telephone' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'company_cellphone' => array(
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

public function formatData($data = null,$auth= null){

	//pr($data);exit();
	foreach ($data['Address'] as $key => $value) {
		$data['Address'][$key] = $value;
		$data['Address'][$key]['model'] = 'Company';
		$data['Address'][$key]['created_by'] =$auth;
		$data['Address'][$key]['modified_by'] =$auth;
	}

	foreach ($data['Contact'] as $contactkey => $value) {
		$data['Contact'][$contactkey] = $value;
		$data['Contact'][$contactkey]['model'] = 'Company';
		$data['Contact'][$contactkey]['created_by'] =$auth;
		$data['Contact'][$contactkey]['modified_by'] =$auth;
	}



	return $data;
}
	
}
