<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class GatePassTruck extends AppModel {

	public $useDbConfig = 'default';

    public $name = 'GatePassTruck';

    public $recursive = -1;
    
	public $actsAs = array('Containable');

    public function saveGatePassTruck($assistantData = null, $auth = null){
       
        // foreach ($assistantData['GatePassAssistant'] as $key => $helperList) {
        //     $this->create();
            $assistantData['GatePassTruck']['created_by'] = $auth;
            $assistantData['GatePassTruck']['modified_by'] = $auth;
            $this->save($assistantData);

            if($this->save($assistantData)){
            return $this->id;
        }
        // }
        // return 1;
    }

}