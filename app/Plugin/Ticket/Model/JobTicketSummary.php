<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class JobTicketSummary extends AppModel {

	public $useDbConfig = 'koufu_ticketing_system';

    public $name = 'JobTicketSummary';



	public function addSummaryDetails($companyName, $uniqueId, $auth){	
    	// pr($companyName);
    	// pr($uniqueId);
    	// exit();

    	$this->create();
    	$data['JobTicketSummary']['unique_id'] = $uniqueId['Quotation']['unique_id'];	
    	$data['JobTicketSummary']['company_name'] = $companyName['Company']['company_name'];	
    	$data['JobTicketSummary']['quantity'] = $uniqueId['QuotationField'][2]['description'];	
    	$data['JobTicketSummary']['unit_price'] = $uniqueId['QuotationField'][3]['description'];
		$data['JobTicketSummary']['created_by'] = $auth;
		$data['JobTicketSummary']['modified_by'] = $auth;

    	$this->save($data);
		
		return $this->id;		
	}

	public function updateSchedule($data, $auth){	
    	// pr($companyName);
    	// pr($uniqueId);
    	// exit();
    	
    	$this->create();
  //   	$data['JobTicketSummary']['unique_id'] = $uniqueId['Quotation']['unique_id'];	
  //   	$data['JobTicketSummary']['company_name'] = $companyName['Company']['company_name'];	
  //   	$data['JobTicketSummary']['quantity'] = $uniqueId['QuotationField'][2]['description'];	
  //   	$data['JobTicketSummary']['unit_price'] = $uniqueId['QuotationField'][3]['description'];
		// $data['JobTicketSummary']['created_by'] = $auth;
		// $data['JobTicketSummary']['modified_by'] = $auth;

    	$this->save($data);
		
		return $this->id;		


	}

}