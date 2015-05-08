<?php
App::uses('HtmlHelper', 'View/Helper');

class DateFormatHelper extends HtmlHelper {
    
	    
	    
	function isValidDateTimeString($str_dt) {
	 	 return (bool)strtotime($str_dt);
	}
    
}
?>