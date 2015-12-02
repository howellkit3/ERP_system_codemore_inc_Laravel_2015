<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class OutputDetail extends AppModel {

    public $useDbConfig = 'koufu_production';
    public $name = 'OutputDetail';

     public $recursive = -1;
     
    public $actsAs = array('Containable');

    public function bind($model = array('Group')){

		// $this->bindModel(array(
		// 	'hasMany' => array(
		// 		'Department' => array(
		// 			'className' => 'Production.Department',
		// 			'foreignKey' => 'department_id',
		// 			'dependent' => true,
		// 		),
		// 	)
		// ),false);

		$this->contain($model);
	}

	public function saveDetails($outputId = null,$data = array()){

		$this->create();
				
		$saveData['OutputDetail'] = $data['DepartmentProcess'];

		if (!empty($data) && !empty($outputId)) {

			$saveData['OutputDetail']['output_id'] = $outputId;

			$this->save($saveData['OutputDetail']);
		} 

		return $this->id;
		
	}
	
}