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
					'dependent' => false
				),
				'Contactperson' => array(
					'className' => 'Company',
					'foreignKey' => 'Contactperson',
					'dependent' => false
				)
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
		
		$this->create();

		foreach ($data[$this->name] as $key => $emailData) {

			$data[$this->name][$key]['model'] = "ContactPerson";
			$data[$this->name][$key]['foreign_key'] = $contact_id;

		}
		
		$this->saveAll($data[$this->name]);
		
	}
	
}
