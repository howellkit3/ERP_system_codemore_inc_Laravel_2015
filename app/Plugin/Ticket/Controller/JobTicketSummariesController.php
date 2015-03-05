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
			$companyData = $this->Company->Inquiry->find('first', array(
											'conditions' => array(
												'Inquiry.id' => $ticketDetails['Quotation']['inquiry_id']
												)
											));
		}	

		else{

			$this->Company->bind(array('Address','Contact','Email'));
			$companyName = $this->Company->find('first', array(
													'conditions' => array(
														'id' => $ticketDetails['Quotation']['company_id'])
											));
		}

		//pr($companyName);die;

		$this->loadModel('Sales.CustomField');
		$customField = $this->CustomField->find('list', array('fields' => array('id', 'fieldlabel')));
		
		$this->Quotation->bind(array('Product'));
		$productName = $this->Quotation->find('first', array(
													'conditions' => array(
														'Quotation.id' =>$ticketDetails['Quotation']['id']
														)
													));
		$this->set(compact('companyName','ticketDetails','customField','productName'));

	}

}