<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class Product extends AppModel {
	public $useDbConfig = 'koufu_sale';
    public $name = 'Product';


	public function addProduct($data,$auth){
		//pr($id);exit();
		$this->create();
		$data['Product']['type_id'] = $data['Product']['item_type'];
		$data['Product']['company_id'] = $data['Product']['companyId'];
		$data['Product']['product_name'] = $data['Product']['productName'];
		$data['TruckSchedule']['remarks'] = $data['Product']['remarks'];
		$data['Product']['created_by'] = $auth;
		$data['Product']['modified_by'] = $auth;
		$this->save($data);

		return $this->id;
		

	}

}