<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class GatePass extends AppModel {

	public $useDbConfig = 'default';

    public $name = 'GatePass';

    public $recursive = -1;
    
	public $actsAs = array('Containable');

    public function saveGatepass($gateData = null, $auth = null){

        $this->create();

        $gateData[$this->name]['created_by'] = $auth;
        $gateData[$this->name]['modified_by'] = $auth;
       
        if($this->save($gateData)){
            return $this->id;
        }
    }

}