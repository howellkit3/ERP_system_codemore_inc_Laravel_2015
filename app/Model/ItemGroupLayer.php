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
	

	public function saveItemGroupLayer($data = null){
		//pr($data);exit();
		foreach ($data as $key => $itemData)
		{
			
			$this->create();
			if (!empty($data[$this->name])) {


				foreach ($data[$this->name] as $key => $ItemGroupLayer) 
				{
				
					$this->save($ItemGroupLayer);
				}
				
			}
			//return $this->id;

		}

	}

	public function addItemgroupLayer($groupData = null ,$groupId = null){
		
		foreach ($groupData[$this->name] as $key => $ItemGroupList) 
		{
			$this->create();
			$ItemGroupList['no'] = $key;
			$ItemGroupList['foreign_key'] = $groupId;
			
			if($groupData['CompoundSubstrate']){
				$ItemGroupList['model'] = 'CompoundSubstrate';
			}else{
				$ItemGroupList['model'] = 'CorrugatedPaper';
			}
			
			
			$this->save($ItemGroupList);
		}
	}
}
