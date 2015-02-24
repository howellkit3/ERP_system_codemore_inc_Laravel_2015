<?php
App::uses('AppModel', 'Model');
//namespace Sales\Model\Entity;
/**
 * Supllier Model
 *
 */
class Supplier extends AppModel {

    public $useDbConfig = 'koufu_purchasing';

    public $name = 'Supplier';

	public $recursive = -1;

	public $actsAs = array('Containable');

	public function bind($model = array('Product')){

		$this->bindModel(array(
			'hasMany' => array(
				'Address' => array(
					'className' => 'Purchasings.Address',
					'foreignKey' => 'foreign_key',
					'dependent' => true
				),
				'Product' => array(
					'className' => 'Purchasings.Product',
					'foreignKey' => 'supplier_id',
					'dependent' => true
				),
				'Permit' => array(
					'className' => 'Purchasings.Permit',
					'foreignKey' => 'supplier_id',
					'dependent' => true
				),
				'Email' => array(
					'className' => 'Purchasings.Email',
					'foreignKey' => 'foreign_key',
					'conditions' => "model = 'Supplier'",
					'dependent' => true
				),
			),
			'hasOne' => array(
				'Organization'  => array (
					'className' => 'Purchasings.Organization',
					'foreignKey'=> 'supplier_id',
					'dependent' => true
					)	
				)
		),false);

		$this->contain($model);
	}

	public function formatData($data = null,$auth = null){
			
			if (!empty($data['Address'])) {
				
				foreach ($data['Address'] as $key => $value) {
					$data['Address'][$key] = $value;
					$data['Address'][$key]['model'] = 'Supllier';
					$data['Address'][$key]['created_by'] =$auth;
					$data['Address'][$key]['modified_by'] =$auth;
				}
			}
			if (!empty($data['Contact'])) {
				
				foreach ($data['Contact'] as $key => $value) {
					$data['Contact'][$key] = $value;
					$data['Contact'][$key]['model'] = 'Supllier';
					$data['Contact'][$key]['created_by'] =$auth;
					$data['Contact'][$key]['modified_by'] =$auth;
				}

			}
			if (!empty($data['Email'])) {
				foreach ($data['Email'] as $key => $value) {
					$data['Email'][$key] = $value;
					$data['Email'][$key]['model'] = 'Supllier';
					$data['Email'][$key]['created_by'] =$auth;
					$data['Email'][$key]['modified_by'] =$auth;
				}
			}

			if (!empty($data['Organization'])) {

				if (!empty($data['Organization']['type_other'])) {
					$data['Organization']['type'] = $data['Organization']['type_other'];
				}
				if (!empty($data['Organization']['operation_type_other'])) {
					$data['Organization']['operation_type'] = $data['Organization']['operation_type_other'];
				}

			}


			return $data;
		}

}
