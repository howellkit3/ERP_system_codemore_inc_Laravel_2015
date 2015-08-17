<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');
App::import('Vendor', 'DOMPDF', true, array(), 'dompdf'.DS.'dompdf_config.inc.php', false);


class CauseMemosController  extends HumanResourceAppController {

	public function index() {

		$this->loadModel('HumanResource.Violation');

		$this->loadModel('HumanResource.DisciplinaryAction');

		$this->loadModel('HumanResource.CauseMemo');

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.Violation');

		$this->loadModel('User');

		$violationData = $this->Violation->find('all');

		$disciplinaryActionData = $this->DisciplinaryAction->find('all');

		$causeMemoData = $this->CauseMemo->find('all');

		$UserCreated = $this->User->find('list', array('fields' => array('id', 'fullname')
															));

		$employeeName = $this->Employee->find('list', array('fields' => array('id', 'fullname')
															));

		$violationTableData= $this->Violation->find('list', array('fields' => array('id', 'name')
															));

		$this->set(compact('violationData', 'UserCreated', 'disciplinaryActionData', 'causeMemoData', 'employeeName', 'violationTableData'));

	}

	public function add() {

		$userData = $this->Session->read('Auth');

		$this->loadModel('HumanResource.CauseMemo');

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.Violation');

		$this->loadModel('HumanResource.DisciplinaryAction');
		
		$employeeData = $this->Employee->find('list', array('fields' => array('id', 'full_name'),
															'order' => array('Employee.last_name' => 'ASC')
															));

		$violationData = $this->Violation->find('list', array('fields' => array('id', 'name'),
															'order' => array('Violation.name' => 'ASC')
															));

		$notedByEmployee = $this->Employee->find('list', array('fields' => array('id', 'fullname'),
															  'conditions' => array('Employee.department_id' => '6'),
                                                                'order' => 'Employee.last_name ASC'));

		$disciplinaryData = $this->DisciplinaryAction->find('list', array('fields' => array('id', 'name'),
                                                                'order' => 'DisciplinaryAction.id ASC'));

		if ($this->request->is(array('post', 'put'))) {

			$this->CauseMemo->saveCauseMemo($this->request->data,$userData['User']['id']);

			$this->Session->setFlash(__('Cause Memo has been saved'), 'success');
          
            $this->redirect( array(
                'controller' => 'cause_memos',   
                'action' => 'index'
            ));  

		}
	
		$this->set(compact('employeeData', 'violationData', 'notedByEmployee', 'disciplinaryData'));
		

	}
	
	public function add_violation($id = null) {

		$userData = $this->Session->read('Auth');

		$this->loadModel('HumanResource.DisciplinaryAction');

		$this->loadModel('HumanResource.Violation');

		$disciplinaryData = $this->DisciplinaryAction->find('list', array('fields' => array('id', 'name'),
                                                                'order' => 'DisciplinaryAction.id ASC'));

		if ($this->request->is(array('post', 'put'))) {

			$this->Violation->saveViolation($this->request->data,$userData['User']['id']);

			$this->Session->setFlash(__('Violation has been saved'), 'success');
          
            $this->redirect( array(
                'controller' => 'cause_memos',   
                'action' => 'index','tab' => 'tab-violation'
            ));  

		}

		$this->set(compact('disciplinaryData'));

	}

	public function add_disciplinary_action($id = null) {

		$userData = $this->Session->read('Auth');

		$this->loadModel('HumanResource.DisciplinaryAction');

		$this->loadModel('HumanResource.Violation');

		$disciplinaryData = $this->DisciplinaryAction->find('list', array('fields' => array('id', 'name'),
                                                                'order' => 'DisciplinaryAction.id ASC'));

		$violationData = $this->Violation->find('list', array('fields' => array('id', 'name'),
															'order' => array('Violation.id' => 'ASC')
															));

		if ($this->request->is(array('post', 'put'))) {

			$this->DisciplinaryAction->saveDisciplinaryAction($this->request->data,$userData['User']['id']);

			$this->Session->setFlash(__('Disciplinary Action has been saved'), 'success');
          
            $this->redirect( array(
                'controller' => 'cause_memos',   
                'action' => 'index','tab' => 'tab-disciplinary'
            ));  

		}

		$this->set(compact('disciplinaryData', 'violationData'));


	}

