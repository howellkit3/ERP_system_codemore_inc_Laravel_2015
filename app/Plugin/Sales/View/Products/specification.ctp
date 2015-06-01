<!-- //breadcrumbs here -->
<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Product', array('controller' => 'products', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Specification', array('controller' => 'products', 'action' => 'Specification',$product['Product']['id'])); ?>


<?php echo $this->Html->script('Sales.jquery-sortable');?>
<div style="clear:both"></div>

<?php echo $this->element('sales_option');?><br><br>
	<?php echo $this->Html->script('Sales.draggableproducts');?>
	<div class="row">
		<div class="col-lg-12">
			
			<div class="row">
				<div class="col-lg-12">
					<header class="main-box-header clearfix">
						
						<h1 class="pull-left">
							Product Specifications
						</h1>
						<?php 
							echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'products','action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));

	                    ?>
	                    <br>
					</header>

				</div>
			</div>

			<?php echo $this->Form->create('Product',array('url'=>(array('controller' => 'products', 'action' => 'create_specification')),'class' => 'test','method' => 'post'));?>			
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
								                                                    'disabled' => true));
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
								                                                    'fields' =>array('name')));
	                                            ?>
	                                            <?php 
		                                            echo $this->Form->input('Product.id', array(
		                                            								'type' => 'hidden',
		                                            								'class' => 'form-control item_type',
								                                                    'label' => false));
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
								                                                    'fields' =>array('name')));
	                                            ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-lg-2 control-label">Size</label>
											<div class="col-lg-2">
												<?php 
		                                            echo $this->Form->input('ProductSpecification.size1', array(
		                                            								'class' => 'form-control item_type',
								                                                    'label' => false,
								                                                    'placeholder' => 'Size'));
	                                            ?>
											</div>
											<label class="col-lg-1 sizeWith">mm &emsp; x</label>
											<div class="col-lg-2">
												<?php 
		                                            echo $this->Form->input('ProductSpecification.size2', array(
		                                            								'class' => 'form-control item_type',
								                                                    'label' => false,
								                                                    'placeholder' => 'Size'));
	                                            ?>
											</div>
											<label class="col-lg-1 sizeWith">mm &emsp; x</label>
											<div class="col-lg-2">
												<?php 
		                                            echo $this->Form->input('ProductSpecification.size3', array(
		                                            								'class' => 'form-control item_type',
								                                                    'label' => false,
								                                                    'placeholder' => 'Size'));
	                                            ?>
											</div>
											<label class="col-lg-1 sizeWith">mm</label>
										</div>

										<div class="form-group">
											<label class="col-lg-2 control-label">Quantity</label>
											<div class="col-lg-2">
												<?php 
													echo $this->Form->input('ProductSpecification.quantity', array(
		                                            								'class' => 'form-control item_type number required',
		                                            								'type' => 'number',
								                                                    'label' => false,
								                                                    'placeholder' => 'Quantity'));

						                        ?>
											</div>
											<div class="col-lg-3">
												<?php 
													echo $this->Form->input('ProductSpecification.quantity_unit_id', array(
						                                'options' => array($unitData),  
						                                'label' => false,
						                                'class' => 'form-control required',
						                                'empty' => '---Select Unit---'
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
		                	<h1>Specification</h1>
		           		 	</header>
							<div class="main-box-body clearfix">
								<div class="main-box-body clearfix">
									<div class="form-horizontal">	

										<div class="form-group">
											<div class="col-lg-2"></div>
											<div class="col-lg-2 button-spec">
												<button type="button" data="0" class=" process_btn add_field_button btn btn-primary pull-rigth">Component </button>
											</div>
											<div class="col-lg-2 button-spec">
												<button type="button" data="0" class="process_btn btn btn-primary pull-rigth add_part_button">Part</button>
											</div>
											<div class="col-lg-2 button-spec">
												<button type="button" data="0" class=" process_btn btn btn-primary pull-rigth add_process_button">Process</button>
											</div>
										</div>	

										<!--text fields -->
										<section class="label-draggable-section">
											<ul id="sortable">
						 						<!--list of draggable text fields -->
											</ul>
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
<script>

	jQuery(document).ready(function($){
		//datepicker
		$('.datepick').datepicker({
			format: 'yyyy-mm-dd'
		});

	});

</script>