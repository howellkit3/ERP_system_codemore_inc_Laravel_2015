<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');


class Contract extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Contract';

	 public $recursive = -1;


   
  }