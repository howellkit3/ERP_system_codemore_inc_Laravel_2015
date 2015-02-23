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

}