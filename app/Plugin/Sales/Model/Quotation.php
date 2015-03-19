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
				)

			),
			'hasMany' => array(
				'QuotationField' => array(
					'className' => 'Sales.QuotationField',
					'foreignKey' => 'quotation_id',
					'dependent' => true
				),
				'QuotationOption' => array(
					'className' => 'Sales.QuotationOption',
					'foreignKey' => 'quotation_id',
					'dependent' => true
				)

			),
			'hasOne' => array(
				'Product' => array(
					'className' => 'Sales.Product',
					'foreignKey' => false,
					'conditions' => 'Product.id = Quotation.product_id'
				)
			 )
			
		));

		$this->contain($model);
	}

	public $validate = array(

		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
				
			),
		),

		'description' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
				
			),
		),

	);

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

	public function approvedData($quotationId = null){
		
		$this->id = $this->find('first',array('conditions' => array('Quotation.id' => $quotationId)));
				
		if ($this->id) {
		    $this->saveField('status', 1);
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
