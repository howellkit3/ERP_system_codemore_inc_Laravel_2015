<?php
App::uses('AppModel', 'Model');
//namespace Sales\Model\Entity;
/**
 * Supllier Model
 *
 */
class Request extends AppModel {

    public $useDbConfig = 'koufu_purchasing';

    public $name = 'Request';

	public $recursive = -1;

	public $actsAs = array('Containable');

 	public function bind($model = array('Group')){

		$this->bindModel(array(

			'hasOne' => array(	
				'PurchasingType' => array(
					'className' => 'Purchasing.PurchasingType',
					'foreignKey' =>  false,
					'conditions' => array('PurchasingType.id = pur_type_id')
				),
			),

			'hasMany' => array(	
				'PurchasingItem' => array(
					'className' => 'Purchasing.PurchasingItem',
					'foreignKey' =>  false,
					'conditions' => array('PurchasingItem.request_uuid' => 'Request.uuid')
				),

				'RequestItem' => array(
					'className' => 'Purchasing.RequestItem',
					'foreignKey' =>  false,
					'conditions' => array('RequestItem.request_uuid' => 'Request.uuid')
				),
			)
			
		));

		$this->contain($model);
	}

	// public function bindRequest() {
	// 	$this->bindModel(array(
	// 		'hasMany' => array(
	// 			'PurchasingItem' => array(
	// 				'className' => 'Purchasing.PurchasingItem',
	// 				'foreignKey' => false,
	// 				'conditions' => 'PurchasingItem.request_uuid = Request.uuid'
	// 			),		
				
	// 		)
	// 	));
	// 	$this->recursive = 1;
	// 	//$this->contain($giveMeTheTableRelationship);
	// }

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
		$requestData['prepared_by'] = $auth;
		$requestData['approved_by'] = $auth;

		$this->save($requestData);

		return $requestData['uuid'];
		
	}
	

}
