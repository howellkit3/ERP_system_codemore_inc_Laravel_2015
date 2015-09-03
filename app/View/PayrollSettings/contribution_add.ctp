<?php echo $this->element('payroll_setting_option');?><br><br>
<div class="row">
	<div class="col-lg-12">
		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					<h1 class="pull-left">
						Contribution Settings
					</h1>
					<?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'payroll_settings', 'action' => 'contributions'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
				</header>

			</div>
		</div>
		<?php echo $this->Form->create('Contribution',array('url'=>(array('controller' => 'payroll_settings','action' => 'contribution_add'))));?>
			
			<div class="row">
				<div class="col-lg-12">
					<div class="main-box">
						<div class="top-space"></div>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">
									
								<div class="form-group">
										<label class="col-lg-2 control-label"><span style="color:red">*</span> Name </label>
										<div class="col-lg-8">
										<?php 	
												echo $this->Form->input('id',array('type' => 'hidden' ));
	                                            echo $this->Form->input('name', 
	                                            		array('class' => 'form-control item_type col-lg-4 required',
							                                   'label' => false,
							                                   'placeholder' => 'Name'));
                                            
                                         ?>
                                        </div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label"><span style="color:red">*</span> Description </label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('description', array(
	                                            								'class' => 'form-control item_type required',
							                                                    'label' => false,
							                                                    'type' => 'textarea',
							                                                    'placeholder' => 'Description'));
                                            
                                            ?>

										</div>
									</div>	

									<div class="form-group">
										<label class="col-lg-2 control-label"><span style="color:red">*</span> Scheme </label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('schedules', 
	                                            	array(
	                                            		'options' => array(
	                                            		  '1' => 'Semi Monthly(Equal)',
	                                            		  '2' => 'Semi Monthly(First Payroll)',
	                                            		  '3' => 'Semi Monthly(Second Payroll)', 
	                                            		  '4' => 'Anytime'
	                                            		  ),
	                                            		'class' => 'form-control item_type required',
	                                            		'empty' => '---- Select Type -----',
	                                            		'label' => false,
							                             'placeholder' => 'Payment Scheme'
							                        ));
                                            
                                            ?>
										</div>
									</div>	

									<div class="form-group">
										<div class="col-lg-2"></div>
										<div class="col-lg-8">
											<button type="submit" class="btn btn-primary pull-left">Submit</button>&nbsp;
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
		<?php echo $this->Form->end(); ?>

		
	</div>


		
	</div>
</div>