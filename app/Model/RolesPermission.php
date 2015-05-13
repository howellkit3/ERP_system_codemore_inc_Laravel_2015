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

    public function saveRoleperm($ids = null , $data = null){
        
        $approved = !empty($ids['Permission']['approved']) ? $ids['Permission']['approved'] : array() ;
        
        $saveData = [];

        foreach ($data['Permission'] as $key => $dataList) {

            if (!in_array($key, $approved)) {
                $saveData[$key]['id'] = '';  
                 $saveData[$key]['role_id'] = $data['Role']['id'];
                 $saveData[$key]['permission_id'] = $key; 
            }
           
        }
        $this->saveAll($saveData);

        $delete = !empty($ids['Permission']['delete']) ? $ids['Permission']['delete'] : array() ;

        if(!empty($delete)){
            $this->deleteAll(array('RolesPermission.role_id' => $data['Role']['id'],'RolesPermission.permission_id' => $delete), false);
        }
       
        
    }


}