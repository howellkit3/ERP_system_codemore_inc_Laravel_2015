<?php
// app/View/Helper/MyHtmlHelper.php
App::uses('HtmlHelper', 'View/Helper');

class CustomEmployeeHelper extends AppHelper {

function findEmployee($empId = null, $bind = array()) {
	
	$Employee = ClassRegistry::init('HumanResource.Employee');
	
	if (!empty($bind)) {

		$Employee->bind($bind);
	}		
		

	$total = [];

	if (!empty($empId)) {

		$employee = $Employee->find('first',array('conditions' => array('Employee.id' => $empId ),'recursive' => -1));
	
	}


	return $employee;

}


}