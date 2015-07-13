<?php
App::uses('AppModel', 'Model');
//namespace Sales\Model\Entity;
/**
 * Supllier Model
 *
 */
class PurchasingItem extends AppModel {

    public $useDbConfig = 'koufu_purchasing';

    public $name = 'PurchasingItem';

	public $recursive = -1;

	public $actsAs = array('Containable');

	


}
