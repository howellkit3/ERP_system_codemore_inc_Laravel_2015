<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class SalesInvoice extends AppModel {

    public $useDbConfig = 'koufu_accounting';
    public $name = 'SalesInvoice';
  
	public function addSalesInvoice($invoiceData = null, $auth = null){
		
		$this->create();
		
		$invoiceData[$this->name]['created_by'] = $auth;
		$invoiceData[$this->name]['modified_by'] = $auth;
		$this->save($invoiceData);

		return $this->id;
		
	}
}