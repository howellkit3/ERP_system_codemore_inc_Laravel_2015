<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class CreateOrderController extends SalesAppController {

	public function beforeFilter() {

        parent::beforeFilter();

        $userData = $this->Session->read('Auth');

        $this->Auth->allow('add','index');

        $this->set(compact('userData'));

    }
    
	public $uses = array('Sales.QuotationOption','Sales.Quotation','Sales.Company','Sales.CreateOrder','Sales.SalesOrder','Sales.ClientOrder');

	public function add($quotationId = null, $salesOrderId = null){

		$quotationData = $this->Quotation->find('first', array(
												'conditions' => array(
													'id' => $quotationId
												)
											));
		

		$companyData = $this->Company->find('first', array(
												'conditions' => array(
													'id' => $quotationData['Quotation']['company_id']
												)
											));

		$this->set(compact('count','first','quotationData','companyData'));
	}

	public function get_quotation_options(){

		$data = $this->QuotationOption->find('all', array(
												'conditions' => array(
													'custom_fields_id' => array('3','4','6'),
													'position' => $this->request->data['position'],
													'quotation_id' => $this->request->data['quotation']
											)
										));
		$this->set(compact('data'));
	}
	public function insert(){
		$userData = $this->Session->read('Auth');
		if ($this->request->is('post')) {
			//pr();die;
			 if (!empty($this->request->data)) {
			 	$this->CreateOrder->saveOrder($this->request->data, $userData['User']['id']);
			 	$this->QuotationOption->updateOptions($this->request->data, $userData['User']['id']);
			 	$this->Quotation->approvedData($this->request->data['CreateOrder']['quotationId']);
			 	$this->SalesOrder->approvedData($this->request->data['CreateOrder']['quotationId'], $userData['User']['id'] );
			 	$this->Session->setFlash(__('Successfully Created Order.'));
    			$this->redirect(
            		array('controller' => 'sales_orders', 'action' => 'index')
       			 );

			 }
		}
	}

	public function index($quotationId = null, $uuid = null){

		$this->loadModel('PaymentTermHolder');

		$this->loadModel('Sales.ContactPerson');

		$this->loadModel('Currency');
		
		$this->loadModel('Unit');

		$month = date("m"); 
	    $year = date("y");
	    $hour = date("H");
	    $minute = date("i");
	    $seconds = date("s");
	    $random = rand(1000, 10000);
	        
		$code =  $year. $month .$random;

		$currencies = $this->Currency->getList();

		$units = $this->Unit->getList();

		$paymentTerm = $this->PaymentTermHolder->find('list',array('fields' => array('id','name')));

		$this->Quotation->bind(array('QuotationItemDetail','QuotationDetailOrder','ContactPerson'));

		$quotationData = $this->Quotation->findById($quotationId);

		$this->Company->bind(array('Address' => array('fields' => array('id','address1','address2'))));

		$companyData = $this->Company->find('first', array(
												'conditions' => array('Company.id' => $quotationData['Quotation']['company_id'])
											));

		$productData = $this->Company->Product->find('first',array('fields' => array('id','name'),
										'conditions' => array('id' => $quotationData['QuotationDetailOrder'][0]['product_id'])));
		
		$this->set(compact('quotationData','companyData','paymentTerm','productData','currencies','units','code'));
	}

	public function find_item_detail($itemDetailId = null){

		$this->Quotation->bind(array('QuotationItemDetail'));

		$itemDetail = $this->Quotation->QuotationItemDetail->find('first',array('conditions' => array('QuotationItemDetail.id' => $itemDetailId)));
		
		echo json_encode($itemDetail);

		$this->autoRender = false;
	}

	public function order_create(){

		$userData = $this->Session->read('Auth');
	
		if ($this->request->is('post')) {

            if (!empty($this->request->data)) {
            	
            	$this->ClientOrder->bind(array('ClientOrderDeliverySchedule','ClientOrderItemDetail'));

            	$this->id = $this->ClientOrder->saveClientOrder($this->request->data, $userData['User']['id']);
            	
            	$this->ClientOrder->ClientOrderDeliverySchedule->saveClientOrderDeliverySchedule($this->request->data, $userData['User']['id'], $this->id);

            	$this->Session->setFlash(__('Client Order was successfully added in the system.'));
    			$this->redirect(
            		array('controller' => 'sales_orders', 'action' => 'index')
       			 );

            }
        }
	}
}
?>
