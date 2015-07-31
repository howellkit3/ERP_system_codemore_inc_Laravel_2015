<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Type extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Type';

    public $actsAs = array('Containable');

    
	public function saveType($typeData = null , $userId){

		if (!empty($typeData)) {

			$this->create();
			
			$typeData['Type']['id'] = !empty($typeData['Type']['id']) ? $typeData['Type']['id'] : '';

			$typeData['Type']['created_by'] = $userId;

			$typeData['Type']['modified_by'] = $userId;
			
			return $this->save($typeData);
		}
		
	}

}