<?php
App::uses('AppModel', 'Model');
//namespace Sales\Model\Entity;
/**
 * Supllier Model
 *
 */
class WarehouseRequest extends AppModel {

    public $useDbConfig = 'koufu_warehouse';

    public $name = 'WarehouseRequest';

	public $recursive = -1;

	public $actsAs = array('Containable');

 	public function bind($model = array('Group')){

		$this->bindModel(array(
	
			'hasMany' => array(	
				'WarehouseRequestItem' => array(
					'className' => 'WareHouse.WarehouseRequestItem',
					'foreignKey' =>  'request_id'
					//'conditions' => array('RequestItem.request_id = 69')
				),

			)
			
		));

		$this->contain($model);
	}


	public function saveRequest($requestData = null, $auth = null){

		$month = date("m"); 

		$year = date("y");

		$hour = date("H");

		$minute = date("i");

		$seconds = date("s");

		$random = rand(1000, 10000);

		$code =  $year. $month .$random;

		$this->create();

		$requestData['uuid'] = $code;
		$requestData['status_id'] = 8;
		$requestData['created_by'] = $auth;
		$requestData['modified_by'] = $auth;

		$this->save($requestData);

		//return $requestData['uuid'];

		return $this->id;
		
	}
	

}
