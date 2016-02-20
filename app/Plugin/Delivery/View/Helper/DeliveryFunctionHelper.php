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

		$clientsOrder = array();

		if (!empty($clientsOrderId)) {

			$clientsOrder = $ClientsOrder->find('first',array(
				'conditions' => array('uuid' => $clientsOrderId)
			));	
		}

		return $clientsOrder;

	}

	public function getbyScheduleID($uuidClientsOrder = null,$status = 3) {

		$arr = array();

		if (!empty($uuidClientsOrder)) {

			$Delivery = ClassRegistry::init('Delivery.Delivery');

			$Delivery->bindDeliveryCount();

			$delivery = $Delivery->find('all',array(
				'conditions' => array(
					'schedule_uuid' => $uuidClientsOrder,
					//'status' => $status
				),
				'fields' => array(
						'Delivery.id',
						'Delivery.schedule_uuid',
						'Delivery.status',
						'Delivery.clients_order_id',
						'DeliveryDetail.id',
						'DeliveryDetail.delivered_quantity',
						'DeliveryDetail.status',
						'DeliveryDetail.quantity'
				),
				'group' => 'Delivery.id'
				
			));


			return $delivery;
		}
	}
}