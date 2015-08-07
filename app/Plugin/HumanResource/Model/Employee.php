<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Employee extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Employee';

    public $actsAs = array('Containable');

	public $virtualFields = array(
		'full_name' => 'CONCAT_WS(" ",Employee.last_name , Employee.middle_name , Employee.first_name  )',
		'fullname' => 'CONCAT_WS(" ", Employee.first_name, Employee.middle_name, Employee.last_name   )'
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
				'Salary' => array(
					'className' => 'Salary',
					'foreignKey' => false,
					'conditions' => array('Salary.employee_id = Employee.id'),
					'dependent' => true
				),
			
			),
			'belongsTo' => array(
				'Position' => array(
					'className' => 'HumanResource.Position',
					'foreignKey' => 'position_id',
					'conditions' => '',
					),
				'Department' => array(
					'className' => 'HumanResource.Department',
					'foreignKey' => 'department_id',
					'conditions' => '',
					),
				'Status' => array(
					'className' => 'HumanResource.Status',
					'foreignKey' => 'status',
					'conditions' => '',
					),

				'DailyInfo' => array(
						'className' => 'DailyInfo',
						'foreignKey' => 'employee_id',
						'conditions' => '',
						'dependent' => true,
					),		
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

	public function bindEmployee() {
		$this->bindModel(array(
			'hasOne' => array(
				'WorkSchedule' => array(
					'className' => 'HumanResource.WorkSchedule',
					'foreignKey' => false,
					'conditions' => 'Employee.id = WorkSchedule.foreign_key'
				),		

				'WorkShift' => array(
					'className' => 'HumanResource.WorkShift',
					'foreignKey' => false,
					'conditions' => 'WorkSchedule.work_shift_id = WorkShift.id'
				),	
			)
		));
		$this->recursive = 1;
		//$this->contain($giveMeTheTableRelationship);
	}

	public function getList($conditions = array()) {

		return $this->find('list',array(
				'conditions' => array(),
				'group' => array('Employee.id'),
				'order' => array('Employee.last_name ASC','Employee.first_name ASC'),
				'fields' => array('Employee.id','Employee.full_name')
			));
	}

	public function getAllWorkShift($params = array()){

		$this->bindEmployee();
		$workshifts = $this->find('all',$params);
		// pr($workshifts); exit;

		$list = [];
			foreach ($workshifts as $key => $workshift) {
				if (!empty($workshift['WorkShift']['from']) && $workshift['WorkShift']['from'] != '00-00-00') {
					$list[$key]['title'] = $workshift['WorkShift']['from'] . ' - ' . $workshift['WorkShift']['to'];
					$list[$key]['start'] = $workshift['WorkShift']['from'];
					$list[$key]['end']  = $workshift['WorkShift']['to'];
					$list[$key]['color'] = '#257e4a';
				}
			}

			$list = json_encode($list);
			$list = str_replace('[','',$list);
			$list = str_replace(']','',$list);

			return $list;

	}


}