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

	<?php echo $this->Form->create('OvertimeRate',array('url'=>(array('controller' => 'payroll_settings','action' => 'ot_rates_edit'))));?>
			
			<div class="row">
				<div class="col-lg-12">
					<div class="main-box">
						<div class="top-space"></div>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">
									
								<div class="form-group">
									<label class="col-lg-2 control-label"><span style="color:red">*</span> Day </label>
										<div class="col-lg-8">
										<?php 	
												echo $this->Form->input('id',array('type' => 'hidden' ));
	                                            echo $this->Form->input('day_type_id', 
	                                            		array(
	                                            			'options' => $days,
	                                            			'class' => 'form-control item_type col-lg-4 required',
	                                            			'empty' => '--- Select Day-Type ----',
							                                'label' => false,
							                                 'placeholder' => 'Name'));
                                            
                                         ?>
                                        </div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label"><span style="color:red">*</span> Rates </label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('rates', array(
	                                            								'class' => 'form-control item_type required',
							                                                    'label' => false,
							                                                    'placeholder' => '0.00'));
                                            
                                            ?>

										</div>
									</div>	

									<div class="form-group">
										<label class="col-lg-2 control-label"><span style="color:red">*</span> Overtime </label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('overtime', 
	                                            	array(
	                                            		'class' => 'form-control item_type required',
	                                            		'label' => false,
							                            'placeholder' => '0.00'
							                        ));
                                            
                                            ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label"><span style="color:red">*</span> Night Differential </label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('night_diffrential', 
	                                            	array(
	                                            		'class' => 'form-control item_type required',
	                                            		'label' => false,
							                            'placeholder' => '0.00'
							                        ));
                                            
                                            ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label"><span style="color:red">*</span> Night Differential OT </label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('night_defferential_ot', 
	                                            	array(
	                                            		'class' => 'form-control item_type required',
	                                            		'label' => false,
							                            'placeholder' => '0.00'
							                        ));
                                            
                                            ?>
										</div>
									</div>	

									<div class="form-group">
										<div class="col-lg-2"></div>
										<div class="col-lg-8">
											<button type="submit" class="btn btn-primary pull-left">Submit</button>&nbsp;
											<?php 
						                        echo $this->Html->link('Cancel', array('controller' => 'payroll_settings', 'action' => 'ot_rates'),array('class' =>'btn btn-default','escape' => false));
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