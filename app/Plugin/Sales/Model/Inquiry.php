<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class Inquiry extends AppModel {

    public $useDbConfig = 'koufu_sale';

	public $recursive = -1;

	 public $name = 'Inquiry';

	public $actsAs = array('Containable');

	public function bind($model = array('Group')){

		$this->bindModel(array(
			'belongsTo' => array(
				'Company' => array(
					'className' => 'Sales.Company',
					'foreignKey' => 'company_id',
					'dependent' => true
				),
			),
			'hasMany' => array(
				'Quotation' => array(
					'className' => 'Sales.Quotation',
					'foreignKey' => 'inquiry_id',
					'dependent' => true
				),
			)
		));

		$this->contain($model);
	}

	public $validate = array(

		'quotes' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				
			),
		),
		// 'remarks' => array(
		// 	'notEmpty' => array(
		// 		'rule' => array('notEmpty'),
				
		// 	),
		// ),

	);

	public function saveInquiry($data,$auth){

	$month = date("m"); 
    $year = date("y");
    $hour = date("H");
    $minute = date("i");
    $seconds = date("s");
        
	$code =  $year. $month .$minute . $hour . $seconds;
			
		$this->create();
		
			$data['Inquiry']['company_id'] = $data['Company']['id'];
			$data['Inquiry']['created_by'] = $auth;
			$data['Inquiry']['modified_by'] = $auth;
			$data['Inquiry']['uuid'] = $code;
		
		$this->saveAll($data);
		return $this->id;
		
	}

	public function afterSave($data,$options = array() ) {

		Cache::delete('inquiryId');
		
	}
	public function afterDelete() {

		Cache::delete('inquiryId');

	}
	
}
