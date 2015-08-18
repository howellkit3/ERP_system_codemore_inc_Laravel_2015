<?php
// app/View/Helper/MyHtmlHelper.php
App::uses('HtmlHelper', 'View/Helper');

class CustomEmployeeHelper extends AppHelper {

function findEmployee($empId = null) {

	$Employee = ClassRegistry::init('HumanResource.Employee');

	$total = [];

	if (!empty($empId)) {

		$employee = $Employee->find('first',array('conditions' => array('Employee.id' => $empId )));
	
	}	

	return $employee;

}


}