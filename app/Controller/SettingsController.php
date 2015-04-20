<?php
App::uses('AppController', 'Controller');

class SettingsController extends AppController
{
    public $uses = array('ItemCategoryHolder', 'StatusFieldHolder' , 'PackagingHolder', 'PaymentTermHolder', 'ItemTypeholder');

    public $useDbConfig = array('default');

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

        $this->loadModel('ItemCategoryHolder');

        $this->loadModel('ItemTypeHolder');

        $userData = $this->Session->read('Auth');

        $this->ItemTypeHolder->bind(array('ItemCategoryHolder'));

        $categoryData = $this->ItemCategoryHolder->find('all',  array('order' => 'ItemCategoryHolder.id DESC'));

        $categoryDataDropList = $this->ItemCategoryHolder->find('list',  array('order' => 'ItemCategoryHolder.id DESC'));

        $nameTypeData = $this->ItemTypeHolder->find('all',  array('order' => 'ItemTypeHolder.id DESC'));


        if ($this->request->is('post')) {
            
            if (!empty($this->request->data)) {

                $this->ItemCategoryHolder->save($this->request->data);

                $this->Session->setFlash(__('Add Category Complete.'));

                $this->redirect(

                    array('controller' => 'settings', 'action' => 'category')
                );
            }
        }

