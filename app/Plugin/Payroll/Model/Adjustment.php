<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Adjustment extends AppModel {

    public $useDbConfig = 'koufu_payrolls';

    public $name = 'Adjustment';
	
    public $actsAs = array('Containable');

	public function bind($model = array('Group')){

		 // $this->bindModel(array(
		 // 	'belongsTo' => array(
		 // 		'Employee' => array(
		 // 			'className' => 'Employee',
		 // 			'foreignKey' => 'employee_id',
		 // 			'dependent' => true
		 // 		))
		 // ),false);

		 // $this->contain($model);
	}

	public function updatePayroll($data = null) {

		$update = '';
		$saveData = '';



		foreach ($data as $key => $list) {
			
			if (!empty($list['adjustment_ids'])) {

				$ids = (array)json_decode($list['adjustment_ids']);

				foreach ($ids as $key => $value) {

					if (!empty($value)) {

						$saveData['is_process'] = 1;
						$saveData['id'] = $value;

						$update = $this->save($saveData);
					}

					
				}

			}
		}


		return $update;
	}


}