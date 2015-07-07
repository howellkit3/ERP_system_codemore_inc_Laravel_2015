<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class GatePassAssistant extends AppModel {

	public $useDbConfig = 'default';

    public $name = 'GatePassAssistant';

    public $recursive = -1;
    
	public $actsAs = array('Containable');

    public function saveGatePassAssistant($assistantData = null,$gateId = null, $auth = null){
       
        foreach ($assistantData['GatePassAssistant'] as $key => $helperList) {
            $this->create();
            $helperList['created_by'] = $auth;
            $helperList['modified_by'] = $auth;
            $helperList['gate_pass_id'] = $gateId;
           
            $this->save($helperList);
        }
        return 1;
    }

}