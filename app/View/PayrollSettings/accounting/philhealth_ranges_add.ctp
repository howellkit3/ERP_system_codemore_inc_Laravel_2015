<?php echo $this->element('payroll_setting_option');?><br><br>
<div class="row">
	<div class="col-lg-12">
		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					<h1 class="pull-left">
						SSS Ranges
					</h1>
					<?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'payroll_settings', 'action' => 'sss_ranges'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
				</header>

			</div>
		</div>
		<?php echo $this->Form->create('PhilHealthRange',array('url'=>(array('controller' => 'payroll_settings','action' => 'sss_ranges_add'))));?>
			
			<div class="row">
				<div class="col-lg-12">
					<div class="main-box">
						<div class="top-space"></div>

<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">
									<div class="form-group">
										<label class="col-lg-2 control-label"><span style="color:red">*</span> Bounds / Salary Range</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('id');
	                                            echo $this->Form->input('range_from', array(
	                                            								'class' => 'form-control item_type col-lg-4',
							                                                    'label' => false,
							                                                    'placeholder' => 'Salary Start'));
                                            
                                            ?>
                                            - 

                                            <?php 
	                                            echo $this->Form->input('range_to', array(
	                                            								'class' => 'form-control item_type col-lg-4',
							                                                    'label' => false,
							                                                    'placeholder' => 'Salary Start'));
                                            
                                            ?>
                                            <span class="lighter-color2">write Above or Below</span>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label"><span style="color:red">*</span> Salary Base </label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('salary_base', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'placeholder' => 'Monthly Credit'));
                                            
                                            ?>

										</div>
									</div>
									<h5>Employer to Employee Contibution</h5>
									<hr/>
									<div class="form-group">
										<label class="col-lg-2 control-label"><span style="color:red">*</span> Employer </label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('employer', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'placeholder' => 'Employer'));
                                            
                                            ?>

										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label"><span style="color:red">*</span> Employees </label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('employee', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'placeholder' => 'Employees'));
                                            
                                            ?>

										</div>
									</div>

									<div class="form-group">
										<div class="col-lg-2"></div>
										<div class="col-lg-8">
											<button type="submit" class="btn btn-primary pull-left">Submit</button>&nbsp;
											<?php 
						                        echo $this->Html->link('Cancel', array('controller' => 'payroll_settings', 'action' => 'index'),array('class' =>'btn btn-default','escape' => false));
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