<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Tool extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Tool';

    public $actsAs = array('Containable');
    
      public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Tooling' => array(
					'className' => 'Tooling',
					'foreignKey' => 'tools_id',
					'dependent' => true,
				)
		),false);

		$this->contain($model);
	}
	
  }
