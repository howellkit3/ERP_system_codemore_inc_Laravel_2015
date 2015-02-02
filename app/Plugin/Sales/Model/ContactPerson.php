<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class ContactPerson extends AppModel {

    public $useDbConfig = 'koufu_sale';

	public $recursive = -1;

	 public $name = 'ContactPerson';

	public $actsAs = array('Containable');

	public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Company' => array(
					'className' => 'Sales.Company',
					'foreignKey' => 'company_id',
					'dependent' => true
				),
			),
			'hasMany' => array(
				'Address' => array(
					'className' => 'Sales.Address',
					'foreignKey' => 'foreign_key',
					'dependent' => true,
					'conditions' => "Address.model = 'ContactPerson'"
				),
				'Contact' => array(
					'className' => 'Sales.Contact',
					'foreignKey' => 'foreign_key',
					'dependent' => true,
					'conditions' => "Contact.model = 'ContactPerson'"
				),
				'Email' => array(
					'className' => 'Sales.Email',
					'foreignKey' => 'foreign_key',
					'dependent' => true,
					'conditions' => "Email.model = 'ContactPerson'"
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

	public function beforeSave($options = array())
	{
		$userId = AuthComponent::user('id'); 

		$this->data[$this->name]['created_by'] = $userId;
		$this->data[$this->name]['modified_by'] = $userId;
	}

	public function saveContact($data, $company_id,$auth)
	{
		foreach ($data as $key => $contactPersonData)
		{
			$this->create();
			foreach ($contactPersonData[$this->name] as $key => $contactPersonValue) 
			{
				$contactPersonValue['model'] = "Company";
				$contactPersonValue['company_id'] = $company_id;
				$contactPersonValue['created_by'] = $auth;
				$contactPersonValue['modified_by'] = $auth;	
				
			}
			$this->saveAll($contactPersonValue);
			return $this->id;
		}
		
	}
	
}
