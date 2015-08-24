<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class MachineSpecification extends AppModel {

    public $useDbConfig = 'koufu_production_system';
    public $name = 'MachineSpecification';

     public $recursive = -1;
     
    public $actsAs = array('Containable');

    public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Machine' => array(
					'className' => 'Production.Machine',
					'foreignKey' => 'machine_id',
					'dependent' => true,
				),
			)
		),false);

		$this->contain($model);
	}

	public function saveMachineSpecification($data = null,$machineId = null,$auth = null){

		$this->create();
		 
		$data['MachineSpecification']['machine_id'] = $machineId;
		$data['MachineSpecification']['created_by'] = $auth;
		$data['MachineSpecification']['modified_by'] = $auth;
		$this->save($data);

		return $this->id;
		

	}
	
}