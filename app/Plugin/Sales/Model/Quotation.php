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
				'CustomField' => array(
					'className' => 'Sales.CustomField',
					'foreignKey' => 'inquiry_id',
					'dependent' => true
				),
			)
		));

		$this->contain($model);
	}

	public $validate = array(

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

	public function addQuotation($data, $auth,$inquiryId){
		
		$this->create();
			foreach ($data as $key => $quotationValue) 
			{
				
				$quotationValue['inquiry_id'] = $inquiryId;	
				$quotationValue['created_by'] = $auth;
				$quotationValue['modified_by'] = $auth;
				
				$this->saveAll($quotationValue);
			}

	}
	
}
