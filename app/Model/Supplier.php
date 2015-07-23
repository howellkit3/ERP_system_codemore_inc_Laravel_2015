<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class Supplier extends AppModel {

	public $useDbConfig = 'default';

    public $name = 'Supplier';

    public $recursive = -1;

    public $actsAs = array('Containable');

    public $validate = array(

		
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		)
	
	);

     public function bind($model = array('Group')){

		// $this->bindModel(array(
			
		// 	'hasMany' => array(
		// 		'ItemTypeHolder' => array(
		// 			'className' => 'ItemTypeHolder',
		// 			'foreignKey' => 'item_category_holder_id',
		// 			'dependent' => true
		// 		),
		// 	),

		// 	'hasOne' => array(
		// 		'GeneralItem' => array(
		// 			'className' => 'GeneralItem',
		// 			'foreignKey' => 'item_category_holder_id',
		// 			'dependent' => true
		// 		),
		// 	),


		// ));

		// $this->contain($model);
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

	public function saveSupplier($supplierData = null, $auth = null){
		
		$this->create();

        $supplierData['created_by'] = $auth;
        $supplierData['modified_by'] = $auth;

    	if($this->save($supplierData)){
    		return $this->id;
    	}
	} 

}