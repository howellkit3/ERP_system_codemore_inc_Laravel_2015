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

		$data['received_orders_id'] = $id;

		foreach ($data as $key => $value)
		{
			foreach ($value as $key => $valueOfvalue) 
			{

				$key = array_search("on", $valueOfvalue);

				if(!empty($key)){

					$this->create();
					$valueOfvalue['foreign_key'] = $key;
					$valueOfvalue['received_orders_id'] = $id;
			 		$this->save($valueOfvalue);
				}

			}
			
			return $this->id;
			
		}



	}

}