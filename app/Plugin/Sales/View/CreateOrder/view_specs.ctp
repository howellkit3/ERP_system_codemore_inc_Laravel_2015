<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Create Order', array('controller' => 'create_order', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('view specs', array('controller' => 'create_order', 'action' => 'view_specs',$productId)); ?>
<?php  echo $this->Html->script('Sales.inquiry');?>
<?php  echo $this->Html->script('Sales.quantityLimit');?>
<div class="alert alert-success fade in">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<i class="fa fa-check-circle fa-fw fa-lg"></i>
	<strong>Well done!</strong> Job Ticket successfully created.
</div>
<?php echo $this->element('sales_option');?><br><br>

<?php echo $this->Html->script('Sales.editableProductSpecs'); ?>
<?php echo $this->Html->script('Sales.draggableproducts');?>

<div class="row">
	<div class="col-lg-12">
		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					
                    
					<h1 class="pull-left">
						Client order view Specification
					</h1>
					<div class="filter-block pull-right">
						<?php 
							echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Return to Sales ', array('controller' => 'sales_orders', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
							
							echo $this->Html->link('<i class="fa fa-location-arrow fa-lg"></i> Proceed to Job Ticket ', array('controller' => 'ticketing_systems', 'action' => 'index','plugin' => 'ticket'),array('class' =>'btn btn-primary pull-right','escape' => false));

							echo $this->Html->link('<i class="fa fa-print fa-lg"></i> Print ', array('controller' => 'products','action' => 'print_specs',$productData['Product']['uuid']),array('class' =>'btn btn-primary pull-right','escape' => false,'target' => '_blank'));
						?>
					</div>
				</header>

			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="main-box">
					<header class="main-box-header clearfix">
						<h2 class="pull-left">Client Order details</h2>
					</header>
					<div class="main-box-body clearfix">
						<div class="main-box-body clearfix">
							<div class="form-horizontal">
								<?php 
                                    echo $this->Form->input('Product.id', array('class' => 'form-control item_type',
				                        'hidden' => 'hidden',
				                        'readonly' => 'readonly',
				                        'label' => false,
				                         'value' => ucfirst($productData['Product']['id'])
				                         ));
                                ?>

                                <div class="form-group">
                                	<label class="col-lg-2 control-label">CO No.</label>
									<div class="col-lg-8">
										<?php 
                                            echo $this->Form->input('ClientOrder.uuid', array(

                                            								'class' => 'form-control item_type',
						                                                    'label' => false,
						                                                    'readonly' => 'readonly',
						                                                    'value' => ucfirst($clientOrderData['ClientOrder']['uuid'])
						                                                    ));
                                        ?>
									</div>
								</div>

								<div class="form-group">
                                	<label class="col-lg-2 control-label">PO No.</label>
									<div class="col-lg-8">
										<?php 
                                            echo $this->Form->input('ClientOrder.po_number', array(

                                            								'class' => 'form-control item_type',
						                                                    'label' => false,
						                                                    'readonly' => 'readonly',
						                                                    'value' => ucfirst($clientOrderData['ClientOrder']['po_number'])
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

		<?php echo $this->Form->create('Product',array('url'=>(array('controller' => 'create_order', 'action' => 'create_specification')),'class' => 'test','method' => 'post'));?>			
			<div class="row">
				<div class="col-lg-12">
					<div class="main-box">
						<header class="main-box-header clearfix">
							<h2 class="pull-left">Product Details</h2>
						</header>
						<div class="top-space"></div>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">

									<div class="form-group">
										<label class="col-lg-2 control-label">Customer</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('Company.company_name', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'disabled' => true,
							                                                    'value' => $companyData[$productData['Product']['company_id']]));
                                            ?>
										</div>
									</div>									
									<div class="form-group">
										<label class="col-lg-2 control-label">Item Number</label>
										<input type="hidden" id="selected_type" value="<?php // echo $this->request->data['Product']['id']; ?>">
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('Product.uuid', array(
	                                            								'class' => 'form-control item_type',
	                                            								'readonly' => true,
							                                                    'label' => false,       
							                                                    'placeholder' => 'Item Number',
							                                                    'value' => $productData['Product']['uuid']));
                                            ?>
                                            <?php 
	                                            echo $this->Form->input('Product.id', array(
	                                            								'type' => 'hidden',
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'value' => $productData['Product']['id']));
                                            ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Item Name</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('Product.name', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'disabled' => true,
							                                                    'placeholder' => 'Product Name',
							                                                    'value' => $productData['Product']['name']));
                                            ?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Size</label>
										<div class="col-lg-2">
											<?php 
												//hidden id
												echo $this->Form->input('ProductSpecification.id', array(
                                            								'class' => 'form-control item_type editMe',
						                                                    'label' => false,
						                                                    'hidden' => 'hidden',
						                                                    'value' => $specs['ProductSpecification']['id']));
	                                            echo $this->Form->input('ProductSpecification.size1', array(
                                            								'class' => 'form-control item_type editMe',
						                                                    'label' => false,
						                                                    'disabled' => true,
						                                                    'value' => $specs['ProductSpecification']['size1']));
                                            ?>
										</div>
										<label class="col-lg-1 sizeWith">mm &emsp; x</label>
										<div class="col-lg-2">
											<?php 
	                                            echo $this->Form->input('ProductSpecification.size2', array(
	                                            								'class' => 'form-control item_type editMe',
							                                                    'label' => false,
							                                                    'disabled' => true,
							                                                    'value' => $specs['ProductSpecification']['size2']));
                                            ?>
										</div>
										<label class="col-lg-1 sizeWith">mm &emsp; x</label>
										<div class="col-lg-2">
											<?php 
	                                            echo $this->Form->input('ProductSpecification.size3', array(
	                                            								'class' => 'form-control item_type editMe',
							                                                    'label' => false,
							                                                    'disabled' => true,
							                                                    'value' => $specs['ProductSpecification']['size3']));
                                            ?>
										</div>
										<label class="col-lg-1 sizeWith">mm</label>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Quantity</label>
										<div class="col-lg-2">
											<?php 
												echo $this->Form->input('ProductSpecification.quantity', array(
	                                            								'class' => 'form-control item_type number required editMe',
	                                            								'type' => 'number',
							                                                    'label' => false,
							                                                    'disabled' => true,
							                                                    'value' => $specs['ProductSpecification']['quantity']));

					                        ?>
										</div>
										<div class="col-lg-3">
											<?php 
												echo $this->Form->input('ProductSpecification.quantity_unit_id', array(
					                                'options' => array($unitData),  
					                                'label' => false,
					                                'class' => 'form-control required editMe',
					                                'empty' => '---Select Unit---',
					                                'disabled' => true,
							                        'default' => $specs['ProductSpecification']['quantity_unit_id']));

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
	                		<h1 class="pull-left">Specification</h1>
			                <!-- <button class="editAll btn btn-primary pull-right" onclick="showEditFields()" type="button" ><i class="fa fa-pencil fa-lg"></i> Edit </button>
			                <button class=" hideAll btn btn-primary pull-right" style="display:none;" onclick="hideEditFields()" type="button" ><i class="fa fa-repeat fa-lg"></i> Cancel</button> -->
	           		 	</header>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">	
									<?php
										$componentCounter = 0;
										$partCounter = 0;
										$processCounter = 0;
										foreach ($formatDataSpecs as $key => $specLists) {
											if($specLists['ProductSpecificationDetail']['model'] == 'Component'){
												$componentCounter += 1;
											} 
											if($specLists['ProductSpecificationDetail']['model'] == 'Part'){
												$partCounter += 1;
											}
											if($specLists['ProductSpecificationDetail']['model'] == 'Process'){
												$processCounter += 1;
											}
										}
									?>
									<div class="form-group buttonSpecs" style="display:none;">
										<div class="col-lg-2"></div>
										<div class="col-lg-2 button-spec">
											<button type="button" data="<?php echo $componentCounter ?>" class=" process_btn add_field_button btn btn-primary pull-rigth">Component </button>
										</div>
										<div class="col-lg-2 button-spec">
											<button type="button" data="<?php echo $partCounter ?>" class="process_btn btn btn-primary pull-rigth add_part_button">Part</button>
										</div>
										<div class="col-lg-2 button-spec">
											<button type="button" data="<?php echo $processCounter ?>" class=" process_btn btn btn-primary pull-rigth add_process_button">Process</button>
										</div>
									</div>
									<!--text fields -->
									<section class="label-draggable-section">
										<ul id="sortable" class="sortMe">
					 						<!--list of draggable text fields -->

					 						<?php 
					 							$componentCounter1 = 0;
												$partCounter1 = 0;
												$processCounter1 = 0;
					 							foreach ($formatDataSpecs as $key => $specLists) { 
					 						?>
						 						<li class="ui-state-default">

												  	<section class="dragField">
													    <header class="main-box-header dragHeader clearfix">
													        <h2 class="pull-left"> <?php echo $specLists['ProductSpecificationDetail']['model'] ?> </h2>
													        <a href="#" class="remove_field pull-right editMeBtn" style="display:none;">
													            <i class="fa fa-times-circle fa-fw fa-lg"></i>
													        </a>
													    </header>
													    <input name="data[IdHolder][ProductSpecificationDetail][<?php echo $key ;?>][id]" value="<?php echo $specLists['ProductSpecificationDetail']['id'] ?>" class="form-control" type="hidden" />
												      	<?php

													      	if($specLists['ProductSpecificationDetail']['model'] == 'Label'){

													      		echo $this->element('Specs/component', array('formatDataSpecs' => $formatDataSpecs[$key],'counter' => $componentCounter1));
													      		$componentCounter1++;

													      	}
													      	if($specLists['ProductSpecificationDetail']['model'] == 'Part'){
													      		
													      		echo $this->element('Specs/part', array('formatDataSpecs' => $formatDataSpecs[$key],'counter' => $partCounter1));
													      		$partCounter1++;

													      	}
													      	if($specLists['ProductSpecificationDetail']['model'] == 'Process'){
													      		
													      		echo $this->element('Specs/process', array('formatDataSpecs' => $formatDataSpecs[$key],'counter' => $processCounter1));
													      		$processCounter1++;

													      	}
												      	?>
												  	</section>
												  	<input type="hidden" name="data[ProductSpecificationDetail][]" value="<?php echo $specLists['ProductSpecificationDetail']['model'] ?>">
												</li>
												
											<?php } ?>
												
										</ul>
									</section>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row editMeBtn" style="display:none;">
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