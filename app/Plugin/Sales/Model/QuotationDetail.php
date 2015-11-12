<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class QuotationDetail extends AppModel {

    public $useDbConfig = 'koufu_sale';
	
	public $recursive = -1;

	public $name = 'QuotationDetail';

	public $actsAs = array('Containable');

	public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Quotation' => array(
					'className' => 'Sales.Quotation',
					'foreignKey' => 'quotation_id',
					'dependent' => true
				),

				'Product' => array(
					'className' => 'Sales.Product',
					'foreignKey' => 'product_id',
					'dependent' => true
				),
			),
					 			
		));

		$this->contain($model);
	}

	//new function for saving quotationDetails
	public function addQuotationDetail($quotationData = null, $auth = null, $quoteId){
		// pr($quotationData);die;
		$this->create();
			
		$quotationData['QuotationDetail']['created_by'] = $auth;
		$quotationData['QuotationDetail']['modified_by'] = $auth;
		$quotationData['QuotationDetail']['quotation_id'] = $quoteId;
		
		$this->save($quotationData);

		return $this->id;

	}

	public function saveEdit($data, $auth, $quoteId){

		$this->create();
		$data['created_by'] = $auth;
		$data['modified_by'] = $auth;
		$data['quotation_id'] = $quoteId;
		//pr($data); exit;
		$this->save($data);

		return $this->id;

	}
	
}
