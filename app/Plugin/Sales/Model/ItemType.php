<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class ItemType extends AppModel {
	public $useDbConfig = 'koufu_sale';
    public $name = 'ItemType';
    public $actsAs = array('Containable');
 
	public function saveType($data){

    	$this->create();
    	$data['ItemType']['category_id'] = $data['ItemType']['category_name'];
    	$data['ItemType']['type_description'] = $data['ItemType']['itemName'];
		$this->saveAll($data);
		return $this->id;
		

    }

}