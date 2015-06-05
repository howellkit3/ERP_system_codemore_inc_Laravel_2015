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

							//echo $this->Html->link('<i class="fa fa-print fa-lg"></i> Print ', array('controller' => 'products','action' => 'print_specs',$productData['Product']['uuid']),array('class' =>'btn btn-primary pull-right','escape' => false,'target' => '_blank'));
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

		<div class="main-box">
			<div class="top-space"></div>
			<div class="main-box-body clearfix">
				<form class="form-horizontal" role="form">
					
					<div class="form-group">
						<div class="col-lg-2">
							&nbsp;&nbsp;Customer
						</div>
						<div class="col-lg-5">
							:&emsp;
							<?php 
								echo ucfirst($companyData[$productData['Product']['company_id']]);
							?>
						</div>
						<div class="col-lg-4">&emsp;&emsp;&nbsp;&nbsp;&nbsp;
							Date : <?php echo (new \DateTime())->format('l, F d, Y '); ?>
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-2">
							&nbsp;&nbsp;Item
						</div>
						<div class="col-lg-5">
							:&emsp;
							<?php 
								echo ucfirst($productData['Product']['name']);
							?>
						</div>
						<div class="col-lg-4"></div>
					</div>

					<div class="form-group">
						<div class="col-lg-2">
							&nbsp;&nbsp;Item size
						</div>
						<div class="col-lg-5">
							:&emsp;
							<?php 
								echo !empty($specs['ProductSpecification']['size1']) ? $specs['ProductSpecification']['size1'] : '0'; 
								echo " x ";
								echo !empty($specs['ProductSpecification']['size1']) ? $specs['ProductSpecification']['size2'] : '0';
								echo " x ";
								echo !empty($specs['ProductSpecification']['size1']) ? $specs['ProductSpecification']['size3'] : '0';
									
							?>
						</div>
						<div class="col-lg-4"></div>
					</div>

					<div class="form-group">
						<div class="col-lg-2">
							&nbsp;&nbsp;PO Quanity 
						</div>
						<div class="col-lg-5">
							:&emsp;
							
								<?php 
									echo $specs['ProductSpecification']['quantity']; 
									echo " ";
									echo $unitData[$specs['ProductSpecification']['quantity_unit_id']];
									
								?>
							
						</div>
						<div class="col-lg-4"></div>
					</div>

					<div class="form-group">
						<div class="col-lg-2">
							&nbsp;&nbsp;Stocks 
						</div>
						<div class="col-lg-5">
							:&emsp;
							
								<?php 
									echo $specs['ProductSpecification']['stock']; 
								?>
							
						</div>
						<div class="col-lg-4"></div>
					</div>

					<hr>

					<?php $componentCounter = 1?>
					<?php $partCounter = 1?>
					<?php $processCounter = 1?>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<?php foreach ($formatDataSpecs as $key => $specLists) { ?>
					
									<?php

								      	if($specLists['ProductSpecificationDetail']['model'] == 'Component'){

								      		echo $this->element('ViewSpecs/component', array('formatDataSpecs' => $formatDataSpecs[$key],'key' => $componentCounter));
								      		$componentCounter++;
								      	}
								      	if($specLists['ProductSpecificationDetail']['model'] == 'Part'){
								      		
								      		echo $this->element('ViewSpecs/part', array('formatDataSpecs' => $formatDataSpecs[$key],'key' => $partCounter));
								      		$partCounter++;
								      		
								      	}
								      	if($specLists['ProductSpecificationDetail']['model'] == 'Process'){
								      		
								      		echo $this->element('ViewSpecs/process', array('formatDataSpecs' => $formatDataSpecs[$key],'key' => $processCounter));
								      		$processCounter++;

								      	}
							      	?>
					      	
								<?php } ?>
							</thead>
					    </table>
				   	</div> 
				</form>
			</div>
		</div>
	</div>
</div>