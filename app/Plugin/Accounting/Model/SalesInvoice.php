<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class SalesInvoice extends AppModel {

    public $useDbConfig = 'koufu_accounting_system';
    public $name = 'SalesInvoice';
  
	public function addSalesInvoice($data, $auth){

		$this->create();
		$data['sales_invoice_no'] = $data['Accounting']['invoice_number'];
		$data['sales_order_no'] = $data['Accounting']['sales_order_id'];
		//$data['product_name'] = $data['Product']['productName'];
		$data['total_price'] = $data['Accounting']['total_price'];
		$data['created_by'] = $auth;
		$data['modified_by'] = $auth;
		$this->save($data);

		return $this->id;
		
	}
}