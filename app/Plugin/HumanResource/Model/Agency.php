<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Agency extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Agency';

    public $actsAs = array('Containable');

    
	public function saveAgency($sagencyData = null , $userId){

		if (!empty($sagencyData)) {

			$this->create();
			
			$sagencyData['Agency']['id'] = !empty($sagencyData['Agency']['id']) ? $sagencyData['Agency']['id'] : '';

			$sagencyData['Agency']['created_by'] = $userId;

			$sagencyData['Agency']['modified_by'] = $userId;
			
			return $this->save($sagencyData);
		}
		
	}

}