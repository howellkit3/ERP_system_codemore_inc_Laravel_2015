
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

  	public function saveStock($received,$data, $auth, $supplierId, $stockData){

		$this->create();

		$stock['supplier_id'] = $received['ReceivedOrder']['supplier_id'];
		$stock['location_id'] = $data['InRecord']['storekeeper'];
		$stock['remarks'] = $data['InRecord']['remarks'];


		foreach ($received['ReceivedItem'] as $key => $value) {
			// pr($stockData); exit;

			$month = date("m"); 
		    $year = date("y");
		    $hour = date("H");
		    $minute = date("i");
		    $seconds = date("s");
		    $random = rand(1000, 10000);
		        
			$code =  $year. $month .$random;

			
			$foreignkeyholder = $value['foreign_key'];
			$model = $value['model'];
			
					$value['quantity'] = $value['quantity'] + $value['addQuantity'];
					$value['uuid'] = $code;
					$value['model'] = $value['model'];
					$value['item_id'] = $value['foreign_key'];
					$value['supplier_id'] = $supplierId;
					$value['quantity'] = $value['quantity'];
					$value['location_id'] = $data['InRecord']['location'];
					$value['quantity_unit_id'] = !empty($value['quantity_unit_id']) ? $value['quantity_unit_id'] : 14 ;
					$value['created_by'] = $auth;
					$value['modified_by'] = $auth;

					$value['size1'] = !empty($value['size1']) ? $value['size1'] : " ";
					$value['size1_unit_id'] = !empty($value['size1_unit_id']) ? $value['size1_unit_id'] : " ";
					$value['size2'] = !empty($value['size2']) ? $value['size2'] : " ";
					$value['size2_unit_id'] = !empty($value['size2_unit_id']) ? $value['size2_unit_id'] : " " ;
					$value['size3'] = !empty($value['size3']) ? $value['size3'] : " ";
					$value['size3_unit_id'] = !empty($value['size3_unit_id']) ? $value['size3_unit_id'] : " ";

				$this->save($value);

			}

		}

	public function saveOutRecordStock($data, $auth, $stockData){  

		foreach ($data as $key => $value) {

			foreach ($stockData as $key => $valueOfStock) {

				$modelHolder = $valueOfStock['Stock']['model'];

				$foreign_keyHolder = $valueOfStock['Stock']['item_id'];

				if($value['model'] == $modelHolder && $value['foreign_key'] == $foreign_keyHolder){

					$deductedQuantity = $valueOfStock['Stock']['quantity'] - $value['quantity'];

					$stock['id'] = $valueOfStock['Stock']['id'];

					$stock['quantity'] = $deductedQuantity;

					$this->save($stock);

				// 	return "0";

				// }else{

				// 	return "1";
				}


			}

		}


	}

	}

//}