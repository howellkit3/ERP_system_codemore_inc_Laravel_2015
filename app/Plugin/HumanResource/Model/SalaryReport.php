<?php
App::uses('AppModel', 'Model');

class SalaryReport extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'SalaryReport';

    public $actsAs = array('Containable');

 	 public function bind($model = array('Group')){

		$this->bindModel(
			array(
			'belongsTo' => array(
				'Employee' => array(
					'className' => 'HumanResource.Employee',
					'foreignKey' => 'employee_id'),
				'EmployeeAdditionalInformation' => array(
					'className' => 'HumanResource.EmployeeAdditionalInformation',
					'foreignKey' => 'employee_id'),
				'SssRecord' => array(
					'className' => 'HumanResource.GovernmentRecord',
					'foreignKey' => 'employee_id',
					'conditions' => array('SssRecord.agency_id' => 1)
					),
				'Position' => array(
					'className' => 'HumanResource.Position',
					'foreignKey' => false,
					'conditions' => array('Position.id = Employee.position_id')
					),
				)
			),false);

		$this->contain($model);
	}

	public function getTotalContribution($data = null,$agency = null){

		if (!empty($agency)) {
			
			$arr = array();

			foreach($data as $key => $item)
			{
				$arr[$item['SalaryReport']['employee_id']][$key] = $item;
			}

			ksort($arr, SORT_NUMERIC);

			return $arr;
		}
	}
}