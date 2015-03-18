<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class JobTicketSummariesController extends TicketAppController {

	public function index($id = null){

		$this->loadModel('Sales.Quotation');
		$this->Quotation->bind(array('QuotationField'));
		
		$ticketDetails = $this->Quotation->find('first', array(
													'conditions' => array(
														'unique_id' => $id
														)
													));
	
		$this->loadModel('Sales.Company');
		if(!empty($ticketDetails['Quotation']['inquiry_id'])){

			$this->Company->bind(array('Address','Contact','Email','Inquiry'));
			$inquiry = $this->Company->Inquiry->find('first', array(
															'conditions' => array(
																'Inquiry.id' => $ticketDetails['Quotation']['inquiry_id']
																)
															));
			
			$companyName = $this->Company->find('first', array(
		        									'conditions' => array(
		        										'Company.id' => $inquiry['Inquiry']['company_id'])

		    										));
		  
		}	


		else{

			$this->Company->bind(array('Address','Contact','Email'));
			$companyName = $this->Company->find('first', array(
													'conditions' => array(
														'id' => $ticketDetails['Quotation']['company_id'])
											));
		}

		
		
		$this->loadModel("Sales.CustomField");
		$this->CustomField->bind('QuotationField');
		
		$customField = $this->CustomField->find('all', array(
														'fields' => array(
															'id', 'fieldlabel'),
														
														));
		
		$customValue = $this->CustomField->QuotationField->find('list', array(
																	'fields' =>array(
																		'custom_fields_id','description'),
																	'conditions' => array(
																		'quotation_id' => $ticketDetails['Quotation']['id']

																	)
																));
		
		
		
		$this->Quotation->bind(array('Product'));
		$productName = $this->Quotation->find('first', array(
													'conditions' => array(
														'Quotation.id' =>$ticketDetails['Quotation']['id']
														)
													));
		
		$this->set(compact('companyName','ticketDetails','customField','productName','customValue'));

	}

}