<?php
// app/View/Helper/MyHtmlHelper.php
App::uses('HtmlHelper', 'View/Helper');

class CustomTimeHelper extends AppHelper {

function getTotalWorks($empId = null) {

	$attendance = ClassRegistry::init('Attendance');

	$total = array();

	if (!empty($empId)) {

		$total = $attendance->find('all',array('conditions' => array('Attendance.employee_id' => $empId )));
	
		foreach ($total as $key => $value) {
				
				$total['total_time'] = $this->getduration($value['Attendance']['in'],$value['Attendance']['out']);
		}
	}	


	return $total;

}
function getDuration($time1 = null,$time2 = null)
{	

	if (!empty($time1) && $time2) {

		$date = date('Y-m-d');
		$date1 = new DateTime($time1);
		$date2 = new DateTime($time2);

		$interval = $date1->diff($date2);

		$difference = '';

			if ($interval->d != 0){
				$days = ($interval->d > 1) ? 'days' : 'day';
			$difference	.= $interval->d  .' '.$days;
			}
			else{
				if ($interval->h != 0){
					$difference .= $interval->h  . 'h';
				} 
			}

			if ($interval->d == 0 && $interval->invert == 0 && $interval->i != 0) {
				if ($interval->h != 0) {
				  $difference .= ' & ';
				}
				$minutes = 'm';

				if ($interval->i > 1) {
					$minutes = 'm';
				}
				$difference .= $interval->i  .$minutes;
			}

		return $difference;
	}
}

function getDurationSchedule($time1 = null,$time2 = null,$workschedules = null,$workschedulesBreaks = null)
{	


	if (!empty($time1) && $time2 && !empty($workschedulesBreaks['id'])) {

		//workschedules
		$timeIn = date('h:i:s',strtotime($time1));

		if (!empty($workschedules)) {

			if (strtotime($time1) > strtotime($workschedules['from'])) {

				$timeIn = $time1;
			} else {

				$timeIn = $workschedules['from'];
			}

			if (strtotime($time2) > strtotime($workschedules['to'])) {

				$timeOut = $workschedules['to'];

			} else {

				$timeOut = $time2;
			}

		}

		if (!empty($workschedulesBreaks)) {

			//substract lunchbreaktime
			if ($timeOut > $workschedulesBreaks['from'] && $timeOut >  $workschedulesBreaks['to']) {

					$timeOut = strtotime($timeOut) - 3600;
					$timeOut = date('H:i:s',$timeOut);

			}


		}

		
		$date = date('Y-m-d');
		$date1 = new DateTime($timeIn);
		$date2 = new DateTime($timeOut);

		$interval = $date1->diff($date2);

		$difference = '';

			if ($interval->d != 0) {

				$days = ($interval->d > 1) ? 'days' : 'day';
				$difference	.= $interval->d  .' '.$days;

			} else {

				if ($interval->h != 0){
					$difference .= $interval->h  . 'h';
				} 
			}

			if ($interval->d == 0 && $interval->invert == 0 && $interval->i != 0) {
				
				if ($interval->h != 0) {
				  $difference .= ' & ';
				}
				$minutes = 'm';

				if ($interval->i > 1) {
					$minutes = 'm';
				}

				$difference .= $interval->i  .$minutes;
			}


		return $difference;
	}
}

function getDurationTime($time1 = null,$time2 = null)
{	

	if (!empty($time1) && $time2) {

		$date = date('Y-m-d');
		$date1 = new DateTime($date.' '.$time1);
		$date2 = new DateTime($date.' '.$time2);

		$interval = $date1->diff($date2);

		$difference = '';

			// if ($interval->d != 0){
			// 	$days = ($interval->d > 1) ? 'days' : 'day';
			// $difference	.= $interval->d  .' '.$days;
			// }
			if ($interval->h != 0){
				$difference .= $interval->h;
			} 
			if ($interval->d == 0 && $interval->invert == 0 && $interval->i != 0) {
				if ($interval->h != 0) {
				  $difference .= ':';
				  $difference .= $interval->i.':00';
				} else {
					$difference .= $interval->i.':00:00';
				}
				
			} else {
				$difference = $interval->h.':00:00';
			}

		return $difference;
	}
}


function AddTime($times) {

	if (!empty($times)) {
		$minutes  = '00:00:00';
	  	 foreach ($times as $time) {
	        list($hour, $minute) = explode(':', $time);
	        $minutes += $hour * 60;
	        $minutes += $minute;
	    }

	    $hours = floor($minutes / 60);
	    $minutes -= $hours * 60;

	    // returns the time already formatted
	    return sprintf('%02d:%02d', $hours, $minutes);
	}
  
}

public function formaTime($time = null, $separator = null) {

	if (!empty($time)) {

		$time  = explode($separator,$time);

		$formated = '';

		$parts = array('hours','minutes','seconds');

		foreach ($time as $key => $value) {
				
				$formated[] = $value.' '.$parts[$key];   
		}

		return implode(' '.$separator.' ', $formated);
	}
}

}