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

  	public function saveStock($received, $data, $auth, $supplierId){

		$this->create();

		$stock['supplier_id'] = $received['PurchaseOrder']['supplier_id'];
		$stock['location_id'] = $data['InRecord']['storekeeper'];
		$stock['remarks'] = $data['InRecord']['remarks'];

		

		foreach ($received['ReceivedItem'] as $key => $value)
		{
			pr($received); exit;


			$month = date("m"); 
		    $year = date("y");
		    $hour = date("H");
		    $minute = date("i");
		    $seconds = date("s");
		    $random = rand(1000, 10000);
		        
			$code =  $year. $month .$random;

			$value['uuid'] = $code;
			$value['model'] = $value['model'];
			$value['item_id'] = $value['foreign_key'];
			$value['supplier_id'] = $supplierId;
			$value['quantity'] = $value['quantity'];
			$value['size1'] = $value['size1'];
			$value['location_id'] = $data['InRecord']['location'];
			$value['size1_unit_id'] = $value['size1_unit_id'];
			$value['size2'] = $value['size2'];
			$value['size2_unit_id'] = $value['size2_unit_id'];
			$value['size3'] = $value['size3'];
			$value['size3_unit_id'] = $value['size3_unit_id'];
			$value['quantity_unit_id'] = $value['quantity_unit_id'];
			$value['created_by'] = $auth;
			$value['modified_by'] = $auth;


			$this->save($value);

			//pr($value);
		} 


	}

}