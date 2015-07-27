<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class WorkSchedule extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'WorkSchedule';

    public $actsAs = array('Containable');


     public function bind($model = array('Group')){

		$this->bindModel(array(
			'hasMany' => array(
				'WorkShiftBreak' => array(
					'className' => 'WorkShiftBreak',
					'foreignKey' => 'workshift_id',
					'dependent' => true
				),
			
			)
		),false);

		$this->contain($model);
	}


    
  }
