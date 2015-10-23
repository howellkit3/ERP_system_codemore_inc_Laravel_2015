<?php


class RawMaterialsController extends WareHouseAppController {

	public $useDbConfig = array('koufu_warehouse');

	public function index(){
		
		$this->loadModel('WareHouse.ItemCategory');

		$this->loadModel('WareHouse.Item');

		$this->loadModel('WareHouse.Department');



		$this->Item->bind(array('ItemCategory'));	

		$limit = 10;

		$conditions = array('Item.category_type_id' => 2);

		$params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Item.name ASC',
	    );

		$this->paginate = $params;

		$items = $this->paginate('Item');

		$this->set(compact('items','itemsCategory','departments'));

	}
	public function add(){
		
		$this->loadModel('WareHouse.ItemCategory');

		$this->loadModel('ItemCategoryHolder');

		$this->loadModel('WareHouse.Item');

		$this->loadModel('WareHouse.Department');

		$this->loadModel('Supplier');

		if ($this->request->is('post')) {

			$auth = $this->Session->read('Auth.User');

			$this->request->data['Item']['created_by'] = 
			$this->request->data['Item']['modified_by'] = $auth['id'];
			
			//check if others
			if ($this->request->data['Item']['department_id'] == 'others' ) {

				$data['name'] = $this->request->data['Item']['department_id_others'];

				$departmentId = $this->Department->saveDepartment($data,$auth['id']);

				$this->request->data['Item']['department_id'] = $departmentId;
			}
			if ($this->request->data['Item']['supplier'] == 'others' ) {

				$data['name'] = $this->request->data['Item']['supplier_id_others'];

				$supplierId = $this->Supplier->saveSupplier($data,$auth['id']);

				$this->request->data['Item']['supplier'] = $supplierId;
			}
			

			if ($this->Item->save($this->request->data['Item'])) {

				$this->Session->setFlash('Raw Material successfully added!','success');
		  		 $this->redirect( array('controller' => 'raw_materials', 'action' => 'index'));
	 
			} else {

				$this->Session->setFlash('There\'s an error in saving items','error');
		    	$this->redirect( array('controller' => 'consumables', 'action' => 'add'));
			}

		}

		$categoryDataDropList = $this->ItemCategoryHolder->find('list',  array('order' => 'ItemCategoryHolder.name ASC'));

		$itemsCategory = $this->ItemCategory->find('list',array('fields' => array('id','name') ,'order' => array('ItemCategory.name ASC')));

		$departments = $this->Department->find('list',array('fields' => array('id','name') ,'order' => array('Department.name ASC')));

		$suppliers = $this->Supplier->find('list',  array('order' => 'Supplier.name ASC'));
		//consumebles items

		$this->set(compact('itemsCategory','departments','suppliers','categoryDataDropList'));


	}

	// public function edit($id = null){

	// 	if ($this->request->is('post')) {

	// 		 if ($this->RawMaterial->save($this->request->data['RawMaterial'])) {
	// 			   $this->Session->setFlash('Raw material updated!');
	// 		        $this->redirect( array('controller' => 'raw_materials', 'action' => 'index'));
	// 	    }

	// 	} else {
	// 		if ($id) {

	// 			$this->request->data = $this->RawMaterial->read(null,$id);

	// 			$data = $this->RawMaterial->findById($id);

	// 			$this->set(compact('data'));
			
	// 		}
	// 	}
	// }



	// public function delete($id = null){

	// 	if ($this->RawMaterial->delete($id)) {
			
	// 		$this->Session->setFlash(__('Raw Material has been deleted successfully.'),'success');
	// 		$this->redirect(
	// 			array('controller' => 'raw_materials', 'action' => 'index')
	// 		);
		
	// 	} else {
			
	// 		$this->Session->setFlash(__('Error Deleting Information.'),'error');
	// 		$this->redirect(
	// 				array('controller' => 'raw_materials', 'action' => 'index')
	// 			);
			
	// 	}

	// }

	public function edit($id = null) {

		$this->loadModel('WareHouse.ItemCategory');

		$this->loadModel('ItemCategoryHolder');

		$this->loadModel('WareHouse.Item');

		$this->loadModel('WareHouse.Department');

		$this->loadModel('Supplier');

		if ($this->request->is('put')) {

			$auth = $this->Session->read('Auth.User');

			$this->request->data['Item']['created_by'] = 
			$this->request->data['Item']['modified_by'] = $auth['id'];

		
			if ($this->Item->save($this->request->data['Item'])) {

				$this->Session->setFlash('Item updated!','success');
					
					if (!empty($this->params['named']['page'])) {

						$this->redirect( array('controller' => 'raw_materials', 'action' => 'index','page' => $this->params['named']['page']));

					} else {

			  		 	$this->redirect( array('controller' => 'raw_materials', 'action' => 'index'));
					}
				
	 
			} else {

				$this->Session->setFlash('There\'s an error in saving items','error');
		    	$this->redirect( array('controller' => 'consumables', 'action' => 'add'));
			}

		}


		if (!empty($id)) {

			$this->request->data = 	$this->Item->findById($id);
		}


		//$categoryDataDropList = $this->ItemCategoryHolder->find('list',  array('order' => 'ItemCategoryHolder.name ASC'));

		$itemsCategory = $this->ItemCategory->find('list',array('fields' => array('id','name') ,'order' => array('ItemCategory.name ASC')));

		$categoryDataDropList = $this->Department->find('list',array('fields' => array('id','name') ,'order' => array('Department.name ASC')));

		$suppliers = $this->Supplier->find('list',  array('order' => 'Supplier.name ASC'));
		//consumebles items

		$this->set(compact('itemsCategory','departments','suppliers','categoryDataDropList'));
	}

	public function delete($id = null){



		$this->loadModel('WareHouse.Item');

		if ($this->Item->delete($id)) {
			
			$this->Session->setFlash(__('Item has been deleted successfully.'),'success');
			$this->redirect(
				array('controller' => 'raw_materials', 'action' => 'index')
			);
		
		} else {
			
			$this->Session->setFlash(__('Error Deleting Information.'),'error');
			$this->redirect(
					array('controller' => 'raw_materials', 'action' => 'index')
				);
			
		}

	}


	public function searchItem() {

		
		$this->loadModel('WareHouse.Item');

		$this->loadModel('WareHouse.ItemCategory');

		$this->Item->bind(array('ItemCategory'));	

		$query = $this->request->query;


		$conditions = array();

		if (!empty($query['search'])) {

			$conditions = array_merge($conditions,array('Item.name like' => '%'.$query['search'].'%'));
		}
		if (!empty($query['type'])) {

			$conditions = array_merge($conditions,array('Item.category_type_id' => $query['type']));
		}


		$items = $this->Item->find('all',array(
			'conditions' => $conditions,
			'order' => 'Item.name DESC'
		));

		$this->set(compact('items'));

		$this->render('Items/ajax/search');
	}



	public function pull_out(){
		$userData = $this->Session->read('Auth');
		$this->loadModel('WareHouse.PullOut');
		$listData = $this->RawMaterial->find('list', array(
	        'conditions' => array('RawMaterial.status' => 'in_stock')
	    ));
	    $listqty = $this->RawMaterial->find('list', array(
	        'conditions' => array('RawMaterial.status' => 'in_stock'),
	        'fields' => array('RawMaterial.qty'),
	    ));

		$this->set(compact('listData','listqty'));

		if ($this->request->is('post')) {

		if (!empty($this->request->data)) {		
		$data = $this->request->data;

		
		$this->PullOut->saveData($data['PullOut'], $userData['User']['id']);

		$this->Session->setFlash(__('New Customer Information Added.'));
		$this->redirect( array('controller' => 'raw_materials', 'action' => 'add'));
		} else{
			$this->Session->setFlash(__('The invalid data. Please, try again.'));
		}
           
		
	}
}

	public function find_data($id = null) {
		
		$this->layout = false;


		$data =$this->RawMaterial->find('first', array('conditions' => array('RawMaterial.id' => $id),'fields' => array('id','qty')));
	
		echo json_encode($data);


		$this->autoRender = false;

	}

}
