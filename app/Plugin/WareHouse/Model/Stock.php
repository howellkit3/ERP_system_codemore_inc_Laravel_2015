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

  	public function saveStock($received, $data, $auth){

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
			$stock['size1'] = $value['size1'];
			$stock['size1_unit_id'] = $value['size1_unit_id'];
			$stock['size2'] = $value['size2'];
			$stock['size2_unit_id'] = $value['size2_unit_id'];
			$stock['size3'] = $value['size3'];
			$stock['size3_unit_id'] = $value['size3_unit_id'];
			$stock['quantity_unit_id'] = $value['quantity_unit_id'];
			$stock['created_by'] = $auth;
			$stock['modified_by'] = $auth;


			$this->save($stock);
		}

		


		

	}

}