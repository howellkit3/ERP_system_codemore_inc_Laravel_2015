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

    public $useDbConfig = 'koufu_sale';

    public $name = 'Address';

	public $recursive = -1;

	public $actsAs = array('Containable');

	public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Company' => array(
					'className' => 'Sales.Company',
					'foreignKey' => 'foreign_key',
					'dependent' => false
				),
				'ContactPerson' => array(
					'className' => 'Sales.ContactPerson',
					'foreignKey' => 'company_id',
					'dependent' => false
				)
			)
		));

		$this->contain($model);
	}

	public function saveContact($data, $contact_id)
	{
		foreach ($data as $key => $addressData)
		{
			$this->create();
			foreach ($addressData as $key => $addressIndex) 
			{
				
				$addressData[$this->name][$key]['model'] = "ContactPerson";
				$addressData[$this->name][$key]['foreign_key'] = $contact_id;

			}
			$this->saveAll($addressData[$this->name]);
		}
		
	}

	public function beforeSave($options = array())
	{
		$userId = AuthComponent::user('id'); 

		$this->data[$this->name]['created_by'] = $userId;
		$this->data[$this->name]['modified_by'] = $userId;
	}
	
}
