<?php

App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');

//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class Payroll extends AppModel {

    public $useDbConfig = 'koufu_payrolls';

	public $recursive = -1;

	public $name = 'Payroll';

	public $actsAs = array('Containable');
    
    public function bind($model = array('Group')){

  //   	$this->bindModel(array(
		// 	'belongsTo' => array(
		// 		'DayType' => array(
		// 			'className' => 'DayType',
		// 			'foreignKey' => 'day_type_id',
		// 		),
				
		// 	),
		// ),false);

		$this->contain($model);
	}
		

	public function createPayroll($data = null , $auth = null) {

		if (!empty($data)) {
			$data[$this->alias]['status'] = 'pending';
			$data[$this->alias]['created_by'] = $auth['id'];
			$data[$this->alias]['modified_by'] = $auth['id'];
			if (!empty($data[$this->alias]['date']) ){
				$dates = explode(':', $data[$this->alias]['date'] );
			}
			$data[$this->alias]['from'] = date('Y-m-d',strtotime($dates[0].'-'.$data[$this->alias]['month_year']));
			$data[$this->alias]['to'] = date('Y-m-d',strtotime($dates[1].'-'.$data[$this->alias]['month_year']));
			$data[$this->alias]['date'] = date('Y-m-d');
			$data[$this->alias]['transaction_date'] = date('Y-m-d');
			//$data[$this->alias]['transaction_date'] = date('Y-m-d');
		}

		return $data;
	}

	public function objectToArray( $object = null )
    {

    	foreach ($object as $key => $value) {
    		$object[$key] = (array)$value;

    	}
        return $object;
    }

}