<?php
// app/View/Helper/MyHtmlHelper.php
App::uses('HtmlHelper', 'View/Helper');

class ProcessHelper extends AppHelper {


function getData($ticketProcessHolderId = null,$jobTicketId = null)
{	

	$process = '';

	if (!empty($ticketProcessHolderId)) {

		$conditions = array(
			'TicketProcessSchedule.product_specification_process_holder_id' => $ticketProcessHolderId,
			'TicketProcessSchedule.job_ticket_id' =>$jobTicketId
			);

		$process = ClassRegistry::init('TicketProcessSchedule')->find('first',array(
					'conditions' => $conditions,
					//'fields' => array('BreakTime.name','BreakTime.from','BreakTime.to')
		));
			
	}

	return $process;

}

}