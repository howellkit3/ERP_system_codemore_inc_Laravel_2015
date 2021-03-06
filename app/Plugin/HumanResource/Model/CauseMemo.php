<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class CauseMemo extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'CauseMemo';

    public $actsAs = array('Containable');

    public function saveCauseMemo($data = null, $auth = null){

    	$month = date("m"); 
	    $year = date("y");
	    $hour = date("H");
	    $minute = date("i");
	    $seconds = date("s");
	    $random = rand(1000, 10000);
	        
		$code =  $year. $month .$random;

		$this->create();

				$data['CauseMemo']['modified_by'] = $auth;
				$data['CauseMemo']['created_by'] = $auth;
				$data['CauseMemo']['uuid'] = $code;
				$data['CauseMemo']['status_id'] = 9;
				
		$this->save($data);


	}

	public function editCauseMemo($data = null, $auth = null){



		$this->create();

				$data['CauseMemo']['modified_by'] = $auth;
				
		$this->save($data);


	}

	public function bind($model = array('Group')){

		$this->bindModel(array(
			
				'belongsTo' => array (
					'Employee' => array(
						'className' => 'Employee',
						'foreignKey' => false,
						'conditions' => array('Employee.id = CauseMemo.employee_id'),
						'dependent' => true,
					),
					'Status' => array(
						'className' => 'Status',
						'foreignKey' => false,
						'conditions' => array('Status.id = CauseMemo.status_id'),
						'dependent' => true,
					),
					
				)
			),false);

		$this->contain($model);
	}
    
	
  }
