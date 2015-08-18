<?php
// app/View/Helper/MyHtmlHelper.php
App::uses('HtmlHelper', 'View/Helper');

class SalariesHelper extends AppHelper {


function gross_pay($attendance = null,$salaries = null,$hours = 8)
{

	$data['gross'] = number_format(0,2);
	$data['time_work'] = number_format(0,2);
	$data['days'] = 0;

	if (!empty($attendance['Attendance'])) {

		foreach ($attendance['Attendance'] as $key => $days) {

			$data['time_work'] += $days['total_hours'];
		}

		$data['gross'] = ($salaries['basic_pay'] * $data['time_work']) / $hours;
		$data['days'] = count($attendance['Attendance']);

	}
	return $data;
}

function sss_pay( $attendance = null,$salaries = null,$sched = 'first',$gross_pay = 0 ){
	//sss agency id = 1;

	$pay = number_format(0,2);
	
	if ( $gross_pay != 0 && in_array(1,$attendance['Agency'])) {
			
			$SssRange = ClassRegistry::init('SssRange');
			
			$conditions = array('SssRange.range_from <=' => $gross_pay, 'SssRange.range_to >=' => $gross_pay);
			
			$range = $SssRange->find('first',array('conditions' => $conditions ));

			$pay = !empty($range['SssRange']['employees']) ? $range['SssRange']['employees'] : $pay;
	}

	return $pay;

}

function philhealth_pay($attendance = null,$salaries = null,$sched = 'first',$gross_pay = 0 ){

	//sss agency id = 2;

	$pay = number_format(0,2);
	
	if ( $gross_pay != 0 && in_array(2,$attendance['Agency'])) {
			
			$SssRange = ClassRegistry::init('PhilHealthRange');
			$conditions = array('PhilHealthRange.range_from >=' => $gross_pay);
			$range = $SssRange->find('first',array('conditions' => $conditions ));
			$pay = !empty($range['PhilHealthRange']['employee']) ? $range['PhilHealthRange']['employee'] : $pay;
			//$pay = $range['PhilHealthRange']['employees'];
	}

	return $pay;

}

}