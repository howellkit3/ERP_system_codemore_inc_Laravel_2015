<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class Assistant extends AppModel {

	public $useDbConfig = 'default';

    public $name = 'Assistant';

    public $recursive = -1;
    
	public $actsAs = array('Containable');


    public function saveAssistant($AssistantData = null, $auth = null){
       
        $this->create();

        $AssistantData[$this->name]['created_by'] = $auth;
        $AssistantData[$this->name]['modified_by'] = $auth;
       
        if($this->save($AssistantData)){
            return $this->id;
        }
    }

}