<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class Item extends AppModel {

    public $useDbConfig = 'koufu_warehouse';
    
  	public $name = 'Item';

    public $actsAs = array('Containable');

	public function bind($model = array('Group')){

	     $this->bindModel(array(
	     'belongsTo' => array(
	       'ItemCategory' => array(
	          'className' => 'WareHouse.ItemCategory',
	          'foreignKey' => 'category_type_id'
	        ),
	      ),
	     'hasMany' => array(
	     	'ItemSpec' => array(
	          'className' => 'WareHouse.ItemSpec',
	          'foreignKey' => 'items_id',
	        ),

	     )

	    ), false);

	     $this->contain($model);
	  }

}