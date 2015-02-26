<?php


class RawMaterialsController extends WareHouseAppController {

	public $useDbConfig = array('koufu_ware_house');

	public function index(){
		
		$rawData = $this->RawMaterial->find('all');
		
		$this->set(compact('rawData'));
		

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

		} else {
			if ($id) {

				$this->request->data = $this->RawMaterial->read(null,$id);

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

}
