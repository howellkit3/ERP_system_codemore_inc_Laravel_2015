<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Tool extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Tool';

    public $actsAs = array('Containable');
    
  }
