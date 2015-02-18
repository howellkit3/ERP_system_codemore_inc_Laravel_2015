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

    public $useDbConfig = 'koufu_sale';

	public $recursive = -1;
	
	public $actsAs = array('Containable');

	public function bind($model = array('Group')){

		$this->bindModel(array(
			'hasMany' => array(
				'ContactPerson' => array(
					'className' => 'Sales.ContactPerson',
					'foreignKey' => 'company_id',
					'dependent' => true
				),
				'Address' => array(
					'className' => 'Sales.Address',
					'foreignKey' => 'foreign_key',
					'conditions' => "model = 'Company'",
					'dependent' => true
				),
				'Contact' => array(
					'className' => 'Sales.Contact',
					'foreignKey' => 'foreign_key',
					'conditions' => "model = 'Company'",
					'dependent' => true
				),
				'Email' => array(
					'className' => 'Sales.Email',
					'foreignKey' => 'foreign_key',
					'conditions' => "model = 'Company'",
					'dependent' => true
				),
				'Inquiry' => array(
					'className' => 'Sales.Inquiry',
					'foreignKey' => 'company_id',
					'conditions' => '',
					'dependent' => true
				),
				'Quotation' => array(
					'className' => 'Sales.Quotation',
					'foreignKey' => 'company_id',
					'conditions' => '',
					'dependent' => true
				)
			)
		),false);

		$this->contain($model);
	}
	
	public $validate = array(

		'id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message'=>'Select Company',
			),
		),
		
		'company_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
			),
		),

		'description' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
			),
		),

		'tin' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
			),
			'numeric'=> array(
	            'rule' => 'numeric',
	            'message'=> 'Zip Code should be numeric'
	        ),
		),
		'payment_term' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
			),
		),

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
		// 'zip_code' => array(
		// 	'rule' => 'numeric',
		// 	'allowEmpty' => false, //validate only if not empty
		// 	'message'=>'Zip Code should be numeric',
		// ),

		'first_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
			),
			'alphaNumeric'=> array(
	            'rule' => 'alphaNumeric',
	            'message'=> 'Please enter a valid name'
	        ),
		),
		'lastname' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
			),
			'alphaNumeric'=> array(
	            'rule' => 'alphaNumeric',
	            'message'=> 'Please enter a valid name'
	        ),
		),	
		'email' => array(
			'email' => array(
				'rule' => array('email'),
			),
		),
		'number' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
			),
			'numeric'=> array(
	            'rule' => 'numeric',
	            'message'=> 'It should be numeric'
	        ),
		),
		// 'number' => array(
		// 	'rule' => 'numeric',
		// 	'allowEmpty' => true, //validate only if not empty
		// 	'message'=>'Zip Code should be numeric',
		// ),
	
	);

	public function formatData($data = null,$auth= null){

		foreach ($data['Address'] as $key => $value) {
			$data['Address'][$key] = $value;
			$data['Address'][$key]['model'] = 'Company';
			$data['Address'][$key]['created_by'] =$auth;
			$data['Address'][$key]['modified_by'] =$auth;
		}

		foreach ($data['Contact'] as $key => $value) {
			$data['Contact'][$key] = $value;
			$data['Contact'][$key]['model'] = 'Company';
			$data['Contact'][$key]['created_by'] =$auth;
			$data['Contact'][$key]['modified_by'] =$auth;
		}

		foreach ($data['Email'] as $key => $value) {
			$data['Email'][$key] = $value;
			$data['Email'][$key]['model'] = 'Company';
			$data['Email'][$key]['created_by'] =$auth;
			$data['Email'][$key]['modified_by'] =$auth;
		}


		return $data;
	}

	public function beforeSave($options = array())
	{
		$userId = AuthComponent::user('id'); 

		$this->data[$this->name]['created_by'] = $userId;
		$this->data[$this->name]['modified_by'] = $userId;
	}
	
	
}
