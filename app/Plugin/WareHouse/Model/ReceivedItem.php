<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class ReceivedItem extends AppModel {

    public $useDbConfig = 'koufu_warehouse';
    
  	public $name = 'ReceivedItem';

	public function saveReceivedItems($id, $data){

		$month = date("m"); 
	    $year = date("y");
	    $hour = date("H");
	    $minute = date("i");
	    $seconds = date("s");
	    $random = rand(1000, 10000);
	        
		$code =  $year. $month .$random;

		$data['received_orders_id'] = $id;

		foreach ($data as $key => $value)
		{
			foreach ($value as $key => $valueOfvalue) 
			{

				$key1 = array_search("on", $valueOfvalue);

				if(!empty($key1)){

					$this->create();
					$valueOfvalue['foreign_key'] = $key1;
					$valueOfvalue['received_orders_id'] = $id;
					$valueOfvalue['delivery_uuid'] = $code;
			 		$this->save($valueOfvalue);
				}

			}
			
			return $this->id;
			
		}

	}

		public function bind($model = array('PurchaseOrder', 'ReceivedItem')){

		$this->bindModel(array(
			'hasOne' => array(
				'ReceivedItem' => array(
					'className' => 'WareHouse.ReceivedItem',
					'foreignKey' => false,
					'conditions' => 'Delivery.dr_uuid = DeliveryReceipt.dr_uuid'
				),
			)

		));


	}

}