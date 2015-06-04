<?php
App::uses('AppController', 'Controller');

class SettingsController extends AppController
{
    public $uses = array('ItemCategoryHolder','ItemTypeHolder');

    public $useDbConfig = array('default');

    var $paginate = array( 
        'ItemCategoryHolder' => array( 
                'fields' => array( 
                        'Image.filename', 'Image.caption' 
                ), 
                'limit' => 10, 
                'order' => 'ItemCategoryHolder.id DESC'
            ), 
        'ItemTypeHolder' => array( 
                'limit' => 10,
                'fields' => array('id', 'name', 'created','ItemCategoryHolder.name'),
                'order' => 'ItemTypeHolder.id DESC',
            ),
        'GeneralItem' => array( 
                'limit' => 10,
                //'fields' => array('id', 'name', 'created'),
                'order' => 'GeneralItem.id DESC'
            ),
        'Substrate' => array( 
                'limit' => 10,
                //'fields' => array('id', 'name', 'created'),
                'order' => 'Substrate.id DESC'
            ), 
        'CompoundSubstrate' => array( 
            'limit' => 10,
            //'fields' => array('id', 'name', 'created'),
            'order' => 'CompoundSubstrate.id DESC'
        ),

        'CorrugatedPaper' => array( 
            'limit' => 10,
            //'fields' => array('id', 'name', 'created'),
            'order' => 'CorrugatedPaper.id DESC'
         ),

       'SubProcess' => array( 
                'limit' => 10,
                //'fields' => array('id', 'name', 'created'),
                'order' => 'SubProcess.id DESC'
        ),

       'Process' => array( 
                'limit' => 10,
                //'fields' => array('id', 'name', 'created'),
                'order' => 'Process.id DESC'
        )


    ); 
    
    public function beforeFilter() {


        parent::beforeFilter();
        $this->Auth->allow('index','category','ajax_categ');
        $this->loadModel('User');
        $userData = $this->User->read(null,$this->Session->read('Auth.User.id'));//$this->Session->read('Auth');
        $this->set(compact('userData'));
    }
	
	public function index() {
		
	}

    public function category() {


        $limit = 10;

        $conditions = array();


        if ($this->RequestHandler->isAjax()) {
                $this->layout = "";
        }

        $userData = $this->Session->read('Auth');

        $this->ItemTypeHolder->bind(array('ItemCategoryHolder',));

        if ( (empty($this->params['named']['model'])) ||  $this->params['named']['model'] == 'ItemCategoryHolder' ) {
            
            $this->paginate['ItemCategoryHolder'] = array(
                'conditions' => $conditions,
                'limit' => $limit,
                'fields' => array('id', 'name', 'created','modified','ItemCategoryHolder.name'),
            );

            $categoryData = $this->paginate('ItemCategoryHolder');

        }

        $categoryDataDropList = $this->ItemCategoryHolder->find('list',  array('order' => 'ItemCategoryHolder.id DESC'));

        if ( (empty($this->params['named']['model'])) ||  $this->params['named']['model'] == 'ItemTypeHolder' ) {
            $this->paginate['ItemTypeHolder'] = array(
                'conditions' => $conditions,
                'limit' => $limit,
                'fields' => array('id', 'name', 'created','ItemCategoryHolder.name'),
            );

            $nameTypeData = $this->paginate('ItemTypeHolder');

        }   

        if ($this->request->is('post')) {

            $categoryDetails = $this->request->data;
            
            if (!empty($this->request->data)) {

                    $userData = $this->Session->read('Auth');
                    $categoryDetails['ItemCategoryHolder']['created_by'] = $userData['User']['id'];
                    $categoryDetails['ItemCategoryHolder']['modified_by'] = $userData['User']['id'];

                $this->ItemCategoryHolder->save($categoryDetails);

                $this->Session->setFlash(__('Add Category Complete.'));

                $this->redirect(

                    array('controller' => 'settings', 'action' => 'category')
                );
            }
        }

        $this->set(compact('categoryDataDropList', 'categoryData','nameTypeData' ));
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

    public function category_index() {

    }

    public function category_option() {
                    
    }

    public function category_find($id) {


        $this->layout = false;

        if (!empty($id)) {

            $category = $this->ItemCategoryHolder->findById($id);

            echo json_encode($category);

        }
         $this->autoRender = false;
         exit();
    

    }

    public function name_type() {

        $userData = $this->Session->read('Auth');

        $nameTypeData = $this->ItemTypeHolder->find('all',  array('order' => 'ItemTypeHolder.id DESC'));

        $categoryTable = $this->ItemCategoryHolder->find('list', array('ItemCategoryHolder.name'));

            if ($this->request->is('post')) {
                
                if (!empty($this->request->data)) {

                    $this->ItemTypeHolder->save($this->request->data);

                    $this->ItemTypeHolder->save($this->request->data);
                
                    $this->Session->setFlash(__('Add Name Type Complete.'));

                    return $this->redirect(array('action' => 'category#tab-type'));
                }
            }

            $this->set(compact('nameTypeData'));
	}

        public function name_type_edit($id = null) {

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
                   return $this->redirect(array('action' => 'category#tab-type'));
               }
                $this->Session->setFlash(__('Unable to update your post.'));
            }

            if (!$this->request->data) {
                $this->request->data = $post;
            }

