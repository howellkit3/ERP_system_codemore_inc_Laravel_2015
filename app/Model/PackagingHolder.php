<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class PackagingHolder extends AppModel {

	public $useDbConfig = 'default';

    public $name = 'PackagingHolder';

    public $useTable = 'packaging_holders';

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
                'PackagingHolder' => array(
                    'className' => 'PackagingHolder',
                    'foreignKey' => 'packaging_holder_id',
                    'dependent' => true
                ),
            )
        ));

        $this->contain($model);
    }

  /*  public function bindStatus($model = array('Group')){

        $this->bindModel(array(
            
            'belongsTo' => array(
                'StatusFieldHolder' => array(
                    'className' => 'StatusFieldHolder',
                    'foreignKey' => 'id',
                    'dependent' => true
                ),
            )
        ));

        $this->contain($model);
    } */

    public function savePackaging($packagingData = null, $auth = null){
        
        $this->create();

        $packagingData['created_by'] = $auth;
        $packagingData['modified_by'] = $auth;

        if($this->save($packagingData)){
            return $this->id;
        }
    } 
}