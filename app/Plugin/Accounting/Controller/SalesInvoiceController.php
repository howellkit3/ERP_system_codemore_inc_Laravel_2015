<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');
App::import('Vendor', 'DOMPDF', true, array(), 'dompdf'.DS.'dompdf_config.inc.php', false);

class SalesInvoiceController extends AccountingAppController {

    public $uses = array('Accounting.SalesInvoice');
    public $helpers = array('Accounting.PhpExcel','Accounting.DateFormat');

    public function index(){

        $userData = $this->Session->read('Auth');
        
        $this->loadModel('Sales.Company');

        $this->loadModel('Sales.ClientOrder');

        $this->loadModel('Delivery.Delivery');

        $limit = 10;

        $conditions = array('NOT' => array('SalesInvoice.status' => array(0,2)) );

        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'fields' => array(
                'SalesInvoice.id',
                'SalesInvoice.sales_invoice_no',
                'SalesInvoice.statement_no',  
                'SalesInvoice.dr_uuid', 
                'SalesInvoice.status',
                'SalesInvoice.delivery_id',
                'SalesInvoice.deliveries'
                ),
            'order' => 'SalesInvoice.id DESC',
        );

        $invoiceData = $this->paginate('SalesInvoice');

        $companyName = $this->Company->getList(array('id','company_name'));

        $deliveryNumHolder = $this->Delivery->find('list',array('fields' => array('dr_uuid','clients_order_id')));

        $clientDataHolder = $this->ClientOrder->find('list',array('fields' => array('uuid','company_id')));

        foreach($deliveryNumHolder as $key => $deliveryList) {
          
           $keyHolder = ltrim($key, '0');
           $deliveryNum[$keyHolder] = $deliveryList;
           
        }
      
      
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

        $date = date('Y/m/01').' - '.date('Y/m/d');

