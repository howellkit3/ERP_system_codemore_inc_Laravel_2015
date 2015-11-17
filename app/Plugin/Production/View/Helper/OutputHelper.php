<?php
// app/View/Helper/MyHtmlHelper.php
App::uses('HtmlHelper', 'View/Helper');

class OutputHelper extends AppHelper {

function findNext($outputId = null,$tickeSchedule = null,$jobticketId = null) {
		

		$Output = ClassRegistry::init('Production.Output');

		$Output->bind(array('MachineLog','TicketProcessSchedule'));

		$out = $Output->find('first',array(
			'conditions' => array(
					'Output.id NOT' => $outputId,
					'Output.status' => ''

			),
			'order' => array('Output.order ASC')
		));

		return $out;

		// pr($out);

		// exit();

		// if (!empty($employeeIds)) {

		// 	$ids = json_decode($employeeIds);

		// 	$employees = $Employee->find('list',array(
		// 		'conditions' => array(
		// 			'Employee.id' => $ids
		// 		),
		// 		'group' => array('Employee.id'),
		// 		'fields' => array('id','full_name')
		// 	));
		
		// }

		//return $employees;
}

function findCurrent($tickeSchedule = null,$jobticketId = null) {
		

		$Output = ClassRegistry::init('Production.Output');

		$Schedule = ClassRegistry::init('Production.TicketProcessSchedule');


		$Schedule->bind(array('ProcessDepartment'));

		$out = $Schedule->find('first',array(
			'conditions' => array(
					'TicketProcessSchedule.status' => 0,
					'TicketProcessSchedule.id' => $tickeSchedule

			),
			'order' => array('TicketProcessSchedule.order DESC')
		));

		return $out;

		// pr($out);

		// exit();

		// if (!empty($employeeIds)) {

		// 	$ids = json_decode($employeeIds);

		// 	$employees = $Employee->find('list',array(
		// 		'conditions' => array(
		// 			'Employee.id' => $ids
		// 		),
		// 		'group' => array('Employee.id'),
		// 		'fields' => array('id','full_name')
		// 	));
		
		// }

		//return $employees;
}

}