	public function edit($id = null) {


		$userData = $this->Session->read('Auth');

		$this->loadModel('HumanResource.CauseMemo');

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.Violation');

		$this->loadModel('HumanResource.DisciplinaryAction');
		
		$employeeData = $this->Employee->find('list', array('fields' => array('id', 'full_name'),
															'order' => array('Employee.last_name' => 'ASC')
															));

		$violationData = $this->Violation->find('list', array('fields' => array('id', 'name'),
															'order' => array('Violation.id' => 'ASC')
															));

		$notedByEmployee = $this->Employee->find('list', array('fields' => array('id', 'fullname'),
															  'conditions' => array('Employee.department_id' => '6'),
                                                                'order' => 'Employee.last_name ASC'));

		$disciplinaryData = $this->DisciplinaryAction->find('list', array('fields' => array('id', 'name')));

		$causeMemoData = $this->CauseMemo->find('first', array('conditions' => array('CauseMemo.id' => $id)
                                                               ));

		$this->set(compact('causeMemoData', 'disciplinaryData', 'notedByEmployee','violationData','employeeData'));


		if ($this->request->is(array('post', 'put'))) {

			//pr($this->request->data); exit;

			 $this->CauseMemo->editCauseMemo($this->request->data,$userData['User']['id']);

			 $this->Session->setFlash(__('Cause Memo has been updated'), 'success');
          
            $this->redirect( array(
                'controller' => 'cause_memos',   
                'action' => 'index'
            ));  

		}

	}

	public function edit_violation($id = null) {


		$userData = $this->Session->read('Auth');

		$this->loadModel('HumanResource.Violation');


		$violationTableData = $this->Violation->find('first', array('conditions' => array('Violation.id' => $id)
                                                               ));

		$this->set(compact('violationTableData'));


		if ($this->request->is(array('post', 'put'))) {

			//pr($this->request->data); exit;

			 $this->Violation->editViolation($this->request->data,$userData['User']['id']);

			 $this->Session->setFlash(__('Violation has been updated'), 'success');
          
            $this->redirect( array(
                'controller' => 'cause_memos',   
                'action' => 'index','tab' => 'tab-violation'
            ));  

		}

	}

	public function edit_disciplinary_action($id = null) {


		$userData = $this->Session->read('Auth');

		$this->loadModel('HumanResource.DisciplinaryAction');

		$DisciplinaryActionData = $this->DisciplinaryAction->find('first', array('conditions' => array('DisciplinaryAction.id' => $id)
                                                               ));

		$this->set(compact('DisciplinaryActionData'));


		if ($this->request->is(array('post', 'put'))) {

			//pr($this->request->data); exit;

			 $this->DisciplinaryAction->editDisciplinaryAction($this->request->data,$userData['User']['id']);

			 $this->Session->setFlash(__('DisciplinaryAction has been updated'), 'success');
          
            $this->redirect( array(
                'controller' => 'cause_memos',   
                'action' => 'index','tab' => 'tab-disciplinary'
            ));  

		}

	}

	public function print_cause_memo($id = null) {


		$userData = $this->Session->read('Auth');

		$this->loadModel('HumanResource.CauseMemo');

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.Violation');

		$this->loadModel('HumanResource.Department');

		$this->loadModel('HumanResource.DisciplinaryAction');

		$this->loadModel('HumanResource.Position');

		$positionData = $this->Position->find('list', array('fields' => array('id', 'name'),
                                                                'order' => 'Position.id ASC'));	

		$causeMemoData = $this->CauseMemo->find('first', array('conditions' => array('CauseMemo.id' => $id)
                                                               ));

		$employeeData = $this->Employee->find('first', array('conditions' => array('Employee.id' => $causeMemoData['CauseMemo']['employee_id'])
                                                               ));

		$employeeName = $this->Employee->find('list', array('fields' => array('id', 'fullname')
															));

		$department = $this->Department->find('list', array('fields' => array('id', 'name')
															));

		$violationData = $this->Violation->find('list', array('fields' => array('id', 'name'),
															'order' => array('Violation.id' => 'ASC')
															));

		$disciplinaryData = $this->DisciplinaryAction->find('list', array('fields' => array('id', 'name'),
                                                                'order' => 'DisciplinaryAction.id ASC'));	

		$view = new View(null, false);

		$view->set(compact('causeMemoData', 'employeeData', 'employeeName', 'department', 'violationData', 'disciplinaryData', 'userData', 'positionData'));
        
		$view->viewPath = 'CauseMemo'.DS.'pdf';	
   
        $output = $view->render('print_cause_memo', false);
   	
        $dompdf = new DOMPDF();
        $dompdf->set_paper("A4");
        $dompdf->load_html(utf8_decode($output), Configure::read('App.encoding'));
        $dompdf->render();
        $canvas = $dompdf->get_canvas();
        $font = Font_Metrics::get_font("verdana", "bold");
        $canvas->page_text(16, 800, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, array(0,0,0));

        $output = $dompdf->output();
        $random = rand(0, 1000000) . '-' . time();
        if (empty($filename)) {
        	$filename = 'cause_memo-'.$causeMemoData['CauseMemo']['uuid'].'-request'.time();
        }
      	$filePath = 'view_pdf/'.strtolower(Inflector::slug( $filename , '-')).'.pdf';
        $file_to_save = WWW_ROOT .DS. $filePath;
        	
        if ($dompdf->stream( $file_to_save, array( 'Attachment'=>0 ) )) {
        		unlink($file_to_save);
        }
        
        exit();  

	}

