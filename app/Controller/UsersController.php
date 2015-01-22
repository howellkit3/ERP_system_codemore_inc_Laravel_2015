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
        $this->Auth->allow('login','add', 'index');
    }
	public function home() {
		
	}
	public function index() {
		
	}

	public function add() {
		if ($this->request->is('post')) {
            
            if (!empty($this->request->data)) {
            	// pr($this->request->data);exit();
            	$this->User->create();
            	$this->User->AddAction($this->request->data);
            	$this->Session->setFlash(__('Register Complete.'));
            	$this->redirect(
                    array('controller' => 'users', 'action' => 'add')
                );
            	
            }
        }
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
                $this->redirect($this->Auth->redirectUrl());
            } else {

              

               $this->Session->setFlash(
                 __('Username or password is incorrect'),
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