
<div style="clear:both"></div>

<?php echo $this->element('deliveries_options'); ?><br><br>

 <?php if(!empty($DeliveryReceiptData)){ ?>

      <?php  foreach ($DeliveryReceiptData as $deliveryReceiptList): ?>

<div class="row">
	<div class="col-lg-12">
		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					
             				
				</header>

			</div>
		</div>
				<?php echo $this->Form->create('DeliveryReceipt',array('url'=>(array('controller' => 'products','action' => 'view'))));?>			
			<div class="row">
				<div class="col-lg-12">
					<div class="main-box">
						<header class="main-box-header clearfix">

							<h2 class="pull-left">Delivery Receipt Details</h2>

							<?php 
                        		echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'deliveries','action' => 'dr_record'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    		?>

						</header>
						<div class="top-space"></div>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">									
									<div class="form-group">
										<label class="col-lg-2 control-label">D.R. Number</label>
										<input type="hidden" id="selected_type" value="<?php // echo $this->request->data['Product']['id']; ?>">
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('DeliveryReceipt.uuid', array(
	                                            								'class' => 'form-control item_type',
	                                            								'disabled' => true,
							                                                    'label' => false,       
							                                                    'placeholder' => 'Delivery Receipt Number',
							                                                    'value' => $deliveryReceiptList['DeliveryReceipt']['dr_uuid'],
							                                                    'fields' =>array('name')));
                                            ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Schedule</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('DeliveryReceipt.schedule', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'disabled' => true,
							                                                    'placeholder' => 'Schedule',
							                                                    'value' => date("F j, Y ", strtotime($deliveryReceiptList['DeliveryReceipt']['schedule'])),
							                                                    'fields' =>array('name')));
                                            ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Quantity</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('DeliveryReceipt.quantity', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'disabled' => true,
							                                                    'placeholder' => 'Quantity',
							                                                    'fields' =>array('name'),
							                                                    'value' => $deliveryReceiptList['DeliveryReceipt']['quantity']));
                                            ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Location</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('DeliveryReceipt.location', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'disabled' => true,
							                                                    'placeholder' => 'Location',
							                                                    'fields' =>array('name'),
							                                                    'value' => $deliveryReceiptList['DeliveryReceipt']['location']));
                                            ?>
										</div>
									</div>
									<?php $Fname = $printedFirstName[$deliveryReceiptList['DeliveryReceipt']['printed_by']]; 

										$Lname = $printedLastName[$deliveryReceiptList['DeliveryReceipt']['printed_by']];?>
									<div class="form-group">
										<label class="col-lg-2 control-label">Quantity</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('DeliveryReceipt.quantity', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'disabled' => true,
							                                                    'placeholder' => 'Quantity',
							                                                    'fields' =>array('name'),
							                                                    'value' => $Fname . ' ' . $Lname));
                                            ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Schedule</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('DeliveryReceipt.schedule', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'disabled' => true,
							                                                    'placeholder' => 'Schedule',
							                                                    'value' => date("F j, Y ", strtotime($deliveryReceiptList['DeliveryReceipt']['printed'])),
							                                                    'fields' =>array('name')));
                                            ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Remarks</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('DeliveryReceipt.remarks', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'disabled' => true,
							                                                    'placeholder' => 'Remarks',
							                                                    'value' => $deliveryReceiptList['DeliveryReceipt']['remarks']));
                                            ?>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		
		<?php echo $this->Form->end(); ?>	
	</div>
</div>

  <?php 
      endforeach; 
} 
?> 

<script>

	jQuery(document).ready(function($){
		//datepicker
		$('.datepick').datepicker({
			format: 'yyyy-mm-dd'
		});
		
	});

</script>