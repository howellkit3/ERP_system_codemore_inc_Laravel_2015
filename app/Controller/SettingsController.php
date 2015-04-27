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
         )   

    ); 
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index','category');
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

        $limit = 5;

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

        $limit = 5;

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

                $limit = 5;

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
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1')));
     
        $typeData = $this->ItemTypeHolder->find('list', array('fields' => array('id', 'name'),
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1')));

        $categoryDataDropList = $this->ItemCategoryHolder->find('list',  array('order' => 'ItemCategoryHolder.id DESC'));

        $supplierData = $this->Supplier->find('list',  array('order' => 'Supplier.id DESC'));

        //general item
         $this->GeneralItem->bind(array('ItemCategoryHolder', 'ItemTypeHolder', 'Supplier'));

         if ( (empty($this->params['named']['model'])) ||  $this->params['named']['model'] == 'GeneralItem' ) {
          
           $this->paginate['GeneralItem'] = array(
                'conditions' =>  array(),
                'limit' => 10,
            );

            $generalItemData = $this->paginate('GeneralItem');

        }
       
        //substrateData
          $this->Substrate->bind(array('ItemCategoryHolder', 'ItemTypeHolder', 'Supplier'));

         if ( (empty($this->params['named']['model'])) ||  $this->params['named']['model'] == 'Substrate' ) {
            
            $this->paginate['Substrate'] = array(
                'conditions' =>  array(),
                'limit' => 10,
            );

            $substrateData = $this->paginate('Substrate');

        }
       
          //Compound substrateData
         $this->CompoundSubstrate->bind(array('ItemCategoryHolder', 'ItemTypeHolder', 'Supplier'));

        if ( (empty($this->params['named']['model'])) ||  $this->params['named']['model'] == 'CompoundSubstrate' ) {
            
            $this->paginate['CompoundSubstrate'] = array(
                'conditions' =>  array(),
                'limit' => 10,
            );

            $compoundSubstrateData = $this->paginate('CompoundSubstrate');

        }

          //Corrugated Paper
         $this->CorrugatedPaper->bind(array('ItemCategoryHolder', 'ItemTypeHolder', 'Supplier', 'ItemGroupLayer'));

        if ( (empty($this->params['named']['model'])) ||  $this->params['named']['model'] == 'CorrugatedPaper' ) {
            
            $this->paginate['CorrugatedPaper'] = array(
                'conditions' =>  array(),
                'limit' => 10,
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
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1')));
     
        $typeData = $this->ItemTypeHolder->find('list', array('fields' => array('id', 'name'),
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1')));

        $supplierData = $this->Supplier->find('list',  array('order' => 'Supplier.id DESC'));


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
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1')));
     
        $typeData = $this->ItemTypeHolder->find('list', array('fields' => array('id', 'name'),
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1')));

        $supplierData = $this->Supplier->find('list',  array('order' => 'Supplier.id DESC'));

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
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1')));
     
        $typeData = $this->ItemTypeHolder->find('list', array('fields' => array('id', 'name'),
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1')));

        $supplierData = $this->Supplier->find('list',  array('order' => 'Supplier.id DESC'));


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
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1')));
     
        $typeData = $this->ItemTypeHolder->find('list', array('fields' => array('id', 'name'),
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1')));

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

            if ($this->request->is('post')) {

                 $compoundSubstrateDetails = $this->request->data;
                
                if (!empty($compoundSubstrateDetails)) {

                    $userData = $this->Session->read('Auth');
                    $compoundSubstrateDetails['CompoundSubstrate']['uuid'] = time();
                    $compoundSubstrateDetails['CompoundSubstrate']['created_by'] = $userData['User']['id'];
                    $compoundSubstrateDetails['CompoundSubstrate']['modified_by'] = $userData['User']['id'];

                    $this->CompoundSubstrate->save($compoundSubstrateDetails);

                    $this->CompoundSubstrate->save_substrate($this->request->data,$this->CompoundSubstrate->id); 
                    
                    $this->Session->setFlash(__('Adding Compound Substrate Complete.'));

                    return $this->redirect(array('action' => 'item_group','tab' => 'tab-compound_substrates'));
                }
            }

            $this->set(compact('compoundSubstrateData'));
    
    }
    public function compound_substrate_edit($id = null) {

        $this->loadModel('Supplier');

        $this->loadModel('CompoundSubstrate');

        $this->ItemTypeHolder->bind(array('ItemCategoryHolder'));

        $this->CompoundSubstrate->bind(array('ItemCategoryHolder','ItemTypeHolder', 'Supplier','ItemGroupLayer'));

        $categoryData = $this->ItemCategoryHolder->find('list', array('fields' => array('id', 'name'),
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1')));
     
        $typeData = $this->ItemTypeHolder->find('list', array('fields' => array('id', 'name'),
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1')));

        $supplierData = $this->Supplier->find('list',  array('order' => 'Supplier.id DESC'));



            if (!$id) {
                throw new NotFoundException(__('Invalid post'));
            }

            $post = $this->CompoundSubstrate->findById($id);

            if (!$post) {
                throw new NotFoundException(__('Invalid post'));
            }

            if ($this->request->is(array('post', 'put'))) {
                $this->CompoundSubstrate->id = $id;


                if ($this->CompoundSubstrate->save($this->request->data)) {

                    //save substrate
                    $this->CompoundSubstrate->save_substrate($this->request->data,$this->CompoundSubstrate->id); 

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

        return $this->redirect(array(' controller' => 'settings', 'action' => 'item_group','tab' => 'tab-compound_substrate'));
    }

    public function view_compound_substrate($id){

        $this->loadModel('Supplier');

        $this->loadModel('CompoundSubstrate');

        $this->ItemTypeHolder->bind(array('ItemCategoryHolder'));

        $this->CompoundSubstrate->bind(array('ItemCategoryHolder','ItemTypeHolder', 'Supplier', 'ItemGroupLayer'));

        $categoryData = $this->ItemCategoryHolder->find('list', array('fields' => array('id', 'name'),
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1')));
     
        $typeData = $this->ItemTypeHolder->find('list', array('fields' => array('id', 'name'),
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1')));

        $supplierData = $this->Supplier->find('list',  array('order' => 'Supplier.id DESC'));

        $post = $this->CompoundSubstrate->findById($id);

            if (!$this->request->data) {
                $this->request->data = $post;
            }

            $this->set(compact( 'categoryData' , 'typeData', 'supplierData' ));
    }


    public function corrugated_paper() {

        $this->loadModel('CorrugatedPaper');

        $this->loadModel('ItemGroupLayer');

        $corrugatedPaperData = $this->CorrugatedPaper->find('all',  array('order' => 'CorrugatedPaper.id DESC','limit'=>4, 'offset'=>3));

        $userData = $this->Session->read('Auth');

            if ($this->request->is('post')) {

                 $corrugatedDetails = $this->request->data;
                
                if (!empty($corrugatedDetails)) {

                    $userData = $this->Session->read('Auth');
                    $corrugatedDetails['CorrugatedPaper']['uuid'] = time();
                    $corrugatedDetails['CorrugatedPaper']['created_by'] = $userData['User']['id'];
                    $corrugatedDetails['CorrugatedPaper']['modified_by'] = $userData['User']['id'];

                    $this->CorrugatedPaper->save($corrugatedDetails);
                    $dataHolder = array();

                    for($groupLayerCount=0; $groupLayerCount < count($this->request->data['ItemGroupLayer']['no']); $groupLayerCount++) {

                    $this->ItemGroupLayer->create();

                    $dataHolder['ItemGroupLayer']['foreign_key'] = $this->CorrugatedPaper->id;
                    $dataHolder['ItemGroupLayer']['no'] = $this->request->data['ItemGroupLayer']['no'][$groupLayerCount];
                    $dataHolder['ItemGroupLayer']['substrate'] = $this->request->data['ItemGroupLayer']['substrate'][$groupLayerCount];
                    $dataHolder['ItemGroupLayer']['model'] = 'CorrugatedPaper';
                    $this->ItemGroupLayer->save($dataHolder);

                    }
           
                    $this->Session->setFlash(__('Adding Corrugated Paper Complete.'));

                    return $this->redirect(array('action' => 'item_group','tab' => 'tab-corrugated_papers'));
            } 
        }


            $this->set(compact('corrugatedPaperData'));    
        
    }


     public function corrugated_paper_edit($id = null) {


        $this->loadModel('Supplier');

        $this->loadModel('CorrugatedPaper');

        $this->ItemTypeHolder->bind(array('ItemCategoryHolder'));

        $this->CorrugatedPaper->bind(array('ItemCategoryHolder','ItemTypeHolder', 'Supplier', 'ItemGroupLayer'));

        $categoryData = $this->ItemCategoryHolder->find('list', array('fields' => array('id', 'name'),
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1')));
     
        $typeData = $this->ItemTypeHolder->find('list', array('fields' => array('id', 'name'),
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1')));

        $supplierData = $this->Supplier->find('list',  array('order' => 'Supplier.id DESC'));


            if (!$id) {
                throw new NotFoundException(__('Invalid post'));
            }

            $post = $this->CorrugatedPaper->findById($id);

            if (!$post) {
                throw new NotFoundException(__('Invalid post'));
            }

            if ($this->request->is(array('post', 'put'))) {
                $this->CorrugatedPaper->id = $id;

                if ($this->CorrugatedPaper->save($this->request->data)) {

                    $this->CorrugatedPaper->save($this->request->data);

                    $this->Session->setFlash(__('Corrugated Paper has been updated.'));

                    return $this->redirect(array('action' => 'item_group','tab' => 'tab-corrugated_papers'));
                }
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
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1')));
     
        $typeData = $this->ItemTypeHolder->find('list', array('fields' => array('id', 'name'),
                                                                'conditions' => array('ItemCategoryHolder.category_type' => '1')));

        $supplierData = $this->Supplier->find('list',  array('order' => 'Supplier.id DESC'));

        $post = $this->CorrugatedPaper->findById($id);

            if (!$this->request->data) {
                $this->request->data = $post;
            }

            $this->set(compact( 'categoryData','typeData' , 'supplierData'));
    }

    public function process() {

        $this->loadModel('Process');

        $userData = $this->Session->read('Auth');

        $limit = 5;

        $conditions = array();

        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'fields' => array('id', 'name','created'),
            'order' => 'Process.id DESC',
        );

        $processData = $this->paginate('Process');

            if ($this->request->is('post')) {
                
                if (!empty($this->request->data)) {
                   
                    $this->Process->create();

                    $this->id = $this->Process->saveProcess($this->request->data['Process'], $userData['User']['id']);
           
                    $this->Session->setFlash(__('Add Process Complete.'));

                    $this->redirect(
                        array('controller' => 'settings', 'action' => 'process')
                    );
                }
            }

        $this->set(compact('processData'));
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

                    return $this->redirect(array('action' => 'process'));
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

        return $this->redirect(array('action' => 'process'));
    }

     public function unit() {

        $this->loadModel('Unit');

        $userData = $this->Session->read('Auth');

        $limit = 5;

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

    public function ajax_categ($itemId = false){


        $this->autoRender = false;

        $this->loadModel('ItemCategoryHolder');
        $this->ItemCategoryHolder->bind(array('ItemTypeHolder'));

        $itemdata = $this->ItemCategoryHolder->ItemTypeHolder->find('all', array(
                                        'conditions' => array(
                                            'ItemTypeHolder.Item_category_holder_id' => $itemId), 
                                        'fields' => array(
                                            'id', 'name')
                                        ));

       echo json_encode($itemdata);
    }


}
            


