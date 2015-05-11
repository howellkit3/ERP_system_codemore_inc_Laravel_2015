<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class SalesOrdersController extends SalesAppController {

	public $uses = array('Sales.Quotation','Sales.ClientOrder','Sales.Company');

	public function beforeFilter() {

        parent::beforeFilter();

        $userData = $this->Session->read('Auth');

        $this->Auth->allow('index');

        $this->set(compact('userData'));

    }
	    	    
	public function index() {

		$userData = $this->Session->read('Auth');
		
		$this->Quotation->bind(array('ClientOrder'));

		$clientOrder = $this->Quotation->ClientOrder->find('all', array('order' => 'ClientOrder.id DESC'));

		$this->loadModel('Sales.Company');

		$this->Company->bind(array('Inquiry'));

		$companyData = $this->Company->find('list',array(
     											'fields' => array('id','company_name')
     										));

		$inquiryId = $this->Company->Inquiry->find('list',array(
     													'fields' => array('company_id')
     												));

		$quoteName = $this->Quotation->find('list',array('id','name'));
		
		$this->set(compact('clientOrder','quoteName','companyData','inquiryId'));
	}

	public function view($clientOrderId = null){

		$this->loadModel('PaymentTermHolder');
       
		$this->Quotation->bind(array('QuotationDetail','QuotationItemDetail','Product','ContactPerson'));

		$this->ClientOrder->bind(array('ClientOrderDeliverySchedule'));

		$clientOrderData = $this->ClientOrder->find('first',array('conditions' => array('ClientOrder.id' => $clientOrderId)));

		$quotationData = $this->Quotation->findById($clientOrderData['ClientOrder']['quotation_id']);

		$companyName = $this->Company->find('list',array(
     													'fields' => array('id','company_name')
     												));

		$quotationItemDetail = $this->Quotation->QuotationItemDetail->find('first',array('conditions' => array('QuotationItemDetail.id' => $clientOrderData['ClientOrder']['client_order_item_details_id'])));
      
		$paymentTermData = $this->PaymentTermHolder->find('list',array('fields' => array('id','name')));
												
		$this->set(compact('clientOrderData','quotationData','companyName','quotationItemDetail','paymentTermData'));

	}

	public function add_schedule() {

      //new code bienskie noted:all adding schedule can use this controller
      $this->ClientOrder->bind(array('ClientOrderDeliverySchedule'));

      $userData = $this->Session->read('Auth');

      if ($this->request->is('post')) {
     
        if (!empty($this->request->data)) {

          $result['ClientOrderDeliverySchedule'] = Set::classicExtract($this->request->data,'{s}');
         
          $this->ClientOrder->ClientOrderDeliverySchedule->saveClientOrderDeliverySchedule($result,$userData['User']['id'],$this->request->data['ClientOrderDeliverySchedule']['client_order_id']);
        
          $this->Session->setFlash(__('Client order delivery details has been updated.'));

          return $this->redirect(array('controller' => 'sales_orders','action' => 'view',$this->request->data['ClientOrderDeliverySchedule']['client_order_id']));
        }

      }
		
	}


	  public function status() {

        $userData = $this->Session->read('Auth');

        $productData = $this->AddProduct->find('all', array('order' => 'StatusFieldHolder.id DESC'));
        if ($this->request->is('post')) {
            
            if (!empty($this->request->data)) {
               // pr($this->request->data); exit;

              //  pr($this->StatusFieldHolder->ItemTypeHolder->saveItemType($this->request->data['id'], $this->id));exit();

                $this->StatusFieldHolder->create();

                $this->id = $this->StatusFieldHolder->saveStatus($this->request->data['StatusFieldHolder'], $userData['User']['id']);

            
                $this->Session->setFlash(__('Add Status Complete.'));

                $this->redirect(
                    array('controller' => 'settings', 'action' => 'status')
                );
            }
        }

       // $categoryData = $this->ItemCategoryHolder->find('all', array('order' => 'StatusFieldHolder.id DESC'));
        $this->set(compact('productData'));
        //$this->set(compact('categoryData'));
    }
	



	

}