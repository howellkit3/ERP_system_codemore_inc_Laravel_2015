<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Breaktime extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Breaktime';

    public $actsAs = array('Containable');
    
     public function bind($model = array('Group')){

		// $this->bindModel(array(
		// 	'belongsTo' => array(
		// 		'Tooling' => array(
		// 			'className' => 'Tooling',
		// 			'foreignKey' => 'tools_id',
		// 			'dependent' => true,
		// 		)
		// ),false);

		// $this->contain($model);
	}


	
  }
