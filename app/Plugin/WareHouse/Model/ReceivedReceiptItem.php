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

		//pr($data); exit;
		

		foreach ($data['itemdetails'] as $key => $value)
		{

			//pr( $value); exit;
				$this->create();
				$value['received_orders_id'] = $id;
				$value['delivered_order_id'] = $uuid;
				//pr( $value); exit;
		 		$this->save($value);


			return $this->id;
			
		}
	}


}