            $this->set(compact('categoryDataDropList', 'categoryData','nameTypeData' ));
    }

    public function status() {

        $userData = $this->Session->read('Auth');
        
        $this->loadModel('StatusFieldHolder');

        $limit = 10;

        $conditions = array();

        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'fields' => array('id', 'status','created'),
            'order' => 'StatusFieldHolder.id DESC',
        );

        $statusData = $this->paginate('StatusFieldHolder');

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

    public function deleteStatus($id) {

         $this->loadModel('StatusFieldHolder');
           
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

         $this->loadModel('StatusFieldHolder');

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

    public function supplier() {

        $userData = $this->Session->read('Auth');

        $this->loadModel('Supplier');

        $limit = 10;

        $conditions = array();

        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'fields' => array('id', 'name', 'description','created'),
            'order' => 'Supplier.id DESC',
        );

        $supplierData = $this->paginate('Supplier');

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

        if ($this->ItemTypeHolder->delete($id)) {

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
         
    public function packaging() {

        $this->loadModel('PackagingHolder');

        $userData = $this->Session->read('Auth');

        $limit = 10;

        $conditions = array();

        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'fields' => array('id', 'name','created'),
            'order' => 'PackagingHolder.id DESC',
        );

        $packagingData = $this->paginate('PackagingHolder');

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

        $this->loadModel('PackagingHolder');

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

        $this->loadModel('PackagingHolder');
      
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

                $limit = 10;

                $conditions = array();

                $this->paginate = array(
                    'conditions' => $conditions,
                    'limit' => $limit,
                    'fields' => array('id', 'name','created'),
                    'order' => 'PaymentTermHolder.id DESC',
                );

                $paymentTermData = $this->paginate('PaymentTermHolder');

                if ($this->request->is('post')) {
                    
                    if (!empty($this->request->data)) {

                        $this->PaymentTermHolder->create();

                        $this->id = $this->PaymentTermHolder->savePaymentTerm($this->request->data['PaymentTermHolder'], $userData['User']['id']);

                        $this->Session->setFlash(__('Add Term Complete.'));

                        $this->redirect(

                            array('controller' => 'settings', 'action' => 'payment_term')
                        );
                    }
                }

                $this->set(compact('paymentTermData'));
    }
 
    public function payment_term_edit($id = null) {

        $this->loadModel('PaymentTermHolder');

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

       public function deletePaymentTerm($id) {

        $this->loadModel('PaymentTermHolder');
      
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

    // public function deleteProduct($id) {
      
    //     if ($this->Product->delete($id)) {
            
    //         $this->Session->setFlash(
    //             __('Successfully deleted.', h($id))
    //         );
    //     } else {
    //         $this->Session->setFlash(
    //             __('The post cannot be deleted.', h($id))
    //         );
    //     }

    //     return $this->redirect(array(' controller' => 'products', 'action' => 'index'));
    // }

      public function item_group() {

        $this->loadModel('Supplier');

        $this->loadModel('GeneralItem');

        $this->loadModel('Substrate');

        $this->loadModel('CompoundSubstrate');

        $this->loadModel('CorrugatedPaper');

        $this->ItemTypeHolder->bind(array('ItemCategoryHolder'));

        $categoryData = $this->ItemCategoryHolder->find('list', array('fields' => array('id', 'name'),
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1'),
                                                                'order' => 'ItemCategoryHolder.name ASC'));
     
        $typeData = $this->ItemTypeHolder->find('list', array('fields' => array('id', 'name'),
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1'),
                                                                'order' => 'ItemTypeHolder.name ASC'));

        $categoryDataDropList = $this->ItemCategoryHolder->find('list',  array('order' => 'ItemCategoryHolder.name ASC'));

        $supplierData = $this->Supplier->find('list',  array('order' => 'Supplier.name ASC'));

        //general item
         $this->GeneralItem->bind(array('ItemCategoryHolder', 'ItemTypeHolder', 'Supplier'));

         if ( (empty($this->params['named']['model'])) ||  $this->params['named']['model'] == 'GeneralItem' ) {
          
           $this->paginate['GeneralItem'] = array(
                'conditions' =>  array(),
                'limit' => 10,
                'order' => 'GeneralItem.id DESC'
            );

            $generalItemData = $this->paginate('GeneralItem');

        }
       
        //substrateData
          $this->Substrate->bind(array('ItemCategoryHolder', 'ItemTypeHolder', 'Supplier'));

         if ( (empty($this->params['named']['model'])) ||  $this->params['named']['model'] == 'Substrate' ) {
            
            $this->paginate['Substrate'] = array(
                'conditions' =>  array(),
                'limit' => 10,
                'order' => 'Substrate.id DESC'
            );

            $substrateData = $this->paginate('Substrate');

        }
       
          //Compound substrateData
         $this->CompoundSubstrate->bind(array('ItemCategoryHolder', 'ItemTypeHolder', 'Supplier'));

        if ( (empty($this->params['named']['model'])) ||  $this->params['named']['model'] == 'CompoundSubstrate' ) {
            
            $this->paginate['CompoundSubstrate'] = array(
                'conditions' =>  array(),
                'limit' => 10,
                'order' => 'CompoundSubstrate.id DESC'
            );

            $compoundSubstrateData = $this->paginate('CompoundSubstrate');

        }

          //Corrugated Paper
         $this->CorrugatedPaper->bind(array('ItemCategoryHolder', 'ItemTypeHolder', 'Supplier', 'ItemGroupLayer'));

        if ( (empty($this->params['named']['model'])) ||  $this->params['named']['model'] == 'CorrugatedPaper' ) {
            
            $this->paginate['CorrugatedPaper'] = array(
                'conditions' =>  array(),
                'limit' => 10,
                'order' => 'CorrugatedPaper.id DESC'
            );

            $corrugatedPaperData = $this->paginate('CorrugatedPaper');

        }


       if ($this->request->is('post')) {
               
               $generalItemDetails = $this->request->data;
          
            if (!empty($generalItemDetails)) {

                $userData = $this->Session->read('Auth');
                $generalItemDetails['GeneralItem']['uuid'] = time();
                $generalItemDetails['GeneralItem']['created_by'] = $userData['User']['id'];
                $generalItemDetails['GeneralItem']['modified_by'] = $userData['User']['id'];

                $this->GeneralItem->save($generalItemDetails);

                $this->Session->setFlash(__('Adding General Item Complete.'));

                $this->redirect(

                    array('controller' => 'settings', 'action' => 'item_group')
                );
            }
        }

        $this->set(compact('categoryDataDropList', 'categoryData','typeData', 'supplierData', 'generalItemData','substrateData', 'compoundSubstrateData', 'corrugatedPaperData'));

    }

    public function deleteGeneralItem($id) {

        $this->loadModel('GeneralItem');
      
        if ($this->GeneralItem->delete($id)) {
            
            $this->Session->setFlash(
                __('Successfully deleted.', h($id))
            );
        } else {
            $this->Session->setFlash(
                __('The post cannot be deleted.', h($id))
            );
        }

        return $this->redirect(array(' controller' => 'settings', 'action' => 'item_group'));
    } 

    public function general_item_edit($id = null) {

        $this->loadModel('Supplier');

        $this->loadModel('GeneralItem');

        $this->ItemTypeHolder->bind(array('ItemCategoryHolder'));

       $this->GeneralItem->bind(array('ItemCategoryHolder','ItemTypeHolder', 'Supplier'));

        $categoryData = $this->ItemCategoryHolder->find('list', array('fields' => array('id', 'name'),
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1'),
                                                                'order' => 'ItemCategoryHolder.name ASC'));
     
        $typeData = $this->ItemTypeHolder->find('list', array('fields' => array('id', 'name'),
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1'),
                                                                'order' => 'ItemTypeHolder.name ASC'));

        $supplierData = $this->Supplier->find('list',  array('order' => 'Supplier.name ASC'));


            if (!$id) {
                throw new NotFoundException(__('Invalid post'));
            }

            $post = $this->GeneralItem->findById($id);

            if (!$post) {
                throw new NotFoundException(__('Invalid post'));
            }

            if ($this->request->is(array('post', 'put'))) {
                $this->GeneralItem->id = $id;

                if ($this->GeneralItem->save($this->request->data)) {

                    $this->GeneralItem->save($this->request->data);

                    $this->Session->setFlash(__('General Item has been updated.'));

                    return $this->redirect(array('action' => 'item_group'));
                }
                $this->Session->setFlash(__('Unable to update your post.'));
            }

            if (!$this->request->data) {
                $this->request->data = $post;
            }

            $this->set(compact('generalItemData', 'categoryData' , 'typeData', 'supplierData' ));
    }

    public function view_general_item($id){

        $this->loadModel('Supplier');

        $this->loadModel('GeneralItem');

        $this->ItemTypeHolder->bind(array('ItemCategoryHolder'));

        $this->GeneralItem->bind(array('ItemCategoryHolder','ItemTypeHolder', 'Supplier'));

        $categoryData = $this->ItemCategoryHolder->find('list', array('fields' => array('id', 'name'),
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1'),
                                                                'order' => 'ItemCategoryHolder.name ASC'));
     
        $typeData = $this->ItemTypeHolder->find('list', array('fields' => array('id', 'name'),
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1'),
                                                                'order' => 'ItemTypeHolder.name ASC'));

        $supplierData = $this->Supplier->find('list',  array('order' => 'Supplier.name ASC'));

        $post = $this->GeneralItem->findById($id);

            if (!$this->request->data) {
                $this->request->data = $post;
            }

            $this->set(compact( 'categoryData' , 'typeData', 'supplierData' ));
    }

    public function substrate() {

        $this->loadModel('Substrate');

        $substrateData = $this->Substrate->find('all',  array('order' => 'Substrate.id DESC','limit'=>4, 'offset'=>3));

        $userData = $this->Session->read('Auth');

            if ($this->request->is('post')) {

                 $substrateDetails = $this->request->data;
                
                if (!empty($substrateDetails)) {

                    $userData = $this->Session->read('Auth');
                    $substrateDetails['Substrate']['uuid'] = time();
                    $substrateDetails['Substrate']['created_by'] = $userData['User']['id'];
                    $substrateDetails['Substrate']['modified_by'] = $userData['User']['id'];

                    $this->Substrate->save($substrateDetails);
           
                    $this->Session->setFlash(__('Adding Substrate Complete.'));

                    return $this->redirect(array('action' => 'item_group','tab' => 'tab-substrates'));
                }
            }

            $this->set(compact('substrateData'));
    }

    public function substrate_edit($id = null) {

        $this->loadModel('Substrate');

        $this->loadModel('Supplier');

        $this->loadModel('GeneralItem');

        $this->ItemTypeHolder->bind(array('ItemCategoryHolder'));

        $this->Substrate->bind(array('ItemCategoryHolder','ItemTypeHolder', 'Supplier'));

        $categoryData = $this->ItemCategoryHolder->find('list', array('fields' => array('id', 'name'),
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1'),
                                                                'order' => 'ItemCategoryHolder.name ASC'));
     
        $typeData = $this->ItemTypeHolder->find('list', array('fields' => array('id', 'name'),
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1'),
                                                                'order' => 'ItemTypeHolder.name ASC'));

        $supplierData = $this->Supplier->find('list',  array('order' => 'Supplier.name ASC'));


            if (!$id) {
                throw new NotFoundException(__('Invalid post'));
            }

            $post = $this->Substrate->findById($id);

            if (!$post) {
                throw new NotFoundException(__('Invalid post'));
            }

            if ($this->request->is(array('post', 'put'))) {
                $this->Substrate->id = $id;

                if ($this->Substrate->save($this->request->data)) {

                    $this->Substrate->save($this->request->data);

                    $this->Session->setFlash(__('Substrate has been updated.'));

                    return $this->redirect(array('action' => 'item_group','tab' => 'tab-substrates'));
                }
                $this->Session->setFlash(__('Unable to update your post.'));
            }

            if (!$this->request->data) {
                $this->request->data = $post;
            }


            $this->set(compact( 'categoryData' , 'typeData', 'supplierData' ));
    }

    public function deleteSubstrate($id) {

        $this->loadModel('Substrate');
      
        if ($this->Substrate->delete($id)) {
            
            $this->Session->setFlash(
                __('Successfully deleted.', h($id))
            );
        } else {
            $this->Session->setFlash(
                __('The post cannot be deleted.', h($id))
            );
        }

        return $this->redirect(array(' controller' => 'settings', 'action' => 'item_group','tab' => 'tab-substrate'));
    } 


    public function view_substrate($id){

        $this->loadModel('Supplier');

        $this->loadModel('Substrate');

        $this->ItemTypeHolder->bind(array('ItemCategoryHolder'));

        $this->Substrate->bind(array('ItemCategoryHolder','ItemTypeHolder', 'Supplier'));

        $categoryData = $this->ItemCategoryHolder->find('list', array('fields' => array('id', 'name'),
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1'),
                                                                'order' => 'ItemCategoryHolder.name ASC'));
     
        $typeData = $this->ItemTypeHolder->find('list', array('fields' => array('id', 'name'),
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1'),
                                                                'order' => 'ItemTypeHolder.name ASC'));

        $supplierData = $this->Supplier->find('list',  array('order' => 'Supplier.id DESC'));

        $post = $this->Substrate->findById($id);

            if (!$this->request->data) {
                $this->request->data = $post;
            }

            $this->set(compact( 'categoryData' , 'typeData', 'supplierData' ));
    }

    public function compound_substrate() {

        $this->loadModel('CompoundSubstrate');

        $this->loadModel('ItemGroupLayer');

        $this->CompoundSubstrate->bind(array('ItemGroupLayer'));

        $compoundSubstrateData = $this->CompoundSubstrate->find('all',  array('order' => 'CompoundSubstrate.id DESC','limit'=>4, 'offset'=>3));

        $userData = $this->Session->read('Auth');

            if (!empty($this->request->data)) {

                if(!empty($this->request->data['IdHolder'])){
                
                    foreach ($this->request->data['IdHolder'] as $key => $value) {
                        $this->ItemGroupLayer->delete($value);
                    }

                }

                $this->id = $this->CompoundSubstrate->saveCompound($this->request->data,$userData['User']['id']);

                $this->ItemGroupLayer->addItemgroupLayer($this->request->data,$this->id);

                if(!empty($this->request->data['IdHolder'])){

                    $this->Session->setFlash(__('Edit Compound Substrate Complete.'));

                }else{

                    $this->Session->setFlash(__('Adding Compound Substrate Complete.'),'success');

                }
            
                return $this->redirect(array('action' => 'item_group','tab' => 'tab-compound_substrates'));

            }

            $this->set(compact('compoundSubstrateData'));
    
    }
    public function compound_substrate_edit($id = null) {

        $this->loadModel('Supplier');

        $this->loadModel('CompoundSubstrate');

        $this->loadModel('ItemGroupLayer');

        $this->ItemTypeHolder->bind(array('ItemCategoryHolder'));

        $this->CompoundSubstrate->bind(array('ItemCategoryHolder','ItemTypeHolder', 'Supplier','ItemGroupLayer'));

        $categoryData = $this->ItemCategoryHolder->find('list', array('fields' => array('id', 'name'),
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1'),
                                                                'order' => 'ItemCategoryHolder.name ASC'));
     
        $typeData = $this->ItemTypeHolder->find('list', array('fields' => array('id', 'name'),
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1'),
                                                                'order' => 'ItemTypeHolder.name ASC'));

        $supplierData = $this->Supplier->find('list',  array('order' => 'Supplier.name ASC'));

        $compoundsubstrateData = $this->ItemGroupLayer->find('all', array('conditions' => array('ItemGroupLayer.foreign_key' => $id, 'ItemGroupLayer.model' => 'CompoundSubstrate' )
                                                                          ));

            if (!$id) {

                throw new NotFoundException(__('Invalid post'));
            }

            $post = $this->CompoundSubstrate->findById($id);

            if (!$post) {
                throw new NotFoundException(__('Invalid post'));
            }

            if ($this->request->is(array('post', 'put'))) {

                //pr($this->request->data);exit;

                $paperHolderId = array();

                foreach ($this->request->data['ItemGroupLayer']['substrate'] as $key => $idList) {
                        array_push($paperHolderId, $idList['id']); 
                }

                $this->CompoundSubstrate->id = $id;

               

                $this->CompoundSubstrate->save($this->request->data);

                if ($this->CompoundSubstrate->save($this->request->data)) {

                     foreach ($compoundsubstrateData as $key => $paper) {

                        if(in_array($paper['ItemGroupLayer']['id'], $paperHolderId)){

                            //pr($this->request->data['ItemGroupLayer']['substrate'][$key]);
                            $this->ItemGroupLayer->save($this->request->data['ItemGroupLayer']['substrate'][$key]);
                            
                        }else{

                            $this->ItemGroupLayer->delete($paper['ItemGroupLayer']['id']);
                        }
                    }

                   // $this->CompoundSubstrate->save_substrate($this->request->data,$this->CompoundSubstrate->id); 

                    $this->Session->setFlash(__('Compound Substrate has been updated.'));

                    return $this->redirect(array('action' => 'item_group','tab' => 'tab-compound_substrates'));
                }
                $this->Session->setFlash(__('Unable to update your post.'));
            }

            if (!$this->request->data) {
                $this->request->data = $post;
            }

            $this->set(compact( 'categoryData' , 'typeData', 'supplierData' ));
    }


    public function deleteCompoundSubstrate($id) {

        $this->loadModel('CompoundSubstrate');
      
        if ($this->CompoundSubstrate->delete($id)) {
            
            $this->Session->setFlash(
                __('Successfully deleted.', h($id))
            );
        } else {
            $this->Session->setFlash(
                __('The post cannot be deleted.', h($id))
            );
        }

        return $this->redirect(array(' controller' => 'settings', 'action' => 'item_group','tab' => 'tab-compound_substrates'));
    }

    public function view_compound_substrate($id){

        $this->loadModel('Supplier');

        $this->loadModel('CompoundSubstrate');

        $this->ItemTypeHolder->bind(array('ItemCategoryHolder'));

        $this->CompoundSubstrate->bind(array('ItemCategoryHolder','ItemTypeHolder', 'Supplier', 'ItemGroupLayer'));

        $categoryData = $this->ItemCategoryHolder->find('list', array('fields' => array('id', 'name'),
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1'),
                                                                'order' => 'ItemCategoryHolder.name ASC'));
     
        $typeData = $this->ItemTypeHolder->find('list', array('fields' => array('id', 'name'),
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1'),
                                                                'order' => 'ItemTypeHolder.name ASC'));

        $supplierData = $this->Supplier->find('list',  array('order' => 'Supplier.name ASC'));

        $compoundData = $this->CompoundSubstrate->findById($id);

        $compoundLayer = $this->CompoundSubstrate->ItemGroupLayer->find('all',array(
                                    'conditions' => array('AND' => array(
                                        array('ItemGroupLayer.foreign_key' => $compoundData['CompoundSubstrate']['id']),
                                        array('ItemGroupLayer.model' => 'CompoundSubstrate')
                                        ))));
       
            if (!$this->request->data) {
                $this->request->data = $compoundData;
            }

            $this->set(compact( 'categoryData' , 'typeData', 'supplierData','compoundLayer' ));
    }


    public function corrugated_paper() {

        $this->loadModel('CorrugatedPaper');

        $this->loadModel('ItemGroupLayer');

        $corrugatedPaperData = $this->CorrugatedPaper->find('all',  array('order' => 'CorrugatedPaper.id DESC','limit'=>4, 'offset'=>3));

        $userData = $this->Session->read('Auth');

        if (!empty($this->request->data)) {
            
            if(!empty($this->request->data['IdHolder'])){
                
                foreach ($this->request->data['IdHolder'] as $key => $value) {
                    $this->ItemGroupLayer->delete($value);
                }

            }

            $this->id = $this->CorrugatedPaper->saveCorrugated($this->request->data,$userData['User']['id']);

            $this->ItemGroupLayer->addItemgroupLayer($this->request->data,$this->id);

            if(!empty($this->request->data['IdHolder'])){

                $this->Session->setFlash(__('Edit Corrugated Paper Complete.'),'success');

            }else{

                $this->Session->setFlash(__('Adding Corrugated Paper Complete.'),'success');

            }
            
            return $this->redirect(array('action' => 'item_group','tab' => 'tab-corrugated_papers'));

        }

        $this->set(compact('corrugatedPaperData'));    
        
    }


     public function corrugated_paper_edit($id = null) {

        //pr($id); exit;

        $this->loadModel('Supplier');

        $this->loadModel('CorrugatedPaper');

        $this->loadModel('ItemGroupLayer');

        $this->ItemTypeHolder->bind(array('ItemCategoryHolder'));

        $this->CorrugatedPaper->bind(array('ItemCategoryHolder','ItemTypeHolder', 'Supplier', 'ItemGroupLayer'));

        $categoryData = $this->ItemCategoryHolder->find('list', array('fields' => array('id', 'name'),
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1'),
                                                                'order' => 'ItemCategoryHolder.name ASC'));
     
        $typeData = $this->ItemTypeHolder->find('list', array('fields' => array('id', 'name'),
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1'),
                                                                'order' => 'ItemTypeHolder.name ASC'));
        $supplierData = $this->Supplier->find('list',  array('order' => 'Supplier.name ASC'));

        //$itemGroupLayerData = $this->ItemGroupLayer->find('all', array('conditions' => array('ItemGroupLayer.foreign_key' => 'CorrugatedPaper.id')));

        //foreach ($this->request->data['ItemGroupLayer'] as $key => $itemGroupData): 

       


            if (!$id) {
                throw new NotFoundException(__('Invalid post'));
            }

            $post = $this->CorrugatedPaper->findById($id);

            if (!$post) {
                throw new NotFoundException(__('Invalid post'));
            }

            if ($this->request->is(array('post', 'put'))) {

                $paperHolderId = array();
             
                foreach ($this->request->data['ItemGroupLayer'] as $key => $idList) {
                        array_push($paperHolderId, $idList['id']); 
                }
                
                $this->CorrugatedPaper->id = $id;
   
                $dataHolder = array();

                $alldatapaper = $this->ItemGroupLayer->find('all', array('conditions' => array('ItemGroupLayer.foreign_key' => $id, 'ItemGroupLayer.model' => 'CorrugatedPaper' ),
                                                                            'fields' => array('id' ,'foreign_key')
                                                                          ));

                    foreach ($alldatapaper as $key => $paper) {

                        if(in_array($paper['ItemGroupLayer']['id'], $paperHolderId)){

                            $this->ItemGroupLayer->save($this->request->data['ItemGroupLayer'][$key]);
                            
                        }else{

                            $this->ItemGroupLayer->delete($paper['ItemGroupLayer']['id']);
                        }
                    }

                    $this->CorrugatedPaper->save($this->request->data);

                    $this->Session->setFlash(__('Corrugated Paper has been updated.'));

                    return $this->redirect(array('action' => 'item_group','tab' => 'tab-corrugated_papers'));

                $this->Session->setFlash(__('Unable to update your post.'));
            }

            if (!$this->request->data) {
                $this->request->data = $post;
            }

            $this->set(compact( 'categoryData','typeData','supplierData', 'itemGroupLayerData' ));
    }

     public function deleteCorrugatedPaper($id) {

        $this->loadModel('CorrugatedPaper');
      
        if ($this->CorrugatedPaper->delete($id)) {
            
            $this->Session->setFlash(
                __('Successfully deleted.', h($id))
            );
        } else {
            $this->Session->setFlash(
                __('The post cannot be deleted.', h($id))
            );
        }

        return $this->redirect(array(' controller' => 'settings', 'action' => 'item_group','tab' => 'tab-corrugated_papers'));
    }

    public function view_corrugated_paper($id){


        $this->loadModel('Supplier');

        $this->loadModel('CorrugatedPaper');



        $this->ItemTypeHolder->bind(array('ItemCategoryHolder'));

        $this->CorrugatedPaper->bind(array('ItemCategoryHolder','ItemTypeHolder', 'Supplier', 'ItemGroupLayer'));

        $categoryData = $this->ItemCategoryHolder->find('list', array('fields' => array('id', 'name'),
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1'),
                                                                'order' => 'ItemCategoryHolder.name ASC'));
     
        $typeData = $this->ItemTypeHolder->find('list', array('fields' => array('id', 'name'),
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1'),
                                                                'order' => 'ItemTypeHolder.name ASC'));

        $supplierData = $this->Supplier->find('list',  array('order' => 'Supplier.name ASC'));

        $corrugatedData = $this->CorrugatedPaper->findById($id);

        $corrugatedLayer = $this->CorrugatedPaper->ItemGroupLayer->find('all',array(
                                    'conditions' => array('AND' => array(
                                        array('ItemGroupLayer.foreign_key' => $corrugatedData['CorrugatedPaper']['id']),
                                        array('ItemGroupLayer.model' => 'CorrugatedPaper')
                                        ))));
       
        if (!$this->request->data) {
            $this->request->data = $corrugatedData;
        }

        $this->set(compact( 'categoryData','typeData' , 'supplierData','corrugatedLayer'));
    }

    public function process() {

        $this->loadModel('Process');

        $this->loadModel('SubProcess');

        $userData = $this->Session->read('Auth');

        $processDataDropList = $this->Process->find('list',  array('order' => 'Process.id DESC'));

        $this->SubProcess->bind(array('Process',));

        $limit = 10;

        $conditions = array();


        if ($this->RequestHandler->isAjax()) {
                $this->layout = "";
        }

  if ( (empty($this->params['named']['model'])) ||  $this->params['named']['model'] == 'Process' ) {
            
            $this->paginate['Process'] = array(
                'conditions' => $conditions,
                'limit' => $limit,
                'fields' => array('id', 'name', 'created','modified'),
                'order' => 'Process.id DESC'
            );

            $processData = $this->paginate('Process');

        }

    if ( (empty($this->params['named']['model'])) ||  $this->params['named']['model'] == 'SubProcess' ) {
            $this->paginate['SubProcess'] = array(
                'conditions' => $conditions,
                'limit' => $limit,
                'fields' => array('id', 'name', 'created','Process.name'),
            );

            $SubProcessData = $this->paginate('SubProcess');

        }    

            if ($this->request->is('post')) {
                
                if (!empty($this->request->data)) {
                   
                    $this->Process->create();

                    $this->id = $this->Process->saveProcess($this->request->data['Process'], $userData['User']['id']);
           
                    $this->Session->setFlash(__('Add Process Complete.'));

                    $this->redirect(
                        array('controller' => 'settings', 'action' => 'process','tab' => 'tab-process')
                    );
                }
            }

        $this->set(compact('processData', 'processDataDropList', 'SubProcessData'));
    }

     public function process_edit($id = null) {

        $this->loadModel('Process');

            if (!$id) {
                throw new NotFoundException(__('Invalid post'));
            }

            $post = $this->Process->findById($id);
            if (!$post) {
                throw new NotFoundException(__('Invalid post'));
            }

            if ($this->request->is(array('post', 'put'))) {
                $this->Process->id = $id;

                if ($this->Process->save($this->request->data)) {

                    $this->Process->save($this->request->data);

                    $this->Session->setFlash(__('Process has been updated.'));

                    return $this->redirect(array('action' => 'process','tab' => 'tab-process'));
                }

                $this->Session->setFlash(__('Unable to update your post.'));
            }

            if (!$this->request->data) {

                $this->request->data = $post;
            }
    }

    public function deleteProcess($id) {

        $this->loadModel('Process');
      
        if ($this->Process->delete($id)) {

            $this->Session->setFlash(

                __('Successfully deleted.', h($id))
            );

        } else {

            $this->Session->setFlash(

                __('The post cannot be deleted.', h($id))
            );
        }

        return $this->redirect(array('action' => 'process','tab' => 'tab-process'));

    }

        public function sub_process() {

        $this->loadModel('SubProcess');

        $userData = $this->Session->read('Auth');

        $processDataDropList = $this->ItemCategoryHolder->find('list',  array('order' => 'ItemCategoryHolder.id DESC'));

        $subProcessData = $this->SubProcess->find('all',  array('order' => 'SubProcess.id DESC'));

        $categoryTable = $this->ItemCategoryHolder->find('list', array('ItemCategoryHolder.name'));

         if ($this->request->is('post')) {
                
                if (!empty($this->request->data)) {
                   
                    $this->SubProcess->create();

                    $this->id = $this->SubProcess->saveSubProcess($this->request->data['SubProcess'], $userData['User']['id']);
           
                    $this->Session->setFlash(__('Add Sub Process Complete.'));

                    $this->redirect(
                        array('controller' => 'settings', 'action' => 'process','tab' => 'tab-sub_process')
                    );
                }
            }

            $this->set(compact('processDataDropList'));
    }

    public function sub_process_edit($id = null) {

        $this->loadModel('SubProcess');

        $this->loadModel('Process');

        $this->SubProcess->bind(array('Process',));

        $subProcessDropList = $this->Process->find('list',  array('order' => 'Process.id DESC'));

            if (!$id) {
                throw new NotFoundException(__('Invalid post'));
            }

            $post = $this->SubProcess->findById($id);
            if (!$post) {
                throw new NotFoundException(__('Invalid post'));
            }

            if ($this->request->is(array('post', 'put'))) {
                $this->SubProcess->id = $id;

                if ($this->SubProcess->save($this->request->data)) {

                    $this->SubProcess->save($this->request->data);

                    $this->Session->setFlash(__('Sub Process has been updated.'));

                    return $this->redirect(array('action' => 'process','tab' => 'tab-sub_process'));
                }

                $this->Session->setFlash(__('Unable to update your post.'));
            }

            if (!$this->request->data) {

                $this->request->data = $post;
            }

        $this->set(compact('subProcessDropList'));
    }

    public function deleteSubProcess($id) {

        $this->loadModel('SubProcess');
      
        if ($this->SubProcess->delete($id)) {

            $this->Session->setFlash(

                __('Successfully deleted.', h($id))
            );

        } else {

            $this->Session->setFlash(

                __('The post cannot be deleted.', h($id))
            );
        }

        return $this->redirect(array('action' => 'process' ,'tab' => 'tab-sub_process'));

    }

     public function unit() {

        $this->loadModel('Unit');

        $userData = $this->Session->read('Auth');

        $limit = 10;

        $conditions = array();

        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'fields' => array('id', 'unit','created'),
            'order' => 'Unit.id DESC',
        );

        $unitData = $this->paginate('Unit');

            if ($this->request->is('post')) {
                
                if (!empty($this->request->data)) {
                   
                    $this->Unit->create();

                    $this->id = $this->Unit->saveUnit($this->request->data['Unit'], $userData['User']['id']);
           
                    $this->Session->setFlash(__('Add Unit Complete.'));

                    $this->redirect(
                        array('controller' => 'settings', 'action' => 'unit')
                    );
                }
            }

        $this->set(compact('unitData'));
    }

    public function unit_edit($id = null) {

        $this->loadModel('Unit');

            if (!$id) {
                throw new NotFoundException(__('Invalid post'));
            }

            $post = $this->Unit->findById($id);
            if (!$post) {
                throw new NotFoundException(__('Invalid post'));
            }

            if ($this->request->is(array('post', 'put'))) {
                $this->Unit->id = $id;

                if ($this->Unit->save($this->request->data)) {

                    $this->Unit->save($this->request->data);

                    $this->Session->setFlash(__('Unit has been updated.'));

                    return $this->redirect(array('action' => 'unit'));
                }

                $this->Session->setFlash(__('Unable to update your post.'));
            }

            if (!$this->request->data) {

                $this->request->data = $post;
            }
    }

    public function deleteUnit($id) {

        $this->loadModel('Unit');
      
        if ($this->Unit->delete($id)) {

            $this->Session->setFlash(

                __('Successfully deleted.', h($id))
            );

        } else {

            $this->Session->setFlash(

                __('The post cannot be deleted.', h($id))
            );
        }

        return $this->redirect(array('action' => 'unit'));
    }

     public function currency() {

        $this->loadModel('Currency');

        $userData = $this->Session->read('Auth');

        $limit = 10;

        $conditions = array();

        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'fields' => array('id', 'name','created'),
            'order' => 'Currency.id DESC',
        );

        $currencyData = $this->paginate('Currency');

            if ($this->request->is('post')) {
                
                if (!empty($this->request->data)) {
                   
                    $this->Currency->create();

                    $this->id = $this->Currency->saveCurrency($this->request->data['Currency'], $userData['User']['id']);
           
                    $this->Session->setFlash(__('Add Currency Complete.'));

                    $this->redirect(
                        array('controller' => 'settings', 'action' => 'currency')
                    );
                }
            }

        $this->set(compact('currencyData'));
    }

    public function currency_edit($id = null) {

            $this->loadModel('Currency');

                if (!$id) {
                    throw new NotFoundException(__('Invalid post'));
                }

                $post = $this->Currency->findById($id);
                if (!$post) {
                    throw new NotFoundException(__('Invalid post'));
                }

                if ($this->request->is(array('post', 'put'))) {
                    $this->Currency->id = $id;

                    if ($this->Currency->save($this->request->data)) {

                        $this->Currency->save($this->request->data);

                        $this->Session->setFlash(__('Currency has been updated.'));

                        return $this->redirect(array('action' => 'currency'));
                    }

                    $this->Session->setFlash(__('Unable to update your post.'));
                }

                if (!$this->request->data) {

                    $this->request->data = $post;
                }
        }    

    public function deleteCurrency($id) {

        $this->loadModel('Currency');
      
        if ($this->Currency->delete($id)) {

            $this->Session->setFlash(

                __('Successfully deleted.', h($id))
            );

        } else {

            $this->Session->setFlash(

                __('The post cannot be deleted.', h($id))
            );
        }

        return $this->redirect(array('action' => 'currency'));
    }

    public function ajax_categ($itemId = false){


        $this->autoRender = false;

        $this->loadModel('ItemCategoryHolder');
        $this->ItemCategoryHolder->bind(array('ItemTypeHolder'));

        $itemdata = $this->ItemCategoryHolder->ItemTypeHolder->find('all', array(
                                        'conditions' => array(
                                            'ItemTypeHolder.Item_category_holder_id' => $itemId), 
                                        'fields' => array(
                                            'id', 'name'),
                                        'order' => 'ItemTypeHolder.name ASC'
                                        ));
       
       echo json_encode($itemdata);
    }

    public function ajax_categ_substrate($itemId = false){


        $this->autoRender = false;

        $this->loadModel('ItemCategoryHolder');
        $this->ItemCategoryHolder->bind(array('ItemTypeHolder'));

        $itemdata = $this->ItemCategoryHolder->ItemTypeHolder->find('all', array(
                                        'conditions' => array(
                                            'ItemTypeHolder.Item_category_holder_id' => $itemId), 
                                        'fields' => array(
                                            'id', 'name'),
                                        'order' => 'ItemTypeHolder.name ASC'
                                        ));
        //pr($itemdata);exit();
       echo json_encode($itemdata);
    }

    public function acl(){

        $this->loadModel('Role');
        $this->loadModel('Permission');

        $userData = $this->Session->read('Auth');

        $roleTable = $this->Role->find('all', array(
                                        'fields' => array(
                                            'id', 'name','created'),
                                        'order' => 'Role.id DESC'
                                        ));

         $permissionTable = $this->Permission->find('all', array(
                                        'fields' => array(
                                            'id', 'name','created'),
                                        'order' => 'Permission.id DESC'
                                        ));
       
        if ($this->request->is('post')) {
            
            if (!empty($this->request->data)) {
               
                if(!empty($this->request->data['Role'])){
                    
                    $this->Role->saveRole($this->request->data,$userData['User']['id']);

                    $this->Session->setFlash(__('Role Successfully added..'));

                    $this->redirect(
                        array('controller' => 'settings', 'action' => 'acl')
                    );
                }

                if(!empty($this->request->data['Permission'])){
                    
                    $this->Permission->savePermission($this->request->data,$userData['User']['id']);

                    $this->Session->setFlash(__('Permission Successfully added..'));

                    $this->redirect(
                        array('controller' => 'settings', 'action' => 'acl')
                    );
                }
                
            } 
        }

        $this->set(compact('roleTable','permissionTable'));

    }

    public function role_edit($roleId = null){

        $userData = $this->Session->read('Auth');

        $this->loadModel('Role');

        $roleData = $this->Role->findById($roleId);

        if (!$roleData) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {

            $this->Role->id = $roleId;
           
            $this->Role->saveRole($this->request->data,$userData['User']['id']);

            $this->Session->setFlash(__('Role Successfully updated..'));

            $this->redirect(
                array('controller' => 'settings', 'action' => 'acl')
            );
        }

        if (!$this->request->data) {
            $this->request->data = $roleData;
        }

        $this->set(compact('roleId'));

    }

    public function permission_edit($permissionId = null){

        $userData = $this->Session->read('Auth');

        $this->loadModel('Permission');

        $permissionData = $this->Permission->findById($permissionId);

        if (!$permissionData) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {

            $this->Permission->id = $permissionId;

            $this->Permission->savePermission($this->request->data,$userData['User']['id']);

            $this->Session->setFlash(__('Permission Successfully updated..'));

            $this->redirect(
                array('controller' => 'settings', 'action' => 'acl')
            );
        }

        if (!$this->request->data) {
            $this->request->data = $permissionData;
        }

         $this->set(compact('permissionId'));

    }

    public function deleteAcl($aclname = null,$aclId = null){

        $this->loadModel('Role');
        $this->loadModel('Permission');

        if($aclname == 'Role'){

            $this->Role->delete($aclId);

            $this->Session->setFlash(__('Role Successfully deleted..'));

            $this->redirect(
                array('controller' => 'settings', 'action' => 'acl')
            );

        }

        if($aclname == 'Permission'){

            $this->Permission->delete($aclId);

            $this->Session->setFlash(__('Permission Successfully deleted..'));

            $this->redirect(
                array('controller' => 'settings', 'action' => 'acl')
            );

        }
        

    }

    public function role_perm(){

        $this->loadModel('User');
        $this->loadModel('Role');
        $this->loadModel('Permission');

        $userDatList = $this->User->find('list',array('fields' => array('id','fullname')));
        $roleDataListAll = $this->Role->find('list',array('fields' => array('id','name')));
        $permissionDataList = $this->Permission->find('all',array('fields' => array('id','name')));
        $roleDataListLimit = $this->Role->find('list', array(
                                            'fields' => array('id','name'),
                                            'conditions' => array('Role.id NOT' => array(1))
                                            ));
       
        if (!empty($this->request->data)) {

            if(!empty($this->request->data['Role']['id']) && ($this->request->data['User']['id'])){

                if(!empty($this->request->data)){
                    
                    $this->User->id = $this->request->data['User']['id'];
                    $this->User->saveField('role_id', $this->request->data['Role']['id']);
                    
                    $userData = $this->Session->read('Auth');

                    if ($userData['User']['id'] == $this->request->data['User']['id'] ){
                        $this->Session->write('Auth',$this->User->read(null,$this->request->data['User']['id']));
                    }
                   
                    $this->Session->setFlash(__('Permission Successfully added'),'success');

                    $this->redirect(
                        array('controller' => 'settings', 'action' => 'role_perm')
                    );
               }
            }else{

                 $this->Session->setFlash(__('You must select User and Role description'),'error');

                    $this->redirect(
                        array('controller' => 'settings', 'action' => 'role_perm')
                    );

            }   
        }

        $this->set(compact('userDatList','roleDataListAll','permissionDataList','roleDataListLimit'));
    }

    public function permissionData($roleId = null){

        $this->autoRender = false;

        $this->loadModel('RolesPermission');
        $this->loadModel('Permission');
        
        $rolepermdata = $this->RolesPermission->find('list',
                                            array('fields' => 
                                                array('RolesPermission.id',
                                                    'RolesPermission.permission_id'
                                                 ),
                                                'conditions' => array(
                                                    'RolesPermission.role_id' => $roleId
                                                ),
                                               
                                                ));

        $perdata = $this->Permission->find('all',
                                            array('fields' => 
                                                array('Permission.id',
                                                    'Permission.name'
                                                 ),
                                                'conditions' => array(
                                                    'Permission.id' => $rolepermdata
                                                ),
                                               
                                                ));
       
       echo json_encode($perdata);
    }

    public function editPermission($roleId = null){

        $this->autoRender = false;

        $this->loadModel('RolesPermission');
        $this->loadModel('Permission');
        
        $rolepermdata = $this->RolesPermission->find('list',
                                            array('fields' => 
                                                array('RolesPermission.id',
                                                    'RolesPermission.permission_id'
                                                 ),
                                                'conditions' => array(
                                                    'RolesPermission.role_id' => $roleId
                                                ),
                                               
                                                ));
       
       echo json_encode($rolepermdata);
    }

    public function role_perm_edit(){

        $this->loadModel('RolesPermission');

        $this->loadModel('Permission');

        if(!empty($this->request->data)){

            if(!empty($this->request->data['Role']['id'])){

                $RoleId = $this->request->data['Role'];

                $PermissionRoleId = $this->RolesPermission->find('list',array(
                                                'conditions' => array('RolesPermission.role_id' => $this->request->data['Role']['id'])));

                //pr($PermissionRoleId); exit;

                if (array_key_exists('Permission', $this->request->data)) { 

                        $array = $this->request->data['Permission'];

                        $userData = $this->RolesPermission->find('list',array(
                                                'conditions' => array('RolesPermission.role_id' => $this->request->data['Role']['id'])));
                        $arrayflip = array();
                        foreach ($array as $key => $arrayList) {

                            $arrayflip[] = $key;
                        }
                      
                        $ids = array();

                        foreach ($userData as $key => $userDataList) {
                             if(in_array($userDataList, $arrayflip)){
                                $ids['Permission']['approved'][] = $userDataList; 
                             }else{
                                $ids['Permission']['delete'][] = $userDataList;
                             }
                        }

                        $this->RolesPermission->delete($PermissionRoleId);

                        $this->RolesPermission->saveRoleperm($ids,$this->request->data);
                  
                        $this->Session->setFlash(__('Permission Successfully updated..'),'success');

                        $this->redirect(
                            array('controller' => 'settings', 'action' => 'role_perm')
                        );
                 }else{

                     $this->RolesPermission->delete($PermissionRoleId);

                     $this->Session->setFlash(__('Permission Successfully updated..'),'success');
                    
                    $this->redirect(
                        array('controller' => 'settings', 'action' => 'role_perm')
            );

                 }
            } else{

        $this->Session->setFlash(__('You must select a role description'),'error');

        $this->redirect(
                array('controller' => 'settings', 'action' => 'role_perm')
            );

            }
        }
    }

    public function corrugated_layer($Id = null) {

            $this->loadModel('ItemGroupLayer');

            $this->loadModel('CorrugatedPaper');

            $userData = $this->Session->read('Auth');

        if ($this->request->is('post')) {
                
                if (!empty($this->request->data)) {   // pr($this->request->data); exit;

            $itemGroupLayerData = $this->ItemGroupLayer->find('all', array('conditions' => array('ItemGroupLayer.foreign_key' => $this->request->data['CorrugatedPaper']['id'])));

             //pr($itemGroupLayerData);exit;

            //$this->request->data['CorrugatedPaper']['layers'] = 1;

             foreach ($itemGroupLayerData as $key => $userDataList) {

                $this->request->data['ItemGroupLayer']['foreign_key'] = $itemGroupLayerData[$key]['ItemGroupLayer']['foreign_key'];
                $this->request->data['ItemGroupLayer']['model'] = $itemGroupLayerData[$key]['ItemGroupLayer']['model'];
                $this->request->data['ItemGroupLayer']['no'] = intval($itemGroupLayerData[$key]['ItemGroupLayer']['no' ]) + 1;
                $this->request->data['CorrugatedPaper']['layers'] =  $this->request->data['ItemGroupLayer']['no'] +1;
                            
                        }

                       // pr($this->request->data); exit;        

                    $this->ItemGroupLayer->create();

                    $this->id = $this->ItemGroupLayer->saveAll($this->request->data);

                    $this->id = $this->CorrugatedPaper->saveAll($this->request->data);

                    $this->Session->setFlash(__('Add Layer Complete.'));

                    $this->redirect(

                        array('controller' => 'settings', 'action' => 'item_group','tab' => 'tab-corrugated_papers')

                    );
                }
            }
        }

        public function substrate_layer($Id = null) {

            $this->loadModel('ItemGroupLayer');

            $this->loadModel('CompoundSubstrate');

            $userData = $this->Session->read('Auth');

            // pr($this->request->data);exit;

            $itemGroupLayerData = $this->ItemGroupLayer->find('all', array('conditions' => array('ItemGroupLayer.foreign_key' => $this->request->data['CompoundSubstrate']['id'])));

            //pr($itemGroupLayerData);exit;

             foreach ($itemGroupLayerData as $key => $userDataList) {

                $this->request->data['ItemGroupLayer']['foreign_key'] = $itemGroupLayerData[$key]['ItemGroupLayer']['foreign_key'];
                $this->request->data['ItemGroupLayer']['model'] = $itemGroupLayerData[$key]['ItemGroupLayer']['model'];
                $this->request->data['ItemGroupLayer']['no'] = intval($itemGroupLayerData[$key]['ItemGroupLayer']['no' ]) + 1;
                $this->request->data['CompoundSubstrate']['layers'] = $this->request->data['ItemGroupLayer']['no'] +1;
                            
                        }

                       // pr($this->request->data); exit;
        
            if ($this->request->is('post')) {
                
                if (!empty($this->request->data)) {

                    $this->ItemGroupLayer->create();

                    $this->id = $this->ItemGroupLayer->save($this->request->data);

                    $this->id = $this->CompoundSubstrate->save($this->request->data);

                    $this->Session->setFlash(__('Add Layer Complete.'));

                    $this->redirect(

                        array('controller' => 'settings', 'action' => 'item_group','tab' => 'tab-compound_substrates')

                    );
                }
            }
        }

}
            


