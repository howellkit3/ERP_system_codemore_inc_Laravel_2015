<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class Area extends AppModel {

	public $useDbConfig = 'default';

    public $name = 'Area';

    public $recursive = -1;
    
	public $actsAs = array('Containable');

    public $validate = array(

        'name' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            ),
        )    
    );

    public function saveArea($areaData = null, $auth = null){
        
        $this->create();

        $areaData['created_by'] = $auth;
        $areaData['modified_by'] = $auth;

        if($this->save($areaData)){
            return $this->id;
        }
    }

}
