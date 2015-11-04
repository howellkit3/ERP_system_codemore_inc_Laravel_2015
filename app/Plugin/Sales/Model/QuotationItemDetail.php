<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class QuotationItemDetail extends AppModel {

    public $useDbConfig = 'koufu_sale';
	
	public $recursive = -1;

	public $name = 'QuotationItemDetail';

	public $actsAs = array('Containable');

	public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Quotation' => array(
					'className' => 'Sales.Quotation',
					'foreignKey' => 'quotation_id',
					'dependent' => true
				),
			)
			
		));

		$this->contain($model);
	}

	//new function for saving quotationDetails
	public function addQuotationItemDetail($quotationData = null, $quoteId){
		
		$this->create();

		foreach ($quotationData[$this->name] as $key => $quotationItem) 
		{
			
			$quotationItem['quotation_id'] = $quoteId;
		//	pr($quotationData); exit;
			$this->saveAll($quotationItem);
			
		}
		
		return $this->id;

	}

	public function edit($quotationData = null, $quotationId = null){
		
		

		$this->create();

		foreach ($quotationData as $key => $quotationItem) 
		{
			
			
			$quotationItem['quotation_id'] = $quotationId;
			//pr($quotationItem);
			$this->saveAll($quotationItem);
			
		}  //exit;
		
		return $this->id;

	}

	public function saveFromInvoice($data = null){


		if($data['QuotationItemDetail']['vat_status'] == 1){

			$data['QuotationItemDetail']['vat_status'] = 'Vatable Sale';
		}

		if($data['QuotationItemDetail']['vat_status'] == 2){

			$data['QuotationItemDetail']['vat_status'] = 'Vat Exempt';
		}

		if($data['QuotationItemDetail']['vat_status'] == 3){

			$data['QuotationItemDetail']['vat_status'] = 'Zero Rated Sale';
		}

		$this->create();
		//pr($data); exit;
		$this->save($data);


	}

}
