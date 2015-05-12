<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class Role extends AppModel {

	public $useDbConfig = 'default';

    public $name = 'Role';

    public $recursive = -1;
    
	public $actsAs = array('Containable');

    public $validate = array(

        'name' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            ),
        )    
    );

    // public function bind($model = array('Group')){

    //     $this->bindModel(array(
            
    //         'hasMany' => array(
    //             'SubProcess' => array(
    //                 'className' => 'SubProcess',
    //                 'foreignKey' => 'process_id',
    //                 'dependent' => true
    //             ),
    //         )
    //     ));

    //     $this->contain($model);
    // }

    public function saveRole($roleData = null , $auth = null){
       
        $this->create();

        $roleData[$this->name]['created_by'] = $auth;
        $roleData[$this->name]['updated_by'] = $auth;

        if($this->save($roleData)){
            return $this->id;
        }
    }

}