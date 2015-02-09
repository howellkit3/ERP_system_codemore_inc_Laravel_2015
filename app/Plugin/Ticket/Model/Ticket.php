<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class Ticket extends AppModel {

    public $useDbConfig = 'koufu_ticketing_system';

    public $name = 'Ticket';

	// public $recursive = -1;

	// public $actsAs = array('Containable');

	// public function bind($model = array('Group')){

	// 	$this->bindModel(array(
	// 		'belongsTo' => array(
	// 			'Company' => array(
	// 				'className' => 'Company',
	// 				'foreignKey' => 'foreign_key',
	// 				'dependent' => true
	// 			),
	// 			'Contactperson' => array(
	// 				'className' => 'Company',
	// 				'foreignKey' => 'Contactperson',
	// 				'dependent' => true
	// 			)
	// 		)
	// 	));

	// 	$this->contain($model);
	// }

	public $validate = array(

		'unique_id' => array(
			'unique' => array(
				'rule'    => 'isUnique',
				'message' => 'This Ticket Unique Id has already been taken.'
			)
		),
	
	);

	public function saveUniqueId($uniqueId = null,$auth = nnull){

		$this->create();

		if($this->save(array('unique_id' =>$uniqueId ,'created_by' =>$auth,'modified_by' =>$auth))){

        	return $this->id;

        }
	}

}
