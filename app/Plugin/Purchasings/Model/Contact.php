<?php
App::uses('AppModel', 'Model');
/**
 * Contact Model
 *
 */
class Contact extends AppModel {

    public $useDbConfig = 'koufu_purchasing';

    public $name = 'Contact';

	public $recursive = -1;

	public $actsAs = array('Containable');

	public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Supplier' => array(
					'className' => 'Supplier',
					'foreignKey' => 'foreign_key',
					'dependent' => true
				),
				'ContactPerson' => array(
					'className' => 'ContactPerson',
					'foreignKey' => 'foreign_key',
					'dependent' => true
				)
			)
		));

		$this->contain($model);
	}

	
	public function saveContact($data = null , $contact_id = null)
	{
		foreach ($data as $key => $contactData)
		{
			$this->create();
			foreach ($contactData[$this->name] as $key => $contactValue) 
			{
				$contactValue['model'] = "ContactPerson";
				$contactValue['foreign_key'] = $contact_id;	
				
			}
			$this->saveAll($contactValue);
		}
		
	}

	public function beforeSave($options = array())
	{
		$userId = AuthComponent::user('id'); 
		
		$this->data[$this->name]['created_by'] = $userId;
		$this->data[$this->name]['modified_by'] = $userId;
	}
	
}
