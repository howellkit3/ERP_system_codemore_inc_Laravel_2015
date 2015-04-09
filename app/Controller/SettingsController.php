<?php
App::uses('AppController', 'Controller');

class SettingsController extends AppController
{

    public $uses = array('ItemCategoryHolder', 'StatusFieldHolder');

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

         $categoryData = $this->ItemCategoryHolder->find('all', array('order' => 'ItemCategoryHolder.id DESC'));
        if ($this->request->is('post')) {
            
            if (!empty($this->request->data)) {
               // pr($this->request->data); exit;

                $this->ItemCategoryHolder->create();

                $this->id = $this->ItemCategoryHolder->saveCategory($this->request->data['ItemCategoryHolder'], $userData['User']['id']);

                $this->ItemCategoryHolder->ItemTypeHolder->saveItemType($this->request->data['ItemTypeHolder'], $this->id);

                $this->Session->setFlash(__('Add Category Complete.'));

                $this->redirect(
                    array('controller' => 'settings', 'action' => 'category')
                );
          
               
            }
        }

       
       // pr($categoryData);exit();
        $this->set(compact('categoryData'));
    }
	

    public function status() {

        $userData = $this->Session->read('Auth');

        $this->StatusFieldHolder->bindStatus(array('ItemTypeHolder'));


        $statusData = $this->StatusFieldHolder->find('all', array('order' => 'StatusFieldHolder.id DESC'));
        if ($this->request->is('post')) {
            
            if (!empty($this->request->data)) {
               // pr($this->request->data); exit;

              //  pr($this->StatusFieldHolder->ItemTypeHolder->saveItemType($this->request->data['id'], $this->id));exit();

                $this->StatusFieldHolder->create();

                $this->id = $this->StatusFieldHolder->saveStatus($this->request->data['StatusFieldHolder'], $userData['User']['id']);

                $this->StatusFieldHolder->ItemTypeHolder->saveItemType($this->request->data['id'], $this->id);

                $this->Session->setFlash(__('Add Status Complete.'));

                $this->redirect(
                    array('controller' => 'settings', 'action' => 'status')
                );
          
               
            }

        /*if ($this->request->is('post')) {
            
            if (!empty($this->request->data)) {

                $this->StatusFieldHolder->create();

                 $this->StatusFieldHolder->saveStatus($this->request->data['StatusFieldHolder'], $userData['User']['id']);

                $this->Session->setFlash(__('Add Status Complete.'));

                $this->redirect(
                    array('controller' => 'settings', 'action' => 'status')
                );
          
               
            }*/
        }

       // $categoryData = $this->ItemCategoryHolder->find('all', array('order' => 'StatusFieldHolder.id DESC'));
        $this->set(compact('statusData'));
        //$this->set(compact('categoryData'));
    }


    public function category_edit($id = null) {
            if (!$id) {
                throw new NotFoundException(__('Invalid post'));
            }

             $this->ItemCategoryHolder->bind(array('ItemTypeHolder'));


            $post = $this->ItemCategoryHolder->findById($id);
            if (!$post) {
                throw new NotFoundException(__('Invalid post'));
            }

            if ($this->request->is(array('post', 'put'))) {
                $this->ItemCategoryHolder->id = $id;

                if ($this->ItemCategoryHolder->save($this->request->data)) {

                    $this->ItemCategoryHolder->save($this->request->data);
                    $this->ItemCategoryHolder->bind(array('ItemTypeHolder'));
                    $this->ItemCategoryHolder->ItemTypeHolder->save($this->request->data);
                    $this->Session->setFlash(__('Category has been updated.'));
                    return $this->redirect(array('action' => 'category'));
                }
                $this->Session->setFlash(__('Unable to update your post.'));
            }

            if (!$this->request->data) {
                $this->request->data = $post;
            }
    }

        public function delete($id) {
      
       /* if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        } */
        if ($this->ItemCategoryHolder->delete($id)) {
            $this->Session->setFlash(
                __('Successfully deleted.', h($id))
            );
        } else {
            $this->Session->setFlash(
                __('The post cannot be deleted.', h($id))
            );
        }

        return $this->redirect(array('action' => 'category'));
    }

    public function deleteStatus($id) {
      
       /* if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        } */
        if ($this->StatusFieldHolder->delete($id)) {
            $this->Session->setFlash(
                __('Successfully deleted.', h($id))
            );
        } else {
            $this->Session->setFlash(
                __('The post cannot be deleted.', h($id))
            );
        }

        return $this->redirect(array('action' => 'status'));
    }


     public function status_edit($id = null) {
            if (!$id) {
                throw new NotFoundException(__('Invalid post'));
            }

             $this->StatusFieldHolder->bind(array('ItemTypeHolder'));


            $post = $this->StatusFieldHolder->findById($id);
            if (!$post) {
                throw new NotFoundException(__('Invalid post'));
            }

            if ($this->request->is(array('post', 'put'))) {
                $this->StatusFieldHolder->id = $id;

                if ($this->StatusFieldHolder->save($this->request->data)) {

                    $this->StatusFieldHolder->save($this->request->data);
                    $this->StatusFieldHolder->bind(array('id'));
                    $this->StatusFieldHolder->ItemTypeHolder->save($this->request->data);
                    $this->Session->setFlash(__('Status has been updated.'));
                    return $this->redirect(array('action' => 'status'));
                }
                $this->Session->setFlash(__('Unable to update your post.'));
            }

            if (!$this->request->data) {
                $this->request->data = $post;
            }
    }



}
            


