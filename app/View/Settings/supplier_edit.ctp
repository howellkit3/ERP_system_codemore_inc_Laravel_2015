<?php echo $this->element('setting_option');?><br><br>

<div class="row">
	<div class="col-lg-12">
		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					    
					<h1 class="pull-left">
						Edit Supplier
					</h1>
					<?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
				</header>
			</div>
		</div>
		<?php echo $this->Form->create('Supplier',array('url'=>(array('controller' => 'settings','action' => 'supplier_edit'))));?>
			
			<div class="row">
				<div class="col-lg-12">
					<div class="main-box">
						<div class="top-space"></div>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">
									<div class="form-group">
										<label class="col-lg-2 control-label">Supplier</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('Supplier.name', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'placeholder' => 'Name of Supplier'));
	                                             echo $this->Form->input('Supplier.id', array(
	                                            								'class' => 'form-control item_type',
	                                            								'hidden' => 'hidden',
							                                                    'label' => false,
							                                                    'placeholder' => 'Name Category'));
	                                              echo $this->Form->input('Supplier.id', array(
	                                            								'class' => 'form-control item_type',
	                                            								'hidden' => 'hidden',
							                                                    'label' => false,
							                                                    'placeholder' => 'Name Category'));
                                            ?>

										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Description</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('Supplier.description', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'placeholder' => 'Description of Supplier'));
                                            
                                            ?>
										</div>
									</div>

									<div class="form-group">
										<div class="col-lg-2"></div>
										<div class="col-lg-8">
											<button type="submit" class="btn btn-primary pull-left">Submit Supplier</button>&nbsp;
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