<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class JobTicketDetail extends AppModel {

	public $useDbConfig = 'koufu_ticketing_system';

    public $name = 'JobTicketDetail';

    public function bind($model = array('Group')){

        $this->bindModel(array(
            
            'belongsTo' => array(
                'JobTicketSummary' => array(
                    'className' => 'Ticket.JobTicketSummary',
                    'foreignKey' => false,
                    'conditions' => 'JobTicketDetail.id = JobTicketSummary.detail_id'
                )
            )
        ));

        $this->contain($model);
    }



	public function addJobDetails($companyName, $uniqueId, $auth){	
		// pr($uniqueId['Quotation']['unique_id']);
		// pr($companyName['Company']['company_name']);die;
		$this->create();
    	$data['JobTicketDetail']['unique_id'] = $uniqueId['Quotation']['unique_id'];	
    	$data['JobTicketDetail']['company_name'] = $companyName['Company']['company_name'];	
		$data['JobTicketDetail']['created_by'] = $auth;
		$data['JobTicketDetail']['modified_by'] = $auth;

    	$this->save($data);
		
		return $this->id;

	}
}