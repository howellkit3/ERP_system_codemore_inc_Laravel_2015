<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');

class Product extends AppModel {
	public $useDbConfig = 'koufu_sale';
    public $name = 'Product';
    public $actsAs = array('Containable');
    
    public function bind($model = array('Group')){

		$this->bindModel(array(
			
			'belongsTo' => array(
				
				'Quotation' => array(
					'className' => 'Sales.Quotation',
					'foreignKey' => 'product_id',
					'dependent' => true
				),
				'ProductDetail' => array(
					'className' => 'Sales.ProductDetail',
					'foreignKey' => false,
					'conditions' => array('ProductDetail.item_category_holder_id' => 'Quotation.item_category_holder_id'),
					'dependent' => true
				),
				'Company' => array(
					'className' => 'Sales.Company',
					'foreignKey' => 'company_id',
					'dependent' => true
				),
				'ItemCategoryData' => array( /** DITO KAMI HULING TUMIGIL NI HOWELL */
					'className' => 'Sales.ItemCategory',
					'foreignKey' => 'item_category_holder_id',
					'dependent' => true
				),

				'ItemTypeData' => array(
					'className' => 'Sales.ItemType',
					'foreignKey' => 'item_type_holder_id',
					'dependent' => true
				),
			),

			'hasMany' => array(
				'ProductSpec' => array(
				'className' => 'Sales.ProductSpec',
				'foreignKey' => 'product_id',
				'dependent' => true
				)
			)
		));

		$this->contain($model);
	}

	public $validate = array(

		'uuid' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
			),
			'numeric'=> array(
	            'rule' => 'numeric',
	            'message'=> 'It should be numeric'
	        ),
		),

		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
			),	
		)

	);

	public function addProduct($data,$auth){
		
		$this->create();
		$data['Product']['type_id'] = $data['Product']['item_type'];
		$data['Product']['company_id'] = $data['Product']['companyId'];
		$data['Product']['product_name'] = $data['Product']['productName'];
		$data['Product']['created_by'] = $auth;
		$data['Product']['modified_by'] = $auth;
		$data['Product']['uuid'] = rand(999,999).time();

		$this->save($data);

		return $this->id;
		

	}

	public function addQuotationProduct($data,$auth){
	
		$this->create();
		
		$data['Product']['company_id'] = $data['0'];
		$data['Product']['product_name'] = $data['1'];
		$data['Product']['created_by'] = $auth;
		$data['Product']['modified_by'] = $auth;
		$this->save($data);

		return $this->id;
		

	}
	public function editProduct($data,$auth){
		
		$this->id = $this->find('first',array('conditions' => array('id' => $data['Product']['productId'])));
	
		if ($this->id) {
			
		    $this->saveField('product_name', $data['Product']['productName']);

		    $this->bind(array('ProductSpec'));
	        $this->ProductSpec->editProductSpec($data, $auth);
		  

		}

	}



}