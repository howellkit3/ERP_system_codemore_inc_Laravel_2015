<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class Driver extends AppModel {

	public $useDbConfig = 'default';

    public $name = 'Driver';

    public $recursive = -1;
    
	public $actsAs = array('Containable');



    public function saveDriver($driverData = null, $auth = null){
       
        $this->create();

        $driverData[$this->name]['created_by'] = $auth;
        $driverData[$this->name]['modified_by'] = $auth;
       
        if($this->save($driverData)){
            return $this->id;
        }
    }

}