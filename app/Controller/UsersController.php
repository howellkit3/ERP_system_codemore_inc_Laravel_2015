<?php
App::uses('AppController', 'Controller');

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
    
	public function add() {

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
}