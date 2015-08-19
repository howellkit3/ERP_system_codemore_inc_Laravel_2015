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

  	public function saveItemRecord($inrecordID , $data){


  		foreach ($data as $key => $value)
		{
			
	  		$this->create();
	  		//pr($value); exit;
	  		$inrecordItems['type_record'] = 0;
	  		$inrecordItems['type_record_id'] = $inrecordID;
	  		$inrecordItems['model'] = $value['model'];
	  		$inrecordItems['foreign_key'] = $value['foreign_key'];
	  		$inrecordItems['quantity'] = $value['quantity'];
	  		
	  			//pr($inrecordItems); 	
	  		$this->save($inrecordItems);

	  		
	  	}
  	}

}