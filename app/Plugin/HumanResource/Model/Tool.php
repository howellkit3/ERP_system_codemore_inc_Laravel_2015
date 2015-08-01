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
				))
		),false);

		$this->contain($model);
	}

	public function saveTool($toolData = null , $userId){

		if (!empty($toolData)) {

			$this->create();
			
			$toolData['Tool']['id'] = !empty($toolData['Tool']['id']) ? $toolData['Tool']['id'] : '';

			$toolData['Tool']['created_by'] = $userId;

			$toolData['Tool']['modified_by'] = $userId;
			
			return $this->save($toolData);
		}
		
	}
	
  }
