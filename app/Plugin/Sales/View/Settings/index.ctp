<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Settings', array('controller' => 'customer_sales', 'action' => 'settings')); ?>
<?php echo $this->Html->script('Sales.inquiry');?>
<div style="clear:both"></div>

<?php echo $this->element('sales_option');?><br><br>
<div class="col-lg-12 col-md-8 col-sm-8">
	<div class="main-box clearfix">
		<div class="tabs-wrapper profile-tabs">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab-newsfeed" data-toggle="tab">Add Custom Field</a></li>
			</ul>
			
			<div class="tab-content">
				<div class="tab-pane fade in active" id="tab-newsfeed">
					
					<div class="table-responsive">
						
						<div class="col-lg-6">
							<div class="main-box">
								<header class="main-box-header clearfix">
									<h2><b>Add Label</b></h2>
								</header>
								
								<div class="main-box-body clearfix">
									<?php echo $this->Form->create('CustomField',array('url'=>(array('controller' => 'settings','action' => 'custom_field')),'class' => 'form-horizontal'));?>
										<div class="form-group">
											<label for="inputEmail1" class="col-lg-2 control-label">Label</label>
											<div class="col-lg-8">
												<?php 
	                                                echo $this->Form->input('CustomField.fieldlabel', array('class' => 'form-control item_type',
	                                                    'alt' => 'address1',
	                                                    'label' => false));
	                                            ?>
											</div>
										</div>
										
										<div class="form-group">
											<div class="col-lg-offset-2 col-lg-10">
												<button type="submit" class="btn btn-success">Add Label</button>
											</div>
										</div>
									<?php echo $this->Form->end(); ?>
								</div>								
							</div>
						</div>
						<div class="col-lg-6 col-md-4 col-sm-4">
							<div class="main-box clearfix">
								<header class="main-box-header clearfix">
									<h1>Custom Fields List</h1>
								</header>
								<table class="table table-striped table-hover">
			                        <thead>
			                            <tr>
			                                <th><a href="#"><span>Label</span></a></th>
			                                <th><a href="#"><span>Created</span></a></th>
			                                <th>Action</th>
			                            </tr>
			                        </thead>

			                        <?php echo $this->element('custom_field_table'); ?>

			                    </table>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>