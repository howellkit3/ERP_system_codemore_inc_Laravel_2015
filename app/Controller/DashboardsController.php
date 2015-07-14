<?php
App::uses('AppController', 'Controller');

class DashboardsController extends AppController
{
    
  //public $components = array('Session', 'Auth');

	public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
        'order' => array('User.email' => 'asc' )
    );

    public function beforeFilter() {
        parent::beforeFilter();
        // $this->response->disableCache();
        $this->Auth->allow('index');
        $this->loadModel('User');
        $userData = $this->User->read(null,$this->Session->read('Auth.User.id'));//$this->Session->read('Auth');
        $this->set(compact('userData'));
    }
	
	public function index() {
       
         $userData = $this->Session->read('Auth');

         $this->set(compact('userData'));
		
	}

	public function logout() {
        $this->redirect($this->Auth->logout());
    }
}