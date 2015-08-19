<?php echo $this->element('payroll_setting_option');?><br><br>
<div class="row">
	<div class="col-lg-12">
		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					<h1 class="pull-left">
						Deduction Settings
					</h1>
					<?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'sss_ranges'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
				</header>

			</div>
		</div>
		<?php echo $this->Form->create('Loan',array('url'=>(array('controller' => 'payroll_settings','action' => 'loan_add'))));?>
			
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
	                                            		array('class' => 'form-control item_type col-lg-4',
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
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'type' => 'textarea',
							                                                    'placeholder' => 'Description'));
                                            
                                            ?>

										</div>
									</div>	

									<div class="form-group">
										<label class="col-lg-2 control-label"><span style="color:red">*</span> Payment Schedule </label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('schedules', 
	                                            	array(
	                                            		'options' => array(
	                                            		  '1' => 'Once',
	                                            		  '2' => 'Every Month',
	                                            		  '3' => 'Twice a Month', 
	                                            		  '4' => 'Yearly'
	                                            		  ),
	                                            		'class' => 'form-control item_type',
	                                            		'empty' => '---- Select Type -----',
	                                            		'label' => false,
							                             'placeholder' => 'Payment Schedule'
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