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

	public function saveQuotationField($data = null, $quotaionId= null, $auth = nnull){


		$this->create();
		foreach ($data[$this->name] as $key => $customFieldValue) 
		{	
			// foreach ($data['MultipleField'] as $multiple => $multipleFieldValue){
			// 	$customFieldValue['description'] = $multipleFieldValue['Qty']['description'];
			// 	$customFieldValue['custom_fields_id'] = $multipleFieldValue['Qty']['custom_fields_id'];

			// 	$customFieldValue['description'] = $multipleFieldValue['Uprice']['description'];
			// 	$customFieldValue['custom_fields_id'] = $multipleFieldValue['Uprice']['custom_fields_id'];

			// 	$customFieldValue['description'] = $multipleFieldValue['Vat']['description'];
			// 	$customFieldValue['custom_fields_id'] = $multipleFieldValue['Vat']['custom_fields_id'];

			// 	$customFieldValue['description'] = $multipleFieldValue['Mat']['description'];
			// 	$customFieldValue['custom_fields_id'] = $multipleFieldValue['Mat']['custom_fields_id'];

			// }
	
			$customFieldValue['quotation_id'] = $quotaionId;
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
	public function editFields($data = null, $quotationId = null){
		
		$this->id = $this->find('all',array( 
								'conditions' => array(
								'quotation_id' => $quotationId
								)));
		
		if ($this->id) {
			foreach ($data[$this->name] as $key => $customFieldValue) 
			{
				$this->save($customFieldValue);
			}
		}
		return $this->id;
	}
	
}
