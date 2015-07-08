<?php


class RawMaterialsController extends WareHouseAppController {

	public $useDbConfig = array('koufu_warehouse');

	public function index(){
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
	public function add(){
		$userData = $this->Session->read('Auth');
		$this->set(compact('supplierName'));

		if ($this->request->is('post')) {

			if (!empty($this->request->data)) {		
				$data = $this->request->data['RawMaterial'];
				$this->RawMaterial->saveRawMaterial($data, $userData['User']['id']);

            	$this->Session->setFlash(__('New Customer Information Added.'));
            	$this->redirect( array('controller' => 'raw_materials', 'action' => 'add'));
            } else{
	            	$this->Session->setFlash(__('The invalid data. Please, try again.'));
	        }
            	
        }
	}

	public function edit($id = null){

		if ($this->request->is('post')) {

			 if ($this->RawMaterial->save($this->request->data['RawMaterial'])) {
				   $this->Session->setFlash('Raw material updated!');
			        $this->redirect( array('controller' => 'raw_materials', 'action' => 'index'));
		    }

		} else {
			if ($id) {

				$this->request->data = $this->RawMaterial->read(null,$id);

				$data = $this->RawMaterial->findById($id);

				$this->set(compact('data'));
			
			}
		}
	}



	public function delete($id = null){

		if ($this->RawMaterial->delete($id)) {
			
			$this->Session->setFlash(__('Raw Material has been deleted successfully.'),'success');
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
