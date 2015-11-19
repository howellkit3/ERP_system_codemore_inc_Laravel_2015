<!-- //breadcrumbs here -->
<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Product', array('controller' => 'products', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Specification', array('controller' => 'products', 'action' => 'Specification',$product['Product']['id'])); ?>
<?php echo $this->Html->script('Sales.jquery-sortable');?>
<div style="clear:both"></div>

<?php  echo $this->element('sales_option');

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

		                    echo $this->Html->link('<i class="fa fa-pencil fa-lg"></i> Edit ', array('controller' => 'products','action' => 'specification_edit',$product['Product']['id'],$ifTicket, $ticketId),array('class' =>'btn btn-primary pull-right','escape' => false));

		                ?>

		                <!-- <a data-toggle="modal" href="#myModalEdit" class="btn btn-primary mrg-b-lg pull-right "><i class="fa fa-edit fa-lg"></i>Edit</a> -->

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

    <div class="modal fade" id="myModalEdit" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content margintop">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Edit Specification</h4>
                </div>
                <div class="modal-body">
                    <?php  echo $this->Form->create('Edit',array('url'=>(array('controller' => 'products','action' => 'edit_specs_question',$product['Product']['id'],$ifTicket, $ticketId)),'class' => 'form-horizontal'))?>

	               		<div class="form-group">
							<label class="col-lg-2 control-label"><span style="color:red">*</span>Edit Type</label>
							
							<div class="col-lg-8">
								<?php 
									echo $this->Form->input('Edit_Purpose', array(
		                                'options' => array('Edit Specification saved in this Job Ticket', 'Edit for Other Job Ticket Purposes'),  
		                                'label' => false,
		                                'class' => 'form-control required ',
				                        'value' => 1));
		                        ?>
							</div>
							
						</div>
                   
                        <div class="modal-footer">
                             <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle fa-lg"></i> Submit</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                        </div>
                   
                    <?php echo $this->Form->end(); ?>   
                </div>
                
            </div>
        </div>
    </div> 

