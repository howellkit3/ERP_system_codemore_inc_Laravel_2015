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

		//foreach ($data['itemdetails'] as $key => $value)
		//{

			//pr( $value); exit;
				$this->create();
				$value['received_orders_id'] = $id;
				$value['delivered_order_id'] = $uuid;
				$value['model'] = $data['model'];
				$value['item_type'] = $data['item_type'];
				$value['item_type'] = $data['item_type'];
				$value['foreign_key'] = $data['foreign_key'];
				$value['quantity'] = $data['quantity'];
				$value['quantity_unit_id'] = $data['quantity_unit_id'];
				$value['lot'] = $data['lot'];
				$value['number_of_boxes'] = $data['pack_quantity'];
				$value['quantity_per_boxes'] = $data['quantity_per_box'];
				$value['remarks'] = $data['remarks'];

				$value['dr_num'] = !empty($data['dr_num']) ? $data['dr_num'] : '';
				$value['si_num'] = !empty($data['si_num']) ? $data['si_num'] : '';
				$value['tracking'] = !empty($data['tracking']) ? $data['tracking'] : '';
				
				//pr( $value); exit;
		 		$this->save($value);

		//}

		return $this->id;
	}


}