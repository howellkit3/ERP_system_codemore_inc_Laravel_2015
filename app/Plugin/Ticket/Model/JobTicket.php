<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class JobTicket extends AppModel {

    public $useDbConfig = 'koufu_ticketing';

    public $name = 'JobTicket';

	public $recursive = -1;

	public $actsAs = array('Containable');

	   public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'ClientOrder' => array(
					'className' => 'Sales.ClientOrder',
					'foreignKey' => 'client_order_id',
					//'conditions' => 'JobTicket.client_order_id = ClientOrder.id'
				),				
			
				'ClientOrderDeliverySchedule' => array(
					'className' => 'Sales.ClientOrderDeliverySchedule',
					'foreignKey' => false,
					'conditions' => array('ClientOrderDeliverySchedule.Client_order_id = JobTicket.client_order_id')
					//'conditions' => 'Company.id = Product.company_id'
				), 				
				'Product' => array(
					'className' => 'Sales.Product',
					'foreignKey' => 'product_id',
					//'conditions' => 'Company.id = Product.company_id'
				),
				// 'Company' => array(
				// 	'className' => 'Sales.Company',
				// 	'foreignKey' => false,
				// 	'conditions' => array('Company.id' => 'Product.company_id')
				// )
				// 'Product' => array(
				// 	'className' => 'Sales.Product',
				// 	'foreignKey' => false,
				// 	'conditions' => array('Product.id = JobTicket.product_id'),
				// 	'dependent' => true
				// ),
			),
		'hasMany' => array(
				'TicketProcessSchedule' => array(
					'className' => 'Production.TicketProcessSchedule',
					'foreignKey' => 'job_ticket_id',
					'order' => array('TicketProcessSchedule.order ASC'),
					//'conditions' => 'TicketProcessSchedule.job_ticket_id = JobTicket.id'
				),				

			)
			
		),false);

		$this->contain($model);
	}


	public function bindTicket() {
		$this->bindModel(array(
			'belongsTo' => array(
				'ClientOrder' => array(
					'className' => 'Sales.ClientOrder',
					'foreignKey' => 'client_order_id',
					//'conditions' => 'JobTicket.client_order_id = ClientOrder.id'
				),				
			
			
				// 'Company' => array(
				// 	'className' => 'Sales.Company',
				// 	'foreignKey' => false,
				// 	'conditions' => array('Company.id' => 'Product.company_id')
				// )
				// 'Product' => array(
				// 	'className' => 'Sales.Product',
				// 	'foreignKey' => false,
				// 	'conditions' => array('Product.id = JobTicket.product_id'),
				// 	'dependent' => true
				// ),
			)
			
		));
		$this->recursive = 1;
		//$this->contain($giveMeTheTableRelationship);
	}

	public function bindTicketSchedule(){
			$this->bindModel(array(
			'belongsTo' => array(
				'ClientOrder' => array(
					'className' => 'Sales.ClientOrder',
					'foreignKey' => 'client_order_id',
					//'conditions' => 'JobTicket.client_order_id = ClientOrder.id'
				),
				'ClientOrderDeliverySchedule' => array(
					'className' => 'Sales.ClientOrderDeliverySchedule',
					'foreignKey' => false,
					'conditions' => array('ClientOrderDeliverySchedule.Client_order_id = JobTicket.client_order_id')
					//'conditions' => 'Company.id = Product.company_id'
				), 				
				'Product' => array(
					'className' => 'Sales.Product',
					'foreignKey' => 'product_id',
					//'conditions' => 'Company.id = Product.company_id'
				),
				// 'Company' => array(
				// 	'className' => 'Sales.Company',
				// 	'foreignKey' => false,
				// 	'conditions' => array('Company.id' => 'Product.company_id')
				// )
				// 'Product' => array(
				// 	'className' => 'Sales.Product',
				// 	'foreignKey' => false,
				// 	'conditions' => array('Product.id = JobTicket.product_id'),
				// 	'dependent' => true
				// ),
			)
			
		));
		$this->recursive = 1;
	}

	public function bindJobTicket() {
		$this->bindModel(array(
			'belongsTo' => array(
				'ClientOrder' => array(
					'className' => 'Sales.ClientOrder',
					'foreignKey' => 'client_order_id',
					//'conditions' => 'JobTicket.client_order_id = ClientOrder.id'
				),				
				'Product' => array(
					'className' => 'Sales.Product',
					'foreignKey' => 'product_id',
					//'conditions' => 'Company.id = Product.company_id'
				),
				'ClientOrderDeliverySchedule' => array(
					'className' => 'Sales.ClientOrderDeliverySchedule',
					//'foreignKey' => 'client_order_id',
					'conditions' => 'ClientOrderDeliverySchedule.client_order_id => 11'
				)

			)
			
		));
		$this->recursive = 1;
		//$this->contain($giveMeTheTableRelationship);
	}

	public function bindTicketingSearch() {
		$this->bindModel(array(
			'belongsTo' => array(
				'ClientOrder' => array(
					'className' => 'Sales.ClientOrder',
					'foreignKey' => 'client_order_id',
					//'conditions' => 'JobTicket.client_order_id = ClientOrder.id'
				),				
				'Product' => array(
					'className' => 'Sales.Product',
					'foreignKey' => 'product_id',
					//'conditions' => 'Company.id = Product.company_id'
				)
			

			)
			
		));
		$this->recursive = 1;
		//$this->contain($giveMeTheTableRelationship);
	}

	public function bindTicketJob() {
		$this->bindModel(array(
			'belongsTo' => array(
				'ClientOrder' => array(
					'className' => 'Sales.ClientOrder',
					'foreignKey' => 'client_order_id',
					//'conditions' => 'JobTicket.client_order_id = ClientOrder.id'
				),				
				'Product' => array(
					'className' => 'Sales.Product',
					'foreignKey' => 'product_id',
					//'conditions' => 'Company.id = Product.company_id'
				),
				// 'ClientOrderDeliverySchedule' => array(
				// 	'className' => 'Sales.ClientOrderDeliverySchedule',
				// 	'foreignKey' => false,
				// 	'conditions' => array('ClientOrderDeliverySchedule.client_order_id = client_order_id')
				// )
			)
			
		));
		$this->recursive = 1;
		//$this->contain($giveMeTheTableRelationship);
	}


	public $validate = array(

		'unique_id' => array(
			'unique' => array(
				'rule'    => 'isUnique',
				'message' => 'This Ticket Unique Id has already been taken.'
			)
		),
	
	);

	public function saveUniqueId($uniqueId = null, $auth = null){

		$this->create();

		if($this->save(array('unique_id' =>$uniqueId ,'status' => '0','job_ticket_id' => '1','created_by' =>$auth,'modified_by' =>$auth))){
			
        	return $this->id;

        }
	}

	
	public function updateStatus($ticketId){
		
		$this->id = $this->find('first',array(
			'conditions' => array(
				'Ticket.id' => $ticketId
				)
			));

		if ($this->id) {
		    $this->saveField('status', 1);

		}

		return $this->id;

	}

	public function finishedJob($ticketId){

		$ticketQuery = $this->id = $this->find('first',array(
			'conditions' => array(
				'Ticket.id' => $ticketId
				)
			)); 
		$jobTicketId = $ticketQuery['Ticket']['job_ticket_id'] + 1;
		//pr($jobTicketId);

		if ($this->id) {
			    $this->save(array('status' =>0,
		     				'job_ticket_id' =>$jobTicketId 
		    ));

		 }

		  return $this->id;

	}

	public function saveTicket($clientData = null,$auth = null,$clientOrderId = null){
		
		$month = date("m"); 
        $year = date("y");
        $hour = date("H");
        $minute = date("i");
        $day = date("d");
        $seconds = date("s");
       
        $timestamp = strtotime(date('h:i:s'));  
        $code = $year . $month. substr($timestamp, 4);
        
	    $this->create();

	    $data[$this->name]['uuid'] = $code;
	    $data[$this->name]['product_id'] = $clientData['Product']['id'];
	    $data[$this->name]['client_order_id'] = $clientOrderId;
	    $data[$this->name]['po_number'] = $clientData['ClientOrder']['po_number'];
	    $data[$this->name]['created_by'] = $auth;
	    $data[$this->name]['modified_by'] = $auth;

	    $this->save($data[$this->name]);

	    return $this->id;


	}

}
