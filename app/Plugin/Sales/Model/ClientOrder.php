<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class ClientOrder extends AppModel {

    public $useDbConfig = 'koufu_sale';
	
	public $recursive = -1;

	public $name = 'ClientOrder';

	public $actsAs = array('Containable');

	public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Quotation' => array(
					'className' => 'Sales.Quotation',
					'foreignKey' => 'quotation_id',
					'dependent' => true
				),
				'Company' => array(
					'className' => 'Sales.Company',
					'foreignKey' => 'company_id',
					'dependent' => true
				),

				'Sales.PaymentTermHolder' => array(
					'className' => 'PaymentTerms',
					'foreignKey' => 'payment_terms',
					'dependent' => true
				)
			),
			'hasMany' => array(
				
				'ClientOrderDeliverySchedule' => array(
					'className' => 'Sales.ClientOrderDeliverySchedule',
					'foreignKey' => 'client_order_id',
					'dependent' => true
				)

			),
			
		));

		$this->contain($model);
	}

	public function saveClientOrder($clientOrderData = null, $auth = null){
		
		$this->create();

		$clientOrderData['ClientOrder']['client_order_item_details_id'] = $clientOrderData['QuotationItemDetail']['id'];
		$clientOrderData['ClientOrder']['created_by'] = $auth;
		$clientOrderData['ClientOrder']['modified_by'] = $auth;
		$clientOrderData['ClientOrder']['uuid'] = time();
		$clientOrderData['ClientOrder']['company_id'] = $clientOrderData['Company']['id'];
		$clientOrderData['ClientOrder']['quotation_id'] = $clientOrderData['Quotation']['id'];
		
		$this->save($clientOrderData);

		return $this->id;
	}

}
