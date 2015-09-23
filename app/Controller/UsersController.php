<?php
App::uses('AppController', 'Controller');

App::uses('ImageUploader', 'Vendor');

class UsersController extends AppController
{
    
  //public $components = array('Session', 'Auth');

	public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
        'order' => array('User.email' => 'asc' )
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','add');
        
    }
	public function home() {
		
	}
	public function index() {	
	}
    
	public function addbk() {

        $this->layout = 'add';

        $this->loadModel('Role');

        $roleDatList = $this->Role->find('list', array('conditions' => array('NOT' => array('Role.id' => array(1, 2)))));

		if ($this->request->is('post')) {
            
            if (!empty($this->request->data)) {
               
            	$this->User->create();

                $this->request->data['User']['rxt'] = $this->request->data['User']['password'];
                $this->request->data['User']['role_id'] = $this->request->data['Role']['id'];
                
            	if($this->User->save($this->request->data)){

                    $this->Session->setFlash(__('Register Complete.'));

                    $this->redirect(
                        array('controller' => 'users', 'action' => 'login')
                    );
                } else {

                    $this->Session->setFlash(
                        __('The invalid data. Please, try again.')
                    );
                }
	
            } 
        }

        $this->set(compact('roleDatList'));

	}

	public function login() {

        $this->layout = 'login';

        $this->Session->read('Auth');

		 //if already logged-in, redirect
        if($this->Session->check('Auth.User')){

            $this->redirect(array('action' => 'index'));     
        }
         
        // if we get the post information, try to authenticate
        
        if ($this->request->is('post')) {

            if ($this->Auth->login()) {

                $this->Session->setFlash(__('Welcome, '. $this->Auth->user('lastname')));
                
                $this->redirect(
                    array('controller' => 'dashboards', 'action' => 'index')
                );

            } else {

               $this->Session->setFlash(
                     __('Email or password is incorrect'),
                    'default',
                    array(),
                    'auth'
                  );
            }
        } 

	}
	public function logout() {
        $this->redirect($this->Auth->logout());
    }


    public function profile_settings() {

        $this->loadModel('User');

        $userData = $this->Session->read('Auth.User');

        if (!empty($this->request->data)) {
               if (!empty($this->request->data['User']['file']['name'])) {

                    $file = $this->request->data['User']['file'];
                    
                    $uploader = new ImageUploader;

                    if ($this->request->data['User']['file']['error'] == 0 ) {
                       $time = time();
                       $file['name'] = $uploader->resize($file, $time,'users');
                        
                    }
               
                    $this->request->data['User']['image'] = $file['name'];
                }


                if ($this->User->save($this->request->data)) {

                 
                    $user = $this->User->read(null,$userData['id']);

                    $this->Auth->login($user['User']);

                    $this->Session->setFlash(__('Profile successfully update.'));

                    $this->redirect(
                        array('controller' => 'users', 'action' => 'profile_settings')
                    );

                } else {

                    $this->Session->setFlash(
                        __('The invalid data. Please, try again.')
                    );
                }
        }

        if (!empty($userData)) {
            $this->User->bind(array('Role'));
            $userData = $this->User->read(null,$userData['id']);

        }
        
        $this->set(compact('userData'));
    }
}