<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');
App::import('Vendor', 'DOMPDF', true, array(), 'dompdf'.DS.'dompdf_config.inc.php', false);

class TicketingSystemsController extends TicketAppController {

	public $uses = array('Ticket.JobTicket');

	//public $helpers = array('Ticket.PhpExcel','Sales.Country','Sales.Status','Cache','Sales.DateFormat');
    public $helpers = array('Ticket.PhpExcel','Ticket.PlateMaking');
	public function beforeFilter() {

        parent::beforeFilter();

        $userData = $this->Session->read('Auth');

        $this->Auth->allow('index');

        $this->set(compact('userData'));

    }
	    	    
	public function index() {

        $this->loadModel('Sales.Company');

        $limit = 10;

        $conditions = array();

              $this->JobTicket->bindTicket();

        $query = $this->request->query;

        if (!empty($query)) {

            if (!empty($query['name'])){

                $conditions = array_merge($conditions,array(
                    'OR' => array(
                          'JobTicket.uuid like' => '%'.$query['name'].'%',
                          'JobTicket.po_number like' => '%'.$query['name'].'%',
                          //'Product.name like' => '%'.$query['name'].'%',
                        )
                      
                ));
            }

        }

   

        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            //'fields' => array('id', 'status','created'),
            'order' => 'JobTicket.id DESC',
        );


        $ticketData = $this->paginate('JobTicket');

		$companyData = $this->Company->find('list',array('fields' => array('id','company_name')));

		$this->set(compact('ticketData','companyData'));

