
<?php
App::uses('AppModel', 'Model');
//namespace Sales\Model\Entity;
/**
 * Supllier Model
 *
 */
class PurchaseOrder extends AppModel {

    public $useDbConfig = 'koufu_purchasing';

    public $name = 'PurchaseOrder';

	public $recursive = -1;

	public $actsAs = array('Containable');

 	public function bind($model = array('Group')){

		$this->bindModel(array(
			
			'belongsTo' => array(	
				'Request' => array(
					'className' => 'Purchasing.Request',
					'foreignKey' =>  'request_id',
					//'conditions' => array('PurchasingItem.request_uuid = request_uuid')
				),
				'Contact' => array(
					'className' => 'Purchasing.Contact',
					'foreignKey' =>  'contact_id',
					//'conditions' => array('PurchasingItem.request_uuid = request_uuid')
				),
				'SupplierContactPerson' => array(
					'className' => 'Purchasing.SupplierContactPerson',
					'foreignKey' =>  'contact_person_id',
					//'conditions' => array('PurchasingItem.request_uuid = request_uuid')
				),
				'Supplier' => array(
					'className' => 'Supplier',
					'foreignKey' =>  'supplier_id',
					//'conditions' => array('PurchasingItem.request_uuid = request_uuid')
				),
				'ReceivedOrder' => array(
					'className' => 'WareHouse.ReceivedOrder',
					'foreignKey' =>  false,
					'conditions' => array('ReceivedOrder.purchase_orders_id = PurchaseOrder.id')
				),
				'DeliveredOrder' => array(
					'className' => 'WareHouse.DeliveredOrder',
					'foreignKey' =>  false,
					'conditions' => array('DeliveredOrder.purchase_orders_id = PurchaseOrder.id')
				),
			),

			'hasMany' => array(	
				'PurchasingItem' => array(
					'className' => 'Purchasing.PurchasingItem',
					'foreignKey' =>  false,
					'conditions' => array('Request.uuid = request_uuid')
				),

				'RequestItem' => array(
					'className' => 'Purchasing.RequestItem',
					'foreignKey' =>  false,
					'conditions' => array('Request.uuid = request_uuid')
				),

				// 'ReceivedItem' => array(
				// 	'className' => 'WareHouse.ReceivedItem',
				// 	'foreignKey' =>  false,
				// 	'conditions' => array('ReceivedOrder.id = received_orders_id')
				// ),
			
		)));

		$this->contain($model);
	}

	public function savePurchaseOrder($purchaseOrderData = null, $auth = null){
		
		$month = date("m"); 

		$year = date("y");

		$hour = date("H");

		$minute = date("i");

		$seconds = date("s");

		$random = rand(1000, 10000);

		$code =  $year. $month .$random;

		$this->create();

		if (empty($purchaseOrderData['PurchaseOrder']['id'])) {

			$purchaseOrderData[$this->name]['uuid'] = $code;
			$purchaseOrderData[$this->name]['created_by'] = $auth;
			$purchaseOrderData[$this->name]['status'] = 8;
			$purchaseOrderData[$this->name]['version'] = 1;
		}
		
		$purchaseOrderData[$this->name]['modified_by'] = $auth;
		
		
		$this->save($purchaseOrderData);

		return $this->id;
		
	}
	
	public function bindReceive() {
		$this->bindModel(array(
			'hasOne' => array(
				'Request' => array(
					'className' => 'Purchasing.Request',
					'foreignKey' => false,
					'conditions' => 'Request.id = PurchaseOrder.request_id'
				),		
				'PurchasingItem' => array(
					'className' => 'Purchasing.PurchasingItem',
					'foreignKey' => false,
					'conditions' => 'Request.uuid = PurchasingItem.request_uuid'
				),		

				'RequestItem' => array(
					'className' => 'Purchasing.RequestItem',
					'foreignKey' => false,
					'conditions' => 'Request.uuid = RequestItem.request_uuid'
				),		
			)
		));
		$this->recursive = 1;
	}

}