	public function view($id = null) {

		$userData = $this->Session->read('Auth');

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.Department');

		$this->loadModel('HumanResource.Violation');

		$this->loadModel('HumanResource.DisciplinaryAction');

		$this->loadModel('HumanResource.Position');

		$requestId = $id;

		$causeMemoData = $this->CauseMemo->find('first', array('conditions' => array('CauseMemo.id' => $id)
                                                               ));

		$employeeData = $this->Employee->find('first', array('conditions' => array('Employee.id' => $causeMemoData['CauseMemo']['employee_id'])
                                                               ));

		$employeeName = $this->Employee->find('list', array('fields' => array('id', 'fullname')
															));


		$department = $this->Department->find('list', array('fields' => array('id', 'name')
															));

		$violationData = $this->Violation->find('list', array('fields' => array('id', 'name'),
															'order' => array('Violation.id' => 'ASC')
															));

		$disciplinaryData = $this->DisciplinaryAction->find('list', array('fields' => array('id', 'name'),
                                                                'order' => 'DisciplinaryAction.id ASC'));	

		$positionData = $this->Position->find('list', array('fields' => array('id', 'name'),
                                                                'order' => 'Position.id ASC'));	

  		$this->set(compact('requestId', 'causeMemoData', 'employeeName', 'department', 'employeeSection', 'employeeData', 'violationData', 'disciplinaryData', 'userData', 'positionData'));

	}

	public function approve_request($id = null) {

		$userData = $this->Session->read('Auth');

		$this->loadModel('HumanResource.CauseMemo');

		$this->CauseMemo->id = $id;

		$this->CauseMemo->saveField('status_id', 1);

		$this->Session->setFlash(__('Cause Memo has been approved'), 'success');
      
        $this->redirect( array(
            'controller' => 'cause_memos',   
            'action' => 'index'
        ));  

	}

	public function terminate_request($id = null) {

		$userData = $this->Session->read('Auth');

		$this->loadModel('HumanResource.CauseMemo');

		$this->CauseMemo->id = $id;

		$this->CauseMemo->saveField('status_id', 5);

		$this->Session->setFlash(__('Cause Memo has been terminated'), 'success');
      
        $this->redirect( array(
            'controller' => 'cause_memos',   
            'action' => 'index'
        ));  

	}

	public function close_request($id = null) {

		$userData = $this->Session->read('Auth');

		$this->loadModel('HumanResource.CauseMemo');

		$this->CauseMemo->id = $id;

		$this->CauseMemo->saveField('status_id', 10);

		$this->Session->setFlash(__('Cause Memo has been closed'), 'success');
      
        $this->redirect( array(
            'controller' => 'cause_memos',   
            'action' => 'index'
        ));  


	}

	public function search_memo($hint = null){

       $this->loadModel('HumanResource.Violation');

		$this->loadModel('HumanResource.DisciplinaryAction');

		$this->loadModel('HumanResource.CauseMemo');

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.Violation');

		$this->loadModel('User');

		$this->CauseMemo->bind(array(
				'Employee'
				));

        $CauseMemoData = $this->CauseMemo->find('all',array(
                      'conditions' => array(
                        'OR' => array(
                        array('CauseMemo.uuid LIKE' => '%' . $hint . '%'),
                        array('Employee.first_name LIKE' => '%' . $hint . '%'),
                        array('Employee.last_name LIKE' => '%' . $hint . '%')
                          )
                        ),
                      'limit' => 10
                      )); 

        $violationData = $this->Violation->find('all');

		$disciplinaryActionData = $this->DisciplinaryAction->find('all');

		$causeMemoData = $this->CauseMemo->find('all');

		$UserCreated = $this->User->find('list', array('fields' => array('id', 'fullname')
															));

		$employeeName = $this->Employee->find('list', array('fields' => array('id', 'fullname')
															));

		$violationTableData= $this->Violation->find('list', array('fields' => array('id', 'name')
															));

		$this->set(compact('violationData', 'UserCreated', 'disciplinaryActionData', 'causeMemoData', 'employeeName', 'violationTableData', 'CauseMemoData'));
  
        if ($hint == ' ') {
            $this->render('index');
        }else{
            $this->render('search_memo');
        }
    }
	
}