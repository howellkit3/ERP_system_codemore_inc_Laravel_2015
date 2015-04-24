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

	 public function bind($model = array('Group')){

		$this->bindModel(array(
			
			'belongsTo' => array(
				'CorrugatedPaper' => array(
					'className' => 'CorrugatedPaper',
					'foreignKey' => 'foreign_key',
					'dependent' => true
				),
			)
		));

		$this->contain($model);
	}
	
}
