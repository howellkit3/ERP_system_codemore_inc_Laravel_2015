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
				'QuotationField' => array(
					'className' => 'Sales.QuotationField',
					'foreignKey' => 'quotation_id',
					'dependent' => true
				),
			)
		));

		$this->contain($model);
	}

	public $validate = array(

		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				
			),
		),
		'label' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				
			),
		),
		'description' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				
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

		$data['inquiry_id'] = $inquiryId;	
		$data['created_by'] = $auth;
		$data['modified_by'] = $auth;
		$data['status'] = 0;
		
		$this->save($data);

		return $this->id;

	}

	public function addCompanyQuotation($data, $auth,$companyId){

		$this->create();

		$data['company_id'] = $companyId;	
		$data['created_by'] = $auth;
		$data['modified_by'] = $auth;
		$data['status'] = 0;
		
		$this->save($data);
		
		return $this->id;		

	}

	public function approvedData($quotationId = null){
		
		$this->id = $this->find('first',array('conditions' => array('Quotation.id' => $quotationId)));
				
		if ($this->id) {
		    $this->saveField('status', 1);
		}
	}
	
}
