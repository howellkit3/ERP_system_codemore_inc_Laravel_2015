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
    public $actsAs = array('Containable');
    public function bind($model = array('Group')){

		$this->bindModel(array(
			
			'belongsTo' => array(
				'ItemType' => array(
					'className' => 'Sales.ItemType',
					'foreignKey' => 'type_id',
					'dependent' => true
				),
				'Quotation' => array(
					'className' => 'Sales.Quotation',
					'foreignKey' => 'product_id',
					'dependent' => true
				)
			),
			'hasMany' => array(
				'ProductSpec' => array(
					'className' => 'Sales.ProductSpec',
					'foreignKey' => 'product_id',
					'dependent' => true
				)
			)
		));

		$this->contain($model);
	}

	public function addProduct($data,$auth){
		//pr($id);exit();
		$this->create();
		$data['Product']['type_id'] = $data['Product']['item_type'];
		$data['Product']['company_id'] = $data['Product']['companyId'];
		$data['Product']['product_name'] = $data['Product']['productName'];
		//$data['TruckSchedule']['remarks'] = $data['Product']['remarks'];
		$data['Product']['created_by'] = $auth;
		$data['Product']['modified_by'] = $auth;
		$this->save($data);

		return $this->id;
		

	}
	public function editProduct($data,$auth){
		//pr($data);exit();
		$this->id = $this->find('first',array('conditions' => array('id' => $data['Product']['productId'])));
		//pr($this->id);exit();
		if ($this->id) {
			//pr($this->id);exit();
		    $this->saveField('product_name', $data['Product']['productName']);

		    $this->bind(array('ProductSpec'));
	        $this->ProductSpec->editProductSpec($data, $auth);
		    // $this->bind(array('ProductSpec'));
		    // $this->QuotationField->editFields($data,$quotationId);
		    //pr($data);exit();
		    //$this->QuotationField

		}

	}

}