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
					'foreignKey' => 'uuid',
					'dependent' => true
				),
			),
			
		));

		$this->contain($model);
	}

	public function savePurchasingItem($requestData = null,$requestUuid = null)
	{
	
		foreach ($requestData['PurchasingItem'] as $key => $requestValue)
		{
			$this->create();

			$requestValue['request_uuid'] = $requestUuid;

			$this->save($requestValue);
		}

		
		return true;
	}

	public function savePurchasingItemPrice($priceData = null)
	
	{
		
		foreach ($priceData['PurchasingItem'] as $key => $priceDataValue)
		{
			$this->create();
			
			$this->save($priceDataValue);
		}

		return true;
	}
}
