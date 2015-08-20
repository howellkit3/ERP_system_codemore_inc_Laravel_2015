<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Department extends AppModel {

    public $useDbConfig = 'koufu_production_system';
    public $name = 'Department';

     public $recursive = -1;
     
    public $actsAs = array('Containable');

    public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Machine' => array(
					'className' => 'Production.Machine',
					'foreignKey' => 'department_id',
					'dependent' => true,
				),
			)
		),false);

		$this->contain($model);
	}

	public function addDepartment($data,$auth){
		
		$this->create();
		 
		$data['Department']['created_by'] = $auth;
		$data['Department']['modified_by'] = $auth;
		$this->save($data);

		return $this->id;
		

	}
	
}