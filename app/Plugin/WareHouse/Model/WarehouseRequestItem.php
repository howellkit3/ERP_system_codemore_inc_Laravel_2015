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

		//pr($requestData); exit; 
	
		foreach ($requestData['WarehouseRequestItem'] as $key => $requestValue)
		{
			$this->create();

			$requestValue['request_id'] = $id;

			$this->save($requestValue);
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
