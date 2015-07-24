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

    public function saveGatepass($gateData = null, $auth = null, $gatePassId = null){

        if(!empty($gateData['GatePass'])){
       
            foreach ($gateData['GatePass'] as $key => $value) {

                $this->create();
                $gateData['GatePass'][$key] = $value;
                $value['gatepass_truck_id'] = $gatePassId;
                
                $this->save($value);
                
            }
        }

    return $this->id;

    }

}