<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');

class ProductSpecificationComponent extends AppModel {

	public $useDbConfig = 'koufu_sale';
    public $name = 'ProductSpecificationComponent';
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

	public function saveComponent($componentdata = null , $auth = null,$specId = null){
		
		$Ids = array();
		
		foreach ($componentdata[$this->name] as $key => $componentList) {
			$this->create();
			
			$componentList['created_by'] = $auth;
			$componentList['modified_by'] = $auth;
			$componentList['product_specification_id'] = $specId;
			$componentList['product_id'] = $componentdata['Product']['id'];
			
			$this->save($componentList);
			if (!empty($componentList['order'])) {

				array_push($Ids, $this->id.'-'.$componentList['order'].'-'.'Component');
			}
		}
		
		return $Ids;

	}

	public function deleteData($componentData = null){

		foreach ($componentData['ProductSpecificationComponent'] as $key => $deleteMe) {
			$this->delete($deleteMe);
		}

	}

}