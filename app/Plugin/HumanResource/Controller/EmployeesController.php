<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


App::uses('ImageUploader', 'Vendor');

class EmployeesController  extends HumanResourceAppController {

	var $helpers = array('HumanResource.CustomText');

	public function index() {

		 $limit = 10;

        $conditions = array();

        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            //'fields' => array('id', 'status','created'),
            'order' => 'Employee.id DESC',
        );

        $employees = $this->paginate();

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

        $this->set(compact('employees','departments','positions'));
	}

	public function add () {


		if ($this->request->is('post')) {

			  $uploader = new ImageUploader;
        
			 if(!empty($this->request->data)){

			 //	pr($this->request->data); exit();

			 	if (!empty($this->request->data['Employee']['file']['name'])) {

					$file = $this->request->data['Employee']['file'];
              
                    if ($this->request->data['Employee']['file']['error'] == 0 ) {
                       $time = time();
                       $file['name'] = $uploader->resize($file, $time,'employee');
                        
                    }
               
                	$this->request->data['Employee']['image'] = $file['name'];
            }


			 	if ($this->Employee->save($this->request->data)) {

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

		if ($this->request->is('put')) {

			  $uploader = new ImageUploader;
        
			 if(!empty($this->request->data)){

			 	if (!empty($this->request->data['Employee']['file']['name'])) {

					$file = $this->request->data['Employee']['file'];
              
                    if ($this->request->data['Employee']['file']['error'] == 0 ) {
                       $time = time();
                       $file['name'] = $uploader->resize($file, $time,'employee');
                        
                    }
               
                	$this->request->data['Employee']['image'] = $file['name'];
           		 }


			 	if ($this->Employee->save($this->request->data)) {

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

			$this->request->data = $this->Employee->findById($id);

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


}