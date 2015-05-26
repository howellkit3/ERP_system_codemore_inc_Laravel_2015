<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');

class ProductSpecificationProcess extends AppModel {
	public $useDbConfig = 'koufu_sale';
    public $name = 'ProductSpecificationProcess';
    public $actsAs = array('Containable');
    
    public function bind($model = array('Group')){

		$this->bindModel(array(
			
			'hasMany' => array(
				'ProductSpecificationDetail' => array(
				'className' => 'Sales.ProductSpecificationDetail',
				'foreignKey' => 'foreign_key',
				'dependent' => true
				),
				'ProductSpecificationProcessHolder' => array(
				'className' => 'Sales.ProductSpecificationProcessHolder',
				'foreignKey' => 'product_specification_process_id',
				'dependent' => true
				)
			)

		));

		$this->contain($model);
	}

	public function saveProcess($processdata = null , $auth = null,$specId = null){

		$this->bind(array('Sales.ProductSpecificationProcessHolder'));
		$Ids = array();
		
		foreach ($processdata[$this->name] as $key => $processList) {
			$this->create();

			$processList['created_by'] = $auth;
			$processList['modified_by'] = $auth;
			$processList['product_specification_id'] = $specId;
			$processList['product_id'] = $processdata['Product']['id'];
			$this->save($processList);

			array_push($Ids, $this->id.'-'.$processList['order'].'-'.'Process');
			
			$this->ProductSpecificationProcessHolder->saveProcessHolder($processdata,$this->id,$auth);
			
			
			
		}
		
		return $Ids;

	}

}