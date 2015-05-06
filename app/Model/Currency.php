<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class Currency extends AppModel {

	public $useDbConfig = 'default';

    public $name = 'Currency';

    public $recursive = -1;
    
	public $actsAs = array('Containable');

    public $validate = array(

        'name' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            ),
        )    
    );

     public function saveCurrency($currencyData = null, $auth = null){
        
        $this->create();

        $currencyData['created_by'] = $auth;
        $currencyData['modified_by'] = $auth;

        if($this->save($currencyData)){
            return $this->id;
        }
    }

    public function getList($conditions = array(),$fields = array('id','name')) {

        return $this->find('list',array(
            'conditions' => $conditions,
            'fields'    => $fields
            ));
    }


}