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


              $this->deleteAll(
              array('Contact.model' => $model,
                    'Contact.foreign_key' => $foreignkey,
                    'Contact.number' => ''
                )
              );

    					$contacts = array();
    				
      				foreach ($data as $key => $value) {

                if ($value['number'] != '') {

                
      						$contacts[$key] = $value;
      						$contacts[$key]['model'] = $model;
      						$contacts[$key]['foreign_key'] = $foreignkey;
      						$contacts[$key]['created_by'] =  $authid;
      						$contacts[$key]['modified_by'] =  $authid;

                  $save = $this->save($contacts[$key]);
                }
      						
    					}


  

    				} else {  
    					
              if (!empty($data['number']) ) {
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
  }