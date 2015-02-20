<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Schedule extends AppModel {

    public $useDbConfig = 'koufu_production_system';
    public $name = 'Schedule';
    
	public $validate = array(
        'description' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message'=>'Select Company',
			),
		),
		
		'schedule_from' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
			),
		),

		'schedule_to' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
			),
		),

    );

	public function addSchedule($data,$auth){
		$this->create();
		 
		$data['Schedule']['created_by'] = $auth;
		$data['Schedule']['modified_by'] = $auth;
		$this->save($data);

		return $this->id;
		

	}
	
}