<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Salary extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Salary';

    public $actsAs = array('Containable');

 	 public function bind($model = array('Group')){
 	 	
		$this->bindModel(
			array(
			'belongsTo' => array(
				'Employee' => array(
					'className' => 'HumanResource.Employee',
					'foreignKey' => 'employee_id')
								)
			),false);

		$this->contain($model);
	}

	public function saveSettings($data = null){

		if (!empty($data)) {

			$save = array();

			// $settings = $this->find('first',array('conditions' => array('Salary.employee_id' => $data['Employee']['id'] )));

			// $save['id'] = !empty($settings['Salary']['id']) ?  $settings['Salary']['id'] : '';

			// $dependent = count($data['Dependent']);

			// $status = $data['EmployeeAdditionalInformation']['status'];

			// if ( $status == 'M' ) {

			// 	if (empty($dependent)) {

			// 	}
			// 	if ($dependent == 1) {

			// 	}
			// 	if ($dependent == 2) {

			// 	}
			// 	if ($dependent == 3) {

			// 	}
			// 	if ($dependent >= 4) {

			// 	}


			// } else {

			// }
 
			// pr($data); exit();

			// $save['tax_status'] = '';

		}
	}
}