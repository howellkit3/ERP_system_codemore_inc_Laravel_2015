<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class LeaveType extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'LeaveType';

    public $actsAs = array('Containable');

    
	public function saveLeaveType($leavetypeData = null , $userId){

		if (!empty($leavetypeData)) {

			$this->create();
			
			$leavetypeData['LeaveType']['id'] = !empty($leavetypeData['LeaveType']['id']) ? $leavetypeData['LeaveType']['id'] : '';

			$leavetypeData['LeaveType']['created_by'] = $userId;

			$leavetypeData['LeaveType']['modified_by'] = $userId;
			
			return $this->save($leavetypeData);
		}
		
	}

}