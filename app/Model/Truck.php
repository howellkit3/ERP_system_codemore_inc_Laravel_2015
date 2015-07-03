<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class Truck extends AppModel {

	public $useDbConfig = 'default';

    public $name = 'Truck';

    public $recursive = -1;
    
	public $actsAs = array('Containable');

    public $validate = array(

        'truck_no' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            ),
        )    
    );

    // public function bind($model = array('Group')){

    //     $this->bindModel(array(
            
    //         'belongsTo' => array(
    //             'PackagingHolder' => array(
    //                 'className' => 'PackagingHolder',
    //                 'foreignKey' => 'packaging_holder_id',
    //                 'dependent' => true
    //             ),
    //         )
    //     ));

    //     $this->contain($model);
    // }

    public function saveTruck($truckData = null, $auth = null){
       
        $this->create();

        $truckData[$this->name]['created_by'] = $auth;
        $truckData[$this->name]['modified_by'] = $auth;
       
        if($this->save($truckData)){
            return $this->id;
        }
    }

}