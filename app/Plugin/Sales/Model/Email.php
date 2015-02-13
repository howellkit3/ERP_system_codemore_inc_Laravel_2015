<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class Email extends AppModel {

    public $useDbConfig = 'koufu_sale';

    public $name = 'Email';

	public $recursive = -1;

	public $actsAs = array('Containable');

	public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Company' => array(
					'className' => 'Company',
					'foreignKey' => 'foreign_key',
					'dependent' => true
				),
				'Contactperson' => array(
					'className' => 'Company',
					'foreignKey' => 'Contactperson',
					'dependent' => true
				)
			)
		));

		$this->contain($model);
	}

	public $validate = array(

		'email' => array(
			'email' => array(
				'rule' => array('email'),
			),
		),
	
	);

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

	public function deleteEmail($personId = null){

		$emailData = $this->find('all',array(
			     'conditions' => array('model'=> "ContactPerson",
			     'foreign_key' => $personId)
			));

		foreach ($emailData as $key => $value) {

			$this->delete($value['Email']['id']);
		}
	}
	
}
