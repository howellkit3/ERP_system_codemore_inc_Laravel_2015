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
			'belongsTo' => array(
				'Product' => array(
					'className' => 'Purchasing.Product',
					'foreignKey' => 'foreign_key',
					'dependent' => false
				),
			)
		));

		$this->contain($model);
	}

}
