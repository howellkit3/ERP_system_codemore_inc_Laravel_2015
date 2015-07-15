<?php
App::uses('AppModel', 'Model');
//namespace Sales\Model\Entity;
/**
 * Supllier Model
 *
 */
class PurchasingItem extends AppModel {

    public $useDbConfig = 'koufu_purchasing';

    public $name = 'PurchasingItem';

	public $recursive = -1;

	public $actsAs = array('Containable');

	
public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Request' => array(
					'className' => 'Purchasing.Request',
					'foreignKey' => 'item_group_id',
					'dependent' => true
				),
			),
			
		));

		$this->contain($model);
	}

// public function savePurchasingItem($requestData = null, $auth = null)
// 	{
	
// 		foreach ($requestData as $key => $requestValue)
		
// 				foreach ($requestValue[$this->name] as $key => $contactPersonValue) 
// 				{
// 					$contactPersonValue['id'] = !empty($requestValue[$this->name][$key]['id']) ? $contactPersonData[$this->name][$key]['id'] : '';
// 					$contactPersonValue['model'] = "Company";
// 					$contactPersonValue['company_id'] = $company_id;
				
			
// 				}
				
// 		}

// 		$this->saveAll($contactPersonValue);
// 		return $this->id;
		
	//}

}
