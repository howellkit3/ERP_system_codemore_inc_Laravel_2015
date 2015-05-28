<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');

class ProductSpecificationLabel extends AppModel {

	public $useDbConfig = 'koufu_sale';
    public $name = 'ProductSpecificationLabel';
    public $recursive = -1;
    public $actsAs = array('Containable');
    
    public function bind($model = array('Group')){

		$this->bindModel(array(
			
			// 'hasMany' => array(

			// 	'ProductSpecificationDetail' => array(
			// 		'className' => 'Sales.ProductSpecificationDetail',
			// 		'foreignKey' => 'foreign_key',
			// 		'dependent' => true
			// 	)
			// ),
			'belongsTo' => array(

				// 'ProductSpecificationDetail' => array(
				// 	'className' => 'Sales.ProductSpecificationDetail',
				// 	'foreignKey' => 'foreign_key',
				// 	'dependent' => true
				// )

			)

		));

		$this->contain($model);
	}

	public function saveLabel($labeldata = null , $auth = null,$specId = null){
		
		$Ids = array();
		
		foreach ($labeldata[$this->name] as $key => $labelList) {
			$this->create();
			
			$labelList['created_by'] = $auth;
			$labelList['modified_by'] = $auth;
			$labelList['product_specification_id'] = $specId;
			$labelList['product_id'] = $labeldata['Product']['id'];
			
			$this->save($labelList);
			array_push($Ids, $this->id.'-'.$labelList['order'].'-'.'Label');
		}
		
		return $Ids;

	}

	public function deleteData($labelData = null){

		foreach ($labelData['ProductSpecificationLabel'] as $key => $deleteMe) {
			$this->delete($deleteMe);
		}

	}

}