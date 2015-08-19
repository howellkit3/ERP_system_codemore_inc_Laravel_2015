<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class ReceivedOrder extends AppModel {

    public $useDbConfig = 'koufu_warehouse';
    
  	public $name = 'ReceivedOrder';

	
	
	public function saveReceivedOrders($data, $auth, $order_id){

		$month = date("m"); 
	    $year = date("y");
	    $hour = date("H");
	    $minute = date("i");
	    $seconds = date("s");
	    $random = rand(1000, 10000);
	        
		$code =  $year. $month .$random;
		
		$this->create();

		$data['received_by'] = $auth;
		$data['uuid'] = $code;
		$data['purchase_order_id'] = $order_id;
		$data['status_id'] = 11;

		
		$this->save($data);

		return $this->id;

	}

	public function bind($model = array('PurchaseOrder', 'ReceivedItem')){

		$this->bindModel(array(
			'belongsTo' => array(
				'PurchaseOrder' => array(
					'className' => 'Purchasing.PurchaseOrder',
					'foreignKey' => 'purchase_order_id',
					'dependent' => true
				),
			),
			'hasMany' => array(
				'ReceivedItem' => array(
					'className' => 'WareHouse.ReceivedItem',
					'foreignKey' => 'received_orders_id',
					'dependent' => true
				),
			)

		));


	}

}