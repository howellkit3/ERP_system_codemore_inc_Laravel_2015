<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class DeliveredOrder extends AppModel {

    public $useDbConfig = 'koufu_warehouse';
    
  	public $name = 'DeliveredOrder';

	public function saveDeliveredOrder($auth, $receivedOrdersId, $purchaseId, $deliveredItemsData = null){

		$month = date("m"); 
	    $year = date("y");
	    $hour = date("H");
	    $minute = date("i");
	    $seconds = date("s");
	    $random = rand(1000, 10000);
	        
		$code =  $year. $month .$random;

		$mystring = mb_substr($deliveredItemsData['uuid'],4,9);
	//	$mystring = mb_substr($deliveredItemsData['po_number'],4,9);
		
		$this->create();

		$data['dr_num'] = $deliveredItemsData['dr_num'];
		$data['si_num'] = $deliveredItemsData['si_num'];
		$data['created_by'] = $auth;
		$data['modified_by'] = $auth;
		$data['received_orders_id'] = $receivedOrdersId;
		$data['purchase_orders_id'] = $purchaseId;
		$data['purchase_order_uuid'] = $deliveredItemsData['po_number'];
		$data['uuid'] = $mystring;
		//pr($data); exit;
		$this->save($data);

		return $this->id;

	}


	public function bind($model = array('Group')){


		$this->bindModel(array(
			'hasMany' => array(
				'ReceivedItem' => array(
					'className' => 'WareHouse.ReceivedItem',
					'foreignKey' => 'delivered_order_id'
					//'conditions' => 'ReceivedItem.delivered_order_id = DeliveredOrder.id'
				),
			),

			'hasOne' => array(
				'ReceivedOrder' => array(
					'className' => 'WareHouse.ReceivedOrder',
					'foreignKey' => false,
					'conditions' => 'ReceivedOrder.id = DeliveredOrder.received_orders_id'
				),

				'PurchaseOrder' => array(
					'className' => 'Purchasing.PurchaseOrder',
					'foreignKey' => false,
					'conditions' => array('DeliveredOrder.purchase_orders_id = PurchaseOrder.id')
				),
			)
		));
	}

	public function bindItem() {
		$this->bindModel(array(

			'hasOne' => array(
				'ReceivedOrder' => array(
					'className' => 'WareHouse.ReceivedOrder',
					'foreignKey' => false,
					'conditions' => 'ReceivedOrder.id = DeliveredOrder.received_orders_id'
				),

				'PurchaseOrder' => array(
					'className' => 'Purchasing.PurchaseOrder',
					'foreignKey' => false,
					'conditions' => array('DeliveredOrder.purchase_orders_id = PurchaseOrder.id')
				),
			),

			'hasMany' => array(
				'ReceivedItem' => array(
					'className' => 'WareHouse.ReceivedItem',
					'foreignKey' => 'delivered_order_id'
					//'conditions' => array('ReceivedItem.delivered_order_id = DeliveredOrder.id')
				),
			)
		));
		$this->recursive = 1;
		//$this->contain($giveMeTheTableRelationship);
	}
}