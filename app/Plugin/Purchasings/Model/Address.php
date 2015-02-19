<?php
App::uses('AppModel', 'Model');
//namespace Sales\Model\Entity;
/**
 * Supllier Model
 *
 */
class Address extends AppModel {

    public $useDbConfig = 'koufu_purchasing';

    public $name = 'Address';

	public $recursive = -1;

	public $actsAs = array('Containable');

	public function bind($model = array('Product')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Supplier' => array(
					'className' => 'Purchasings.Supplier',
					'foreignKey' => 'foreign_key',
					'dependent' => true
				),
			)
		));

		$this->contain($model);
	}



	public function formatData($data = null,$auth= null){

			foreach ($data['Address'] as $key => $value) {
				$data['Address'][$key] = $value;
				$data['Address'][$key]['model'] = 'Company';
				$data['Address'][$key]['created_by'] =$auth;
				$data['Address'][$key]['modified_by'] =$auth;
			}

			foreach ($data['Contact'] as $key => $value) {
				$data['Contact'][$key] = $value;
				$data['Contact'][$key]['model'] = 'Company';
				$data['Contact'][$key]['created_by'] =$auth;
				$data['Contact'][$key]['modified_by'] =$auth;
			}

			foreach ($data['Email'] as $key => $value) {
				$data['Email'][$key] = $value;
				$data['Email'][$key]['model'] = 'Company';
				$data['Email'][$key]['created_by'] =$auth;
				$data['Email'][$key]['modified_by'] =$auth;
			}


			return $data;
		}

}
