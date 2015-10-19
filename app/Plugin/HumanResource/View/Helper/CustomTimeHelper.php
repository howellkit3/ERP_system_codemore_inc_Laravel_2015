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

	if (!empty($time1) && !empty($time2) && !empty($workschedulesBreaks['id'])) {

		//workschedules
		$timeIn = date('h:i:s',strtotime($time1));


		if (!empty($workschedules)) {


			if (strtotime($timeIn) > strtotime($workschedules['from'])) {

				$timeIn = date('H:i',strtotime($timeIn)).':00';

			} else {

				$timeIn = $workschedules['from'];
			}


			$timeOut = date('H:i:s',strtotime($time2));

			if (strtotime($timeOut) > strtotime($workschedules['to'])) {

				$timeOut = $workschedules['to'];

			} else {
				
				$timeOut = date('H:i',strtotime($time2)).':00';
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


function getDurationScheduleTime($time1 = null,$time2 = null,$workschedules = null,$workschedulesBreaks = null)
{	

	$difference = '00:00';

	if (!empty($time1) && !empty($time2) && !empty($workschedulesBreaks['id'])) {


		$today = date('Y-m-d',strtotime($time1));

		$logout = date('Y-m-d',strtotime($time2));
		
		//workschedules
		$timeIn = date('Y-m-d h:i',strtotime($time1)).':00';



		if (!empty($workschedules)) {

			$defaultFrom = $today.' '.$workschedules['from'];


			if (strtotime($timeIn) > strtotime($defaultFrom)) {

				$timeIn = $timeIn;

			} else {

				$timeIn = $today.' '.$workschedules['from'];
			}


			$timeOut = date('H:i',strtotime($time2)).':00';

			if (strtotime($timeOut) > strtotime($workschedules['to'])) {

				$timeOut = $logout.' '.$workschedules['to'];

			} else {

				$timeOut = $time2;
			}

		
		}

		if (!empty($workschedulesBreaks)) {

	
			$timestamp = strtotime($timeOut);

			$out = date('H:i:s', $timestamp);


			//substract lunchbreaktime
			if ($timeOut > $workschedulesBreaks['from'] && $out >  $workschedulesBreaks['to']) {

					$timeOut = strtotime($timeOut) - 3600;
					$timeOut = $logout.' '.date('H:i',$timeOut).':00';
	

			}	

			// if ($timeOut > $workschedulesBreaks['from']) {

			// 	$timeOut = $today.' '.date('H:',strtotime($timeOut)).'00:00';
			// }


			$myBreakFrom = $today.' '.  $workschedulesBreaks['from'];
			$myBreakTo = $logout.' '.  $workschedulesBreaks['to'];


			$breakHour = strtotime($workschedulesBreaks['from']) + 3600;

			$todayBreak =  $logout.' '.date('H:i:s',$breakHour);


			if (strtotime($time2) >= strtotime($myBreakFrom) && strtotime($time2) <= strtotime($todayBreak)) {

				$timeOut = $logout.' '.date('H:',strtotime($time2)).'00:00';


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
					$difference .= sprintf("%02d", $interval->h);
				} 
			}

			if ($interval->d == 0 && $interval->invert == 0 && $interval->i != 0) {
				
				if ($interval->h != 0) {
				  $difference .= ':';
				}
				// $minutes = 'm';

				// if ($interval->i > 1) {
				// 	$minutes = 'm';
				// }

				$difference .= sprintf("%02d", $interval->i);

			} else {

				$difference .= ':00';

			}

		
	}
	return $difference;
}

function addWorkTime($times = array()) {

	  $minutes = '';
    // loop throught all the times
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