<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

App::import('Vendor', 'DOMPDF', true, array(), 'dompdf'.DS.'dompdf_config.inc.php', false);


App::uses('ImageUploader', 'Vendor');

class EmployeesController  extends HumanResourceAppController {

	var $helpers = array('HumanResource.PhpExcel','HumanResource.CustomText');
	//,'HumanResource.Country'
	public function index() {

		$this->loadModel('HumanResource.Tooling');
		$this->loadModel('HumanResource.Position');
		$this->loadModel('HumanResource.Department');
		$this->loadModel('HumanResource.Status');

		$this->Employee->bind(array('Position','Department','Status'));

		//array_push($departmentData, "All");
		$limit = 10;

        $conditions = array();

	 	if ( (empty($this->params['named']['model'])) ||  $this->params['named']['model'] == 'Employee' ) {
	 		
	 		$this->Employee->bind(array('Position','Department','Status'));

	        $this->paginate = array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'recursive' => -1,
	            'order' => 'Employee.code DESC',
	        );

	        $employees = $this->paginate();

	        $totalEmployee = $this->Employee->find('count',array('conditions' => $conditions, 'group' => array('Employee.id'), 'recursive' => -1));
	

	    }

	    if ( (empty($this->params['named']['model'])) ||  $this->params['named']['model'] == 'Tooling' ) {
			//toolings
	       	$conditions = array();    
	       	$this->Tooling->bind('Employee');
	        $this->paginate = array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Tooling.id DESC',
	            'recursive' => -1
	        );


