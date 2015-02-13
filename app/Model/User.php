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
			'alphaNumeric'=> array(
	            'rule' => 'alphaNumeric',
	            'message'=> 'Please enter a valid name'
	        ),
		),
		'last_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
			'alphaNumeric'=> array(
	            'rule' => 'alphaNumeric',
	            'message'=> 'Please enter a valid name'
	        ),
		),
		 'password' => array(
            'rule' => array('between', 8, 20),
            'required' => true,
            'allowEmpty' => false,
            'message' => 'Between 8-20 characters'
        ) 	
	
	);

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
