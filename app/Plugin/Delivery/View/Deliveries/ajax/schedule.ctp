<?php if (!empty($clientOrder)) : ?>
	<?php foreach ($clientOrder as $key => $value) { ?>
			<tr>	
				<td>
					<input type="checkbox" class="checkbox-item" name="data['ClientOrderDeliverySchedule']['id']" value="<?php echo $value['ClientOrderDeliverySchedule']['id'];?>" data-po="<?php echo $value['ClientOrder']['po_number']?>" data-schedule="<?php echo $value['ClientOrderDeliverySchedule']['schedule'] ?>" data-client="<?php echo $value['ClientOrder']['id']; ?>">
						<?php echo $value['Product']['name']; ?>
				</td>
				<td>
					<?php echo $value['ClientOrder']['po_number']; ?>
				</td>
				<td>
					<?php //echo $value['ClientOrder']['po_number']; ?>
				</td>
				<td>
					<?php echo !empty($value['ClientOrderDeliverySchedule']['schedule']) ? date('Y/m/d',strtotime($value['ClientOrderDeliverySchedule']['schedule'])) : ''; ?>
				</td>
			</tr>
	<?php } ?>

<?php endif; ?>