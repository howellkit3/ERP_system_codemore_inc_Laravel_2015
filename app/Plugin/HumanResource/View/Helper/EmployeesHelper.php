<?php
// app/View/Helper/MyHtmlHelper.php
App::uses('HtmlHelper', 'View/Helper');

class EmployeesHelper extends AppHelper {


function overtimeEmployee($employeeIds = array()) {
		

		$employees = array();

		$Employee = ClassRegistry::init('Employee');

		if (!empty($employeeIds)) {

			$ids = json_decode($employeeIds);

			$employees = $Employee->find('list',array(
				'conditions' => array(
					'Employee.id' => $ids
				),
				'group' => array('Employee.id'),
				'fields' => array('id','full_name')
			));
		
		}

		return $employees;
}

}