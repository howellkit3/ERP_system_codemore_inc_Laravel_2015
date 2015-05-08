<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Quotation', array('controller' => 'quotation', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Create Order', array('controller' => 'quotation', 'action' => 'index',$quotationData['Quotation']['id'],$quotationData['Quotation']['uuid'])); ?>
<?php echo $this->Html->script('Sales.inquiry');?>
<?php echo $this->Html->script('Sales.quantityLimit');?>

<?php echo $this->element('sales_option');?><br><br>

<div class="row">
	<div class="col-lg-12">
		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					
                    
					<h1 class="pull-left">
						Create Order
					</h1>
					<?php 
						 echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'quotations', 'action' => 'view',$quotationData['Quotation']['id'],$quotationData['Quotation']['company_id']),array('class' =>'btn btn-primary pull-right','escape' => false));
					?>
				</header>

			</div>
		</div>
		<?php echo $this->Form->create('Quotation',array('url'=>(array('controller' => 'create_order','action' => 'order_create'))));?>
			<div class="row">
				<div class="col-lg-12">
					<div class="main-box">
						<div class="top-space"></div>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">
									<?php 
										//hidden id's
                                        echo $this->Form->input('Company.id', array('class' => 'form-control item_type',
					                        'hidden' => 'hidden',
					                        'label' => false,
					                        'value' => ucfirst($quotationData['Quotation']['company_id'])));
                                        echo $this->Form->input('Quotation.id', array(
												'hidden' => 'hidden',
				                                'label' => false,
				                                'class' => 'form-control',
				                                'value' => ucfirst($quotationData['Quotation']['id'])
				                                 )); 

                                        
                                    ?>

                                    <div class="form-group">
                                    	<label class="col-lg-2 control-label">Company</label>
										<div class="col-lg-8">
											<?php echo $this->Form->input('Company.company_name', array(
												'type' => 'text',
				                                'readonly' => 'readonly',
				                                'label' => false,
				                                'class' => 'form-control',
				                                'value' => ucfirst($companyData['Company']['company_name'])
				                                 )); 

				                            ?>
										</div>
									</div>

									<!-- <div class="form-group">
                                    	<label class="col-lg-2 control-label">Quotation Name</label>
										<div class="col-lg-8">
											<?php echo $this->Form->input('Quotation.name', array(
												'type' => 'text',
				                                'label' => false,
				                                'readonly' => 'readonly',
				                                'class' => 'form-control',
				                                'value' => ucfirst($quotationData['Quotation']['name'])
				                                 )); 

				                            ?>
										</div>
									</div> -->

									<div class="form-group">
                                    	<label class="col-lg-2 control-label">Item Name</label>
										<div class="col-lg-8">
											<?php echo $this->Form->input('Product.name', array(
												'type' => 'text',
				                                'label' => false,
				                                'readonly' => 'readonly',
				                                'class' => 'form-control',
				                                'value' => ucfirst($productData['Product']['name'])
				                                 )); 

				                            ?>
										</div>
									</div>

									<div class="form-group">
                                    	<label class="col-lg-2 control-label">PQ No.</label>
										<div class="col-lg-8">
											<?php echo $this->Form->input('Quotation.uuid', array(
												'type' => 'text',
				                                'readonly' => 'readonly',
				                                'label' => false,
				                                'class' => 'form-control',
				                                'value' => 'PQ-'.$quotationData['Quotation']['uuid']
				                                 )); 

				                            ?>
										</div>
									</div>

                                    <div class="form-group">
                                    	<label class="col-lg-2 control-label">Attention</label>
										<div class="col-lg-8">
											<?php echo $this->Form->input('Quotation.attention_details', array(
												'type' => 'text',
				                                'readonly' => 'readonly',
				                                'label' => false,
				                                'class' => 'form-control',
				                                'value' => ucfirst($quotationData['Quotation']['attention_details'])
				                                 )); 

				                            ?>
										</div>
									</div>

									<div class="form-group">
                                    	<label class="col-lg-2 control-label">Payment Terms</label>
										<div class="col-lg-8">
											<?php echo $this->Form->input('ClientOrder.payment_terms_field', array(
												'type' => 'text',
				                                'readonly' => 'readonly',
				                                'label' => false,
				                                'class' => 'form-control',
				                                'value' => $paymentTerm[$quotationData['Quotation']['payment_terms']]
				                                 )); 

										 		echo $this->Form->input('ClientOrder.payment_terms', array(
												'type' => 'text',
				                                'hidden' => 'hidden',
				                                'label' => false,
				                                'value' => $companyData['Company']['payment_term']
				                                 ));
											
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
								
									<div class="form-group">
                                    	<label class="col-lg-2 control-label">PO No.</label>
										<div class="col-lg-8">
											<?php 
                                                echo $this->Form->input('ClientOrder.po_number',array( 
                                                						'class' => 'form-control item_type required', 
                                                    					'label' => false,
                                                    					'placeholder' => 'PO Number',
                                                    					'id' => 'generate-poNumber' 
                                                    					));
                                            ?>
										</div>
									</div>

									<div class="form-group">
                                    	<label class="col-lg-2 control-label"></label>
										<div class="col-lg-8">
											<div class="checkbox-nice">
												<input id="checkbox-1" type="checkbox" class="generate-poNumber">
												<label for="checkbox-1"> Generate PO Number </label>
											</div>
										</div>
									</div>

                                    <div class="form-group">
                                    	<label class="col-lg-2 control-label">Order Name</label>
										<div class="col-lg-8">
											<?php 
                                                echo $this->Form->input('ClientOrder.name',array( 
                                                						'class' => 'form-control item_type ', 
                                                    					'label' => false,
                                                    					'placeholder' => 'Order Name' 
                                                    					));
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
							<h2 class="pull-left">Client Order Item Detail</h2>
						</header>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">
								
                                    <div class="form-group">
                                    	
										<label class="col-lg-2 control-label">
											Qty<br><br>
											Unit Price<br><br>
											Vat Price<br><br>
											Material
										</label>
										<div class="col-lg-8 ">
											<?php foreach ($quotationData['QuotationItemDetail'] as $itemDetail){ ?>
												<table  class = "tbl">
													<tr>
														
														<td height ="37px" valign ="top" class ="column3 col-md-10"> 
															<div class="col-lg-12">
																<?php echo $itemDetail['quantity'];?> 
															</div>
														</td>	
														
													</tr>

													<tr >
														
														<td height ="37px" valign ="top" class = "column4 col-md-10">
															<div class="col-lg-12">
																<?php echo $itemDetail['unit_price'];?> 
															</div>
														</td>
														
													</tr>

													<tr>
														
														<td height ="35px" class ="column2 col-md-10">
															<div class="col-lg-12">
																<?php echo $itemDetail['vat_price'];?> 
															</div>
														</td>
														
													</tr>

													<tr>
														
														<td height ="35px" class ="column2 col-md-10">
															<div class="col-lg-12">
																<?php 
																	echo $itemDetail['material'];

																?> 
															</div>
														</td>
														
													</tr>
													<tr style="border:none;">
														
														<td height ="50px" class ="column2 col-md-10">
															<div class="col-lg-10">
																 
											                    	<input name="itemDetail" class="select-item" type="radio" value="<?php echo $itemDetail['id']?>" required/> 
											                    	<font size="1">Select Item</font>
											                	
															</div>
														</td>
														
													</tr>
													
												</table>
												
											<?php } ?>

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
							<h2 class="pull-left">Selected Item Detail</h2>
						</header>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">

									<div class="form-group">
                                    	<label class="col-lg-2 control-label">Quantity</label>
										<div class="col-lg-8">
											<?php 
                                                echo $this->Form->input('QuotationItemDetail.quantity',array( 
                                                						'class' => 'form-control item_type ', 
                                                    					'label' => false, 
                                                    					'placeholder' => 'Quantity',
                                                    					'readonly' => 'readonly',
                                                    					'id' => 'quantity'
                                                    					));

                                            ?>
                                          
										</div>
									</div>

									<div class="form-group">
                                    	<label class="col-lg-2 control-label">Unit Price</label>
										<div class="col-lg-8">
											<?php 
                                                echo $this->Form->input('QuotationItemDetail.unit_price',array( 
                                                						'class' => 'form-control item_type ', 
                                                    					'label' => false, 
                                                    					'placeholder' => 'Unit Price',
                                                    					'readonly' => 'readonly',
                                                    					'id' => 'unit_price'
                                                    					));
                                            ?>
										</div>
									</div>

									<div class="form-group">
                                    	<label class="col-lg-2 control-label">Vat Price</label>
										<div class="col-lg-8">
											<?php 
                                                echo $this->Form->input('QuotationItemDetail.vat_price',array( 
                                                						'class' => 'form-control item_type ', 
                                                    					'label' => false, 
                                                    					'placeholder' => 'Vat Price',
                                                    					'readonly' => 'readonly',
                                                    					'id' => 'vat_price'
                                                    					));
                                            ?>
										</div>
									</div>

									<div class="form-group">
                                    	<label class="col-lg-2 control-label">Material</label>
										<div class="col-lg-8">
											<?php 
                                                echo $this->Form->input('QuotationItemDetail.material',array( 
                                                						'class' => 'form-control item_type ', 
                                                    					'label' => false, 
                                                    					'placeholder' => 'Material',
                                                    					'readonly' => 'readonly',
                                                    					'id' => 'material'
                                                    					));
                                                echo $this->Form->input('QuotationItemDetail.id', array('class' => 'form-control',
							                        
							                        'hidden' => 'hidden',
							                        'label' => false,
							                        'id' => 'itemDetailId'));
                                            ?>
										</div>
									</div>
									

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<section class="cloneMe scheduleSection">
				<div class="row">
					<div class="col-lg-12">
						<div class="main-box">
							<div class="top-space"></div>
							<div class="main-box-body clearfix">
								<div class="main-box-body clearfix">
									<div class="form-horizontal">
									
										<div class="form-group">
	                                    	<label class="col-lg-2 control-label">Schedule</label>
											<div class="col-lg-8">
												<?php 
	                                                echo $this->Form->input('ClientOrderDeliverySchedule.0.schedule',array( 
	                                                						'class' => 'form-control item_type datepick', 
	                                                    					'label' => false,
	                                                    					'readonly' => 'readonly',
	                                                    					'placeholder' => 'Schedule'  
	                                                    					));
	                                            ?>
											</div>
										</div>

										<div class="form-group">
	                                    	<label class="col-lg-2 control-label">Location</label>
											<div class="col-lg-8">
												<?php 
	                                                echo $this->Form->input('ClientOrderDeliverySchedule.0.location',array( 
	                                                						'class' => 'form-control item_type ', 
	                                                    					'label' => false, 
	                                                    					'placeholder' => 'Location',
	                                                    					'value' => !empty($companyData['Address'][0]['address1']) ? $companyData['Address'][0]['address1'] : ''
	                                                    					));
	                                            ?>
											</div>
										</div>

	                                    <div class="form-group">
	                                    	<label class="col-lg-2 control-label">Quantity</label>
											<div class="col-lg-8">
												<?php 
	                                                echo $this->Form->input('ClientOrderDeliverySchedule.0.quantity',array( 
	                                                						'class' => 'form-control item_type quantityLimit', 
	                                                    					'label' => false, 
	                                                    					'placeholder' => 'Quantity'
	                                                    					));
	                                            ?>
											</div>
										</div>

										<hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
                                    

                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label"></label>
                                            <div class="col-lg-10">
                                                <button type="button" data-model='Address' class="add-field table-link danger btn btn-success" onclick="cloneData('scheduleSection',this)"> <i class="fa fa-plus"></i></button>
                                                <button type="button" class="remove-field btn btn-danger remove" onclick="removeClone('scheduleSection')"><i class="fa fa-minus"></i> </button>
                                            </div>
                                        </div>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</section>

			<div class="row">
				<div class="col-lg-12">
					<div class="main-box">
						<div class="top-space"></div>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">
								
                                    <div class="form-group">
                                    	<label class="col-lg-2 control-label">Remarks</label>
										<div class="col-lg-8">
											<?php 
                                                echo $this->Form->input('ClientOrder.remarks',array( 
                                                						'class' => 'form-control item_type ', 
                                                    					'label' => false,
                                                    					'placeholder' => 'Remarks' 
                                                    					));
                                            ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label"></label>
										<div class="col-lg-8">
											<button type="submit" class="btn btn-success pull-left">Submit Order</button>&emsp;
											<?php 
						                        echo $this->Html->link('Cancel', array('controller' => 'quotations', 'action' => 'index'),array('class' =>'btn btn-primary','escape' => false));
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
