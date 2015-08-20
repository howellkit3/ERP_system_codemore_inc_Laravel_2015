<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class Stock extends AppModel {

    public $useDbConfig = 'koufu_warehouse';
    
  	public $name = 'Stock';

  	public function saveStock($received, $data){

  		//pr($received); exit;

		$this->create();

		$stock['supplier_id'] = $received['PurchaseOrder']['supplier_id'];
		$stock['location_id'] = $data['InRecord']['storekeeper'];
		$stock['remarks'] = $data['InRecord']['remarks'];

		foreach ($received['ReceivedItem'] as $key => $value)
		{
			//pr($value); exit;

			$month = date("m"); 
		    $year = date("y");
		    $hour = date("H");
		    $minute = date("i");
		    $seconds = date("s");
		    $random = rand(1000, 10000);
		        
			$code =  $year. $month .$random;

			$stock['uuid'] = $code;
			$stock['model'] = $value['model'];
			$stock['item_id'] = $value['foreign_key'];
			$stock['quantity'] = $value['quantity'];
			$this->save($stock);
		}

		


		

	}

}