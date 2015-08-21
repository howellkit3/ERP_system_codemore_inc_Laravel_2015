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