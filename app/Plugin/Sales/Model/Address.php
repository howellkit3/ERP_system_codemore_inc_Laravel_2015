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

	public $validate = array(

		'address1' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
			),
		),

	);

	public function saveContact($data, $contact_id)
	{

		foreach ($data as $key => $addressData)
		{
			
			$this->create();
			foreach ($addressData[$this->name] as $key => $addressValue) 
			{
				$addressValue['model'] = "ContactPerson";
				$addressValue['foreign_key'] = $contact_id;	
				
			}
			$this->saveAll($addressValue);
			return $this->id;
			
		}
		
	}

	public function beforeSave($options = array())
	{
		$userId = AuthComponent::user('id'); 

		$this->data[$this->name]['created_by'] = $userId;
		$this->data[$this->name]['modified_by'] = $userId;
	}

	public function deleteAddress($personId = null){

		$addressData = $this->find('all',array(
			     'conditions' => array('model'=> "ContactPerson",
			     'foreign_key' => $personId)
			));

			foreach ($addressData as $key => $value) {

				$this->delete($value['Address']['id']);
			}
	}

	public function saveAddress($data = null, $companyId = null, $auth = null){

		$this->create();
		$data['Address']['created_by'] = $auth;
		$data['Address']['modified_by'] = $auth;
		$data['Address']['foreign_key'] = $companyId;
		
    	if($this->save($data['Address'])){

            return $this->id;

        } 
		
	}
	
}
