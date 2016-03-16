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

	public function saveReceivedMultipleItems($data,$id = null,$uuid = null,$tracking = null){

		foreach ($data['requestPurchasingItem'] as $key => $list) {


				$this->create();
				$value['received_orders_id'] = $id;
				$value['delivered_order_id'] = $uuid;
				$value['model'] = $list['model'];
				$value['item_type'] = $data['ReceiveReceipt']['item_type'];
				$value['item_type'] = $data['ReceiveReceipt']['item_type'];
				$value['foreign_key'] = $list['foreign_key'];
				$value['quantity'] = $list['quantity'];
				$value['quantity_unit_id'] = $list['quantity_unit_id'];
				$value['lot'] = !empty($list['lot']) ? $list['lot'] : '';
				$value['number_of_boxes'] = $list['pack_quantity'];
				$value['quantity_per_boxes'] = $list['quantity_per_box'];
				$value['remarks'] = !empty($data['ReceiveReceipt']['remarks']) ? $data['ReceiveReceipt']['remarks']: '';

				$value['dr_num'] = !empty($data['ReceiveReceipt']['dr_num']) ? $data['ReceiveReceipt']['dr_num'] : '';
				$value['si_num'] = !empty($data['ReceiveReceipt']['si_num']) ? $data['ReceiveReceipt']['si_num'] : '';
				$value['tracking'] = $tracking;
				
				//pr( $value); sexit;
		 		$this->save($value);


		 }
	}


}