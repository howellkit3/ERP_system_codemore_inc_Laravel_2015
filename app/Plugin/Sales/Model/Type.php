<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class Type extends AppModel {

	//public $useTable = 'customers'; // name of the database table 
    public $useDbConfig = 'koufu_sale';

	public $recursive = -1;

	public $actsAs = array('Containable');

	public function bind($model = array('Group')){

		$this->bindModel(array(
			'hasMany' => array(
				'ContactPerson' => array(
					'className' => 'ContactPerson',
					'foreignKey' => 'type',
					'dependent' => false,
					'conditions' => '',
					'fields' => '',
					'order' => '',
					'limit' => '',
					'offset' => '',
					'exclusive' => '',
					'finderQuery' => '',
					'counterQuery' => ''
				),
				'Address' => array(
					'className' => 'Address',
					'foreignKey' => 'type',
					'dependent' => false,
					'conditions' => '',
					'fields' => '',
					'order' => '',
					'limit' => '',
					'offset' => '',
					'exclusive' => '',
					'finderQuery' => '',
					'counterQuery' => ''
				),
				'Contact' => array(
					'className' => 'Address',
					'foreignKey' => 'type',
					'dependent' => false,
					'conditions' => '',
					'fields' => '',
					'order' => '',
					'limit' => '',
					'offset' => '',
					'exclusive' => '',
					'finderQuery' => '',
					'counterQuery' => ''
				),
				'Email' => array(
					'className' => 'Address',
					'foreignKey' => 'type',
					'dependent' => false,
					'conditions' => '',
					'fields' => '',
					'order' => '',
					'limit' => '',
					'offset' => '',
					'exclusive' => '',
					'finderQuery' => '',
					'counterQuery' => ''
				)
			)
		));

		$this->contain($model);
	}
	
}
