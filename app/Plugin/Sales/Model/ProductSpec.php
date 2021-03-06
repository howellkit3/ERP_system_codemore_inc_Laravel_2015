<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class ProductSpec extends AppModel {
	public $useDbConfig = 'koufu_sale';
    public $name = 'ProductSpec';
    public $actsAs = array('Containable');
    public function bind($model = array('Group')){

		$this->bindModel(array(
			
			'belongsTo' => array(
				'Product' => array(
					'className' => 'Sales.Product',
					'foreignKey' => 'product_id',
					'dependent' => true
				),
			)
		));

		$this->contain($model);
	}

	public function addProductSpec($data, $productId = null ,$auth){
		
		$this->create();

		foreach ($data['QuotationField'] as $key => $customFieldValue) 
		{	

			$customFieldValue['product_id'] = $productId;
			$customFieldValue['created_by'] = $auth;
			$customFieldValue['modified_by'] = $auth;
			$this->saveAll($customFieldValue);
		}
		
		return $this->id;
	
		

	}

	public function editProductSpec($data ,$auth){
		
		$productSpec = $this->find('all', array( 
										'conditions' => array(
											'product_id' => $data['Product']['productId']
										)
									));
		
		if ($productSpec) {
			
			foreach ($data['QuotationField'] as $key => $customFieldValue) 
			{
				$this->save($customFieldValue);
			}
		}
		else{
			$this->create();

			foreach ($data['QuotationField'] as $key => $customFieldValue) 
			{	

				$customFieldValue['product_id'] = $data['Product']['productId'];
				$customFieldValue['created_by'] = $auth;
				$customFieldValue['modified_by'] = $auth;
				$this->saveAll($customFieldValue);
			}

		}
		return $this->id;
	
		

	}
}