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

	public $useTable = 'customers'; // name of the database table 
    public $useDbConfig = 'koufu_sale';

	public $recursive = -1;

	public $actsAs = array('Containable');


	public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Company' => array(
					'className' => 'Company',
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
	
}
