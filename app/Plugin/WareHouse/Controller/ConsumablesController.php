<?php


class ConsumablesController extends WareHouseAppController {

	public $useDbConfig = array('koufu_warehouse');

	public function index(){

		$this->loadModel('WareHouse.ItemCategory');

		$this->loadModel('WareHouse.Item');

		$this->loadModel('WareHouse.Department');

		$itemsCategory = $this->ItemCategory->find('list',array('fields' => array('id','name') ,'order' => array('ItemCategory.name ASC')));

		$departments = $this->Department->find('list',array('fields' => array('id','name') ,'order' => array('Department.name ASC')));

		$items = $this->Item->find('all',array('conditions' => array('Item.category_id' => 1) ));
		//consumebles items

		$this->set(compact('itemsCategory','departments'));

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

		$this->loadModel('WareHouse.Item');

		$this->loadModel('WareHouse.Department');

		$this->loadModel('Supplier');

		$itemsCategory = $this->ItemCategory->find('list',array('fields' => array('id','name') ,'order' => array('ItemCategory.name ASC')));

		$departments = $this->Department->find('list',array('fields' => array('id','name') ,'order' => array('Department.name ASC')));

		$items = $this->Item->find('all',array('conditions' => array('Item.category_id' => 1) ));

		$suppliers = $this->Supplier->find('list');
		//consumebles items

		$this->set(compact('itemsCategory','departments','suppliers'));

	}

}
