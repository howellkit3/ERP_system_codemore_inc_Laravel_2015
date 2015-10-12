<?php
App::uses('AppHelper', 'View/Helper');

/**
 * Helper for working with PHPExcel class.
 *
 * @package PhpExcel
 * @author segy
 */
class PlateMakingHelper extends AppHelper {



	public function getOffsetDetail($ticketId = null,$processId = null, $productId = null,$machines = array()) {

		$plateMaking = ClassRegistry::init('Ticket.PlateMakingProcess');	

		//$plateMaking->bindModel('Machine');
		$conditions = array(
	                'PlateMakingProcess.job_ticket_id' =>  $ticketId,
	                'PlateMakingProcess.process_id' => $processId,
	                
	        );

		if (!empty($productId)) {

			$conditions = array_merge($conditions,array(
					'PlateMakingProcess.product' => $productId
			));
		}

		$plateMaking  = $plateMaking->find('first',array(
	        'conditions' => $conditions 
	    ));

	    
		return $plateMaking;

	}
  
}