<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses('CakeNumber', 'Utility');
require_once('Mandrill.php');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {
	
	public $components = array("RequestHandler", "Paypal");

	public $uses = array('User', 'Message', 'Enrolment','Payment','Price','EnrolmentSetting');
    
    public function dashboard() {
    	if($this->Auth->user('User.type') =='Student' || $this->Auth->user('User.type') =='Tutor') {
			$this->redirect(array('controller'=> $this->Auth->user('User.type'). 's', 'action'=>'dashboard'));
		}
		if($this->Auth->user('User.type') =='Admin' || $this->Auth->user('User.type') =='SuperAdmin') {
			$this->redirect(array('controller'=> $this->Auth->user('User.type'). 's', 'action'=>'dashboard'));
		}
	}

	private function checkIfLogin(){
	    if ($this->Session->check('UserDataHolder')) {
			$this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
	    }
	}
	
	public function beforeFilter() {
	    $this->Auth->allow(array('login', 'register'));
	    parent::beforeFilter();
	}
/** 
 * index method
 *
 * @return void
 */
	public function index() {
		switch($this->Auth->user('User.type'))
		{
		    case "SuperAdmin":
			$this->redirect(array('controller' => 'admins', 'action' => 'dashboard'));
			break;
		    case "Admin":
			$this->redirect(array('controller' => 'admins', 'action' => 'dashboard'));
			break;
			case "Tutor":
			$this->redirect(array('controller' => 'tutors', 'action' => 'dashboard'));
			break;
		    case "Family":
			$this->redirect(array('controller' => 'families', 'action' => 'dashboard'));
			break;
		    case "Student":
		    if ($this->Session->read('UserDataHolder.User.type') == 'Student' && $this->Session->read('UserDataHolder.User.filled_up_form') != 1) {
				$this->redirect(array('controller' => 'users', 'action' => 'registration'));
			}
			else {
				$this->redirect(array('controller' => 'students', 'action' => 'dashboard'));
			}
			break;
		}
		$this->redirect(array('action' => 'login'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {

		$this->layout = "default";

		if($id == null){
			$id = $this->Auth->user('User.id');
		}
		if ($id == $this->Auth->user('User.id')){
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if($this->request->data['password'] == ''){
				unset($this->request->data['password']);
			} else {
				$this->request->data['password'] = $this->Auth->password($this->request->data['password']);
			}
			
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('The user has been saved','success');
				$this->redirect(array('action' => 'edit'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$userinfo = $this->User->findById($id);
		$this->set('userinfo', $userinfo);
	}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	public function login() {
	    $this->checkIfLogin();
	    $this->layout = 'login';
	    if ($this->request->is('post'))
	    {
			$userData = $this->User->find('first', array(
			    'conditions' => array(
				'email' => trim($this->request->data['User']['email']),
				// 'username' => trim($this->request->data['User']['email']),
				'password' => $this->Auth->password($this->request->data['User']['password'])
			    )
			));
			if (!empty($userData))
			{
			    if($this->Auth->login($userData))
			    {
				$this->User->updateLastLogin($userData['User']['id']);
				
				unset($userData['User']['password']);
				unset($userData['User']['default_password']);
				unset($userData['User']['puncrypt']);
				$this->Session->write('UserDataHolder', $userData);
				$this->redirect(array('action' => 'index'));
			    }
			}
			else
			{
			    $this->Session->setFlash('Invalid username or password', 'error');
			}
	    }

	}
	
	public function logout() {
		$this->layout = 'default';
	    if($this->Session->delete('UserDataHolder'))
	    {
			$this->redirect($this->Auth->logout());
	    }
	    
	}
	
	public function register() {
		$this->layout = 'default';
	    $this->checkIfLogin();
	    $this->layout = 'login';
	    if ($this->request->is('post'))
	    {
			$this->User->set($this->request->data['User']);
			if ($this->User->validates())
			{
			    $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
			    $this->request->data['User']['type'] = 'Student';
			    $this->User->create();
			    if ($this->User->save($this->request->data['User'], array('validate' => FALSE)))
			    {
				unset($this->request->data);
			    }
			}
			else
			{
			    unset($this->request->data['User']['password']);
			    unset($this->request->data['User']['confirm_password']);
			    unset($this->request->data['User']['email']);
			    $this->Session->setFlash('Please check all the fields', 'error');
			}
		
	    }
	}
	
	public function registration($id = null) {
		$this->layout = 'default';
		if ($this->Session->read('UserDataHolder.User.type') == 'Student') {
			if ($this->Session->read('UserDataHolder.User.filled_up_form') != 1) {
				$this->set('registration_title', 'Registration Completion');
			}
			else {
				$this->set('registration_title', 'User Information');
			}
			$id = $this->Session->read('UserDataHolder.User.id');
		}
	    
	    if ($this->request->is('post'))
	    {
	    
		$this->User->set($this->request->data['User']);
		

		if ($this->User->validates())
		{

			$existedemail = $this->User->find('first', array('conditions'=>array('User.email' => $this->request->data['User']['email'])));
			
			if(!empty($existedemail) && $this->Session->read('UserDataHolder.User.type') == 'Student'){
				if($existedemail['User']['email'] != $this->Session->read('UserDataHolder.User.email') ) {
				$this->Session->setFlash('Email Already Exists', 'error');
				$this->redirect(array('action' => 'registration'));
				}
			}
			else{
				if(!empty($existedemail)) {
				$this->Session->setFlash('Email Already Exists', 'error');
				$this->redirect(array('action' => 'registration'));
				}
			}
		

			$userinfo = $this->User->find('first', array('conditions' => array('id' => $id)));
			if(isset($userinfo['User'])){
				if($this->request->data['User']['password'] == $userinfo['User']['password']){
					unset($this->request->data['User']['password']);
				} else {
			    	$this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
			    }
		    } else {
		    	$this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
		    }
		    $this->request->data['User']['type'] = 'Student';
		    $this->request->data['User']['filled_up_form'] = 1;
		    $this->User->create();
		    if ($this->Session->read('UserDataHolder.User.type') == 'Admin') {

		    	$ifexist = $this->User->find('first',array('conditions'=>array('User.id'=>$id)));
		    	if(isset($ifexist['User'])){
		    		$this->set('registration_title','Session Registration');
    				$this->User->id = $id;
    			    if ($this->User->save($this->request->data['User'], array('validate' => FALSE))) {
    			    	ClassRegistry::init('Payment')->updateAll(
    					    array('payment_status' => "'outstanding'"),
    					    array('Payment.user_id' => $id)
    					);
    					unset($this->request->data);
    					$this->Session->setFlash('User successfully updated', 'success');
    					$this->redirect(array('controller' => 'users', 'action' => 'enrol',$id));
    			    }
		    	}
		    	$this->set('registration_title','Session Registration');
		    	$this->User->create();
			    if ($this->User->save($this->request->data['User'], array('validate' => FALSE))) {
					$this->Session->setFlash('User has been saved', 'success');
					$this->redirect('/users/enrol/'.$this->User->id);
			    }
		    } else {
		    	$this->set('registration_title','User Information');
		    	$userid = $this->Session->read('UserDataHolder.User.id');
				$this->User->id = $userid;
			    if ($this->User->save($this->request->data['User'], array('validate' => FALSE))) {
			    	ClassRegistry::init('Payment')->updateAll(
					    array('payment_status' => "'outstanding'"),
					    array('Payment.user_id' => $userid)
					);
					unset($this->request->data);
					$this->Session->setFlash('Your data has been saved', 'success');
					$this->redirect(array('controller' => 'users', 'action' => 'enrol'));
			    }
		    }
		}





		else
		{
			if($id){
				$user = $this->User->find('first', array('conditions' => array('id' => $id)));
				$this->set('user', $user);
			}
		    unset($this->request->data['User']['password']);
		    unset($this->request->data['User']['confirm_password']);
		    unset($this->request->data['User']['email']);
		    $this->Session->setFlash('Please check all the fields', 'error');
		}
		
	    } else {
	    	if($id){
	    		$user = $this->User->find('first', array('conditions' => array('id' => $id)));
	    		$this->set('user', $user);
	    		$this->set('userid', $id);
	    	}
	    }
	}
// 		if($this->Auth->user('User.type') =='Tutor') {
// 		$this->redirect(array('controller'=> $this->Auth->user('User.type'). 's', 'action'=>'dashboard'));
// 		}
// 		$this->layout = 'default';
// 		if ($this->Session->read('UserDataHolder.User.type') == 'Student') {
// 			if ($this->Session->read('UserDataHolder.User.filled_up_form') != 1) {
// 				$this->set('registration_title', 'Registration Completion');
// 			}
// 			else {
// 				$this->set('registration_title', 'User Information');
// 			}
// 			$id = $this->Session->read('UserDataHolder.User.id');
// 		}
	    
// 	    if ($this->request->is('post'))
// 	    {
	    
// 		$this->User->set($this->request->data['User']);
// 		if ($this->User->validates())
// 		{
// 			// $existedemail = $this->User->find('count', array('conditions'=>array('User.email' => $this->request->data['User']['email'])));
// 			// if($existedemail == 1) {
// 			// 	$this->Session->setFlash('Email Already Existed', 'error');
// 			// 	$this->redirect(array('action' => 'registration'));
// 			// }

// 			$userinfo = $this->User->find('first', array('conditions' => array('id' => $id)));
// 			if(isset($userinfo['User'])){
// 				if($this->request->data['User']['password'] == $userinfo['User']['password']){
// 					unset($this->request->data['User']['password']);
// 				} else {
// 			    	$this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
// 			    }
// 		    } else {
// 		    	$this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
// 		    }
// 		    $this->request->data['User']['type'] = 'Student';
// 		    $this->request->data['User']['filled_up_form'] = 1;
// 		    $this->User->create();
// 		    if ($this->Session->read('UserDataHolder.User.type') == 'Admin') {

// 		    	$ifexist = $this->User->find('first',array('conditions'=>array('User.id'=>$id)));
// 		    	if(isset($ifexist['User'])){
// 		    		$this->set('registration_title','Session Registration');
//     				$this->User->id = $id;
//     			    if ($this->User->save($this->request->data['User'], array('validate' => FALSE))) {
//     			    	ClassRegistry::init('Payment')->updateAll(
//     					    array('payment_status' => "'outstanding'"),
//     					    array('Payment.user_id' => $id)
//     					);
//     					unset($this->request->data);
//     					$this->Session->setFlash('User successfully updated', 'success');
//     					$this->redirect(array('controller' => 'users', 'action' => 'enrol',$id));
//     			    }
// 		    	}
// 		    	$this->set('registration_title','Session Registration');
// 		    	$this->User->create();
// 			    if ($this->User->save($this->request->data['User'], array('validate' => FALSE))) {
// /*			    	$this->request->data['Payment']['user_id'] = $this->User->id;
// 			    	$this->request->data['Payment']['payment_status'] = 'outstanding';
// 		    		ClassRegistry::init('Payment')->save($this->request->data);
// 					unset($this->request->data);*/
// 					$this->Session->setFlash('User has been saved', 'success');
// 					$this->redirect('/users/enrol/'.$this->User->id);
// 			    }
// 		    } else {
// 		    	$this->set('registration_title','User Information');
// 		    	$userid = $this->Session->read('UserDataHolder.User.id');
// 				$this->User->id = $userid;
// 			    if ($this->User->save($this->request->data['User'], array('validate' => FALSE))) {
// 			    	ClassRegistry::init('Payment')->updateAll(
// 					    array('payment_status' => "'outstanding'"),
// 					    array('Payment.user_id' => $userid)
// 					);
// 					unset($this->request->data);
// 					$this->Session->setFlash('Your data has been saved', 'success');
// 					$this->redirect(array('controller' => 'users', 'action' => 'enrol'));
// 			    }
// 		    }
// 		}
// 		else
// 		{
// 			if($id){
// 				$user = $this->User->find('first', array('conditions' => array('id' => $id)));
// 				$this->set('user', $user);
// 			}
// 		    unset($this->request->data['User']['password']);
// 		    unset($this->request->data['User']['confirm_password']);
// 		    unset($this->request->data['User']['email']);
// 		    $this->Session->setFlash('Please check all the fields', 'error');
// 		}
		
// 	    } else {
// 	    	if($id){
// 	    		$user = $this->User->find('first', array('conditions' => array('id' => $id)));
// 	    		$this->set('user', $user);
// 	    		$this->set('userid', $id);
// 	    	}
// 	    }
// 	}

	public function selfregistration() {


		if($this->Auth->user('User.type') =='Tutor') {
			$this->redirect(array('controller'=> $this->Auth->user('User.type'). 's', 'action'=>'dashboard'));
		}
		$this->layout = 'default';
	    if ($this->request->is('post'))
	    {
		//$this->User->set($this->request->data['User']);
		if ($this->User->validates())
		{
			
			$this->request->data['User']['puncrypt'] = $this->request->data['User']['password'];
		    $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
		    $this->request->data['User']['type'] = 'Student';
		    
		    //print_r($this->request->data); exit();
		    //if ($this->Message->sendStudentDetails($this->request->data)) {
			
		    //}

		    $this->User->create();

		    if ($this->User->save($this->request->data, array('validate' => FALSE)))
		    {

		    	$this->request->data['Payment']['user_id'] = $this->User->id;

		    	ClassRegistry::init('Payment')->save($this->request->data);

				$mandrill = new Mandrill('BGqgZjXSJEaI9RKAqHG-ig');
			    $template_name = 'registration';
			    $template_content = array(
			        array(
			            'name' => 'to',
			            'content' => 'Hi '.$this->request->data['User']['first_name'].', '
			        ),
			        array(
			            'name' => 'email',
			            'content' => '<span>Email:&nbsp;</span> '.$this->request->data['User']['email']
			        ),
			        array(
			            'name' => 'pass',
			            'content' => '<span>Password:&nbsp;</span> '.$this->request->data['User']['confirm_password']
			        )
			    );
			    $message = array(
			        'to' => array(
			            array(
			                'email' => $this->request->data['User']['email']
			            )
		        	)
			    );
			    $async = false;
			    $ip_pool = 'Main Pool';
			    $result = $mandrill->messages->sendTemplate($template_name, $template_content, $message, $async, $ip_pool);

				unset($this->request->data);
				$this->Session->setFlash('New student is added. Email sent!', 'success');
		    }
		}
		else
		{
		    unset($this->request->data['User']['password']);
		    unset($this->request->data['User']['confirm_password']);
		    unset($this->request->data['User']['email']);
		    $this->Session->setFlash('Please check all the fields', 'error');
		}
		
	    }
	
	}

	public function self_registration() {
		$this->layout = 'default';
	    if ($this->request->is('post'))
	    {
		//$this->User->set($this->request->data['User']);
		if ($this->User->validates())
		{
			
			$existedemail = $this->User->find('count', array('conditions'=>array('User.email' => $this->request->data['User']['email'])));
			if($existedemail == 1) {
				$this->Session->setFlash('Email Already Exists', 'error');
				$this->redirect(array('action' => 'self_registration'));
			}
			if($this->request->data['User']['password'] != $this->request->data['User']['confirm_password']){
				$this->Session->setFlash('Confirm Password did not match', 'error');
				$this->redirect(array('action' => 'self_registration'));
			}	

			$this->request->data['User']['puncrypt'] = $this->request->data['User']['password'];
		    $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
		    $this->request->data['User']['type'] = 'Student';
		    
		    //print_r($this->request->data); exit();
		    //if ($this->Message->sendStudentDetails($this->request->data)) {
			
		    //}

		    $this->User->create();

		    if ($this->User->save($this->request->data, array('validate' => FALSE)))
		    {

		    	$this->request->data['Payment']['user_id'] = $this->User->id;

		    	ClassRegistry::init('Payment')->save($this->request->data);

				$mandrill = new Mandrill('BGqgZjXSJEaI9RKAqHG-ig');
			    $template_name = 'registration';
			    $template_content = array(
			        array(
			            'name' => 'to',
			            'content' => 'Hi '.$this->request->data['User']['first_name'].', '
			        ),
			        array(
			            'name' => 'email',
			            'content' => '<span>Email:&nbsp;</span> '.$this->request->data['User']['email']
			        ),
			        array(
			            'name' => 'pass',
			            'content' => '<span>Password:&nbsp;</span> '.$this->request->data['User']['confirm_password']
			        )
			    );
			    $message = array(
			        'to' => array(
			            array(
			                'email' => $this->request->data['User']['email']
			            )
		        	)
			    );
			    $async = false;
			    $ip_pool = 'Main Pool';
			    $result = $mandrill->messages->sendTemplate($template_name, $template_content, $message, $async, $ip_pool);

				unset($this->request->data);
				$this->Session->setFlash('New student is added. Email sent!', 'success');
				$this->redirect(array('action' => 'selfregistration'));
		    }
		}
		else
		{
		    unset($this->request->data['User']['password']);
		    unset($this->request->data['User']['confirm_password']);
		    unset($this->request->data['User']['email']);
		    $this->Session->setFlash('Please check all the fields', 'error');
		}
		
	    }
	
	}

	public function reenrol() {
		if($this->Auth->user('User.type') =='Tutor' || $this->Auth->user('User.type') =='Student') {
		$this->redirect(array('controller'=> $this->Auth->user('User.type'). 's', 'action'=>'dashboard'));
		}
		$this->layout = 'default';
		$this->set('title_for_layout', 'Re-enrol');
		$this->set('studentlist', $this->Enrolment->allenroled());
	}

	public function enrol($id = null,$type = "") {

		if($this->Auth->user('User.type') == 'Tutor'){
			$this->redirect(array('controller'=> $this->Auth->user('User.type'). 's', 'action'=>'dashboard'));
		}
		$this->layout = 'default';
		$this->set('title_for_layout', 'Enrolment');
		$this->set('price_lists', $this->Price->lists(array('status'=>'active')));
		$this->set('day_lists', $this->EnrolmentSetting->lists(array('type'=>'day','status'=>'available')));
		$this->set('time_lists', $this->EnrolmentSetting->lists(array('type'=>'time','status'=>'available')));
		$this->set('isreenrol', $type);
		$this->set('location_lists', $this->EnrolmentSetting->lists(array('type'=>'location','status'=>'available')));
		if($id && $id != 0){
			$user_id = $id;
		} else {
			$user_id = $this->Session->read('UserDataHolder.User.id');
		}
		$this->set('user_details', $this->User->userDetails(array('User.id'=>$user_id)));
	}

	public function enroledList() {
		$this->layout = 'default';
		//$this->set('title_for_layout', 'Price List');
		$this->set('enroled_list', $this->Enrolment->lists());
	}

	// public function saveEnrole($id = null,$method = null,$isreenrol="") {
	// 	$this->layout = 'default';
		
	// 	$session_id = $this->request->data['Enrolment']['session_id'];
	// 	if(isset($isreenrol) && $isreenrol == "reenrol"){
	// 		$this->request->data['Enrolment']['isreenrol'] = 1;
	// 	}

	// 	$this->Session->write('enrolData', $this->request->data['Enrolment']);
	// 	if ($this->request->is('post')) {
	// 		if ($session_id == 0 || $session_id == "") {

	// 			$this->Session->setFlash('Please select a session.', 'error');
	// 			$this->redirect(array('controller' => 'users', 'action' => 'enrol'));	

	// 		} else {

	// 			$price = $this->Price->find('all',array(
	// 				'conditions' => array('id'=>$session_id)
	// 			));

	// 			if($method == "f2f"){
	// 				$enrolmentdata = $this->Session->read('enrolData');
	// 				// $session = $this->request->data['Price']['session'];
	// 				// $price = $this->request->data['Price']['price'];
	// 				// $this->request->data['Price']['status'] ='active';
	// 				// $this->request->data['Price']['total'] = $session * $price;
	// 				// $this->request->data['Price']['total'] = CakeNumber::currency($this->request->data['Price']['total'],'');
	// 				// $this->request->data['Price']['price'] = CakeNumber::currency($this->request->data['Price']['price'],'');
	// 				// $this->Price->save($this->request->data['Price']);
	// 				if(isset($isreenrol) && $isreenrol == "reenrol")
	// 				$otherFields = array('user_id' => $id,'session_id' => $price[0]["Price"]["id"],'first_day' => $enrolmentdata["first_day"],'second_day' => $enrolmentdata["second_day"], 'first_time' => $enrolmentdata["first_time"],'second_time' => $enrolmentdata["second_time"],'location' => $enrolmentdata["location"],'date_session' => date("Y-m-d"), 'status' => 'active', 'session' => $price[0]["Price"]["session"], 'price' => $price[0]["Price"]["price"], 'total' => $price[0]["Price"]["price"], 'isreenrol' => "1");
	// 				else
	// 				$otherFields = array('user_id' => $id,'session_id' => $price[0]["Price"]["id"],'first_day' => $enrolmentdata["first_day"],'second_day' => $enrolmentdata["second_day"], 'first_time' => $enrolmentdata["first_time"],'second_time' => $enrolmentdata["second_time"],'location' => $enrolmentdata["location"],'date_session' => date("Y-m-d"), 'status' => 'active', 'session' => $price[0]["Price"]["session"], 'price' => $price[0]["Price"]["price"], 'total' => $price[0]["Price"]["price"]);
	// 				// $otherFields = array('user_id' => $id,
	// 				// 	'session_id' => 0,
	// 				// 	'first_day' => $enrolmentdata["first_day"],
	// 				// 	'second_day' => $enrolmentdata["second_day"],
	// 				// 	'first_time' => $enrolmentdata["first_time"],
	// 				// 	'second_time' => $enrolmentdata["second_time"],
	// 				// 	'location' => $enrolmentdata["location"],
	// 				// 	'date_session' => date("Y-m-d"), 
	// 				// 	'status' => 'active',
	// 				// 	'session' => $this->request->data['Price']['session'], 
	// 				// 	'price' => $this->request->data['Price']['price'], 
	// 				// 	'total' => $this->request->data['Price']['price']);
	// 				$this->Enrolment->create();
	// 				foreach ($otherFields as $key => $value) {
	// 					$this->Enrolment->saveField($key,$value);
	// 				}
					
	// 					$otherFieldsPayment = array('user_id' => $id,'enrolment_id' => $this->Enrolment->id, 'paid_amount' => 0,'total_price' => 0, 'payment_status' => 'outstanding');
	// 					ClassRegistry::init('Payment')->create();
	// 					foreach ($otherFieldsPayment as $key => $value) {
	// 						ClassRegistry::init('Payment')->saveField($key,$value);
	// 					}

	// 				$this->redirect(array('controller' => 'payments', 'action' => 'reciept',$id));
	// 			} else {
	// 				$this->processCheckout($price, $session_id);
	// 			}
					
	// 		}

	// 	}	
	// 	$this->redirect(array('controller' => 'users', 'action' => 'enrol'));
	// }
	public function saveEnrole($id = null,$method = null,$isreenrol="") {
		$this->layout = 'default';
		
		$session_id = $this->request->data['Enrolment']['session_id'];
		if(isset($isreenrol) && $isreenrol == "reenrol"){
			$this->request->data['Enrolment']['isreenrol'] = 1;
		}

		$this->Session->write('enrolData', $this->request->data['Enrolment']);
		if ($this->request->is('post')) {
				$price = $this->Price->find('all',array(
					'conditions' => array('id'=>$session_id)
				));

				if($method == "f2f"){
					$enrolmentdata = $this->Session->read('enrolData');
			
					if(isset($isreenrol) && $isreenrol == "reenrol")  {
					$otherFields = array('user_id' => $id,'session_id' => $price[0]["Price"]["id"],'first_day' => $enrolmentdata["first_day"],'second_day' => $enrolmentdata["second_day"], 'first_time' => $enrolmentdata["first_time"],'second_time' => $enrolmentdata["second_time"],'location' => $enrolmentdata["location"],'date_session' => date("Y-m-d"), 'status' => 'active', 'session' => $price[0]["Price"]["session"], 'price' => $price[0]["Price"]["price"], 'total' => $price[0]["Price"]["price"], 'isreenrol' => "1");
					}
					elseif(!empty($this->request->data['Price']['subject']) && !empty($this->request->data['Price']['session']) && !empty($this->request->data['Price']['price'])) {
						$otherFields = array(
						'user_id' => $id,
						'session_id' => $this->Price->id,
						'first_day' => $enrolmentdata["first_day"],
						'second_day' => $enrolmentdata["second_day"],
						'first_time' => $enrolmentdata["first_time"],
						'second_time' => $enrolmentdata["second_time"],
						'location' => $enrolmentdata["location"],
						'date_session' => date("Y-m-d"), 
						'status' => 'active',
						'session' => $this->request->data['Price']['session'], 
						'price' => $this->request->data['Price']['price'], 
						'total' => $this->request->data['Price']['price'],
						'hour' => $this->request->data['Enrolment']['hour']); 
						$session = $this->request->data['Price']['session'];
						$price = $this->request->data['Price']['price'];
						$this->request->data['Price']['status'] ='active';
						$this->request->data['Price']['hour'] = $this->request->data['Enrolment']['hour'];
						$this->request->data['Price']['total'] = $session * $price;
						$this->request->data['Price']['total'] = CakeNumber::currency($this->request->data['Price']['total'],'');
						$this->request->data['Price']['price'] = CakeNumber::currency($this->request->data['Price']['price'],'');
						$this->Price->save($this->request->data['Price']);
						$this->Session->write('enrolData.session_id' ,  $this->Price->id);	
						}
					else  {
							$otherFields = array('user_id' => $id,'session_id' => $price[0]["Price"]["id"],'first_day' => $enrolmentdata["first_day"],'second_day' => $enrolmentdata["second_day"], 'first_time' => $enrolmentdata["first_time"],'second_time' => $enrolmentdata["second_time"],'location' => $enrolmentdata["location"],'date_session' => date("Y-m-d"), 'status' => 'active', 'session' => $price[0]["Price"]["session"], 'price' => $price[0]["Price"]["price"], 'total' => $price[0]["Price"]["price"]);
					}
				
					$this->Enrolment->create();
					foreach ($otherFields as $key => $value) {
						$this->Enrolment->saveField($key,$value);
					}

						$otherFieldsPayment = array('user_id' => $id,'enrolment_id' => $this->Enrolment->id, 'paid_amount' => 0,'total_price' => 0, 'payment_status' => 'outstanding');
						ClassRegistry::init('Payment')->create();
						foreach ($otherFieldsPayment as $key => $value) {
							ClassRegistry::init('Payment')->saveField($key,$value);
						}


					$this->redirect(array('controller' => 'payments', 'action' => 'reciept',$id));
				} else {
					$this->processCheckout($price, $session_id);
				}
					
		// 	}

		}	
		$this->redirect(array('controller' => 'users', 'action' => 'enrol'));
	}

	public function makepayment($id = null,$sesid = null,$enrolid = null) {
		$this->layout = 'default';

		if ($this->request->is('post')) {
			
			$enrolinfo = ClassRegistry::init('Enrolment')->getStudentDetails($id);
			$paymentValue = array("payment_method"=>"'".$this->request->data["payment_method"]."'",
							"payment"=>"'".$this->request->data["payment"]."'",
							"notes"=>"'".$this->request->data["notes"]."'",
							"discount"=>"'".$this->request->data["discount"]."'",
							"tfee"=>"'".$this->request->data["tfee"]."'",
							"payment_status"=>"'paid'",
							"total_price"=>"'".$this->request->data["total_price"]."'",
							"paid_amount"=>"'".$this->request->data["paid_amount"]."'",
							"enrolment_id"=>"'".$enrolid."'"
						  );
			ClassRegistry::init('Payment')->updateAll($paymentValue,array("Payment.enrolment_id"=>$enrolid));
			//redirect to paypal
			$this->redirect(array('controller' => 'payments', 'action' => 'reciept',$id,'rp'));
		}

		$price = $this->Price->find('all',array(
			'conditions' => array('id'=>$sesid)
		));

		$user_id = $id;

		$this->set('price',$price[0]['Price']);
		$this->set('enrolmentid',$enrolid);
		$this->set('sessionid',$sesid);
		$this->set('user_details', $this->User->userDetails(array('id'=>$user_id)));
	}

	//paypal function
	public function processCheckout($price, $session_id)  {
		$this->layout = 'default';
			$total = $price[0]['Price']['total'];

        	$this->autoRender = false;
            $this->Paypal->amount = $total;
            $this->Paypal->currencyCode = 'USD';
            $this->Paypal->returnUrl = Router::url('completeCheckout/'.$session_id, true);
            $this->Paypal->cancelUrl = Router::url('', true);
            $this->Paypal->itemName = 'Enrolment Payment';
            $this->Paypal->orderDesc = 'Private tutoring student';
            $this->Paypal->quantity = 1;
            $this->Paypal->expressCheckout();
    }
    
	public function completeCheckout($session_id) {
		$this->layout = 'default';
		$price = $this->Price->find('all',array(
			'conditions' => array('id'=>$session_id)
		));

        $this->autoRender = false;
        $this->Paypal->token = $this->request->query['token'];
        $this->Paypal->payerId = $this->request->query['PayerID'];
        
        $customer_details = $this->Paypal->getExpressCheckoutDetails();
        $this->Paypal->amount = $customer_details['AMT'];
        $this->Paypal->currencyCode = $customer_details['CURRENCYCODE'];
        $this->Paypal->token = $customer_details['TOKEN'];
        $this->Paypal->payerId = $customer_details['PAYERID'];
        $response = $this->Paypal->doExpressCheckoutPayment();

        /** */
        if(isset($response) && $response['PAYMENTSTATUS'] == 'Completed') {
           //Transaction succes
        	$this->transactionsuccess($price, $this->Paypal->token, $this->Paypal->payerId);
        }
    }

    function transactionsuccess($price, $token, $payerID) 
	{
		$this->layout = 'default';
		$enrolment = $this->Session->read('enrolData');
		$session_id = $enrolment['session_id'];
		$session = $price[0]['Price']['session'];
		$total = $price[0]['Price']['total'];
		$price = $price[0]['Price']['price'];

		$student_id = $this->Session->read('UserDataHolder.User.id');
		$otherFields = array('user_id' => $student_id, 'session' => $session, 'price' => $price, 'total' => $total);
		$this->Enrolment->create();
		$this->Enrolment->save($enrolment);
		foreach ($otherFields as $key => $value) {
			$this->Enrolment->saveField($key,$value);
		}
		$this->Enrolment->saveField('price',$price);
		$this->Enrolment->saveField('total',$total);
		$this->Enrolment->saveField('date_added',date("Y-m-d"));
		$this->Enrolment->saveField('status','active');//change this to active after paying in paypal
		
/*		$paymentValue = array("payment_method"=>"'Paypal'",
						"payment_status"=>"'paid'",
						"total_price"=>$price,
						"paid_amount"=>$total,
						"enrolment_id"=>$this->Enrolment->id
					  );

		ClassRegistry::init('Payment')->updateAll($paymentValue,array("Payment.user_id"=>$student_id));*/

		$otherFieldsPayment = array('user_id' => $student_id,'enrolment_id' => $this->Enrolment->id, 'paid_amount' => $total,'total_price' => $price, 'payment_status' => 'paid');
		ClassRegistry::init('Payment')->create();
		foreach ($otherFieldsPayment as $key => $value) {
			ClassRegistry::init('Payment')->saveField($key,$value);
		}

		$this->Session->delete('enrolData');
		//redirect to paypal
		$this->redirect(array('controller' => 'payments', 'action' => 'reciept',$student_id,'rp'));
	}
	
}