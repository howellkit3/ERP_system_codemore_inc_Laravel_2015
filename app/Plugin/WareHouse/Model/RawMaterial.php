<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class RawMaterial extends AppModel {

    public $useDbConfig = 'koufu_ware_house';
    
  	public $name = 'RawMaterial';

	public $recursive = -1;

	public $actsAs = array('Containable');

	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
			),
		),
		'unit_cost' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
			),
		),
		'unit' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
			),
		),
		'qty' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
			),
		),
		'description' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
			),
		),

	);

	public function saveRawMaterial($data, $authId)
	{


		foreach ($data as $key => $rawData)
		{
			$rawData['created_by']	= $authId;
			$rawData['modified_by']	= $authId;		
		}
		$this->saveAll($rawData);
		
	}

}