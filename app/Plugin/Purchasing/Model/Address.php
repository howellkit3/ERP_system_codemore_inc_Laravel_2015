<?php
App::uses('AppModel', 'Model');
//namespace Sales\Model\Entity;
/**
 * Supllier Model
 *
 */
class Address extends AppModel {

    public $useDbConfig = 'koufu_purchasing';

    public $name = 'Address';

	public $recursive = -1;

	public $actsAs = array('Containable');

	public function bind($model = array('Product')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Supplier' => array(
					'className' => 'Purchasing.Supplier',
					'foreignKey' => 'foreign_key',
					'dependent' => true
				),
			)
		));

		$this->contain($model);
	}

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
			
		}
		
	}

	public function beforeSave($options = array())
	{
		$userId = AuthComponent::user('id'); 

		$this->data[$this->name]['created_by'] = $userId;
		$this->data[$this->name]['modified_by'] = $userId;
	}

}
