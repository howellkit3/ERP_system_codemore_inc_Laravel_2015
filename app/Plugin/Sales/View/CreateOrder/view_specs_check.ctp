<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Create Order', array('controller' => 'create_order', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('view specs', array('controller' => 'create_order', 'action' => 'view_specs',$productData['Product']['id'])); ?>
<?php  echo $this->Html->script('Sales.inquiry');?>
<?php  echo $this->Html->script('Sales.quantityLimit');?>

<?php echo $this->element('sales_option');?><br><br>

<div class="row">
	<div class="col-lg-12">
		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					
                    
					<h1 class="pull-left">
						Client order view Specification
					</h1>
					<?php 
						 echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'quotations', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
					?>
				</header>

			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="list-group ">

					<div class="list-group-item ">

						<div class="alert alert-warning">
							<i class="fa fa-warning fa-fw fa-lg"></i>
							<strong>Warning!</strong> This product has no specification yet.
						</div>

						<p class="list-group-item-text">Do you want to create specification for this product?</p><br>
						
						<?php 
							echo $this->Html->link('<i class="fa fa-times-circle fa-fw fa-lg"></i> No ', array('controller' => 'sales_orders', 'action' => 'index'),array('class' =>'btn btn-primary','escape' => false));

							echo " ";
							
						 	echo $this->Html->link('<i class="fa fa-check-circle fa-fw fa-lg"></i> Yes ', array('controller' => 'create_order', 'action' => 'create_specs',$productData['Product']['id'],$clientOrderId),array('class' =>'btn btn-primary','escape' => false));
						 	
						?>
						<br><br>
						<p class="list-group-item-text">Note: No Job Ticket will be released if products have no Specification.</p><br>
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
                                    echo $this->Form->input('Product.id', array('class' => 'form-control item_type',
				                        'hidden' => 'hidden',
				                        'readonly' => 'readonly',
				                        'label' => false,
				                         'value' => ucfirst($productData['Product']['id'])
				                         ));
                                ?>

                                <div class="form-group">
                                	<label class="col-lg-2 control-label">Item Name</label>
									<div class="col-lg-8">
										<?php 
                                            echo $this->Form->input('Product.name', array(

                                            								'class' => 'form-control item_type',
						                                                    'label' => false,
						                                                    'readonly' => 'readonly',
						                                                    'value' => ucfirst($productData['Product']['name'])
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

	</div>
</div>