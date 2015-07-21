
<div style="clear:both"></div>

<?php echo $this->element('deliveries_options'); ?><br><br>

 <?php if(!empty($transmittalData)){ ?>

      <?php  foreach ($transmittalData as $transmittalDataList): ?>

<div class="row">
	<div class="col-lg-12">
		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					
                    
					<h1 class="pull-left">
						<?php
							//echo ucfirst($companyName[$clientOrderData['ClientOrder']['company_id']]); 
						?>
					</h1>
					<?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'products','action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
				</header>

			</div>
		</div>
				<?php echo $this->Form->create('Transmittal',array('url'=>(array('controller' => 'products','action' => 'view'))));?>			
			<div class="row">
				<div class="col-lg-12">
					<div class="main-box">
						<header class="main-box-header clearfix">
						<h2 class="pull-left">Tranmittal Details</h2>
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
	                                            echo $this->Form->input('Transmittal.uuid', array(
	                                            								'class' => 'form-control item_type',
	                                            								'disabled' => true,
							                                                    'label' => false,       
							                                                    'placeholder' => 'Delivery Receipt Number',
							                                                    'value' => $transmittalDataList['Transmittal']['tr_uuid'],
							                                                    'fields' =>array('name')));
                                            ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Contact Person</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('Transmittal.contact_person', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'disabled' => true,
							                                                    'placeholder' => 'Schedule',
							                                                    'value' => $transmittalDataList['Transmittal']['contact_person'],
							                                                    'fields' =>array('name')));
                                            ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Quantity</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('Transmittal.quantity', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'disabled' => true,
							                                                    'placeholder' => 'Quantity',
							                                                    'fields' =>array('name'),
							                                                    'value' => $transmittalDataList['Transmittal']['quantity']));
                                            ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Location</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('Transmittal.location', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'disabled' => true,
							                                                    'placeholder' => 'Location',
							                                                    'fields' =>array('name'),
							                                                    'value' => $transmittalDataList['DeliveryDetail']['location']));
                                            ?>
										</div>
									</div> 
									<?php $Fname = $printedFirstName[$transmittalDataList['Transmittal']['created_by']]; 

										$Lname = $printedLastName[$transmittalDataList['Transmittal']['created_by']];?>
									<div class="form-group">
										<label class="col-lg-2 control-label">Printed By:</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('Transmittal.printed', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'disabled' => true,
							                                                    'placeholder' => 'Location',
							                                                    'fields' =>array('name'),
							                                                    'value' => $Fname . ' ' . $Lname ));
                                            ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Schedule</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('Tranmittal.schedule', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'disabled' => true,
							                                                    'placeholder' => 'Schedule',
							                                                    'value' => date("F j, Y ", strtotime($transmittalDataList['Transmittal']['created'])),
							                                                    'fields' =>array('name')));
                                            ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Remarks</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('Transmittal.remarks', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'disabled' => true,
							                                                    'placeholder' => 'Remarks',
							                                                    'value' => $transmittalDataList['Transmittal']['remarks']));
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