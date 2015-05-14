<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Clients Order', array('controller' => 'sales_orders', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('View', array('controller' => 'sales_orders', 'action' => 'view',$clientOrderData['ClientOrder']['id'])); ?>
<?php echo $this->Html->script('Sales.inquiry');?>
<?php echo $this->Html->script('Sales.quantityLimitview');?>
<div style="clear:both"></div>

<?php echo $this->element('sales_option');?><br><br>
 
<div class="row">
	<div class="col-lg-12">		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					
					<h1 class="pull-left">
						Clients Order View
					</h1>
					<?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'sales_orders', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
				</header>

			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="main-box">
					<div class="top-space"></div>
					<div class="main-box-body clearfix">
						<div class="main-box-body clearfix">
							<div class="form-horizontal">
								<?php 
                                    echo $this->Form->input('Company.id', array('class' => 'form-control item_type',
				                        'hidden' => 'hidden',
				                        'readonly' => 'readonly',
				                        'label' => false,
				                        'id' => 'id'));
                                ?>

                                <div class="form-group">
                                	<label class="col-lg-2 control-label">Company</label>
									<div class="col-lg-8">
										<?php 
                                            echo $this->Form->input('ClientOrder.company', array(

                                            								'class' => 'form-control item_type',
						                                                    'label' => false,
						                                                    'readonly' => 'readonly',
						                                                    'value' => ucfirst($companyName[$clientOrderData['ClientOrder']['company_id']])
						                                                    ));
                                        ?>
									</div>
								</div>

								<div class="form-group">
                                	<label class="col-lg-2 control-label">Attention</label>
									<div class="col-lg-8">
										

	                                        <?php echo $this->Form->input('Quotation.attention_details', array(
											'type' => 'hidden',
			                                'readonly' => 'readonly',
			                                'label' => false,
			                                'class' => 'form-control',
			                                'value' => ucfirst($quotationData['Quotation']['attention_details'])
			                                 )); 

			                            ?>
										<?php echo $this->Form->input('Quotation.attention_details_name', array(
											'type' => 'text',
			                                'readonly' => 'readonly',
			                                'label' => false,
			                                'class' => 'form-control',
			                                'value' => 
			                                ucfirst($quotationData['ContactPerson']['firstname']).' '.
			                                ucfirst($quotationData['ContactPerson']['lastname'])
			                                 )); 

			                            ?>
									</div>
								</div>

								<div class="form-group">
                            		<label class="col-lg-2 control-label">PQ no.</label>
									<div class="col-lg-8">
										<?php 
                                            echo $this->Form->input('Quotation.uuid_field', array(
                                            								'class' => 'form-control item_type',
						                                                    'label' => false,
						                                                    'readonly' => 'readonly',
						                                                    'value' => 'PQ-'.$quotationData['Quotation']['uuid']));
                                        ?>
										  
									</div>
								</div>

                                <div class="form-group">
                                	<label class="col-lg-2 control-label">CO no.</label>
									<div class="col-lg-8">
										<?php 
                                            echo $this->Form->input('ClientOrder.uuid', array(
                                            								'class' => 'form-control item_type',
						                                                    'label' => false,
						                                                    'readonly' => 'readonly',
						                                                    'value' => $clientOrderData['ClientOrder']['uuid']));
                                        ?>
									</div>
								</div>

								<div class="form-group" id="existing_items">
									<label class="col-lg-2 control-label">PO no.</label>
									<div class="col-lg-8">
										<?php 
                                            echo $this->Form->input('ClientOrder.po_number', array(
                                            								'class' => 'form-control item_type',
						                                                    'label' => false,
						                                                    'readonly' => 'readonly',
						                                                    'value' => $clientOrderData['ClientOrder']['po_number']));
                                        ?>
									</div>	
								</div>

								<?php if (!empty($clientOrderData['ClientOrder']['name'])) { ?>
									<div class="form-group">
	                                	<label class="col-lg-2 control-label">Order Name</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('ClientOrder.name', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'readonly' => 'readonly',
							                                                    'value' => $clientOrderData['ClientOrder']['name']));
	                                        ?>
										</div>
									</div>
								<?php } ?>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="main-box">
					<header class="main-box-header clearfix">
						<h2 class="pull-left">Client Order Details</h2>
					</header>
					<div class="main-box-body clearfix">
						<div class="main-box-body clearfix">
							<div class="form-horizontal">
								<?php 
		                            echo $this->Form->input('Company.id', array('class' => 'form-control item_type',
				                        'hidden' => 'hidden',
				                        'readonly' => 'readonly',
				                        'label' => false,
				                        'id' => 'id'));
		                        ?>

	                        

		                        <div class="form-group">
		                        	<label class="col-lg-2 control-label">Item Name</label>
									<div class="col-lg-8">
										<?php 
		                                    echo $this->Form->input('ClientOrder.name', array(
		                                    								'class' => 'form-control item_type',
						                                                    'label' => false,
						                                                    'readonly' => 'readonly',
						                                                    'value' => $quotationData['Product']['name']));
		                                ?>
									</div>
								</div>

								<div class="form-group" id="existing_items">
									<label class="col-lg-2 control-label">Payment Terms</label>
									<div class="col-lg-8">
										<?php 
										
		                                   $paymentTerms = !empty($paymentTermData[$quotationData['Quotation']['payment_terms']]) ? $paymentTermData[$quotationData['Quotation']['payment_terms']] : '';

                                            echo $this->Form->input('PaymentTermHolder.name', array(
                                            								'class' => 'form-control item_type',
						                                                    'label' => false,
						                                                    'readonly' => 'readonly',
						                                                    'value' => $paymentTerms
						                                                     ));
		                                ?>	
									</div>
								</div>
								
		                    	<div class="form-group">
		                    		<label class="col-lg-2 control-label">Remarks</label>
									<div class="col-lg-8">
										<?php 
		                                    echo $this->Form->input('ClientOrder.remarks', array(
		                                    								'class' => 'form-control item_type',
						                                                    'label' => false,
						                                                    'readonly' => 'readonly',
						                                                    'value' => $clientOrderData['ClientOrder']['remarks']));
		                                ?>	
		                            </div>
								</div>
							</div>							
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="main-box">
					<header class="main-box-header clearfix">
						<h2 class="pull-left">Client Order Item Details</h2>
					</header>
					<div class="main-box-body clearfix">
						<div class="main-box-body clearfix">
							<div class="form-horizontal">
								<?php 
                                    echo $this->Form->input('Company.id', array('class' => 'form-control item_type',
				                        'hidden' => 'hidden',
				                        'readonly' => 'readonly',
				                        'label' => false,
				                        'id' => 'id'));
                                ?>

                                <div class="form-group">
                                	<label class="col-lg-2 control-label">Quantity</label>
									<div class="col-lg-8">
										<?php 
                                            echo $this->Form->input('QuotationItemDetail.quantity', array(
                                            								'class' => 'form-control item_type',
						                                                    'label' => false,
						                                                    'readonly' => 'readonly',
						                                                    'value' => $quotationItemDetail['QuotationItemDetail']['quantity'],
						                                                    'id' => 'quantity'));
                                        ?>
									</div>
								</div>

								<div class="form-group" id="existing_items">
									<label class="col-lg-2 control-label">Unit Price</label>
									<div class="col-lg-8">
										<?php 
                                            echo $this->Form->input('QuotationItemDetail.unit_price', array(
                                            								'class' => 'form-control item_type',
						                                                    'label' => false,
						                                                    'readonly' => 'readonly',
						                                                    'value' => $quotationItemDetail['QuotationItemDetail']['unit_price']));
                                        ?>
									</div>
									
								</div>

                            	<div class="form-group">
                            		<label class="col-lg-2 control-label">Vat Price</label>
									<div class="col-lg-8">
										<?php 
                                            echo $this->Form->input('QuotationItemDetail.vat_price', array(
                                            								'class' => 'form-control item_type',
						                                                    'label' => false,
						                                                    'readonly' => 'readonly',
						                                                    'value' => $quotationItemDetail['QuotationItemDetail']['vat_price']));
                                        ?>
										  
									</div>
								</div>

								<div class="form-group">
                            		<label class="col-lg-2 control-label">Material</label>
									<div class="col-lg-8">
										<?php 
                                            echo $this->Form->input('QuotationItemDetail.material', array(
                                            								'class' => 'form-control item_type',
						                                                    'label' => false,
						                                                    'readonly' => 'readonly',
						                                                    'value' => $quotationItemDetail['QuotationItemDetail']['material']));
                                        ?>

                                        
										  
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>  
		</div> 
		
		<div class="row">
			<div class="col-lg-12">
				<div class="main-box">
					<header class="main-box-header clearfix">
						<h2 class="pull-left">Client Order Delivery Schedule</h2>
						<a data-toggle="modal" href="#myModalDelivery" class="btn btn-primary mrg-b-lg pull-right addSchedButton"><i class="fa fa-plus-circle fa-lg"></i> Add Delivery Schedule</a>
					</header>
					<div class="main-box-body clearfix">
						<div class="main-box-body clearfix">
							<div class="form-horizontal">
								<?php foreach ($clientOrderData['ClientOrderDeliverySchedule'] as $schedule):  ?>

									<?php echo $this->Form->create('ClientOrderDeliverySchedule',array('id' => 'form'.$schedule['id'],'url'=>(array('controller' => 'sales_orders','action' => 'add_schedule'))));?>

										<div class="tab-container">
											<?php 
		                                        echo $this->Form->input('ClientOrderDeliverySchedule.id', array(
		                                        								'class' => 'form-control item_type editable',
		                                        								'id' => 'toBeEdited',
							                                                    'label' => false,
							                                                    'hidden' => 'hidden',
					                        									'readonly' => 'readonly',
							                                                	'value' => $schedule['id']));

		                                        echo $this->Form->input('ClientOrderDeliverySchedule.client_order_id', array(
		                                        								'type' => 'text',
							                                                    'label' => false,
							                                                    'hidden' => 'hidden',
							                                                	'value' => $schedule['client_order_id']));
		                                       
		                                    ?>

	                                		<div class="form-group">
	                                			<label class="col-lg-2 control-label">Schedule</label>
												<div class="col-lg-8">
													<?php 
			                                              echo $this->Form->input('ClientOrderDeliverySchedule.schedule', array(
			                                            								'class' => 'form-control item_type',
									                                                    'label' => false,
									                                                    'type' => 'text',
									                                                    'class' => 'form-control item_type datepick editable',
									                                                    'readonly' => 'readonly',
									                                                    'value' => !empty($schedule['schedule']) ?
									                                                    date('Y-m-d',strtotime($schedule['schedule'])) : ''	

									                                                   ));
			                                        ?>
                                        
												</div>
											</div>

											<div class="form-group" id="existing_items">
												<label class="col-lg-2 control-label">Location</label>
												<div class="col-lg-8">
													<?php 
			                                            echo $this->Form->input('ClientOrderDeliverySchedule.location', array(
			                                            								'class' => 'form-control item_type editable',
									                                                    'label' => false,
									                                                   	'readonly' => 'readonly',
									                                                    'value' => $schedule['location']));
			                                        ?>
												</div>
												
											</div>

			                            	<div class="form-group">
			                            		<label class="col-lg-2 control-label">Quantity</label>
												<div class="col-lg-8">
													<?php 
			                                            echo $this->Form->input('ClientOrderDeliverySchedule.quantity', array(
			                                            								'class' => 'form-control item_type editable quantityLimit number',
									                                                    'label' => false,
									                                                    'readonly' => 'readonly',
									                                                    'value' => $schedule['quantity']));
			                                        ?>
			                                        <br>

			                                        <button type="button" class="btn btn-primary pull-left buttonEdit" style="margin-right:13px;" >Edit</button> 

													<button type="submit" class="btn btn-primary pull-left editable" id = "submit" disabled onclick="AddAttr()">Submit</button>
													  
												</div>
											</div>

											<hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
										</div>

									<?php echo $this->Form->end(); ?>

								<?php endforeach; ?> 

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="main-box clearfix">
					<div class="top-space"></div>
					<div class="main-box-body clearfix">
						<div id="accordion" class="panel-group accordion">
							
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a href="#collapseTwo" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed fa fa-chevron-circle-down">
											View Quotation Details
										</a>
									</h4>
								</div>
								<div class="panel-collapse collapse" id="collapseTwo" style="height: 1.11667px;">
									<div class="panel-body">
										<div class="form-horizontal">

											<div class="form-group" id="existing_items">
												<label class="col-lg-2 control-label">Payment Terms</label>
												<div class="col-lg-8">
													<?php 
													 	$paymentTerms = !empty($paymentTermData[$quotationData['Quotation']['payment_terms']]) ? $paymentTermData[$quotationData['Quotation']['payment_terms']] : '';

			                                            echo $this->Form->input('PaymentTermHolder.name', array(
			                                            								'class' => 'form-control item_type',
									                                                    'label' => false,
									                                                    'readonly' => 'readonly',
									                                                    'value' => $paymentTerms

									                                                   

									                                                     ));
			                                        ?>
												</div>									
											</div>

			                            	<div class="form-group">
			                            		<label class="col-lg-2 control-label">Validity</label>
												<div class="col-lg-8">
													<?php 
													if (!empty($quotation['Quotation']['validity']) 
													&& $this->DateFormat->isValidDateTimeString($quotation['Quotation']['validity'])){

													$validty =  date('M d, Y', strtotime($quotation['Quotation']['validity']));
													} else {

													$validty = 'No validity date';
													} 
			                                            echo $this->Form->input('Quotation.validity_field', array(
			                                            								'class' => 'form-control item_type',
									                                                    'label' => false,
									                                                    'readonly' => 'readonly',
									                                                    'value' => $validty));


			                                        ?>
													  
												</div>
											</div>
											<div class="form-group">
			                                	<label class="col-lg-2 control-label">Size</label>
												<div class="col-lg-8">
													<?php 
			                                            echo $this->Form->input('Quotation.name', array(
			                                            								'class' => 'form-control item_type',
									                                                    'label' => false,
									                                                    'readonly' => 'readonly',
									                                                    'value' => $quotationData['QuotationDetail']['size']));
			                                        ?>
												</div>
											</div>

											<div class="form-group" id="existing_items">
												<label class="col-lg-2 control-label">Color</label>
												<div class="col-lg-8">
													<?php 
			                                            echo $this->Form->input('Quotation.color', array(
			                                            								'class' => 'form-control item_type',
									                                                    'label' => false,
									                                                    'readonly' => 'readonly',
									                                                    'value' => $quotationData['QuotationDetail']['color']));
			                                        ?>
												</div>
												
											</div>

			                            	<div class="form-group">
			                            		<label class="col-lg-2 control-label">Process</label>
												<div class="col-lg-8">
													<?php 
			                                            echo $this->Form->input('Quotation.process', array(
			                                            								'class' => 'form-control item_type',
									                                                    'label' => false,
									                                                    'readonly' => 'readonly',
									                                                    'value' => $quotationData['QuotationDetail']['process']));
			                                        ?>
													  
												</div>
											</div>

											<div class="form-group">
			                            		<label class="col-lg-2 control-label">Packaging</label>
												<div class="col-lg-8">
													<?php 
			                                            echo $this->Form->input('Quotation.packaging', array(
			                                            								'class' => 'form-control item_type',
									                                                    'label' => false,
									                                                    'readonly' => 'readonly',
									                                                    'value' => $quotationData['QuotationDetail']['packaging']));
			                                        ?>
													  
												</div>
											</div>

											<div class="form-group">
			                            		<label class="col-lg-2 control-label">Other Specs</label>
												<div class="col-lg-8">
													<?php 
			                                            echo $this->Form->input('Quotation.other_specs', array(
			                                            								'class' => 'form-control item_type',
									                                                    'label' => false,
									                                                    'readonly' => 'readonly',
									                                                    'value' => $quotationData['QuotationDetail']['other_specs']));
			                                        ?>
													  
												</div>
											</div>

											<div class="form-group">
			                            		<label class="col-lg-2 control-label">Remarks</label>
												<div class="col-lg-8">
													<?php 
			                                            echo $this->Form->input('Quotation.remarks', array(
			                                            								'class' => 'form-control item_type',
									                                                    'label' => false,
									                                                    'readonly' => 'readonly',
									                                                    'value' => $quotationData['QuotationDetail']['remarks']));
			                                        ?>
													  
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
						</div>
					
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

<?php echo $this->element('modals'); ?>

<script>

	jQuery(document).ready(function($){
		//datepicker
		$('.datepick').datepicker({
			format: 'yyyy-mm-dd'
		});
		
	});

</script>

<script>

    $("body").on('click','.buttonEdit', function(e){

		$(this).parents('.tab-container').find('.editable').attr('readonly', false);
    	$(this).parents('.tab-container').find('button.editable').attr('disabled', false);
    	$(this).html('Cancel');
    	$(this).addClass('Cancel');
    
    	
    	$("body").on('click','.Cancel', function(e){
	    	$(this).parents('.tab-container').find('.editable').attr('readonly', true);
	    	$(this).parents('.tab-container').find('button.editable').attr('disabled', true);
	    	$(this).html('Edit');
	    	$(this).removeClass('Cancel');
	    });
    	// if ($('#textField1').is(':readonly')) {
	    // 	//alert('zero value ko'); 
	    // 	$(this).parents('.tab-container').find('.editable').attr('readonly', false);
	    	
	    // }else{
	    // 	//alert('one value ko'); 
	    // 	$(this).parents('.tab-container').find('.editable').attr('readonly', true);
		   //  x = 0;
	    // }

    });

    
</script>
