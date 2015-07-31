<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Category extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Category';

    public $actsAs = array('Containable');

    
	public function saveCategory($categoryData = null , $userId){

		if (!empty($categoryData)) {

			$this->create();
			
			$categoryData['Category']['id'] = !empty($categoryData['Category']['id']) ? $categoryData['Category']['id'] : '';

			$categoryData['Category']['created_by'] = $userId;

			$categoryData['Category']['modified_by'] = $userId;
			
			return $this->save($categoryData);
		}
		
	}

}