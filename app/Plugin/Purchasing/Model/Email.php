<?php
App::uses('AppModel', 'Model');
//namespace Sales\Model\Entity;
/**
 * Supllier Model
 *
 */
class Email extends AppModel {

    public $useDbConfig = 'koufu_purchasing';

    public $name = 'Email';

	public $recursive = -1;

	public $actsAs = array('Containable');

	public function bind($model = array('Supplier')){

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

	public function beforeSave($options = array())
	{
		$userId = AuthComponent::user('id'); 

		$this->data[$this->name]['created_by'] = $userId;
		$this->data[$this->name]['modified_by'] = $userId;
	}

	public function saveContact($data, $contact_id)
	{
		foreach ($data as $key => $emailData)
		{
			$this->create();
			foreach ($emailData[$this->name] as $key => $emailValue) 
			{
				$emailValue['model'] = "ContactPerson";
				$emailValue['foreign_key'] = $contact_id;	
				
			}
			$this->saveAll($emailValue);
		}
		
	}


} ?>