<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class ReceivedReceiptItem extends AppModel {

    public $useDbConfig = 'koufu_warehouse';
    
  	public $name = 'ReceivedReceiptItem';

	public function saveReceivedReceiptItems($id, $data, $uuid){

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
					$valueOfvalue['delivered_order_id'] = $uuid;
					$valueOfvalue['reject_quantity'] = $valueOfvalue['rejectQuantity'];
					$valueOfvalue['request_uuid'] = $data['ReceivedItems']['request_id'];
			 		$this->save($valueOfvalue);
				}
 
			}
			
			return $this->id;
			
		}
	}


}