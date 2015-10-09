<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Email extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Email';

    var $useTable = 'emails';


    public $actsAs = array('Containable');

    public function bind($model = array('Group')){
  	$this->bindModel(array(
      'belongsTo' => array(
        'ContactPerson' => array(
          'className' => 'Contact',
          'foreignKey' => false,
          'dependent' => true,
          'conditions' => array(
            'Contact.model = ContactPerson',
            'Contact.foreign_key = ContactPerson.id' 
            )
        ),
        'Employee' => array(
          'className' => 'Email',
          'foreignKey' => false,
          'dependent' => true,
          'conditions' => array(
            'Email.model = Employee',
            'Email.foreign_key = ContactPerson.id' 
            )
        )
      )
    ),false);

  }


  	public function saveEmails($data = null,$foreignKey = null,$model = null ,$authid = null){



  		if (!empty($foreignKey) && !empty($model) && !empty($data))  {

        $this->deleteAll(array(
            'Email.model' => $model,
            'Email.foreign_key' => $foreignKey,
            'Email.email' => ''
        ));


  				if (!empty($data[0])) {
            
  					$emails = array();
  				  
  					foreach ($data as $key => $value) {
  						$emails[$key] = $value;
  						$emails[$key]['model'] = $model;
  						$emails[$key]['foreign_key'] = $foreignKey;
  						$emails[$key]['created_by'] =  $authid;
  						$emails[$key]['modified_by'] =  $authid;


               $save = $this->save($emails[$key]);
  						
					}
          
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