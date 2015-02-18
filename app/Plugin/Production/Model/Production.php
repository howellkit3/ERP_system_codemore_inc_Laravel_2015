<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Production extends AppModel {

    public $useDbConfig = 'koufu_production_system';
    public $name = 'Production';

 //    public $validate = array(

	// 	'name' => array(
	// 		'notEmpty' => array(
	// 			'rule' => array('notEmpty'),
				
	// 		),
	// 	),
	// 	'label' => array(
	// 		'notEmpty' => array(
	// 			'rule' => array('notEmpty'),
				
	// 		),
	// 	),
	// 	'description' => array(
	// 		'notEmpty' => array(
	// 			'rule' => array('notEmpty'),
				
	// 		),
	// 	),

	// );
	
}