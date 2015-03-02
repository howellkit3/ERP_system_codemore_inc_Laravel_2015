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
    public $actsAs = array('Containable');
    public $name = 'JobTicketSummary';

    public function bind($model = array('Group')){

        $this->bindModel(array(
            'belongsTo' => array(
                'JobTicketDescription' => array(
                    'className' => 'Ticket.JobTicketDescription',
                    'foreignKey' => false,
                    'conditions' => 'JobTicketDescription.id = JobTicketSummary.description_id'
                ),
                'JobTicketDetail' => array(
                    'className' => 'Ticket.JobTicketDetail',
                    'foreignKey' => false,
                    'conditions' => 'JobTicketDetail.id = JobTicketSummary.detail_id'
                )
            )
            
        ));

        $this->contain($model);
    }

	public function addSummaryDescription($detailId, $uniqueId, $descriptionId, $auth){	
       
    	$this->create();
    	$data['JobTicketSummary']['detail_id'] = $detailId['JobTicketDetail']['id'];	
    	$data['JobTicketSummary']['description_id'] = $descriptionId;
    	$data['JobTicketSummary']['value'] = $uniqueId['QuotationField'][$descriptionId + 2]['description'];	
		$data['JobTicketSummary']['created_by'] = $auth;
		$data['JobTicketSummary']['modified_by'] = $auth;

    	$this->save($data);
		
		return $this->id;		
	}

    public function addSummarySchedule($detailId, $content, $descriptionId, $auth){ 
        // pr($detailId);
        // pr($data);
        // exit();
       
        $this->create();

        $data['JobTicketSummary']['detail_id'] = $detailId['JobTicketDetail']['id'];    
        $data['JobTicketSummary']['description_id'] = $descriptionId;
        $data['JobTicketSummary']['value'] = $content;    
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