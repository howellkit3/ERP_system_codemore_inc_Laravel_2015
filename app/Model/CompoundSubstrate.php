<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');

class CompoundSubstrate extends AppModel {

	public $useDbConfig = 'default';

    public $name = 'CompoundSubstrate';

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
					'conditions' => 'ItemGroupLayer.model = "CompoundSubstrate"'
				),
			)
		
		));

		$this->contain($model);
	}

	public function save_substrate($data,$foreignKey = null,$model = null) {

		if (!empty($data)) {

			 $dataHolder = array();


       		 for($groupLayerCount=0; $groupLayerCount < count($data['ItemGroupLayer']['no']); $groupLayerCount++) {

				$this->ItemGroupLayer->create();

				$dataHolder['ItemGroupLayer']['foreign_key'] = $this->id;
				$dataHolder['ItemGroupLayer']['no'] = $data['ItemGroupLayer']['no'][$groupLayerCount];

				$dataHolder['ItemGroupLayer']['substrate'] = $data['ItemGroupLayer']['substrate'][$groupLayerCount];
				
				$dataHolder['ItemGroupLayer']['id']  = '';
				if (is_array($dataHolder['ItemGroupLayer']['substrate'])) {
					//echo "true";
					$dataHolder['ItemGroupLayer']['substrate'] = $data['ItemGroupLayer']['substrate'][$groupLayerCount]['substrate'];
					$dataHolder['ItemGroupLayer']['id'] = !empty($data['ItemGroupLayer']['substrate'][$groupLayerCount]['id']) ? $data['ItemGroupLayer']['substrate'][$groupLayerCount]['id'] : '';
				
				}

				$dataHolder['ItemGroupLayer']['model'] = 'CompoundSubstrate';
				$this->bind('ItemGroupLayer');


				

				if (!empty($data['ItemGroupLayer']['substrate'][$groupLayerCount]['remove']) &&  $data['ItemGroupLayer']['substrate'][$groupLayerCount]['remove'] != 'false') {
					
					$this->ItemGroupLayer->delete($data['ItemGroupLayer']['substrate'][$groupLayerCount]['id']);

				} else {
					
					$this->ItemGroupLayer->save($dataHolder);
				}
				
			}

		}	
	}

	public function saveCompound($compoundData = null ,$auth = null){
		
		$month = date("m"); 
	    $year = date("y");
	    $hour = date("H");
	    $minute = date("i");
	    $seconds = date("s");
	    $random = rand(1000, 10000);

	    $code =  $year. $month .$random;
	    
	    $this->create();

		$compoundData[$this->name]['created_by'] = $auth;
        $compoundData[$this->name]['modified_by'] = $auth;
        $compoundData[$this->name]['uuid'] = $code;
        
        if($this->save($compoundData)){
            return $this->id;
        }
	}

}