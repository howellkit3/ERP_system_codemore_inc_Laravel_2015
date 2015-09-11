<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');
App::import('Vendor', 'DOMPDF', true, array(), 'dompdf'.DS.'dompdf_config.inc.php', false);

class ContractsController  extends HumanResourceAppController {

	//var $helpers = array('HumanResource.CustomText','HumanResource.Country');
	public $uses = array('HumanResource.Employee');

	public function index() {
		
		$this->loadModel('HumanResource.Contract');
		$this->Employee->bind(array('Position','Department','Status'));
		$employeeData = $this->Employee->find('all',array('order' => array('Employee.id' => 'ASC' )));
		
		$contract = $this->Contract->find('list',array('fields' => array('id','name')));
		
		$this->set(compact('employeeData','contract'));

	}

	public function view($id = null ) {

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.EmployeeAdditionalInformation');

		$this->loadModel('HumanResource.Address');

		$this->loadModel('HumanResource.Salary');

		$this->loadModel('HumanResource.GovernmentRecord');

		$this->Employee->bind(array('Position','Department','EmployeeAdditionalInformation','Address','Status','Salary','SSS','PhilHealth','TIN','Pagibig'));

		$auth = $this->Session->read('Auth.User');
		
		if (!empty($id)) {

			$employeeData = $this->Employee->findById($id);
		}

		$this->set(compact('employeeData'));
		//probational
		if ($employeeData['Employee']['contract_id'] == 1) {
			$this->render('prob_contract');
		}

	}

	public function print_contract($id = null){

		$this->loadModel('HumanResource.Employee');

		$this->loadModel('HumanResource.EmployeeAdditionalInformation');

		$this->loadModel('HumanResource.Address');

		$this->loadModel('HumanResource.GovernmentRecord');

		$this->loadModel('HumanResource.Salary');

		$this->Employee->bind(array('Position','Department','EmployeeAdditionalInformation','Address','Status','Salary','SSS','PhilHealth','TIN','Pagibig'));

		$auth = $this->Session->read('Auth.User');
		
		if (!empty($id)) {

			$employeeData = $this->Employee->findById($id);

		}
		
		$view = new View(null, false);

		$view->set(compact('employeeData'));
		
		$view->viewPath = 'Contracts'.DS.'pdf';	

		if ($employeeData['Employee']['contract_id'] == 2) {
			$output = $view->render('print_contractual', false);
		}

		if ($employeeData['Employee']['contract_id'] == 1) {
			$output = $view->render('print_probational', false);
		}
   
        
   	
        $dompdf = new DOMPDF();
        $dompdf->set_paper("A4");
        $dompdf->load_html(utf8_decode($output), Configure::read('App.encoding'));
        $dompdf->render();
        $canvas = $dompdf->get_canvas();
        $font = Font_Metrics::get_font("helvetica", "bold");
        //$canvas->page_text(16, 800, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, array(0,0,0));

        $output = $dompdf->output();
        $random = rand(0, 1000000) . '-' . time();
        if (empty($filename)) {
        	$filename = 'Contract-contractual'.time();
        }
      	$filePath = 'view_pdf/'.strtolower(Inflector::slug( $filename , '-')).'.pdf';
        $file_to_save = WWW_ROOT .DS. $filePath;
        	
        if ($dompdf->stream( $file_to_save, array( 'Attachment'=>0 ) )) {
        		unlink($file_to_save);
        }
        
        exit();
	}

}