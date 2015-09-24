<?php

class ItemsController extends WareHouseAppController {

	public $useDbConfig = array('koufu_warehouse');

	public function index(){

		$this->loadModel('WareHouse.ItemCategory');

		$this->loadModel('WareHouse.Item');

		$this->loadModel('WareHouse.Department');

		$itemsCategory = $this->ItemCategory->find('list',array('fields' => array('id','name') ,'order' => array('ItemCategory.name ASC')));

		// $departments = $this->Department->find('list',array('fields' => array('id','name') ,'order' => array('Department.name ASC')));

		//$items = $this->Item->find('all',array('conditions' => array('Item.category_id' => 1) ));
		//consumebles items
		
		$this->Item->bind(array('ItemCategory'));	

		$limit = 10;

		$conditions = array();

		$params =  array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Item.name ASC',
	    );

		$this->paginate = $params;

		$items = $this->paginate();

		$this->set(compact('items','itemsCategory','departments'));

		// $this->RawMaterial->bind(array('PullOut'));
		// $this->RawMaterial->recursive = 1;
		// $this->RawMaterial->virtualFields['TotalHours'] = 0;
		// $rawData = $this->RawMaterial->find('all');

		// // $rawData = $this->RawMaterial->find('all',array('fields' => array('SUM(qty) as PullOut__TotalHours',
		// // 	'RawMaterial.id',
		// // 	'RawMaterial.name',
		// // 	)));
		// $sum = 0;
		// foreach ($rawData as $key => $value) {
		// 		pr($key);	
		// 	foreach ($value['PullOut'] as $pullout_key => $val) {
		// 		 $sum+= $val['qty'];
		// 	}
		// 	$rawData[$key]['RawMaterial']['total_minus'] = $value['RawMaterial']['qty'] - $sum;
		// }
			
	

		// $this->set(compact('rawData'));
		

	}

	public function add() {

	
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

				$this->Session->setFlash('Items updated!','success');
		  		 $this->redirect( array('controller' => 'items', 'action' => 'index'));
	 
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
		  		 $this->redirect( array('controller' => 'items', 'action' => 'index'));
	 
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

		if ($this->Item->delete($id)) {
			
			$this->Session->setFlash(__('Item has been deleted successfully.'),'success');
			$this->redirect(
				array('controller' => 'items', 'action' => 'index')
			);
		
		} else {
			
			$this->Session->setFlash(__('Error Deleting Information.'),'error');
			$this->redirect(
					array('controller' => 'items', 'action' => 'index')
				);
			
		}

	}


	public function searchItem() {

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

}
