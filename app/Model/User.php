<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
/**
 * User Model
 *
 */
class User extends AppModel {

	public $recursive = -1;
	
	public $actsAs = array('Containable');

	public $validate = array(

		'email' => array(
			'email' => array(
				'rule' => array('email'),
			),
			'unique' => array(
				'rule'    => 'isUnique',
				'message' => 'This Email has already been taken.'
			),
		),
		'first_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
			
		),
		'last_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
			
		),
	 	'password' => array(
            'identicalFieldValues' => array( 
				'rule' => array('identicalFieldValues', 'repassword' ), 
				'message' => 'Please re-enter your password twice so that the values match' 
    		), 
            'length' => array(
				'rule' => array('between', 8, 20),
				'message' => 'Between 8-20 characters'
			),

        )
	
	);

	public function bind($model = array('Group')){

		$this->bindModel(array(
			
			'hasOne' => array(
				'Role' => array(
					'className' => 'Role',
					'foreignKey' => 'id',
					'dependent' => true
				),
			), 


		));

		$this->contain($model);
	}

	public $virtualFields = array(
		'fullname' => 'CONCAT(User.last_name,",", User.first_name)'
	);

	public $virtualField = array(
		'fullnameDropdown' => 'CONCAT( User.first_name," ",User.last_name)'
	);
	
	public function identicalFieldValues( $field=array(), $compare_field=null ) { 
        foreach( $field as $key => $value ){ 
            $v1 = $value; 
            $v2 = $this->data[$this->name][ $compare_field ];  
            if($v1 !== $v2) { 
                return FALSE; 
            } else { 
                continue; 
            } 
        } 
        return TRUE; 
    } 

	public function beforeSave($options = array()) {
	    if (isset($this->data[$this->alias]['password'])) {
	        $passwordHasher = new SimplePasswordHasher();
	        $this->data[$this->alias]['password'] = $passwordHasher->hash(
	            $this->data[$this->alias]['password']
	        );
	    }

	    return true;
	}
	// public function AddAction($data = null) {

	// 	$user = ClassRegistry::init('User');
	// 	$passReal = $data['User']['password'];
	// 	$user->save($data); 
	// 	return $this->saveField('password_real', $passReal);

	// }
	
}
