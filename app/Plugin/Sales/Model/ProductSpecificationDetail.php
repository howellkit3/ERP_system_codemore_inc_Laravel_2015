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
				'ProductSpecificationMainPanel' => array(
					'className' => 'Sales.ProductSpecificationMainPanel',
					'foreignKey' => false,
					'conditions' => array(
						'ProductSpecificationMainPanel.product_specification_id = ProductSpecificationDetail.id'),	
					'dependent' => true
				),
				'ProductSpecificationComponent' => array(
					'className' => 'Sales.ProductSpecificationComponent',
					'foreignKey' => false,
					'conditions' => array(
						'ProductSpecificationComponent.product_specification_id = ProductSpecificationDetail.id'),	
					'dependent' => true
				),
				'ProductSpecificationPart' => array(
					'className' => 'Sales.ProductSpecificationPart',
					'foreignKey' => false,
					'conditions' => array(
						'ProductSpecificationPart.product_specification_id = ProductSpecificationDetail.id',
						),	
					'dependent' => true
				),
				'ProductSpecificationProcess' => array(
					'className' => 'Sales.ProductSpecificationProcess',
					'foreignKey' => false,
					'conditions' => array(
						'ProductSpecificationProcess.product_specification_id = ProductSpecificationDetail.id',
						),	
					'dependent' => true
				)

			),

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

	public function findData($productUuid = null,$specificProcess = null){
		
		$conditions = array('ProductSpecificationDetail.product_id' => $productUuid);	

		if (!empty($specificProcess)) {
			$conditions = array_merge($conditions, array(
					'ProductSpecificationDetail.model' => $specificProcess

			));
		}
		$specsList = $this->find('all',array(
						'conditions' => $conditions,
						'order' => 'ProductSpecificationDetail.order ASC'
						// 'contain' => ''
						));


		$dataArray = array();

		$this->bind(array('Sales.ProductSpecificationMainPanel','Sales.ProductSpecificationComponent','Sales.ProductSpecificationPart','Sales.ProductSpecificationProcess'));
		// $this->ProductSpecificationProcess->bind(array('ProductSpecificationProcessHolder'));

		$processHolder = ClassRegistry::init('Sales.ProductSpecificationProcessHolder');
		// $processData = $this->ProductSpecificationProcessHolder->find('all');
		
		foreach ($specsList as $key => $list) {
			
			$dataArray[$key] = $list;

			switch ($list['ProductSpecificationDetail']['model']) {
				// case 'MainPanel':
				// 	$model = 'ProductSpecificationMainPanel';
				// 	break;
				case 'Component':
					$model = 'ProductSpecificationComponent';
					break;
				case 'Part':
					$model = 'ProductSpecificationPart';
					break;
				case 'Process':
					$model = 'ProductSpecificationProcess';
					break;
			}
			
			if (!empty($model)){
				$data = $this->$model->find('first',
				array('conditions' => array('id' => $list['ProductSpecificationDetail']['foreign_key'])));
				
				$dataArray[$key][$model] = !empty($data[$model]) ? $data[$model] : array();  

				
				if($model == 'ProductSpecificationProcess'){
					
					$processData = $processHolder->find('all',array(
										'conditions' => array(
											'product_specification_process_id' => $dataArray[$key][$model]['id']),
										'order' => 'order ASC'));
					
					$dataArray[$key][$model]['ProcessHolder'] = !empty($processData) ? $processData: array();
					
					
				}
			}
			
		}
		
		return $dataArray;
	}

	public function deleteData($detailData = null){

		foreach ($detailData['ProductSpecificationDetail'] as $key => $deleteMe) {
			$this->delete($deleteMe);
		}

	}


}