<?php if(!empty($clientsOrder)) : ?>

	<?php foreach ($clientsOrder as $key => $value) { ?>

		<tr>
			<td> 

				<input name="data[Item]][<?php echo $key ?>][client_order_id]" value="<?php echo $value['ClientOrder']['id']; ?>" type="checkbox">
				<input name="data[Item]][<?php echo $key ?>][client_order_delivery_schedule]" value="<?php echo $value['ClientOrderDeliverySchedule']['id']; ?>" type="hidden">
				
			</td>

			<td> <?php echo $value['Product']['name']; ?> </td>

			<td> <?php echo $value['ClientOrder']['po_number']; ?> </td>

			<td>
				<input class="form-control required" name="data[Item]][<?php echo $key ?>][quantity]" value="" type="number" placeholder="0.00" >
			</td>

			<td>
				<div class="col-lg-6">
				<input  class="form-control required" name="data[Item]][<?php echo $key ?>][pieces]" value="" type="number" placeholder="0" >
				</div>

				<div class="col-lg-6">
				 <?php 
                                    echo $this->Form->input('DeliveryDetail'.$key.'measure', array(         
                                                                    'required' => 'required',
                                                                    'class' => 'form-control required  ',

                                                                    'options' => array($measureList),
                                                                    'empty' => '--Select Measure--',
                                                                    'label' => false,
                                                                    'type' => 'select',
                                                                    'required' => 'required',
                                                                    ));
                                ?>
                </div>
                          
			</td>

			<td>
				<input  class="form-control required" name="data[Item]][<?php echo $key ?>][remarks]" value="" type="text" placeholder="" >
			</td>
		</tr>

	<?php } ?>


<?php else : ?>
<tr>
	<td> No Result found</td>
</tr>

<?php endif; ?>
