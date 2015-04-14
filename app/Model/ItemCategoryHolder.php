<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class ItemCategoryHolder extends AppModel {

	public $useDbConfig = 'default';

    public $name = 'ItemCategoryHolder';

    public $recursive = -1;

    public $actsAs = array('Containable');

    public $validate = array(

		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'status' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		)
	
	);

    public function bind($model = array('Group')){

		$this->bindModel(array(
			
			'hasOne' => array(
				'ItemTypeHolder' => array(
					'className' => 'ItemTypeHolder',
					'foreignKey' => 'item_category_holder_id',
					'dependent' => true
				),
			)
		));

		$this->contain($model);
	}
	
	public function saveCategory($categoryData = null, $auth = null){
		
		$this->create();

        $categoryData['created_by'] = $auth;
        $categoryData['modified_by'] = $auth;

    	if($this->save($categoryData)){
    		return $this->id;
    	}
	}
}