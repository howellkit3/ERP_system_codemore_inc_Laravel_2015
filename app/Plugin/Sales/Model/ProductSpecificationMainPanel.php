<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');

class ProductSpecificationMainPanel extends AppModel {

	public $useDbConfig = 'koufu_sale';
    public $name = 'ProductSpecificationMainPanel';
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

	public function saveMainPanel($mainPaneldata = null , $auth = null,$specId = null){
		
		$Ids = array();

		if (!empty($mainPaneldata[$this->name])) {

		
		foreach ($mainPaneldata[$this->name] as $key => $mainPanelList) {
			$this->create();
			
			$mainPanelList['created_by'] = $auth;
			$mainPanelList['modified_by'] = $auth;
			$mainPanelList['product_specification_id'] = $specId;
			$mainPanelList['product_id'] = $mainPaneldata['Product'];
			
			
			$this->save($mainPanelList);

			array_push($Ids, $this->id.'-'.$mainPanelList['order'].'-'.'MainPanel');
		
		}

	}
	return $Ids;

	}

	public function deleteData($mainPaneldata = null){

		if (!empty($mainPaneldata['ProductSpecificationmainPanel'])) {

			foreach ($mainPaneldata['ProductSpecificationmainPanel'] as $key => $deleteMe) {
				$this->delete($deleteMe);
			}
		}
		

	}

}