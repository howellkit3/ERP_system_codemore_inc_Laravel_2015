<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class SupplierContactPerson extends AppModel {

    public $useDbConfig = 'koufu_purchasing';

	public $recursive = -1;

	 public $name = 'SupplierContactPerson';

	public $actsAs = array('Containable');

	public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Supplier' => array(
					'className' => 'Purchasing.Supplier',
					'foreignKey' => 'supplier_id',
					'dependent' => true
				),
			),
			'hasMany' => array(
				'Address' => array(
					'className' => 'Purchasing.Address',
					'foreignKey' => 'foreign_key',
					'dependent' => true,
					'conditions' => "Address.model = 'ContactPerson'"
				),
				'Contact' => array(
					'className' => 'Purchasing.Contact',
					'foreignKey' => 'foreign_key',
					'dependent' => true,
					'conditions' => "Contact.model = 'ContactPerson'"
				),
				'Email' => array(
					'className' => 'Purchasing.Email',
					'foreignKey' => 'foreign_key',
					'dependent' => true,
					'conditions' => "Email.model = 'ContactPerson'"
				),
				
			)
		));

		$this->contain($model);
	}
	
	public $validate = array(
		
		'firstname' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
			),
		),
		'lastname' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
			),
		),	
		'position' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
			),
		)	
	
	);

	public function beforeSave($options = array())
	{
		$userId = AuthComponent::user('id'); 

		$this->data[$this->name]['created_by'] = $userId;
		$this->data[$this->name]['modified_by'] = $userId;
	}

	
	public function saveContact($data, $supplier_id,$auth) {

		foreach ($data as $key => $contactPersonData)
		{
			foreach ($contactPersonData as $key => $contactPersonValue) 
			{
				$contactPersonValue[$key]['model'] = "Supplier";
				$contactPersonValue[$key]['supplier_id'] = $supplier_id;
				$contactPersonValue[$key]['created_by'] = $auth;
				$contactPersonValue[$key]['modified_by'] = $auth;	
						
				$this->save($contactPersonValue);
				
			}

			return $this->id;
		}
		
	}

	public function saveContactPerson($data = null, $supplierId = null, $auth = null){
		
		$this->create();
		$data['SupplierContactPerson']['created_by'] = $auth;
		$data['SupplierContactPerson']['modified_by'] = $auth;
		$data['SupplierContactPerson']['supplier_id'] = $supplierId;
		
    	if($this->save($data['SupplierContactPerson'])){

            return $this->id;

        } 
	}
	
}
