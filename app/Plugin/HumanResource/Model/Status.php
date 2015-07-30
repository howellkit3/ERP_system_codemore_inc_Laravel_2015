<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Status extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Status';

    public $actsAs = array('Containable');

    
	public function saveStatus($statusData = null , $userId){

		if (!empty($statusData)) {

			$this->create();
			
			$statusData['Status']['id'] = !empty($statusData['Status']['id']) ? $statusData['Status']['id'] : '';

			$statusData['Status']['created_by'] = $userId;

			$statusData['Status']['modified_by'] = $userId;
			
			return $this->save($statusData);
		}
		
	}

}