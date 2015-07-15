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

    public $useDbConfig = 'koufu_human_resource';

	public $recursive = -1;

	public $name = 'ContactPerson';

	public $actsAs = array('Containable');
    
    public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Contact' => array(
					'className' => 'Contact',
					'foreignKey' => false,
					'dependent' => true,
					'conditions' => array(
						'Contact.model = ContactPerson',
						'Contact.foreign_key = ContactPerson.id' 
						)
				),
				'Email' => array(
					'className' => 'Email',
					'foreignKey' => false,
					'dependent' => true,
					'conditions' => array(
						'Email.model = ContactPerson',
						'Email.foreign_key = ContactPerson.id' 
						)
				)
			)
		),false);

		$this->contain($model);
	}
	
	public function saveContact($data, $employee_id = null,$auth_id = null)
	{	

		$contact_person = [];		

		if (!empty($data)){
	
			$contact_person['employee_id'] = $employee_id;
			$contact_person['created_by'] = $auth_id;
			$contact_person['modified_by'] = $auth_id;

			$this->save($contact_person);

			$this->bind(array('Contact','Email'));

			if (!empty($data['Contact'])) {
				
				$contacts = [];

				foreach ($data['Contact'] as $key => $value) {
					$contacts[$key] = $value;
					$contacts[$key]['model'] = 'ContactPerson';
					$contacts[$key]['foreign_key'] = $this->id;
					$contacts[$key]['created_by'] = $auth_id;
					$contacts[$key]['modified_by'] = $auth_id;
			
				}

				$this->Contact->saveAll($contacts);	

			}

			if (!empty($data['Email'])) {
				
				$contacts = [];

				foreach ($data['Contact'] as $key => $value) {
					$contacts[$key] = $value;
					$contacts[$key]['model'] = 'ContactPerson';
					$contacts[$key]['foreign_key'] = $this->id;
					$contacts[$key]['created_by'] = $auth_id;
					$contacts[$key]['modified_by'] = $auth_id;
			
				}

				$this->Contact->saveAll($contacts);	

			}

		}

		exit();
		
		return $this->id;
		
	}

	
	
}
