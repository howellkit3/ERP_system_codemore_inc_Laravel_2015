<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class QuotationField extends AppModel {

    public $useDbConfig = 'koufu_sale';
	
	public $recursive = -1;

	public $name = 'QuotationField';

	public $actsAs = array('Containable');

	public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'CustomField' => array(
					'className' => 'Sales.CustomField',
					'foreignKey' => 'custom_fields_id',
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

	public function saveQuotationField($data = null,$quotationId= null,$auth = nnull){
			
		$this->create();

		foreach ($data[$this->name] as $key => $customFieldValue) 
		{	
			
			$customFieldValue['custom_fields_id'] = $customFieldValue['label'];
				
			$customFieldValue['quotation_id'] = $quotationId;
			$customFieldValue['created_by'] = $auth;
			$customFieldValue['modified_by'] = $auth;
			$this->saveAll($customFieldValue);
		}
		
		return $this->id;
	
	}

	public function deleteQuoteFields($quotationData = null){

		$fieldsData = $this->find('all',array('conditions' => array('QuotationField.quotation_id' => $quotationData)));
		
		foreach ($fieldsData as $key => $value) {

			$this->delete($value['QuotationField']['id']);

		}	
		
	}
	
}
