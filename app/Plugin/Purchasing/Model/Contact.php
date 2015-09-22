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
				'SupplierContactPerson' => array(
					'className' => 'Purchasing.SupplierContactPerson',
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
					if (!empty($contactValue['firstname'])) {

						$contactValue['model'] = "ContactPerson";
						$contactValue['foreign_key'] = $contact_id;	
					}
				
			}
			//pr($contactValue);
			
		}

		$this->saveAll($contactValue);
		
	}

	public function beforeSave($options = array())
	{
		$userId = AuthComponent::user('id'); 
		
		$this->data[$this->name]['created_by'] = $userId;
		$this->data[$this->name]['modified_by'] = $userId;
	}

	public function saveNumber($data = null, $supplierId = null, $auth = null){

		$this->create();
		$data['Contact']['created_by'] = $auth;
		$data['Contact']['modified_by'] = $auth;
		$data['Contact']['foreign_key'] = $supplierId;
		
    	if($this->save($data['Contact'])){

            return $this->id;

        } 
		
	}
	
}
