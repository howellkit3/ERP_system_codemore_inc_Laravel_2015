<?php
App::uses('AppModel', 'Model');
//namespace Sales\Model\Entity;
/**
 * Supllier Model
 *
 */
class PurchasingType extends AppModel {

    public $useDbConfig = 'koufu_purchasing';

    public $name = 'PurchasingType';

	public $recursive = -1;

	public $actsAs = array('Containable');


}
