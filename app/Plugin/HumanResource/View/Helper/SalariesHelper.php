<?php
// app/View/Helper/MyHtmlHelper.php
App::uses('HtmlHelper', 'View/Helper');

class SalariesHelper extends AppHelper {


function gross_pay($attendance = null,$salaries = null,$hours = 8)
{

	$data['gross'] = number_format(0,2);
	$data['time_work'] = number_format(0,2);
	$data['days'] = 0;

	if (!empty($attendance)) {

		foreach ($attendance as $key => $days) {

			$data['time_work'] += $days['total_hours'];
		}

		$data['gross'] = ($salaries['basic_pay'] * $data['time_work']) / $hours;
		$data['days'] = count($attendance);

	}
	return $data;
}

function sss_pay($attendance = null,$salaries = null,$sched = 'first',$gross_pay = 0){

	$pay = number_format(0,2);
	
	if ($sched == 'first' && $gross_pay != 0) {
			
			$SssRange = ClassRegistry::init('SssRange');
			
			$conditions = array('SssRange.range_from <=' => $gross_pay, 'SssRange.range_to >=' =>$gross_pay);
			
			$range = $SssRange->find('first',array('conditions' => $conditions ));

			$pay = !empty($range['SssRange']['employees']) ? $range['SssRange']['employees'] : $pay;
	}

	return $pay;

}

function philhealth_pay($attendance = null,$salaries = null,$sched = 'first',$gross_pay = 0){

	$pay = number_format(0,2);
	
	if ($sched == 'first' && $gross_pay != 0) {
			
			$SssRange = ClassRegistry::init('PhilHealthRange');
			$conditions = array('PhilHealthRange.range_from >=' => $gross_pay);
			$range = $SssRange->find('first',array('conditions' => $conditions ));
			$pay = !empty($range['PhilHealthRange']['employee']) ? $range['PhilHealthRange']['employee'] : $pay;
			//$pay = $range['PhilHealthRange']['employees'];
	}

	return $pay;

}

}