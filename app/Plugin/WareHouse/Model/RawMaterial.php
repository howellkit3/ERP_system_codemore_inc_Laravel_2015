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

    public $useDbConfig = 'koufu_warehouse';
    
  	public $name = 'RawMaterial';

	public $recursive = -1;

	public $actsAs = array('Containable');

	public function bind($model = array('Group')){

	$this->bindModel(array(
		
		'hasMany' => array(
			'PullOut' => array(
				'className' => 'WareHouse.PullOut',
				'foreignKey' => 'raw_material_id',
				'dependent' => true,
				'conditions' => 'PullOut.raw_material_id = "3"',

			),
		)
	));

	// $this->contain($model);
	}

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
			$rawData['status']	= 'in_stock';
		}
		$this->saveAll($rawData);
		
	}

}