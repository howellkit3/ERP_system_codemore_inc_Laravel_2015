<?php

App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class OvertimeRate extends AppModel {

    public $useDbConfig = 'koufu_payrolls';

	public $recursive = -1;

	public $name = 'OvertimeRate';

	public $actsAs = array('Containable');
    
    public function bind($model = array('Group')){

    	$this->bindModel(array(
			'belongsTo' => array(
				'DayType' => array(
					'className' => 'DayType',
					'foreignKey' => 'day_type_id',
				),
				
			),
		),false);

		$this->contain($model);
	}
		

}