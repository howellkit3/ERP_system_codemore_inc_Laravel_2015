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
                'Machine' => array(
                    'className' => 'Machine',
                    'foreignKey' => 'machine',
                    'conditions' => ''
                )
            )
            
        ));

        $this->contain($model);
    }


    public function getProcess($data = array()){


     $this->bind(array('Machine'));

     $process = $this->find('first',array(
                    'conditions' => array(
                            'PlateMakingProcess.job_ticket_id' =>  $data['ticketId'],
                            'PlateMakingProcess.process_id' =>  $data['processID'],
                            'PlateMakingProcess.product' => $data['product']
                    )
                ));

     return $process;

    }
    

}