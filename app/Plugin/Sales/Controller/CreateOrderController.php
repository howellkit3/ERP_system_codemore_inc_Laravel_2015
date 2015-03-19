<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class CreateOrderController extends SalesAppController {
	public $uses = array('Sales.QuotationOption','Sales.Quotation','Sales.Company','Sales.CreateOrder','Sales.SalesOrder');

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

		$count = $this->QuotationOption->find('count', array(
											'conditions' => array(
												'custom_fields_id' => '3',
												'custom_fields_id' => '4',
												'custom_fields_id' => '6',
												'quotation_id' => $quotationId
											)
										));
		$first = $this->QuotationOption->find('all', array(
												'conditions' => array(
													'custom_fields_id' => array('3','4','6'),
													'position' => '1',
													'quotation_id' => $quotationId
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
}
?>
