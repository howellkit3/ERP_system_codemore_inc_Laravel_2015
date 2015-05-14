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
        $userData = $this->Session->read('Auth');
        $this->set(compact('userData'));
    }
	
	public function index() {
		
	}

	public function logout() {
        $this->redirect($this->Auth->logout());
    }
}