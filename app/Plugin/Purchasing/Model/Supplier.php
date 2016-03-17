<?php
App::uses('AppModel', 'Model');
//namespace Sales\Model\Entity;
/**
 * Supllier Model
 *
 */
class Supplier extends AppModel {

    //public $useDbConfig = $default;

    public $name = 'Supplier';

	public $recursive = -1;

	public $actsAs = array('Containable');

	public function bind($model = array('Group')){

		$this->bindModel(array(
			'hasMany' => array(
				'SupplierContactPerson' => array(
					'className' => 'Purchasing.SupplierContactPerson',
					'foreignKey' => 'supplier_id',
					'dependent' => true
				),
				
				'Address' => array(
					'className' => 'Purchasing.Address',
					'foreignKey' => 'foreign_key',
					'conditions' => "model = 'Supplier'",
					'dependent' => true
				),
				'Contact' => array(
					'className' => 'Purchasing.Contact',
					'foreignKey' => 'foreign_key',
					'conditions' => "model = 'Supplier'",
					'dependent' => true
				),
				'Email' => array(
					'className' => 'Purchasing.Email',
					'foreignKey' => 'foreign_key',
					'conditions' => "model = 'Supplier'",
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
				$data['Address'][$key]['model'] = 'Supplier';
				$data['Address'][$key]['created_by'] =$auth;
				$data['Address'][$key]['modified_by'] =$auth;
			}
		}
		if (!empty($data['Contact'])) {
			
			foreach ($data['Contact'] as $key => $value) {
				$data['Contact'][$key] = $value;
				$data['Contact'][$key]['model'] = 'Supplier';
				$data['Contact'][$key]['created_by'] =$auth;
				$data['Contact'][$key]['modified_by'] =$auth;
			}

		}
		if (!empty($data['Email'])) {
			foreach ($data['Email'] as $key => $value) {
				$data['Email'][$key] = $value;
				$data['Email'][$key]['model'] = 'Supplier';
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

	public function updateModelField ( $field = null,$value = null,$id = null) {

		if (!empty($id) && !empty($field) && !empty($value)) {
			$this->id = $id;
			$this->saveField($field,$value);
		}

	}

}