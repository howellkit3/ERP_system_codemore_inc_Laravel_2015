<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Employee extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Employee';

    public $actsAs = array('Containable');

	public $virtualFields = array(
		'full_name' => 'CONCAT_WS(" ",Employee.last_name , Employee.middle_name , Employee.first_name ,Employee.suffix)',
		'fullname' => 'CONCAT_WS(" ", Employee.first_name, Employee.middle_name, Employee.last_name ,Employee.suffix)',
		'middle_fullname' => 'CONCAT_WS(" ", Employee.first_name, Employee.last_name , Employee.middle_name ,Employee.suffix)',
		'last_fullname' => 'CONCAT_WS(" ", Employee.last_name, Employee.first_name , Employee.middle_name ,Employee.suffix )',
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
				'HumanResourceContactPerson' =>  array(
					'className' => 'ContactPerson',
					'foreignKey' => 'employee_id',
					'conditions' => '',
					'dependent' => true
				),

				'ContactPersonAddress' =>  array(
					'className' => 'HumanResource.Address',
					'foreignKey' => false,
					'conditions' => array('ContactPersonAddress.foreign_key = ContactPerson.id',
										'ContactPersonAddress.model' => 'ContactPerson'),
					'dependent' => true
				),
				'ContactPersonNumber' =>  array(
					'className' => 'HumanResource.Contact',
					'foreignKey' => false,
					'conditions' => array('ContactPersonNumber.foreign_key = ContactPerson.id',
						'ContactPersonNumber.model' => 'ContactPerson'),
					'dependent' => true
				),
				'ContactPersonEmail' => array(
					'className' => 'HumanResource.Email',
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
					'SSS' => array(
					'className' => 'GovernmentRecord',
					'foreignKey' => false,
					'conditions' => array('SSS.employee_id = Employee.id','SSS.agency_id' => 1)
						),
				'PhilHealth' => array(
					'className' => 'GovernmentRecord',
					'foreignKey' => false,
					'conditions' => array('PhilHealth.employee_id = Employee.id','PhilHealth.agency_id' => 3)
						),
				'TIN' => array(
					'className' => 'GovernmentRecord',
					'foreignKey' => false,
					'conditions' => array('TIN.employee_id = Employee.id','TIN.agency_id' => 2)
						),
				'Pagibig' => array(
					'className' => 'GovernmentRecord',
					'foreignKey' => false,
					'conditions' => array('Pagibig.employee_id = Employee.id','Pagibig.agency_id' => 4)
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

				'Contract' => array(
						'className' => 'Contract',
						'foreignKey' => 'contract_id',
						'conditions' => '',
						'dependent' => true,
					),	
				// 'Tooling' => array(
				// 		'className' => 'Tooling',
				// 		'foreignKey' => 'employee_id',
				// 		'conditions' => '',
				// 		'dependent' => true,
				// 	),
			
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
				'Attendance' =>  array(
					'className' => 'Attendance',
					'foreignKey' => 'employee_id',
					'conditions' => '',
					'dependent' => true
				),
				'EmployeeEducationalBackground' =>  array(
					'className' => 'EmployeeEducationalBackground',
					'foreignKey' => 'employee_id',
					'conditions' => '',
					'dependent' => true
				),
				'Dependent' =>  array(
					'className' => 'Dependent',
					'foreignKey' => 'employee_id',
					'conditions' => '',
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

	public function bindPrimary() {
		$this->bindModel(array(
			'belongsTo' => array(
				'Position' => array(
					'className' => 'HumanResource.Position',
					'foreignKey' => 'position_id',
					'conditions' => '',
					),
			),
			'hasOne' => array(
				'EmployeeAdditionalInformation' => array(
					'className' => 'EmployeeAdditionalInformation',
					'foreignKey' => 'employee_id',
					'dependent' => true
				),
				'Salary' => array(
					'className' => 'Salary',
					'foreignKey' => false,
					'conditions' => array('Salary.employee_id = Employee.id'),
					'dependent' => true
				),
			)
		));
		$this->recursive = 1;
		//$this->contain($giveMeTheTableRelationship);
	}
	public function bindSSS($group = array()) {
		$this->bindModel(array(
			'belongsTo' => array(
				'GovernmentRecord' => array(
					'className' => 'GovernmentRecord',
					'foreignKey' => false,
					'conditions' => array('GovernmentRecord.employee_id = Employee.id','GovernmentRecord.agency_id' => 1)
					),
				'Status' => array(
					'className' => 'HumanResource.Status',
					'foreignKey' => 'status',
					'conditions' => '',
					),

			),
			'hasOne' => array(
				'EmployeeAdditionalInformation' => array(
					'className' => 'EmployeeAdditionalInformation',
					'foreignKey' => 'employee_id',
					'dependent' => true
				)
			)
		));
		if (!empty($group)) {
			$group = array_merge($group,array('GovernmentRecord','EmployeeAdditionalInformation'));

			$this->contain($group);

		}
		//$this->recursive = 1;

	}

	public function bindPagibig() {
		$this->bindModel(array(
			'belongsTo' => array(
				'GovernmentRecord' => array(
					'className' => 'GovernmentRecord',
					'foreignKey' => false,
					'conditions' => array('GovernmentRecord.employee_id = Employee.id','GovernmentRecord.agency_id' => 4)
					),
			),
			'hasOne' => array(
				'EmployeeAdditionalInformation' => array(
					'className' => 'EmployeeAdditionalInformation',
					'foreignKey' => 'employee_id',
					'dependent' => true
				)
			)
		));

		$this->recursive = 1;
	}
	public function getList($conditions = array()) {

		return $this->find('list',array(
				'conditions' => $conditions ,
				'group' => array('Employee.id'),
				'order' => array('Employee.last_name ASC','Employee.first_name ASC'),
				'fields' => array('Employee.id','Employee.last_fullname')
			));
	}

	public function getAllWorkShift($params = array(),$data = null,$holidays = array()){

		$this->bindEmployee();
		$workshifts = $this->find('all',$params);
		// pr($workshifts); exit;
		$list = array();

		if ($data['WorkSchedule']['type'] == 'monthly') {

					$date = explode('-',$data['WorkSchedule']['day']);

					$days1 = explode('/',trim($date[0]));
					$days2 = explode('/',trim($date[1]));

					ini_set('max_execution_time', 3600);
					ini_set('memory_input_time', 1024);
					ini_set('max_input_nesting_level', 1024);
					ini_set('memory_limit', '1024M');

					$list_key = 0;

					for ($days_count = $days1[2];$days_count <= $days2[2]; $days_count++) :

					foreach ($workshifts as $key => $workshift) {

						if (!empty($workshift['WorkShift']['from']) && $workshift['WorkShift']['from'] != '00-00-00') {
								
								$dateNow = $days1[0].'-'.$days1[1].'-'.sprintf("%02d",$days_count);
									
								if ( date("w",strtotime($dateNow)) != 0) { 
									
									$list[$list_key]['title'] = date('h:i a',strtotime($workshift['WorkShift']['from'])) . ' - ' .  date('h:i a',strtotime($workshift['WorkShift']['to']));
									$list[$list_key]['start'] = $days1[0].'-'.$days1[1].'-'.sprintf("%02d",$days_count).' '.date('h:i:s',strtotime($workshift['WorkShift']['from']));
									$list[$list_key]['end']  = $days1[0].'-'.$days1[1].'-'.sprintf("%02d",$days_count).' '.date('h:i:s',strtotime($workshift['WorkShift']['to']));
									$list[$list_key]['color'] = '#257e4a';

								} 

								foreach ($holidays as $key => $holiday) {

									if ($dateNow >= $holiday['Holiday']['start_date'] && $dateNow <= $holiday['Holiday']['end_date'] ) {

									$list[$list_key]['title'] = date('h:i a',strtotime($workshift['WorkShift']['from'])) . ' - ' .  date('h:i a',strtotime($workshift['WorkShift']['to']));
									$list[$list_key]['start'] = $days1[0].'-'.$days1[1].'-'.sprintf("%02d",$days_count).' '.date('h:i:s',strtotime($workshift['WorkShift']['from']));
									$list[$list_key]['end']  = $days1[0].'-'.$days1[1].'-'.sprintf("%02d",$days_count).' '.date('h:i:s',strtotime($workshift['WorkShift']['to']));
									$list[$list_key]['color'] = '#F57821';

									} 
								}



								if (date("w",strtotime($dateNow)) == 0) {
									$list[$list_key]['title'] = 'Rest Day';
									$list[$list_key]['start'] = $days1[0].'-'.$days1[1].'-'.sprintf("%02d",$days_count).' '.date('h:i:s',strtotime($workshift['WorkShift']['from']));
									$list[$list_key]['end']  = $days1[0].'-'.$days1[1].'-'.sprintf("%02d",$days_count).' '.date('h:i:s',strtotime($workshift['WorkShift']['to']));
									$list[$list_key]['color'] = '#6237A5';
								}


						

								
							
						}
					}

						
					$list_key++;

					endfor;

					$list = array_values($list);
				
		} else {


			foreach ($workshifts as $key => $workshift) {
				if (!empty($workshift['WorkShift']['from']) && $workshift['WorkShift']['from'] != '00-00-00') {
					$list[$key]['title'] =  date('h:i a',strtotime($workshift['WorkShift']['from'])) . ' - ' .  date('h:i a',strtotime($workshift['WorkShift']['to']));
					$list[$key]['start'] = $data['WorkSchedule']['day'].' '.date('h:i:s',strtotime($workshift['WorkShift']['from']));
					$list[$key]['end']  =  $data['WorkSchedule']['day'].' '.date('h:i:s',strtotime($workshift['WorkShift']['to']));
					$list[$key]['color'] = '#257e4a';
				}
			}

		}

		$list = json_encode($list);

		return $list;

	}


	public function filter($conditions = array()) {

			$employee = $this->find('all',array(
								'conditions' => $conditions,
								'order' => array('Employee.last_name ASC'),
								'group' => array('Employee.id'),
								'fields' => array(
									'Employee.id',
									'Employee.department_id',
									'Salary.employee_salary_type',
									'EmployeeAdditionalInformation.bank_account_number'
								)
							));

			return  Set::classicExtract($employee,'{n}.Employee.id');
	}

	public function findbyCode($code = null,$type = 'first',$fields = array(),$conditions = array()) {

		$conditions = array('Employee.code' => $code );
		return $this->find($type,array('conditions' => $conditions,'fields' => $fields));

	}

	public function checkContract($emp = array()) {

		$dateNow = date('Y-m-d h:i:s');

		if (!empty($emp)) {

			$contractStart = array();
			$startKey = 0;

			$empStatus = array('1','2');

			$empContract = array('1','2');

			foreach ($emp as $key => $list) {

		    	$to = $list['Employee']['date_hired'];

				$datetime1 = new DateTime($dateNow);

				$datetime2 = new DateTime($to);
				$interval = $datetime1->diff($datetime2);
				// if ($) {

				// }
				//contractual or probi
				if ($interval->m >= 5 && in_array($list['Employee']['contract_id'],$empStatus) && in_array($list['Contract']['id'], $empContract)) {
						
						$contractStart[$startKey] = $list;
						$contractStart[$startKey]['date_hired'] = $list['Employee']['date_hired'];
						$contractStart[$startKey]['end_contract'] =  date('Y-m-d', strtotime("+5 months", strtotime($list['Employee']['date_hired'])));
						$contractStart[$startKey]['emp_status'] = $list['Employee']['contract_id'];
				
				}

				$startKey++;

			}

			return $contractStart;

		}
	}

	public function getOperator($type = null,$conditions = array()) {

		$this->bind(array('Position'));

		$employees = $this->find($type,array(
			'conditions' => array('Position.id' => array('52','75','76','77','78','111','112','113','114','118','119','120','121','122','123','124','125','126','127','128','129','130','131') ),
			//'fields' => array('Employee.id','Employee.first_name','Employee.last_name','Employee.middle_name','Employee.fullname','Position.id','Position.name')
			'fields' => array('Employee.id','Employee.fullname')
			));

		return $employees;
	}

}