<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Quotation', array('controller' => 'quotation', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Create', array('controller' => 'quotation', 'action' => 'create')); ?>
<?php  echo $this->Html->script('Sales.company_quotation');?>
<?php echo $this->Html->script('Sales.checkvat');?>
<?php  echo $this->Html->script('Sales.create_ajax');?>
<style type="text/css">#QuotationField12Description{background-color:#fff;}</style>
<div style="clear:both"></div>
      
<?php echo $this->element('purchasings_option'); ?><br><br>

<?php if(!empty($inquiry['Inquiry']['id'])) {

	echo $this->element('inquiry_quotation');

} else { ?>
	
	<div class="row">
		<div class="col-lg-12">
			
			<div class="row">
				<div class="col-lg-12">
					<header class="main-box-header clearfix">
							                    
						<h1 class="pull-left">
							Create Purchase Request
						</h1>
						<?php 
	                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'quotations', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
	                    ?>
					</header>

				</div>
			</div>
			<?php echo $this->Form->create('Request',array('url'=>(array('controller' => 'requests','action' => 'create'))));?>
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
		                                            echo $this->Form->input('Request.name', array(
		                                            								'class' => 'form-control item_type',
								                                                    'label' => false,
								                                                    'placeholder' => 'Request Name'));
	                                            ?>
											</div>
										</div>

										<div class="form-group" id="existing_items">
											<label class="col-lg-2 control-label"><span style="color:red">*</span>Type</label>
											<div class="col-lg-8">
												<?php 
	                                                echo $this->Form->input('Request.item_category_holder_id', 
	                                                						array( 
	                                                						'options' => array($purchasingTypeData),	
	                                                						'type' => 'select',
	                                                						'class' => 'form-control item_type categorylist required', 
	                                                    					'label' => false, 
	                                                    					'placeholder' => 'Item',
	                                                    					'empty' => '--Select Category--'
	                                                    					));
	                                            ?>
											</div>
										</div>

										<div class="form-group" id="existing_items">
											<label class="col-lg-2 control-label"><span style="color:red">*</span>Item</label>
											<div class="col-lg-6">
												<?php 
	                                                echo $this->Form->input('Request.product_id', 
	                                                									array( 
	                                                						'type' => 'select',
	                                                						'class' => 'form-control item_type required', 
	                                                    					'label' => false,
	                                                    					'id' => 'txtProduct',
	                                                    					'id' => 'product_holder_id',
	                                                    					'placeholder' => 'Item',
	                                                    					'empty' => '--Select Item--'
	                                                    					));
	                                            ?>
											</div>

											<div class="col-lg-2">

												<a data-toggle="modal" href="#myModalItem" class="btn btn-primary mrg-b-lg pull-right addSchedButton "><i class="fa fa-plus-circle fa-lg"></i> Select Purchase Item</a>

											</div>
										</div>
	                                    
										<div class="form-group">
											<label for="inputPassword1" class="col-lg-2 control-label"> Remarks</label>
											<div class="col-lg-8">
												<?php 
												echo $this->Form->textarea('Request.remarks', array('class' => 'form-control item_type',
												'alt' => 'Request Inquiry',
												'label' => false,
												'rows' => '6'));
												?>

											</div>
										</div>

	                                	

										<div class="form-group">
											<div class="col-lg-2"></div>
												<div class="col-lg-8">
												<?php echo $this->Form->submit('Submit Request',array('class' => 'btn btn-primary','div' => false,'name' => 'submit','value' => 'pending')); ?>

												&nbsp;
												<?php echo $this->Html->link('<button type="submit" class="btn btn-default">Cancel</button>', array('controller' => 'quotations', 'action' => 'index'),array('escape' => false));
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

	<?php echo $this->element('item_modal'); ?>


	<script>
		
	jQuery(document).ready(function($){
			$("#QuotationCreateForm").validate();
			//datepicker
			$('.datepick').datepicker({
				format: 'yyyy-mm-dd'
			});
			
	});

	 </script>
		
<?php } ?>

