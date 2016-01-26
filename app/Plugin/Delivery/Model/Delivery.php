<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Delivery extends AppModel {
	public $recursive = -1;
	
	public $actsAs = array('Containable');

    public $useDbConfig = 'koufu_delivery_system';
    
    public $name = 'Delivery';

	public function saveDelivery($data = null, $auth = null,$novalidate = null){

		$this->create();
					
		$data['Delivery']['created_by'] = $auth;

		$this->save($data);

	}

	public function bindDeliveryById() {

		$this->bindModel(array(
			'hasOne' => array(
				'DeliveryDetail' => array(
					'className' => 'Delivery.DeliveryDetail',
					'foreignKey' => false,
					'conditions' => 'Delivery.id = DeliveryDetail.delivery_id'
				),		
				
				'Transmittal' => array(
					'className' => 'Delivery.Transmittal',
					'foreignKey' => false,
					'conditions' => 'Delivery.dr_uuid = Transmittal.dr_uuid'
				),
				'DeliveryReceipt' => array(
					'className' => 'Delivery.DeliveryReceipt',
					'foreignKey' => false,
					'conditions' => array('DeliveryReceipt.dr_uuid = Delivery.dr_uuid')
				),
			
			),
			// 'hasMany' => array(
			// 	'DeliveryReceiptItem' => array(
			// 		'className' => 'Delivery.DeliveryReceipt',
			// 		'foreignKey' => false,
			// 		//'conditions' => array('DeliveryReceiptItem.dr_uuid' => 't3')
			// 	)	
			// )
		));
		$this->recursive = 1;

	}
	public function bindDelivery() {
		$this->bindModel(array(
			'hasOne' => array(
				'DeliveryDetail' => array(
					'className' => 'Delivery.DeliveryDetail',
					'foreignKey' => false,
					'conditions' => 'Delivery.dr_uuid = DeliveryDetail.delivery_uuid'
				),		
				'DeliveryReceipt' => array(
					'className' => 'Delivery.DeliveryReceipt',
					'foreignKey' => false,
					'conditions' => 'Delivery.dr_uuid = DeliveryReceipt.dr_uuid'
				),	
				
				'Transmittal' => array(
					'className' => 'Delivery.Transmittal',
					'foreignKey' => false,
					'conditions' => 'Delivery.dr_uuid = Transmittal.dr_uuid'
				),	

			)
		));
		$this->recursive = 1;
	}

	public function bindDeliveryView() {
		$this->bindModel(array(
			'hasOne' => array(
				'DeliveryDetail' => array(
					'className' => 'Delivery.DeliveryDetail',
					'foreignKey' => false,
					'conditions' => 'Delivery.dr_uuid = DeliveryDetail.delivery_uuid'
				),		
			)
		));
		$this->recursive = 1;
		
	}

	public function bindDeliveryClientOrder() {
		$this->bindModel(array(
			'hasOne' => array(
				'DeliveryDetail' => array(
					'className' => 'Delivery.DeliveryDetail',
					'foreignKey' => false,
					'conditions' => 'Delivery.dr_uuid = DeliveryDetail.delivery_uuid'
				),

						
			)
		));
		$this->recursive = 1;
	}

	public function bindDeliveryTrans() {
		$this->bindModel(array(
			'hasOne' => array(
				'DeliveryDetail' => array(
					'className' => 'Delivery.DeliveryDetail',
					'foreignKey' => false,
					'conditions' => 'Delivery.dr_uuid = DeliveryDetail.delivery_uuid'
				),		
				'DeliveryReceipt' => array(
					'className' => 'Delivery.DeliveryReceipt',
					'foreignKey' => false,
					'conditions' => 'Delivery.dr_uuid = DeliveryReceipt.dr_uuid'
				),	

				'Transmittal' => array(
					'className' => 'Delivery.Transmittal',
					'foreignKey' => false,
					'conditions' => 'Delivery.dr_uuid = Transmittal.dr_uuid'
				),		
			)
		));
		$this->recursive = 1;

	}

	public function bindInvoice() {
		$this->bindModel(array(
			'hasOne' => array(
				'ClientOrder' => array(
					'className' => 'Sales.ClientOrder',
					'foreignKey' => false,
					'conditions' => 'Delivery.clients_order_id = ClientOrder.uuid'
				),	
				'Company' => array(
					'className' => 'Sales.Company',
					'foreignKey' => false,
					'conditions' => array('Company.id = Delivery.company_id')
				),	
			)
		));
		$this->recursive = 1;

	}

}