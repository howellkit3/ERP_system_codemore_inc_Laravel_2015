<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class WorkShift extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'WorkShift';

    public $actsAs = array('Containable');


     public function bind($model = array('Group')){

		$this->bindModel(array(
			'hasMany' => array(
				'WorkShiftBreak' => array(
					'className' => 'WorkShiftBreak',
					'foreignKey' => 'workshift_id',
					'dependent' => true
				),
			
			),
			'belongsTo' =>  array(
				'WorkSchedule' => array(
					'className' => 'WorkSchedule',
					'foreignKey' => 'workshift_id',
					'dependent' => false
				))
		),false);

		$this->contain($model);
	}

	public function getList($conditions = array()) {
		
		return $this->find('list',array(
				'conditions' =>$conditions,
				'order' => array('WorkShift.name ASC'),
				'group' => array('WorkShift.id'),
				//fields' => array('WorkShift.id','name')
			));
	}

	public function createWorkshift($data = null,$overtimeId = null,$auth_id = null) {

		$workshift = [];

		$this->create();

		if (!empty($data)) {

			$workshift['name'] = 'OT-'.$overtimeId.'-'.$data['Overtime']['department_id'].'-'.$data['Overtime']['date'];
			$workshift['overtime_id'] = $overtimeId;
			$workshift['from'] = $data['Overtime']['from'];
			$workshift['to'] = $data['Overtime']['to'];
			$workshift['created_by'] = $auth_id;
			$workshift['modified_by'] = $auth_id;

			if ($this->save($workshift)) {

				$workshift['id'] = $this->id;
			}

			return $workshift;

		}
	}


    
 }