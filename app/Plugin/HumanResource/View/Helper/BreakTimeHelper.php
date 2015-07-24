<?php
// app/View/Helper/MyHtmlHelper.php
App::uses('HtmlHelper', 'View/Helper');

class BreakTimeHelper extends AppHelper {


function getData($breakTimeId = null)
{	

	$break = '';

	if (!empty($breakTimeId)) {

		$break = ClassRegistry::init('BreakTime')->find('first',array(
					'conditions' => array('BreakTime.id' => $breakTimeId ),
					'fields' => array('BreakTime.name','BreakTime.from','BreakTime.to')
		));
			
	}

	return $break;

}

}