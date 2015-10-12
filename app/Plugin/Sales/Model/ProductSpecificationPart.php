<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');

class ProductSpecificationPart extends AppModel {
	public $useDbConfig = 'koufu_sale';
    public $name = 'ProductSpecificationPart';
    public $recursive = -1;
    public $actsAs = array('Containable');
    public $useTable = 'product_specification_parts';
    
    public function bind($model = array('Group')){

		$this->bindModel(array(
			
			'hasMany' => array(
				'ProductSpecificationDetail' => array(
				'className' => 'Sales.ProductSpecificationDetail',
				'foreignKey' => 'foreign_key',
				'dependent' => true
				)
			),
			'belongsTo' => array(

				'ProductSpecification' => array(
					'className' => 'Sales.ProductSpecification',
					'foreignKey' => 'product_specification_id',
					'dependent' => true
				)

			)

		));

		$this->contain($model);
	}

	public function savePart($partdata = null , $auth = null,$specId = null){
		$Ids = array();
			
			if (!empty($partdata[$this->name])) {

				foreach ($partdata[$this->name] as $key => $partList) {
					
					$this->create();
					$partList['created_by'] = $auth;
					$partList['modified_by'] = $auth;
					$partList['product_specification_id'] = $specId;
					$partList['product_id'] = $partdata['Product'];
					
					$this->save($partList);
					if (!empty($partList['order'])) {
						array_push($Ids, $this->id.'-'.$partList['order'].'-'.'Part');
					}
					
				}

		}

		return $Ids;

	}

	public function deleteData($partData = null){

		if (!empty($partData['ProductSpecificationPart']) && is_array($partData['ProductSpecificationPart'])) {
			
			foreach ($partData['ProductSpecificationPart'] as $key => $deleteMe) {

				if (is_array($deleteMe)) {

					foreach ($deleteMe as $key => $innerDelete) {
						$this->delete($innerDelete);
					}

				} else {
					
					$this->delete($deleteMe);
				}
			}
		}
		
	}

}