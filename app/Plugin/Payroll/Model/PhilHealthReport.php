<?php
App::uses('AppModel', 'Model');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class PhilHealthReport extends AppModel {

	public $useDbConfig = 'koufu_payrolls';

    public $name = 'PhilHealthReport';

    var $useTable = 'philhealth_reports';

    public $recursive = -1;
    
	public $actsAs = array('Containable');

    public function bind($model = array('Group')){

        // $this->bindModel(array(
            
        // //     'belongsTo' => array(
        // //         'RolePermission' => array(
        // //             'className' => 'RolePermission',
        // //             'foreignKey' => 'permission_id',
        // //             'dependent' => true
        // //         ),
        // //     )
        // // ));

        // $this->contain($model);
    }

    public function formatData($data = null, $auth = null){

        if (!empty($data)) {

            $data[$this->alias]['created_by'] = $auth['User']['id'];
            $data[$this->alias]['modified_by'] = $auth['User']['id'];
            
        }
        return $data;
    }


    public function saveReport($data = array(),$payroll_id = null,$auth = null) {

        $report = array();
        $reportIds = array();

        if (!empty($data)) {
            foreach ($data as $key => $list) {
            
                $report['id'] = !empty($list['id']) ? $list['id'] : '';
                $report['employee_id'] = !empty($list['Employee']['id']) ? $list['Employee']['id'] : '';
                $report['employer'] = !empty($list['philhealth_employer] ']) ? $list['philhealth_employer] '] : '';
                $report['employee'] = !empty($list['philhealth']) ? $list['philhealth'] : '';

                $report['created_by'] = !empty($auth['id']) ? $auth['id'] : '';
                
                $report['modified_by'] = !empty($auth['id']) ? $auth['id'] : '';

                $report['payroll_id'] = !empty($payroll_id) ? $payroll_id : '';

                if ($this->save($report)) {
                     $reportIds[] = $this->id;
                }
                   
            }
        }

        return $reportIds;
    }




}