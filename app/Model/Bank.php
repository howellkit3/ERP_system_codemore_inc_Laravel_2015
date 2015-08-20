<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class Bank extends AppModel {

	public $useDbConfig = 'default';

    public $name = 'Bank';

    public $recursive = -1;
    
	public $actsAs = array('Containable');

    public $validate = array(

        'name' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            ),
        ),  
        'code' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            ),
        )   
    );

    
    public function saveBank($bankData = null , $auth = null){
       
        $this->create();

        $bankData[$this->name]['created_by'] = $auth;
        $bankData[$this->name]['updated_by'] = $auth;
       
        if($this->save($bankData)){

            return $this->id;

        }
    }

}