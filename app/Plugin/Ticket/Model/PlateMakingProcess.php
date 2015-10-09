<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class PlateMakingProcess extends AppModel {

	public $useDbConfig = 'koufu_ticketing';

    public $actsAs = array('Containable');

    public $name = 'PlateMakingProcess';

    public $useTable ='plate_making_process';

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