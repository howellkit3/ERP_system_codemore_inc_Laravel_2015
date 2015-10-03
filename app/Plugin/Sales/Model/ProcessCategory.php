<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');

class ProcessCategory extends AppModel {

	public $useDbConfig = 'koufu_sale';
    public $name = 'ProcessCategory';
    public $actsAs = array('Containable');

    public $usetable = 'process_categories';
    
    public function bind($model = array('Group')){

		$this->bindModel(array(
			
			'belongsTo' => array(
				'Product' => array(
					'className' => 'Sales.Product',
					'foreignKey' => 'product_id',
					'dependent' => true
				),
				'ProductSpecificationDetail' => array(
					'className' => 'Sales.ProductSpecificationDetail',
					'foreignKey' => 'product_id',
					'dependent' => true
				),
				
			),
		));

		$this->contain($model);
	}

	public function saveSpec($specData = null,$auth = null){
		
		$this->create();

		$specData[$this->name]['created_by'] = $auth;
		$specData[$this->name]['modified_by'] = $auth;
		$specData[$this->name]['product_id'] = $specData['Product']['id'];
		$this->save($specData[$this->name]);

		return $this->id;
	}


}