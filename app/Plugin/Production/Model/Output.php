<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Output extends AppModel {

    public $useDbConfig = 'koufu_production';
    public $name = 'Output';

     public $recursive = -1;
     
    public $actsAs = array('Containable');

    public function bind($model = array('Group')){

		// $this->bindModel(array(
		// 	'hasMany' => array(
		// 		'Department' => array(
		// 			'className' => 'Production.Department',
		// 			'foreignKey' => 'department_id',
		// 			'dependent' => true,
		// 		),
		// 	)
		// ),false);

		$this->contain($model);
	}

	public function saveOutput($data,$auth){

		$this->create();
		 
		$data['Output']['created_by'] = $auth['id'];
		$data['Output']['modified_by'] = $auth['id'];
		$this->save($data);

		return $this->id;
		
	}
	
}