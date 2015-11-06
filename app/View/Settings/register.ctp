<?php $this->Html->addCrumb('Register', array('controller' => 'settings', 'action' => 'register')); ?>

<div class="row">
	<div class="col-lg-12">
		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
						                    
					<h1 class="pull-left">
						Registration
					</h1>
					<?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
				</header>

			</div>
		</div>

		
			<div class="row">
				<div class="col-lg-12">
					<div class="main-box">
						<div class="top-space"></div>
						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								<div class="form-horizontal">
									<?php echo $this->Form->create('User',array('url'=>(array('controller' => 'settings','action' => 'register'))));?>
                                    <div class="form-group">
										<label class="col-lg-2 control-label">Firstname</label>
										<div class="col-lg-8">
											<?php
		                                        echo $this->Form->input('User.first_name', array('class' => 'required form-control col-lg-6','label' => false,'placeholder' => 'Firstname'));
		                                    ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Lastname</label>
										<div class="col-lg-8">
											<?php
		                                        echo $this->Form->input('User.last_name', array('class' => 'required form-control col-lg-6','label' => false,'placeholder' => 'Lastname'));
		                                    ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Email</label>
										<div class="col-lg-8">
											<?php
		                                        echo $this->Form->input('User.email', array('class' => 'required form-control col-lg-6','label' => false,'placeholder' => 'Email'));
		                                    ?>
										</div>
									</div>


									<div class="form-group">
										<label class="col-lg-2 control-label">Password</label>
										<div class="col-lg-8">
											<?php
		                                        echo $this->Form->input('User.password', array('label' => 'Password ', 'maxLength' => 255, 'title' => 'Password', 'type'=>'password','class' => 'required form-control col-lg-6','label' => false,'placeholder' => 'Password'));
		                                    ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Repeat Password</label>
										<div class="col-lg-8">
											<?php
		                                         echo $this->Form->input('User.repassword', array('label' => 'Confirm Password ', 'maxLength' => 255, 'title' => 'Password', 'type'=>'password','class' => 'required form-control col-lg-6','label' => false,'placeholder' => 'Confirm Password'));
		                                    ?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label">Role</label>
										<div class="col-lg-8">
											<?php
		                                         echo $this->Form->input('Role.id', array(
		                                            'options' => array($roleDatList),
		                                            'label' => false,
		                                            'style' => 'text-transform:capitalize',
		                                            'class' => 'form-control editRole required',
		                                            'empty' => '--Select Role Description--'));
		                                    ?>
										</div>
									</div>



						
									<div class="form-group">
										<label class="col-lg-2 control-label"> </label>
										<div class="col-lg-8">
											<div class="checkbox-nice">
												<input type="checkbox" id="inCharge" name="data[User][in_charge]">
												<label for="inCharge">
													In Charge
												</label>
											</div>
										</div>
									</div>

									<div class="form-group department-list hide ">
										<label class="col-lg-2 control-label"> Departments </label>
										<div class="col-lg-8" style="margin-left:10px;">
											<div class="form-group">	
												<?php foreach ($departments as $key => $list) { ?>
													<div class="checkbox-nice">
															<input type="checkbox" class="dp-selection" value="<?php echo $key; ?>" id="dp-<?php echo $key; ?>" name="data[User][departments_handle][]">
															<label for="dp-<?php echo $key; ?>">
																<?php echo $list; ?>
														</label>
													</div>
												<?php } ?>		
										</div>
									</div>
									</div>

									<div class="clearfix"></div>
									<div class="form-group">
										<label class="col-lg-2 control-label"> </label>
										<div class="col-lg-3">
											<?php
		                                         echo $this->Form->submit('Register', array('class' => 'btn btn-success col-xs-12',  'title' => 'Click here to add the user') );
		                                    ?>
										</div>
									</div>
								<?php $this->Form->end(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		
	</div>
</div>
<script>
    
    jQuery(document).ready(function($){
            $("#UserRegisterForm").validate();
            //datepicker
           
           $('#inCharge').click(function(){

           		if ($(this).is(':checked')) {
           			$('.department-list').removeClass('hide').find('input').attr('disabled',false);
           		} else {

           			$('.department-list').addClass('hide').find('input').attr('disabled',false);
           		}

           });
            
    });

 </script>