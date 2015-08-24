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

	public function saveDeliveredOrder($auth, $receivedOrdersId, $purchaseId){

		$month = date("m"); 
	    $year = date("y");
	    $hour = date("H");
	    $minute = date("i");
	    $seconds = date("s");
	    $random = rand(1000, 10000);
	        
		$code =  $year. $month .$random;
		
		$this->create();

		$data['created_by'] = $auth;
		$data['modified_by'] = $auth;
		$data['received_orders_id'] = $receivedOrdersId;
		$data['purchase_orders_id'] = $purchaseId;
		$data['uuid'] = $code;
		
		$this->save($data);

		return $this->id;

	}

	public function bind($model = array('Group')){
		$this->bindModel(array(
			'hasMany' => array(
				'ReceivedItem' => array(
					'className' => 'WareHouse.ReceivedItem',
					'foreignKey' => 'delivered_order_id'
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

}