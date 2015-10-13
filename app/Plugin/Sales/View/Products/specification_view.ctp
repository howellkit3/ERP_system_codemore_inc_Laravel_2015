<!-- //breadcrumbs here -->
<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Product', array('controller' => 'products', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Specification', array('controller' => 'products', 'action' => 'Specification',$product['Product']['id'])); ?>
<?php echo $this->Html->script('Sales.jquery-sortable');?>
<div style="clear:both"></div>

<?php echo $this->element('sales_option');

?><br><br>
<?php echo $this->Html->script('Sales.editableProductSpecs'); ?>
<?php echo $this->Html->script('Sales.draggableproducts');?>

<div class="row">
	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					
					<h1 class="pull-left">
						Product Specifications
					</h1>
					<div class="filter-block pull-right">
						<?php 
						
		                    echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'products','action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));

		                    echo $this->Html->link('<i class="fa fa-pencil fa-lg"></i> Edit ', array('controller' => 'products','action' => 'specification_edit',$product['Product']['id']),array('class' =>'btn btn-primary pull-right','escape' => false));

		                ?>

		            </div>
	                <br>
				</header>

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
								echo !empty($this->request->data['Company']['company_name']) ? ucfirst($this->request->data['Company']['company_name']) : '' ;
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
								echo !empty($this->request->data['Product']['name']) ? ucfirst($this->request->data['Product']['name']) : '' ;
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

					<?php //$mainpanelCounter = 1?>
					<?php $componentCounter = 1?>
					<?php $partCounter = 1?>
					<?php $processCounter = 1?>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<?php foreach ($formatDataSpecs as $key => $specLists) {  ?>
									
									<?php
									
										// if($specLists['ProductSpecificationDetail']['model'] == 'MainPanel'){
											
								  //     		echo $this->element('ViewSpecs/mainpanel', array('formatDataSpecs' => $formatDataSpecs[$key],'key' => $mainpanelCounter));
								  //     		$mainpanelCounter++;
								  //     	}

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

