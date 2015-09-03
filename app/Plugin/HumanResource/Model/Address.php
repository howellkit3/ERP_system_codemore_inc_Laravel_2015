<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Address extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Address';

  //   public function bind($model = array('Group')){

  //    $this->bindModel(array(
  //     'belongsTo' => array(
  //       'Employee' => array(
  //         'className' => 'Employee',
  //         'foreignKey' => 'foreign_key',
  //         //'dependent' => true,
  //         // 'conditions' => array(
  //         //   'Address.model = Employee',
  //         //   'Address.foreign_key = Employee.id' 
  //         //   )
  //       )
  //       ))
  //    ),false);

  //    $this->contain($model);
  // }
  	
  	public function saveAddress($data,$foreignKey = null,$model = null,$authid = null) {

  		$save = false;

  		if (!empty($foreignKey) && !empty($model) && !empty($data))  {

  				if (!empty($data[0])) {

  					$emails = array();
  				
    				foreach ($data as $key => $value) {
    						$emails[$key] = $value;
    						$emails[$key]['model'] = $model;
    						$emails[$key]['foreign_key'] = $foreignKey;
    						$emails[$key]['created_by'] =  $authid;
    						$emails[$key]['modified_by'] =  $authid;
    						
  					}

  					$save = $this->saveAll($emails);
  				} else {
  					
  					$emails = $data;
					$emails['model'] = $model;
					$emails['foreign_key'] = $foreignKey;
					$emails['created_by'] =  $authid;
					$emails['modified_by'] =  $authid;
					$save = $this->save($emails);
  				}
  			

  		}

  		return $save;
  	}

}