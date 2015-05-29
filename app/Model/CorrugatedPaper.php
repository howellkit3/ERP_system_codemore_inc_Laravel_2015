<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');

class CorrugatedPaper extends AppModel {

	public $useDbConfig = 'default';

    public $name = 'CorrugatedPaper';

    public $recursive = -1;

    public $actsAs = array('Containable');

    public $validate = array(

		
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),

		'type_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),

		'category_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),

		'layers' => array(
			'Numeric'=> array(
	            'rule' => 'Numeric',
	            'message'=> 'Please enter a number of layer'
	        ),
	        	'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),

	);

	public function bind($model = array('ItemCategoryHolder')){

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

			),
			'hasMany' => array(
				'ItemGroupLayer' => array(
					'className' => 'ItemGroupLayer',
					'foreignKey' => 'foreign_key',
					'conditions' => 'ItemGroupLayer.model = "CorrugatedPaper"'
				),
			)
		
		));

		$this->contain($model);
	}

	public function saveCorrugated($corrugatedData = null, $auth = null){

		$month = date("m"); 
	    $year = date("y");
	    $hour = date("H");
	    $minute = date("i");
	    $seconds = date("s");
	    $random = rand(1000, 10000);

	    $code =  $year. $month .$random;
	    
	    $this->create();

		$corrugatedData[$this->name]['created_by'] = $auth;
        $corrugatedData[$this->name]['modified_by'] = $auth;
        $corrugatedData[$this->name]['uuid'] = $code;
        
        if($this->save($corrugatedData)){
            return $this->id;
        }
	}

}