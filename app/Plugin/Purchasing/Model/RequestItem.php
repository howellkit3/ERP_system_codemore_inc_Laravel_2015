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

	public function saveRequestItem($requestData = null,$requestUuid = null)
	{
		//pr($requestData); exit;
	
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
	 //pr($priceData); exit;
		foreach ($priceData['RequestItem'] as $key => $priceDataValue)
		{
			$this->create();
			
			$this->save($priceDataValue);
		}

		return true;
	}


}
