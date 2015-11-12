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

	public function formatData($data = null){

		$save = array();

		if (!empty($data)) {

			$date = explode('-',$data['from_date']);

			$split = new DateTime(trim($date[0]));


			$start_date = date('Y-m-d',strtotime(trim($date[0])));

			$end_date = date('Y-m-d',strtotime(trim($date[1])));

			$key = 0;

		

			while (strtotime($start_date) <= strtotime($end_date)) {

				$save['Holiday'][$key] = $data['Holiday'];

				//$data['Holiday'][$key]['year'] = date('Y',strtotime($start_date));
				$save['Holiday'][$key]['start_date'] = $start_date;
				$save['Holiday'][$key]['end_date'] = $start_date;

				$start_date = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)));


				
				$key++;	
			}
		
		}

		return $save;
	}
	public function getAllHolidays($params = array()){

		
		$holidays = $this->find('all',$params);

		$list = array();
		
			foreach ($holidays as $key => $holiday) {
				if (!empty($holiday['Holiday']['start_date']) && $holiday['Holiday']['start_date'] != '00-00-00') {
					$list[$key]['title'] = $holiday['Holiday']['name'];
					$list[$key]['start'] = $holiday['Holiday']['start_date'];
					$list[$key]['end']  = $holiday['Holiday']['end_date'];
					$list[$key]['color'] = $holiday['Holiday']['type'] == 'special' ? '#F57821' : '#257e4a';
				}
			}

			$list = json_encode($list);
			$list = str_replace('[','',$list);
			$list = str_replace(']','',$list);

			return $list;

	}

	
  }
