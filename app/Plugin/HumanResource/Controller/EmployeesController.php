<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


App::uses('ImageUploader', 'Vendor');

class EmployeesController  extends HumanResourceAppController {

	var $helpers = array('HumanResource.PhpExcel','HumanResource.CustomText');
	//,'HumanResource.Country'
	public function index() {

		$this->loadModel('HumanResource.Department');
		$this->loadModel('HumanResource.Position');
		$this->loadModel('HumanResource.Department');
		$this->loadModel('HumanResource.Tooling');
		$this->loadModel('HumanResource.Status');

		$departmentData = $this->Department->find('list', array('fields' => array('id', 'name')
															));

		//array_push($departmentData, "All");

		$limit = 10;


        $conditions = array();

	 if ( (empty($this->params['named']['model'])) ||  $this->params['named']['model'] == 'Employee' ) {

	 		$this->Employee->bind(array('Status'));

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

		$this->loadModel('HumanResource.Tool');

		$toolList = $this->Tool->find('list',array('fields' => array('id','name')));

        $this->set(compact('employees','departments','positions','toolings','toolList','employeeList', 'departmentData'));
	}

	public function add () {


		if ($this->request->is('post')) {

			 $this->loadModel('HumanResource.EmployeeAdditionalInformation');

			 $this->loadModel('HumanResource.Email');

			 $this->loadModel('HumanResource.Address');

			 $this->loadModel('HumanResource.GovernmentRecord');

			 $this->loadModel('HumanResource.Contact');

			 $this->loadModel('HumanResource.ContactPerson');

			
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

			 		if (!empty($data['ContactPersonData'])) {
						
						$this->ContactPerson->saveContact($data['ContactPersonData'],$employeeId,$auth['id']);
			 		}
					//save contactPerson emails
			 		$save = $this->Email->saveEmails($employeeId,'ContactPerson',$data['ContactPersonData']['Email'],$auth['id']);

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

		$positionList = $this->Position->find('list',array('fields' => array('id','name')));

		$departmentList = $this->Department->find('list',array('fields' => array('id','name')));

		$statusList = $this->Status->find('list',array('fields' => array('id','name')));

		$agencyList = $this->Agency->find('all',array('fields' => array('id','name','field')));

		$this->set(compact('positionList','departmentList','statusList','agencyList'));
	}

	public function edit($id){
		
		$this->loadModel('HumanResource.EmployeeAdditionalInformation');

		 $this->loadModel('HumanResource.Email');

		 $this->loadModel('HumanResource.Address');

		 $this->loadModel('HumanResource.GovernmentRecord');

		 $this->loadModel('HumanResource.Contact');

		 $this->loadModel('HumanResource.ContactPerson');

		if ($this->request->is('put')) {

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

			 		if (!empty($data['ContactPersonData'])) {
						
						$this->ContactPerson->saveContact($data['ContactPersonData'],$employeeId,$auth['id']);
			 		}
					//save contactPerson emails
			 		//$save = $this->Email->saveEmails($employeeId,'ContactPerson',$data['ContactPersonData']['Email'],$auth['id']);


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

			$this->Employee->bind(array(
				'EmployeeAdditionalInformation',
				'Email',
				'GovernmentRecord',
				'Address',
				'Contact',
				'ContactPerson',
				'ContactPersonEmail',
				'ContactPersonAddress',
				'ContactPersonNumber'
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

		$positionList = $this->Position->find('list',array('fields' => array('id','name')));

		$departmentList = $this->Department->find('list',array('fields' => array('id','name')));

		$statusList = $this->Status->find('list',array('fields' => array('id','name')));

		$agencyList = $this->Agency->find('all',array('fields' => array('id','name','field')));

		$nameList = array();
		foreach ($agencyList as $key => $value) {
			$nameList[$value['Agency']['id']] = array('name' => $value['Agency']['name'],'field' =>$value['Agency']['field']);
		}
		
		$this->set(compact('positionList','departmentList','statusList','nameList'));
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
			

			$this->set(compact('employee','departments','positions','nameList'));
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
				$this->Employee->bind(array('Position'));

				$employees = $this->Employee->find('all',array(
					'conditions' => array('Employee.department_id' => $id),
					'order' => array('Employee.last_name','Employee.code'),
					'fields' => array(
					'id',
					'Employee.first_name',
					'Employee.last_name',
					'Employee.middle_name',
					'Employee.position_id',
					'Employee.department_id',
					'Employee.image',
					'Position.name'
					),
					'group' => 'Employee.id' 
				));

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

	public function print_employee($id = null) {
		
		$departmentId = $this->request->data['Department']['department_id'];
		
        if (!empty($this->request->data['from_date'])) {

        	$dateRange = str_replace(' ', '', $this->request->data['from_date']);
       
	        $splitDate = split('-', $dateRange);
	        $from = str_replace('/', '-', $splitDate[0]);
	        $to = str_replace('/', '-', $splitDate[1]);

	        $employeeData = $this->Employee->find('all', array(
                'conditions' => array(
                    'AND' => array(
                        'Employee.department_id' => $departmentId,
                        'Employee.created BETWEEN ? AND ?' => array($from.' '.'00:00:00:', $to.' '.'23:00:00:')
                    ),
                ),
                'order' => 'Employee.id DESC'
            ));

        } else {

        	$employeeData = $this->Employee->find('all',array('conditions' => array('Employee.department_id' => $departmentId)));

        }
		//pr($employeeData);exit();
		$this->set(compact('employeeData'));
		$this->render('Employees/xls/employee_report');

	}

	public function print_tool($id = null) {
		
		$this->loadModel('HumanResource.Tooling');

		$toolId = $this->request->data['Tool']['tool_id'];
		$employeeId = $this->request->data['Tool']['employee_id'];
		
        if (!empty($employeeId)) {

	        $toolingData = $this->Tooling->find('all', array(
                'conditions' => array(
                    'AND' => array(
                        'Tooling.tool_id' => $toolId,
                        'Tooling.tool_id' => $employeeId,
                    ),
                ),
                'order' => 'Tooling.id DESC'
            ));

        } else {

        	$toolingData = $this->Tooling->find('all',array('conditions' => array('Tooling.tool_id' => $toolId)));

        }
		pr($toolingData);exit();
		// $this->set(compact('toolingData'));
		// $this->render('Employees/xls/tool_report');

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
				'middle_name like' => '%'.$data['middle_name'].'%',

			));

			$employee = $this->Employee->find('count',array(
				'conditions' => $conditions
				));


			echo json_encode($employee);

		}

		exit();
	}

}