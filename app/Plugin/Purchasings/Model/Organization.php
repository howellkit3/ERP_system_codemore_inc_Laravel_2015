<?php
App::uses('AppModel', 'Model');
//namespace Sales\Model\Entity;
/**
 * Supllier Model
 *
 */
class Organization extends AppModel {

    public $useDbConfig = 'koufu_purchasing';

    public $name = 'Organization';

	public $recursive = -1;

	public $actsAs = array('Containable');

	public function bind($model = array('Product')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Supplier' => array(
					'className' => 'Purchasings.Supplier',
					'foreignKey' => 'supplier_id',
					'dependent' => true
				),
			)
		));

		$this->contain($model);
	}

}
