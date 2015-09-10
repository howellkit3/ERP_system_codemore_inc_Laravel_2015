<?php echo $this->element('payroll_setting_option');?><br><br>

<div class="row">
	<div class="col-lg-12">
		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					<h1 class="pull-left">
						Tax Settings
					</h1>
					<div class=" filter-block pull-right ">
					 <div class="form-group">
						<?php 
	                        // echo $this->Html->link('<i class="fa fa-plus fa-lg"></i> Add ', array('controller' => 'payroll_settings', 'action' => 'main_settings'),array('class' =>'btn btn-primary pull-right','escape' => false));
	                    ?>
	                  </div>
                    </div>
				</header>

			</div>
		</div>
		
		<div class="row">
			<div class="main-box-body clearfix">
			<?php echo $this->Form->create('Setting',array('url'=>(array('controller' => 'payroll_settings','action' => 'main_settings'))));?>
		
				<div class="main-box-body clearfix">
						<div class="main-box clearfix">
							<header class="main-box-header clearfix">
							<h2 class="pull-left"> Payroll Settings </h2>
							<div id="reportrange" class="pull-right daterange-filter">
								<i class="icon-calendar"></i>
								<span></span> <b class="caret"></b>
							</div>
							</header>

							<div class="main-box-body clearfix">
								<div class="form-horizontal">
									
								<div class="form-group">
										<label class="col-lg-2 control-label"><span style="color:red">*</span> Working Days </label>
										<div class="col-lg-8">
										<?php 	
												echo $this->Form->input('id',array('type' => 'hidden' ));
	                                            echo $this->Form->input('working_days', 
	                                            		array('class' => 'form-control item_type col-lg-4 number',
							                                   'label' => false,
							                                   'placeholder' => 'Working Days limit'));
                                            
                                         ?>
                                        </div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label"><span style="color:red">*</span> Leaves </label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('leaves', array(
	                                            								'class' => 'form-control item_type number',
							                                                    'label' => false,
							                                                    'placeholder' => 'Leave Days'));
                                            
                                            ?>

										</div>
									</div>	

									<div class="form-group">
										<label class="col-lg-2 control-label"><span style="color:red">*</span> Tax Payment Settings </label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('tax_pay', 
	                                            	array(
	                                            		'options' => array(
	                                            			'daily' => 'Daily',
	                                            			'weekly' => 'Weekly',
	                                            			'semi_montly' => 'Semi Monthly',
	                                            			'montly' => 'Monthly',
	                                            		),
	                                            		'class' => 'form-control item_type',
	                                            		'empty' => '---- Select Type -----',
	                                            		'label' => false,
							                             'placeholder' => 'Payment Settings'
							                        ));
                                            ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label"><span style="color:red">*</span> Payroll computations </label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('payment_type', 
	                                            	array(
	                                            		'options' => array(
	                                            			'yearly' => 'by Year',
	                                            			'days' => 'by days',
	                                            			'month' => 'by Month',
	                                            		),
	                                            		'class' => 'form-control item_type',
	                                            		'empty' => '---- Select Type -----',
	                                            		'label' => false,
							                             'placeholder' => 'Payroll Computations'
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

			<?php echo $this->Form->end(); ?>
			</div>
	</div>
</div>
</div>