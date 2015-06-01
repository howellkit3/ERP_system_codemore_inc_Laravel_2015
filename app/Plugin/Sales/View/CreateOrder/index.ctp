<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Quotation', array('controller' => 'quotation', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Create Order', array('controller' => 'quotation', 'action' => 'index',$quotationData['Quotation']['id'],$quotationData['Quotation']['uuid'])); ?>
<?php  echo $this->Html->script('Sales.inquiry');?>
<?php  echo $this->Html->script('Sales.quantityLimit');?>

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
                                    	<label class="col-lg-2 control-label">CO No.</label>
										<div class="col-lg-8">
											<?php 
                                                echo $this->Form->input('ClientOrder.uuid',array( 
                                                						'class' => 'form-control item_type required', 
                                                    					'label' => false,
                                                    					'readonly' => 'readonly',
                                                    					'placeholder' => 'CO Number',
                                                    					'value' => $code 
                                                    					));
                                            ?>
										</div>
									</div>

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
							<h2 class="pull-left">Client Order Details</h2>
						</header>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">

									<div class="form-group">
                                    	<label class="col-lg-2 control-label">Item Name</label>
										<div class="col-lg-8">
											<?php
												echo $this->Form->input('Product.name', array(
													'type' => 'text',
					                                'label' => false,
					                                'readonly' => 'readonly',
					                                'class' => 'form-control',
					                                'value' => ucfirst($productData['Product']['name'])
					                                 )); 
												pr($productData);exit();
												// echo $this->Form->input('Product.name', array(
												// 	'type' => 'hidden',
					       //                          'label' => false,
					       //                          'readonly' => 'readonly',
					       //                          'class' => 'form-control',
					       //                          'value' => ucfirst($productData['Product']['uuid'])
					       //                           )); 

				                            ?>
										</div>
									</div>

									
									<div class="form-group">
                                    	<label class="col-lg-2 control-label">Payment Terms</label>
										<div class="col-lg-8">
											
				                            <?php echo $this->Form->input('ClientOrder.payment_terms', array(
					                                'options' => array($paymentTerm),
					                                'type' => 'select',
					                                'label' => false,
					                                'class' => 'form-control required contacpersonlist2',
					                                'empty' => '---Select Payment Term---',
					                                'default' => $quotationData['Quotation']['payment_terms']
					                                 )); 

					                            ?>
										</div>
									</div>

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
																
																<?php echo (!empty($itemDetail['quantity']) && is_numeric($itemDetail['quantity'])) ? number_format($itemDetail['quantity']) : '';
																?>
																<?php
													 				echo !empty($units[$itemDetail['quantity_unit_id']]) ? $units[$itemDetail['quantity_unit_id']] : '' 
													 			?> 
															</div>
														</td>	
														
													</tr>

													<tr >
														
														<td height ="37px" valign ="top" class = "column4 col-md-10">
															<div class="col-lg-12">
																<?php
																	echo !empty($currencies[$itemDetail['unit_price_currency_id']]) ? $currencies[$itemDetail['unit_price_currency_id']] : ''
																?>
																<?php echo (!empty($itemDetail['unit_price']) && is_numeric($itemDetail['unit_price'])) ? number_format($itemDetail['unit_price'],4) : '';
																?>
																/
																<?php
																
																	echo !empty($units[$itemDetail['unit_price_unit_id']]) ? $units[$itemDetail['unit_price_unit_id']] : ''
																?> 
															</div>
														</td>
														
													</tr>

													<tr>
														
														<td height ="35px" class ="column2 col-md-10">
															<div class="col-lg-12">
																<?php echo (!empty($itemDetail['vat_price']) && is_numeric($itemDetail['vat_price'])) ? number_format($itemDetail['vat_price'],4) : '';
																?>
																
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
											                    	<input name="itemDetail" class="select-item" type="radio"  style="vertical-align: middle; margin: 0px;" value="<?php echo $itemDetail['id']?>"   required/> 
											                    	<font size="2" >Select Item</font>
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
				<div class="col-lg-12 ">
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
                                                						'type' => 'hidden',
                                                						'class' => 'form-control item_type ', 
                                                    					'label' => false, 
                                                    					'placeholder' => 'Quantity',
                                                    					'readonly' => 'readonly',
                                                    					'id' => 'quantity'
                                                    					));
                                                echo $this->Form->input('QuotationItemDetail.quantity_proxy',array( 
                                                						'class' => 'form-control item_type ', 
                                                    					'label' => false, 
                                                    					'placeholder' => 'Quantity',
                                                    					'disabled' => 'disabled',
                                                    					'id' => 'quantity_proxy'
                                                    					));

                                            ?>
                                          
										</div>
									</div>

									<div class="form-group">
                                    	<label class="col-lg-2 control-label">Unit Price</label>
										<div class="col-lg-8">
											<?php 
                                                echo $this->Form->input('QuotationItemDetail.unit_price',array( 
                                                						'type' => 'hidden',
                                                						'class' => 'form-control item_type ', 
                                                    					'label' => false, 
                                                    					'placeholder' => 'Unit Price',
                                                    					'readonly' => 'readonly',
                                                    					'id' => 'unit_price'
                                                    					));
                                                echo $this->Form->input('QuotationItemDetail.unit_price_proxy',array( 
                                                						'type' => 'text',
                                                						'class' => 'form-control item_type ', 
                                                    					'label' => false, 
                                                    					'placeholder' => 'Unit Price',
                                                    					'disabled' => 'disabled',
                                                    					'id' => 'unit_price_proxy'
                                                    					));
                                            ?>
										</div>
									</div>

									<div class="form-group">
                                    	<label class="col-lg-2 control-label">Vat Price</label>
										<div class="col-lg-8">
											<?php 
                                                echo $this->Form->input('QuotationItemDetail.vat_price',array( 
                                                						'type' => 'hidden',
                                                						'class' => 'form-control item_type ', 
                                                    					'label' => false, 
                                                    					'placeholder' => 'Vat Price',
                                                    					'readonly' => 'readonly',
                                                    					'id' => 'vat_price'
                                                    					));
                                                echo $this->Form->input('QuotationItemDetail.vat_price_proxy',array( 
                                                						'type' => 'text',
                                                						'class' => 'form-control item_type ', 
                                                    					'label' => false, 
                                                    					'placeholder' => 'Vat Price',
                                                    					'disabled' => 'disabled',
                                                    					'id' => 'vat_price_proxy'
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
					<div class="col-lg-12 ">
						<div class="main-box">
							<header class="main-box-header clearfix">
								<h2 class="pull-left">Client Order Delivery Schedule</h2>
							</header>
							<div class="main-box-body clearfix">
								<div class="main-box-body clearfix">
									<div class="form-horizontal">

										<div class="form-group plusDisable">
                                            <label for="inputEmail1" class="col-lg-2 control-label ">Delivery Type</label>
                                            <div class="col-lg-2">
                                                <?php 
                                                    echo $this->Form->input('ClientOrderDeliverySchedule.0.delivery_type', array(
                                                        'options' => array('Once' => 'Once', 'Partial' => 'Partial'),
                                                        'label' => false,
                                                        'class' => 'form-control col-lg-4 required OnceSelected sched required schedClone',
                                                        'empty' => '---Select Delivery Type---'
                                                        
                                                    ));
                                                ?>

                                            </div>
                                    	</div>
									
										<div class="form-group">
	                                    	<label class="col-lg-2 control-label">Schedule</label>
											<div class="col-lg-8">
												<?php 
	                                                echo $this->Form->input('ClientOrderDeliverySchedule.0.schedule',array( 
	                                                						'class' => 'form-control item_type datepick schedClone required', 
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
	                                                						'class' => 'form-control item_type schedClone disablefields required', 
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
	                                                						'class' => 'form-control item_type quantityLimit number schedClone disablefields quantityCondition required', 
	                                                    					'label' => false,
	                                                    					'id' => 'totalQuantity',  
	                                                    					'placeholder' => 'Quantity'
	                                                    					));
	                                            ?>
											</div>
										</div>

										<div class="form-group">
                                            <label for="inputEmail1" class="col-lg-2 control-label">Allowance</label>
                                            <div class="col-lg-2">
                                                <?php 
                                                    echo $this->Form->input('ClientOrderDeliverySchedule.0.allowance', array(
                                                        'options' => array('With charge' => 'With charge' , 'Without Charge' => 'Without charge'),
                                                        'label' => false,
                                                        'class' => 'form-control col-lg-4 schedClone ',
                                                        'empty' => '---Select Allowance---'
                                                        
                                                    ));
                                                ?>

                                            </div>
                                    	</div>

										<hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
                                
                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 control-label"></label>
                                            <div class="col-lg-10">
                                                <button type="button" data-model='Address' class="add-field table-link danger btn btn-success onceDisable" onclick="cloneDataSchedule('scheduleSection',this)"> <i class="fa fa-plus"></i></button>
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
					<div class="main-box clearfix">
						<div class="top-space"></div>
						<div class="main-box-body clearfix">
							<div id="accordion" class="panel-group accordion">
								
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a href="#collapseTwo" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed fa fa-chevron-circle-down ">
												<font class="fontSame">View Quotation Details</font>
											</a>
										</h4>
									</div>
									<div class="panel-collapse collapse" id="collapseTwo" style="height: 1.11667px;">
										<div class="panel-body">
											<div class="form-horizontal">

												<div class="form-group">
			                                    	<label class="col-lg-2 control-label">Payment Terms</label>
													<div class="col-lg-8">
														<?php 
			                                                echo $this->Form->input('Quotation.payment_termsField',array( 
                                                						'class' => 'form-control item_type ', 
                                                    					'label' => false,
                                                    					'disabled' => 'disabled',
                                                    					'value' => $paymentTerm[$quotationData['Quotation']['payment_terms']]  
                                                    					));
			                                            ?>
													</div>
												</div>

												<div class="form-group">
			                                    	<label class="col-lg-2 control-label">Validity</label>
													<div class="col-lg-8">
														<?php 
			                                                echo $this->Form->input('Quotation.validityField',array( 
                                                						'class' => 'form-control item_type ', 
                                                    					'label' => false,
                                                    					'disabled' => 'disabled',
                                                    					'value' => date('M d, Y', strtotime($quotationData['Quotation']['validity']))  
                                                    					));

			                                            ?>
													</div>
												</div>

												<?php foreach ($quotationData['QuotationDetailOrder'] as $key => $details) { ?>
													<div class="form-group">
				                                    	<label class="col-lg-2 control-label">Size</label>
														<div class="col-lg-8">
															<?php 
				                                                echo $this->Form->input('QuotationDetail.size',array( 
	                                                						'class' => 'form-control item_type ', 
	                                                    					'label' => false,
	                                                    					'disabled' => 'disabled',
	                                                    					'value' => $details['size']  
	                                                    					));
				                                            ?>
														</div>
													</div>

													<div class="form-group">
				                                    	<label class="col-lg-2 control-label">Color</label>
														<div class="col-lg-8">
															<?php 
				                                                echo $this->Form->input('QuotationDetail.color',array( 
	                                                						'class' => 'form-control item_type ', 
	                                                    					'label' => false,
	                                                    					'disabled' => 'disabled',
	                                                    					'value' => $details['color']  
	                                                    					));
				                                            ?>
														</div>
													</div>

													<div class="form-group">
				                                    	<label class="col-lg-2 control-label">Process</label>
														<div class="col-lg-8">
															<?php 
				                                                echo $this->Form->input('QuotationDetail.process',array( 
	                                                						'class' => 'form-control item_type ', 
	                                                    					'label' => false,
	                                                    					'disabled' => 'disabled',
	                                                    					'value' => $details['process']  
	                                                    					));
				                                            ?>
														</div>
													</div>

													<div class="form-group">
				                                    	<label class="col-lg-2 control-label">Packaging</label>
														<div class="col-lg-8">
															<?php 
				                                                echo $this->Form->input('QuotationDetail.packaging',array( 
	                                                						'class' => 'form-control item_type ', 
	                                                    					'label' => false,
	                                                    					'disabled' => 'disabled',
	                                                    					'value' => $details['packaging']  
	                                                    					));
				                                            ?>
														</div>
													</div>

													<div class="form-group">
				                                    	<label class="col-lg-2 control-label">Other Specs</label>
														<div class="col-lg-8">
															<?php 
				                                                echo $this->Form->input('QuotationDetail.other_specs',array( 
	                                                						'class' => 'form-control item_type ', 
	                                                    					'label' => false,
	                                                    					'disabled' => 'disabled',
	                                                    					'value' => $details['other_specs']  
	                                                    					));
				                                            ?>
														</div>
													</div>

													<div class="form-group">
				                                    	<label class="col-lg-2 control-label">Remarks</label>
														<div class="col-lg-8">
															<?php 
				                                                echo $this->Form->input('QuotationDetail.remarks',array( 
	                                                						'class' => 'form-control item_type ', 
	                                                    					'label' => false,
	                                                    					'disabled' => 'disabled',
	                                                    					'value' => $details['remarks']  
	                                                    					));
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


<script>
$(document).ready(function(){

    //$(".OnceSelected").change(function(){
    $('body').on('change', '.OnceSelected', function(){
   // alert($("option:selected", this).text());
    if ($("option:selected", this).text() == "Once") {
    	//if ($(".quantityCondition").val() == "123") {
    		//alert('quantityCondition');
    	//alert ("asdas");
    	var quantityValue = $('#quantity').val();
    	$("#totalQuantity").val(quantityValue);
    	 $(".onceDisable").hide();
    	 $( ".disablefields" ).prop( "readonly", true );
    	 $(".OnceRemove").remove(); 
    	//}
    }else{
    	$(".onceDisable").show();
    	$( ".disablefields" ).prop( "readonly", false );
    	$("#totalQuantity").val("");
    }
      
    });

    // $(".onceDisable").click(function(){
   
   	// 	//alert("a");
    // 	  $(".plusDisable").children().hide();
    // 	 //$(".plusDisable").Attr('disabled');

   
      
    // });

});

</script>