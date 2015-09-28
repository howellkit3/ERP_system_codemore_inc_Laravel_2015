<?php $this->Html->addCrumb('Profile Settings', array('controller' => 'users', 'action' => 'profile_settings')); ?>
<?php echo $this->Html->css('HumanResource.default');?>
<?php echo $this->Html->script('HumanResource.custom');?>
<?php echo $this->Html->script('profile');?>
<div style="clear:both"></div>
<div class="row">
    <div class="col-lg-12">
		<div class="row" id="user-profile">
			<div class="col-lg-3 col-md-4 col-sm-4">
				<div class="main-box clearfix">
					<header class="main-box-header clearfix">
						<center>

							<h4 style="word-wrap:break-word">
								<?php //echo $this->CustomText->getFullname($employee['Employee']);  ?>
							</h4>
						
						</center>
					</header>
					<?php echo $this->Form->create('User',array(
					'url' => array('controller' => 'users',
					'action' => 'profile_settings',$userData['User']['id']),
					'enctype' => 'multipart/form-data')); ?>	
					<div class="main-box-body clearfix">

						<div class="profile-since">
							<center>
								<?php
		                            $style = '';

			                         $serverPath = $this->Html->url('/',true);

		                            if (!empty($userData['User']['image'])) {
	
			                            $background =  $serverPath.'img/uploads/users/'.$userData['User']['image'];	
			                            $style = 'background:url('.$background.')';
		                            } 

		                        ?>
	                            <div class="image_profile" style="<?php echo $style; ?>">
										<?php 
				                    		echo $this->Form->input('file', array(
				                    		'type' => 'file',
				                         	'class' => 'form-control btn-success',
				                         	'onchange' => 'readURL(this,"image_profile")',
				                         	'label' => false));
				                    	?>
				                </div>
		                       <button class="btn btn-success upload-image"> Uplad Photo </button>
	                        </center>
						</div>

						<div class="story-author">
							<div class="table-responsive">
								<div class="col-lg-12">
                             		<div class="form-group">
                                        <label for="inputEmail1" class="col-lg-12 control-label strong">Name</label>
	                                      <div class="col-lg-12 value">

	                                      		<?php 

													if(isset($userData)){
														echo $userData['User']['first_name'].' '.$userData['User']['last_name'];
													}


	                                      		?>
	                                       </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-12 control-label strong">Role</label>
	                                      <div class="col-lg-12 value">

	                                      		<?php 

													if(isset($userData['Role'])){
														echo $userData['Role']['name'];
													}


	                                      		?>
	                                       </div>
                                    </div>
								</div>
							</div>
						</div>

					</div>
					
				</div>
			</div>


				<div class="col-lg-9 col-md-8 col-sm-8">
				<div class="main-box clearfix">
					<div class="tabs-wrapper profile-tabs">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab-ainfo" data-toggle="tab">Profile Information</a></li>
						<!-- 	<li class=""><a href="#tab-ainfo" data-toggle="tab">Salary Adjustment</a></li> -->
							
						</ul>
						
						<div class="tab-content">
								<div class="tab-pane fade active in" id="tab-ainfo">
										<div class="story-content remove-pad">
											<header class="story-header">
											
												<div class="story-author">
														<div class="table-responsive">
															<div class="col-lg-12">
					                                     		<div class="form-group">
							                                        <label for="inputEmail1" class="col-lg-2 control-label strong"> First Name </label>
								                                      <div class="col-lg-7 value">
								                                      		<?php
								                                      		echo $this->Form->input('id',array(
								                                      			'value' => $userData['User']['id']
								                                      		));
								                                      		 echo $this->Form->input('first_name',
								                                      		 	array(
									                                      		 	'label' => false,
									                                      		 	'class' => 'form-control',
									                                      		 	'value' => !empty($userData['User']['first_name']) ? $userData['User']['first_name'] : ''
								                                      		 	));
								                                      		 ?>
								                                       </div>
							                                     </div>
							                                     <div class="clearfix"></div>

							                                      <div class="form-group">
							                                        <label for="inputEmail1" class="col-lg-2 control-label strong"> Last Name </label>
								                                      <div class="col-lg-7 value"> 
								                                     		<?php echo $this->Form->input('last_name',
								                                     		array(
									                                     		'label' => false,
									                                     		'class' => 'form-control',
									                                     		'value' => !empty($userData['User']['last_name']) ? $userData['User']['last_name'] : ''
									                                     		)); ?>
								                                       </div>
							                                     </div>
							                                     <div class="clearfix"></div>

							                                     <div class="form-group">
							                                        <label for="inputEmail1" class="col-lg-2 control-label strong"> Email Address </label>
								                                      <div class="col-lg-7 value"> 
								                                     		<?php echo $this->Form->input('email',array(
								                                     		'label' => false,
								                                     		'class' => 'form-control',
								                                     		'value' => $userData['User']['email']
								                                     		)); ?>
								                                       </div>
							                                     </div>
							                                     <div class="clearfix"></div>

							                                      <a href="#" class="changePass">Change Password</a>
							                                      <br>
							                                       <br>
							                                       <div class="clearfix"></div>
							                                      <div class="ChangePassword hide">

							                                       <div class="form-group">
							                                        <label for="inputEmail1" class="col-lg-2 control-label strong"> Password </label>
								                                      <div class="col-lg-7 value"> 
								                                     		<?php echo $this->Form->input('password',array(
								                                     		'label' => false,
								                                     		'type' => 'password',
								                                     		'class' => 'form-control',
								                                     		'value' => $userData['User']['rxt']
								                                     		)); ?>
								                                       </div>
							                                     	</div>

							                                      <div class="clearfix"></div>
							                                        <div class="form-group">
							                                        <label for="inputEmail1" class="col-lg-2 control-label strong"> Password </label>
								                                      <div class="col-lg-7 value"> 
								                                     		<?php echo $this->Form->input('repassword',array(
								                                     		'label' => false,
								                                     		'type' => 'password',
								                                     		'class' => 'form-control',
								                                     		)); ?>
								                                       </div>
							                                     	</div>
							                                     	
							                                      <div class="clearfix"></div>

							                                      </div>
			                                    			</div>
														</div>
												</div>
												
											</header>
											<hr class="dashed grey">
												<button class="btn btn-success"><i class="fa fa-check"></i> Submit </button> <button class="btn btn-default" type="reset"><i class="fa fa-times"></i> Clear </button>
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

<script type="text/javascript">
	$(document).ready(function(e){

		$('.ChangePassword').find('input').attr('disabled','disabled');

		$('.changePass').click(function(){

			if ($('.ChangePassword').hasClass('hide') == true) {
				
				$('.ChangePassword').removeClass('hide');

				$('.ChangePassword').find('input').attr('disabled',false);

			} else {

				$('.ChangePassword').addClass('hide');

				$('.ChangePassword').find('input').attr('disabled','disabled');
			}

		});

	});
</script>
