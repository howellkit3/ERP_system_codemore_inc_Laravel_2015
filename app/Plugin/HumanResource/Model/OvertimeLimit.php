<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class OvertimeLimit extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'OvertimeLimit';

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


	public function createLimit($data = null,$auth = null,$limit_hours = 12,$used = 0) {

		if (!empty($data)) {

			if ($data['type'] == 'monthly') {

				$dates = explode('-', $data['day']);

				$date1 = trim($dates[0]);
				$date2 = trim($dates[1]);

				$begin = new DateTime($date1);
				$end   = new DateTime($date2);

				$limit = array();
				$key = 1;
				$sundaykeys = 1;

				for($i = $begin; $begin <= $end; $i->modify('+1 day')){
					
					$current = $i->format("Y-m-d");

					if ( date("w",strtotime($current)) != 0) {
						$limit[$key] = $current;
					} else {
						$limit[]['sunday'] = $current;
						$key++; 
					}
					
				}

		}

		$index = 0;
		$saveData = array();
		end($limit);

		$lastKey = key($limit);

			foreach ($limit as $key => $value) {
				
				if ($index == 0) {
					$saveData[$key]['from'] = $begin->format("Y-m-d");
				} else {

					$last = new DateTime($lastDate);
					$last = $last->modify('+2 day');

					$saveData[$key]['from'] = $last->format("Y-m-d");
				}	
				
				$saveData[$key]['to'] =  $value;

				if ($key !=  $lastKey) {
					
					$toDate =  new DateTime($value);
					$to = $toDate->modify('+1 day');
					$saveData[$key]['to'] =  $to->format("Y-m-d");
				}
			
				$lastDate = $saveData[$key]['to'];
				
				$saveData[$key]['employee_id'] = $data['foreign_key'];
				
				if ( $data['model'] == 'Employee' ) {
					
					$saveData[$key]['employee_id'] = $data['foreign_key'];
				
				}

				$saveData[$key]['limit'] = $limit_hours;
				$saveData[$key]['used'] = $used;
				$saveData[$key]['created_by'] = $auth['id'];
				$saveData[$key]['modifiy_by'] = $auth['id'];
				$index++;

			}

			return $this->saveAll($saveData);
			// $this->save($data);
		}
	}


	public function checkIfConsumed($data = null) {

		if (!empty($data['Overtime']['id'])) {

			//check if overtime used
			$saveData = array();

			if (strtotime($data['Attendance']['out']) > strtotime($data['Overtime']['from'])) {

				//compute hours
				$from = new DateTime($data['Overtime']['from']);
				$to = new DateTime($data['Attendance']['out']);
				
				if ($data['Attendance']['out'] > $data['Overtime']['to']) {

					$to = new DateTime($data['Overtime']['to']);
				}
				
				$saveData['total_hours'] =  $from->diff($to)->format('%h.%i'); 
			}
			
			//find limit whe date is belong
			$params = array(
				'conditions' => array(
					'employee_id' => $data['Attendance']['employee_id'],
					'OvertimeLimit.from <=' =>  $data['Attendance']['date'],
					'OvertimeLimit.to >=' => $data['Attendance']['date']
					),
			);

			$limit = $this->find('first',$params);

			if (!empty($limit) && !empty($saveData['total_hours'])) {
				
				$this->id = $limit['OvertimeLimit']['id'];

				$total_consumed = $limit['OvertimeLimit']['used'] + $saveData['total_hours'];

				$consumed = $saveData['total_hours'];

				if ($limit['OvertimeLimit']['used'] < 12) {
					$consumed = $total_consumed - 12;
				}

				$this->saveField('used',$total_consumed);

				if ($total_consumed > 12) {
									$limit['OvertimeLimit']['used'] = $consumed;
					return $limit;
				}	
				
			}

		}
	}
	
  }
