<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');

class ProductSpecificationDetail extends AppModel {
	public $useDbConfig = 'koufu_sale';
    public $name = 'ProductSpecificationDetail';
    public $actsAs = array('Containable');
    
    public function bind($model = array('Group')){

		$this->bindModel(array(
			
			'belongsTo' => array(
				
				'Product' => array(
					'className' => 'Sales.Product',
					'foreignKey' => 'product_id',
					'dependent' => true
				),

				'ProductSpecificationLabel' => array(
					'className' => 'Sales.ProductSpecificationLabel',
					'foreignKey' => 'foreign_key',
					'dependent' => true
				),

				'ProductSpecificationPart' => array(
					'className' => 'Sales.ProductSpecificationPart',
					'foreignKey' => 'foreign_key',
					'dependent' => true
				),

				'ProductSpecificationProcess' => array(
					'className' => 'Sales.ProductSpecificationProcess',
					'foreignKey' => 'foreign_key',
					'dependent' => true
				),
				
			)

		));

		$this->contain($model);
	}

	public function saveSpecDetail($saveArray = null, $auth = null, $productuuid = null){
		

		foreach ($saveArray as $key => $arrayList) {
			
			$this->create();
			$arrayList[$this->name]['created_by'] = $auth;
			$arrayList[$this->name]['modified_by'] = $auth;
			$arrayList[$this->name]['product_id'] = $productuuid;
			
			$this->save($arrayList);
			// array_push($Ids, $this->id);
		}
		return $this->id;
	}


}