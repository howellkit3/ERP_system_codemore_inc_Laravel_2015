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

  	public function saveItemRecord($inrecordData , $id){

  	//	pr ($inrecordData); exit;
  		foreach ($inrecordData as $key => $value)
		{
			
	  		$this->create();
	  		
	  		$inrecordItems['type_record'] = 0;
	  		$inrecordItems['type_record_id'] = $id;
	  		$inrecordItems['model'] = $value['model'];
	  		$inrecordItems['foreign_key'] = $value['foreign_key'];
	  		$inrecordItems['quantity'] = $value['quantity'];
	  		
	  		
	  		$this->save($inrecordItems);

	  		
	  	}
  	}

}