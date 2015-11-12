<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');
App::import('Vendor', 'DOMPDF', true, array(), 'dompdf'.DS.'dompdf_config.inc.php', false);

class TicketingSystemsController extends AppController {

	public $uses = array('Ticket.JobTicket');

	//public $helpers = array('Ticket.PhpExcel','Sales.Country','Sales.Status','Cache','Sales.DateFormat');
    public $helpers = array('Ticket.PhpExcel','Ticket.PlateMaking');

}
