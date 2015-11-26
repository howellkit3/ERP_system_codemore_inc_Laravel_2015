<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class ProductionDashboardsController extends ProductionAppController {
	
	public function index() {

     //   $this->layout = 'test';

		$this->loadModel('Production.TicketProcessSchedule');

            $this->loadModel('Production.ProcessDepartment');

        $this->loadModel('Production.Machine');

        $tickets = $this->TicketProcessSchedule->query("
        SELECT TicketProcessSchedule.id,TicketProcessSchedule.job_ticket_id,TicketProcessSchedule.job_ticket_id,TicketProcessSchedule.production_date,TicketProcessSchedule.department_process_id,TicketProcessSchedule.machine_id,
        RecievedTicket.id,RecievedTicket.job_ticket_id,RecievedTicket.status,RecievedTicket.created,
        JobTicket.id,JobTicket.product_id,JobTicket.client_order_id,JobTicket.po_number,JobTicket.status_production_id,JobTicket.remarks,
        ClientOrder.id,
        Product.id,Product.uuid,Product.company_id,Product.item_category_holder_id,Product.name,
        ClientOrderDeliverySchedule.id,ClientOrderDeliverySchedule.client_order_id,ClientOrderDeliverySchedule.delivery_type,ClientOrderDeliverySchedule.schedule,
        ProductSpecification.id,ProductSpecification.product_id,ProductSpecification.size1,ProductSpecification.size2,ProductSpecification.size3,ProductSpecification.quantity,ProductSpecification.quantity_unit_id,ProductSpecification.stock,
        ProductSpecificationPart.id,ProductSpecificationPart.product_specification_id,
        ProductSpecificationPart.name,ProductSpecificationPart.material,ProductSpecificationPart.part,
        ProductSpecificationPart.rate,ProductSpecificationPart.size1,ProductSpecificationPart.size2,
        ProductSpecificationPart.size2,ProductSpecificationPart.quantity,ProductSpecificationPart.quantity_unit_id,ProductSpecificationPart.paper_quantity,ProductSpecificationPart.color,
        ProductSpecificationPart.outs1,ProductSpecificationPart.outs2,ProductSpecificationPart.allowance
        FROM koufu_production.ticket_process_schedules AS TicketProcessSchedule
        LEFT JOIN koufu_production.recieved_tickets AS RecievedTicket
        ON TicketProcessSchedule.job_ticket_id = RecievedTicket.job_ticket_id
        LEFT JOIN koufu_ticketing.job_tickets AS JobTicket
        ON JobTicket.id = TicketProcessSchedule.job_ticket_id
        LEFT JOIN koufu_sale.client_orders AS ClientOrder
        ON ClientOrder.id = JobTicket.client_order_id
        LEFT OUTER JOIN koufu_sale.client_order_delivery_schedules as ClientOrderDeliverySchedule
        ON (ClientOrderDeliverySchedule.client_order_id = ClientOrder.id)
        LEFT JOIN koufu_sale.products as Product
        ON (Product.id = JobTicket.product_id)
        LEFT JOIN koufu_sale.product_specifications as ProductSpecification
        ON (ProductSpecification.product_id = JobTicket.product_id)
        LEFT JOIN koufu_sale.product_specification_parts as ProductSpecificationPart
        ON (ProductSpecificationPart.product_specification_id = ProductSpecification.id)

        group by TicketProcessSchedule.id
        ");

    

        if (!empty($_GET['test'])) { 

            pr($tickets);
            exit();
        }
        // pr($ticketProcess);
        // exit();

		// $this->loadModel('Production.RecievedTicket');

	

		// // $this->loadModel('Ticket.JobTicket');

		// $this->loadModel('Sales.ClientOrder');

		// $limit = 10;
		
		// $conditions = array();

		// //$this->TicketProcessSchedule->bind(array('JobTicket','RecievedTicket'));

  //       $this->paginate = array(
  //           'conditions' => $conditions,
  //           'limit' => $limit,
  //           //'fields' => array('id', 'status','created'),
  //           //'recursive' => -1,
  //           'order' => 'RecievedTicket.created ASC',
  //               'joins' => array(
  //                   array(
  //                       'table' => 'koufu_sale.client_order_delivery_schedules',
  //                           'alias' => 'ClientOrderDeliverySchedule',
  //                           'type' => 'INNER',
  //                       //     'conditions' => array(
  //                       //     'ClientOrderDeliverySchedule.client_order_id' => 'ClientOrder.id'
  //                       // )
  //                   )
  //               ),
  //           'contain' => array(
  //               'RecievedTicket',
  //               'JobTicket',
  //               'ProductSpecificationProcessHolder',
  //               'ProductSpecificationProcess',
  //               //'ProductSpecificationProcessHolder',
  //               'ClientOrder'
  //           )
  //       );

  //       $tickets = $this->paginate('TicketProcessSchedule');

  //       pr($tickets);
  //       exit();

  //       //get ClientOrder
  //       $tickets = $this->ClientOrder->getClientOrder( $tickets );
       	    
       	$departmentProcess = $this->ProcessDepartment->find('list', array('fields' => array('id', 'name')));

       	$machineData = $this->Machine->find('list',array('fields' => array('id','name')));

      
        if (!empty($_GET['test'])) {
        	pr($tickets);
        	//exit();
        }
        
        $this->set(compact('tickets','departmentProcess','machineData'));

		// $this->set(compact('scheduleData'));
    }

    
}