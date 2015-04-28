<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php echo $this->Html->script('Sales.inquiry');?>
<?php echo $this->Html->script('Sales.draggableproducts');?>
<?php echo $this->element('sales_option'); ?><br><br>

<div class="row">
	<div class="col-lg-12">
		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					
                    
					<h1 class="pull-left">
						Add Product
					</h1>
				</header>

			</div>
		</div>
		<?php echo $this->Form->create('Product',array('url'=>(array('controller' => 'products','action' => 'create_product'))));?>

			<div class="row">
				<div class="col-lg-12">
					<div class="main-box">
						<div class="top-space"></div>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">									
									<div class="form-group">
										<label class="col-lg-2 control-label">Name</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('Product.name', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'required' => 'required',
							                                                    'placeholder' => 'Item Name'));
                                            ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Customer</label>
										<div class="col-lg-8">
											<input type="hidden" id="selected_type" value="">
                                            <?php echo $this->Form->input('Product.company_id', array(
					                                'options' => array($companyData),
					                                'type' => 'select',
					                                'label' => false,
					                                //'readonly' => 'readonly',
					                                'class' => 'form-control required categorylist',
					                                'empty' => '---Select Customer---',
					                               	'required' => 'required'
					                                 )); 
					                            ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Item Category</label>
										<div class="col-lg-8">
											<input type="hidden" id="selected_type" value="">
                                            <?php echo $this->Form->input('Product.item_category_holder_id', array(
					                                'options' => array($itemCategoryData),
					                                'type' => 'select',
					                                'label' => false,
					                                //'readonly' => 'readonly',
					                                'class' => 'form-control required categorylist',
					                                'empty' => '---Select Item Category---',
					                               	'required' => 'required'
					                                 )); 


					                            ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Item Type</label>
										<div class="col-lg-8">
											 <?php echo $this->Form->input('Product.item_type_holder_id', array(
					                                // 'type' => 'select',
					                                'label' => false,
					                                //'readonly' => 'readonly',
					                                'class' => 'form-control required',
					                                'empty' => '---Select Item Type---',
					                                'id' => 'item_type_holder_id',
					                               	'required' => 'required'
					                                 )); 

					                            ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Remarks</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->textarea('Product.remarks', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'placeholder' => 'Remarks'));
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
	                	<h1>Specification</h1>
	           		 	</header>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">	

									<div class="form-group">
										<div class="col-lg-2"></div>
										<div class="col-lg-1">
											<button data="0"class="add_field_button btn btn-primary pull-left">Label &nbsp;&nbsp;&nbsp;</button>
										</div>
										<div class="col-lg-1">
											<button type="button" class="btn btn-primary pull-left add_part_button">Part</button>
										</div>
										<div class="col-lg-1">
											<button type="submit" class="btn btn-primary pull-left">Process&nbsp;</button>
										</div>
									</div>	

									<!--text fields -->
									<section class="label-draggable-section">
										<div class="row">
											<div class="col-lg-12">
												<div class="main-box label-section">
													<div class="top-space"></div>
													<ul id="sortable">
								 						<!--list of draggable text fields -->
													</ul>
													
												</div>
											</div>
										</div>
									</section>
									<!--parts fields -->
									<section class="part-draggable-section">
										<div class="row">
											<div class="col-lg-12">
												<div class="main-box">
													<div class="top-space"></div>
													<div class="main-box-body clearfix">
														<div class="main-box-body clearfix">
															<div class="form-horizontal">	
																<div class="form-group">
																	<label class="col-lg-2 control-label my-pad">Item Group</label>
																	<div class="col-lg-8">
																		<?php echo $this->Form->input('Product.itemGroup', array(
																			'options' => array('General Items', 'Substrates', 'Compound Substrates','Corrugated Papers'),
											                                'type' => 'select',
											                                'label' => false,
											                                //'readonly' => 'readonly',
											                                'class' => 'form-control required categorylist',
											                                'empty' => '---Select Item Group---',
											                               	'required' => 'required'
											                                 )); 
											                            ?>
																	</div>
																</div>
																<section class="dropItem">
																	<div class="form-group">
																		<label class="col-lg-2 control-label my-pad">Category</label>
																		<div class="col-lg-8">
																			<?php echo $this->Form->input('Product.category', array(
																				'options' => array('General Items', 'Substrates', 'Compound Substrates','Corrugated Papers'),
												                                'type' => 'select',
												                                'label' => false,
												                                //'readonly' => 'readonly',
												                                'class' => 'form-control required categorylist',
												                                'empty' => '---Select Item Group---',
												                               	'required' => 'required'
												                                 )); 
												                            ?>
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="col-lg-2 control-label my-pad">Item</label>
																		<div class="col-lg-8">
																			<?php echo $this->Form->input('Product.item', array(
																				'options' => array(
																					'General Items', 
																					'Substrates',
																					'Compound Substrates',
																					'Corrugated Papers'
																				),
												                                'type' => 'select',
												                                'label' => false,
												                                //'readonly' => 'readonly',
												                                'class' => 'form-control required categorylist',
												                                'empty' => '---Select Item Group---',
												                               	'required' => 'required'
												                                 )); 
												                            ?>
																		</div>
																	</div>
																</section>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</section>							
									
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
										<div class="col-lg-2"></div>
										<div class="col-lg-8">

											<button type="submit" class="btn btn-primary pull-left">Submit Product</button>&nbsp;
											<?php 
						                        echo $this->Html->link('Cancel', array('controller' => 'products', 'action' => 'index'),array('class' =>'btn btn-default','escape' => false));
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