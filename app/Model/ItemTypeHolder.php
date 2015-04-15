<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class ItemTypeholder extends AppModel {

	public $useDbConfig = 'default';

    public $name = 'ItemTypeholder';

    public $useTable = 'item_type_holders';

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
        ),

        'category' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            ),
        )
    
    );

    public function bind($model = array('Group')){

        $this->bindModel(array(
            
            'belongsTo' => array(
                'ItemCategoryHolder' => array(
                    'className' => 'ItemCategoryHolder',
                    'foreignKey' => 'item_category_holder_id',
                    'dependent' => true
                ),
            )
        ));

        $this->contain($model);
    } 

    public function saveItemType($categoryData = null,$categoryId = null){
        //pr($categoryData);exit();
        $this->create();

        $categoryData['item_category_holder_id'] = $categoryId;
        

        if($this->save($categoryData)){
            return $this->id;
        }
    }

    public function saveType($typeData = null, $auth = null){
        $this->create();

        $typeData['created_by'] = $auth;
        $typeData['modified_by'] = $auth;

        if($this->save($typeData)){
            return $this->id;
        }
    }

}