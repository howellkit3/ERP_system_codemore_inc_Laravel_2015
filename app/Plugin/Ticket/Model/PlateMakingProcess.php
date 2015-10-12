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
            'hasOne' => array(
                'Machine' => array(
                    'className' => 'Machine',
                    'foreignKey' => false,
                    'conditions' => 'Machine.id = PlateMakingProcess.machine'
                )
            )
            
        ));

        $this->contain($model);
    }


    public function getProcess($data = array()){

     $process = $this->PlateMakingProcess->find('first',array(
                    'conditions' => array(
                            'PlateMakingProcess.job_ticket_id' =>  $data['pro'],
                            'PlateMakingProcess.process_id' => $processId,
                            'PlateMakingProcess.product' => $product
                    )
                ));

     return $process;

    }
    

}