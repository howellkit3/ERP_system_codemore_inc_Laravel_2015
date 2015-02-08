<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class SalesOrder extends AppModel {

    public $useDbConfig = 'koufu_sale';
	
	public $recursive = -1;

	public $name = 'SalesOrder';

	public $actsAs = array('Containable');

	public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Quotation' => array(
					'className' => 'Sales.Quotation',
					'foreignKey' => 'quotation_id',
					'dependent' => true
				),
			)
		));

		$this->contain($model);
	}

	public function approvedData($quotationId = null,$auth){

		$this->create();

		if($this->save(array('quotation_id' =>$quotationId ,
				'status' =>1 ,'created_by' =>$auth,'modified_by' =>$auth))){

        	return $this->id;

        } else {

        	echo "not";exit();

        }
		
	}
	
}
