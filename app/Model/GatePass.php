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
       
        pr($gateData['GatePass_uuid']);
        foreach ($gateData['GatePass_uuid'] as $key => $value['ref_uuid']) {

            $gateData['GatePass_uuid'][$key]['ref_uuid'] = $value;
            // $gateData[$this->name][$key]['created_by'] = $auth;
            // $gateData[$this->name][$key]['modified_by'] = $auth;
            pr($gateData['GatePass_uuid']);
        }
        exit();
        $this->create();

        $gateData[$this->name]['created_by'] = $auth;
        $gateData[$this->name]['modified_by'] = $auth;
       
        if($this->save($gateData)){
            return $this->id;
        }
    }

}