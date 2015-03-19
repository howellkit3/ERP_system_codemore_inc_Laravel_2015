<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class QuotationOption extends AppModel {

    public $useDbConfig = 'koufu_sale';

	public $recursive = -1;

	 public $name = 'QuotationOption';

	public $actsAs = array('Containable');

	public function saveQuotationOption($data = null, $quotaionId= null, $auth = null){

		$this->create();
		foreach ($data[$this->name] as $key => $customFieldValue) 
		{	
		
			$customFieldValue['quotation_id'] = $quotaionId;
			$customFieldValue['status'] = "Pending";
			$customFieldValue['created_by'] = $auth;
			$customFieldValue['modified_by'] = $auth;
			$this->saveAll($customFieldValue);
			
			
		}
		return $this->id;
	}
	public function updateOptions($data, $auth){
		
		foreach ($data['QuotationOption'] as $key => $customFieldValue){
			$this->id = $this->find('first',array( 
										'conditions' => array(
											'QuotationOption.id' => $customFieldValue['id'])
									));
			if($this->id){
				$this->saveField('status', "Approved");

			}
		}
		
	}
}