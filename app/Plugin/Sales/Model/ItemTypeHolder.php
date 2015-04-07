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

	public $useDbConfig = 'koufu_system';
    public $name = 'ItemTypeholder';

    public $recursive = -1;
    
	public $actsAs = array('Containable');

    public function bind($model = array('Group')){

        $this->bindModel(array(
            
            'belongsTo' => array(
                'ItemCategoryholder' => array(
                    'className' => 'ItemCategoryholder',
                    'foreignKey' => 'item_category_holder_id',
                    'dependent' => true
                ),
            )
        ));

        $this->contain($model);
    }

}