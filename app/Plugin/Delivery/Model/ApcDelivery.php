<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class ApcDelivery extends AppModel {
	public $recursive = -1;
	
	public $actsAs = array('Containable');

    public $useDbConfig = 'koufu_delivery_system';
    
    public $name = 'ApcDelivery';

    public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'ClientOrderDeliverySchedule' => array(
					'className' => 'Sales.ClientOrderDeliverySchedule',
					'foreignKey' => 'delivery_schedule_id',
				),
				'ClientOrder' => array(
					'className' => 'Sales.ClientOrder',
					'foreignKey' => 'client_order_id',
				),
				'Company' => array(
					'className' => 'Sales.Company',
					'foreignKey' => 'company_id',
				),
				'Plant' => array(
					'className' => 'Delivery.Plant',
					'foreignKey' => 'plant_id',
				))
		),false);

		$this->contain($model);
	}


    public function saveData($data) { 

    		$save = array();
    		
    		if (!empty($data['ClientOrderDelivery'])) {

    			if (is_array($data['ClientOrderDelivery'])) {

    				foreach ($data['ClientOrderDelivery'] as $key => $list) {
    					
    					$save[$key]['apc_dr'] = $data['Delivery']['apc_dr'];
    					$save[$key]['plant_id'] = $data['Delivery']['plant_id'];	
    					$save[$key]['company_id'] = $data['Delivery']['company_id'];
    					$save[$key]['tel_num'] = $data['Delivery']['company_id'];
    					$save[$key]['delivery_schedule_id'] = $list['delivery_schedule_id'];
    					$save[$key]['client_order_id'] = $list['client_order_id'];
    				
    				
    				}
    			}
    		}

    		return $save;
    }
}