	        $toolings = $this->paginate('Tooling');
		       
	    }
        
		$positions = $this->Position->find('list',array('fields' => array('id','name')));

		$departments = $this->Department->find('list',array('fields' => array('id','notes')));
		
        $employeeList = $this->Employee->find('list',array('fields' => array('id','fullname')));

        $departmentData = $this->Department->find('list',array('fields' => array('id','name')));

		//$toolList = $this->Tool->find('list',array('fields' => array('id','name')));

		$statusList = $this->Status->find('list',array('fields' => array('id','name')));

        $this->set(compact('employees','departments','positions','toolings','toolList','employeeList', 'departmentData','statusList','totalEmployee'));
	}


	public function search_by_department($departmentId = null , $status = null,$hintKey = null){

		$this->loadModel('HumanResource.Position');
		$this->loadModel('HumanResource.Department');
		$this->loadModel('HumanResource.Status');

		$this->Employee->bind(array('Position','Department','Status'));

		$conditions = array();

		if ($status != 0) {

			$conditions = array_merge($conditions,array('Employee.status' => $status ));

		}

		if ($departmentId != 0) {

			$conditions = array_merge($conditions,array('Employee.department_id' => $departmentId ));

		}

		if (!empty($hintKey)) {

			$conditions = array_merge($conditions,array(
									'OR' => array(
										array('Employee.first_name LIKE' => '%' . $hintKey . '%'),
										array('Employee.last_name LIKE' => '%' . $hintKey . '%'),
										array('Employee.code LIKE' => '%'. $hintKey .'%')
									)
								));

		}

		$employeeData = $this->Employee->find('all',array(
			'conditions' => $conditions,
			'order' => array('Employee.code DESC')
			));

		$this->set(compact('employeeData'));
		
    	$this->render('search_by_department');
    	

	}

	public function add () {


		if ($this->request->is('post')) {

			//pr($this->request->data); exit;

			 $this->loadModel('HumanResource.EmployeeAdditionalInformation');

			 $this->loadModel('HumanResource.Email');

			 $this->loadModel('HumanResource.Address');

			 $this->loadModel('HumanResource.GovernmentRecord');

			 $this->loadModel('HumanResource.Contact');

			 $this->loadModel('HumanResource.ContactPerson');

			 $this->loadModel('HumanResource.EmployeeEducationalBackground');

			 $this->loadModel('HumanResource.Department');

			 $this->loadModel('HumanResource.Position');

			 $this->loadModel('HumanResource.Dependent');

			 $this->loadModel('HumanResource.Salaries');

			 $uploader = new ImageUploader;
        
			 if(!empty($this->request->data)){
			 	
			 	$auth = $this->Session->read('Auth.User');
			 	$data = $this->request->data;
			 	//pr($data);exit();
			 	if (!empty($this->request->data['Employee']['file']['name'])) {

					$file = $this->request->data['Employee']['file'];
              
                    if ($this->request->data['Employee']['file']['error'] == 0 ) {
                       $time = time();
                       $file['name'] = $uploader->resize($file, $time,'employee');
                    }
               
                	$data['Employee']['image'] = $file['name'];
            	}

            	$this->Employee->create();

            	//check department

            	if (!empty($this->request->data['Employee']['department_id_others']) && $this->request->data['Employee']['department_id'] == 'other') {

            		$department = $this->Department->createDepartment($this->request->data,$auth);
            		
            		if (!empty($department)) {

            			 $data['Employee']['department_id'] = $department;
            		}
            	}

				//check Position
            		
            	if (!empty($this->request->data['Employee']['position_id_others']) && $this->request->data['Employee']['position_id'] == 'other') {

            		$position = $this->Position->createPosition($this->request->data,$auth);
            		
            		if (!empty($position)) {

            			 $data['Employee']['position_id'] = $position;
            		}
            	}

            		
			 	if ($this->Employee->save($data)) {
		
			 		$employeeId = $this->Employee->id;
			 		//save additional info
			 		$save = $this->EmployeeAdditionalInformation->saveInfo($employeeId,$data['EmployeeAdditionalInformation']);
			 		//save employee emails
			 		//$save = $this->Email->saveEmails($data['Emails'],$employeeId,'Employee',$auth['id']);
					//save employee address
			 		$save = $this->Address->saveAddress($data['Address'],$employeeId,'Employee',$auth['id']);	
			 		//save employee contact
			 		//$this->loadModel('HumanResource.Contact');

			 		$this->loadModel('HumanResource.HumanResourceContactPerson');

			 		$save = $this->HumanResourceContactPerson->saveContact($data['Contact'],$employeeId,'Employee',$auth['id']);
					//save employee_goverment record
			 		$save = $this->GovernmentRecord->saveRecord($data['EmployeeAgencyRecord'],$employeeId,$auth['id']);

			 		//save educational background
			 		$save = $this->EmployeeEducationalBackground->saveEducation($data['EmployeeEducationalBackground'],$employeeId);

			 		//save dependent
			 		$save = $this->Dependent->saveDependent($data['Dependent'],$employeeId,$auth['id']);

			 		if (!empty($data['ContactPersonData'])) {
						
						$this->HumanResourceContactPerson->saveContact($data['ContactPersonData'],$employeeId,$auth['id']);
			 		}
					//save contactPerson emails
			 		$save = $this->Email->saveEmails($employeeId,'ContactPerson',$data['ContactPersonData']['Email'],$auth['id']);

			 		$save = $this->Email->saveEmails($data['ContactPersonData']['Email'],$employeeId,'ContactPerson',$auth['id']);

			 		//$save
			 		$this->Session->setFlash('Saving employee information successfully, Please add Salary setting','success');
			 		   $this->redirect( array(
                                 'controller' => 'salaries', 
                                 'action' => 'employee_settings',
                                 $this->Employee->id
                            ));
                
                	} else {

			 		$this->Session->setFlash('There\'s an error saving employee information','error');
			 		}

			 } 
		}

		$this->loadModel('HumanResource.Position');

		$this->loadModel('HumanResource.Department');

		$this->loadModel('HumanResource.Status');

		$this->loadModel('HumanResource.Agency');

		$this->loadModel('HumanResource.Contract');

		$this->loadModel('Bank');

		$positionList = $this->Position->find('list',array('fields' => array('id','name')));

		$departmentList = $this->Department->find('list',array('fields' => array('id','notes'), 'order' => 'notes ASC'));

		$statusList = $this->Status->find('list',array('fields' => array('id','name')));

		$agencyList = $this->Agency->find('all',array('fields' => array('id','name','field')));

		$contractList = $this->Contract->find('list',array('fields' => array('id','name')));

		$bankList = $this->Bank->find('list',array('fields' => array('id','code')));

		$this->set(compact('positionList','departmentList','statusList','agencyList','contractList','bankList'));
	}

	public function edit($id){
		
		$this->loadModel('HumanResource.EmployeeAdditionalInformation');

		$this->loadModel('HumanResource.Email');

		$this->loadModel('HumanResource.Address');

		$this->loadModel('HumanResource.GovernmentRecord');

		$this->loadModel('HumanResource.Contact');

		$this->loadModel('HumanResource.HumanResourceContactPerson');

		$this->loadModel('HumanResource.ContactPerson');

		$this->loadModel('HumanResource.EmployeeEducationalBackground');

		$this->loadModel('HumanResource.Dependent');

		$this->loadModel('HumanResource.Salary');

		if ($this->request->is('put')) {
			
			if (!empty($this->request->data['EducationIdHolder'])) {

				foreach ($this->request->data['EducationIdHolder']['id'] as $key => $value) {
					$this->EmployeeEducationalBackground->delete($value);
				}
			}
			
			$uploader = new ImageUploader;
        
			 if(!empty($this->request->data)){
			 	$auth = $this->Session->read('Auth.User');
			 	$data = $this->request->data;

			 	if (!empty($this->request->data['Employee']['file']['name'])) {

					$file = $this->request->data['Employee']['file'];
              
                    if ($this->request->data['Employee']['file']['error'] == 0 ) {
                       $time = time();
                       $file['name'] = $uploader->resize($file, $time,'employee');
                        
                    }
               
                	$data['Employee']['image'] = $file['name'];
           		 }


			 	if ($this->Employee->save($data)) {


			 		$employeeId = $this->Employee->id;
			 		//save additional info
			 		$save = $this->EmployeeAdditionalInformation->saveInfo($employeeId,$data['EmployeeAdditionalInformation']);
			 		//save employee emails
			 		//$save = $this->Email->saveEmails($data['Emails'],$employeeId,'Employee',$auth['id']);
					//save employee address
			 		$save = $this->Address->saveAddress($data['Address'],$employeeId,'Employee',$auth['id']);	
			 		//save employee contact
			 		$this->loadModel('HumanResource.Contact');



			 		$save = $this->Contact->saveContact($data['Contact'],$employeeId,'Employee',$auth['id']);



					//save employee_goverment record
			 		$save = $this->GovernmentRecord->saveRecord($data['EmployeeAgencyRecord'],$employeeId,$auth['id']);

					if (!empty($data['EmployeeEducationalBackground'])) {

					//save educational background
					$save = $this->EmployeeEducationalBackground->saveEducation($data['EmployeeEducationalBackground'],$employeeId);

					}
					if (!empty($data['Dependent'])) {
			 		//save dependent
			 			$save = $this->Dependent->saveDependent($data['Dependent'],$employeeId,$auth['id']);

			 		}
			 		if (!empty($data['ContactPersonData'])) {

			 			$this->HumanResourceContactPerson->saveContact($data['ContactPersonData'],$employeeId,$auth['id']);
				
			 		}


			 		//pr($data);
			 		//exit();
			 		//save salary settings
			 		$this->Salary->saveSettings($data);
					//save contactPerson emails
			 		$save = $this->Email->saveEmails($employeeId,'ContactPerson',$data['ContactPersonData']['Email'],$auth['id']);


			 		$this->Session->setFlash('Saving employee information successfully','success');
			 		   $this->redirect( array(
                                 'controller' => 'employees', 
                                 'action' => 'index',
                                 'page' => !empty($this->request->params['named']['page']) ? $this->request->params['named']['page'] : '',
                                 'model' => 'Employee'
                            ));
                
                	} else {

			 		$this->Session->setFlash('There\'s an error saving employee information','error');
			 	}

			 } 
		}


		if (!empty($id)) {


		$this->loadModel('HumanResource.EmployeeAdditionalInformation');

		 $this->loadModel('HumanResource.Email');

		 $this->loadModel('HumanResource.Address');

		 $this->loadModel('HumanResource.GovernmentRecord');

		 $this->loadModel('HumanResource.Contact');

		 $this->loadModel('HumanResource.ContactPerson');

		 $this->loadModel('HumanResource.HumanResourceContactPerson');

		 $this->loadModel('HumanResource.EmployeeEducationalBackground');

			$this->Employee->bind(array(
				'EmployeeAdditionalInformation',
				'Email',
				'GovernmentRecord',
				'Address',
				'Contact',
				'ContactPerson',
				'HumanResourceContactPerson',
				'ContactPersonEmail',
				'ContactPersonAddress',
				'ContactPersonNumber',
				'EmployeeEducationalBackground',
				'Dependent',
				'Salary'
				));

			$this->request->data = $this->Employee->findById($id);

			if (!empty($_GET['test'])) {
				pr($this->request->data); exit();
			}
			

		}
		$this->loadModel('HumanResource.Position');

		$this->loadModel('HumanResource.Department');

		$this->loadModel('HumanResource.Status');

		$this->loadModel('HumanResource.Agency');

		$this->loadModel('HumanResource.Contract');

		$this->loadModel('HumanResource.Bank');

		$bankList = $this->Bank->find('list',array('fields' => array('id','code')));

		$positionList = $this->Position->find('list',array('fields' => array('id','name')));


		$departmentList = $this->Department->find('list',array('fields' => array('id','notes'), 'order' => 'notes ASC'));

		$statusList = $this->Status->find('list',array('fields' => array('id','name')));

		$agencyList = $this->Agency->find('all',array('fields' => array('id','name','field')));

		$contractList = $this->Contract->find('list',array('fields' => array('id','name')));

		$nameList = array();
		foreach ($agencyList as $key => $value) {
			$nameList[$value['Agency']['id']] = array('name' => $value['Agency']['name'],'field' =>$value['Agency']['field']);
		}
		
		$this->set(compact('positionList','departmentList','statusList','nameList','contractList','bankList'));
	}

	function view($id){

		if (!empty($id)) {

		 $this->loadModel('HumanResource.EmployeeAdditionalInformation');

		 $this->loadModel('HumanResource.Email');

		 $this->loadModel('HumanResource.Address');

		 $this->loadModel('HumanResource.GovernmentRecord');

		 $this->loadModel('HumanResource.Contact');

		 $this->loadModel('HumanResource.ContactPerson');

		// $this->loadModel('HumanResource.HumanResourceContactPerson');

		 $this->loadModel('HumanResource.Position');

		 $this->loadModel('HumanResource.Department');
		
		 $this->loadModel('HumanResource.Agency');

		 $this->loadModel('HumanResource.Contract');

		 $contractList = $this->Contract->find('list',array('fields' => array('id','name')));

		$positions = $this->Position->find('list',array('fields' => array('id','name')));

		$departments = $this->Department->getList();

		$this->Employee->bind(array(
			'EmployeeAdditionalInformation',
			'Email',
			'GovernmentRecord',
			'Address',
			'Contact',
			'ContactPerson',
			// 'HumanResourceContactPerson',
			'ContactPersonEmail',
			'ContactPersonAddress',
			'ContactPersonNumber',
		));

		$employee = $this->Employee->findById($id);


		$agencyList = $this->Agency->find('all',array('fields' => array('id','name','field')));

		$nameList = array();

		foreach ($agencyList as $key => $value) {
			$nameList[$value['Agency']['id']] = array('name' => $value['Agency']['name'],'field' =>$value['Agency']['field']);
		}
		

			$this->set(compact('employee','departments','positions','nameList','contractList'));
		}
	}


	public function find($department = null, $name = '') {

			$this->layout = false;

			if (!empty($name)) {

				$conditions = array('OR' => 
					array('Employee.first_name LIKE' => '%'.$name.'%','Employee.last_name LIKE' => '%'.$name.'%')
					);


			if (!empty($department) && $department > 0) {

				$conditions = array_merge($conditions,array('Employee.department_id' => $department));
			}

			$limit = 10;

			$this->paginate = array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Employee.Last_name DESC',
	        );

	        $employees = $this->paginate();

	        $this->set(compact('employees'));

		}

	}


	public function findById($id = null) {

			$this->layout = false;

			if (!empty($id)) {

				if ($this->request->is('ajax')) {

					$employee = $this->Employee->find('first',array(
						'conditions' => array( 'Employee.id' => $id ),
						'fields' => array('id','full_name','code')
					));

					echo json_encode($employee);
					exit();
				}
			}

		
		$this->autoRender = false;

	}

	public function findByDepartment($id = null) {

			$this->layout = false;

			if (!empty($id)) {

				if ($this->request->is('ajax')) {

				$this->loadModel('HumanResource.Position');
				$this->loadModel('HumanResource.Employee');		
				$this->loadModel('HumanResource.Attendance');	
				$this->Attendance->bind(array('Employee'));

				$conditions = array();

				$date = date('Y-m-d');

				$conditions = array_merge($conditions,array(
  						'date(Attendance.date) BETWEEN ? AND ?' => array($date,$date), 
  				));
  				
				$conditions = array_merge($conditions,array('Attendance.in !=' => ' '));

				$conditions = array_merge($conditions,array('Employee.department_id' => $id));

				// $employees = $this->Employee->find('all',array(
				// 	'conditions' => $conditions,
				// 	'order' => array('Employee.last_name','Employee.code'),
				// 	'fields' => array(
				// 	'id',
				// 	'Employee.first_name',
				// 	'Employee.last_name',
				// 	'Employee.middle_name',
				// 	'Employee.position_id',
				// 	'Employee.department_id',
				// 	'Employee.image',
				// 	// 'Attendance.schedule_id',
				// 	// 'Attendance.type',
				// 	// 'Attendance.in',
				// 	// 'Attendance.out',
				// 	'Position.name'
				// 	),
				// 	'group' => 'Employee.id' 
				// ));

				$employees = $this->Attendance->find('all',array(
					'conditions' => $conditions,
					'order' => array('Employee.last_name','Employee.code'),
						'fields' => array(
					'id',
					'Employee.first_name',
					'Employee.last_name',
					'Employee.middle_name',
					'Employee.position_id',
					'Employee.department_id',
					'Employee.image',
					'Attendance.schedule_id',
					'Attendance.type',
					'Attendance.in',
					'Attendance.out'
					//'Position.name'
					),
					
				));

				//pr($employees);exit();

				if (count($employees) == 0) {

					echo "no result found";
				}

				}

				$this->set(compact('employees'));		
				
				$this->render('Employees/ajax/employees_overtime');


			} else {
					echo "no result found";
					exit();
			}



	}

	public function print_employee() {

		Configure::write('debug',0);

		if (!empty($this->request->data)) {
			//pr($this->request->data);exit();
			$this->loadModel('HumanResource.Position');
			$this->loadModel('HumanResource.Department');
			$this->loadModel('HumanResource.EmployeeAdditionalInformation');
			$this->loadModel('HumanResource.Salary');
			$this->loadModel('HumanResource.Status');
			$this->loadModel('HumanResource.GovernmentRecord');
			$this->loadModel('HumanResource.Address');
			$this->loadModel('HumanResource.Contact');
			$this->loadModel('HumanResource.Email');

			ini_set('max_execution_time', 3600);
			ini_set('memory_input_time', 1024);
			ini_set('max_input_nesting_level', 1024);
			ini_set('memory_limit', '1024M');

			$this->Employee->bind(array('Position','Department','Contact','Status','EmployeeAdditionalInformation','Address','Salary','SSS','PhilHealth','TIN','Pagibig','Email'));

			$conditions = array();

			if ($this->request->data['status'] != 0) {

				$conditions = array_merge($conditions,array('Employee.status' => $this->request->data['status'] ));

			}

			if ($this->request->data['department'] != 0) {

				$conditions = array_merge($conditions,array('Employee.department_id' => $this->request->data['department'] ));

			}

			if (!empty($this->request->data['input_search'])) {

				$conditions = array_merge($conditions,array(
										'OR' => array(
											array('Employee.first_name LIKE' => '%' . $this->request->data['input_search'] . '%'),
											array('Employee.last_name LIKE' => '%' . $this->request->data['input_search'] . '%')
										)
									));

			}

			$employeeData = $this->Employee->find('all',array(
				'conditions' => $conditions,
				'order' => array('Employee.last_name','Employee.first_name'),
				'group' => 'Employee.id',
				'fields' => array(
					'id',
					'Employee.code',
					'Employee.last_name',
					'Employee.first_name',
					'Employee.middle_name',
					'EmployeeAdditionalInformation.gender',
					'EmployeeAdditionalInformation.status',
					'Employee.status',
					'Status.name',
					//'Address',
					'Department.name',
					'Department.notes',
					'Position.name',
					'Department.description',
					'Salary.employee_salary_type',
					'Salary.basic_pay',
					'Salary.ctpa',
					'Salary.sea',
					'SSS.value',
					'PhilHealth.value',
					'Pagibig.value',
					'Tin.value',

					)
			));


			
			//pr($employeeData);exit();
			
			$this->set(compact('employeeData'));
			
			$this->render('Employees/xls/employee_report');

		}
		
	}

	public function print_tool($id = null) {
		
		$this->loadModel('HumanResource.Tooling');

		$this->loadModel('HumanResource.Position');

		$this->loadModel('HumanResource.Department');

		$this->Tooling->bind(array('Employee','Tool'));

		$toolId = $this->request->data['Tool']['tool_id'];
		//$departmentId = $this->request->data['Tool']['department_id'];
		$date = $this->request->data['Tool']['datepick'];
		
		$conditions = array();

        if (!empty($toolId)) {

        	$conditions = array_merge($conditions,array('Tooling.tools_id' => $toolId));

        } 

        // if (!empty($employeeId)) {

        // 	$conditions = array_merge($conditions,array('Employee.department_id' => $departmentId));

        // } 

        if (!empty($date)) {

        	$conditions = array_merge($conditions,array('Tool.created' => $date.' '.'00:00:00'));

        } 
		
		$toolingData = $this->Tooling->find('all',array('conditions' => $conditions,'order' => 'Tooling.id ASC'));

		$positionList = $this->Position->find('list',array('field' => array('id','name')));

		$departmentList = $this->Department->find('list',array('field' => array('id','name')));
		//pr($toolingData);exit();
		$this->set(compact('toolingData','positionList','departmentList'));
		$this->render('Employees/xls/tool_report');

	}


	public function getCode(){

		if ($this->request->is('ajax')) {

			$this->loadModel('HumanResource.Department');
			//add position if ever
			if (!empty($this->request->data['department'])) {

				$department = $this->Department->find('first',array(
					'conditions' => array('Department.id' => $this->request->data['department']),
					'fields' => array('id','prefix')
					)); 

			}
			
			$employee = $this->Employee->find('count',array('conditions' => array('Employee.department_id' => $this->request->data['department'] )));

			$employee_number = str_pad($employee + 1, 3, '0', STR_PAD_LEFT);

			$empCode = 'E-'.$department['Department']['prefix'].'-'.$employee_number;

			if (!empty($this->request->data['date-hired'])) {

				$date = explode('-', $this->request->data['date-hired'] );
				$empCode = 'E'.$department['Department']['prefix'].'-'.substr($date[0], -2).'-'.$date[1].'-'.$employee_number;
			}
			echo json_encode(array('emp_number' => $empCode ));
			exit();
			
		}
	}

	public function checkExistingCode() {

		if (!empty($this->request->data)) {

			$code = $this->request->data['emp_code'];

			$employee = $this->Employee->find('count',array('conditions' => array('Employee.code' => $code )));

			echo json_encode(array('result' => $employee ));
			exit();
		}
	}

	public function checkExistingEmployee()  {

		if ($this->request->is('ajax')) {
			$data = $this->request->data;

			$conditions = array('AND'=>array(
				'first_name like' => '%'.$data['first_name'].'%',
				'last_name like' => '%'.$data['last_name'].'%',

			));

			if (!empty($data['middle_name'])) {
				$conditions = array_merge($conditions,array('Employee.middle_name like' => '%'.$data['middle_name'].'%'));
			}

			$employee = $this->Employee->find('count',array(
				'conditions' => $conditions
				));


			echo json_encode($employee);

		}

		exit();
	}


	public function getBy($id = null) {

			$this->layout = false;

			if ($this->request->is('ajax')) {
				
				$conditions = array();

				$query = $this->request->query;

				$this->loadModel('HumanResource.Position');	
				$this->loadModel('HumanResource.Salary');	


				$this->Employee->bind(array('Position'));

				if (!empty($query['department'])) {
					$conditions = array_merge($conditions,array('Employee.department_id' => $query['department'] ));	
				}

				if (!empty($query['id'])) {
					
					$this->Employee->bind(array('Department','Position','Salary'));
					$conditions = array_merge($conditions,array('Employee.id' => $query['id'] ));
				
				}

				

				$employees = $this->Employee->find('all',array(
					'conditions' => $conditions ,
					'order' => array('Employee.last_name','Employee.code'),
					// 'fields' => array(
					// 'id',
					// 'Employee.first_name',
					// 'Employee.last_name',
					// 'Employee.middle_name',
					// 'Employee.position_id',
					// 'Employee.department_id',
					// 'Employee.code',
					// 'Employee.image',
					// 'Position.name'
					// ),
					'group' => 'Employee.id' 
				));


				if (count($employees) == 0) {

					$employees = array('result' => 0);
				} else {
					$employees = array('result' => $employees );
				}

				echo json_encode($employees);
			}

			exit();


	}
	
	public function delete($id = null) {

		if (!empty($id)) {


			$this->loadModel('HumanResource.EmployeeAdditionalInformation');

			 $this->loadModel('HumanResource.Email');

			 $this->loadModel('HumanResource.Address');

			 $this->loadModel('HumanResource.GovernmentRecord');

			 $this->loadModel('HumanResource.Contact');

			 $this->loadModel('HumanResource.ContactPerson');

			 $this->loadModel('HumanResource.EmployeeEducationalBackground');

			if ($this->Employee->delete($id)) {


					//delete all additional info
					$this->EmployeeAdditionalInformation->deleteAll(array('EmployeeAdditionalInformation.employee_id' => $id), false);

					//delete all Email
					$this->Email->deleteAll(array('Email.foreign_key' => $id,'Email.model' => 'Employee'), false);

					//delete all Address
					$this->Address->deleteAll(array('Address.foreign_key' => $id,'Address.model' => 'Employee'), false);

					//delete all government Record
					$this->GovernmentRecord->deleteAll(array('GovernmentRecord.employee_id' => $id), false);

					//delete all EmployeeEducationalBackground Record
					$this->EmployeeEducationalBackground->deleteAll(array('EmployeeEducationalBackground.employee_id' => $id), false);
					
					//delete all EmployeeEducationalBackground Record
					$this->ContactPerson->deleteAll(array('ContactPerson.employee_id' => $id), false);
			
				$this->Session->setFlash(
                      __('Employee Successfully deleted.', h($id), 'sucess')
                  );
             } else {
                  $this->Session->setFlash(
                    __('Employee cannot be deleted.', h($id), 'sucess')
                 );
            }

            $this->redirect( array(
                                 'controller' => 'employees', 
                                 'action' => 'index',
                                 $this->Employee->id
                            ));

		}	
	}

	public function print_id($id = null) {

		$this->loadModel('HumanResource.ContactPerson');


		$this->loadModel('HumanResource.Contact');


		$this->loadModel('HumanResource.Address');

		//Configure::write('debug',0);

		$this->layout = false;


		if (!empty($id)) {

			$this->Employee->bind(array('Department','Position','ContactPerson','Contact','ContactPersonNumber','ContactPersonAddress'));
			
			$employee = $this->Employee->findById($id);
		}


		$this->set(compact('employee'));

		$view = new View(null, false);
		//pr($formatDataSpecs);exit();
		$view->set(compact('employee'));

		$view->viewPath = 'Employees'.DS.'pdf';	
   
        $output = $view->render('print_id', false);
   	   
      
        $dompdf = new DOMPDF();
        $dompdf->set_paper("A5");


		//$paper_size = array(0,0,96,56);
		//  $dompdf->set_paper($paper_size);
//

        //$output = mb_convert_encoding($output, 'HTML-ENTITIES', 'UTF-8');
        $dompdf->load_html($output);
        $dompdf->load_html($output, 'UTF-8');
        $dompdf->render();
        $canvas = $dompdf->get_canvas();
        $font = "DejaVu Sans";
        //body { font-family: DejaVu Sans, sans-serif; }
        //$pdf->SetFont('dejavusans', '', 14, '', true);
      //  $canvas->page_text(16, 800, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, array(0,0,0));
        //
        $output = $dompdf->output();
        
        $random = rand(0, 1000000) . '-' . time();
        if (empty($filename)) {
        	//$filename = 'product-'.$quotation['ProductDetail']['name'].'-quotation'.time();
        	$filename = 'employee-'.time();
        }
      	$filePath = 'view_pdf/'.strtolower(Inflector::slug( $filename , '-')).'.pdf';
        $file_to_save = WWW_ROOT .DS. $filePath;
         //pr($output);exit();	
        if ($dompdf->stream( $file_to_save, array( 'Attachment'=>0 ) )) {
        		unlink($file_to_save);
        }
       

	}


	public function saveImage() {

			//WWW_ROOT .DS. $filePath;

		// $fileName = time().'-image.jpg';

		// $savePath = WWW_ROOT.'/img/uploads/employee/';

		// $str = file_get_contents("php://input");

		// file_put_contents($savePath."upload.jpg", pack("H*", $str));



		if (!empty($_POST)) {

	
			$employee = array();

			if (!empty($_POST['employeeId'])) {

				$employee = $this->Employee->findById($_POST['employeeId']);

			}

			$image=$_POST['save_image']; //assing post to variable
			
			$savePath = WWW_ROOT.'/img/uploads/employee/';
			
			$image=base64_decode(str_replace('data:image/png;base64,', '', $image));

			$imageName = date('ymdhis').'-'.time().'.png'; 

			file_put_contents($savePath.$imageName, $image);

			if (!empty($employee['Employee']['id'])) {

				$employee['Employee']['image'] = $imageName;

				if ($this->Employee->save($employee)) {

					$this->redirect( array(
                                 'controller' => 'employees', 
                                 'action' => 'view',
                                 $this->Employee->id
                            ));
				} else {

			 		$this->Session->setFlash('There\'s an error saving employee information','error');
			 	}

			}
			 // decode string with base64 and replace desnecessary header to write to file
			//save picture to disk

		}

	

	}	

	
}