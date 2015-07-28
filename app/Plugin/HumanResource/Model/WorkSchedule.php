<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class WorkSchedule extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'WorkSchedule';

    public $actsAs = array('Containable');


     public function bind($model = array('Group')){

		$this->bindModel(array(
			'hasOne' => array(
				'WorkShift' => array(
					'className' => 'HumanResource.WorkShift',
					'foreignKey' => false,
					'conditions' => array('WorkShift.id = WorkSchedule.work_shift_id'),
					'dependent' => true
				),
			
			),
			'belongsTo' => array(
				'Employee' => array(
					'className' => 'HumanResource.Employee',
					'foreignKey' => false,
					'conditions' => array('Employee.id = WorkSchedule.foreign_key'),
					'dependent' => true
				),

				)
		),false);

		$this->contain($model);
	}


    
  }
