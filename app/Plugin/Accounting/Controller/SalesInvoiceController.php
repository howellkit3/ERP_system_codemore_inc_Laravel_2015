<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');
App::import('Vendor', 'DOMPDF', true, array(), 'dompdf'.DS.'dompdf_config.inc.php', false);

class SalesInvoiceController extends AccountingAppController {

    public $uses = array('Accounting.SalesInvoice');
    public $helpers = array('Accounting.PhpExcel');

    public function index(){

        $userData = $this->Session->read('Auth');
        
        $this->loadModel('Sales.Company');

        $this->loadModel('Delivery.Delivery');

        //$this->SalesInvoice->bindInvoice();

        $limit = 10;

        $conditions = array('NOT' => array('SalesInvoice.status' => 2) );

        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'fields' => array(
                'SalesInvoice.id',
                'SalesInvoice.sales_invoice_no',
                'SalesInvoice.statement_no',  
                'SalesInvoice.dr_uuid', 
                'SalesInvoice.status',
             //   'Delivery.company_id',
                ),
            'order' => 'SalesInvoice.id DESC',
        );

        $invoiceData = $this->paginate('SalesInvoice');


       //pr($invoiceData);exit();
        $companyName = $this->Company->find('list',array('fields' => array('id','company_name')));

        $deliveryNumHolder = $this->Delivery->find('list',array('fields' => array('dr_uuid','company_id')));
        //pr($deliveryNum); exit;
        foreach($deliveryNumHolder as $key => $deliveryList) {
          //  pr($deliveryList);    
           //$keyHolder = strval($key);
           //pr( $keyHolder);
           $keyHolder = ltrim($key, '0');
           $deliveryNum[$keyHolder] = $deliveryList;
        }
      //  pr($deliveryNum); exit;
      
        if ($userData['User']['role_id'] == 9 ) {
            $noPermissionReciv = 'disabled not-active';
        } else {
            $noPermissionReciv = ' ';
        }

       if ($userData['User']['role_id'] == 10) {
            $noPermissionPay = 'disabled not-active';
            $this->redirect( array(
                 'controller' => 'salesInvoice', 
                 'action' => 'payable'
            ));

        } else {
            $noPermissionPay = ' ';
        }

