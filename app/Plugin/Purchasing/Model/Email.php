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

	public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Supplier' => array(
					'className' => 'Purchasing.Supplier',
					'foreignKey' => 'foreign_key',
					'dependent' => true
				),
				'SupplierContactPerson' => array(
					'className' => 'Purchasing.SupplierContactPerson',
					'foreignKey' => 'foreign_key',
					'dependent' => true
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

	public function saveEmail($data = null, $supplierId = null, $auth = null){

		$this->create();
		$data['Email']['created_by'] = $auth;
		$data['Email']['modified_by'] = $auth;
		$data['Email']['foreign_key'] = $supplierId;
	
    	if($this->save($data['Email'])){

            return $this->id;

        } 
		
	}


} ?>