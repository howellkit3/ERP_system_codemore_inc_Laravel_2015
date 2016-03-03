<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class SalesInvoice extends AppModel {

    public $useDbConfig = 'koufu_accounting';

    public $name = 'SalesInvoice';

    //public $useTable = 'SalesInvoice';

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
  	
	public function bindDeliverybyId() {

		$this->bindModel(array(
			'hasMany' => array(
				'Delivery' => array(
					'className' => 'Delivery.Delivery',
					'foreignKey' => false,
					'conditions' => array('Delivery.dr_uuid = SalesInvoice.dr_uuid')
				)
			),
			'belongsTo' => array(

				'DeliveryConnection' => array(
					'className' => 'Delivery.Delivery',
					'foreignKey' => 'sales_invoice_id',
					//'conditions' => 'DeliveryConnection.sales_invoice_id = SalesInvoice.id'
				),
				'DeliveryDetail' => array(
					'className' => 'Delivery.DeliveryDetail',
					'foreignKey' => false,
					'conditions' => array('DeliveryDetail.delivery_uuid = SalesInvoice.dr_uuid')
				),


				// 'ClientOrder' => array(
				// 	'className' => 'Sales.ClientOrder',
				// 	'foreignKey' => false,
				// 	'conditions' => array('ClientOrder.id = Delivery.clients_order_id')
				// ),

			)
		)

		);

		$this->recursive = 1;
	}

  	public function bindDelivery() {
		$this->bindModel(array(
			'belongsTo' => array(
				'Delivery' => array(
					'className' => 'Delivery.Delivery',
					'foreignKey' => false,
					'conditions' => 'Delivery.dr_uuid = SalesInvoice.3256'
				),

				// 'ClientOrder' => array(
				// 	'className' => 'Sales.ClientOrder',
				// 	'foreignKey' => false,
				// 	'conditions' => array('ClientOrder.id = Delivery.clients_order_id')
				// ),

			)
		)

		);

		$this->recursive = 1;
	}


	public function addSalesInvoice($invoiceData = null, $auth = null,$drData = array()){

		$date = date('Y-m-d H:i:s');
		
		$this->create();

		if (!empty($invoiceData['InvoiceForm']['delivery_id'])) {
			$invoiceData[$this->name]['delivery_id'] = $invoiceData['InvoiceForm']['delivery_id'];
		}

		if (!empty($invoiceData['SalesInvoice']['plant_id'])) {
			$invoiceData[$this->name]['plant_id'] = $invoiceData['SalesInvoice']['plant_id'];
		} else {
				
			$PlantModel = ClassRegistry::init('Delivery.Plant');
			
			if (!empty($invoiceData['SalesInvoice']['plant'])) {
				
				$plant = $PlantModel->find('first',array(
					'conditions' => array(
							'Plant.name like' => '%'.$invoiceData['SalesInvoice']['plant'].'%'
						)
				));

				if ($plant) {

					$invoiceData[$this->name]['plant_id'] = $invoiceData['Plant']['id'];
				}

			}

		}
			
		$invoiceData[$this->name]['created_by'] = $auth;
		$invoiceData[$this->name]['modified_by'] = $auth;
		$invoiceData[$this->name]['modified'] = $date;
		//pr($invoiceData); exit;
		$this->save($invoiceData);

		return $this->id;
		
	}

	public function changeStatus($auth = null, $id = null){

				$this->id = $id;
				$this->saveField('status', 1);
				$this->saveField('modified_by', $auth);
				
	}
}