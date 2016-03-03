<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

App::import('Vendor', 'PhpExcelReader', array('file' => 'PhpExcelReader'.DS.'excel_reader2.php'));

class ProductionDashboardsController extends ProductionAppController {
	
	public function index() {

     //   $this->layout = 'test';
    Configure::write('debug',2);
		$this->loadModel('Production.TicketProcessSchedule');

        $this->loadModel('Production.ProcessDepartment');

        $this->loadModel('Production.Machine');

        $this->loadModel('Unit');

        $conditions = '';

        $selectedDate = '';
        
        $data = $this->request->query;

        if (!empty($data['data']['date'])) {

            $date = explode('-', $data['data']['date']);

            $date1 = !empty($date[0]) ? date('Y-m-d',strtotime($date[0])) : '';

            $date2 = !empty($date[1]) ? date('Y-m-d',strtotime($date[1])) : ''; 

            $conditions =  "WHERE ClientOrderDeliverySchedule.schedule BETWEEN '".$date1."' AND '".$date2."' ";

            $selectedDate = $date1.' - '.$date2;
        }

        $tickets = $this->TicketProcessSchedule->query("
        SELECT TicketProcessSchedule.id,TicketProcessSchedule.job_ticket_id,TicketProcessSchedule.job_ticket_id,TicketProcessSchedule.production_date,TicketProcessSchedule.department_process_id,TicketProcessSchedule.machine_id,TicketProcessSchedule.production_date_from,TicketProcessSchedule.production_date_to,
        RecievedTicket.id,RecievedTicket.job_ticket_id,RecievedTicket.status,RecievedTicket.created,
        JobTicket.id,JobTicket.product_id,JobTicket.client_order_id,JobTicket.po_number,JobTicket.status_production_id,JobTicket.remarks,JobTicket.uuid,
        ClientOrder.id,ClientOrder.po_number,ClientOrder.company_id,ClientOrder.quotation_id,ClientOrder.client_order_item_details_id,
        Company.id,Company.company_name,
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
        LEFT JOIN koufu_sale.companies as Company
        ON (Company.id = ClientOrder.company_id)
        ". $conditions ." group by TicketProcessSchedule.id
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

        $unitData = Cache::read('unitData');

        if (!$unitData) {
            
            $unitData = $this->Unit->find('list', array('fields' => array('id', 'unit'),
                                                            'order' => array('Unit.unit' => 'ASC')
                                                            ));
            Cache::write('unitData', $unitData);
        }


        if (!empty($_GET['test'])) {
        	pr($tickets);
        	//exit();
        }
        
        $this->set(compact('tickets','departmentProcess','machineData','selectedDate','unitData'));

		// $this->set(compact('scheduleData'));
    }


    public function export() {
      
      $this->loadModel('Production.TicketProcessSchedule');

      if (!empty($this->request->data)) {

        $conditions = '';

        $data = $this->request->data;

        if (!empty($data['Production']['date'])) {

            $proDate = $data['Production']['date'];

            $date = explode('-',  $proDate);

            $date1 = !empty($date[0]) ? date('Y-m-d',strtotime($date[0])) : '';

            $date2 = !empty($date[1]) ? date('Y-m-d',strtotime($date[1])) : ''; 

            $conditions .=  "WHERE ClientOrderDeliverySchedule.schedule BETWEEN '".$date1."' AND '".$date2."' ";
        }

        $tickets = $this->TicketProcessSchedule->query("
        SELECT TicketProcessSchedule.id,TicketProcessSchedule.job_ticket_id,TicketProcessSchedule.job_ticket_id,TicketProcessSchedule.production_date,TicketProcessSchedule.department_process_id,TicketProcessSchedule.machine_id,TicketProcessSchedule.production_date_from,TicketProcessSchedule.production_date_to,
        RecievedTicket.id,RecievedTicket.job_ticket_id,RecievedTicket.status,RecievedTicket.created,
        JobTicket.id,JobTicket.product_id,JobTicket.client_order_id,JobTicket.po_number,JobTicket.status_production_id,JobTicket.remarks,JobTicket.uuid,
        ClientOrder.id,ClientOrder.po_number,ClientOrder.company_id,ClientOrder.quotation_id,ClientOrder.client_order_item_details_id,
        Company.id,Company.company_name,
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
        LEFT JOIN koufu_sale.companies as Company
        ON (Company.id = ClientOrder.company_id)
        ". $conditions ." group by TicketProcessSchedule.id
        ");


        if (!empty($_GET['test'])) { 

            pr($tickets);
            exit();
        }



      $this->set(compact('tickets'));
      
      $this->render('ProductionDashboards/xls/reports');

      } 
    
    }
    
}