        if ($this->request->is('ajax')) {

            $this->render('TicketingSystems/ajax/index');
        }
	
	}

	public function view($productUuid = null,$ticketId = null,$clientOrderId = null) {

        $userData = $this->Session->read('Auth');

        $this->loadModel('Sales.ProductSpecificationDetail');

        $this->loadModel('Sales.ProductSpecification');

        $this->loadModel('Unit');

        $this->loadModel('Machine');

        $this->loadModel('SubProcess');

        $this->loadModel('Sales.Product');

        $this->loadModel('Sales.Company');

        $this->loadModel('Sales.ClientOrder');

        $this->ClientOrder->bind(array('ClientOrderDeliverySchedule'));

        $delData = $this->ClientOrder->find('first',array('conditions' => array('id' => $clientOrderId)));

        $ticketData = $this->JobTicket->find('first',array('conditions' =>array('id' => $ticketId)));

        $companyData = $this->Company->find('list',
                                            array('fields' => 
                                                array('Company.id',
                                                    'Company.company_name'
                                                 )
                                                ));

        $productData = $this->Product->find('first',array('conditions' => array('Product.uuid' => $productUuid) ,'order' => 'Product.id DESC'));


         // pr( $productData );

        $subProcessData = $this->SubProcess->find('list',
                                            array('fields' => 
                                                array('SubProcess.id',
                                                    'SubProcess.name'
                                                 )
                                                ));

        $machines = $this->Machine->find('list', array('fields' => 
                                                array('id',
                                                    'name'
                                                 )
                                                ));
        //$subProcess =  $subProcess['SubProcess'];

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

        //no permission sales
        if ($userData['User']['role_id'] == 3 OR $userData['User']['role_id'] == 8) {
            $noPermissionSales = 'disabled';
        }else{
            $noPermissionSales = ' ';
        }

		
		$this->set(compact('userData','delData','ticketData','formatDataSpecs','specs','machines','unitData','subProcess','productData','companyData','clientOrderId','noPermissionSales','subProcessData'));
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

    public function find_process($processId = null, $productId = null , $ticketId = null,$product = null, $formProcesId = null) {

        $query = $this->request->query;

        $this->autoRender = false;

        if (!empty($processId) && !empty($productId) && !empty($formProcesId)) {

            $parameter['processId'] = $processId;

            $parameter['productId'] = $productId;

            $parameter['ticketId'] = $ticketId;


            $parameter['product'] = $product;

            $parameter['formProcesId'] = $formProcesId;

            $this->set(compact('parameter'));


            if (in_array($processId,array('11','61',))) {

                $this->render('TicketingSystems/forms/cutting', false);

            } else if (in_array($processId,array('21'))) {

                $this->loadModel('Ticket.PlateMakingProcess');

                $this->loadModel('Machine');

                $machines = $this->Machine->find('list',array(
                    'conditions' => array(),
                    'order' => array('Machine.name DESC')
                ));

                $this->request->data = $this->PlateMakingProcess->find('first',array(
                    'conditions' => array(
                            'PlateMakingProcess.job_ticket_id' =>  $ticketId,
                            'PlateMakingProcess.process_id' => $processId,
                            'PlateMakingProcess.product' => $product
                    )
                ));

                $this->set(compact('machines'));
                
                $this->render('TicketingSystems/forms/offset', false);

            } else if (in_array($processId,array('20'))) {
                 $this->render('TicketingSystems/forms/wood_mould', false);
             } else {

                echo "no Forms Yet";
             }

        }

    }


    public function save_job_ticket_process() {

        $this->loadModel('Ticket.WoodMoldJobTicket');

        $this->loadModel('Ticket.CuttingJobTicket');

        $auth = $this->Session->read('Auth.User');

        if (!empty($this->request->data)) {

            $type = $this->params['named']['type'];

            if (!empty($type)) {
                $data = array();
                switch ($type) {
                    case 'wood_mold':
                     $model = 'WoodMoldJobTicket';  

                     $data['WoodMoldJobTicket'] = $this->request->data['JobTicketProcess'];

                   

                    break;
                    case 'cutting':
                     $model = 'CuttingJobTicket';  

                     $data['CuttingJobTicket'] = $this->request->data['JobTicketProcess'];

                    break;    
                    default:
                        # code...
                    break;
                }


                if (!empty($model)) {

                      $data[$model]['created_by'] = $auth['id'];
                      $data[$model]['modified_by'] = $auth['id'];

                    if ( $this->$model->save($data)) {

                        $lastID = $this->$model->id;

                        $this->redirect(array(
                            'controller' => 'ticketing_systems', 
                            'action' => 'print_process',
                            $data[$model]['process_id'],
                            $data[$model]['product_id'],
                            $data[$model]['job_ticket_id'],
                            $model,
                            $lastID));
                       
                    }
                } else {

          $this->Session->setFlash(
            __('Job Ticket failed', 'error')
        );

        return $this->redirect(array('controller' => 'ticketing_systems', 
                'action' => 'view',
                  $data['WoodMoldJobTicket']['product_id'],
                $data['WoodMoldJobTicket']['job_ticket_id'],
                $this->request->data['JobTicket']['client_order_id']));
                }
            }

        }
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

        $delData = $this->ClientOrder->find('first',array('ClientOrder.id' => $clientOrderId));
       
    	$productData = $this->Product->find('first',array(
    		'conditions' => array('Product.uuid' => $productUuid)));

        $ticketData = $this->JobTicket->find('first',array(
            'conditions' => array('JobTicket.uuid' => $ticketUuid)));

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
		$view->set(compact('userData','ticketData','formatDataSpecs','productData','specs','companyData','unitData','subProcess','ticketUuid','delData'));
        
		$view->viewPath = 'Products'.DS.'pdf';	
   
        $output = $view->render('print_specs', false);
   	   
        $dompdf = new DOMPDF();
        $dompdf->set_paper("A4");
        //$output = mb_convert_encoding($output, 'HTML-ENTITIES', 'UTF-8');
        $dompdf->load_html($output);
        $dompdf->load_html($output, 'UTF-8');
        $dompdf->render();
        $canvas = $dompdf->get_canvas();
        $font = "DejaVu Sans";
        //body { font-family: DejaVu Sans, sans-serif; }
        //$pdf->SetFont('dejavusans', '', 14, '', true);
        $canvas->page_text(16, 800, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, array(0,0,0));
        //
        $output = $dompdf->output();
        
        $random = rand(0, 1000000) . '-' . time();
        if (empty($filename)) {
        	//$filename = 'product-'.$quotation['ProductDetail']['name'].'-quotation'.time();
        	$filename = 'product-'.$productUuid.'-specification'.time();
        }
      	$filePath = 'view_pdf/'.strtolower(Inflector::slug( $filename , '-')).'.pdf';
        $file_to_save = WWW_ROOT .DS. $filePath;
         //pr($output);exit();	
        if ($dompdf->stream( $file_to_save, array( 'Attachment'=>0 ) )) {
        		unlink($file_to_save);
        }
       
        exit();
    }

    public function add_remarks(){
       
        $this->JobTicket->id = $this->request->data['JobTicket']['id'];
        $this->JobTicket->saveField('remarks', $this->request->data['JobTicket']['remarks']);

        $this->Session->setFlash(
            __('Remarks in Job Ticket successfully added', 'success')
        );

        return $this->redirect(array('controller' => 'ticketing_systems', 
                'action' => 'view',
                $this->request->data['JobTicket']['product_uuid'],
                $this->request->data['JobTicket']['id'],
                $this->request->data['JobTicket']['client_order_id']));

    }

    public function excel_ticket($productUuid = null,$ticketUuid = null, $clientOrderId = null ){

        $userData = $this->Session->read('Auth');

        $this->loadModel('Sales.ProductSpecification');

        $this->loadModel('Sales.ProductSpecificationDetail');

        $this->loadModel('Sales.Company');

        $this->loadModel('Sales.Product');

        $this->loadModel('Sales.ClientOrder');

        $this->loadModel('Unit');

        $this->ClientOrder->bind(array('ClientOrderDeliverySchedule'));

        $delData = $this->ClientOrder->find('first',array('ClientOrder.id' => $clientOrderId));
       
        $productData = $this->Product->find('first',array(
            'conditions' => array('Product.uuid' => $productUuid)));

        $ticketData = $this->JobTicket->find('first',array(
            'conditions' => array('JobTicket.uuid' => $ticketUuid)));

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
       
        $this->set(compact('userData','ticketData','formatDataSpecs','productData','specs','companyData','unitData','subProcess','ticketUuid','delData'));
        
        $this->render('excel_specs');
       
    }

    public function print_ticket_export($productUuid = null,$ticketUuid = null, $clientOrderId = null,$type = 'excel') {
        
        $userData = $this->Session->read('Auth');

        $this->loadModel('Sales.ProductSpecification');

        $this->loadModel('Sales.ProductSpecificationDetail');

        $this->loadModel('Sales.Company');

        $this->loadModel('Sales.Product');

        $this->loadModel('Sales.ClientOrder');

        $this->loadModel('Unit');


        $this->ClientOrder->bind(array('ClientOrderDeliverySchedule'));

        $delData = $this->ClientOrder->find('first',array('conditions' => array('id' => $clientOrderId)));

        $productData = $this->Product->find('first',array('conditions' => array('Product.uuid' => $productUuid) ,'order' => 'Product.id DESC'));


        $ticketData = $this->JobTicket->find('first',array(
            'conditions' => array('JobTicket.uuid' => $ticketUuid)));

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
        //$subProcess =  $subProcess['SubProcess'];

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


        $this->set(compact('userData','ticketData','formatDataSpecs','productData','specs','companyData','unitData','subProcess','ticketUuid','delData'));
        

        if ($type == 'excel') {

        }

        if ($type == 'pdf') {


                $view = new View(null, false);

                $view->viewPath = 'TicketingSystem'.DS.'pdf';  

                $view->set(compact('userData','ticketData','formatDataSpecs','productData','specs','companyData','unitData','subProcess','ticketUuid','delData'));
                
                $output = $view->render('print_ticket_export', false);

                $dompdf = new DOMPDF();
                $dompdf->set_paper("A5", 'portrait');
                $dompdf->load_html(utf8_decode($output), Configure::read('App.encoding'));
                $dompdf->render();
                $canvas = $dompdf->get_canvas();
                $font = Font_Metrics::get_font("helvetica", "bold");
                $canvas->page_text(16, 800, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, array(0,0,0));

                $output = $dompdf->output();
                $random = rand(0, 1000000) . '-' . time();

                if (empty($filename)) {
                    $filename = 'payslip-record'.time();
                }
                $filePath = $filename.'.pdf';

                $file_to_save = WWW_ROOT .DS. $filePath;
                    
                if ($dompdf->stream( $file_to_save, array( 'Attachment'=>0 ) )) {
                        
                        unlink($file_to_save);
                }

                $dompdf->render();
                
                if ($dompdf->stream('payslip-'.$ticketUuid.'-.pdf',array( 'Attachment'=>0 ))) {
                    unlink($file_to_save);
                }




                if (empty($filename)) {
                    $filename = 'pdf_reports'.time();
                }
                $filePath = $filename.'.pdf';

                $file_to_save = WWW_ROOT .DS. $filePath;
                    
                if ($dompdf->stream( $file_to_save, array( 'Attachment'=>0 ) )) {
                        
                        unlink($file_to_save);
                }

                $dompdf->render();
                 if ($dompdf->stream('payslip-'.$ticketUuid.'-.pdf')){

                    unlink($file_to_save);
                }

                exit();
                break;  


        }
    }


    public function print_process($processId = null,$productUuid = null,$ticketUuid = null, $model = null , $lastId = null) {

        if (!empty($processId) && !empty($productUuid)) {

        $userData = $this->Session->read('Auth');

        $this->loadModel('Sales.ProductSpecification');

        $this->loadModel('Sales.ProductSpecificationDetail');

        $this->loadModel('Sales.ProductSpecificationPart');

        $this->loadModel('Sales.Company');

        $this->loadModel('Sales.Product');

        $this->loadModel('Sales.ClientOrder');

        $this->loadModel('Ticket.PlateMakingProcess');

        $this->loadModel('Unit');

        $modelData = array();

        if (!empty($model)) {
              $this->loadModel('Ticket.'.$model);


            $modelData = $this->$model->findById( $lastId );
        }



        $this->ClientOrder->bind(array('ClientOrderDeliverySchedule'));

       //$delData = $this->ClientOrder->find('first',array('ClientOrder.id' => $clientOrderId));
       
   
        $productData = $this->Product->find('first',array('conditions' => array('Product.uuid' => $productUuid) ,'order' => 'Product.id DESC'));

        // $ticketData = $this->JobTicket->find('first',array(
        //     'conditions' => array('JobTicket.uuid' => $ticketUuid)));

        $specs = $this->ProductSpecification->find('first',array('conditions' => array('ProductSpecification.product_id' => $productData['Product']['id'])));


       // pr($productUuid);
        //find if product has specs

        //find process part

        $processCond = array(
                    'ProductSpecificationDetail.product_id' => $productUuid,
                    'ProductSpecificationDetail.model' => 'Part',
                   
            );
        if (!empty($this->params['named']['productId'])) {
             $processCond = array_merge(
                $processCond,
                    array(
                    'ProductSpecificationDetail.foreign_key' => $this->params['named']['productId'],
               
                ));
        } 

        $processData = $this->ProductSpecificationDetail->find('first',array(
            'conditions' =>  $processCond

        ));


        $part = array();
         
         if (!empty($processData['ProductSpecificationDetail']['foreign_key'])) {

            $part = $this->ProductSpecificationPart->find('first',array(
                'conditions' => array(
                        'ProductSpecificationPart.id' => $processData['ProductSpecificationDetail']['foreign_key']
                )
            ));
         }   
        
        $formatDataSpecs = $this->ProductSpecificationDetail->findData($productUuid);
       //pr($formatDataSpecs);
     
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
        //set to cache in first load
        $unitData = Cache::read('unitData');
        
        if (!$unitData) {
            
            $unitData = $this->Unit->find('list', array('fields' => array('id', 'unit'),
                                                            'order' => array('Unit.unit' => 'ASC')
                                                            ));
            Cache::write('unitData', $unitData);
        }

        $view = new View(null, false);

        $view->viewPath = 'TicketingSystem'.DS.'pdf';  

        $view->set(compact('userData','ticketData','modelData','formatDataSpecs','productData','specs','companyData','part','unitData','subProcess','ticketUuid','delData','processId','processData',' modelData','part'));
        

        if (in_array($processId,array('11','61'))) {

            $output = $view->render('print_process_cutting', false);
        
        }  else if (in_array($processId,array('21'))) {

            // $this->PlateMakingProcess->find('first',array(
            //         'conditions' => array(
            //                 'PlateMakingProcess.job_ticket_id' =>  $ticketId,
            //                 'PlateMakingProcess.process_id' => $processId,
            //                 'PlateMakingProcess.product' => $product
            //         )
            //     ));


            //plateMaking Process
            $PlateMakingProcess = $this->PlateMakingProcess->getProcess(
                array(
                    $ticketUuid, $processId ,  $productUuid
                )
            );

            pr($PlateMakingProcess);
            exit();

            $output = $view->render('print_process_offset', false);
   

        } else if (in_array($processId,array('20'))) {

            $output = $view->render('print_process_woodmold', false);
            
        } else {
            
            $output = $view->render('print_process', false);
        }
    
        $dompdf = new DOMPDF();
        $dompdf->set_paper("A5", 'landscape');
        $dompdf->load_html(utf8_decode($output), Configure::read('App.encoding'));
        $dompdf->render();
        $canvas = $dompdf->get_canvas();
        $font = Font_Metrics::get_font("helvetica", "bold");
        $canvas->page_text(16, 800, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, array(0,0,0));

        $output = $dompdf->output();
        $random = rand(0, 1000000) . '-' . time();

        if (empty($filename)) {
            $filename = 'payslip-record'.time();
        }
        $filePath = $filename.'.pdf';

        $file_to_save = WWW_ROOT .DS. $filePath;
            
        if ($dompdf->stream( $file_to_save, array( 'Attachment'=>0 ) )) {
                
                unlink($file_to_save);
        }

        $dompdf->render();
        
        if ($dompdf->stream('payslip-'.$ticketUuid.'-.pdf',array( 'Attachment'=>0 ))) {
            unlink($file_to_save);
        }


        if (empty($filename)) {
            $filename = 'pdf_reports'.time();
        }
        $filePath = $filename.'.pdf';

        $file_to_save = WWW_ROOT .DS. $filePath;
            
        if ($dompdf->stream( $file_to_save, array( 'Attachment'=>0 ) )) {
                
                unlink($file_to_save);
        }

        $dompdf->render();
         if ($dompdf->stream('payslip-'.$ticketUuid.'-.pdf')){

            unlink($file_to_save);
        }

        exit();
        break;  


        }
    }

    public function prepress_ticket($productUuid = null,$ticketUuid = null) {


        if (!empty($productUuid)) {

       
        $userData = $this->Session->read('Auth');

        $this->loadModel('Sales.ProductSpecification');

        $this->loadModel('Sales.ProductSpecificationDetail');

        $this->loadModel('Sales.Company');

        $this->loadModel('Sales.Product');

        $this->loadModel('Sales.ClientOrder');

        $this->loadModel('Unit');

        $productData = $this->Product->find('first',array(
            'conditions' => array('Product.uuid' => $productUuid)));

            //if (!$companyData) {
        $companyData = $this->Company->find('list', array(
                                            'fields' => array( 
                                                'id','company_name')
                                        ));

        Cache::write('companyData', $companyData);


        $this->set(compact('companyData','productData','userData','ticketUuid'));

         $ticketData = $this->JobTicket->find('first',array(
            'conditions' => array('JobTicket.uuid' => $ticketUuid)));

        $view = new View(null, false);

        $view->viewPath = 'TicketingSystem'.DS.'pdf';  

        $view->set(compact('companyData','productData','userData','ticketUuid','ticketData'));
        
        $output = $view->render('print_prepress', false);

        $dompdf = new DOMPDF();
        $dompdf->set_paper("A4", 'portrait');
        $dompdf->load_html(utf8_decode($output), Configure::read('App.encoding'));
        $dompdf->render();
        $canvas = $dompdf->get_canvas();
        // $font = Font_Metrics::get_font("Arial", "bold");
        // $canvas->page_text(16, 800, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, array(0,0,0));

        $output = $dompdf->output();
        $random = rand(0, 1000000) . '-' . time();

        if (empty($filename)) {
            $filename = 'payslip-record'.time();
        }
        $filePath = $filename.'.pdf';

        $file_to_save = WWW_ROOT .DS. $filePath;
            
        if ($dompdf->stream( $file_to_save, array( 'Attachment'=>0 ) )) {
                
                unlink($file_to_save);
        }

        $dompdf->render();
        
        if ($dompdf->stream('payslip-'.$ticketUuid.'-.pdf',array( 'Attachment'=>0 ))) {
            unlink($file_to_save);
        }


        if (empty($filename)) {
            $filename = 'pdf_reports'.time();
        }
        $filePath = $filename.'.pdf';

        $file_to_save = WWW_ROOT .DS. $filePath;
            
        if ($dompdf->stream( $file_to_save, array( 'Attachment'=>0 ) )) {
                
                unlink($file_to_save);
        }

        $dompdf->render();
         if ($dompdf->stream('payslip-'.$ticketUuid.'-.pdf')){

            unlink($file_to_save);
        }

        }
        // }


    }


    public function save_process_to_ticket() {


        if (!empty($this->request->data)) {

            $this->loadModel('Ticket.PlateMakingProcess');


            $this->loadModel('Machine');

            $auth = $this->Session->read('Auth.User');

            if (!empty($this->request->data['PlateMakingProcess']['machine'])) {

                  $data = $this->request->data;

                  $data['PlateMakingProcess']['created_by'] = $auth['id'];

                  $data['PlateMakingProcess']['modified_by'] = $auth['id'];


                  if ($this->PlateMakingProcess->save($data)) {

                    $process = $this->PlateMakingProcess->read(null,$this->PlateMakingProcess->id);

                    $machines = $this->Machine->find('list');

                    if (!empty($process['PlateMakingProcess']['id'])) {
                        $process['PlateMakingProcess']['machine_name'] = $machines[$process['PlateMakingProcess']['machine']];

                    }

                    

                    $process = array_merge($process, array('formProcessId' => $data['PlateMakingProcess']['FormId']));

                    echo json_encode(array('result' =>  $process));

                  } else {

                     echo json_encode(array('result' => 'error'));
                  }
            }
          
          exit();
        }
    }
}