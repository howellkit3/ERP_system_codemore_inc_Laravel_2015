<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class StatusFieldHolder extends AppModel {

	public $useDbConfig = 'default';

    public $name = 'StatusFieldHolder';

    public $recursive = -1;

    public $actsAs = array('Containable');

    public $validate = array(

		
		'status' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		)
	
	);

    public function bind($model = array('Group')){

		$this->bindModel(array(
			
			'hasMany' => array(
				'ItemTypeHolder' => array(
					'className' => 'ItemTypeHolder',
					'foreignKey' => 'item_category_holder_id',
					'dependent' => true
				),
			)
		));

		$this->contain($model);
	}
	/*public function saveCategory($categoryData = null, $auth = null){
		
		$this->create();

        $categoryData['created_by'] = $auth;
        $categoryData['modified_by'] = $auth;

    	if($this->save($categoryData)){
    		return $this->id;
    	}
	} */

	public function saveStatus($statusData = null, $auth = null){
		//pr($categoryData); exit;
		$this->create();

        $statusData['created_by'] = $auth;
        $statusData['modified_by'] = $auth;

    	if($this->save($statusData)){
    		return $this->id;
    	}
	} 
}