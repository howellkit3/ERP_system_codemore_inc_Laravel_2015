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

	public function saveReceivedItems($id, $data, $uuid){

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
					$valueOfvalue['quantity_unit_id'] =!empty($valueOfvalue['quantity_unit_id']) ? $valueOfvalue['quantity_unit_id'] : 14;
					$valueOfvalue['reject_quantity'] = !empty($valueOfvalue['rejectQuantity']) ? $valueOfvalue['rejectQuantity'] : 0;
					$valueOfvalue['request_uuid'] = $data['ReceivedItems']['request_id'];
			 		$this->save($valueOfvalue);
				}
 
			}
			
			return $this->id;
			
		}
	}

		public function bind($model = array('Group')){


		$this->bindModel(array(
			'belongsTo' => array(
				'DeliveredOrder' => array(
					'className' => 'WareHouse.DeliveredOrder',
					'foreignKey' => id
				),
			)
		));
	}



}