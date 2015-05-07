<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class Unit extends AppModel {

	public $useDbConfig = 'default';

    public $name = 'Unit';

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
            
    //         'belongsTo' => array(
    //             'PackagingHolder' => array(
    //                 'className' => 'PackagingHolder',
    //                 'foreignKey' => 'packaging_holder_id',
    //                 'dependent' => true
    //             ),
    //         )
    //     ));

    //     $this->contain($model);
    // }

    public function saveUnit($unitData = null, $auth = null){
        
        $this->create();

        $unitData['created_by'] = $auth;
        $unitData['modified_by'] = $auth;

        if($this->save($unitData)){
            return $this->id;
        }
    }

   public function getList($conditions = array(),$fields = array('id','unit')) {

        return $this->find('list',array(
            'conditions' => $conditions,
            'fields'    => $fields
            ));
    }

    public function afterSave($data,$options = array()) {

        Cache::delete('unitData');

    }
    public function afterDelete() {

        Cache::delete('unitData');

    }

}