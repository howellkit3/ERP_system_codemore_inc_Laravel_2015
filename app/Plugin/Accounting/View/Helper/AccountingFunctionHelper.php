<?php
App::uses('AppHelper', 'View/Helper');

/**
 * Helper for working with PHPExcel class.
 *
 * @package PhpExcel
 * @author segy
 */
class AccountingFunctionHelper extends AppHelper {


	public function getItems($drUuid = null,$client_order_id = null) {

		$ClientOrder = ClassRegistry::init('Delivery.Delivery');

		$Delivery = ClassRegistry::init('Delivery.Delivery');
		
		$items = array();

		if (!empty($drUuid)) {


		$items = $Delivery->query('SELECT *
        FROM deliveries AS Delivery
        LEFT JOIN koufu_sale.client_orders AS ClientOrder
        ON ClientOrder.uuid = Delivery.clients_order_id
        LEFT JOIN koufu_sale.client_order_delivery_schedules AS ClientOrderDeliverySchedule
        ON ClientOrderDeliverySchedule.client_order_id = ClientOrder.id
        WHERE Delivery.dr_uuid = "'.$drUuid.'"');
	
		}

	return $items;	
	

}

	// public function getItems($clientsOrderId = null) {

	// 	$ClientsOrder = ClassRegistry::init('Sales.ClientOrder');

	// 	if (!empty($clientsOrderId)) {

	// 		$clientsOrder = $ClientsOrder->find('first',array(
	// 			'conditions' => array('id' => $clientsOrderId)
	// 		));	
	// 	}

	// 	return $clientsOrder;

	// }
}