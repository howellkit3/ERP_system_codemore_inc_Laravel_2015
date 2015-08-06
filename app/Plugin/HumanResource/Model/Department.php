<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Department extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Department';

    public $actsAs = array('Containable');

    
	public function saveDepartment($departmentData = null , $userId){

		if (!empty($departmentData)) {

			$this->create();

			$initial = '';

			$departmentData['Department']['prefix'] = '';

			if (empty($departmentData['Department']['prefix'])) {


				$aName = explode(" ", $departmentData['Department']['name']);

				if (count($aName) > 1) {

					foreach ($aName as $key => $list) {
						$initial .= strtoupper($list{0});
					}

				} else {

					$initial = strtoupper($aName[0]{0}.$aName[0]{2});
				}

				$departmentData['Department']['prefix'] = $initial;

			}

			$departmentData['Department']['prefix'] = strtoupper($departmentData['Department']['prefix']);
			
			$departmentData['Department']['id'] = !empty($departmentData['Department']['id']) ? $departmentData['Department']['id'] : '';

			$departmentData['Department']['created_by'] = $userId;

			$departmentData['Department']['modified_by'] = $userId;
			
			return $this->save($departmentData);
		}
		
	}

	public function getList($conditions = array()) {

		return  $this->find('list',array('conditions' => $conditions,'fields' => array('id','name')));

	}


}