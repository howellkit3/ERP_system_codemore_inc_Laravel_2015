<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');

class Substrate extends AppModel {

	public $useDbConfig = 'default';

    public $name = 'Substrate';

    public $recursive = -1;

    public $actsAs = array('Containable');

    public $validate = array(

		
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),

		// 'type_id' => array(
		// 	'notEmpty' => array(
		// 		'rule' => array('notEmpty'),
		// 	),
		// ),

		'category_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		)

	);

	public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Supplier' => array(
					'className' => 'Supplier',
					'foreignKey' => 'manufacturer_id',
					'dependent' => false
				),
				'ItemCategoryHolder' => array( 
					'className' => 'Sales.ItemCategoryHolder',
					'foreignKey' => 'category_id',
					'dependent' => false
				),'ItemTypeHolder' => array(
					'className' => 'Sales.ItemTypeHolder',
					'foreignKey' => 'type_id',
					'dependent' => false
				),

			)
		
		));

		$this->contain($model);
	}

}