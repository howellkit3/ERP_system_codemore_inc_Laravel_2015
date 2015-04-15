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
            
            'hasOne' => array(
                'ItemTypeHolder' => array(
                    'className' => 'Sales.ItemType',
                    'foreignKey' => 'item_type_holder_id',
                    'dependent' => true
                ),
            )
        ));

        $this->contain($model);
    }
