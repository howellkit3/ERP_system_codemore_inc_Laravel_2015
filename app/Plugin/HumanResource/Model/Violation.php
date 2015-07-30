<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Violation extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Violation';

    public $actsAs = array('Containable');
    
	
  }
