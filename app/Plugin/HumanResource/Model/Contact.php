<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');


class Contact extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Contact';

	 public $recursive = -1;


    public function saveContact($data = null,$foreignkey = null,$model = null,$authid = null) {

    	if (!empty($foreignkey) && !empty($model) && !empty($data)) {


    			if (!empty($data[0])) {

  					$contacts = [];
  				
    				foreach ($data as $key => $value) {
    						$contacts[$key] = $value;
    						$contacts[$key]['model'] = $model;
    						$contacts[$key]['foreign_key'] = $foreignkey;
    						$contacts[$key]['created_by'] =  $authid;
    						$contacts[$key]['modified_by'] =  $authid;
    						
  					}

  					$save = $this->saveAll($contacts);

  				} else {
  					
    				$contacts = $data;
  					$contacts['model'] = $model;
  					$contacts['foreign_key'] = $foreignKey;
  					$contacts['created_by'] =  $authid;
  					$contacts['modified_by'] =  $authid;
  					$save = $this->save($contacts);
  				}
    	}

    }
  }