<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class RequestDeliverySchedule extends AppModel {

	public $useDbConfig = 'koufu_sale';
    public $name = 'RequestDeliverySchedule';

    public function addRequest($data,$auth){
		//pr($data);exit();
		$this->create();
		$data['RequestDeliverySchedule']['status'] = 'Pending';
		$data['RequestDeliverySchedule']['created_by'] = $auth;
		$data['RequestDeliverySchedule']['modified_by'] = $auth;
		$this->save($data);

		return $this->id;
		

	}

	public function updateRequest($data,$auth){

	
		$this->id = $this->find('first',array(
								'conditions' => array(
								'sales_order_id' => $data['TruckSchedules']['sales_order_id']
									)
								));
		if ($this->id) {
			    $this->save( array(
			    			'status' =>'Accepted',
		     				
		    				));

		 }

		return $this->id;

	}
}