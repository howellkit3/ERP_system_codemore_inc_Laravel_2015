<?php
// app/View/Helper/MyHtmlHelper.php
App::uses('HtmlHelper', 'View/Helper');

class CustomTimeHelper extends AppHelper {


function getDuration($time1 = null,$time2 = null)
{	

	if (!empty($time1) && $time2) {

		$date = date('Y-m-d');
		$date1 = new DateTime($date.' '.$time1);
		$date2 = new DateTime($date.' '.$time2);

		$interval = $date1->diff($date2);

		$difference = '';

			if ($interval->d != 0){
				$days = ($interval->d > 1) ? 'days' : 'day';
			$difference	.= $interval->d  .' '.$days;
			}
			else{
				if ($interval->h != 0){
					$difference .= $interval->h  . ' hours';
				} 
			}

			if ($interval->d == 0 && $interval->invert == 0 && $interval->i != 0) {
				if ($interval->h != 0) {
				  $difference .= ' & ';
				}
				$minutes = ' min';

				if ($interval->i > 1) {
					$minutes = ' mins';
				}
				$difference .= $interval->i  .$minutes;
			}

		return $difference;
	}
}

public function formaTime($time = null, $separator = null) {

	if (!empty($time)) {

		$time  = explode($separator,$time);

		$formated = '';

		$parts = array('hours','minutes','seconds');

		foreach ($time as $key => $value) {
				
				$formated[] = $value.$parts[$key];   
		}

		return implode(' '.$separator.' ', $formated);
	}
}

}