<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class ContactPerson extends AppModel {

    public $useDbConfig = 'koufu_sale';

	public $recursive = -1;

	 public $name = 'ContactPerson';

	public $actsAs = array('Containable');

	public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Company' => array(
					'className' => 'Sales.Company',
					'foreignKey' => 'company_id',
					'dependent' => true
				),
			),
			'hasMany' => array(
				'Address' => array(
					'className' => 'Sales.Address',
					'foreignKey' => 'foreign_key',
					'dependent' => true,
					'conditions' => "Address.model = 'ContactPerson'"
				),
				'Contact' => array(
					'className' => 'Sales.Contact',
					'foreignKey' => 'foreign_key',
					'dependent' => true,
					'conditions' => "Contact.model = 'ContactPerson'"
				),
				'Email' => array(
					'className' => 'Sales.Email',
					'foreignKey' => 'foreign_key',
					'dependent' => true,
					'conditions' => "Email.model = 'ContactPerson'"
				),
				'Quotation' => array(
					'className' => 'Sales.Quotation',
					'foreignKey' => false,
					'conditions' => array('Quotation.attention_details = ContactPerson.id'),
					'dependent' => false
				),
			)
		));

		$this->contain($model);
	}
	
	public $validate = array(

		
		// 'firstname' => array(
		// 	'notEmpty' => array(
		// 		'rule' => array('notEmpty'),
		// 		'message' => 'Required fields.',
		// 	),
			// 'alphaNumeric'=> array(
	  //           'rule' => 'alphaNumeric',
	  //           'message'=> 'Please enter a valid name'
	  //       ),
		// ),
		// 'lastname' => array(
		// 	'notEmpty' => array(
		// 		'rule' => array('notEmpty'),
		// 		'message' => 'Required fields.',
		// 	),
			// 'alphaNumeric'=> array(
	  //           'rule' => 'alphaNumeric',
	  //           'message'=> 'Please enter a valid name'
	  //       ),
		// ),	
		// 'position' => array(
		// 	'notEmpty' => array(
		// 		'rule' => array('notEmpty'),
		// 		'message' => 'Required fields.',
		// 	),
		// )	
	
	);

	public function beforeSave($options = array())
	{
		$userId = AuthComponent::user('id'); 

		$this->data[$this->name]['created_by'] = $userId;
		$this->data[$this->name]['modified_by'] = $userId;
	}

	public function afterSave($data,$options = array()) {

		//Cache::delete('companyData');

	}

	public function afterDelete() {

		//Cache::delete('inquiryId');

	}

	public function saveContact($data, $company_id)
	{
	
		foreach ($data as $key => $contactPersonData)
		{

			$this->create();
			if (!empty($contactPersonData['ContactPerson'])) {

			
				foreach ($contactPersonData[$this->name] as $key => $contactPersonValue) 
				{
					
					if(!empty($contactPersonValue['firstname'] ) || !empty($contactPersonValue['lastname'])){
						$contactPersonValue['id'] = !empty($contactPersonData[$this->name][$key]['id']) ? $contactPersonData[$this->name][$key]['id'] : '';
						$contactPersonValue['model'] = "Company";
						$contactPersonValue['company_id'] = $company_id;
					}
					
						
					
				}
			}
			
		}
		$this->saveAll($contactPersonValue);
		return $this->id;
		
	}
	public function saveContactMultiple($data, $company_id)
	{

		$contactPerson = array();

		$this->create();

		if (!empty($data)) {
		
			foreach ($data[$this->name] as $key => $contactPersonValue) 
			{
				
				if (!empty($contactPersonValue['firstname'] ) || !empty($contactPersonValue['lastname'])) {
					
					$contactPersonValue['id'] = !empty($contactPersonValue['id']) ? $contactPersonValue['id'] : '';
					$contactPersonValue['model'] = "Company";
					$contactPersonValue['company_id'] = $company_id;
				
				}

			}
		}


		$this->save($contactPersonValue);
		return $this->id;

	}

	public function saveContactPerson($data = null, $companyId = null, $auth = null){
		
		$this->create();
		$data['ContactPerson']['created_by'] = $auth;
		$data['ContactPerson']['modified_by'] = $auth;
		$data['ContactPerson']['company_id'] = $companyId;
		
    	if($this->save($data['ContactPerson'])){

            return $this->id;

        } 
	}
	
}
