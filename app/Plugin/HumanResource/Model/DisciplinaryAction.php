<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class DisciplinaryAction extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'DisciplinaryAction';

    public $actsAs = array('Containable');

 	public function saveDisciplinaryAction($data = null, $auth = null){

		$this->create();

				$data['DisciplinaryAction']['modified_by'] = $auth;
				$data['DisciplinaryAction']['created_by'] = $auth;
				
		$this->save($data);


	}
    
	
  }
