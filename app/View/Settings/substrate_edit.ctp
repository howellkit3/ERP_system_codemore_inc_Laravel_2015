<?php echo $this->element('setting_option');?><br><br>
<?php echo $this->Html->script('substrate'); ?>

<div class="row">
	<div class="col-lg-12">
		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					
					<h1 class="pull-left">
						Edit Substrate
					</h1>
					<?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'item_group','tab' => 'tab-substrates'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
				</header>

			</div>
		</div>
		<?php echo $this->Form->create('Substrate',array('url'=>(array('controller' => 'settings','action' => 'substrate_edit'))));?>
			<div class="row">
				<div class="col-lg-12">
					<div class="main-box">
						<div class="top-space"></div>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">
									<div class="form-group">
										<label class="col-lg-2 control-label"><span style="color:red">*</span>Name</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('Substrate.name', array(
                        								'class' => 'form-control item_type',
	                                                    'label' => false,
	                                                    'required' => 'required',
	                                                    'placeholder' => 'Substrate Name'));
                                            ?>

										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label"><span style="color:red">*</span>Category</label>
										<div class="col-lg-8">
											<?php 
												echo $this->Form->input('Substrate.category_id', array(
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
										<label class="col-lg-2 control-label"><span style="color:red">*</span>Type</label>
										<div class="col-lg-8">
											<?php echo $this->Form->input('ItemTypeHolder.id',array('id' => 'selected_type')); ?>
												<?php echo $this->Form->input('Substrate.type_id', array(
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
										<label class="col-lg-2 control-label"><span style="color:red">*</span>Manufacturer</label>
										<div class="col-lg-8">
											<?php echo $this->Form->input('Substrate.manufacturer_id', array(
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
										<label class="col-lg-2 control-label"><span style="color:red">*</span>Type</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('Substrate.type', array(
                        								'class' => 'form-control item_type',
	                                                    'label' => false,
	                                                    'required' => 'required',
	                                                    'placeholder' => 'Type'));
                                            ?>

										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label"><span style="color:red">*</span>Thickness</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('Substrate.thickness', array(
                        								'class' => 'form-control item_type',
	                                                    'label' => false,
	                                                    'placeholder' => 'Thickness'));
                                            ?>

										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Remarks</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('Substrate.remarks', array(
                        								'class' => 'form-control item_type',
	                                                    'label' => false,
	                                                    'placeholder' => 'Remarks'));
                                            ?>

										</div>
									</div>

									<div class="form-group">
										<div class="col-lg-2"></div>
										<div class="col-lg-8">
											<button type="submit" class="btn btn-primary pull-left">Submit Substrate</button>&nbsp;
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