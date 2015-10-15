<?php
App::uses('AppModel', 'Model');

class Overtime extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Overtime';

    public $actsAs = array('Containable');

    var $useTable = 'overtimes';

     public function bind($model = array('Group')){

		$this->bindModel(
			array(
			'belongsTo' => array(
				'Department' => array(
					'className' => 'Department',
					'foreignKey' => 'department_id')
								)
			),false);

		$this->contain($model);
	}

    public function formatData($data = null,$auth = null) {
        
        $employeeIds = array();

        if (is_array($data['Employee']['id'] )) {

            $employeeIds = $data['Employee']['id'];
        } else {

         foreach ($data['Employee']['id'] as $key => $value) {
            
            $employeid = explode('-', $value);

            array_push($employeeIds, $employeid[0]);

            $data['Attendance']['id'][$key] = $employeid[1];
            
        }
        }
      

    	if (!empty($data['Employee'])) {

    		$data[$this->alias]['employee_ids']	= json_encode($employeeIds);	
            //$data['Employee']['id']
    	}

    	$data[$this->alias]['created_by'] = $auth;
    	$data[$this->alias]['modified_by'] = $auth;

    	return $data;


    }
}