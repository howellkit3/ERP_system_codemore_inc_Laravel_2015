<?php
App::uses('AppModel', 'Model');
//namespace Sales\Model\Entity;
/**
 * Supllier Model
 *
 */
class Request extends AppModel {

    public $useDbConfig = 'koufu_purchasing';

    public $name = 'Request';

	public $recursive = -1;

	public $actsAs = array('Containable');




}
