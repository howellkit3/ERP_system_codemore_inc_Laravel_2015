<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class ContributionBalance extends AppModel {

    public $useDbConfig = 'koufu_payrolls';

	public $recursive = -1;

	public $name = 'ContributionBalance';

	public $actsAs = array('Containable');

	public function saveBalance($data = array(),$auth = null,$payroll_id = null) {

		$save = $historyData = array();

    	foreach ($data as $key => $value) {
    			
    			foreach ($value['ContributionBalance'] as $key => $value) {
    				
    				$historyData[$key] = $value;
    				$historyData[$key]['amount'] = $value['balance'];
					$historyData[$key]['payroll_id'] = $payroll_id;
					$historyData[$key]['created_by'] = $auth['id'];
					$historyData[$key]['modified_by'] = $auth['id'];
    			
    			}

                if (!empty($historyData)) {

                    $save = $this->saveAll($historyData);

                }
                
    	}

    	return $save;
	}


}