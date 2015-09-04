<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class ItemRecord extends AppModel {

    public $useDbConfig = 'koufu_warehouse';
    
  	public $name = 'ItemRecord';

  	public function saveItemRecord($inrecordData , $data){

  		foreach ($data as $key => $value)
		{
			
	  		$this->create();
	  		
	  		$inrecordItems['type_record'] = 0;
	  		$inrecordItems['type_record_id'] = $inrecordData;
	  		$inrecordItems['model'] = $value['model'];
	  		$inrecordItems['foreign_key'] = $value['foreign_key'];
	  		$inrecordItems['quantity'] = $value['quantity'];
	  		
	  		 
	  		$this->save($inrecordItems);

	  		
	  	}
  	}

  	public function saveOutItemRecord($requestData , $outRecordId, $stockData){

  	//	pr('$stockData'); exit;

   		foreach ($requestData as $key => $value)
		 { //pr($value); exit;

		 	$value['stock_quantity'] = 0;

			foreach ($stockData as $key => $valueOfStock) {

				$modelHolder = $valueOfStock['Stock']['model'];

				$foreign_keyHolder = $valueOfStock['Stock']['item_id'];

				$this->create();

				if($value['model'] == $modelHolder && $value['foreign_key'] == $foreign_keyHolder){

					$value['stock_quantity'] = $valueOfStock['Stock']['quantity'];

				}
				
			}


	
	  		$this->create();
	  		
	  		$value['type_record'] = 1;
	  		$value['type_record_id'] = $outRecordId;
	  		// $value['model'] = $value['model'];
	  		// $value['foreign_key'] = $value['foreign_key'];
	  		// $value['quantity'] = $value['quantity'];
	  		
	  		$this->save($value);
	  		//pr($value); 
	  		
	  	}  
  	}

}