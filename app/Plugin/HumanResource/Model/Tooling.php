<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Tooling extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Tooling';

    public $actsAs = array('Containable');


     public function bind($model = array('Group')){

		$this->bindModel(array(
			'hasOne' => array(
				'Employee' => array(
					'className' => 'HumanResource.Employee',
					'foreignKey' => false,
					'conditions' => array('Tooling.employee_id = Employee.id'),
				),
				'Tool' => array(
					'className' => 'HumanResource.Tool',
					'foreignKey' => false,
					'conditions' => array('Tooling.tools_id = Tool.id'),
				),
			
			)
		),false);

		$this->contain($model);
	}

    
  }
