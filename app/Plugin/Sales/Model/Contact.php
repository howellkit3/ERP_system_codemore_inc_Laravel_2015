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

	public $validate = array(

		'number' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
			),
			'numeric'=> array(
	            'rule' => 'numeric',
	            'message'=> 'It should be numeric'
	        ),
		),
	
	);
	
	public function saveContact($data, $contact_id)

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
			return $this->id;

		}
		$this->id;
		
	}

	public function beforeSave($options = array())
	{
		$userId = AuthComponent::user('id'); 
		
		$this->data[$this->name]['created_by'] = $userId;
		$this->data[$this->name]['modified_by'] = $userId;
	}

	public function deleteContact($personId = null){

		$contactData = $this->find('all',array(
			     'conditions' => array('model'=> "ContactPerson",
			     'foreign_key' => $personId
			)));

		foreach ($contactData as $key => $value) {

			$this->delete($value['Contact']['id']);
		}
	}

	public function saveNumber($data = null, $companyId = null, $auth = null){

		$this->create();
		$data['Contact']['created_by'] = $auth;
		$data['Contact']['modified_by'] = $auth;
		$data['Contact']['foreign_key'] = $companyId;
		
    	if($this->save($data['Contact'])){

            return $this->id;

        } 
		
	}
	
}
