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
			
			'hasMany' => array(
				'PurchasingItem' => array(
					'className' => 'Purchasing.PurchasingItem',
					'foreignKey' => 'item_group_id',
					'dependent' => true
				),
			)
			
		));

		$this->contain($model);
	}

public function bindRequest() {
	$this->bindModel(array(
		'hasOne' => array(
			'PurchasingItem' => array(
				'className' => 'Purchasing.PurchasingItem',
				'foreignKey' => false,
				'conditions' => 'Request.uuid = PurchasingItem.item_group_uuid'
			),		
			

		)
	));
	$this->recursive = 1;
	//$this->contain($giveMeTheTableRelationship);
}

public function saveRequest($requestData = null, $auth = null){

			

			$this->create();

				$requestData['status_id'] = 8;
				$requestData['prepared_by'] = $auth;
				$requestData['approved_by'] = $auth;
				$this->save($requestData);
		
	}


}
