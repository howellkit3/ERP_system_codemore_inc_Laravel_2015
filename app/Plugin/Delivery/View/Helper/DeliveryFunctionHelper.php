<?php
App::uses('AppHelper', 'View/Helper');

/**
 * Helper for working with PHPExcel class.
 *
 * @package PhpExcel
 * @author segy
 */
class DeliveryFunctionHelper extends AppHelper {


	public function getIttems($deliveryID, $drUuid = null) {

		$deliveryReciept = ClassRegistry::init('Delivery.DeliveryReceipt');
			
		if (!empty($drUuid)) {
			
			$items = $deliveryReciept->find('all',array(
				'conditions' => array('dr_uuid' => $drUuid)
			));	
		}
		
		return $items;
	}

	public function getClientsOrder($clientsOrderId = null) {

		$ClientsOrder = ClassRegistry::init('Sales.ClientOrder');

		if (!empty($clientsOrderId)) {

			$clientsOrder = $ClientsOrder->find('first',array(
				'conditions' => array('uuid' => $clientsOrderId)
			));	
		}

		return $clientsOrder;

	}

	public function getBySchedule($uuidClientsOrder = null) {

		$arr = array();

		if (!empty($uuidClientsOrder)) {

			$Delivery = ClassRegistry::init('Delivery.Delivery');

			$delivery = $Delivery->find('all',array(
				'conditions' => array(
					'schedule_uuid' => $uuidClientsOrder,
				)
				
			));

			foreach ($delivery as $key => $list) {
				
				 if( $list['DeliveryDetail']['status'] != 5 && $value['Delivery']['status'] != 2 ){
                                                   
                   		array_push($arr,$value['DeliveryDetail']['delivered_quantity']);
				 }
			}

		}
	}
}