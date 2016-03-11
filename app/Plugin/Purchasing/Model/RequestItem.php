<?php
App::uses('AppModel', 'Model');
//namespace Sales\Model\Entity;
/**
 * Supllier Model
 *
 */
class RequestItem extends AppModel {

    public $useDbConfig = 'koufu_purchasing';

    public $name = 'RequestItem';

	public $recursive = -1;

	public $actsAs = array('Containable');

	
	public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Request' => array(
					'className' => 'Purchasing.Request',
					'foreignKey' => false,
					'conditions' => array('RequestItem.request_uuid' => 'Request.uuid')
				),
			),
	
		));

		$this->contain($model);
	}

	public function bindItem() {
		$this->bindModel(array(
			'hasOne' => array(
				'PurchasingItem' => array(
					'className' => 'Purchasing.PurchasingItem',
					'foreignKey' => false,
					'conditions' => array('RequestItem.model = PurchasingItem.model',
								'RequestItem.foreign_key = PurchasingItem.foreign_key',
								'RequestItem.request_uuid = PurchasingItem.request_uuid')
				),'Request' => array(
					'className' => 'Purchasing.Request',
					'foreignKey' => false,
					'conditions' => array('RequestItem.request_uuid = Request.uuid')
				)
				
			),
		));
		$this->recursive = 1;
	}

	public function bindItemPurchase() {
		$this->bindModel(array(
			'hasOne' => array(
				'PurchasingItem' => array(
					'className' => 'Purchasing.PurchasingItem',
					'foreignKey' => false,
					'conditions' => array('RequestItem.model = PurchasingItem.model',
								'RequestItem.foreign_key = PurchasingItem.foreign_key',
								'RequestItem.request_uuid = PurchasingItem.request_uuid')
				),'Request' => array(
					'className' => 'Purchasing.Request',
					'foreignKey' => false,
					'conditions' => array('RequestItem.request_uuid = Request.uuid')
				),
				'PurchaseOrder' => array(
					'className' => 'Purchasing.PurchaseOrder',
					'foreignKey' => false,
					'conditions' => array('PurchaseOrder.request_id = Request.id')
				),
				
			),
		),false);
		$this->recursive = 1;
	}

	public function saveRequestItem($requestData = null,$requestUuid = null)
	{
		foreach ($requestData['RequestItem'] as $key => $requestValue)
		{
			$this->create();
			$requestValue['request_uuid'] = $requestUuid;
			$this->save($requestValue);
		}

		return true;
	}

	public function saveRequestItemPrice($priceData = null, $filledNum = null)
	{
	 	if(!empty($priceData['RequestItem'])){
			foreach ($priceData['RequestItem'] as $key => $priceDataValue)
			{
				$this->create();
				$priceDataValue['filed_number'] = $filledNum;
				$priceDataValue['status_id'] = 1;
				
				$this->save($priceDataValue);
			}
		}

		return true;
	}


}
