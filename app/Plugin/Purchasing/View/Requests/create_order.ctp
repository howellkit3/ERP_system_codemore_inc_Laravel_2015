<?php $this->Html->addCrumb('Request List', array('controller' => 'requests', 'action' => 'request_list')); ?>
<?php $this->Html->addCrumb('View', array('controller' => 'requests', 'action' => 'view',$requestId)); ?>
<?php $this->Html->addCrumb('Create Order', array('controller' => 'requests', 'action' => 'create_order',$requestId)); ?>

<?php  echo $this->Html->script('Purchasing.create_order_selector');?>
<?php  echo $this->Html->script('Purchasing.category_purchase');?>
<?php  echo $this->Html->script('Purchasing.modal_clone');?>

<style>

.bycash {
    display: none;
} 

</style>

<div style="clear:both"></div>

<?php echo $this->element('purchasings_option'); ?><br><br>

<div class="row">
	<div class="col-lg-12">
		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					<?php if(empty($bycash)){?>
						<h1 class="pull-left">
							Create Purchase Order
						</h1>
					<?php }else{ ?>
						<h1 class="pull-left">
							Receive By Cash
						</h1>
						<?php } ?>
					<?php 
						 echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'requests', 'action' => 'view',$requestId),array('class' =>'btn btn-primary pull-right','escape' => false));
					?>
				</header>

			</div>
		</div>

		<?php if(empty($bycash)){ ?>

			<?php echo $this->Form->create('PurchaseOrder',array('url'=>(array('controller' => 'requests','action' => 'purchase_order'))));?>

		<?php }else{?>

			<?php echo $this->Form->create('PurchaseOrder',array('url'=>(array('controller' => 'requests','action' => 'purchase_order', 1))));?>

		<?php }?>

			<div class="row">
				<div class="col-lg-12">
					<div class="main-box">
						<div class="top-space"></div>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">

									<?php if(!empty($bycash)){ ?>

									<div class="form-group">
		                                	<label class="col-lg-2 control-label">Supplier</label>
											<div class="col-lg-8">
												
					                            <?php echo $this->Form->input('PurchaseOrder.supplier', array(
						                                'class' => 'form-control', 
                                    					'label' => false,
                                    					'placeholder' => 'Supplier Name'
						                                 )); 

						                            ?>
											</div>
										</div>

										<div class="form-group">
		                                	<label class="col-lg-2 control-label">Contact Number</label>
											<div class="col-lg-8">
												
					                            <?php echo $this->Form->input('PurchaseOrder.contact', array(
						                                'class' => 'form-control ', 
                                    					'label' => false,
                                    					'placeholder' => 'Contact Number'
						                                 )); 

						                            ?>
											</div>
										</div>

										<div class="form-group">
		                                	<label class="col-lg-2 control-label">Contact Person</label>
											<div class="col-lg-8">
												
					                            <?php echo $this->Form->input('PurchaseOrder.contact_person', array(
						                                'class' => 'form-control ', 
                                    					'label' => false,
                                    					'placeholder' => 'Contact Person'
						                                 )); 

						                            ?>
											</div>
										</div>

									<?php }else{ ?>

									<div class="form-group">
	                                	<label class="col-lg-2 control-label">Purchase Order Name</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('PurchaseOrder.name',array( 
	                                            						'class' => 'form-control', 
	                                                					'label' => false,
	                                                					'placeholder' => 'Purchase Order Name'  
	                                                					));
	                                        ?>
										</div>
									</div>
									
									<div class="form-group">
	                                	<label class="col-lg-2 control-label"><span style="color:red">*</span>Supplier</label>
										<div class="col-lg-8">
											
				                            <?php echo $this->Form->input('PurchaseOrder.supplier_id', array(
					                                'options' => array($supplierData),
					                                'type' => 'select',
					                                'label' => false,
					                                'class' => 'form-control required supplier-select',
					                                'empty' => '---Select Supplier Name---'
					                                 )); 

					                            ?>
										</div>
									</div>

									<div class="form-group">
	                                	<label class="col-lg-2 control-label"><span style="color:red">*</span>Contact Number</label>
										<div class="col-lg-8">
											
				                            <?php echo $this->Form->input('PurchaseOrder.contact_id', array(
					                                //'options' => array($supplierData),
					                                'type' => 'select',
					                                'label' => false,
					                                'class' => 'form-control required supplier-number',
					                                'empty' => '---Contact Number---'
					                                 )); 

					                            ?>
										</div>
									</div>

									<div class="form-group">
	                                	<label class="col-lg-2 control-label"><span style="color:red">*</span>Contact Person</label>
										<div class="col-lg-8">
											
				                            <?php echo $this->Form->input('PurchaseOrder.contact_person_id', array(
					                                //'options' => array($supplierData),
					                                'type' => 'select',
					                                'label' => false,
					                                'class' => 'form-control required supplier-contact-person',
					                                'empty' => '---Contact Person---'
					                                 )); 

					                            ?>
										</div>
									</div>
									<?php } ?>
									<?php if(empty($bycash)){ ?>

										<div class="form-group">
		                                	<label class="col-lg-2 control-label"><span style="color:red">*</span>PUO No.</label>
											<div class="col-lg-8">
												<?php 
		                                            echo $this->Form->input('PurchaseOrder.po_number',array( 
		                                            						'class' => 'form-control  required', 
		                                                					'label' => false,
		                                                					'placeholder' => 'PUO Number',
		                                                					'id' => 'generate-poNumber' 
		                                                					));

		                                            echo $this->Form->input('PurchaseOrder.request_id',array( 
		                                            						'class' => 'form-control  required', 
		                                                					'label' => false,
		                                                					'type' => 'hidden',
		                                                					'value' => $requestId
		                                                					));
		                                        ?>
											</div>
										</div>

										<div class="form-group">
		                                	<label class="col-lg-2 control-label"></label>
											<div class="col-lg-8">
												<div class="checkbox-nice">
													<input id="checkbox-1" type="checkbox" class="generate-poNumber">
													<label for="checkbox-1"> Generate PUO Number </label>
												</div>
											</div>
										</div>

									<?php }else{ ?>

										<div class="form-group">
		                                	<label class="col-lg-2 control-label"><span style="color:red">*</span>Receive No.</label>
											<div class="col-lg-8">
												<?php 
		                                            echo $this->Form->input('PurchaseOrder.po_number',array( 
		                                            						'class' => 'form-control  required', 
		                                                					'label' => false,
		                                                					'placeholder' => 'PUO Number',
		                                                					'id' => 'generate-poNumber' 
		                                                					));

		                                            echo $this->Form->input('PurchaseOrder.request_id',array( 
		                                            						'class' => 'form-control  required', 
		                                                					'label' => false,
		                                                					'type' => 'hidden',
		                                                					'value' => $requestId
		                                                					));
		                                        ?>
											</div>
										</div>

										<div class="form-group">
		                                	<label class="col-lg-2 control-label"></label>
											<div class="col-lg-8">
												<div class="checkbox-nice">
													<input id="checkbox-1" type="checkbox" class="generate-poNumber">
													<label for="checkbox-1"> Generate Receive Number </label>
												</div>
											</div>
										</div>

									<?php }?>

									<div class="form-group">
	                                	<label class="col-lg-2 control-label"><span style="color:red">*</span>Payment Terms</label>
										<div class="col-lg-8">
											
				                            <?php 

				                            if(!empty($bycash)){

				                            echo $this->Form->input('PurchaseOrder.payment_term_proxy', array(
					                                'options' => array($paymentTermData),
					                                'type' => 'select',
					                                'label' => false,
					                                'class' => 'form-control required paymentTerm',
					                                'value' => !empty($bycash) ? 12 : "" , 
					                                'readonly' => 'readonly',
					                                'disabled' => 'disabled',
					                                'empty' => '---Select Payment Term---'
					                                 )); 

				                            echo $this->Form->input('PurchaseOrder.payment_term', array(
					                                'type' => 'hidden',
					                                'label' => false,
					                                'class' => 'form-control required paymentTerm',
					                                'value' => !empty($bycash) ? 12 : "" , 
					                                'empty' => '---Select Payment Term---'
					                                 )); 

					                        }else{

					                        	 echo $this->Form->input('PurchaseOrder.payment_term', array(
					                                'options' => array($paymentTermData),
					                                'type' => 'select',
					                                'label' => false,
					                                'class' => 'form-control required paymentTerm',
					                                'value' => !empty($bycash) ? 12 : "" , 
					                                'empty' => '---Select Payment Term---'
					                                 )); 
					                        } ?>

					                            <?php echo $this->Form->input('PurchaseOrder.prepared_by', array(
					                                'label' => false,
					                                'type' => 'hidden',
					                                'class' => 'form-control required preparedby',
					                                'value' => $requestData['Request']['prepared_by'] 
					                                 )); 
					                            ?>

					                            <?php echo $this->Form->input('PurchaseOrder.filed_number', array(
					                                'label' => false,
					                                'type' => 'hidden',
					                                'class' => 'form-control ',
					                                'value' => $byCashNum 
					                                 )); 
					                            ?>

										</div>
									</div>

									<section class = "bycash">

										<div class="form-group">
		                                	<label class="col-lg-2 control-label"><span style="color:red">*</span>Received By</label>
											<div class="col-lg-8">
												
					                            <?php echo $this->Form->input('PurchaseOrder.question', array(
						                                'options' => array('Warehouse', 'Requestor'),
						                                'type' => 'select',
						                                'label' => false,
						                                'class' => 'form-control required receivedBy',
						                                'empty' => '---Select Receiver---'
						                                 )); 

						                            ?>
											</div>
										</div>

										<section class = "append">
										</section>

									</section>

									<div class="form-group">
	                                    	<label class="col-lg-2 control-label"><span style="color:red">*</span>Delivery/Received Date</label>
											<div class="col-lg-8">
												<?php 
	                                                echo $this->Form->input('PurchaseOrder.deliveryDate',array( 
	                                                						'class' => 'form-control item_type datepick  required', 
	                                                    					'label' => false,
	                                                    					'readonly' => false,
	                                                    					'placeholder' => 'Delivery Date Date'  
	                                                    					));
	                                            ?>
											</div>
										</div>

									<div class="form-group">
	                                	<label class="col-lg-2 control-label">Remarks</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('PurchaseOrder.remarks',array( 
	                                            						'class' => 'form-control', 
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
						
							<h2 class="pull-left">
								Request Purchase Detail
							</h2>
							
						</header>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">
									
									<div class="form-group">
	                                	<label class="col-lg-2 control-label">RQO No.</label>
										<div class="col-lg-8">
											
				                            <?php echo $this->Form->input('PurchaseOrder.rqo_number', array(
					                                'type' => 'text',
					                                'label' => false,
					                                'class' => 'form-control required',
					                                'readonly' => true,
					                                'value' => 'RQO'.$requestData['Request']['uuid']
					                                 )); 

					                            ?>
										</div>
									</div>

									<div class="form-group">
	                                	<label class="col-lg-2 control-label">Type</label>
										<div class="col-lg-8">
											
				                            <?php echo $this->Form->input('PurchaseOrder.pur_type_id', array(
					                                'type' => 'text',
					                                'label' => false,
					                                'class' => 'form-control required',
					                                'readonly' => true,
					                                'value' => $type[$requestData['Request']['pur_type_id']]
					                                 )); 

					                            ?> 

					                            <?php echo $this->Form->input('PurchaseOrder.po_number', array(
					                                'type' => 'text',
					                                'label' => false,
					                                'type' => 'hidden',
 					                                'class' => 'form-control po_number',
					                                'readonly' => true,
					                                'value' => $purchaseNumber
					                                 )); 
					                            ?>

					                            <?php echo $this->Form->input('PurchaseOrder.request_item_count', array(
					                                'type' => 'text',
					                                'label' => false,
					                                'type' => 'hidden',
 					                                'class' => 'form-control po_number',
					                                'readonly' => true,
					                                'value' => $requestItemCount
					                                 )); 

					                            ?>

										</div>
									</div>

									<hr>
									
									<?php foreach ($requestItem as $key => $value) { 

										if($value['RequestItem']['status_id'] != 1){  ?>
										
										 <section class="cloneMe">
											<div class="main-box-body clearfix">
												<div class="form-horizontal item-category">

													<?php $dataPlus = $key + 1; ?>

													<?php 
									    				echo $this->Form->input('RequestItemIdHolder.'.$key.'.id', array(
															'class' => 'form-control',
									                        'label' => false,
									                        'type' => 'hidden',
									                        'placeholder' => 'Size',
									                        'value' => $value['RequestItem']['id']));
									                ?>

									               	<?php 
									    				echo $this->Form->input('RequestItemIdHolder.'.$key.'.status_id', array(
															'class' => 'form-control',
									                        'label' => false,
									                        'type' => 'hidden',
									                        'placeholder' => 'Size',
									                        'value' => $value['RequestItem']['status_id']));
									                ?>
											               
													<div class="form-group" >
														<label class="col-lg-2 control-label"><span style="color:red">*</span>Item</label>
														<div class="col-lg-5">

															<?php $dataPlus = $key + 1; ?>

											                <input type="text" class="form-control item_name required" name="data[RequestItem][<?php echo $key ?>][nameToShow]" value="<?php echo $value['RequestItem']['name'] ?>" readonly>

											                <input type="hidden" class="form-control item_name required" name="data[RequestItem][<?php echo $key ?>][name]" value="<?php echo $value['RequestItem']['name'] ?>" readonly>

											                <?php 

											                $uuid = $value['RequestItem']['request_uuid']; 

											               // pr($value['RequestItem']['id']);

										                	   echo $this->Form->input('RequestItem.'.$key.'.request_uuid', 
																			array( 
																'class' => 'form-control  required ', 
																'type' => 'hidden',
										    					'label' => false,
										    					'readonly' => 'readonly',
										    					'value' => $value['RequestItem']['request_uuid']
										    					));

											                    echo $this->Form->input('RequestItem.'.$key.'.foreign_key', 
																				array( 
																	'class' => 'form-control item_id required', 
																	'type' => 'hidden',
											    					'label' => false,
											    					'readonly' => 'readonly',
											    					'value' => $value['RequestItem']['foreign_key']
											    					));

											                    echo $this->Form->input('RequestItem.'.$key.'.status_id', 
																				array( 
																	'class' => 'form-control item_id required', 
																	'type' => 'hidden',
											    					'label' => false,
											    					'readonly' => 'readonly',
											    					'value' => 1
											    					));

											                    

												                 echo $this->Form->input('RequestItem.'.$key.'.filed_number', 
																					array( 
																		'class' => 'form-control item_id required', 
																		'type' => 'hidden',
												    					'label' => false,
												    					'readonly' => 'readonly',
												    					'value' => $byCashNum
												    					));

											                	
											                ?>

											                <?php 
											                    echo $this->Form->input('RequestItem.'.$key.'.model', 
																				array( 
																	'class' => 'form-control item_model required ', 
																	'type' => 'hidden',
											    					'label' => false,
											    					'readonly' => 'readonly',
											    					'value' => $value['RequestItem']['model']
											    					));
											                 
											                ?>

											        	</div>

														<div class="col-lg-4">

															<a data-toggle="modal" href="#myModalItem" data-modal="<?php echo $dataPlus ?>" class="modal-button btn btn-primary mrg-b-lg pull-left  "><i class="fa fa-search-plus fa-lg"></i> Select Item</a>

															&emsp;
															<button type="button" class="add-field1  table-link danger btn btn-success " onclick="cloneDatarequest('cloneMe', this)"><i class="fa fa-plus"></i></button>
															<!-- <button type="button" class="add-field1sd proxy-counter add-request-section table-link danger btn btn-success" ><i class="fa fa-plus"></i></button> -->
															
															<?php 
																if ($key == 0 ) { 
																	$newClass = 'hide-remove';
																}else{
																	$newClass = ' ';
																}
															?>
																<button type="button" class="remove remove-purchase-order btn btn-danger <?php //echo $newClass ?>"><i class="fa fa-minus" ></i></button>
															
														</div>

													</div>

													<div class="form-group">

														<label class="col-lg-2 control-label">Category</label>
														
														<div class="col-lg-6">
															<?php 
																echo $this->Form->input('RequestItem.'.$key.'.category', array(
											                        'options' => array('No Amount Items', 'General Items'), 
											                        'label' => false,
											                        'class' => 'form-control category',
											                        'empty' => '---Select Category---',
											                        'value' =>  !empty($value['RequestItem']['category']
											                         ))); 
											                ?>

														</div>

													</div>

													<div class="form-group other-items">

														<label class="col-lg-2 control-label">Size</label>
														<div class="col-lg-3">
															<?php 
											                    echo $this->Form->input('RequestItem.'.$key.'.size1', array(
																	'class' => 'form-control item_type other-element',
											                        'label' => false,
											                        'placeholder' => 'Size',
											                        'disabled' => false,
											                        'type' => 'number',
											                        'value' => $value['RequestItem']['size1']));
											                ?>
														</div>

														<div class="col-lg-3">
															<?php 
																echo $this->Form->input('RequestItem.'.$key.'.size1_unit_id', array(
											                        'options' => array($unitData),  
											                        'label' => false,
											                        'class' => 'form-control other-element',
											                        'empty' => '---Select Unit---',
											                        'disabled' => false,
											                        'value' => $value['RequestItem']['size1_unit_id']
											                         )); 
																
											                ?>

														</div>

														<label class="col-lg-3 sizeWith">&emsp;&emsp;x </label>

													</div>

													<div class="form-group other-items">
														<label class="col-lg-2 control-label"> </label>
														<div class="col-lg-3">
															<?php 
																echo $this->Form->input('RequestItem.'.$key.'.size2', array(
																	'class' => 'form-control item_type other-element',
											                        'label' => false,
											                        'placeholder' => 'Size',
											                        'disabled' => false,
											                        'type' => 'number',
											                        'value' => $value['RequestItem']['size2']));

											                ?>
														</div>

														<div class="col-lg-3">
															<?php 
																echo $this->Form->input('RequestItem.'.$key.'.size2_unit_id', array(
											                        'options' => array($unitData),  
											                        'label' => false,
											                        'class' => 'form-control other-element',
											                        'empty' => '---Select Unit---',
											                        'disabled' => false,
											                        'default' => $value['RequestItem']['size2_unit_id']
											                         )); 

											                ?>
														</div>

														<label class="col-lg-3 sizeWith">&emsp;&emsp;x </label>

													</div>

													<div class="form-group other-items">
														<label class="col-lg-2 control-label"> </label>
														<div class="col-lg-3">
															<?php 
																echo $this->Form->input('RequestItem.'.$key.'.size3', array(
																	'class' => 'form-control item_type other-element',
											                        'label' => false,
											                        'placeholder' => 'Size',
											                        'disabled' => false,
											                        'type' => 'number',
											                        'value' => $value['RequestItem']['size3']));

											                ?>
														</div>

														<div class="col-lg-3">
															<?php 
																echo $this->Form->input('RequestItem.'.$key.'.size3_unit_id', array(
											                        'options' => array($unitData),  
											                        'label' => false,
											                        'class' => 'form-control other-element',
											                        'empty' => '---Select Unit---',
											                        'disabled' => false,
											                        'default' => $value['RequestItem']['size3_unit_id']
											                         )); 

											                ?>
														</div>

														<label class="col-lg-3 sizeWith">&emsp;&emsp;x </label>

													</div>

													<div class="form-group rolls">
														<label class="col-lg-2 control-label"><span style="color:red">*</span> Width</label>
														<div class="col-lg-3">
															<?php 
																echo $this->Form->input('RequestItem.'.$key.'.width', array(
																	'class' => 'form-control item_type roll-element required',
											                        'label' => false,
											                        'type' => 'number',
											                        'value' => !empty($value['RequestItem']['width']),
											                        'placeholder' => 'Width'));

											                ?>
														</div>

														<div class="col-lg-3 ">
															<?php 
																echo $this->Form->input('RequestItem.'.$key.'.width_unit_id', array(
											                        'options' => array($unitData),  
											                        'label' => false,
											                        'class' => 'form-control item_type roll-element required',
											                        'empty' => '---Select Unit---',
											                        'default' => !empty($value['RequestItem']['width_unit_id'])
											                         )); 

											                ?>
														</div>

													</div>

													<div class="form-group other-items">
																<label class="col-lg-2 control-label"><span style="color:red">*</span>Quantity</label>
																<div class="col-lg-6">
																	<?php 
																		echo $this->Form->input('RequestItem.'.$key.'.quantity', array(
																			'class' => 'form-control item_type number  select-drop ',
																			'type' => 'number',
													                        'label' => false,
													                        'data' => 0,
													                        'placeholder' => 'Quantity',
													                        'value' => $value['RequestItem']['quantity']));

													                ?>
																</div>
															</div>

															<div class="form-group">
																	<label class="col-lg-2 control-label"><span style="color:red">*</span>Pieces</label>

																<div class="col-lg-3">
																	<?php 
																		echo $this->Form->input('RequestItem.'.$key.'.pieces', array(
																			'class' => 'form-control item_type number  select-drop ',
																			'type' => 'number',
													                        'label' => false,
													                        'data' => 0,
													                        'placeholder' => 'Pieces', 
													                        'value' => $value['RequestItem']['pieces']
														                         ));

													                ?>

																</div>

																<div class="col-lg-3">
																	<?php 
																		echo $this->Form->input('RequestItem.'.$key.'.quantity_unit_id', array(
													                        'options' => array($unitData),  
													                        'label' => false,
													                        'class' => 'form-control required',
													                        'empty' => '---Select Unit---',
													                        'default' => $value['RequestItem']['quantity_unit_id']
														                         )); 

													            ?>

																</div>

															</div>

													<div class="form-group">
														<label class="col-lg-2 control-label"><span style="color:red">*</span>Price</label>
														<div class="col-lg-3">
															<?php 
																echo $this->Form->input('RequestItem.'.$key.'.unit_price', array(
																	'class' => 'form-control item_type number required',
																	'type' => 'number',
											                        'label' => false,
											                        'placeholder' => 'Price'));

											                ?>
														</div>

														<div class="col-lg-3 other-items">
															<?php 
																echo $this->Form->input('RequestItem.'.$key.'.unit_price_unit_id', array(
											                        'options' => array($currencyData),  
											                        'label' => false,
											                        'class' => 'form-control required',
											                        'empty' => '---Select Unit---'
											                         )); 

											                ?>
														</div>

														<div class="col-lg-3 rolls">
															<?php 
																echo $this->Form->input('RequestItem.'.$key.'.roll_unit_id', array(
											                        'options' => array($unitData),  
											                        'label' => false,
											                        'class' => 'form-control required',
											                        'empty' => '---Select Unit---'
											                         )); 

											                ?>
														</div>

													</div>

													<hr>

												</div>
											</div>
							</section>
									<?php }} ?>

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
	                                	<label class="col-lg-2 control-label"> </label>
										<div class="col-lg-8">
											
				                           	<button type="submit" class="btn btn-primary">Submit</button>
				                           	&emsp;
				                           	<?php 
												 echo $this->Html->link(' Cancel ', array('controller' => 'requests', 'action' => 'view',$requestId),array('class' =>'btn btn-default','escape' => false));
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

<div class="modal fade" id="myModalItem" role="dialog" data-item="" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog specModal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Material</h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-reorder"></i></span>
                            <select  class="form-control select-group ItemGroup" >
                                <option value="0">--Select Item Group--</option>
                                <option value="1">General Items</option>
                                <option value="2">Substrates</option>
                                <option value="3">Compound Substrates</option>
                                <option value="4">Corrugated Papers</option>
                            </select>
                        </div>
                    </div>
                </div>

                <header class="main-box-header clearfix">
                    <h1 class="pull-left">Item List</h1>
                    <div class="filter-block pull-right">
                        <div class="form-group">

                            <input placeholder="Search..."  class="form-control searchItem" type="search" disabled="disabled" />
                            <i class="fa fa-search search-icon"></i>
                         
                        </div>  
                    </div>
                </header>

                <input type="hidden" class="current_page" />

                <input type="hidden" class="show_per_page" />

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th><a href="#"><span>Select</span></a></th>
                            <th style="width:200px;"><a href="#"><span>Item Number</span></a></th>
                            <th><a href="#"><span>Name</span></a></th>
                        </tr>
                    </thead>
                    <tbody class="tableProduct" aria-relevant="all" id="scrollTable" aria-live="polite" role="alert" >
                    </tbody>

                    <tbody class="Itemtable" aria-relevant="all" id="scrollTable" aria-live="polite" role="alert" >
                    </tbody>
                </table>

                <div class="table-responsive">
                    <header class="main-box-header clearfix">
                        <h1 class="pull-left">Item List</h1>
                        <div class="filter-block pull-right">
                            <div class="form-group pull-left">

                            </div>
                        </div>
                    </header>
                </div>

                <div class="form-group">
                    <div class="col-lg-10"></div>
                    <div class="col-lg-2">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="md-overlay"></div>	


<?php echo $this->element('item_modal'); ?>

<script>
	$(document).ready(function() {

		var thisMe = $(this);
        
        $('.item-category').find('.category').each(function(){

           var category = $(this).val();

            if(category == 0){

	        	$(this).parents('.item-category').find('.other-items').hide();
	        	$(this).parents('.item-category').find( ".other-element" ).prop( "disabled", true );
            	$(this).parents('.item-category').find( ".roll-element" ).prop( "disabled", false );

	        }else{

	        	$(this).parents('.item-category').find('.rolls').hide();
	        	$(this).parents('.item-category').find( ".other-element" ).prop( "disabled", false );
           		$(this).parents('.item-category').find( ".roll-element" ).prop( "disabled", true );

	       }

        });

		test = $('.remove-purchase-order').length;

		$(".hide-remove").hide();

		$("#PurchaseOrderCreateOrderForm").validate();

		$('.datepick').datepicker({
			format: 'yyyy-mm-dd'
		});

		paymentCash();

	});

	$('.receivedBy').change(function(){

		var receivedBy = $('.receivedBy').val();

		var preparedby = $('.preparedby').val();
		
		if(receivedBy == 1){

			$('.append').show();

			$.ajax({
	            type: "GET",
	            url: serverPath + "purchasing/requests/receivedBy/"+preparedby,
	            dataType: "html",
	            success: function(data) {

	                if(data){

	                    $('.append').html(data);

	                } 
	            }
	        });

    	}else{

    		$('.append').hide();

    	}

	});

	$('.paymentTerm').change(function(){

		paymentCash();

	});

	function paymentCash(whatsection, thisElement){

	    var paymentTerm = $('.paymentTerm').val();

		if(paymentTerm == 12){

			$('.bycash').show();

		}else{

			$('.bycash').hide();
		}

	} 

	// generate PO number
	$('.generate-poNumber').change(function(){

		var currentTime = new Date()
		var month = currentTime.getMonth() + 1
		var year = currentTime.getFullYear().toString().substr(2, 2);
		var hour = currentTime.getHours()
		var minute = currentTime.getMinutes()
		var seconds = currentTime.getSeconds()

		//alert(month); 
		var uuid = $('.po_number').val();
		
	 	var code = uuid;

	 	var seriesNumber = code.substr(code.length - 4);

	 	var code = year.toString() + month.toString() + seriesNumber.toString();

		if($(this).is( ":checked" ) == true){
			
            var data = "PUO-" + code;
           	// data.substr(0,-3);
			$('#generate-poNumber').val(data);
			
			$('#generate-poNumber').attr('readonly','true');
        }
        
        if($(this).is( ":checked" ) == false){
			
			$('#generate-poNumber').val('');
			$('#generate-poNumber').removeAttr("readonly");
           
        }
	
	});

	$("body").on('keyup','.searchItem', function(e){
	        var searchInput = $(this).val();
	        var thisMe = $(this);
	        var itemGroup = $('.ItemGroup').val();

	        if(searchInput != ''){

	            thisMe.parents('.modal-body').find('.tableProduct').hide();
	            thisMe.parents('.modal-body').find('.Itemtable').show();
	            //alert('hide');

	        }else{
	            thisMe.parents('.modal-body').find('.tableProduct').show();
	            thisMe.parents('.modal-body').find('.Itemtable').hide();
	            //alert('show');
	        }

	        if(searchInput){
	            $.ajax({
	                type: "GET",
	                url: serverPath + "purchasing/requests/product_search/"+itemGroup+"/"+searchInput+"/"+itemGroup,
	                dataType: "html",
	                success: function(data) {
	                   
	                    if(data){
	                       
	                        thisMe.parents('.modal-body').find('.Itemtable').html(data); 
	                    }else{
	                         
	                        thisMe.parents('.modal-body').find('.Itemtable').html('<font color="red"><b>No result..</b></font>'); 
	                    }
	                    
	                }
	            });

	        }
	        
	    });

</script>
