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

	public function createPosition($data = array() , $auth = null) {

		$positionData = array();

		if (!empty($data)) {

			$positionData['Position']['name']  = $data['Employee']['position_id_others'];

			$positionData['Position']['description'] = $data['Employee']['position_id_others'];

			$positionData['Position']['specification'] = $data['Employee']['position_id_others'];

			$positionData['Position']['notes'] = '';

			$positionData['Position']['created_by'] = $auth['id'];

			$positionData['Position']['modified_by'] = $auth['id'];
			

			if ($this->save($positionData) ) {

				return $this->id;
			}


		}
	}


}