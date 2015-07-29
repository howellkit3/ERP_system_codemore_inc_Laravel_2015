<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Position extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Position';

    public $actsAs = array('Containable');

    
	public function savePosition($positionData = null , $userId){

		if (!empty($positionData)) {

			$this->create();
			
			$positionData['Position']['id'] = !empty($positionData['Position']['id']) ? $positionData['Position']['id'] : '';

			$positionData['Position']['created_by'] = $userId;

			$positionData['Position']['modified_by'] = $userId;
			
			return $this->save($positionData);
		}
		
	}

}