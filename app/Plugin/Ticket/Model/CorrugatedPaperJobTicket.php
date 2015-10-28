<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class CorrugatedPaperJobTicket extends AppModel {

	public $useDbConfig = 'koufu_ticketing';
    public $actsAs = array('Containable');
    public $name = 'CorrugatedPaperJobTicket';

    public $useTable = 'corrugated_paper_job_tickets';

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

}