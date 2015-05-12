<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class RolesPermission extends AppModel {

	public $useDbConfig = 'default';

    public $name = 'RolesPermission';

    public $recursive = -1;
    
	public $actsAs = array('Containable');


    public function bind($model = array('Group')){

        $this->bindModel(array(
            
            'hasMany' => array(
                'Role' => array(
                    'className' => 'Role',
                    'foreignKey' => 'role_id',
                    'dependent' => true
                ),
                'Permission' => array(
                    'className' => 'Permission',
                    'foreignKey' => 'permission_id',
                    'dependent' => true
                ),
            )
        ));

        $this->contain($model);
    }


}