<?php echo $this->element('setting_option');?><br><br>
<?php echo $this->Html->script('general_item'); ?>
<div class="row">
	<div class="col-lg-12">
		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					
                    
					<h1 class="pull-left">
						Edit General Item
					</h1>
					<?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'item_group'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
				</header>

			</div>
		</div>
		<?php echo $this->Form->create('GeneralItem',array('url'=>(array('controller' => 'settings','action' => 'general_item_edit'))));?>
			
			<div class="row">
				<div class="col-lg-12">
					<div class="main-box">
						<div class="top-space"></div>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">
									<div class="form-group">
										<label class="col-lg-2 control-label">General Item Name</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('GeneralItem.name', array(
                        								'class' => 'form-control item_type',
	                                                    'label' => false,
	                                                    'required' => 'required',
	                                                    'placeholder' => 'General Item Name'));
                                            ?>

										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Category</label>
										<div class="col-lg-8">
											<?php 
												echo $this->Form->input('GeneralItem.category_id', array(
														'options' => array($categoryData),
														'type' => 'select',
														'label' => false,
														'class' => 'form-control required categorylist',
														'empty' => '---Select Item Category---',
														'required' => 'required'
													)); 
											?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Type</label>
										<div class="col-lg-8">
											<?php echo $this->Form->input('ItemTypeHolder.id',array('id' => 'selected_type')); ?>
												<?php echo $this->Form->input('GeneralItem.type_id', array(
														'options' => '',
														'type' => 'select',
														'label' => false,
														'class' => 'form-control required categorylist',
														'empty' => '---Select Item Type---',
														'required' => 'required'
												)); 
												?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Manufacturer</label>
										<div class="col-lg-8">
											<?php echo $this->Form->input('GeneralItem.manufacturer_id', array(
														'options' => array($supplierData),
														'type' => 'select',
														'label' => false,
														'class' => 'form-control required categorylist',
														'empty' => '---Select Supplier---',
														'required' => 'required'
											)); 
											?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Measurement</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('GeneralItem.measure', array(
                        								'class' => 'form-control item_type',
	                                                    'label' => false,
	                                                    'required' => 'required',
	                                                    'placeholder' => 'Measure'));
                                            ?>

										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Remarks</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('GeneralItem.measure', array(
                        								'class' => 'form-control item_type',
	                                                    'label' => false,
	                                                    'placeholder' => 'Remarks'));
                                            ?>

										</div>
									</div>

									<div class="form-group">
										<div class="col-lg-2"></div>
										<div class="col-lg-8">
											<button type="submit" class="btn btn-primary pull-left">Submit General Item</button>&nbsp;
											<?php 
						                        echo $this->Html->link('Cancel', array('controller' => 'settings', 'action' => 'index'),array('class' =>'btn btn-default','escape' => false));
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