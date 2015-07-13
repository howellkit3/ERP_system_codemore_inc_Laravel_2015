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
				//pr($requestData); exit;
				$this->save($requestData);
	
							
		
	}


}
