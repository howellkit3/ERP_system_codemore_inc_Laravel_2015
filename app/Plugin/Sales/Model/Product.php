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
				'ItemCategoryHolder' => array( 
					'className' => 'ItemCategoryHolder',
					'foreignKey' => 'item_category_holder_id',
					'dependent' => true
				),
				'ItemTypeHolder' => array(
					'className' => 'ItemTypeholder',
					'foreignKey' => 'item_type_holder_id',
					'dependent' => true
				),

			
				// 'ClientOrder' => array(
				// 	'className' => 'ClientOrder',
				// 	'foreignKey' => 'item_type_holder_id',
				// 	'dependent' => true
				// ),
			),

			'hasMany' => array(
				
				'ProductSpec' => array(
				'className' => 'Sales.ProductSpec',
				'foreignKey' => 'product_id',
				'dependent' => true
				),
				'ProductSpecification' => array(
				'className' => 'Sales.ProductSpecification',
				'foreignKey' => 'product_id',
				'dependent' => true
				),
				'ProductSpecificationDetail' => array(
				'className' => 'Sales.ProductSpecificationDetail',
				'foreignKey' => 'product_id',
				'dependent' => true
				)
			)
		));

		$this->contain($model);
	}

	public function bindProduct() {
		$this->bindModel(array(
			'hasOne' => array(

				// 'ItemCategoryHolder' => array( 
				// 	'className' => 'ItemCategoryHolder',
				// 	'foreignKey' => false,
				// 	'conditions' => 'Product.item_category_holder_id = ItemCategoryHolder.id'

				// ),

				// 'ItemTypeholder' => array( 
				// 	'className' => 'ItemTypeholder',
				// 	'foreignKey' => false,
				// 	'conditions' => 'Product.item_type_holder_id = ItemTypeholder.id'
				
				// ),

				'Company' => array(
					'className' => 'Sales.Company',
					'foreignKey' => false,
					'conditions' => 'Product.company_id = Company.id'
				),	


				'JobTicket' => array(
					'className' => 'Ticket.JobTicket',
					'foreignKey' => 'product_id',
					//'conditions' => 'Product.id = JobTicket.product_id'
				),		
			)
		));
		$this->recursive = 1;
		//$this->contain($giveMeTheTableRelationship);
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
		
		$month = date("m"); 
	    $year = date("y");
	    $hour = date("H");
	    $minute = date("i");
	    $seconds = date("s");
	    $random = rand(1000, 10000);

	    $code =  $year. $month .$random;
	    
		$this->create();
		$data['Product']['type_id'] = $data['Product']['item_type'];
		$data['Product']['company_id'] = $data['Product']['companyId'];
		$data['Product']['product_name'] = $data['Product']['productName'];
		$data['Product']['created_by'] = $auth;
		$data['Product']['modified_by'] = $auth;
		$data['Product']['uuid'] = $code;

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