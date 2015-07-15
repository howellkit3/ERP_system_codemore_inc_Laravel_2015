<?php
// app/View/Helper/MyHtmlHelper.php
App::uses('HtmlHelper', 'View/Helper');

class CustomTextHelper extends AppHelper {


function getFullname($data = array())
{	

	$name = '';

	if (!empty($data)) {

		$name = $data['first_name'];

		if (!empty($data['middle_name'])) {
			$name .= ' '.$data['middle_name'];
		}

		$name .= ' '.$data['last_name'];


		if (!empty($data['suffix'])) {
			$name .= ' '.$data['suffix'];
		}
	}

	return $name;

}

}