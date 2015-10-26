<?php    foreach ($receivedItemData as $key => $receivedOrderDataList) {  ?>
		<tr class="">
			<td>
				<?php echo $supplierName[$purchaseOrderSupplier[$receivedOrderDataList['DeliveredOrder']['purchase_orders_id']]]; ?>
			</td>

			<td>
				<?php echo $purchaseOrderPONum[$receivedOrderDataList['DeliveredOrder']['purchase_orders_id']]; ?>
			</td>

			<td>

			<?php echo $receivedOrderDataList['DeliveredOrder']['si_num']?>

			</td>
			<td>
				<?php echo $receivedOrderDataList['DeliveredOrder']['dr_num']?>
			</td>
			<td>
				<?php echo $receivedOrderDataList['DeliveredOrder']['created']?>
			</td>
			<td>
				<?php echo $receivedOrderDataList['DeliveredOrder']['item_name']?>
			</td>
			<td>
			<?php 

			if(!empty($receivedOrderDataList['ReceivedItem']['reject_quantity'])){
				
				$quantityHolder = $receivedOrderDataList['ReceivedItem']['quantity'] + $receivedOrderDataList['ReceivedItem']['reject_quantity'];

			}else{

				$quantityHolder = $receivedOrderDataList['ReceivedItem']['quantity'];

			}

			echo $quantityHolder?>

			</td>

			<td><?php echo $receivedOrderDataList['ReceivedItem']['quantity']?></td>

			<td><?php echo $receivedOrderDataList['ReceivedItem']['reject_quantity']?>
			</td>

			<td><?php echo $receivedOrderDataList['ReceivedItem']['unit_price']?>
			</td>

			<td><?php echo $receivedOrderDataList['ReceivedItem']['unit_price']* $quantityHolder ?>
			</td>

			<td><?php echo $userName[$receivedOrderDataList['DeliveredOrder']['created_by']] ?>
			</td>
		</tr>
	<?php } ?>