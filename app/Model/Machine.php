<?php
App::uses('AppModel', 'Model');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class Machine extends AppModel {

	public $useDbConfig = 'default';

    public $name = 'Machine';

    public $useTable = 'machines';

    public $recursive = -1;
    
	public $actsAs = array('Containable');

      public function bind($model = array('Group')){

        $this->bindModel(array(
            
            'belongsTo' => array(
                'PlateMakingProcess' => array(
                    'className' => 'PlateMakingProcess',
                    'foreignKey' => false,
                    'dependent' => 'PlateMakingProcess.machine = Machine.id'
                ),
            )
        ));

        $this->contain($model);
    } 

    public $validate = array(

        'name' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            ),
        )
    
    );

}