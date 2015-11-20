<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');

class ProductSpecificationProcessHolder extends AppModel {
	public $useDbConfig = 'koufu_sale';
    public $name = 'ProductSpecificationProcessHolder';
    public $actsAs = array('Containable');
    
    public function bind($model = array('Group')){

		$this->bindModel(array(
			
			'belongsTo' => array(
				
				'ProductSpecificationProcess' => array(
					'className' => 'Sales.ProductSpecificationProcess',
					'foreignKey' => 'product_specification_process_id',
					'dependent' => true
				),
				// 'TicketProcessSchedule' => array(
				// 	'className' => 'Production.TicketProcessSchedule',
				// 	'foreignKey' => false,
				// 	'conditions' => 'TicketProcessSchedule.product_specification_process_holder_id = ProductSpecificationProcessHolder.id'
					
				// ),
				
			)
		));

		$this->contain($model);
	}

	public function saveProcessHolder($processData = null,$processSpecId = null,$auth = null ){

		
		foreach ($processData['ProductSpecificationProcess'] as $key => $processList) {
			
			unset($processList['order']);
			
			foreach ($processList as $key => $list) {
				//$this->create();
				$processSplit = split('-', $list);
				$processId = $processSplit[1];
				$subProcessId = $processSplit[0];

				$processList[$this->name][$key]['product_specification_process_id'] = $processSpecId;
				$processList[$this->name][$key]['created_by'] = $auth;
				$processList[$this->name][$key]['modified_by'] = $auth;
				$processList[$this->name][$key]['process_id'] = $processId;
				$processList[$this->name][$key]['sub_process_id'] = $subProcessId;
				$processList[$this->name][$key]['order'] = $key;
				$processList[$this->name][$key]['id'] = '';
				//$this->save($processList[$this->name][$key]);
			}
			
		}

		
		return $processList[$this->name][$key];
	}

	public function deleteData($processData = null){
		

		if (!empty($processData['ProcessHolder'] )) {

			foreach ($processData['ProcessHolder'] as $key => $deleteMe) {
				$this->delete($deleteMe);
			}

		}

	}


}