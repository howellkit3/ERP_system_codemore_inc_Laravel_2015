<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Machine extends AppModel {

    public $useDbConfig = 'koufu_production';
    public $name = 'Machine';

     public $recursive = -1;
     
    public $actsAs = array('Containable');

    public function bind($model = array('Group')){

		$this->bindModel(array(
			'hasMany' => array(
				'Department' => array(
					'className' => 'Production.Department',
					'foreignKey' => 'department_id',
					'dependent' => true,
				),
			)
		),false);

		$this->contain($model);
	}

	public function saveMachine($data,$auth){

		$this->create();
		 
		$data['Machine']['created_by'] = $auth;
		$data['Machine']['modified_by'] = $auth;
		$this->save($data);

		return $this->id;
		

	}

	
}