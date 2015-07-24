<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Holiday extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Holiday';

    public $actsAs = array('Containable');
    
     public function bind($model = array('Group')){

		// $this->bindModel(array(
		// 	'belongsTo' => array(
		// 		'Tooling' => array(
		// 			'className' => 'Tooling',
		// 			'foreignKey' => 'tools_id',
		// 			'dependent' => true,
		// 		)
		// ),false);

		// $this->contain($model);
	}

	public function getAllHolidays($params = array()){

		
		$holidays = $this->find('all',$params);

		$list = [];
			foreach ($holidays as $key => $holiday) {
				$list[$key]['title'] = $holiday['Holiday']['name'];
				$list[$key]['start'] = $holiday['Holiday']['start_date'];
				$list[$key]['end']  = $holiday['Holiday']['end_date'];
				$list[$key]['color'] = $holiday['Holiday']['type'] == 'special' ? '#E11B22' : '#257e4a';
			}

			$list = json_encode($list);
			$list = str_replace('[','',$list);
			$list = str_replace(']','',$list);

			return $list;

	}

	
  }
