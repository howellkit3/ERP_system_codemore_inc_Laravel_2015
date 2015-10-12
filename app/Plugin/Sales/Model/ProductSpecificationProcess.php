<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');

class ProductSpecificationProcess extends AppModel {
	public $useDbConfig = 'koufu_sale';
    public $name = 'ProductSpecificationProcess';
    public $recursive = -1;
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
			),
			'belongsTo' => array(

				'ProductSpecification' => array(
					'className' => 'Sales.ProductSpecification',
					'foreignKey' => 'product_specification_id',
					'dependent' => true
				),
				// 'ProductSpecificationProcessHolder' => array(
				// 	'className' => 'Sales.ProductSpecificationProcessHolder',
				// 	'foreignKey' => false,
				// 	'conditions' => array(
				// 		'ProductSpecificationProcessHolder.product_specification_process_id = ProductSpecificationProcess.id',
				// 		),	
				// 	'dependent' => true
				// )

			)

		));

		$this->contain($model);
	}

	public function saveProcess($processdata = null , $auth = null,$specId = null){

		$this->bind(array('Sales.ProductSpecificationProcessHolder'));
		$Ids = array();
		if (!empty($processdata[$this->name])) {

		foreach ($processdata[$this->name] as $key1 => $processList) {
			
			$this->create();

			$processList['created_by'] = $auth;
			$processList['modified_by'] = $auth;
			$processList['product_specification_id'] = $specId;
			$processList['product_id'] = $processdata['Product'];
			
			$this->save($processList);

			if (!empty($processList['order'])) {
				array_push($Ids, $this->id.'-'.$processList['order'].'-'.'Process');
			}
			
			unset($processdata[$this->name][$key1]['order']);
			
			$holder = 'ProductSpecificationProcessHolder';

			foreach ($processdata[$this->name][$key1] as $key => $list) {

				$this->ProductSpecificationProcessHolder->create();
				$split = split('-', $list);
				$processId = $split[1];
				$subProcessId = $split[0];
				$processdata[$holder]['product_specification_process_id'] = $this->id;
				$processdata[$holder]['created_by'] = $auth;
				$processdata[$holder]['modified_by'] = $auth;
				$processdata[$holder]['process_id'] = $processId;
				$processdata[$holder]['sub_process_id'] = $subProcessId;
				$processdata[$holder]['order'] = $key;
				
				$this->ProductSpecificationProcessHolder->save($processdata[$holder]);
				
			}
			
			//$this->ProductSpecificationProcessHolder->saveProcessHolder($processdata,$this->id,$auth);
			
		}
	}
	
	return $Ids;


	}

	public function deleteData($processData = null){

		if (!empty($processData['ProductSpecificationProcess'] )) {

			foreach ($processData['ProductSpecificationProcess'] as $key => $deleteMe) {
				$this->delete($deleteMe);
			}

		}
		

	}
}