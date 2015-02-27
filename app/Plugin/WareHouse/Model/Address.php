<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class Address extends AppModel {

    public $useDbConfig = 'koufu_ware_house';

    public $name = 'Address';

	public $recursive = -1;

	public $actsAs = array('Containable');

	public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Supplier' => array(
					'className' => 'Sales.Company',
					'foreignKey' => 'foreign_key',
					'dependent' => false
				),
			)
		));

		$this->contain($model);
	}

	public $validate = array(

		'address1' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
			),
		),
		'state_province' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
			),
		),
		'city' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
			),
		),
		'country' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
			),
		),
		'zip_code' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
			),
			'numeric'=> array(
	            'rule' => 'numeric',
	            'message'=> 'Zip Code should be numeric'
	        ),
		),

	);



}
