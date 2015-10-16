<?php
// app/View/Helper/MyHtmlHelper.php
App::uses('HtmlHelper', 'View/Helper');

class OvertimeHelper extends AppHelper {


function findEmployee($employeeIds = array()) {
	
	$Employee = ClassRegistry::init('Employee');

		if (!empty($overtimes['Overtime']['employee_ids'])) {

			$ids = json_decode($overtimes['Overtime']['employee_ids']);

			$employees = $Employee->find('all',array(
				'conditions' => array(
					'Employee.id' => $ids
				)
			));

			pr($employees);

		}


		exit();
}