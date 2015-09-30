<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class ClientOrderDeliverySchedule extends AppModel {

    public $useDbConfig = 'koufu_sale';
	
	public $recursive = -1;

	public $name = 'ClientOrderDeliverySchedule';

	public $actsAs = array('Containable');

	public $validate = array(

		'schedule' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
				
			),
		),

		'location' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
				
			),
		),

		'quantity' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Required fields.',
				
			),
		),

	);

	public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'ClientOrder' => array(
					'className' => 'Sales.ClientOrder',
					'foreignKey' => 'client_order_id',
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
					'conditions' => array('QuotationItemDetail.quotation_id = ClientOrder.quotation_id'),
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
				
				// 'hasOne' => array(

				// 	'JobTicket' => array(
				// 		'className' => 'Ticket.JobTicket',
				// 		'foreignKey' => false,
				// 		'conditions' => array('JobTicket.client_order_id = ClientOrderDeliverySchedule.client_order_id'),
				// 		'dependent' => true
				// 	),
				// ),

			),
			
		));

		$this->contain($model);
	}

	public function saveClientOrderDeliverySchedule($clientOrderData = null, $auth = null, $clientOrderId = null){

		foreach ($clientOrderData[$this->name] as $key => $clientOrderDetails)
		{
			$month = date("m"); 
		    $year = date("y");
		    $hour = date("H");
		    $minute = date("i");
		    $seconds = date("s");
		    $random = rand(1000, 10000);
	        
		$code =  $year. $month .$random;

			$this->create();
			
			if (!empty($clientOrderData[$this->name])) {
				
				//$clientOrderDetails['delivery_type'] = 'Once';
				$clientOrderDetails['uuid'] = $code;
				$clientOrderDetails['created_by'] = $auth;
				$clientOrderDetails['modified_by'] = $auth;
				$clientOrderDetails['client_order_id'] = $clientOrderId;
				$this->save($clientOrderDetails);
	
			}				
		}
	}

	public function saveDelivery($clientOrderData = null, $auth = null){
		
		
			$this->create();
			
				
				$data['created_by'] = $auth;
				$data['modified_by'] = $auth;
					
				$this->save($data);


	}




}
