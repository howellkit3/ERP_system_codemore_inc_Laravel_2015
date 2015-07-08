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

	public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Supplier' => array(
					'className' => 'Purchasing.Supplier',
					'foreignKey' => 'foreign_key',
					'dependent' => false
				),
				'SupplierContactPerson' => array(
					'className' => 'Purchasing.SupplierContactPerson',
					'foreignKey' => 'supplier_id',
					'dependent' => false
				)
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

	public function saveAddress($data = null, $supplierId = null, $auth = null){

		$this->create();
		$data['Address']['created_by'] = $auth;
		$data['Address']['modified_by'] = $auth;
		$data['Address']['foreign_key'] = $supplierId;
		
    	if($this->save($data['Address'])){

            return $this->id;

        } 
		
	}

}
