<?php
App::uses('AppModel', 'Model');
/**
 * ItemGroupLayer Model
 *
 */
class ItemGroupLayer extends AppModel {

	public $useDbConfig = 'default';

    public $name = 'ItemGroupLayer';

    public $recursive = -1;
    
	public $actsAs = array('Containable');

	 public $validate = array(

        'substrate' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            ),
        )
    
    );
	
}
