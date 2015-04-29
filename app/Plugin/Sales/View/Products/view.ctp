<?php //$this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php //$this->Html->addCrumb('Clients Order', array('controller' => 'sales_orders', 'action' => 'index')); ?>
<?php // $this->Html->addCrumb('View', array('controller' => 'sales_orders', 'action' => 'view',$productData['Product']['id'])); ?>
<?php //echo $this->Html->script('Sales.Product');?>

<?php //pr($itemTypeData); exit;?>

<div style="clear:both"></div>

<?php echo $this->element('sales_option');?><br><br>

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
				<?php echo $this->Form->create('Product',array('url'=>(array('controller' => 'products','action' => 'view'))));?>			
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

									<div class="form-group">
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
						<h2 class="pull-left">Company Details</h2>
					</header>
						<div class="top-space"></div>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">									
									<div class="form-group">
										<label class="col-lg-2 control-label">Customer Name</label>

										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('Company.company_name', array(

	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'disabled' => true,
							                                                    'style' => 'text-transform:capitalize',
							                                                    'placeholder' => 'Customer Name'));
                                            ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Description</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('Company.description', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'disabled' => true,
							                                                    'placeholder' => 'Description'));
                                            ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Website</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('Company.website', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'disabled' => true,
							                                                    'placeholder' => 'Website',
							                                                    'fields' => array('website')));
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