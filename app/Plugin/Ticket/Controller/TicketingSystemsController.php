<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');
App::import('Vendor', 'DOMPDF', true, array(), 'dompdf'.DS.'dompdf_config.inc.php', false);

class TicketingSystemsController extends TicketAppController {

	public $uses = array('Ticket.JobTicket');

	public $helpers = array('Sales.Country','Sales.Status','Cache','Sales.DateFormat');

	public function beforeFilter() {

        parent::beforeFilter();

        $userData = $this->Session->read('Auth');

        $this->Auth->allow('index');

        $this->set(compact('userData'));

    }
	    	    
	public function index() {

        $this->JobTicket->bindTicket();

        $ticketData = $this->JobTicket->find('all', array(
                                        'order' => 'JobTicket.id DESC'
                                        ));

		$this->loadModel('Sales.Company');

		$companyData = $this->Company->find('list',array('fields' => array('id','company_name')));

		$this->set(compact('ticketData','companyData'));
	
	}

	public function view($productUuid = null,$ticketId = null,$clientOrderId = null) {

        $this->loadModel('Sales.ProductSpecificationDetail');

        $this->loadModel('Sales.ProductSpecification');

        $this->loadModel('Unit');

        $this->loadModel('SubProcess');

        $this->loadModel('Sales.Product');

        $this->loadModel('Sales.Company');

        $this->loadModel('Sales.ClientOrder');

        $this->ClientOrder->bind(array('ClientOrderDeliverySchedule'));

        $delData = $this->ClientOrder->find('first',array('id' => $clientOrderId));

        $ticketData = $this->JobTicket->find('first',array('conditions' =>array('id' => $ticketId)));

        $companyData = $this->Company->find('list',
                                            array('fields' => 
                                                array('Company.id',
                                                    'Company.company_name'
                                                 )
                                                ));

        $productData = $this->Product->find('first',array('conditions' => array('Product.uuid' => $productUuid )));

        $subProcess = $this->SubProcess->find('list',
                                            array('fields' => 
                                                array('SubProcess.id',
                                                    'SubProcess.name'
                                                 )
                                                ));

        //set to cache in first load
        $unitData = Cache::read('unitData');
        
        if (!$unitData) {
            
            $unitData = $this->Unit->find('list', array('fields' => array('id', 'unit'),
                                                            'order' => array('Unit.unit' => 'ASC')
                                                            ));

            Cache::write('unitData', $unitData);
        }

        $specs = $this->ProductSpecification->find('first',array('conditions' => array('ProductSpecification.product_id' => $productData['Product']['id'])));
        
		//find if product has specs
        $formatDataSpecs = $this->ProductSpecificationDetail->findData($productUuid);

		
		$this->set(compact('delData','ticketData','formatDataSpecs','specs','unitData','subProcess','productData','companyData','clientOrderId'));
	}

	public function updatePendingStatus($ticketId = null) {

		$this->Ticket->updateStatus($ticketId);

    	$this->redirect(

         array('controller' => 'ticketing_systems', 
            	'action' => 'view',
            	 $ticketId

          ));	
	}

	public function finishedJob($ticketId = null){

		$this->Ticket->finishedJob($ticketId);

		$this->redirect(

        array('controller' => 'ticketing_systems', 
             	'action' => 'view',
             	 $ticketId

        ));

	}

	public function create_ticket($productUuid = null){
		
		$userData = $this->Session->read('Auth');

		$this->loadModel('Sales.Product');

		//$productData = $this->Product->find('first',array('conditions' => array('Product.uuid' => $productUuid)));
		//pr($productData);exit();
		$this->JobTicket->saveTicket($productUuid,$userData['User']['id']);

		
		$this->Session->setFlash(
            __('Create Job Ticket successfully completed', 'success')
        );
        
		return $this->redirect(array('controller' => 'ticketing_systems', 'action' => 'index'));
	}

	public function print_ticket($productUuid = null,$ticketUuid = null, $clientOrderId = null ){

    	$userData = $this->Session->read('Auth');

    	$this->loadModel('Sales.ProductSpecification');

    	$this->loadModel('Sales.ProductSpecificationDetail');

    	$this->loadModel('Sales.Company');

    	$this->loadModel('Sales.Product');

        $this->loadModel('Sales.ClientOrder');

    	$this->loadModel('Unit');

        $this->ClientOrder->bind(array('ClientOrderDeliverySchedule'));

        $delData = $this->ClientOrder->find('first',array('id' => $clientOrderId));
       
    	$productData = $this->Product->find('first',array(
    		'conditions' => array('Product.uuid' => $productUuid)));

    	$specs = $this->ProductSpecification->find('first',array('conditions' => array('ProductSpecification.product_id' => $productData['Product']['id'])));

    	//find if product has specs
		$formatDataSpecs = $this->ProductSpecificationDetail->findData($productUuid);

		$this->loadModel('SubProcess');

		$subProcess = $this->SubProcess->find('list',
											array('fields' => 
												array('SubProcess.id',
												 	'SubProcess.name'
												 )
												));

		//set to cache in first load
		$companyData = Cache::read('companyData');
		
		//if (!$companyData) {
			$companyData = $this->Company->find('list', array(
     											'fields' => array( 
     												'id','company_name')
     										));

            Cache::write('companyData', $companyData);
       	// }

        //set to cache in first load
		$unitData = Cache::read('unitData');
		
		if (!$unitData) {
			
			$unitData = $this->Unit->find('list', array('fields' => array('id', 'unit'),
															'order' => array('Unit.unit' => 'ASC')
															));

            Cache::write('unitData', $unitData);
        }
		
    	$view = new View(null, false);
		//pr($formatDataSpecs);exit();
		$view->set(compact('formatDataSpecs','productData','specs','companyData','unitData','subProcess','ticketUuid','delData'));
        
		$view->viewPath = 'Products'.DS.'pdf';	
   
        $output = $view->render('print_specs', false);
   	
        $dompdf = new DOMPDF();
        $dompdf->set_paper("A4");
        $dompdf->load_html(utf8_decode($output), Configure::read('App.encoding'));
        $dompdf->render();
        $canvas = $dompdf->get_canvas();
        $font = Font_Metrics::get_font("helvetica", "bold");
        $canvas->page_text(16, 800, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, array(0,0,0));

        $output = $dompdf->output();
        $random = rand(0, 1000000) . '-' . time();
        if (empty($filename)) {
        	//$filename = 'product-'.$quotation['ProductDetail']['name'].'-quotation'.time();
        	$filename = 'product-'.$productUuid.'-specification'.time();
        }
      	$filePath = 'view_pdf/'.strtolower(Inflector::slug( $filename , '-')).'.pdf';
        $file_to_save = WWW_ROOT .DS. $filePath;
        	
        if ($dompdf->stream( $file_to_save, array( 'Attachment'=>0 ) )) {
        		unlink($file_to_save);
        }
        
        exit();
    }

}
