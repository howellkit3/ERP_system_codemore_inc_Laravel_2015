<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class CustomField extends AppModel {

    public $useDbConfig = 'koufu_sale';

	public $recursive = -1;

	 public $name = 'CustomField';

	public $actsAs = array('Containable');

	public function bind($model = array('Group')){

		$this->bindModel(array(
			
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

		'fieldlabel' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				
			),
		),

	);

	public function savelabel($data,$auth)
	{
		$this->create();
		
		$data['CustomField']['created_by'] = $auth;
		$data['CustomField']['modified_by'] = $auth;	
			
		$this->saveAll($data['CustomField']);
		return $this->id;
		
		
	}
	
}
