<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class Quotation extends AppModel {

    public $useDbConfig = 'koufu_sale';
	
	public $recursive = -1;

	public $name = 'Quotation';

	public $actsAs = array('Containable');

	public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Inquiry' => array(
					'className' => 'Sales.Inquiry',
					'foreignKey' => 'inquiry_id',
					'dependent' => true
				),
				'SalesOrder' => array(
					'className' => 'Sales.SalesOrder',
					'foreignKey' => 'quotation_id',
					'dependent' => true
				),
				'PaymentTermHolder' => array(
					'className' => 'PaymentTermHolder',
					'foreignKey' => 'payment_term',
					'dependent' => false
					),
				'ContactPerson' => array(
					'className' => 'ContactPerson',
					'foreignKey' => false,
					'conditions' => array('ContactPerson.id = Quotation.attention_details'),
					'dependent' => false
					),
				'ContactPersonEmail' =>  array(
					'className' => 'Email',
					'foreignKey' => false,
					'conditions' => array('ContactPersonEmail.foreign_key = ContactPerson.id'),
					'dependent' => false
					),
				
			),
			'hasMany' => array(
				
				'QuotationItemDetail' => array(
					'className' => 'Sales.QuotationItemDetail',
					'foreignKey' => 'quotation_id',
					'dependent' => true
				),
				
				'ClientOrder' => array(
					'className' => 'Sales.ClientOrder',
					'foreignKey' => 'quotation_id',
					'dependent' => true
				),
				
				'QuotationDetailOrder' => array(
					'className' => 'Sales.QuotationDetail',
					'foreignKey' => 'quotation_id',
					'dependent' => true
				),

				'Approver' => array(
					'className' => 'Sales.Approver',
					'foreignKey' => 'foreign_key',
					'dependent' => true
				),


			),
			'hasOne' => array(
				
				'ProductDetail'  => array(
					'className' => 'Sales.Product',
					'foreignKey' => false,
					'conditions' => array('Quotation.item_category_holder_id = ProductDetail.item_category_holder_id'),
					'dependent' => false
				),
				'QuotationDetail' => array(
					'className' => 'Sales.QuotationDetail',
					'foreignKey' => 'quotation_id',
					'dependent' => true
				),
				'Product' => array(
					'className' => 'Sales.Product',
					'foreignKey' => false,
					'conditions' => array('QuotationDetail.product_id = Product.id'),
					'dependent' => false
				),
				'Company' => array(
					'className' => 'Sales.Company',
					'foreignKey' => false,
					'conditions' => array('Quotation.company_id = Company.id'),
					'dependent' => false
				)
			 )
			
		));

		$this->contain($model);
	}


	public function afterSave($data,$options = array() ) {

		Cache::clear();	
	}
	public function afterDelete() {

		Cache::clear();
	}


	public $validate = array(

		// 'name' => array(
		// 	'notEmpty' => array(
		// 		'rule' => array('notEmpty'),
		// 		'message' => 'Required fields.',
				
		// 	),
		// ),

		'item_type_holder_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
				
			),
		),

		'item_type_holder_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
				
			),
		),

		// 'attention_details' => array(
		// 	'notEmpty' => array(
		// 		'rule' => array('notEmpty'),
		// 		'message' => 'Required fields.',
				
		// 	),
		// ),

		'company_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
				
			),
		),

	);

	//new function for saving quotation 
	public function addQuotation($quotationData = null,$auth){
	
	    $month = date("m"); 
	    $year = date("y");
	    $hour = date("H");
	    $minute = date("i");
	    $seconds = date("s");
	    $random = rand(1000, 10000);
	        
		$code =  $year. $month .$random;


									
		$this->create();
			
		$quotationData['Quotation']['created_by'] = $auth;
		$quotationData['Quotation']['modified_by'] = $auth;
		$quotationData['Quotation']['status'] = !empty($quotationData['Quotation']['status'])? $quotationData['Quotation']['status'] : 0 ;
		
		if (empty($quotationData['Quotation']['id'])) {

			$quotationData['Quotation']['uuid'] = $code;

		}

	//	$quotationData['Quotation']['validity'] = $quotationData['Quotation']['validity_field'];
		
		$this->save($quotationData);

		return $this->id;

	}

	public function QuotationDetail($data, $quotationId, $userId)
	{

		pr($data); exit;	
			
		
		//$this->saveAll($data);
		
	
	}

	public function saveInquiry($data,$auth)
	{
			
		$this->create();
		
		$data['Inquiry']['company_id'] = $data['Company']['id'];
		$data['Inquiry']['created_by'] = $auth;
		$data['Inquiry']['modified_by'] = $auth;	
			
		
		$this->saveAll($data);
		return $this->id;
	
	}

	public function addInquiryQuotation($data, $auth,$inquiryId){


		$this->create();
		$data['product_id'] = $data['product'];
		$data['inquiry_id'] = $inquiryId;	
		$data['created_by'] = $auth;
		$data['modified_by'] = $auth;
		$data['status'] = 1;
		
		$data['unique_id'] = "PQ".'-'.time();
		
		$this->save($data);

		return $this->id;

	}

		public function addNewInquiryQuotation($inquiryData, $inquiryAuth,$newInquiryId){


		$this->create();
		$data['product_id'] = $inquiryData;
		$data['inquiry_id'] = $newInquiryId;	
		$data['created_by'] = $inquiryAuth;
		$data['modified_by'] = $inquiryAuth;
		$data['status'] = 1;
		
		$data['unique_id'] = "PQ".'-'.time();
		
		$this->save($data);

		return $this->id;

	}

	public function addCompanyQuotation($data, $auth,$companyId){
		

		$this->create();
		$data['product_id'] = $data['product'];
		$data['company_id'] = $companyId;	
		$data['created_by'] = $auth;
		$data['modified_by'] = $auth;
		$data['status'] = 1;
		
		$data['unique_id'] = "PQ".'-'.time();
		
		$this->save($data);
		
		return $this->id;		

	}

	public function addNewCompanyQuotation($newData, $newAuth, $newCompanyId){
		

		$this->create();
		$data['product_id'] = $newData;
		$data['company_id'] = $newCompanyId[0];	
		$data['created_by'] = $newAuth;
		$data['modified_by'] = $newAuth;
		$data['status'] = 1;
		
		$data['unique_id'] = "PQ".'-'.time();
		
		$this->save($data);
		
		return $this->id;		

	}

	public function approvedData($quotationId = null, $userId = null, $modified = null){
		
		$this->id = $this->find('first',array('conditions' => array('Quotation.id' => $quotationId)));
				
		if ($this->id) {
		    $this->saveField('status', 1);
		    $this->saveField('modified_by', $userId);
		    $this->saveField('modified', $modified);
		}
	}

	public function terminateData($quotationId = null, $userId = null, $modified = null){
		
		$this->id = $this->find('first',array('conditions' => array('Quotation.id' => $quotationId)));
				
		if ($this->id) {
		    $this->saveField('status', 'Terminated');
		    $this->saveField('modified_by', $userId);
		    $this->saveField('modified', $modified);
		}
	}

	public function edit($data, $quotationId = null){
		$this->id = $this->find('first',array('conditions' => array('Quotation.id' => $quotationId)));
		if ($this->id) {

		    $this->bind(array('QuotationField'));
		    $this->QuotationField->editFields($data,$quotationId);
		   

		}
	}
	public function searchFilter($params=null){
		$keyword = $params['keyword'];
		

		if ( !empty($params) ){
			
				$condHome = array();
			
			$cond=array( $condHome,
						'AND'=>array(array("Quotation.unique_id LIKE '%$keyword%'") ));    
		} 

		return $cond;
	}

	public function updateStatus($id = null ,$quotationId = null){

		$this->id = $this->find('first',array('conditions' => array('Quotation.id' => $quotationId)));

		if ($this->id) {
		    $this->saveField('status', $id);
		}else{
			echo "string";exit();
		}
		
		return $this->id;
	}
	
}
