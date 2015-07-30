<?php
// app/View/Helper/MyHtmlHelper.php
App::uses('HtmlHelper', 'View/Helper');

class CustomTextHelper extends AppHelper {


function getFullname($data = array(),$fistname = 'first_name',$middle_name = 'middle_name',$last_name = 'last_name',$suffix = 'suffix')
{	

	$name = '';

	if (!empty($data)) {

		$name = $data[$fistname];

		if (!empty($data[$middle_name])) {
			$name .= ' '.$data[$middle_name];
		}

		$name .= ' '.$data[$last_name];


		if (!empty($data[$suffix])) {
			$name .= ' '.$data[$suffix];
		}
	}

	return $name;

}

}