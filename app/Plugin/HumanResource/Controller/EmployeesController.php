<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

App::uses('ImageUploader', 'Vendor');

class EmployeesController  extends HumanResourceAppController {

	var $helpers = array('HumanResource.PhpExcel','HumanResource.CustomText');
	//,'HumanResource.Country'
	public function index() {

		$this->loadModel('HumanResource.Position');
		$this->loadModel('HumanResource.Department');
		$this->loadModel('HumanResource.Tooling');
		$this->loadModel('HumanResource.Status');
		//array_push($departmentData, "All");

		$limit = 10;

        $conditions = array();

	 	if ( (empty($this->params['named']['model'])) ||  $this->params['named']['model'] == 'Employee' ) {
	 		$this->Employee->bind(array('Position','Department','Status'));

	        $this->paginate = array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Employee.id DESC',
	        );

	        $employees = $this->paginate();
	    }

        $this->loadModel('HumanResource.Tooling');
 
	    if ( (empty($this->params['named']['model'])) ||  $this->params['named']['model'] == 'Tooling' ) {
			//toolings
	       	$conditions = array();    
	       	$this->Tooling->bind('Employee');
	        $this->paginate = array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Tooling.id DESC',
	        );


	        $toolings = $this->paginate('Tooling');
		       
	    }

        
		$positions = $this->Position->find('list',array('fields' => array('id','name')));

		$departments = $this->Department->find('list',array('fields' => array('id','name')));
        $this->loadModel('HumanResource.Employee');

        $employeeList = $this->Employee->find('list',array('fields' => array('id','fullname')));

        $this->loadModel('HumanResource.Department');

        $departmentData = $this->Department->find('list',array('fields' => array('id','name')));

		$this->loadModel('HumanResource.Tool');

		$toolList = $this->Tool->find('list',array('fields' => array('id','name')));

		$statusList = $this->Status->find('list',array('fields' => array('id','name')));

        $this->set(compact('employees','departments','positions','toolings','toolList','employeeList', 'departmentData','statusList'));
	}

	public function add () {


		if ($this->request->is('post')) {

			 $this->loadModel('HumanResource.EmployeeAdditionalInformation');

			 $this->loadModel('HumanResource.Email');

			 $this->loadModel('HumanResource.Address');

			 $this->loadModel('HumanResource.GovernmentRecord');

			 $this->loadModel('HumanResource.Contact');

			 $this->loadModel('HumanResource.ContactPerson');

			 $this->loadModel('HumanResource.EmployeeEducationalBackground');

			
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

			 	if ($this->Employee->save($data)) {


			 		$employeeId = $this->Employee->id;
			 		//save additional info
			 		$save = $this->EmployeeAdditionalInformation->saveInfo($employeeId,$data['EmployeeAdditionalInformation']);
			 		//save employee emails
			 		$save = $this->Email->saveEmails($data['Emails'],$employeeId,'Employee',$auth['id']);
					//save employee address
			 		$save = $this->Address->saveAddress($data['Address'],$employeeId,'Employee',$auth['id']);	
			 		//save employee contact
			 		//$this->loadModel('HumanResource.Contact');

			 		$save = $this->Contact->saveContact($data['Contact'],$employeeId,'Employee',$auth['id']);
					//save employee_goverment record
			 		$save = $this->GovernmentRecord->saveRecord($data['EmployeeAgencyRecord'],$employeeId,$auth['id']);

			 		//save educational background
			 		$save = $this->EmployeeEducationalBackground->saveEducation($data['EmployeeEducationalBackground'],$employeeId);

			 		if (!empty($data['ContactPersonData'])) {
						
						$this->ContactPerson->saveContact($data['ContactPersonData'],$employeeId,$auth['id']);
			 		}
					//save contactPerson emails
			 		//$save = $this->Email->saveEmails($employeeId,'ContactPerson',$data['ContactPersonData']['Email'],$auth['id']);

			 		$save = $this->Email->saveEmails($data['ContactPersonData']['Email'],$employeeId,'ContactPerson',$auth['id']);

			 		//$save
			 		$this->Session->setFlash('Saving employee information successfully','success');
			 		   $this->redirect( array(
                                 'controller' => 'employees', 
                                 'action' => 'index'
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

		$positionList = $this->Position->find('list',array('fields' => array('id','name')));

		$departmentList = $this->Department->find('list',array('fields' => array('id','name')));

		$statusList = $this->Status->find('list',array('fields' => array('id','name')));

		$agencyList = $this->Agency->find('all',array('fields' => array('id','name','field')));

		$contractList = $this->Contract->find('list',array('fields' => array('id','name')));

		$this->set(compact('positionList','departmentList','statusList','agencyList','contractList'));
	}

	public function edit($id){
		
		$this->loadModel('HumanResource.EmployeeAdditionalInformation');

		$this->loadModel('HumanResource.Email');

		$this->loadModel('HumanResource.Address');

		$this->loadModel('HumanResource.GovernmentRecord');

		$this->loadModel('HumanResource.Contact');

		$this->loadModel('HumanResource.ContactPerson');

		$this->loadModel('HumanResource.EmployeeEducationalBackground');

		if ($this->request->is('put')) {
			
			foreach ($this->request->data['EducationIdHolder']['id'] as $key => $value) {
				$this->EmployeeEducationalBackground->delete($value);
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
			 		$save = $this->Email->saveEmails($data['Emails'],$employeeId,'Employee',$auth['id']);
					//save employee address
			 		$save = $this->Address->saveAddress($data['Address'],$employeeId,'Employee',$auth['id']);	
			 		//save employee contact
			 		//$this->loadModel('HumanResource.Contact');

			 		$save = $this->Contact->saveContact($data['Contact'],$employeeId,'Employee',$auth['id']);
					//save employee_goverment record
			 		$save = $this->GovernmentRecord->saveRecord($data['EmployeeAgencyRecord'],$employeeId,$auth['id']);

			 		//save educational background
			 		$save = $this->EmployeeEducationalBackground->saveEducation($data['EmployeeEducationalBackground'],$employeeId);

			 		if (!empty($data['ContactPersonData'])) {
						
						$this->ContactPerson->saveContact($data['ContactPersonData'],$employeeId,$auth['id']);
			 		}

					//save contactPerson emails
			 		$save = $this->Email->saveEmails($employeeId,'ContactPerson',$data['ContactPersonData']['Email'],$auth['id']);

			 		$this->Session->setFlash('Saving employee information successfully','success');
			 		   $this->redirect( array(
                                 'controller' => 'employees', 
                                 'action' => 'index'
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
		 $this->loadModel('HumanResource.EmployeeEducationalBackground');

			$this->Employee->bind(array(
				'EmployeeAdditionalInformation',
				'Email',
				'GovernmentRecord',
				'Address',
				'Contact',
				'ContactPerson',
				'ContactPersonEmail',
				'ContactPersonAddress',
				'ContactPersonNumber',
				'EmployeeEducationalBackground'
				));

			$this->request->data = $this->Employee->findById($id);
			//pr($this->request->data);exit();
			if (!empty($_GET['test'])) {
				pr($this->request->data); exit();
			}
			

		}
		$this->loadModel('HumanResource.Position');

		$this->loadModel('HumanResource.Department');

		$this->loadModel('HumanResource.Status');

		$this->loadModel('HumanResource.Agency');

		$this->loadModel('HumanResource.Contract');

		$positionList = $this->Position->find('list',array('fields' => array('id','name')));

		$departmentList = $this->Department->find('list',array('fields' => array('id','name')));

		$statusList = $this->Status->find('list',array('fields' => array('id','name')));

		$agencyList = $this->Agency->find('all',array('fields' => array('id','name','field')));

		$contractList = $this->Contract->find('list',array('fields' => array('id','name')));

		$nameList = array();
		foreach ($agencyList as $key => $value) {
			$nameList[$value['Agency']['id']] = array('name' => $value['Agency']['name'],'field' =>$value['Agency']['field']);
		}
		
		$this->set(compact('positionList','departmentList','statusList','nameList','contractList'));
	}

	function view($id){

		if (!empty($id)) {

		 $this->loadModel('HumanResource.EmployeeAdditionalInformation');

		 $this->loadModel('HumanResource.Email');

		 $this->loadModel('HumanResource.Address');

		 $this->loadModel('HumanResource.GovernmentRecord');

		 $this->loadModel('HumanResource.Contact');

		 $this->loadModel('HumanResource.ContactPerson');

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

				$conditions = array_merge($conditions,array('Attendance.date' => date('Y-m-d')));

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

		if (!empty($this->request->data)) {
			//pr($this->request->data);exit();
			$this->loadModel('HumanResource.Position');
			$this->loadModel('HumanResource.Department');
			$this->loadModel('HumanResource.Status');

			// ini_set('max_execution_time', 3600);
			// ini_set('memory_input_time', 1024);
			// ini_set('max_input_nesting_level', 1024);
			// ini_set('memory_limit', '1024M');

			$this->Employee->bind(array('Position','Department','Status'));

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

			$employeeData = $this->Employee->find('all',array('conditions' => $conditions));
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
		$employeeId = $this->request->data['Tool']['employee_id'];
		
		$conditions = array();

        if (!empty($toolId)) {

        	$conditions = array_merge($conditions,array('Tooling.tools_id' => $employeeId));

        } 

        if (!empty($employeeId)) {

        	$conditions = array_merge($conditions,array('Tooling.employee_id' => $employeeId));

        } 
		
		$toolingData = $this->Tooling->find('all',array('conditions' => $conditions,'order' => 'Tooling.id ASC'));

		$positionList = $this->Position->find('list',array('field' => array('id','name')));

		$departmentList = $this->Department->find('list',array('field' => array('id','name')));
		
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

			echo json_encode(array('emp_number' => $department['Department']['prefix'].'-'.$employee_number ));
			

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
										array('Employee.last_name LIKE' => '%' . $hintKey . '%')
									)
								));

		}

		$employeeData = $this->Employee->find('all',array('conditions' => $conditions));

		$this->set(compact('employeeData'));
		
    	$this->render('search_by_department');
    	

	}
}