        $this->set(compact('invoiceData','noPermissionReciv','noPermissionPay','companyName', 'deliveryNumHolder'));

    }

    public function statement(){
        
        $userData = $this->Session->read('Auth');

        $invoiceData = $this->SalesInvoice->find('all', array(
                                                    'fields' => array(
                                                        'id','sales_invoice_no',
                                                        'dr_uuid','statement_no',
                                                        'status'),
                                                    'conditions' => array(
                                                        'SalesInvoice.status' => 2 ),
                                                    'order' => 'SalesInvoice.id DESC'
                                                ));

        if ($userData['User']['role_id'] == 9 ) {
            $noPermissionReciv = 'disabled not-active';
        } else {
            $noPermissionReciv = ' ';
        }

       if ($userData['User']['role_id'] == 10) {
            $noPermissionPay = 'disabled not-active';

        } else {
            $noPermissionPay = ' ';
        }

        $this->set(compact('invoiceData','noPermissionReciv','noPermissionPay'));

    }

    public function view($invoiceId = null,$saNo = null){

        $userData = $this->Session->read('Auth');

        $this->loadModel('Sales.ClientOrderDeliverySchedule');

        $this->ClientOrderDeliverySchedule->bind(array('ClientOrder', 'QuotationDetail','Company', 'Product', 'Quotation', 'QuotationItemDetail', 'Company', 'Address'));

        $this->loadModel('Delivery.Delivery');

        $this->loadModel('Sales.PaymentTermHolder');

        $this->loadModel('Unit');

        $this->loadModel('Currency');

        $units = $this->Unit->getList();

        $this->loadModel('User');

        $approved = $this->User->find('first', array('fields' => array('id', 'first_name','last_name'),
                                                            'conditions' => array('User.id' => $userData['User']['id'])
                                                            )); 
         
        $paymentTermData = Cache::read('paymentTerms');
        
        if (!$paymentTermData) {
            $paymentTermData = $this->PaymentTermHolder->getList(null,array('id','name'));
            Cache::write('paymentTerms', $paymentTermData);
        }
        $currencyData = Cache::read('currencyData');
       
        $currencyData = $this->Currency->find('list', array('fields' => array('id', 'name'),
                                                        'order' => array('Currency.name' => 'ASC')
                                                        ));

        Cache::write('currencyData', $currencyData);

        
        //$this->SalesInvoice->bindInvoice();
        $invoiceData = $this->SalesInvoice->find('first', array(
                                            'conditions' => array('SalesInvoice.id' => $invoiceId
                                            )));

        $prepared = $this->User->find('first', array('fields' => array('id', 'first_name','last_name'),
                                                            'conditions' => array('User.id' => $invoiceData['SalesInvoice']['created_by'])
                                                            )); 
        
        $this->Delivery->bindDelivery();

        if(!empty($invoiceData['SalesInvoice']['dr_uuid'])){

            $drData = $this->Delivery->find('first', array(
                                                'conditions' => array('Delivery.dr_uuid' => $invoiceData['SalesInvoice']['dr_uuid']
                                                )));
        }else{

            $drData = " ";
        }


        $conditions = array('ClientOrderDeliverySchedule.uuid' => $drData['Delivery']['schedule_uuid']);
      // $conditions = array_merge($conditions,array('ClientOrder.uuid' => $drData['Delivery']['clients_order_id']));
        $clientData = $this->ClientOrderDeliverySchedule->find('first', array(
                                            'conditions' => array($conditions
                                            )));

        $clientOrderId = $clientData['ClientOrder']['id'];

        $companyData = $clientData['Company']['company_name'];
       
        $noPermissionPay = "";

        $noPermissionReciv = "";

        $this->set(compact('invoiceId','prepared','approved','drData','clientData','companyData','units','invoiceData','paymentTermData','currencyData', 'noPermissionPay', 'noPermissionReciv','quotationData', 'clientOrderId'));
        
        if (!empty($saNo)) {

            $this->render('view_statement');

        } 
    }

    public function add_statement(){

        $userData = $this->Session->read('Auth');

        $this->loadModel('Delivery.Delivery');

        $seriesNo = $this->SalesInvoice->find('first', array(
                'order' => array('SalesInvoice.statement_no DESC')));

        if(!empty($seriesNo)){

            $nextSalesNo = intval($seriesNo['SalesInvoice']['statement_no']);

            $seriesSalesNo = str_pad(++$nextSalesNo,6,'0',STR_PAD_LEFT); 

        }else{

            $nextSalesNo = intval(0);

            $seriesSalesNo = str_pad(++$nextSalesNo,6,'0',STR_PAD_LEFT);

        }

        if($this->request->is('post')){

            if(!empty($this->request->data)){
                
                $DRdata = $this->SalesInvoice->find('first', array(
                            'conditions' => array(
                                'SalesInvoice.dr_uuid' => $this->request->data['SalesInvoice']['dr_uuid'])
                            ));

                if (!empty($DRdata)) {

                    $this->Session->setFlash(__('This Delivery No. already exist. '), 'error');
                    $this->redirect( array(
                                 'controller' => 'salesInvoice', 
                                 'action' => 'add_statement'
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
                                 'action' => 'statement'
                            ));

                }else{

                    $this->request->data = $this->request->data['SalesInvoice']['dr_uuid'];

                    $this->Session->setFlash(__(' Delivery No. not matched in our system. '), 'error');
                    $this->redirect( array(
                                 'controller' => 'salesInvoice', 
                                 'action' => 'add_statement'
                            ));
                }
                
            }
        }

        $noPermissionPay = "";

        $noPermissionReciv = "";

        $this->set(compact('seriesSalesNo', 'noPermissionPay', 'noPermissionReciv'));

    }

    public function add_invoice(){

        $this->loadModel('Delivery.Delivery');

        $userData = $this->Session->read('Auth');

        //pr($this->request->data); exit;

       // if(!empty($this->request->data['SalesInvoice']['dr_uuid'])){

        $DRdata = $this->SalesInvoice->find('first', array(
            'conditions' => array(
                'SalesInvoice.dr_uuid' => $this->request->data['SalesInvoice']['dr_uuid'])
            ));

        //}

        if (!empty($DRdata)) {

            $this->Session->setFlash(__('This Delivery No. already have a Sales Invoice No. '), 'error');
            $this->redirect( array(
                         'controller' => 'salesInvoice', 
                         'action' => 'add'
                    ));
        }

        if(!empty($this->request->data['SalesInvoice']['dr_uuid'])){

            $findDRdata = $this->Delivery->find('first', array(
                        'conditions' => array(
                            'Delivery.dr_uuid' => $this->request->data['SalesInvoice']['dr_uuid'])
                        ));

        }
    
        if (!empty($findDRdata)) {

            $this->SalesInvoice->addSalesInvoice($this->request->data, $userData['User']['id']);

            $this->Session->setFlash(__(' Sales Invoice No. completed. '), 'success');
            $this->redirect( array(
                         'controller' => 'sales_invoice', 
                         'action' => 'index'
                    ));

        }else{

            //pr($this->request->data ); exit;

            //$this->request->data = $this->request->data['SalesInvoice']['dr_uuid'];

            $this->SalesInvoice->addSalesInvoice($this->request->data, $userData['User']['id']);

            $this->Session->setFlash(__(' Sales Invoice No. completed. '), 'success');
            $this->redirect( array(
                         'controller' => 'sales_invoice', 
                         'action' => 'index'
                    ));

            // $this->Session->setFlash(__(' Delivery No. not matched in our system. '), 'error');
            // $this->redirect( array(
            //              'controller' => 'salesInvoice', 
            //              'action' => 'add'
            //         ));
        }
        

    }

    public function add(){

        $userData = $this->Session->read('Auth');

        $this->loadModel('Delivery.Delivery');

        $this->loadModel('Sales.ClientOrder');

        $this->loadModel('Sales.Company');

      //  $this->Delivery->bindInvoice();

        $limit = 10;

        $conditions = array();

        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'fields' => array(
                'Delivery.id',
                'Delivery.clients_order_id',
                'Delivery.company_id',  
                'Delivery.status',
                'Delivery.dr_uuid', 
                ),
            'order' => 'Delivery.id DESC',
        );

        $deliveryData = $this->paginate('Delivery');

     // pr($deliveryData); exit;

        $poNumber = $this->ClientOrder->find('list', array('fields' => array('uuid', 'po_number')));

        $companyData = $this->Company->find('list', array('fields' => array('id', 'company_name')));

        $seriesNo = $this->SalesInvoice->find('first', array(
                'order' => array('SalesInvoice.sales_invoice_no DESC')));

        if(!empty($seriesNo)){

            $nextSalesNo = intval($seriesNo['SalesInvoice']['sales_invoice_no']);
            $seriesSalesNo = str_pad(++$nextSalesNo,6,'0',STR_PAD_LEFT); 

        }else{

            $nextSalesNo = intval(0);
            $seriesSalesNo = str_pad(++$nextSalesNo,6,'0',STR_PAD_LEFT);

        }
        
        // if($this->request->is('post')){

        //     if(!empty($this->request->data)){
                
        //      $DRdata = $this->SalesInvoice->find('first', array(
        //                  'conditions' => array(
        //                      'SalesInvoice.dr_uuid' => $this->request->data['SalesInvoice']['dr_uuid'])
        //                  ));

        //      if (!empty($DRdata)) {

        //          $this->Session->setFlash(__('This Delivery No. already have a Sales Invoice No. '), 'error');
           //       $this->redirect( array(
        //                          'controller' => 'salesInvoice', 
        //                          'action' => 'add'
        //                     ));
        //      }

        //      $findDRdata = $this->Delivery->find('first', array(
        //                  'conditions' => array(
        //                      'Delivery.dr_uuid' => $this->request->data['SalesInvoice']['dr_uuid'])
        //                  ));
            
        //      if (!empty($findDRdata)) {

        //          $this->SalesInvoice->addSalesInvoice($this->request->data, $userData['User']['id']);

        //          $this->Session->setFlash(__(' Sales Invoice No. completed. '), 'success');
           //       $this->redirect( array(
        //                          'controller' => 'sales_invoice', 
        //                          'action' => 'index'
        //                     ));

        //      }else{

        //          $this->request->data = $this->request->data['SalesInvoice']['dr_uuid'];

        //          $this->Session->setFlash(__(' Delivery No. not matched in our system. '), 'error');
           //       $this->redirect( array(
        //                          'controller' => 'salesInvoice', 
        //                          'action' => 'add'
        //                     ));
        //      }
                
           //  }
        // }

        $noPermissionPay = "";
        $noPermissionReciv = "";

        $this->set(compact('seriesSalesNo', 'noPermissionPay', 'noPermissionReciv', 'deliveryData', 'clientOrderData', 'companyData', 'poNumber'));
        
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
        } else {

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

        $data = array($scheduleInfo, $ticketDetails, $companyName, $deliveryDetails);
        
        echo json_encode($data);

        $this->autoRender = false;
    }

    public function get_data(){ }

    public function create_sales_invoice(){ }
 
    public function print_invoice($invoiceId = null ,$clientsId = null) {

  //      pr($clientsId); pr($invoiceId); exit;

        $userData = $this->Session->read('Auth');

        $this->loadModel('Sales.ClientOrder');

        $this->ClientOrder->bind(array('Quotation','ClientOrderDeliverySchedule',
                                        'QuotationItemDetail','QuotationDetail','Product'));
        
        $this->loadModel('Delivery.Delivery');

        $this->loadModel('Sales.Company');

        $this->loadModel('Sales.PaymentTermHolder');

        $this->loadModel('Unit');

        $this->loadModel('Currency');

        $units = $this->Unit->getList();

        $this->loadModel('User');

        $approved = $this->User->find('first', array('fields' => array('id', 'first_name','last_name'),
                                                            'conditions' => array('User.id' => $userData['User']['id'])
                                                            )); 
         
        $paymentTermData = Cache::read('paymentTerms');
        
        if (!$paymentTermData) {

            $paymentTermData = $this->PaymentTermHolder->getList(null,array('id','name'));
            Cache::write('paymentTerms', $paymentTermData);

        }

        $currencyData = Cache::read('currencyData');
      
        $currencyData = $this->Currency->find('list', array('fields' => array('id', 'name'),
                                                        'order' => array('Currency.name' => 'ASC')
                                                        ));

        Cache::write('currencyData', $currencyData);
     
        $this->Company->bind('Address');

        $invoiceData = $this->SalesInvoice->find('first', array(
                                            'conditions' => array('SalesInvoice.id' => $invoiceId
                                            )));

        $prepared = $this->User->find('first', array('fields' => array('id', 'first_name','last_name'),
                                                            'conditions' => array('User.id' => $invoiceData['SalesInvoice']['created_by'])
                                                            )); 

      //  pr($prepared); exit;

        
        $this->Delivery->bindDelivery();

        $drData = $this->Delivery->find('first', array(
                                            'conditions' => array('Delivery.dr_uuid' => $invoiceData['SalesInvoice']['dr_uuid']
                                            )));

        $clientData = $this->ClientOrder->find('first', array(
                                            'conditions' => array('ClientOrder.id' => $clientsId
                                            )));

        
       // pr($clientData); exit;
        $companyData = $this->Company->find('first', array(
                                            'conditions' => array('Company.id' => $drData['Delivery']['company_id']
                                            )));

    //    pr($companyData); exit;

        //$view = new View(null, false);
        
        $this->set(compact('prepared','approved','drData','clientData','companyData','units','invoiceData','paymentTermData','currencyData'));
          
        //$view->viewPath = 'SalesInvoice'.DS.'pdf';  
        
        if (!empty($saNo)) {
            $output = $this->render('print_statement');
        }else{
            $output = $this->render('print_invoice');
        }
        
     
        // $dompdf = new DOMPDF();

        // $dompdf->set_paper("A4");

        // $dompdf->load_html(utf8_decode($output), Configure::read('App.encoding'));

        // $dompdf->render();

        // $canvas = $dompdf->get_canvas();

        // $font = Font_Metrics::get_font("Arial", "bold");

        // $canvas->page_text(16, 800, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, array(0,0,0));

        // $output = $dompdf->output();

        // $random = rand(0, 1000000) . '-' . time();

        // if (empty($filename)) {

        //   $filename = 'SalesInvoice-'.$invoiceId.'-data'.time();

        // }

        // $filePath = 'view_pdf/'.strtolower(Inflector::slug( $filename , '-')).'.pdf';

        // $file_to_save = WWW_ROOT .DS. $filePath;
          
        // if ($dompdf->stream( $file_to_save, array( 'Attachment'=>0 ) )) {

        //     unlink($file_to_save);
        // }
        
        // exit();
            
    }

    public function receivable(){

        $userData = $this->Session->read('Auth');

        $this->loadModel('Delivery.Delivery');

        $this->loadModel('Delivery.DeliveryDetail');

        $this->loadModel('Sales.ClientOrder');

        $this->loadModel('Sales.QuotationItemDetail');

        $this->loadModel('Sales.Company');

        $this->loadModel('Sales.PaymentTermHolder');

        $paymentTermData = Cache::read('paymentTerms');
        
        if (!$paymentTermData) {

            $paymentTermData = $this->PaymentTermHolder->getList(null,array('id','name'));
            Cache::write('paymentTerms', $paymentTermData);

        }

        $companyData = $this->Company->find('list', array('fields' => array('id', 'company_name')
                                                            ));
       
        $invoiceList = $this->SalesInvoice->find('list',array('fields' => array('id','dr_uuid'),
            'conditions' => array('NOT' => array('SalesInvoice.status' => 0)),
            'order' => 'SalesInvoice.id DESC'
            ));

        //$this->SalesInvoice->bindInvoice();

        $invoiceData = $this->SalesInvoice->find('all',array(
            'conditions' => array('NOT' => array('SalesInvoice.status' => 0)),
            'order' => 'SalesInvoice.id DESC'
            ));
        
        $deliveryData = $this->Delivery->find('all',array(
            'conditions' => array('dr_uuid' => $invoiceList)
            ));

        $clientsId = array();

        foreach ($deliveryData as $key => $value) {
            
            $invoiceData[$key]['SalesInvoice']['schedule_uuid'] = $value['Delivery']['schedule_uuid'];

            $invoiceData[$key]['SalesInvoice']['clients_order_id'] = $value['Delivery']['clients_order_id'];
            
            array_push($clientsId, $value['Delivery']['clients_order_id']);
           
        }

        $deliveryDetails = $this->DeliveryDetail->find('all',array(
            'conditions' => array('delivery_uuid' => $invoiceList),
            'order' => 'DeliveryDetail.id DESC'
            ));
        
        foreach ($deliveryDetails as $key => $value) {
            
            $invoiceData[$key]['SalesInvoice']['quantity'] = $value['DeliveryDetail']['quantity'];
           
            $invoiceData[$key]['SalesInvoice']['schedule'] = $value['DeliveryDetail']['schedule'];
           
        }

        foreach ($clientsId as $key => $value) {

            $this->ClientOrder->bind('QuotationItemDetail');

            $clientData = $this->ClientOrder->find('first',array(
                'conditions' => array('ClientOrder.uuid' => $value)
                ));

            $invoiceData[$key]['SalesInvoice']['company_id'] = $clientData['ClientOrder']['company_id'];
           
            $invoiceData[$key]['SalesInvoice']['payment_terms'] = $clientData['ClientOrder']['payment_terms'];
            
            $invoiceData[$key]['SalesInvoice']['unit_price'] = $clientData['QuotationItemDetail']['unit_price'];
            
            $invoiceData[$key]['SalesInvoice']['unit_price_currency_id'] = $clientData['QuotationItemDetail']['unit_price_currency_id'];


        }
        
        if ($userData['User']['role_id'] == 9 ) {
            $noPermissionReciv = 'disabled not-active';
        } else {
            $noPermissionReciv = ' ';
        }

       if ($userData['User']['role_id'] == 10) {
            $noPermissionPay = 'disabled not-active';

        } else {
            $noPermissionPay = ' ';
        }

        $this->set(compact('invoiceData','companyData','paymentTermData','noPermissionReciv','noPermissionPay'));

    }

    public function dr_summary($reportname = null) {

        $this->loadModel('Delivery.Delivery');

        $this->loadModel('Delivery.DeliveryDetail');

        $this->loadModel('Sales.ClientOrder');

        $this->loadModel('Sales.QuotationItemDetail');

        $this->loadModel('Sales.Company');

        $this->loadModel('Sales.PaymentTermHolder');

        $this->loadModel('PaymentTermHolder');


        $paymentTermData = Cache::read('paymentTerms');
        
        if (!$paymentTermData) {

            $paymentTermData = $this->PaymentTermHolder->getList(null,array('id','name'));
            Cache::write('paymentTerms', $paymentTermData);

        }

        $companyData = $this->Company->find('list', array('fields' => array('id', 'company_name')
                                                            ));

        $companyTinData = $this->Company->find('list', array('fields' => array('id', 'tin')
                                                            ));

        if(!empty($this->request->data['from_date'])){

            $dateRange = str_replace(' ', '', $this->request->data['from_date']);
       
            $splitDate = split('-', $dateRange);
            $from = str_replace('/', '-', $splitDate[0]);
            $to = str_replace('/', '-', $splitDate[1]);

            $invoiceList = $this->SalesInvoice->find('list',array('fields' => array('id','dr_uuid'),
                'conditions' => array(
                    'AND' => array(
                        'SalesInvoice.status !=' => 0,
                        'SalesInvoice.created BETWEEN ? AND ?' => array($from.' '.'00:00:00:', $to.' '.'23:00:00:')
                    ),
                ),
                'order' => 'SalesInvoice.id DESC'
            ));
            
            $invoiceData = $this->SalesInvoice->find('all', array(
                'conditions' => array(
                    'AND' => array(
                        'SalesInvoice.status !=' => 0,
                        'SalesInvoice.created BETWEEN ? AND ?' => array($from.' '.'00:00:00:', $to.' '.'23:00:00:')
                    ),
                ),
                'order' => 'SalesInvoice.id DESC'
            ));

            


           
        } else {

            $invoiceList = $this->SalesInvoice->find('list',array('fields' => array('id','dr_uuid'),
                'conditions' => array(
                    'SalesInvoice.status !=' => 0
                ),
                'order' => 'SalesInvoice.id DESC'
            ));
            
            $invoiceData = $this->SalesInvoice->find('all', array(
                'conditions' => array(
                    'SalesInvoice.status !=' => 0
                ),
                'order' => 'SalesInvoice.id DESC'
            ));

            $DeliveryDateData = $this->Delivery->find('list', array('fields' => array('dr_uuid', 'created')
                                                            ));

            $DeliveryClientsOrderData = $this->Delivery->find('list', array('fields' => array('dr_uuid', 'clients_order_id')
                                                            ));

            $clientOrderData = $this->ClientOrder->find('list', array('fields' => array('uuid', 'payment_terms')
                                                            ));

            $termData = $this->PaymentTermHolder->find('list', array('fields' => array('id', 'name')
                                                            ));
           // PaymentTermHolderpr($DeliveryClientsOrderData); exit;
        }
        
        //$this->SalesInvoice->bindInvoice();

        $deliveryData = $this->Delivery->find('all',array(
            'conditions' => array('dr_uuid' => $invoiceList)
            ));

        $clientsId = array();

        foreach ($deliveryData as $key => $value) {
            
            $invoiceData[$key]['SalesInvoice']['schedule_uuid'] = $value['Delivery']['schedule_uuid'];
           
            $invoiceData[$key]['SalesInvoice']['clients_order_id'] = $value['Delivery']['clients_order_id'];
           
            array_push($clientsId, $value['Delivery']['clients_order_id']);
           
        }

        $deliveryDetails = $this->DeliveryDetail->find('all',array(
            'conditions' => array('delivery_uuid' => $invoiceList)
            ));

        foreach ($deliveryDetails as $key => $value) {
            
            $invoiceData[$key]['SalesInvoice']['quantity'] = $value['DeliveryDetail']['quantity'];
            
            $invoiceData[$key]['SalesInvoice']['schedule'] = $value['DeliveryDetail']['schedule'];
           
        }

        foreach ($clientsId as $key => $value) {

            $this->ClientOrder->bind('QuotationItemDetail');

            $clientData = $this->ClientOrder->find('first',array(
                'conditions' => array('ClientOrder.uuid' => $value)
                ));

            $invoiceData[$key]['SalesInvoice']['company_id'] = $clientData['ClientOrder']['company_id'];
           
            $invoiceData[$key]['SalesInvoice']['payment_terms'] = $clientData['ClientOrder']['payment_terms'];
            
            $invoiceData[$key]['SalesInvoice']['unit_price'] = $clientData['QuotationItemDetail']['unit_price'];
            
            $invoiceData[$key]['SalesInvoice']['unit_price_currency_id'] = $clientData['QuotationItemDetail']['unit_price_currency_id'];


        }

        $this->set(compact('invoiceData','companyData','paymentTermData', 'companyTinData', 'DeliveryDateData', 'clientOrderData', 'DeliveryClientsOrderData', 'termData'));

        if ($reportname == 1) {

            $this->render('SalesInvoice/xls/dr_summary');

        }

        if ($reportname == 2) {

            $this->render('SalesInvoice/xls/php');

        }

        if ($reportname == 3) {

            $this->render('SalesInvoice/xls/usd');

        }

        if ($reportname == 4) {

            $this->render('SalesInvoice/xls/with_terms');

        }
        
    }


    public function payables_print($reportname = null) {

        $this->loadModel('WareHouse.ReceivedItem');

        $this->loadModel('Purchasing.PurchaseOrder');

        $this->loadModel('Supplier');

        $this->loadModel('User');

        $this->ReceivedItem->bind('DeliveredOrder', 'PurchaseOrder');

        if(!empty($this->request->data['from_date'])){

            $dateRange = str_replace(' ', '', $this->request->data['from_date']);
       
            $splitDate = split('-', $dateRange);
            $from = str_replace('/', '-', $splitDate[0]);
            $to = str_replace('/', '-', $splitDate[1]);


            $receivedItemData = $this->ReceivedItem->find('all', array(
            'conditions' => array(
                'AND' => array(
                    'DeliveredOrder.created BETWEEN ? AND ?' => array($from.' '.'00:00:00:', $to.' '.'23:00:00:')
                ),
            ),
            'order' => 'ReceivedItem.id DESC'
            ));

        } else {

            $receivedItemData = $this->ReceivedItem->find('all', array(
                'order' => array('ReceivedItem.id DESC')));
 
        }

        foreach ($receivedItemData as $key => $value) {

            if ($value['ReceivedItem']['model'] ==  "GeneralItem"){

                $this->loadModel('GeneralItem');

                $itemData = $this->GeneralItem->find('list', array('fields' => array('id', 'name')));

                $receivedItemData[$key]['DeliveredOrder']['item_name'] = $itemData[$value['ReceivedItem']['foreign_key']];

            }

            if ($value['ReceivedItem']['model'] ==  "Substrate"){

                $this->loadModel('Substrate');

                $itemData = $this->Substrate->find('list', array('fields' => array('id', 'name')));

                $receivedItemData[$key]['DeliveredOrder']['item_name'] = $itemData[$value['ReceivedItem']['foreign_key']];

            }

            if ($value['ReceivedItem']['model'] ==  "CompoundSubstrate"){

                $this->loadModel('CompoundSubstrate');

                $itemData = $this->CompoundSubstrate->find('list', array('fields' => array('id', 'name')));

                $receivedItemData[$key]['DeliveredOrder']['item_name'] = $itemData[$value['ReceivedItem']['foreign_key']];

            }

            if ($value['ReceivedItem']['model'] ==  "CorrugatedPaper"){

                $this->loadModel('CorrugatedPaper');

                $itemData = $this->CorrugatedPaper->find('list', array('fields' => array('id', 'name')));

                $receivedItemData[$key]['DeliveredOrder']['item_name'] = $itemData[$value['ReceivedItem']['foreign_key']];

            }


        }

        $purchaseOrderSupplier = $this->PurchaseOrder->find('list', array('fields' => array('id', 'supplier_id')));

        $purchaseOrderPONum = $this->PurchaseOrder->find('list', array('fields' => array('id', 'po_number')));

        $userName = $this->User->find('list', array('fields' => array('id', 'fullname')));

        $supplierName = $this->Supplier->find('list', array('fields' => array('id', 'name')));

        $this->set(compact('noPermissionReciv','noPermissionPay', 'userName', 'receivedItemData','purchaseOrderPONum', 'purchaseOrderSupplier','supplierName'));

        $this->render('SalesInvoice/xls/payables_print');
 
    }


    public function daterange_summary($from = null, $to = null){

        $this->loadModel('Delivery.Delivery');

        $this->loadModel('Delivery.DeliveryDetail');

        $this->loadModel('Sales.ClientOrder');

        $this->loadModel('Sales.QuotationItemDetail');

        $this->loadModel('Sales.Company');

        $this->loadModel('Sales.PaymentTermHolder');

        $paymentTermData = Cache::read('paymentTerms');
        
        if (!$paymentTermData) {

            $paymentTermData = $this->PaymentTermHolder->getList(null,array('id','name'));
            Cache::write('paymentTerms', $paymentTermData);

        }

        $companyData = $this->Company->find('list', array('fields' => array('id', 'company_name')
                                                            ));

        $invoiceList = $this->SalesInvoice->find('list',array('fields' => array('id','dr_uuid'),
            'conditions' => array(
                'AND' => array(
                    'SalesInvoice.status !=' => 0,
                    'SalesInvoice.created BETWEEN ? AND ?' => array($from.' '.'00:00:00:', $to.' '.'23:00:00:')
                ),
            ),
            'order' => 'SalesInvoice.created DESC'
        ));
        
        $invoiceData = $this->SalesInvoice->find('all', array(
            'conditions' => array(
                'AND' => array(
                    'SalesInvoice.status !=' => 0,
                    'SalesInvoice.created BETWEEN ? AND ?' => array($from.' '.'00:00:00:', $to.' '.'23:00:00:')
                ),
            ),
            'order' => 'SalesInvoice.id DESC'
        ));
           
        //$this->SalesInvoice->bindInvoice();

        $deliveryData = $this->Delivery->find('all',array(
            'conditions' => array('dr_uuid' => $invoiceList)
            ));

        $clientsId = array();

        foreach ($deliveryData as $key => $value) {
            
            $invoiceData[$key]['SalesInvoice']['schedule_uuid'] = $value['Delivery']['schedule_uuid'];
           
            $invoiceData[$key]['SalesInvoice']['clients_order_id'] = $value['Delivery']['clients_order_id'];
           
            array_push($clientsId, $value['Delivery']['clients_order_id']);
           
        }

        $deliveryDetails = $this->DeliveryDetail->find('all',array(
            'conditions' => array('delivery_uuid' => $invoiceList)
            ));

        foreach ($deliveryDetails as $key => $value) {
            
            $invoiceData[$key]['SalesInvoice']['quantity'] = $value['DeliveryDetail']['quantity'];
            
            $invoiceData[$key]['SalesInvoice']['schedule'] = $value['DeliveryDetail']['schedule'];
           
        }

        foreach ($clientsId as $key => $value) {

            $this->ClientOrder->bind('QuotationItemDetail');

            $clientData = $this->ClientOrder->find('first',array(
                'conditions' => array('ClientOrder.uuid' => $value)
                ));

            $invoiceData[$key]['SalesInvoice']['company_id'] = $clientData['ClientOrder']['company_id'];
           
            $invoiceData[$key]['SalesInvoice']['payment_terms'] = $clientData['ClientOrder']['payment_terms'];
            
            $invoiceData[$key]['SalesInvoice']['unit_price'] = $clientData['QuotationItemDetail']['unit_price'];
            
            $invoiceData[$key]['SalesInvoice']['unit_price_currency_id'] = $clientData['QuotationItemDetail']['unit_price_currency_id'];


        }
       
        $this->set(compact('invoiceData','companyData','paymentTermData'));

        if($whatreport == 1){
            $this->render('daterange_summary');
        }
        if($whatreport == 2){
            $this->render('daterange_php');
        }
        if($whatreport == 3){
            $this->render('daterange_usd');
        }
        if($whatreport == 4){
            $this->render('daterange_term');
        }
        
    }

    public function daterange_summary_payables($from = null, $to = null,$whatreport = null){

        $this->loadModel('WareHouse.ReceivedItem');

        $this->loadModel('Purchasing.PurchaseOrder');

        $this->loadModel('Supplier');

        $this->loadModel('User');

        $this->ReceivedItem->bind('DeliveredOrder', 'PurchaseOrder');

        // $receivedItemData = $this->ReceivedItem->find('all', array(
        //         'order' => array('ReceivedItem.id DESC')));

        $receivedItemData = $this->ReceivedItem->find('all', array(
            'conditions' => array(
                'AND' => array(
                    'DeliveredOrder.created BETWEEN ? AND ?' => array($from.' '.'00:00:00:', $to.' '.'23:00:00:')
                ),
            ),
            'order' => 'ReceivedItem.id DESC'
        ));

        foreach ($receivedItemData as $key => $value) {

            if ($value['ReceivedItem']['model'] ==  "GeneralItem"){

                $this->loadModel('GeneralItem');

                $itemData = $this->GeneralItem->find('list', array('fields' => array('id', 'name')));

                $receivedItemData[$key]['DeliveredOrder']['item_name'] = $itemData[$value['ReceivedItem']['foreign_key']];

            }

            if ($value['ReceivedItem']['model'] ==  "Substrate"){

                $this->loadModel('Substrate');

                $itemData = $this->Substrate->find('list', array('fields' => array('id', 'name')));

                $receivedItemData[$key]['DeliveredOrder']['item_name'] = $itemData[$value['ReceivedItem']['foreign_key']];

            }

            if ($value['ReceivedItem']['model'] ==  "CompoundSubstrate"){

                $this->loadModel('CompoundSubstrate');

                $itemData = $this->CompoundSubstrate->find('list', array('fields' => array('id', 'name')));

                $receivedItemData[$key]['DeliveredOrder']['item_name'] = $itemData[$value['ReceivedItem']['foreign_key']];

            }

            if ($value['ReceivedItem']['model'] ==  "CorrugatedPaper"){

                $this->loadModel('CorrugatedPaper');

                $itemData = $this->CorrugatedPaper->find('list', array('fields' => array('id', 'name')));

                $receivedItemData[$key]['DeliveredOrder']['item_name'] = $itemData[$value['ReceivedItem']['foreign_key']];

            }


        }

        $purchaseOrderSupplier = $this->PurchaseOrder->find('list', array('fields' => array('id', 'supplier_id')));

        $purchaseOrderPONum = $this->PurchaseOrder->find('list', array('fields' => array('id', 'po_number')));

        $userName = $this->User->find('list', array('fields' => array('id', 'fullname')));

        $supplierName = $this->Supplier->find('list', array('fields' => array('id', 'name')));

        $this->set(compact('userName', 'receivedItemData','purchaseOrderPONum', 'purchaseOrderSupplier','supplierName'));
  

        $this->render('daterange_summary_payables');
       

        
    }

    public function payable(){

        $userData = $this->Session->read('Auth');

        if ($userData['User']['role_id'] == 9 ) {
            $noPermissionReciv = 'disabled not-active';
        } else {
            $noPermissionReciv = ' ';
        }

       if ($userData['User']['role_id'] == 10) {
            $noPermissionPay = 'disabled not-active';

        } else {
            $noPermissionPay = ' ';
        }

        $this->loadModel('WareHouse.ReceivedItem');

        $this->loadModel('Purchasing.PurchaseOrder');

        $this->loadModel('Supplier');

        $this->loadModel('User');

        $this->ReceivedItem->bind('DeliveredOrder', 'PurchaseOrder');

        // $receivedItemData = $this->ReceivedItem->find('all', array(
        //         'order' => array('ReceivedItem.id DESC')));

        $limit = 10;

        $conditions = " ";

        $params =  array(
                'conditions' => $conditions,
                'limit' => $limit,
                //'fields' => array('id', 'status','created'),
                'order' => 'ReceivedItem.id DESC',
        );

        $this->paginate = $params;

        $receivedItemData = $this->paginate('ReceivedItem');


        foreach ($receivedItemData as $key => $value) {

            if ($value['ReceivedItem']['model'] ==  "GeneralItem"){

                $this->loadModel('GeneralItem');

                $itemData = $this->GeneralItem->find('list', array('fields' => array('id', 'name')));
            
                $receivedItemData[$key]['DeliveredOrder']['item_name'] = $itemData[$value['ReceivedItem']['foreign_key']];

            }

            if ($value['ReceivedItem']['model'] ==  "Substrate"){

                $this->loadModel('Substrate');

                $itemData = $this->Substrate->find('list', array('fields' => array('id', 'name')));

                $receivedItemData[$key]['DeliveredOrder']['item_name'] = $itemData[$value['ReceivedItem']['foreign_key']];

            }

            if ($value['ReceivedItem']['model'] ==  "CompoundSubstrate"){

                $this->loadModel('CompoundSubstrate');

                $itemData = $this->CompoundSubstrate->find('list', array('fields' => array('id', 'name')));

                $receivedItemData[$key]['DeliveredOrder']['item_name'] = $itemData[$value['ReceivedItem']['foreign_key']];

            }

            if ($value['ReceivedItem']['model'] ==  "CorrugatedPaper"){

                $this->loadModel('CorrugatedPaper');

                $itemData = $this->CorrugatedPaper->find('list', array('fields' => array('id', 'name')));

                $receivedItemData[$key]['DeliveredOrder']['item_name'] = $itemData[$value['ReceivedItem']['foreign_key']];

            }


        }

        $purchaseOrderSupplier = $this->PurchaseOrder->find('list', array('fields' => array('id', 'supplier_id')));

        $purchaseOrderPONum = $this->PurchaseOrder->find('list', array('fields' => array('id', 'po_number')));

        $userName = $this->User->find('list', array('fields' => array('id', 'fullname')));

        $supplierName = $this->Supplier->find('list', array('fields' => array('id', 'name')));

        $this->set(compact('noPermissionReciv','noPermissionPay', 'userName', 'receivedItemData','purchaseOrderPONum', 'purchaseOrderSupplier','supplierName'));
    }

    public function change_to_invoice($id = null) {

        $userData = $this->Session->read('Auth');

        $this->SalesInvoice->changeStatus($userData['User']['id'], $id);

       $this->Session->setFlash(__('Pre-Invoice status was changed to Invoice'), 'success');
      
       $this->redirect( array(
           'controller' => 'sales_invoice',   
           'action' => 'view',$id 
        ));  

    }

    public function invoice_modal($deliveryId = null, $deliveryUUID = null) {

        $seriesNo = $this->SalesInvoice->find('first', array(
                'order' => array('SalesInvoice.id DESC')));

        if(!empty($seriesNo)){

            $nextSalesNo = intval($seriesNo['SalesInvoice']['sales_invoice_no']);

            $seriesSalesNo = str_pad(++$nextSalesNo,6,'0',STR_PAD_LEFT); 

        }else{

            $nextSalesNo = intval(0);

            $seriesSalesNo = str_pad(++$nextSalesNo,6,'0',STR_PAD_LEFT);

        }
 

        $this->set(compact('deliveryUUID', 'seriesSalesNo'));

        if (!empty($deliveryId)) {

             $this->render('SalesInvoice/modal_body', false);
         } else {

            echo "no Forms Yet";
        }


    }

    public function search_order($hint = null, $view = null){

        if($view == 'add'){

            $this->loadModel('Delivery.Delivery');

            $this->loadModel('Sales.ClientOrder');

            $this->loadModel('Sales.Company');
            //$deliveryData = $this->Delivery->find('all');

            $deliveryData = $this->Delivery->find('all',array(
                          'conditions' => array(
                            'OR' => array(
                            array('Delivery.clients_order_id LIKE' => '%' . $hint . '%'),
                              array('Delivery.dr_uuid LIKE' => '%' . $hint . '%')
                              )
                            ),
                          'limit' => 10
                          )); 


            $poNumber = $this->ClientOrder->find('list', array('fields' => array('uuid', 'po_number')));

            $companyData = $this->Company->find('list', array('fields' => array('id', 'company_name')));
            $this->set(compact('seriesSalesNo', 'noPermissionPay', 'noPermissionReciv', 'deliveryData', 'clientOrderData', 'companyData', 'poNumber'));
            
            if ($hint == ' ') {
                $this->render('index');
            }else{
                $this->render('search_order');
            }

        }else{

            $userData = $this->Session->read('Auth');

            $invoiceData = $this->SalesInvoice->find('all',array(
                          'conditions' => array(
                            'OR' => array(
                            array('SalesInvoice.sales_invoice_no LIKE' => '%' . $hint . '%'),
                              array('SalesInvoice.dr_uuid LIKE' => '%' . $hint . '%')
                              )
                            ),
                          'limit' => 10
                          )); 


            $this->set(compact('invoiceData','noPermissionReciv','noPermissionPay'));

            if ($hint == ' ') {
                $this->render('index');
            }else{
                $this->render('search_order_index');
            }

        }
    }

        public function change_vat_status($invoiceId = null){

          //  pr($this->request->data); exit;

            $this->loadModel('Sales.QuotationItemDetail');

            //$this->QuotationItemDetail->bind(array('ClientOrder', 'QuotationDetail','Company', 'Product', 'Quotation', 'QuotationItemDetail', 'Company', 'Address'));

            // $clientVatStatus = $this->QuotationItemDetail->find('all', array(
            //                                 'conditions' => array('ClientOrder.id' => $clientOrderId
            //                                 )));

           // pr($this->request->data); exit;
       //     $this->QuotationItemDetail->id = $id;

            $this->QuotationItemDetail->saveFromInvoice( $this->request->data);

            $this->Session->setFlash(__('Vat Details has been Updated'), 'success');
      
            $this->redirect( array(
                'controller' => 'sales_invoice',   
                'action' => 'view',
                $invoiceId
            ));  
    //
     }

}