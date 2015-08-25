<?php
App::uses('AppModel', 'Model');
//namespace Sales\Model\Entity;
/**
 * Supllier Model
 *
 */
class RequestItem extends AppModel {

    public $useDbConfig = 'koufu_warehouse';

    public $name = 'RequestItem';

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

	public function saveRequestItemPrice($priceData = null)
	{
	
		foreach ($priceData['RequestItem'] as $key => $priceDataValue)
		{
			$this->create();
			
			$this->save($priceDataValue);
		}

		return true;
	}


}
