<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class DisciplinaryAction extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'DisciplinaryAction';

    public $actsAs = array('Containable');
    
	
  }
