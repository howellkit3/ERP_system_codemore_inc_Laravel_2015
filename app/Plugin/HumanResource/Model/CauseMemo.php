<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class CauseMemo extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'CauseMemo';

    public $actsAs = array('Containable');
    
	
  }
