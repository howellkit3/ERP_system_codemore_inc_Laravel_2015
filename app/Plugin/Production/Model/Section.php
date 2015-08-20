<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Section extends AppModel {

    public $useDbConfig = 'koufu_production_system';
    public $name = 'Section';

	public function saveSection($data,$auth){
		
		$this->create();
		 
		$data['Section']['created_by'] = $auth;
		$data['Section']['modified_by'] = $auth;
		$this->save($data);

		return $this->id;
		

	}
	
}