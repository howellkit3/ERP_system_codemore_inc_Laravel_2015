<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class SalesInvoiceConnection extends AppModel {

    public $useDbConfig = 'koufu_accounting';

    public $name = 'SalesInvoiceConnection';
		
	public $useTable = 'sales_invoice_connections';

 	//public $recursive = -1;

	public $actsAs = array('Containable');

    public function bindInvoice() {
		
		$this->bindModel(array(
			'belongsTo' => array(
				'DeliveryDetail' => array(
					'className' => 'Delivery.DeliveryDetail',
					'foreignKey' => false,
					'conditions' => array('DeliveryDetail.delivery_uuid = SalesInvoice.dr_uuid')
				), 

				'Delivery' => array(
					'className' => 'Delivery.Delivery',
					'foreignKey' => false,
					'conditions' => array('Delivery.dr_uuid = SalesInvoice.dr_uuid')
				), 
				// 'ClientOrder' => array(
				// 	'className' => 'Sales.ClientOrder',
				// 	'foreignKey' => false,
				// 	'conditions' => array('Delivery.clients_order_id = ClientOrder.id')
				// )
				// 'ClientOrder' => array( 15068619
				// 	'className' => 'Sales.ClientOrder',
				// 	'foreignKey' => false,
				// 	'conditions' => 'ClientOrder.uuid = Delivery.clients_order_id'
				// ),
				// 'PaymentTermHolder' => array(
				// 	'className' => 'PaymentTermHolder',
				// 	'foreignKey' => 'payment_term',
				// 	'dependent' => false
				// 	),
				// 'ContactPerson' => array(
				// 	'className' => 'ContactPerson',
				// 	'foreignKey' => false,
				// 	'conditions' => array('ContactPerson.id = Quotation.attention_details'),
				// 	'dependent' => false
				// 	),
				// 'ContactPersonEmail' =>  array(
				// 	'className' => 'Email',
				// 	'foreignKey' => false,
				// 	'conditions' => array('ContactPersonEmail.foreign_key = ContactPerson.id'),
				// 	'dependent' => false
				// 	),
				
			)
		));
		$this->recursive = 1;
		//$this->contain($giveMeTheTableRelationship);
	}
  	
}