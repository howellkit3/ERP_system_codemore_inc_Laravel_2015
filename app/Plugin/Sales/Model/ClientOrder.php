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
				'QuotationDetail' => array(
					'className' => 'Sales.QuotationDetail',
					'foreignKey' => false,
					'conditions' => array('QuotationDetail.quotation_id = ClientOrder.quotation_id'),
					'dependent' => true
				),

				'QuotationItemDetail' => array(
					'className' => 'Sales.QuotationItemDetail',
					'foreignKey' => false,
					'conditions' => array('QuotationItemDetail.id = ClientOrder.client_order_item_details_id'),
					'dependent' => true
				),
				'Product' => array(
					'className' => 'Sales.Product',
					'foreignKey' => false,
					'conditions' => array('Product.id = QuotationDetail.product_id'),
					'dependent' => true
				),
				'Company' => array(
					'className' => 'Sales.Company',
					'foreignKey' => 'company_id',
					'dependent' => true
				),

				'Sales.PaymentTermHolder' => array(
					'className' => 'PaymentTermHolder',
					'foreignKey' => 'payment_terms',
					'dependent' => true
				),
				'PaymentTermHolder' => array(
					'className' => 'PaymentTermHolder',
					'foreignKey' => 'id',
					'dependent' => true
				),
				'JobTicket' => array(
					'className' => 'Ticket.JobTicket',
					'foreignKey' => false,
					'dependent' => array('JobTicket.id' => 'ClientOrde.job_ticket_id')
				),
			
			),
			'hasMany' => array(
				
				'ClientOrderDeliverySchedule' => array(
					'className' => 'Sales.ClientOrderDeliverySchedule',
					'foreignKey' => 'client_order_id',
					'dependent' => true
				),

				'JobTicket' => array(
					'className' => 'Ticket.JobTicket',
					'foreignKey' => 'client_order_id',
					'dependent' => true
				),
				
			),
			
			
		));

		$this->contain($model);
	}

	public function bindDelivery() {
		$this->bindModel(array(
			'hasOne' => array(
				'ClientOrderDeliverySchedule' => array(
					'className' => 'Sales.ClientOrderDeliverySchedule',
					'foreignKey' => 'client_order_id'
				)
				,				
				'Company' => array(
					'className' => 'Sales.Company',
					'foreignKey' => false,
					'conditions' => 'Company.id = ClientOrder.company_id'
				),

				'QuotationDetail' => array(
					'className' => 'Sales.QuotationDetail',
					'foreignKey' => false,
					'conditions' => 'QuotationDetail.quotation_id = ClientOrder.quotation_id'
				),

				'Product' => array(
					'className' => 'Sales.Product',
					'foreignKey' => false,
					'conditions' => 'Product.id = QuotationDetail.product_id'
				),
			),

		));
		$this->recursive = 1;
		//$this->contain($giveMeTheTableRelationship);
	}

	public function bindClientDelivery() {
		$this->bindModel(array(
			'hasOne' => array(
				'ClientOrderDeliverySchedule' => array(
					'className' => 'Sales.ClientOrderDeliverySchedule',
					'foreignKey' => 'client_order_id'
				)
				,				
				'Company' => array(
					'className' => 'Sales.Company',
					'foreignKey' => false,
					'conditions' => 'Company.id = ClientOrder.company_id'
				),

				'QuotationDetail' => array(
					'className' => 'Sales.QuotationDetail',
					'foreignKey' => false,
					'conditions' => 'QuotationDetail.quotation_id = ClientOrder.quotation_id'
				),

				'Product' => array(
					'className' => 'Sales.Product',
					'foreignKey' => false,
					'conditions' => 'Product.id = QuotationDetail.product_id'
				),
			
				'QuotationItemDetail' => array(
					'className' => 'Sales.QuotationItemDetail',
					'foreignKey' => false,
					'conditions' => 'QuotationItemDetail.id = ClientOrder.client_order_item_details_id'
					
				),

			)
		));
		$this->recursive = 1;
		//$this->contain($giveMeTheTableRelationship);
	}

	public function saveClientOrder($clientOrderData = null, $auth = null){

		$this->create();

		$clientOrderData['ClientOrder']['client_order_item_details_id'] = $clientOrderData['QuotationItemDetail']['id'];
		$clientOrderData['ClientOrder']['created_by'] = $auth;
		$clientOrderData['ClientOrder']['modified_by'] = $auth;
		$clientOrderData['ClientOrder']['company_id'] = $clientOrderData['Company']['id'];
		$clientOrderData['ClientOrder']['quotation_id'] = $clientOrderData['Quotation']['id'];

		
		$this->save($clientOrderData);

		return $this->id;
	}

	public function getClientOrder($tickets = null) {

		if (!empty($tickets)) {


			foreach ($tickets as $key => $list) {

				$tickets[$key]['ClientOrder'] = array();
				$tickets[$key]['ClientOrderDeliverySchedule'] = array();

			$this->bind(array('ClientOrderDeliverySchedule'));
				
				if (!empty($list['JobTicket']['client_order_id'])) {

				
				$conditions = array(
						'ClientOrder.id' => $list['JobTicket']['client_order_id']
					);

				$clientOrder = $this->find('first',array('conditions' => $conditions));

				$tickets[$key]['ClientOrder'] = $clientOrder['ClientOrder'];
				$tickets[$key]['ClientOrderDeliverySchedule'] = !empty($clientOrder['ClientOrderDeliverySchedule']) ? $clientOrder['ClientOrderDeliverySchedule'] : array() ;
				}
			}

			return $tickets;
		}
	}

}
