<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class ClientOrderDeliverySchedule extends AppModel {

    public $useDbConfig = 'koufu_sale';
	
	public $recursive = -1;

	public $name = 'ClientOrderDeliverySchedule';

	public $actsAs = array('Containable');

	public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'ClientOrder' => array(
					'className' => 'Sales.ClientOrder',
					'foreignKey' => 'client_order_id',
					'dependent' => true
				),
				
			),
			
		));

		$this->contain($model);
	}

	public function saveClientOrderDeliverySchedule($clientOrderData = null, $auth = null, $clientOrderId = null){
		
		foreach ($clientOrderData[$this->name] as $key => $clientOrderDetails)
		{
			$this->create();
			
			if (!empty($clientOrderData[$this->name])) {
				
				$clientOrderDetails['created_by'] = $auth;
				$clientOrderDetails['modified_by'] = $auth;
				$clientOrderDetails['client_order_id'] = $clientOrderId;
				$this->save($clientOrderDetails);
	
			}
				
		}

	}




	public function saveDelivery($clientOrderData = null, $auth = null){
		
		
			$this->create();
			
				
				$data['created_by'] = $auth;
				$data['modified_by'] = $auth;
					
				$this->save($data);


	}




}
