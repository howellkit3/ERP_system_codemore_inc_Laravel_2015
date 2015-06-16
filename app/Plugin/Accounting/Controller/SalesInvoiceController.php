<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');
App::import('Vendor', 'DOMPDF', true, array(), 'dompdf'.DS.'dompdf_config.inc.php', false);

class SalesInvoiceController extends AccountingAppController {

	public $uses = array('Accounting.SalesInvoice');

	public function index(){
		
      	$invoiceData = $this->SalesInvoice->find('all', array(
                                          			'fields' => array(
                                              			'id','sales_invoice_no','dr_uuid','status'),
                                        		));
      	
        $this->set(compact('invoiceData'));
	}

	public function add(){

		$userData = $this->Session->read('Auth');

		$this->loadModel('Delivery.Delivery');
        if($this->request->is('post')){

            if(!empty($this->request->data)){
            	
            	$DRdata = $this->SalesInvoice->find('first', array(
            				'conditions' => array(
            					'SalesInvoice.dr_uuid' => $this->request->data['SalesInvoice']['dr_uuid'])
            				));

            	if (!empty($DRdata)) {

            		$this->Session->setFlash(__('This Delivery No. already have a Sales Invoice No. '), 'error');
	        		$this->redirect( array(
                                 'controller' => 'salesInvoice', 
                                 'action' => 'add'
                            ));
            	}

            	$findDRdata = $this->Delivery->find('first', array(
            				'conditions' => array(
            					'Delivery.dr_uuid' => $this->request->data['SalesInvoice']['dr_uuid'])
            				));
          	
            	if (!empty($findDRdata)) {

            		$this->SalesInvoice->addSalesInvoice($this->request->data, $userData['User']['id']);

            		$this->Session->setFlash(__(' Sales Invoice No. completed. '), 'success');
	        		$this->redirect( array(
                                 'controller' => 'sales_invoice', 
                                 'action' => 'index'
                            ));

            	}else{

            		$this->request->data = $this->request->data['SalesInvoice']['dr_uuid'];

            		$this->Session->setFlash(__(' Delivery No. not matched in our system. '), 'error');
	        		$this->redirect( array(
                                 'controller' => 'salesInvoice', 
                                 'action' => 'add'
                            ));
            	}
            	
            	
	        }
        }
		
	}

	public function find_data($id = null){

		$this->layout = false;
		$this->loadModel('Delivery.Schedule');
		$scheduleInfo = $this->Schedule->find('first', array(
												'conditions' => array(
													'sales_order_id' => $id)
											));
		$this->loadModel('Sales.Quotation');
        $this->Quotation->bind(array('QuotationField','Product'));
        $ticketDetails = $this->Quotation->find('first', array(
                                                    'conditions' => array(
                                                        'unique_id' => $id
                                                        )
                                                    ));


        $this->loadModel('Sales.Company');
        if(!empty($ticketDetails['Quotation']['inquiry_id'])){

            $this->Company->bind(array('Address','Contact','Email','Inquiry'));
            $companyName = $this->Company->Inquiry->find('first', array(
                                                            'conditions' => array(
                                                                'Inquiry.id' => $ticketDetails['Quotation']['inquiry_id']
                                                                )
                                                            ));
        }   

        else{

            $this->Company->bind(array('Address','Contact','Email'));
            $companyName = $this->Company->find('first', array(
                                                    'conditions' => array(
                                                        'id' => $ticketDetails['Quotation']['company_id'])
                                            ));
        }

        $this->loadModel('Delivery.Delivery');
        $deliveryDetails = $this->Delivery->find('all', array(
		                                            'conditions' => array(
		                                                'sales_order_id' => $id),
		                                            'order' => array(
		                                            	'delivery_details_id ASC'
		                                            )
		                                        ));

		//pr($deliveryDetails);die;

		$data = array($scheduleInfo, $ticketDetails, $companyName, $deliveryDetails);
		//pr($data);die;
		echo json_encode($data);
		$this->autoRender = false;
	}

	public function get_data(){
		

	}
	public function create_sales_invoice(){
	}

	public function print_invoice($invoiceId = null) {

    // $this->loadModel('Sales.ClientOrder');
    // $this->ClientOrder->bind(array('Quotation','ClientOrderDeliverySchedule','QuotationItemDetail','QuotationDetail','Product'));
    // //$this->ClientOrder->bindDelivery();
    // $this->loadModel('Sales.Company');

    // $this->loadModel('Unit');
    // $units = $this->Unit->getList();

    // $this->Company->bind('Address');

    // $this->Delivery->bindDelivery();
    // $drData = $this->Delivery->find('first', array(
    //                                     'conditions' => array('Delivery.dr_uuid' => $dr_uuid
    //                                     )));
    
    // $clientData = $this->ClientOrder->find('first', array(
    //                                     'conditions' => array('ClientOrder.uuid' => $drData['Delivery']['clients_order_id']
    //                                     )));
    
    // $companyData = $this->Company->find('first', array(
    //                                     'conditions' => array('Company.id' => $clientData['ClientOrder']['company_id']
    //                                     )));

    // $userData = $this->Session->read('Auth');
    
    $view = new View(null, false);
    
    $view->set(compact('drData','clientData','companyData','units'));
      
    $view->viewPath = 'SalesInvoice'.DS.'pdf';  
   
    $output = $view->render('print_invoice', false);
 
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
      $filename = 'SalesInvoice-'.$invoiceId.'-data'.time();
    }
    $filePath = 'view_pdf/'.strtolower(Inflector::slug( $filename , '-')).'.pdf';
    $file_to_save = WWW_ROOT .DS. $filePath;
      
    if ($dompdf->stream( $file_to_save, array( 'Attachment'=>0 ) )) {
        unlink($file_to_save);
    }
    
    exit();
        
  }

  public function receivable(){
    
  }
}