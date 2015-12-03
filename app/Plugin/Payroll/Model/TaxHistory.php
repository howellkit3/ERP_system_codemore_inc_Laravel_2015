<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class TaxHistory extends AppModel {

    public $useDbConfig = 'koufu_payrolls';

    public $name = 'TaxHistory';

    public $actsAs = array('Containable');

   
    public function saveHistory($data = array(),$auth = null) {

    	$save = array();


    	foreach ($data as $key => $value) {
    			 
                if (!empty($value['TaxHistory'])) {

                
    			foreach ($value['TaxHistory'] as $key => $value) {
    				
    				$historyData[$key] = $value;

    				$historyData[$key]['created_by'] = $auth['id'];

    				$historyData[$key]['modified_by'] = $auth['id'];
    			}

    		$save = $this->saveAll($historyData);

            }
    	}


    	return $save;
    }


}