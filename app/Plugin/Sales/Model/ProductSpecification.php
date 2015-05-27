<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');

class ProductSpecification extends AppModel {
	public $useDbConfig = 'koufu_sale';
    public $name = 'ProductSpecification';
    public $actsAs = array('Containable');
    
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

			'hasMany' => array(
				'ProductSpec' => array(
					'className' => 'Sales.ProductSpec',
					'foreignKey' => 'product_id',
					'dependent' => true
				),
				'ProductSpecificationLabel' => array(
					'className' => 'Sales.ProductSpecificationLabel',
					'foreignKey' => 'product_specification_id',
					'dependent' => true
				),
				'ProductSpecificationPart' => array(
					'className' => 'Sales.ProductSpecificationPart',
					'foreignKey' => 'product_specification_id',
					'dependent' => true
				),
			)
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