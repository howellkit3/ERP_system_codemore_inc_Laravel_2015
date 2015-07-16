<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Tooling extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Tooling';

    public $actsAs = array('Containable');
    
  }
