<?php
App::uses('AppController', 'Controller');

class SettingsController extends AppController
{

    public $uses = array('ItemCategoryHolder');

    public $useDbConfig = array('default');

    // public function beforeFilter() {

    //     parent::beforeFilter();

    //     $userData = $this->Session->read('Auth');

    //     $this->Auth->allow('setting','index');

    //     $this->set(compact('userData'));

    // }
    public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
        'order' => array('User.email' => 'asc' )
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index','category');
    }
	
	public function index() {
		
	}

    public function category() {

        $userData = $this->Session->read('Auth');

        $this->ItemCategoryHolder->bind(array('ItemTypeHolder'));

        if ($this->request->is('post')) {
            
            if (!empty($this->request->data)) {

                $this->ItemCategoryHolder->create();

                $this->id = $this->ItemCategoryHolder->saveCategory($this->request->data['ItemCategoryHolder'], $userData['User']['id']);

                $this->ItemCategoryHolder->ItemTypeHolder->saveItemType($this->request->data['ItemTypeHolder'], $this->id);

                $this->Session->setFlash(__('Add Category Complete.'));

                $this->redirect(
                    array('controller' => 'settings', 'action' => 'category')
                );
          
               
            }
        }

        $categoryData = $this->ItemCategoryHolder->find('all', array('order' => 'ItemCategoryHolder.id DESC'));
        //pr($categoryData);exit();
        $this->set(compact('categoryData'));
    }
	

	
	
}