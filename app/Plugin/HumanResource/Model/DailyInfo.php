<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class DailyInfo extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

	public $recursive = -1;

	public $name = 'DailyInfo';

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
				),
				'Address' => array(
					'className' => 'Address',
					'foreignKey' => false,
					'dependent' => true,
					'conditions' => array(
						'Address.model = ContactPerson',
						'Address.foreign_key = ContactPerson.id' 
						)
				)
			)
		),false);

		$this->contain($model);
	}

	public function saveDailyInfo($data) {

		$info = [];

		if (!empty($data)) {

			$info['employee_id'] = $data['employee_id'];
			$info['date'] = $data['date'];
			
			return $this->save($info);
		}
	}


}