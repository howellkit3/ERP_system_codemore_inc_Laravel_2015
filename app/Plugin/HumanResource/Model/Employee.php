<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Employee extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Employee';

    public $actsAs = array('Containable');

	public $virtualFields = array(
		'full_name' => 'CONCAT_WS(" ",Employee.last_name , Employee.middle_name , Employee.first_name  )'
	);
    
    public function bind($model = array('Group')){

		$this->bindModel(array(
			'hasOne' => array(
				'EmployeeAdditionalInformation' => array(
					'className' => 'EmployeeAdditionalInformation',
					'foreignKey' => 'employee_id',
					'dependent' => true
				),
				'ContactPerson' =>  array(
					'className' => 'ContactPerson',
					'foreignKey' => 'employee_id',
					'conditions' => '',
					'dependent' => true
				),

				'ContactPersonAddress' =>  array(
					'className' => 'Address',
					'foreignKey' => false,
					'conditions' => array('ContactPersonAddress.foreign_key = ContactPerson.id',
										'ContactPersonAddress.model' => 'ContactPerson'),
					'dependent' => true
				),
				'ContactPersonNumber' =>  array(
					'className' => 'Contact',
					'foreignKey' => false,
					'conditions' => array('ContactPersonNumber.foreign_key = ContactPerson.id',
						'ContactPersonNumber.model' => 'ContactPerson'),
					'dependent' => true
				),
				'ContactPersonEmail' => array(
					'className' => 'Email',
					'foreignKey' => false,
					'conditions' => array('ContactPersonEmail.foreign_key = ContactPerson.id',
						'ContactPersonEmail.model' => 'ContactPerson'),
					'dependent' => true
				),
			
			),
			'belongsTo' => array(
				'Position' => array(
					'className' => 'Position',
					'foreignKey' => 'position_id',
					'conditions' => '',
					)	
			),
			'hasMany' => array(
				'Email' => array(
					'className' => 'Email',
					'foreignKey' => 'foreign_key',
					'conditions' => array('Email.model' => 'Employee'),
					'dependent' => true
				),
				'GovernmentRecord' =>  array(
					'className' => 'GovernmentRecord',
					'foreignKey' => 'employee_id',
					'conditions' => '',
					'dependent' => true
				),
				'Address' =>  array(
					'className' => 'Address',
					'foreignKey' => 'foreign_key',
					'conditions' => array('Address.model' => 'Employee'),
					'dependent' => true
				),
				'Contact' =>  array(
					'className' => 'Contact',
					'foreignKey' => 'foreign_key',
					'conditions' => array('Contact.model' => 'Employee'),
					'dependent' => true
				),
			)
		),false);

		$this->contain($model);
	}

	public function getList($conditions = array()) {

		return $this->find('list',array(
				'conditions' => array(),
				'group' => array('Employee.id'),
				'order' => array('Employee.last_name ASC','Employee.first_name ASC'),
				'fields' => array('Employee.id','Employee.full_name')
			));
	}

}