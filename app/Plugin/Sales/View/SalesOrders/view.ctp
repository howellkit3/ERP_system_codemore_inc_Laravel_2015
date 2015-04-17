<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Clients Order', array('controller' => 'sales_orders', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('View', array('controller' => 'sales_orders', 'action' => 'view',$clientOrderData['ClientOrder']['id'])); ?>
<?php echo $this->Html->script('Sales.inquiry');?>
<div style="clear:both"></div>

<?php echo $this->element('sales_option');?><br><br>
 
<div class="row">
	<div class="col-lg-12">
		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					
                    
					<h1 class="pull-left">
						<?php
							echo ucfirst($companyName[$clientOrderData['ClientOrder']['company_id']]);
							//pr($PaymentTermClientData); die;
						?>
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
                                	<label class="col-lg-2 control-label">Name</label>
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

								<div class="form-group" id="existing_items">
									<label class="col-lg-2 control-label">Payment Terms</label>
									<div class="col-lg-8">
										<?php 
                                            echo $this->Form->input('ClientOrder.payment_terms', array(
                                            								'class' => 'form-control item_type',
						                                                    'label' => false,
						                                                    'readonly' => 'readonly',
						                                                    'value' => $clientOrderData['ClientOrder']['payment_terms']));
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
						<h2 class="pull-left">Client Order Delivery Schedule</h2>
					</header>
					<div class="main-box-body clearfix">
						<div class="main-box-body clearfix">
							<div class="form-horizontal">
								<?php foreach ($clientOrderData['ClientOrderDeliverySchedule'] as $schedule):  ?>

	                                <div class="form-group">
	                                	<label class="col-lg-2 control-label">Schedule</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('ClientOrder.schedule', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'id' => 'Irvin',
							                                                    'readonly' => 'readonly',
							                                                    'value' => $schedule['schedule']));
	                                        ?>
										</div>
									</div>

									<div class="form-group" id="existing_items">
										<label class="col-lg-2 control-label">Location</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('ClientOrder.location', array(
	                                            								'class' => 'form-control item_type',
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
	                                            echo $this->Form->input('ClientOrder.quantity', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'readonly' => 'readonly',
							                                                    'value' => $schedule['quantity']));
	                                        ?>
											  
										</div>
									</div>
								<?php endforeach; ?> 
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
						<h2 class="pull-left">Quotation Details
						
						</h2>
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
                                	<label class="col-lg-2 control-label">Attention</label>
									<div class="col-lg-8">
										<?php 
                                            echo $this->Form->input('Quotation.name', array(
                                            								'class' => 'form-control item_type',
						                                                    'label' => false,
						                                                    'readonly' => 'readonly',
						                                                    'value' => $quotationData['Quotation']['attention_details']));
                                        ?>
									</div>
								</div>

								<div class="form-group" id="existing_items">
									<label class="col-lg-2 control-label">Payment Terms</label>
									<div class="col-lg-8">
										<?php 
                                            echo $this->Form->input('Quotation.payment_terms_field', array(
                                            								'class' => 'form-control item_type',
						                                                    'label' => false,
						                                                    'readonly' => 'readonly',
						                                                    'value' =>  $quotationData['PaymentTermHolder']['name']));
                                        ?>
									</div>									
								</div>
                            	<div class="form-group">
                            		<label class="col-lg-2 control-label">Validity</label>
									<div class="col-lg-8">
										<?php 
                                            echo $this->Form->input('Quotation.validity_field', array(
                                            								'class' => 'form-control item_type',
						                                                    'label' => false,
						                                                    'readonly' => 'readonly',
						                                                    'value' => date("Y-m-d", strtotime($quotationData['Quotation']['validity']))));


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

		<div class="row">
			<div class="col-lg-12">
				<div class="main-box">
					<header class="main-box-header clearfix">
						<h2 class="pull-left">Selected Quotation Item Details</h2>
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
						                                                    'value' => $quotationItemDetail['QuotationItemDetail']['quantity']));
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

	</div>
</div>

<script>

	jQuery(document).ready(function($){
		//datepicker
		$('.datepick').datepicker({
			format: 'yyyy-mm-dd'
		});
		
	});

</script>