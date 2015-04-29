<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class PaymentTermHolder extends AppModel {

	public $useDbConfig = 'default';

    public $name = 'PaymentTermHolder';

    public $useTable = 'payment_term_holders';

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
            ),

                'Company' => array(
                    'className' => 'Company',
                    'foreignKey' => 'payment_term',
                    'dependent' => true
                ),
            )
        );

        $this->contain($model);
    }

    public function savePaymentTerm($paymentTermData = null, $auth = null){
        
        $this->create();

        $paymentTermData['created_by'] = $auth;
        $paymentTermData['modified_by'] = $auth;

        if($this->save($paymentTermData)){
            return $this->id;
        }
    } 
}