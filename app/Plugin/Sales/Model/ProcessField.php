<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class ProcessField extends AppModel {
	public $useDbConfig = 'koufu_sale';
    public $name = 'ProcessField';
    public $actsAs = array('Containable');

 //    public function bind($model = array('Group')){

	// 	$this->bindModel(array(
			
	// 		'hasMany' => array(
	// 			'ItemType' => array(
	// 				'className' => 'Sales.ItemType',
	// 				'foreignKey' => 'category_id',
	// 				'dependent' => true
	// 			),
	// 		)
	// 	));

	// 	$this->contain($model);
	// }

   public function saveProcess($data,$auth) {
		
		$this->create();
		
		$data['ProcessField']['created_by'] = $auth;
		$data['ProcessField']['modified_by'] = $auth;	
			
		$this->saveAll($data['ProcessField']);
		return $this->id;
		
		
	}

    public function deleteItem($name){
    	
    	$this->id = $this->find('first',array(
			'conditions' => array(
				'category_name' => $name,
				'status' => 'active'
				)
			));

		if ($this->id) {
		    $this->saveField('status', 'inactive');

		}

		return $this->id;	

    }
}