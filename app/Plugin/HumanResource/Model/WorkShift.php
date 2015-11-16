<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class WorkShift extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'WorkShift';

    public $actsAs = array('Containable');

    public $useTable = 'work_shifts';


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
		
		$worklist =  $this->find('all',array(
				'conditions' =>$conditions,
				'order' => array('WorkShift.name ASC'),
				'group' => array('WorkShift.id'),
				'fields' => array('WorkShift.id','WorkShift.name','WorkShift.from','WorkShift.to')
			));

		$list = array();

		foreach ($worklist as $key => $value) {

			$from = date('H:i',strtotime($value['Workshift']['from']));
			$to = date('H:i',strtotime($value['Workshift']['to']));

			$list[$value['Workshift']['id']] = $value['Workshift']['name'].' ( '.$from.' - '. $to. ' )'; 
		}
	
		return $list;
	}

	public function createWorkshift($data = null,$overtimeId = null,$auth_id = null) {

		//check existing workshift on overtime
		if ($overtimeId) {

			$editWorkshift =  $this->find('first',array('conditions' => array('WorkShift.overtime_id' => $overtimeId )));
		}

		$workshift = array();

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