<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class Contact extends AppModel {

    public $useDbConfig = 'koufu_sale';

    public $name = 'Contact';

	public $recursive = -1;

	public $actsAs = array('Containable');

	public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Company' => array(
					'className' => 'Company',
					'foreignKey' => 'foreign_key',
					'dependent' => false
				),
				'ContactPerson' => array(
					'className' => 'ContactPerson',
					'foreignKey' => 'foreign_key',
					'dependent' => false
				)
			)
		));

		$this->contain($model);
	}
	
	public function saveContact($data, $contact_id)
	{
		
		$this->create();

		foreach ($data[$this->name] as $key => $contactData) {

			$data[$this->name][$key]['model'] = "ContactPerson";
			$data[$this->name][$key]['foreign_key'] = $contact_id;

		}
		
		$this->saveAll($data[$this->name]);
		
	}

	public function beforeSave($options = array())
	{
		$userId = AuthComponent::user('id'); 

		$this->data[$this->name]['created_by'] = $userId;
		$this->data[$this->name]['modified_by'] = $userId;
	}
	
}
