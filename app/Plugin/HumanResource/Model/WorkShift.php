<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class WorkShift extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'WorkShift';

    public $actsAs = array('Containable');


     public function bind($model = array('Group')){

		$this->bindModel(array(
			'hasOne' => array(
				'Overtime' => array(
					'className' => 'Overtime',
					'foreignKey' => false,
					'conditions' => array('Overtime.id = WorkShift.overtime_id'),
					'dependent' => false
				)),
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
				),
			)
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

		//check existing workshift on overtime
		if ($overtimeId) {

			$editWorkshift =  $this->find('first',array('conditions' => array('WorkShift.overtime_id' => $overtimeId )));
		}


		$workshift = [];

		$this->create();

		if (!empty($data)) {
			$workshift['id'] = !empty($editWorkshift['WorkShift']['id']) ? $editWorkshift['WorkShift']['id'] : '';
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