        $this->set(compact('invoiceData','noPermissionReciv','noPermissionPay','companyName', 'deliveryNumHolder', 'clientDataHolder','date'));

    }

    public function statement(){

        $this->loadModel('Sales.Company');

        $this->loadModel('Delivery.Delivery');

        $deliveryNumHolder = $this->Delivery->find('list',array('fields' => array('dr_uuid','company_id')));
        
        $userData = $this->Session->read('Auth');

        $limit = 10;

        $conditions = array('SalesInvoice.status' => 2);

        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'fields' => array(
                'SalesInvoice.id',
                'SalesInvoice.sales_invoice_no',
                'SalesInvoice.statement_no',  
                'SalesInvoice.dr_uuid', 
                'SalesInvoice.status',
                ),
            'order' => 'SalesInvoice.id DESC',
        );

        $invoiceData = $this->paginate('SalesInvoice');

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

      $companyName = $this->Company->getList(array('id','company_name'));



        $this->set(compact('invoiceData','noPermissionReciv','noPermissionPay', 'companyName', 'deliveryNumHolder','date'));

    }

    public function view($invoiceId = null,$saNo = null,$drno = null,$sino = null,$deliveryId = null){


       // Configure::write('debug',2);

        $userData = $this->Session->read('Auth');


        $this->loadModel('Sales.ClientOrder');

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

        $conditions = array('SalesInvoice.id' => $invoiceId);

        // if (!empty($drno) && !empty($sino)) {
        //          $conditions = array('SalesInvoice.dr_uuid' => $drno,'SalesInvoice.sales_invoice_no' => $sino );
           
        // }
        $invoiceData = $this->SalesInvoice->find('first', array(
                                            'conditions' => $conditions ));

        
        $prepared = $this->User->find('first', array('fields' => array('id', 'first_name','last_name'),
                                                            'conditions' => array('User.id' => $invoiceData['SalesInvoice']['created_by'])
                                                            )); 
        
        
        if(!empty($invoiceData['SalesInvoice']['dr_uuid']) || !empty($invoiceData['SalesInvoice']['deliveries'])  ){
           
            if (!empty($deliveryId)) {
                   
                   $this->Delivery->bindDeliverybyId();  
            
            } else {

                    $this->Delivery->bindDelivery();  
            }


            if (!empty($invoiceData['SalesInvoice']['is_multiple']) && $invoiceData['SalesInvoice']['is_multiple'] == 1) {

                // $drData = $this->Delivery->find('all', array(
                //                                 'conditions' => array('Delivery.dr_uuid' => $invoiceData['SalesInvoice']['dr_uuid']
                //                                 )));


               
                if (!empty($invoiceData['SalesInvoice']['deliveries']) && $invoiceData['SalesInvoice']['deliveries'] != 'null') {

                    $deliveryId = json_decode($invoiceData['SalesInvoice']['deliveries']);


                       $conditions = 'Delivery.dr_uuid IN ('.implode($deliveryId,',').') AND Delivery.status != "" ';

                } else {

                    $conditions = 'Delivery.dr_uuid = "'.$invoiceData['SalesInvoice']['dr_uuid'].'" AND Delivery.status != ""';    
                }

                // if (!empty($invoiceData['SalesInvoice']['invoice_date'])) {

                //      $conditions .= ' AND DeliveryDetail.schedule BETWEEN "'.$invoiceData['SalesInvoice']['invoice_date'].'" AND "'.$invoiceData['SalesInvoice']['invoice_date'].'"';
                // }

                // if ($invoiceData['SalesInvoice']['deliveries'] == 'null') {

                //     $conditions = 'Delivery.dr_uuid = "'.$invoiceData['SalesInvoice']['dr_uuid'].'"';
                // } else {

                //         $conditions = 'Delivery.dr_uuid IN ('.implode($deliveryId,',').')';
                // }


             

                $drData = $this->Delivery->query('SELECT *
                    FROM deliveries AS Delivery
                    LEFT JOIN koufu_sale.client_orders AS ClientOrder
                    ON ClientOrder.uuid = Delivery.clients_order_id
                    LEFT JOIN delivery_details AS DeliveryDetail
                    ON DeliveryDetail.delivery_id = Delivery.id
                    LEFT JOIN koufu_sale.client_order_delivery_schedules AS ClientOrderDeliverySchedule
                    ON ClientOrderDeliverySchedule.client_order_id = ClientOrder.id
                    LEFT JOIN koufu_sale.quotations AS Quotation
                    ON Quotation.id = ClientOrder.quotation_id
                     LEFT JOIN koufu_sale.quotation_details AS QuotationDetail
                    ON QuotationDetail.quotation_id = ClientOrder.quotation_id
                    LEFT JOIN koufu_sale.quotation_item_details AS QuotationItemDetail
                    ON QuotationItemDetail.id = ClientOrder.client_order_item_details_id
                    LEFT JOIN koufu_sale.companies AS Company
                    ON Company.id = Quotation.company_id
                    LEFT JOIN koufu_sale.products AS Product
                    ON Product.id = QuotationDetail.product_id
                    LEFT JOIN koufu_sale.addresses AS Address
                    ON Address.foreign_key = Company.id
                    WHERE '.$conditions.' group by Delivery.id ORDER by Delivery.id DESC');
        
                    if (!empty($_GET['test'])){

                      // $drData = $this->ClientOrder->checkPo($drData);
                        Configure::write('debug',2);
                        pr($conditions);
                        pr($drData); 
                        exit();
                    }
                    //check last PO
                  //  $drData = $this->ClientOrder->checkPo($drData);

                  $noPermissionPay = "";

                 $noPermissionReciv = "";
                 $companyData =  $drData[0]['Company']['company_name'];


            } else {

                $drConditions = array('Delivery.dr_uuid' => $invoiceData['SalesInvoice']['dr_uuid'] );

                if (!empty($deliveryId)) {
                    $drConditions = array_merge($drConditions,array('Delivery.id' => $deliveryId));
                }
                
                $drData = $this->Delivery->find('first', array(
                                                'conditions' => $drConditions ));
              // $this->ClientOrder->bind('ClientOrderDeliverySchedule');

                $clientOrder = $this->ClientOrder->find('first',array('conditions' => array('ClientOrder.uuid' => $drData['Delivery']['clients_order_id'])));


                $conditions = array('ClientOrderDeliverySchedule.client_order_id' =>$clientOrder['ClientOrder']['id']);

                $clientData = $this->ClientOrderDeliverySchedule->find('first', array(
                                        'conditions' => array($conditions
                                        )));    
           
                $clientOrderId = $clientData['ClientOrder']['id'];

                $companyData = $clientData['Company']['company_name'];

                $noPermissionPay = "";

                $noPermissionReciv = "";

                // pr( $drData );
                // exit();


            }

            
        }else{

            $drData = " ";
        }


        $this->set(compact('deliveries','invoiceId','prepared','approved','drData','clientData','companyData','units','invoiceData','paymentTermData','currencyData', 'noPermissionPay', 'noPermissionReciv','quotationData', 'clientOrderId'));
        
         if ($invoiceData['SalesInvoice']['is_multiple'] == 1 && empty($saNo)) {

             $this->render('view_multiple');
         }    
         if (!empty($saNo)) {

            if ($invoiceData['SalesInvoice']['is_multiple'] == 1) {

                $this->render('view_statement_multiple');

            } else {
                    
                $this->render('view_statement');
            }

        } 
    }

    public function add_statement(){

        if($this->request->is('post')){

            if(!empty($this->request->data)){

                $DRdata = $this->SalesInvoice->find('first', array(
                    'conditions' => array(
                        'SalesInvoice.dr_uuid' => $this->request->data['SalesInvoice']['dr_uuid']),
                        'order' => array('created DESC')
                    ));

                if (!empty($DRdata && $DRdata['SalesInvoice']['status'] != 3)) {

                        $this->Session->setFlash(__('This Delivery No. has been used. '), 'error');
                        $this->redirect( array(
                                     'controller' => 'salesInvoice', 
                                     'action' => 'add'
                                ));
                }

                $this->SalesInvoice->addSalesInvoice($this->request->data, $userData['User']['id']);

                $this->Session->setFlash(__(' Sales Statement completed. '), 'success');
                $this->redirect( array(
                             'controller' => 'sales_invoice', 
                             'action' => 'statement'
                        ));

            }
        }

        $noPermissionPay = "";

        $noPermissionReciv = "";

        $this->set(compact('seriesSalesNo', 'noPermissionPay', 'noPermissionReciv'));

    }

    public function add_invoice(){

        $userData = $this->Session->read('Auth');

        $DRdata = $this->SalesInvoice->find('first', array(
            'conditions' => array(
                'SalesInvoice.dr_uuid' => $this->request->data['SalesInvoice']['dr_uuid']),
                'order' => array('created DESC')
            ));

        if (!empty($DRdata) && $DRdata['SalesInvoice']['status'] != 3) {

            $this->Session->setFlash(__('This Delivery No. already have a Sales Invoice No. '), 'error');
            $this->redirect( array(
                         'controller' => 'salesInvoice', 
                         'action' => 'add','si_num'
                    ));
        }


        $this->SalesInvoice->addSalesInvoice($this->request->data, $userData['User']['id'],$DRdata);

        $this->Session->setFlash(__(' Sales Invoice No. completed. '), 'success');
        
        if ($this->request->data['SalesInvoice']['status'] == '0') {
               $this->redirect( array(
                     'controller' => 'sales_invoice', 
                     'action' => 'pre_invoices'
                ));

        } else {
                   $this->redirect( array(
                     'controller' => 'sales_invoice', 
                     'action' => 'index'
                ));
        }
     

    }

    public function add_apc_pre_invoce() {

        $userData = $this->Session->read('Auth');

        $DRdata = $this->SalesInvoice->find('first', array(
            'conditions' => array(
                'SalesInvoice.dr_uuid' => $this->request->data['SalesInvoice']['apc_dr']),
                'order' => array('created DESC')
            ));

        if (!empty($DRdata) && $DRdata['SalesInvoice']['status'] != 3) {

            $this->Session->setFlash(__('This Delivery No. already have a Sales Invoice No. '), 'error');
            $this->redirect( array(
                         'controller' => 'salesInvoice', 
                         'action' => 'add','si_num'
                    ));
        }

         $this->SalesInvoice->addSalesInvoice($this->request->data, $userData['User']['id'],$DRdata,'apc_dr');

        $this->Session->setFlash(__(' Sales Invoice No. completed. '), 'success');
        
        if ($this->request->data['SalesInvoice']['status'] == '0') {
               $this->redirect( array(
                     'controller' => 'sales_invoice', 
                     'action' => 'pre_invoices'
                ));

        } else {
                   $this->redirect( array(
                     'controller' => 'sales_invoice', 
                     'action' => 'index'
                ));
        }


    }

    public function add($indicator = null){

        $userData = $this->Session->read('Auth');

        $this->loadModel('Delivery.Delivery');

        $this->loadModel('Sales.ClientOrder');

        $this->loadModel('Sales.Company');

        $limit = 10;

        $search = '';

        $conditions = array();

        if (!empty($this->request->data['search'])) {

            $search = $this->request->data['search'];

            $conditions  =array_merge($conditions,array(
                'Delivery.dr_uuid like' => '%'. $search .'%'       
            ));
        }

        $params =  array('conditions' => $conditions,
            'limit' => $limit,
            'fields' => array(
                'Delivery.id',
                'Delivery.clients_order_id',
                'Delivery.company_id',  
                'Delivery.status',
                'Delivery.dr_uuid', 
                ),
                'order' => 'Delivery.id DESC',
                'group' => 'Delivery.id'

            );

        if ($indicator == 'dr_num')  {

            $params = array_merge($params,array('group' => 'Delivery.dr_uuid'));
        }


        $this->paginate = $params;

       // $this->Delivery->bindDelivery();

        $deliveryData = $this->paginate('Delivery');

        $allSaleInvoice = $this->SalesInvoice->find('list',array(
            'fields' => array('id','dr_uuid')
        ));

        $conditions = array('Delivery.dr_uuid NOT' => $allSaleInvoice,'Delivery.dr_uuid NOT LIKE' => '%x%');

        $allItems = $this->Delivery->find('list',array(
            'fields' => array('dr_uuid' , 'dr_uuid'),
            'conditions' => $conditions,
            'group' => 'Delivery.dr_uuid',
            'order' => 'Delivery.dr_uuid ASC'
        ));

      //  $poNumber = $this->ClientOrder->find('list', array('fields' => array('uuid', 'po_number')));
        $companyData = $this->Company->find('list', array('fields' => array('id', 'company_name')));

        $seriesNo = $this->SalesInvoice->find('first', array(
                'order' => array('SalesInvoice.created DESC')));
       
    
        if(!empty($seriesNo)){

            $nextSalesNo = intval($seriesNo['SalesInvoice']['sales_invoice_no']);
            $seriesSalesNo = str_pad(++$nextSalesNo,6,'0',STR_PAD_LEFT); 

        }else{

            $nextSalesNo = intval(0);
            $seriesSalesNo = str_pad(++$nextSalesNo,6,'0',STR_PAD_LEFT);

        }

        if (!empty($_GET['test']) == 1) {
             Configure::write('debug',2);

             pr( $seriesSalesNo );

                pr($seriesSalesNo);

            exit();
        }

        //  $conditions = array('NOT' => array('SalesInvoice.status' => array(2, 3)) );

        //     $seriesNo = $this->SalesInvoice->find('first', array(
        //         'order' => array('SalesInvoice.modified DESC'),
        //         'conditions' => $conditions));

        // if(!empty($seriesNo)){

        //     $nextSalesNo = intval($seriesNo['SalesInvoice']['sales_invoice_no']);

        //     $seriesSalesNo = str_pad(++$nextSalesNo,6,'0',STR_PAD_LEFT); 

        // }else{

        //     $nextSalesNo = intval(0);

        //     $seriesSalesNo = str_pad(++$nextSalesNo,6,'0',STR_PAD_LEFT);

        //     }
        
        $noPermissionPay = "";

        $noPermissionReciv = "";

        $this->set(compact('seriesNo','allItems','seriesSalesNo','search','indicator','noPermissionPay', 'noPermissionReciv', 'deliveryData', 'clientOrderData', 'companyData', 'poNumber'));
        
        if ($indicator == 'si_num') {

            $output = $this->render('add');

        }else if($indicator == 'dr_num') { 

            if ($this->request->is('ajax')) {

            $output = $this->render('SalesInvoice/ajax/add_by_dr');
            
            } else {

            $output = $this->render('add_by_dr');
            }


        } else if($indicator == 'sa_dr_num') { 

             $output = $this->render('sa_add_by_dr');
        } else {

            $output = $this->render('add_statement');
        }
    }

    public function add_by_apc() {

        //Configure::write('debug',2);

        $this->loadModel('Delivery.DeliveryConnection');

        $this->loadModel('Delivery.Delivery');

        $search = '';

        $this->Delivery->bindDeliveryById();

        $conditions = array('DeliveryDetail.apc_dr NOT' => '');

        $params =  array(   
                'conditions' => $conditions,
                'limit' => 10,
                'order' => 'Delivery.id DESC',
                'group' => 'DeliveryDetail.apc_dr DESC'
        );

        $this->paginate = $params;

        $itemsDelivery = $this->paginate('Delivery');
        
        $noPermissionPay = "";

        $noPermissionReciv = "";

        $indicator = '';
        

        $this->set(compact('items','itemsDelivery','noPermissionReciv','noPermissionPay','indicator','search'));
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
 
    public function print_invoice($invoiceId = null ,$clientsId = null, $saNo = null,$deliveryId = null) {

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

        $invoiceData = $this->SalesInvoice->find('first', array(
                                            'conditions' => array('SalesInvoice.id' => $invoiceId
                                            )));

        $prepared = $this->User->find('first', array('fields' => array('id', 'first_name','last_name'),
                                                            'conditions' => array('User.id' => $invoiceData['SalesInvoice']['created_by'])
                                                            )); 
 
        $this->Delivery->bindDelivery();

        $drConditions = array('Delivery.dr_uuid' => $invoiceData['SalesInvoice']['dr_uuid'] );

        if (!empty($deliveryId)) {
            $this->Delivery->bindDeliverybyId();  
            $drConditions = array_merge($drConditions,array('Delivery.id' => $deliveryId));
        } else {


            $this->Delivery->bindDelivery();  
        }

         $drData = $this->Delivery->find('first', array(
                                        'conditions' => $drConditions ));
           
        

        $clientData = $this->ClientOrderDeliverySchedule->find('first', array(
                                            'conditions' => array('ClientOrder.id' => $clientsId
                                            )));

        
        $this->set(compact('prepared','approved','drData','clientData','companyData','units','invoiceData','paymentTermData','currencyData'));
           
        if (!empty($saNo)) {

            $output = $this->render('print_statement');

        }else{

            $output = $this->render('print_invoice');
        }
        
    }

    public function print_invoice_multiple($invoiceId = null ,$dr_uuid = null) {

        $userData = $this->Session->read('Auth');

        $this->loadModel('Sales.ClientOrderDeliverySchedule');

        $this->loadModel('Currency');

        // $this->ClientOrderDeliverySchedule->bind(array('ClientOrder', 'QuotationDetail','Company', 'Product', 'Quotation', 'QuotationItemDetail', 'Company', 'Address'));
        
        $this->loadModel('Delivery.Delivery');

        $this->loadModel('Sales.PaymentTermHolder');

        $this->loadModel('Sales.ClientOrder');

            
        $paymentTermData = Cache::read('paymentTerms');
        
        if (!$paymentTermData) {
            $paymentTermData = $this->PaymentTermHolder->getList(null,array('id','name'));
            Cache::write('paymentTerms', $paymentTermData);
        }
        $currencyData = Cache::read('currencyData');
       
        $currencyData = $this->Currency->find('list', array('fields' => array('id', 'name'),
                                                        'order' => array('Currency.name' => 'ASC')
                                                        ));

         $invoiceData = $this->SalesInvoice->read(null,$invoiceId );

        if (!empty($invoiceData['SalesInvoice']['deliveries'])  && $invoiceData['SalesInvoice']['deliveries'] != 'null') {

                $deliveryId = json_decode($invoiceData['SalesInvoice']['deliveries']);

              
                    $conditions = 'Delivery.dr_uuid IN ('.implode($deliveryId,',').') AND Delivery.status != ""';

            } else {

                     $conditions = 'Delivery.dr_uuid = "'.$invoiceData['SalesInvoice']['dr_uuid'].'" AND Delivery.status != ""';
            }



        $drData = $this->Delivery->query('SELECT *
                FROM deliveries AS Delivery
                LEFT JOIN koufu_sale.client_orders AS ClientOrder
                ON ClientOrder.uuid = Delivery.clients_order_id
                LEFT JOIN delivery_details AS DeliveryDetail
                ON DeliveryDetail.delivery_id = Delivery.id
                LEFT JOIN koufu_sale.client_order_delivery_schedules AS ClientOrderDeliverySchedule
                ON ClientOrderDeliverySchedule.client_order_id = ClientOrder.id
                LEFT JOIN koufu_sale.quotations AS Quotation
                ON Quotation.id = ClientOrder.quotation_id
                LEFT JOIN koufu_sale.quotation_details AS QuotationDetail
                ON QuotationDetail.quotation_id = ClientOrder.quotation_id
                LEFT JOIN koufu_sale.quotation_item_details AS QuotationItemDetail
                ON QuotationItemDetail.id = ClientOrder.client_order_item_details_id
                LEFT JOIN koufu_sale.companies AS Company
                ON Company.id = Quotation.company_id
                LEFT JOIN koufu_sale.products AS Product
                ON Product.id = QuotationDetail.product_id
                LEFT JOIN koufu_sale.addresses AS Address
                ON Address.foreign_key = Company.id
                WHERE '. $conditions.' group by Delivery.id ORDER by Delivery.id DESC');

    

        //check last PO
        //$drData = $this->ClientOrder->checkPo($drData);

        $noPermissionPay = "";

        $noPermissionReciv = "";
        
        $companyData =  $drData[0]['Company']['company_name'];

        $this->set(compact('prepared','approved','drData','clientData','currencyData','companyData','units','invoiceData','paymentTermData','currencyData'));
           
        if (!empty($saNo)) {

            $output = $this->render('print_statement');

        }else{

            $output = $this->render('print_invoice_multiple');
        }

    }



    public function print_sa_multiple($invoiceId = null ,$dr_uuid = null) {

        $userData = $this->Session->read('Auth');

        $this->loadModel('Sales.ClientOrderDeliverySchedule');

        $this->loadModel('Currency');

        // $this->ClientOrderDeliverySchedule->bind(array('ClientOrder', 'QuotationDetail','Company', 'Product', 'Quotation', 'QuotationItemDetail', 'Company', 'Address'));
        
        $this->loadModel('Delivery.Delivery');

        $this->loadModel('Sales.PaymentTermHolder');
            
        $paymentTermData = Cache::read('paymentTerms');
        
        if (!$paymentTermData) {
            $paymentTermData = $this->PaymentTermHolder->getList(null,array('id','name'));
            Cache::write('paymentTerms', $paymentTermData);
        }

        $currencyData = Cache::read('currencyData');
       
        $currencyData = $this->Currency->find('list', array('fields' => array('id', 'name'),
                                                        'order' => array('Currency.name' => 'ASC')
                                                        ));
           $invoiceData = $this->SalesInvoice->find('first',array(
            'conditions' => array('SalesInvoice.id' => $invoiceId),
            'order' => 'SalesInvoice.id DESC'
            ));


        $drData = $this->Delivery->query('SELECT *
                FROM deliveries AS Delivery
                LEFT JOIN koufu_sale.client_orders AS ClientOrder
                ON ClientOrder.uuid = Delivery.clients_order_id
                LEFT JOIN delivery_details AS DeliveryDetail
                ON DeliveryDetail.delivery_id = Delivery.id
                LEFT JOIN koufu_sale.client_order_delivery_schedules AS ClientOrderDeliverySchedule
                ON ClientOrderDeliverySchedule.client_order_id = ClientOrder.id
                LEFT JOIN koufu_sale.quotations AS Quotation
                ON Quotation.id = ClientOrder.quotation_id
                LEFT JOIN koufu_sale.quotation_details AS QuotationDetail
                ON QuotationDetail.quotation_id = ClientOrder.quotation_id
                LEFT JOIN koufu_sale.quotation_item_details AS QuotationItemDetail
                ON QuotationItemDetail.id = ClientOrder.client_order_item_details_id
                LEFT JOIN koufu_sale.companies AS Company
                ON Company.id = Quotation.company_id
                LEFT JOIN koufu_sale.products AS Product
                ON Product.id = QuotationDetail.product_id
                LEFT JOIN koufu_sale.addresses AS Address
                ON Address.foreign_key = Company.id
                WHERE Delivery.dr_uuid = "'.$dr_uuid.'" group by Delivery.id');
        

         $noPermissionPay = "";

         $noPermissionReciv = "";
         
         $companyData =  $drData[0]['Company']['company_name'];

         $this->set(compact('prepared','approved','drData','clientData','currencyData','companyData','units','invoiceData','paymentTermData','currencyData'));
    


    }

    public function receivable(){

        Configure::write('debug',2);

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

        // $invoiceData = $this->SalesInvoice->find('all',array(
        //     'conditions' => array('NOT' => array('SalesInvoice.status' => 0)),
        //     'order' => 'SalesInvoice.id DESC'
        //     ));

        $params =  array(
                'conditions' => array('SalesInvoice.status' => 0),
                'limit' => 10,
                'order' => 'SalesInvoice.id DESC',
        );

        $this->paginate = $params;

        $invoiceData = $this->paginate('SalesInvoice');

 

      //  pr();
        
        $deliveryData = $this->Delivery->find('all',array(
            'conditions' => array('dr_uuid' => $invoiceList),
            'limit' => 10,
            'order' => 'Delivery.id DESC'
            ));

        $clientsId = array();

        foreach ($deliveryData as $key => $value) {
            
            $invoiceData[$key]['SalesInvoice']['schedule_uuid'] = $value['Delivery']['schedule_uuid'];

            $invoiceData[$key]['SalesInvoice']['clients_order_id'] = $value['Delivery']['clients_order_id'];
            
            array_push($clientsId, $value['Delivery']['clients_order_id']);
           
        }

        $deliveryDetails = $this->DeliveryDetail->find('all',array(
            'conditions' => array('delivery_uuid' => $invoiceList),
            'order' => 'DeliveryDetail.id DESC',
            'limit' => 10
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

        }
        
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
                'order' => array('ReceivedItem.id DESC'), 'fields' => array('ReceivedItem.id', 'DeliveredOrder.id' )));
 
        }

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

    public function daterange_summary_payables($from = null, $to = null, $company = null){

        $this->loadModel('WareHouse.ReceivedItem');

        $this->loadModel('Purchasing.PurchaseOrder');

        $this->loadModel('Supplier');

        $this->loadModel('User');

        $this->ReceivedItem->bind('DeliveredOrder', 'PurchaseOrder');

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

        $limit = 10;

        $conditions = " ";

        $params =  array(
                'conditions' => $conditions,
                'limit' => $limit,
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

        $supplierName = $this->Supplier->find('list', array('fields' => array('id', 'name'), 
                'order' => array('Supplier.name ASC')));

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

    public function invoice_modal($deliveryId = null, $deliveryUUID = null, $indicator = null,$isMultiple = false) {


        $this->loadModel('Delivery.Delivery');

        $this->loadModel('Delivery.DeliveryDetail');

        $deliveries = array();

        if (!empty($deliveryId)) {

            $this->Delivery->bindDeliveryById();

            $deliveries = $this->Delivery->findById($deliveryId);
        
        }

        $apcDr = $this->Delivery->findApc( $deliveries );
        
        if ($indicator == "si_num") {

            $conditions = array('NOT' => array('SalesInvoice.status' => array(2, 3)) );

            $seriesNo = $this->SalesInvoice->find('first', array(
                    'order' => array('SalesInvoice.created DESC'),
                    'conditions' => $conditions));

            if(!empty($seriesNo)){

                $nextSalesNo = intval($seriesNo['SalesInvoice']['sales_invoice_no']);

                $seriesSalesNo = str_pad(++$nextSalesNo,6,'0',STR_PAD_LEFT); 

            }else{

                $nextSalesNo = intval(0);

                $seriesSalesNo = str_pad(++$nextSalesNo,6,'0',STR_PAD_LEFT);

            }
 
        } else if($indicator == 'apc_dr') {

            $conditions = array('NOT' => array('SalesInvoice.status' => array(2, 3)) );

            $seriesNo = $this->SalesInvoice->find('first', array(
                    'order' => array('SalesInvoice.created DESC'),
                    'conditions' => $conditions));

            if(!empty($seriesNo)){

                $nextSalesNo = intval($seriesNo['SalesInvoice']['sales_invoice_no']);

                $seriesSalesNo = str_pad(++$nextSalesNo,6,'0',STR_PAD_LEFT); 

            }else{

                $nextSalesNo = intval(0);

                $seriesSalesNo = str_pad(++$nextSalesNo,6,'0',STR_PAD_LEFT);

            }

        }else{

            $conditions = array();

            $seriesNo = $this->SalesInvoice->find('first', array(
                    'order' => array('SalesInvoice.created DESC'),
                    'conditions' => $conditions));

            if (!empty($seriesNo)) {

                $nextSalesNo = intval($seriesNo['SalesInvoice']['statement_no']);

                $seriesSalesNo = str_pad(++$nextSalesNo,6,'0',STR_PAD_LEFT); 

            } else{

                $nextSalesNo = intval(0);

                $seriesSalesNo = str_pad(++$nextSalesNo,6,'0',STR_PAD_LEFT);

            }

        }

        $this->set(compact('deliveryUUID', 'seriesSalesNo', 'indicator','isMultiple','deliveryId','deliveries','apcDr'));

        if (!empty($deliveryId)) {

             $this->render('SalesInvoice/modal_body', false);
         } else {

            echo "no Forms Yet";
        }

    }

    public function search_order($view = null, $hint = null, $type = null, $indicator = null){

    //Configure::write('debug',2);
    
       $this->loadModel('Sales.Company');
            
       $companyData = $this->Company->find('list', array('fields' => array('id', 'company_name')));
       
        $this->loadModel('Delivery.Delivery');

        $this->loadModel('Sales.ClientOrder');

        $deliveryNumHolder = $this->Delivery->find('list',array('fields' => array('dr_uuid','clients_order_id')));

        $clientDataHolder = $this->ClientOrder->find('list',array('fields' => array('uuid','company_id')));

 
        if($type == '1'){

            $this->loadModel('Delivery.Delivery');

            $deliveryData = $this->Delivery->query('SELECT ClientOrder.id ,ClientOrder.po_number , ClientOrder.uuid, Company.id, Company.company_name , Delivery.dr_uuid, Delivery.company_id, Delivery.dr_uuid, Delivery.clients_order_id , Delivery.status,  Delivery.id 
                FROM koufu_delivery.deliveries AS Delivery
                LEFT JOIN koufu_sale.client_orders AS ClientOrder
                ON Delivery.clients_order_id = ClientOrder.uuid 
                LEFT JOIN koufu_sale.companies AS Company
                ON ClientOrder.company_id = Company.id 
                WHERE Delivery.dr_uuid LIKE "%'.$hint.'%" OR ClientOrder.po_number LIKE "%'.$hint.'%"
                OR Company.company_name LIKE "%'.$hint.'%" OR ClientOrder.uuid LIKE "%'.$hint.'%" GROUP by Delivery.id DESC ');
            

            $this->set(compact('seriesSalesNo', 'noPermissionPay', 'noPermissionReciv', 'deliveryData', 'clientOrderData',  'poNumber', 'companyData','indicator'));
            

            if ($hint == ' ') {
                $this->render('index');
            }else{

                if($type == 0){

                    $this->render('search_order');

                }else{

                    $this->render('search_dr_order');

                }
            }

        } else if($type == '2'){

            $userData = $this->Session->read('Auth');

            $invoiceData = $this->SalesInvoice->query('SELECT SalesInvoice.id ,SalesInvoice.status , SalesInvoice.statement_no, Company.id, Company.company_name , Delivery.dr_uuid, Delivery.company_id, Delivery.dr_uuid,SalesInvoice.deliveries ,SalesInvoice.dr_uuid ,SalesInvoice.created
                FROM koufu_delivery.deliveries AS Delivery
                LEFT JOIN koufu_accounting.sales_invoices AS SalesInvoice
                ON Delivery.dr_uuid = SalesInvoice.dr_uuid 
                LEFT JOIN koufu_sale.client_orders AS ClientOrder
                ON Delivery.clients_order_id = ClientOrder.uuid 
                LEFT JOIN koufu_sale.companies AS Company
                ON ClientOrder.company_id = Company.id 
                WHERE Delivery.dr_uuid LIKE "%'.$hint.'%" OR SalesInvoice.statement_no LIKE "%'.$hint.'%"
                OR Company.company_name LIKE "%'.$hint.'%"  AND SalesInvoice.status = 2 GROUP by SalesInvoice.id DESC');
            
            $this->set(compact('companyData','invoiceData','noPermissionReciv','noPermissionPay', 'deliveryNumHolder','indicator'));

            if ($hint == ' ') {

                $this->render('statement');

            }else{

                $this->render('search_statement_account');
            }
        
        }else{


            $userData = $this->Session->read('Auth');

            // $invoiceData = $this->SalesInvoice->query('SELECT SalesInvoice.id ,SalesInvoice.status , SalesInvoice.sales_invoice_no, Company.id, Company.company_name , Delivery.dr_uuid, Delivery.id, Delivery.company_id, Delivery.dr_uuid, SalesInvoice.dr_uuid 
            //     FROM koufu_delivery.deliveries AS Delivery
            //     LEFT JOIN koufu_accounting.sales_invoices AS SalesInvoice
            //     ON Delivery.dr_uuid = SalesInvoice.dr_uuid 
            //     LEFT JOIN koufu_sale.client_orders AS ClientOrder
            //     ON Delivery.clients_order_id = ClientOrder.uuid 
            //     LEFT JOIN koufu_sale.companies AS Company
            //     ON ClientOrder.company_id = Company.id 
            //     WHERE Delivery.dr_uuid LIKE "%'.$hint.'%" OR SalesInvoice.sales_invoice_no LIKE "%'.$hint.'%"
            //     OR Company.company_name LIKE "%'.$hint.'%" AND SalesInvoice.status = 1 Group by SalesInvoice.id DESC');

          //  pr('test2x');
                $invoiceData = $this->SalesInvoice->query('SELECT SalesInvoice.id ,SalesInvoice.status , SalesInvoice.sales_invoice_no, Company.id, Company.company_name , Delivery.dr_uuid, Delivery.id, Delivery.company_id, Delivery.dr_uuid, SalesInvoice.dr_uuid, SalesInvoice.deliveries,SalesInvoice.apc_dr ,SalesInvoice.created
                    FROM koufu_delivery.deliveries AS Delivery
                    LEFT JOIN koufu_accounting.sales_invoices AS SalesInvoice
                    ON Delivery.dr_uuid = SalesInvoice.dr_uuid 
                    LEFT JOIN koufu_sale.client_orders AS ClientOrder
                    ON Delivery.clients_order_id = ClientOrder.uuid 
                    LEFT JOIN koufu_sale.companies AS Company
                    ON ClientOrder.company_id = Company.id 
                    WHERE Delivery.dr_uuid LIKE "%'.$hint.'%" OR SalesInvoice.sales_invoice_no LIKE "%'.$hint.'%"
                    OR SalesInvoice.apc_dr LIKE "%'.$hint.'%" 
                    OR Company.company_name LIKE "%'.$hint.'%" AND SalesInvoice.status = 1 Group by SalesInvoice.id DESC');


            $this->set(compact('companyData','invoiceData','noPermissionReciv','noPermissionPay', 'deliveryNumHolder','indicator','clientDataHolder'));

            if ($hint == ' ') {

                $this->render('index');
            }else{

                $this->render('search_order_index');
            }

        }


           

    }

    public function cancel($invoiceId = null){

        $userData = $this->Session->read('Auth');

        $this->SalesInvoice->id = $invoiceId;

        $this->SalesInvoice->saveField('status', 3);

        $this->SalesInvoice->saveField('modified_by', $userData['User']['id']);

        $this->Session->setFlash(__('Sales Invoice has been Cancelled'), 'success');
      
        $this->redirect( array(
            'controller' => 'sales_invoice',   
            'action' => 'index',
            $invoiceId
        ));  

    }

    public function change_vat_status($invoiceId = null){

            $this->loadModel('Sales.QuotationItemDetail');

            $this->QuotationItemDetail->saveFromInvoice($this->request->data);

            $this->Session->setFlash(__('Vat Details has been Updated'), 'success');
      
            $this->redirect( array(
                'controller' => 'sales_invoice',   
                'action' => 'view',
                $invoiceId
            ));  
     }

     public function change_vat_status_multiple($invoiceId = null) {


        $this->loadModel('Sales.QuotationItemDetail');
        
        if (!empty($this->request->data)) {

            $data = $this->request->data;

            $newData = array();

            foreach ( $data['QuotationItemDetail']['Item'] as $key => $value) {
              
              $newData['QuotationItemDetail']['id'] = $value['id'];

              $newData['QuotationItemDetail']['quantity'] = $value['quantity'];  

                if($data['QuotationItemDetail']['vat_status'] == 1){

                    $newData['QuotationItemDetail']['vat_status'] = 'Vatable Sale';
                }

                if($data['QuotationItemDetail']['vat_status'] == 2){

                    $newData['QuotationItemDetail']['vat_status'] = 'Vat Exempt';
                }

                if($data['QuotationItemDetail']['vat_status'] == 3){

                    $newData['QuotationItemDetail']['vat_status'] = 'Zero Rated Sale';
                }

                if (!empty($data['QuotationItemDetail']['vat_price'])) {
                         $newData['QuotationItemDetail']['vat_price'] = $data['QuotationItemDetail']['vat_price'];
                }

               // pr($newData);
            $this->QuotationItemDetail->create();
            //pr($data); exit;
            $save = $this->QuotationItemDetail->save($newData);


            }

            if ($save) {
                 $this->Session->setFlash(__('Vat Details has been Updated'), 'success');
      
            } else {

                 $this->Session->setFlash(__('There\'s an error updating vat'), 'error');
      
            }
        }   

        $this->redirect( array(
                'controller' => 'sales_invoice',   
                'action' => 'view',
                $invoiceId
            ));

     }

    public function company_filter_payables($from = null, $to = null,$company = null){

        $this->loadModel('WareHouse.ReceivedItem');

        $this->loadModel('Purchasing.PurchaseOrder');

        $this->loadModel('Supplier');

        $this->loadModel('User');

        $this->ReceivedItem->bind('DeliveredOrder', 'PurchaseOrder');

        $receivedItemData = $this->ReceivedItem->query('SELECT *
                FROM dev_koufu_warehouse.received_items AS ReceivedItem
                INNER JOIN dev_koufu_warehouse.delivered_orders AS DeliveredOrder
                ON ReceivedItem.delivered_order_id = DeliveredOrder.id 
                INNER JOIN dev_koufu_warehouse.received_orders AS ReceivedOrders
                ON ReceivedItem.received_orders_id = ReceivedOrders.id
                INNER JOIN dev_koufu_purchasing.purchase_orders AS PurchaseOrder
                ON DeliveredOrder.purchase_orders_id = PurchaseOrder.id 
                WHERE PurchaseOrder.supplier_id LIKE "%'.$company.'%"  
                AND (DeliveredOrder.created BETWEEN "'.$from.' 00:00:00'.'" AND "'.$to.' 00:00:00'.'")'
                );

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

    public function test(){

         $this->loadModel('WareHouse.ReceivedItem');

        $this->ReceivedItem->bind('DeliveredOrder', 'PurchaseOrder');
        $receivedItemData = $this->ReceivedItem->find('all', array(
                'order' => array('ReceivedItem.id DESC')));

        foreach ($receivedItemData as $key => $value) {

                $this->ReceivedItem->id = $value['ReceivedItem']['id'];
    
                $this->ReceivedItem->saveField('purchasing_order_id', $value['DeliveredOrder']['purchase_orders_id']);

            }

    }

    public function move($sales_invoice_id = null, $sa_no = null){ 

        $userData = $this->Session->read('Auth');

        $invoiceData = $this->SalesInvoice->find('first', array(
                'conditions' => array(
                    'SalesInvoice.id' =>$sales_invoice_id)
            ));

        if(empty($sa_no)){

            if(empty($invoiceData['SalesInvoice']['statement_no'])){

                $statementNumber = $this->SalesInvoice->find('first', array(
                        'fields' => array('SalesInvoice.statement_no'),
                        'conditions' => array(
                            'NOT' => array('SalesInvoice.statement_no' => null)),
                        'order' => 'SalesInvoice.statement_no DESC'
                ));

                $statementNum = $statementNumber['SalesInvoice']['statement_no'] + 1;
                $invoiceData['SalesInvoice']['status'] = 2;
                $statementNum = str_pad($statementNum, 6, '0', STR_PAD_LEFT);
                $invoiceData['SalesInvoice']['statement_no'] = $statementNum;

            }else{

                $statementNum = $invoiceData['SalesInvoice']['statement_no'];
                $invoiceData['SalesInvoice']['status'] = 2;

            }

            $this->SalesInvoice->save($invoiceData);

            $this->Session->setFlash(__('Sales Invoive has been changed to Statement of Account'), 'success');
      
            $this->redirect( array(
                'controller' => 'sales_invoice',   
                'action' => 'statement'
            ));

        }else{

            if(empty($invoiceData['SalesInvoice']['sales_invoice_no'])){

                $conditions = array('NOT' => array('SalesInvoice.status' => 2) );

                $SINumber = $this->SalesInvoice->find('first', array(
                        'order' => array('SalesInvoice.modified DESC'),
                        'conditions' => $conditions));

                $SINum = $SINumber['SalesInvoice']['sales_invoice_no'] + 1;
                $invoiceData['SalesInvoice']['status'] = 1;
                $SINum = str_pad($SINum, 6, '0', STR_PAD_LEFT);
                $invoiceData['SalesInvoice']['sales_invoice_no'] = $SINum;

            }else{

                $SINumber = $invoiceData['SalesInvoice']['sales_invoice_no'];
                $SINumber = str_pad($SINumber, 6, '0', STR_PAD_LEFT);
                $invoiceData['SalesInvoice']['sales_invoice_no'] = $SINumber;
                $invoiceData['SalesInvoice']['status'] = 1;

            }

            $this->SalesInvoice->addSalesInvoice($invoiceData, $userData['User']['id']);

            $this->Session->setFlash(__('Sales Invoive has been changed to Statement of Account'), 'success');
      
            $this->redirect( array(
                'controller' => 'sales_invoice',   
                'action' => 'index'
            ));
        }
    }


    public function pre_invoices() {

        $date = date('Y/m/01').' - '.date('Y/m/d');

        $userData = $this->Session->read('Auth');
        
        $this->loadModel('Sales.Company');

        $this->loadModel('Sales.ClientOrder');

        $this->loadModel('Delivery.Delivery');

        $this->loadModel('Delivery.Plant');

        $limit = 10;

        $conditions = array('SalesInvoice.status' => 0);

       $companyName = $this->Company->getList(array('id','company_name'));

        $plants = $this->Plant->find('list',array('fields' => array('id','name')));
        
        $query = $this->request->query;
        
        if (!empty($query['data']['date'])) {

            $date = $query['data']['date'];

                if (!empty($query['data']['date'])) {

                    $dates = explode('-',$query['data']['date']);

    

           $date1 =  date('Y-m-d',strtotime($dates[0])).' 00:00:00';
           
           $date2 = date('Y-m-d',strtotime($dates[1])).' 00:00:00';

           $conditions = array_merge($conditions,array(
                        'OR' => array(
                            'date(SalesInvoice.created) BETWEEN ? AND ?' => array($date1,$date2),
                            'date(SalesInvoice.invoice_date) BETWEEN ? AND ?' => array($date1,$date2),
                            )   
               ));

                }

        }

        if (!empty($query['data']['action'])) {

            $invoices = $this->SalesInvoice->find('all',array(

                'conditions' => $conditions,
                'order' => 'SalesInvoice.id DESC'
            ));

            $deliveries = array();

            foreach ($invoices as $key => $list) {

                    $dr = $this->Delivery->find('all',array(
                        'conditions' => array(
                                'Delivery.dr_uuid' => $list['SalesInvoice']['dr_uuid']
                        )
                    ));

                    $dr = $this->Delivery->query('SELECT *
                    FROM deliveries AS Delivery
                    LEFT JOIN koufu_sale.client_orders AS ClientOrder
                    ON ClientOrder.uuid = Delivery.clients_order_id 
                    LEFT JOIN koufu_delivery.delivery_details AS DeliveryDetail
                    ON Delivery.dr_uuid = DeliveryDetail.delivery_uuid
                    LEFT JOIN koufu_sale.quotation_item_details AS QuotationItemDetail
                    ON QuotationItemDetail.id = ClientOrder.client_order_item_details_id
                    LEFT JOIN koufu_sale.quotation_details AS QuotationDetail
                    ON ClientOrder.quotation_id = QuotationDetail.quotation_id
                    LEFT JOIN koufu_sale.products AS Product
                    ON Product.id = QuotationDetail.product_id
                    LEFT JOIN koufu_sale.companies AS Company
                    ON Company.id = ClientOrder.company_id
                    WHERE Delivery.dr_uuid = "'.$list['SalesInvoice']['dr_uuid'].'" 
                    ');

                    $deliveries[$key] = $list;
                    $deliveries[$key]['Delivery'] = $dr;

            }

            // pr($deliveries);
            // exit();

            $this->set(compact('invoices','companies','deliveries'));
            $this->render('SalesInvoice/xls/pre_invoices');

            exit();

        }

       // $this->SalesInvoice->bindDeliverybyId();

        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'fields' => array(
                'SalesInvoice.id',
                'SalesInvoice.sales_invoice_no',
                'SalesInvoice.statement_no',  
                'SalesInvoice.dr_uuid', 
                'SalesInvoice.status',
                'SalesInvoice.delivery_id',
                'SalesInvoice.created',
                'SalesInvoice.invoice_date',
                'SalesInvoice.deliveries',
                'SalesInvoice.apc_dr',
                'SalesInvoice.plant_id'
                ),
            'order' => 'SalesInvoice.id DESC',
        );

        $invoiceData = $this->paginate('SalesInvoice');


        $deliveryNumHolder = $this->Delivery->find('list',array('fields' => array('dr_uuid','clients_order_id')));

        $clientDataHolder = $this->ClientOrder->find('list',array('fields' => array('uuid','company_id')));

        foreach($deliveryNumHolder as $key => $deliveryList) {
          
           $keyHolder = ltrim($key, '0');
           $deliveryNum[$keyHolder] = $deliveryList;
           
        }
      
      
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

        $this->set(compact('invoiceData','noPermissionReciv','noPermissionPay','companyName', 'deliveryNumHolder', 'clientDataHolder','date',' plants'));

    }

     function isJson($string) {
     json_decode($string);

        if ((json_last_error() == JSON_ERROR_NONE) && count(json_decode($string)) > 0) {

            return true;
        }
    }
       public function export_invoice() {


        Configure::write('debug',0);

        $date = date('Y/m/1') . '-'. date('Y/m/d');

        $userData = $this->Session->read('Auth');
        
        $this->loadModel('Sales.Company');

        $this->loadModel('Sales.ClientOrder');

        $this->loadModel('Delivery.Delivery');

        $this->loadModel('Delivery.Plant');

        $limit = 10;

        $query = $this->request->query;

        $conditions = array();

        if (!empty($query['type'])) {

         $conditions = array_merge($conditions,array('SalesInvoice.status' => $query['type']));   

        }


     $companyName = $this->Company->getList(array('id','company_name'));

        $plants = $this->Plant->find('list',array('fields' => array('id','name')));
        
        
        if (!empty($query['data']['date'])) {

            $date = $query['data']['date'];

                if (!empty($query['data']['date'])) {

                    $dates = explode('-',$query['data']['date']);

    

           $date1 =  date('Y-m-d',strtotime($dates[0])).' 00:00:00';
           
           $date2 = date('Y-m-d',strtotime($dates[1])).' 00:00:00';

           $conditions = array_merge($conditions,array(
                        'OR' => array(
                            'date(SalesInvoice.created) BETWEEN ? AND ?' => array($date1,$date2),
                            'date(SalesInvoice.invoice_date) BETWEEN ? AND ?' => array($date1,$date2),
                            )   
               ));

                }

        }
  

            
        $customerID = 0;

        if (!empty($query['data']['action']) && in_array($query['data']['action'], array('go','export'))) {

            if (!empty($query['company_id'])) {

                $customerID = $query['company_id'];

                $this->loadModel('Delivery.Delivery');

                if (in_array($query['company_id'],array('3','4','5','6','60','102','1223'))) {
                    
                    $company_conditions =  array(
                                'Delivery.company_id' => array('3','4','5','6','60','102','1223'),

                        );
                } else {
                     $company_conditions =  array(
                                'Delivery.company_id' => $query['company_id']
                        );

                }

                $dr = $this->Delivery->find('list',array(

                        'conditions' =>$company_conditions,
                        'group' => array('Delivery.id'),
                        'fields' => array('Delivery.id','Delivery.dr_uuid')
                ));

                $drUUID = array_unique($dr);

                $conditions = array_merge($conditions,array(
                    'SalesInvoice.dr_uuid' =>  $drUUID
                ));

            }

            $conditions = array_merge($conditions,array(
                'OR' => array(
                        'SalesInvoice.dr_uuid !=' => '',
                        'SalesInvoice.deliveries !=' => '[]' 
                )
            ));

          //  exit();
           // $conditions = 

            //$this->SalesInvoice->bindInvoice();

            $invoices = $this->SalesInvoice->find('all',array(

                'conditions' => $conditions,
                'order' => 'SalesInvoice.id DESC'
            ));


            $deliveries = array();


            foreach ($invoices as $key => $list) {

                    $this->Delivery->bindDeliverybyId();

                    $dr = $this->Delivery->find('all',array(
                        'conditions' => array(
                                'Delivery.dr_uuid' => $list['SalesInvoice']['dr_uuid'],
                                'Delivery.status !=' =>  2,
                                'DeliveryDetail.status !=' => 4
                        )
                    ));


                   if (in_array($query['company_id'],array('3','4','5','6','60','102','1223'))) {
                    
                    $company = array('3','4','5','6','60','102','1223');

                  //  echo $this->isJson($list['SalesInvoice']['deliveries']);

                    if (!empty($list['SalesInvoice']['deliveries']) && $this->isJson($list['SalesInvoice']['deliveries']) ) {
                        
                        $drUUID = json_decode($list['SalesInvoice']['deliveries']);

                        $drFilter = array();

                        foreach ($drUUID as $key => $drList) {
                            
                            if (strpos(strtolower($drList),'x') !== 0) {
                               $drFilter[] = $drList; 
                            }

                        }

                        $drUUIDlist = implode(',', $drFilter );

                        if (!empty( $drFilter)) {
                            $conditions = 'Delivery.company_id IN ('.implode($company,',').') AND Delivery.dr_uuid IN ('. $drUUIDlist.') ';
                        
                        } else {

                        $conditions = 'Delivery.company_id IN ('.implode($company,',').') AND Delivery.dr_uuid != ""';
                           
                        }
                           //$conditions = 'Delivery.company_id IN ('.implode($company,',').') AND Delivery.dr_uuid IN ('. $drUUIDlist.') ';
                       
                      
                    } else {

                        if (!empty($list['SalesInvoice']['dr_uuid'])) {
                             $conditions = 'Delivery.company_id IN ('.implode($company,',').') AND Delivery.dr_uuid = "'.$list['SalesInvoice']['dr_uuid'].'" ';

                        } else {
                             $conditions = 'Delivery.company_id IN ('.implode($company,',').') AND Delivery.dr_uuid != ""';

                        }   
                        
                    }   

                    
                } else {

                    $conditions = 'Delivery.dr_uuid = "'.$list['SalesInvoice']['dr_uuid'].'" ';

                }


                    $dr = $this->Delivery->query('SELECT *
                    FROM deliveries AS Delivery
                    LEFT JOIN koufu_sale.client_orders AS ClientOrder
                    ON ClientOrder.uuid = Delivery.clients_order_id 
                    LEFT JOIN koufu_delivery.delivery_details AS DeliveryDetail
                    ON Delivery.dr_uuid = DeliveryDetail.delivery_uuid
                    LEFT JOIN koufu_sale.quotation_item_details AS QuotationItemDetail
                    ON QuotationItemDetail.id = ClientOrder.client_order_item_details_id
                    LEFT JOIN koufu_sale.quotation_details AS QuotationDetail
                    ON ClientOrder.quotation_id = QuotationDetail.quotation_id
                    LEFT JOIN koufu_sale.products AS Product
                    ON Product.id = QuotationDetail.product_id
                    LEFT JOIN koufu_sale.companies AS Company
                    ON Company.id = ClientOrder.company_id
                    WHERE '.$conditions.' 
                    group by Delivery.id DESC LIMIT 1
                    ');

                    $deliveries[$key] = $list;
                    $deliveries[$key]['Delivery'] = $dr;

            }

            if (!empty($_GET['test'])) {
                Configure::write('debug',2);
                pr($dr);

                exit();
            }


            $this->set(compact('invoices','companies','deliveries','customerID','plants','companyName','date'));

            $this->render('SalesInvoice/xls/export_invoices');
        }

       // $this->SalesInvoice->bindDeliverybyId();

        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'fields' => array(
                'SalesInvoice.id',
                'SalesInvoice.sales_invoice_no',
                'SalesInvoice.statement_no',  
                'SalesInvoice.dr_uuid', 
                'SalesInvoice.status',
                'SalesInvoice.delivery_id',
                'SalesInvoice.created',
                'SalesInvoice.invoice_date',
                'SalesInvoice.deliveries',
                'SalesInvoice.apc_dr',
                'SalesInvoice.plant_id'
                ),
            'order' => 'SalesInvoice.id DESC',
        );

        $invoiceData = $this->paginate('SalesInvoice');


        $deliveryNumHolder = $this->Delivery->find('list',array('fields' => array('dr_uuid','clients_order_id')));

        $clientDataHolder = $this->ClientOrder->find('list',array('fields' => array('uuid','company_id')));

        foreach($deliveryNumHolder as $key => $deliveryList) {
          
           $keyHolder = ltrim($key, '0');
           $deliveryNum[$keyHolder] = $deliveryList;
           
        }
      
      
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


        $this->set(compact('invoiceData','noPermissionReciv','noPermissionPay','companyName', 'deliveryNumHolder', 'clientDataHolder','date',' plants'));


        $this->render('SalesInvoice/xls/export_invoices');
    }

    public function edit_pre_invoice($id = null,$status = 0, $druuid = null,$sino = null,$deliveryId = null) {

        $userData = $this->Session->read('Auth');
        
        $this->loadModel('Sales.Company');

        $this->loadModel('Sales.ClientOrder');

        $this->loadModel('Delivery.Delivery');

        if (!empty($this->request->data)) {

            if ($this->SalesInvoice->save($this->request->data)) {

                $this->Session->setFlash('invoice Successfully updated','success');

                $this->redirect(array(
                    'controller' => 'sales_invoice',
                    'action' => 'view',
                    $id,0,
                    $druuid,
                    $sino,
                    $deliveryId
                ));

            
            } else {

                $this->Session->setFlash('There\'s an error updating invoice');


                $this->redirect(array(
                    'controller' => 'sales_invoice',
                    'action' => 'edit_pre_invoice',
                    $id,0,
                    $druuid,
                    $sino,
                    $deliveryId


                ));
            }


        }


        if (!empty($id)) {


           $companyName = $this->Company->getList(array('id','company_name'));
            

           $invoice = $this->request->data = $this->SalesInvoice->read(null,$id);

            if (!empty($invoice['SalesInvoice']['deliveries'])) {

                $ids = json_decode($invoice['SalesInvoice']['deliveries']);

                 $druuid = $ids[0];

            }

            $deliveryNumHolder = $this->Delivery->find('first',array(
             
            'conditions' =>  array('Delivery.dr_uuid' => $druuid ),  
            'fields' => array('dr_uuid','clients_order_id'
            )));

            $clientDataHolder = $this->ClientOrder->find('first',array('conditions' => array(
                'ClientOrder.uuid' =>  $deliveryNumHolder['Delivery']['clients_order_id']   
            )));


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

        $this->set(compact('noPermissionPay','inovice','noPermissionReciv','companyName','clientDataHolder','invoice'));

        }

       
    }


    public function create_multiple_apc() {

        if (!empty($this->request->data)) {

        $this->loadModel('Accounting.SalesInvoiceConnection');
        
        $userData = $this->Session->read('Auth.User');

       // $this->SalesInvoice->addSalesInvoice($this->request->data, $userData['User']['id'],$DRdata);

        $date = date('Y-m-d H:i:s');
        
        $this->SalesInvoice->create();
      
        $deliveryIDs = explode(',', $this->request->data['SalesInvoice']['delivery_ids']);

        $deliveries = array_unique(array_filter($deliveryIDs));

        $del = array();

        foreach ($deliveries as $key => $list) {
            
            $del[] = trim($list);    
        }

        $drMultiple = array_filter($del);
        
        // if (!empty($invoiceData['InvoiceForm']['delivery_id'])) {
        //     $invoiceData['SalesInvoice']['delivery_id'] = $invoiceData['InvoiceForm']['delivery_id'];
        // }
        
        if (!empty( $drMultiple )) {

           // Configure::write('debug',2);

               $this->loadModel('Delivery.Delivery');

               $this->Delivery->bindDeliveryById();

               $deliveryDetail = $this->Delivery->find('first',array(

                    'conditions' => array(
                            'Delivery.dr_uuid' => $del[0]
                    ),
                    'order' => 'DeliveryDetail.id DESC'

                ));
         

                if (!empty($deliveryDetail)) {

                    $apcDr = $this->Delivery->findApc( $deliveryDetail );

                    $invoiceData['SalesInvoice']['apc_dr'] = !empty($apcDr['apc_dr']) ? $apcDr['apc_dr'] : '';


                      if (!empty($deliveries['DeliveryDetail']['plant_id'])) {

                        $invoiceData['SalesInvoice']['plant_id'] = $apc['plant'];
                        
                        } else {
                        
                        if (!empty($apcDr['plant'])) {
                            
                            $PlantModel = ClassRegistry::init('Delivery.Plant');
         
                            $plant = $PlantModel->find('first',array(
                                'conditions' => array(
                                        'Plant.name like' => '%'.$apcDr['plant'].'%'
                                    )
                            ));

                            if (!empty($plant)) {

                                $invoiceData['SalesInvoice']['plant_id'] = $plant['Plant']['id'];
                            }
            
                        }
                       //  $save['plant_id'] = $apc['plant'];
                    }
             }

        }


        $invoiceData['SalesInvoice']['sales_invoice_no'] = $this->request->data['SalesInvoice']['sales_invoice'];

        $invoiceData['SalesInvoice']['deliveries'] = json_encode(array_unique($del));

        $invoiceData['SalesInvoice']['delivery_id'] = null;

        $invoiceData['SalesInvoice']['dr_uuid'] = $this->request->data['SalesInvoice']['dr_uuid'];
            
        $invoiceData['SalesInvoice']['created_by'] = $userData['id'];

        $invoiceData['SalesInvoice']['modified_by'] = $userData['id'];
        
        $invoiceData['SalesInvoice']['modified'] = $date;

        $invoiceData['SalesInvoice']['status'] = 0;

        $invoiceData['SalesInvoice']['is_multiple'] = 1;

        if ($this->SalesInvoice->save($invoiceData) ) {

            $del = array();
            
            $lastId = $this->SalesInvoice->id;

            foreach ($drMultiple as $key => $value) {
               $del['id'] = '';
               $del['sales_invoice_id'] = $lastId;
               $del['sales_invoice_no'] =  $this->request->data['SalesInvoice']['sales_invoice'];
               $del['dr_uuid'] = $value;
               $del['created_by'] = $userData['id'];
               $del['modified_by'] = $userData['id'];
               $this->SalesInvoiceConnection->save($del);
                 
            }
        }

        $this->Session->setFlash(__(' Sales Invoice No. completed. '), 'success');
        
                $this->redirect( array(
                     'controller' => 'sales_invoice', 
                     'action' => 'pre_invoices'
                ));

      
     
        }
    }

    public function search_dr() {

        $query = $this->request->query;

        if (!empty($query)) {

            $this->loadModel('Delivery.Delivery');

            $deliveries = $this->Delivery->find('list',array(
                'conditions' => array(
                    'Delivery.dr_uuid like' => '%'.$query['uuid'].'%',
                ),
                'fields' => array('dr_uuid','dr_uuid')
            )); 

            $this->set(compact('deliveries'));

            $this->render('SalesInvoice/ajax/dr_numbers');
        }
    }

    public function update_all_apc() {


        $SalesInvoices = $this->SalesInvoice->find('all',array(
            'conditions' => array(
                    'SalesInvoice.deliveries <>' => NULL,
                    'SalesInvoice.deliveries <>' => 'null'
                ),
//            'limit' => 3,
            'order' => 'SalesInvoice.id DESC'
        ));


        foreach ($SalesInvoices as $key => $invoice) {
            
            if (!empty($invoice['SalesInvoice']['deliveries'])) {

                 $del = json_decode($invoice['SalesInvoice']['deliveries']);

                 $this->loadModel('Delivery.DeliveryConnection');

                 $this->loadModel('Delivery.Delivery');

                 $this->Delivery->bindDeliveryById();

                 if (!empty($del[0])) {

                 $deliveries = $this->Delivery->find('first',array(

                    'conditions' => array('Delivery.dr_uuid' => $del[0]) 
                    ));

                 $apc = array();
       
                if (!empty($deliveries["DeliveryDetail"]['remarks']) && strpos(strtolower($deliveries['DeliveryDetail']['remarks']),'apc') !== FALSE) {

                    $apcDr = explode('-', $deliveries['DeliveryDetail']['remarks'] );

                    $apc['apc_dr'] = !empty($apcDr[0]) ? $apcDr[0] : '' ;
                    $apc['plant'] =  !empty($apcDr[1]) ? $apcDr[1] : '' ;
                    

                } else {

                    if (!empty($deliveries['DeliveryDetail']['apc_dr'])) {

                        $apc = $deliveries['DeliveryDetail']['apc_dr'];
                    }
                }   

                    $save['id'] = $invoice['SalesInvoice']['id'];

                if (!empty($apc)) {

                    $save['apc_dr'] = $apc['apc_dr'];

                    if (!empty($deliveries['DeliveryDetail']['plant_id'])) {
                        $save['plant_id'] = $apc['plant'];
                    } else {
                        if (!empty($apc['plant'])) {
                            
                            $PlantModel = ClassRegistry::init('Delivery.Plant');
         
                            $plant = $PlantModel->find('first',array(
                                'conditions' => array(
                                        'Plant.name like' => '%'.$apc['plant'].'%'
                                    )
                            ));

                            if (!empty($plant)) {

                                $save['plant_id'] = $plant['Plant']['id'];
                            }

            
                        }
                       //  $save['plant_id'] = $apc['plant'];
                    }

                    $this->SalesInvoice->save($save);
                }

            }
                   
            }
        }

    }
}