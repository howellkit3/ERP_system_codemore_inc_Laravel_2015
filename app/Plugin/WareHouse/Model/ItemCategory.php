<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class ItemCategory extends AppModel {

    public $useDbConfig = 'koufu_warehouse';
    
  	public $name = 'ItemCategory';

  

}