<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class Department extends AppModel {

    public $useDbConfig = 'koufu_warehouse';
    
  	public $name = 'Department';


  	public function saveDepartment($supplierData = null, $auth = null){
		
		$this->create();

        $supplierData['created_by'] = $auth;
        $supplierData['modified_by'] = $auth;

    	if($this->save($supplierData)){
    		return $this->id;
    	}
	} 

}