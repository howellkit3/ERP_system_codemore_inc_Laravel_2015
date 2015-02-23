<?php
App::uses('AppModel', 'Model');
//namespace Sales\Model\Entity;
/**
 * Supllier Model
 *
 */
class Product extends AppModel {

    public $useDbConfig = 'koufu_purchasing';

    public $name = 'Product';

	public $recursive = -1;

	public $actsAs = array('Containable');

	public function bind($model = array('Supplier')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Supllier' => array(
					'className' => 'Purchasings.Supplier',
					'foreignKey' => 'supplier_id',
					'dependent' => true
				),
			)
		));

		$this->contain($model);
	}


} ?>