        $this->set(compact('categoryDataDropList', 'categoryData','nameTypeData' ));
    }

    public function name_type() {

        $this->loadModel('ItemTypeHolder');

        $userData = $this->Session->read('Auth');

        $nameTypeData = $this->ItemTypeHolder->find('all',  array('order' => 'ItemTypeHolder.id DESC'));

        $categoryTable = $this->ItemCategoryHolder->find('list', array('ItemCategoryHolder.name'));

            if ($this->request->is('post')) {
                
                if (!empty($this->request->data)) {

                    $this->ItemTypeHolder->save($this->request->data);

                    $this->ItemTypeHolder->save($this->request->data);
           
                    $this->Session->setFlash(__('Add Name Type Complete.'));
                    return $this->redirect(array('action' => 'category','tab' => 'tab-type'));
                }
            }

            $this->set(compact('nameTypeData'));
	}

    public function status() {

        $userData = $this->Session->read('Auth');

        $statusData = $this->StatusFieldHolder->find('all', array('order' => 'StatusFieldHolder.id DESC'));
        if ($this->request->is('post')) {
            
            if (!empty($this->request->data)) {

                $this->StatusFieldHolder->create();

                $this->id = $this->StatusFieldHolder->saveStatus($this->request->data['StatusFieldHolder'], $userData['User']['id']);

            
                $this->Session->setFlash(__('Add Status Complete.'));

                $this->redirect(
                    array('controller' => 'settings', 'action' => 'status')
                );
            }
        }

        $this->set(compact('statusData'));

    }

    public function supplier() {

        $userData = $this->Session->read('Auth');

        $this->loadModel('Supplier');

        $supplierData = $this->Supplier->find('all', array('order' => 'Supplier.id DESC'));
        if ($this->request->is('post')) {
            
            if (!empty($this->request->data)) {

                $this->Supplier->create();

                $this->id = $this->Supplier->save($this->request->data);

            
                $this->Session->setFlash(__('Add Supplier Complete.'));

                $this->redirect(
                    array('controller' => 'settings', 'action' => 'supplier')
                );
            }
        }

        $this->set(compact('supplierData'));

    }

    public function supplier_edit($id = null) {

            $this->loadModel('Supplier');

            if (!$id) {
                throw new NotFoundException(__('Invalid post'));
            }

            $post = $this->Supplier->findById($id );

            if (!$post) {
                throw new NotFoundException(__('Invalid post'));
            }

            if ($this->request->is(array('post', 'put'))) {
                $this->Supplier->id = $id;

                if ($this->Supplier->save($this->request->data)) {

                    $this->Supplier->save($this->request->data);
                    $this->Session->setFlash(__('Supplier has been updated.'));
                    return $this->redirect(array('action' => 'supplier'));
                }
                $this->Session->setFlash(__('Unable to update your post.'));
            }

            if (!$this->request->data) {
                $this->request->data = $post;
         }
    }

    public function deleteSupplier($id) {

            $this->loadModel('Supplier');
           
            if ($this->Supplier->delete($id)) {
                $this->Session->setFlash(
                    __('Successfully deleted.', h($id))
                );
            } else {
                $this->Session->setFlash(
                    __('The post cannot be deleted.', h($id))
                );
            }

            return $this->redirect(array('action' => 'supplier'));
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
                    $this->Session->setFlash(__('Category has been updated.'));
                    return $this->redirect(array('action' => 'category'));
                }
                $this->Session->setFlash(__('Unable to update your post.'));
            }

            if (!$this->request->data) {
                $this->request->data = $post;
            }
    }

    public function name_type_edit($id = null) {
            
            $this->loadModel('ItemCategoryHolder');

            $this->loadModel('ItemTypeHolder');

            $this->loadModel('ItemCategoryHolder');

            $categoryDataDropList = $this->ItemCategoryHolder->find('list',  array('order' => 'ItemCategoryHolder.id DESC'));

            if (!$id) {
                throw new NotFoundException(__('Invalid post'));
            }

           $post = $this->ItemTypeHolder->findById($id);

            if (!$post) {
                throw new NotFoundException(__('Invalid post'));
            }

            if ($this->request->is(array('post', 'put'))) {
                $this->ItemTypeHolder->id = $id;

                if ($this->ItemTypeHolder->save($this->request->data)) {

                    $this->ItemTypeHolder->save($this->request->data);
                    $this->ItemTypeHolder->bind(array('ItemCategoryHolder'));
                    $this->Session->setFlash(__('Type has been updated.'));
                    return $this->redirect(array('action' => 'category','tab' => 'tab-type'));
               }
                $this->Session->setFlash(__('Unable to update your post.'));
            }

            if (!$this->request->data) {
                $this->request->data = $post;
            }

            $this->set(compact('categoryDataDropList', 'categoryData','nameTypeData' ));
    }

    public function delete($id) {
    
          
            if ($this->ItemCategoryHolder->delete($id)) {
                $this->Session->setFlash(
                    __('Successfully deleted.', h($id)));
            } else {
                $this->Session->setFlash(
                    __('The post cannot be deleted.', h($id)));
            }

            return $this->redirect(array('action' => 'category'));
    }




    public function deleteType($id) {

        $this->loadModel('ItemTypeHolder');

        if ($this->ItemTypeholder->delete($id)) {

            $this->Session->setFlash(

                __('Successfully deleted.', h($id))
            );

        } else {
            $this->Session->setFlash(

                __('The post cannot be deleted.', h($id))
            );
        }

        return $this->redirect(array('action' => 'category','tab' => 'tab-type'));
    }

    public function deleteStatus($id) {
           
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


            $post = $this->StatusFieldHolder->findById($id );

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
         
    public function packaging() {

        $this->loadModel('PackagingHolder');

        $userData = $this->Session->read('Auth');

        $packagingData = $this->PackagingHolder->find('all', array('order' => 'PackagingHolder.id DESC'));
            if ($this->request->is('post')) {
                
                if (!empty($this->request->data)) {
                   
                    $this->PackagingHolder->create();

                    $this->id = $this->PackagingHolder->savePackaging($this->request->data['PackagingHolder'], $userData['User']['id']);
           
                    $this->Session->setFlash(__('Add Package Complete.'));

                    $this->redirect(
                        array('controller' => 'settings', 'action' => 'packaging')
                    );
                }
            }

        $this->set(compact('packagingData'));
    }

    public function packaging_edit($id = null) {

            if (!$id) {
                throw new NotFoundException(__('Invalid post'));
            }

            $post = $this->PackagingHolder->findById($id);
            if (!$post) {
                throw new NotFoundException(__('Invalid post'));
            }

            if ($this->request->is(array('post', 'put'))) {
                $this->PackagingHolder->id = $id;

                if ($this->PackagingHolder->save($this->request->data)) {

                    $this->PackagingHolder->save($this->request->data);

                    $this->Session->setFlash(__('Package has been updated.'));

                    return $this->redirect(array('action' => 'packaging'));
                }

                $this->Session->setFlash(__('Unable to update your post.'));
            }

            if (!$this->request->data) {

                $this->request->data = $post;
            }
    }

    public function deletePackaging($id) {
      
        if ($this->PackagingHolder->delete($id)) {

            $this->Session->setFlash(

                __('Successfully deleted.', h($id))
            );

        } else {
            $this->Session->setFlash(

                __('The post cannot be deleted.', h($id))
            );
        }

        return $this->redirect(array('action' => 'packaging'));
    }

    public function payment_term() {

                $this->loadModel('PaymentTermHolder');

                $userData = $this->Session->read('Auth');

                $paymentTermData = $this->PaymentTermHolder->find('all', array('order' => 'PaymentTermHolder.id DESC'));
                if ($this->request->is('post')) {
                    
                    if (!empty($this->request->data)) {

                        $this->PaymentTermHolder->create();

                        $this->id = $this->PaymentTermHolder->savePaymentTerm($this->request->data['PaymentTermHolder'], $userData['User']['id']);

                        $this->Session->setFlash(__('Add Package Complete.'));

                        $this->redirect(

                            array('controller' => 'settings', 'action' => 'payment_term')
                        );
                    }
                }

                $this->set(compact('paymentTermData'));
    }

    public function deletePaymentTerm($id) {
      
        if ($this->PaymentTermHolder->delete($id)) {

            $this->Session->setFlash(

                __('Successfully deleted.', h($id))
            );

        } else {

            $this->Session->setFlash(

                __('The post cannot be deleted.', h($id))
            );
        }

        return $this->redirect(array('action' => 'payment_term'));
    }
 
    public function payment_term_edit($id = null) {

            if (!$id) {
                throw new NotFoundException(__('Invalid post'));
            }

            $post = $this->PaymentTermHolder->findById($id);
            if (!$post) {
                throw new NotFoundException(__('Invalid post'));
            }

            if ($this->request->is(array('post', 'put'))) {
                $this->PaymentTermHolder->id = $id;

                if ($this->PaymentTermHolder->save($this->request->data)) {

                    $this->PaymentTermHolder->save($this->request->data);

                    $this->Session->setFlash(__('Payment Term has been updated.'));

                    return $this->redirect(array('action' => 'payment_term'));
                }
                $this->Session->setFlash(__('Unable to update your post.'));
            }

            if (!$this->request->data) {
                $this->request->data = $post;
            }
    }



    public function deleteProduct($id) {
      
        if ($this->Product->delete($id)) {
            
            $this->Session->setFlash(
                __('Successfully deleted.', h($id))
            );
        } else {
            $this->Session->setFlash(
                __('The post cannot be deleted.', h($id))
            );
        }

        return $this->redirect(array(' controller' => 'products', 'action' => 'index'));
    }

    public function category_index() {

    }

    public function category_option() {
                    
    }

    public function category_find($id) {


        $this->layout = false;

        $this->loadModel('ItemCategoryHolder');

        if (!empty($id)) {

            $category = $this->ItemCategoryHolder->findById($id);

            echo json_encode($category);

            //$this->autoRender = false;

        }
         $this->autoRender = false;
         exit();
    

    }

}
            


