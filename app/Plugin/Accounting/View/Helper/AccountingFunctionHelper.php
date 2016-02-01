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


public function getDetails($clientOrderId = null) {
		$items = array();
		if (!empty($clientOrderId)) {
		
		$ClientOrder = ClassRegistry::init('Sales.ClientOrder');	

		$items = $ClientOrder->query('SELECT ClientOrder.id,ClientOrder.po_number,ClientOrder.uuid,Company.company_name,
		ClientOrderDeliverySchedule.id,ClientOrderDeliverySchedule.schedule 
		FROM koufu_sale.client_orders AS ClientOrder
        LEFT JOIN koufu_sale.client_order_delivery_schedules AS ClientOrderDeliverySchedule 
        ON ClientOrderDeliverySchedule.client_order_id = ClientOrder.id
        LEFT JOIN koufu_sale.companies AS Company 
        ON Company.id = ClientOrder.company_id
        WHERE ClientOrder.uuid = "'.$clientOrderId.'"');
		
		}

		return $items;
}


public function findByClientOrder($clientOrderId = null) {


		$ClientOrder = ClassRegistry::init('Sales.ClientOrder');	

		$items = $ClientOrder->query('SELECT ClientOrder.id,ClientOrder.po_number
		FROM koufu_sale.client_orders AS ClientOrder
        WHERE ClientOrder.uuid = "'.$clientOrderId.'"');

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