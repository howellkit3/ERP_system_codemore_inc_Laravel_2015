<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


App::uses('ImageUploader', 'Vendor');

class EmployeesController  extends HumanResourceAppController {

	var $helpers = array('HumanResource.CustomText','HumanResource.Country');

	public function index() {

		$limit = 10;


        $conditions = array();

	 if ( (empty($this->params['named']['model'])) ||  $this->params['named']['model'] == 'Employee' ) {

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

		      // $this->Tooling->bind(array('Employee'));

		        $this->paginate = array(
		            'conditions' => $conditions,
		            'limit' => $limit,
		            //'fields' => array('id', 'status','created'),
		            'order' => 'Tooling.id DESC',
		        );

		        $toolings = $this->paginate('Tooling');
	    }

        $departments = array('' => 'Select Department',
                        	'1' => 'Accounting',
                        	'2' => 'Sales',
                        	'3' => 'Delivery'
                        );

         $positions = array('' => 'Select Position',
		                	'1' => 'CEO',
		                	'2' => 'Vice President',
		                	'3' => 'Employee',
		                	'4' => 'Others'
		                	);

        $this->set(compact('employees','departments','positions','toolings'));
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
			 		//$save = $this->Email->saveEmails($employeeId,'ContactPerson',$data['ContactPersonData']['Email'],$auth['id']);

			 		//$save
			 		$this->Session->setFlash('Saving employee information successfully');
			 		   $this->redirect( array(
                                 'controller' => 'employees', 
                                 'action' => 'index'
                            ));
                
                	} else {

			 		$this->Session->setFlash('There\'s an error saving employee information');
			 	}

			 } 
		}
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


			 		$this->Session->setFlash('Saving employee information successfully');
			 		   $this->redirect( array(
                                 'controller' => 'employees', 
                                 'action' => 'index'
                            ));
                
                	} else {

			 		$this->Session->setFlash('There\'s an error saving employee information');
			 	}

			 } 
		}


		if (!empty($id)) {



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
	}

	function view($id){

		if (!empty($id)) {

			$employee = $this->Employee->findById($id);

			$departments = array('' => 'Select Department',
                        	'1' => 'Accounting',
                        	'2' => 'Sales',
                        	'3' => 'Delivery'
                        );

         	$positions = array('' => 'Select Position',
		                	'1' => 'CEO',
		                	'2' => 'Vice President',
		                	'3' => 'Employee',
		                	'4' => 'Others'
		                	);

			$this->set(compact('employee','departments','positions'));
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


}