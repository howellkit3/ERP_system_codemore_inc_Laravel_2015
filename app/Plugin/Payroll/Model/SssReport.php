<?php
App::uses('AppModel', 'Model');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class SssReport extends AppModel {

	public $useDbConfig = 'koufu_payrolls';

    public $name = 'SssReport';

    var $useTable = 'sss_reports';

    public $recursive = -1;
    
	public $actsAs = array('Containable');

    public function bind($model = array('Group')){

      $this->bindModel(
            array(
            'belongsTo' => array(
                'Employee' => array(
                    'className' => 'HumanResource.Employee',
                    'foreignKey' => 'employee_id'),
                'SSS' => array(
                    'className' => 'HumanResource.GovernmentRecord',
                    'foreignKey' => false,
                    'conditions' => array('SSS.employee_id = Employee.id')
                ),
                ),


            ),false);


        $this->contain($model);
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
                $report['employer'] = !empty($list['sss_employer']) ? $list['sss_employer'] : '';
                $report['employee'] = !empty($list['sss']) ? $list['sss'] : '';
                $report['compensation'] = !empty($list['sss_compensation']) ? $list['sss_compensation'] : '';

                $report['from'] =  $list['from'];
                $report['to'] = $list['to'];
                $report['sched'] = $list['sched'];

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