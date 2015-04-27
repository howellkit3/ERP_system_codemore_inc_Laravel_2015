<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class SubProcess extends AppModel {

	public $useDbConfig = 'default';

    public $name = 'SubProcess';
    
    public $useTable = 'sub_processes';

    public $recursive = -1;
    
	public $actsAs = array('Containable');

    public $validate = array(

        'name' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            ),
        )
    );

    public function bind($model = array('Group')){

        $this->bindModel(array(
            
            'belongsTo' => array(
                'Process' => array(
                    'className' => 'Process',
                    'foreignKey' => 'process_id',
                    'dependent' => true
                ),
            )
        ));

        $this->contain($model);
    } 

}