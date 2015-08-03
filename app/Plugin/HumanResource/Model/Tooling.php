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
					'foreignKey' => 'id',
					'dependent' => true
				),
				'Tool' => array(
					'className' => 'HumanResource.Tool',
					'foreignKey' => 'id',
					'dependent' => true
				),
			
			)
		),false);

		$this->contain($model);
	}

    
  }
