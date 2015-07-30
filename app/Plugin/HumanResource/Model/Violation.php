<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Violation extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Violation';

    public $actsAs = array('Containable');

	public function saveViolation($data = null, $auth = null){

		$this->create();

				$data['Violation']['modified_by'] = $auth;
				$data['Violation']['created_by'] = $auth;
				
		$this->save($data);


	}
    
	
  }
