<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class Approver extends AppModel {

	public $useDbConfig = 'koufu_sale';

    public $name = 'Approver';

    public $recursive = -1;

    public $actsAs = array('Containable');

    public function bind($model = array('Group')){

		$this->bindModel(array(
			
			'belongsTo' => array(
				'Quotation' => array(
					'className' => 'Quotation',
					'foreignKey' => 'foreign_key',
					'dependent' => true
				),
			)
		));

		$this->contain($model);
	}
	
	public function approverData($quotationId = null, $auth = null){

		$this->create();
			$approverData['Approver']['model'] = 'Quotation';
			$approverData['Approver']['foreign_key'] = $quotationId;
			$approverData['Approver']['user_id'] = $auth;
			$approverData['Approver']['created_by'] = $auth;
			$approverData['Approver']['modified_by'] = $auth;
			$approverData['Approver']['is_approved'] = 1;
		
    	if($this->save($approverData)){
    		return $this->id;
    	}
	} 
}