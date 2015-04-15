<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class ItemCategory extends AppModel {
	public $useDbConfig = 'default';
    public $name = 'ItemCategory';
    public $actsAs = array('Containable');

    public function bind($model = array('Group')){

		$this->bindModel(array(
			
			'hasMany' => array(
				'ItemType' => array(
					'className' => 'Sales.ItemType',
					'foreignKey' => 'category_id',
					'dependent' => true
				),
			)
		));

		$this->contain($model);
	}

    public function saveCategory($data,$auth){

    	$this->create();
    	$data['ItemCategory']['category_name'] = $data['Category']['category_name'];
    	$data['ItemCategory']['status'] = 'active';
		$this->saveAll($data);
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