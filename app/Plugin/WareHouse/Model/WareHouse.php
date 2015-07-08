<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class WareHouse extends AppModel {

    public $useDbConfig = 'koufu_warehouse';

    public $name = 'WareHouse';

 

}
