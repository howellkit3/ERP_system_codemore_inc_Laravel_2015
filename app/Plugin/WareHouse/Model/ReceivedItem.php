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
		
		$this->create();

		//pr($data); exit;

		$data['received_orders_id'] = $id;


		// foreach ($data['requestPurchasingItem'] as $key => $value) {
			
		// 		foreach ($value as $key => $valueOfvalue) {
		// 			$key = array_search("on", $value);
		// 			if($valueOfvalue = "on"){
		// 				$data['foreign_key'] = $key;
		// 				$this->save($data);
		// 			}
		// 	}
		// }

		foreach ($data as $key => $value)
		{
			
			
			foreach ($value as $key => $valueOfvalue) 
			{
				$this->create();
				$data['foreign_key'] = $key;
				//pr($valueOfvalue); 
		 		$this->save($data);
				
			}
			
			return $this->id;
			
		}



	}

}