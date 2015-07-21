<?php
App::uses('AppModel', 'Model');
//namespace Sales\Model\Entity;
/**
 * Supllier Model
 *
 */
class PurchaseOrder extends AppModel {

    public $useDbConfig = 'koufu_purchasing';

    public $name = 'PurchaseOrder';

	public $recursive = -1;

	public $actsAs = array('Containable');

 	public function bind($model = array('Group')){

		$this->bindModel(array(
			
			'belongsTo' => array(	
				'Request' => array(
					'className' => 'Purchasing.Request',
					'foreignKey' =>  'request_id',
					//'conditions' => array('PurchasingItem.request_uuid = request_uuid')
				),
			)
			
		));

		$this->contain($model);
	}

	public function savePurchaseOrder($purchaseOrderData = null, $auth = null){

		$month = date("m"); 

		$year = date("y");

		$hour = date("H");

		$minute = date("i");

		$seconds = date("s");

		$random = rand(1000, 10000);

		$code =  $year. $month .$random;

		$this->create();

		$purchaseOrderData[$this->name]['uuid'] = $code;
		$purchaseOrderData[$this->name]['created_by'] = $auth;
		$purchaseOrderData[$this->name]['modified_by'] = $auth;
		
		$this->save($purchaseOrderData);

		return $this->id;
		
	}
	

}
