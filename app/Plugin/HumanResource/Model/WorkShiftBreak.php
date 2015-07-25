<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class WorkShiftBreak extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $usetable = 'work_shift_breaks';


    public $name = 'WorkShiftBreak';

    public $actsAs = array('Containable');


     public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'WorkShift' => array(
					'className' => 'WorkShift',
					'foreignKey' => 'workshift_id',
					'dependent' => true
				),
			
			)
		),false);

		$this->contain($model);
	}



	public function saveBreaks($data = null,$workShiftId = null,$authId = null) {

		$this->deleteAll(array('WorkShiftBreak.workshift_id' => $workShiftId ));
		
		if (!empty($data['breaktime_ids'])) {
			//$data = ['WorkshiftBreak'];
			$breaks = explode(',', $data['breaktime_ids']);

			$breakData = [];

			foreach ($breaks as $key => $break) {

				$breakData[$key]['workshift_id'] = $workShiftId;
				$breakData[$key]['breaktime_id'] = $break;
				$breakData[$key]['created_by'] = $authId;
				$breakData[$key]['modified_by'] = $authId;
			}


			$this->saveAll($breakData);

			return $breakData;

		}
	}



    
  }
