<?php
App::uses('AppModel', 'Model');
//namespace Sales\Model\Entity;
/**
 * Supllier Model
 *
 */
class WarehouseRequestItem extends AppModel {

    public $useDbConfig = 'koufu_warehouse';

    public $name = 'WarehouseRequestItem';

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

	public function saveRequestItem($requestData = null,$id = null)
	{	

		foreach ($requestData['WarehouseRequestItem'] as $key => $requestValue)
		{
		//	pr($requestValue); exit;

			//if(!empty($requestValue['request_id'])){

				$this->create();

				$requestValue['request_id'] = $id;

				$this->save($requestValue);

		//	}	

		} 

		
		return true;
	}

	public function editRequestItem($requestData = null,$id = null)
	{	

		foreach ($requestData['WarehouseRequestItem'] as $key => $requestValue)
		{
			//pr($requestValue); exit;
			if(!empty($requestValue['request_id'])){

				$this->create();

				$requestValue['request_id'] = $id;
				//pr($requestValue); exit;
				$this->save($requestValue);

			}	

		} 

		
		return true;
	}

	public function saveRequestItemPrice($priceData = null)
	{
	
		foreach ($priceData['WarehouseRequestItem'] as $key => $priceDataValue)
		{
			$this->create();
			
			$this->save($priceDataValue);
		}

		return true;
	}


}
