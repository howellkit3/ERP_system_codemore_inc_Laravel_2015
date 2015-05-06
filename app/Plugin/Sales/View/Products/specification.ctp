<!-- //breadcrumbs here -->

<?php echo $this->Html->script('Sales.draggableproducts');?>
<?php echo $this->Html->script('Sales.jquery-sortable');?>
<div style="clear:both"></div>

<?php echo $this->element('sales_option');?><br><br>

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

		<?php echo $this->Form->create('Product',array('url'=>(array('controller' => 'products','action' => 'specification'))));?>			
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
										<label class="col-lg-2 control-label">Item Number</label>
										<input type="hidden" id="selected_type" value="<?php // echo $this->request->data['Product']['id']; ?>">
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('Product.uuid', array(
	                                            								'class' => 'form-control item_type',
	                                            								'disabled' => true,
							                                                    'label' => false,       
							                                                    'placeholder' => 'Item Number',
							                                                    'fields' =>array('name')));
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

									<!-- <div class="form-group">
										<label class="col-lg-2 control-label">Remarks</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('Product.remarks', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'disabled' => true,
							                                                    'placeholder' => 'Remarks'));
                                            ?>
										</div>
									</div> -->

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
											<button type="button" data="0" class="add_field_button btn btn-primary pull-left">Label &nbsp;&nbsp;&nbsp;</button>
										</div>
										<div class="col-lg-1">
											<button type="button" data="0" class="btn btn-primary pull-left add_part_button">Part &emsp;&nbsp;&nbsp;</button>
										</div>
										<div class="col-lg-1">
											<button type="button" data="0" class="btn btn-primary pull-left add_process_button">Process&nbsp;</button>
										</div>
									</div>	

									<!--text fields -->
									<section class="label-draggable-section">
										<div class="top-space"></div>
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