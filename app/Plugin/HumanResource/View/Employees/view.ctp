<?php $this->Html->addCrumb('Employee', array('controller' => 'employees', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Add', array('controller' => 'employees', 'action' => 'add')); ?>
<?php echo $this->Html->css('HumanResource.default');?>
<?php echo $this->Html->script('HumanResource.custom');?>
<div style="clear:both"></div>

<?php echo $this->element('hr_options'); ?><br><br>

<div class="row">
    <div class="col-lg-12">
       	
       	<div class="row">
            <div class="col-lg-12">
                <header class="main-box-header clearfix">
                    
                    <center>
                        <h1 class="pull-left">
                            Employee Information
                        </h1>
                    </center>
                    <?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'employees', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
                </header>

            </div>
        </div>

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
					
					<div class="main-box-body clearfix">

						<div class="profile-since">
							<center>
								<?php
		                            $style = '';

		                            if (!empty($employee['Employee']['image'])) {

			                            $serverPath = $this->Html->url('/',true);	
			                            $background =  $serverPath.'img/uploads/employee/'.$employee['Employee']['image'];	
			                            $style = 'background:url('.$background.')';
		                            } 

		                        ?>
	                            <div class="image_profile" style="<?php echo $style; ?>"></div>
	                        </center>
						</div>

						<div class="story-author">
									<div class="table-responsive">
												<div class="col-lg-12">
		                                     		<div class="form-group">
				                                        <label for="inputEmail1" class="col-lg-12 control-label strong">Name</label>
					                                      <div class="col-lg-12 value">

					                                       <?php echo $this->CustomText->getFullname($employee['Employee']);  ?>
					                                       </div>
				                                     </div>
				                                     <div class="form-group">
				                                        <label for="inputEmail1" class="col-lg-12 control-label strong">Employee #</label>
					                                      <div class="col-lg-12 value"> 
					                                       <?php echo rand(1000,80000);  ?>
					                                       </div>
				                                     </div>

				                                      <div class="form-group">
				                                        <label for="inputEmail1" class="col-lg-12 control-label strong">Department</label>
					                                      <div class="col-lg-12 value"> 
					                                       <?php echo !empty($departments[$employee['Employee']['department_id']]) ? $departments[$employee['Employee']['department_id']] : '';  ?>
					                                       </div>
				                                     	</div>

				                                     	<div class="form-group">
				                                        <label for="inputEmail1" class="col-lg-12 control-label strong">Position</label>
					                                      <div class="col-lg-12 value"> 
					                                       <?php echo !empty($positions[$employee['Employee']['position_id']]) ? $positions[$employee['Employee']['position_id']] : '';  ?>
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
							<li class="active"><a href="#tab-ainfo" data-toggle="tab">Additional Information</a></li>
							<?php if(!empty($employee['Address'][0])) : ?>
									<li><a href="#tab-address" data-toggle="tab">My Address</a></li>
							<?php endif; ?>		
							<li><a href="#tab-gov" data-toggle="tab">Government Records</a></li>
							<li><a href="#tab-cperson" data-toggle="tab">Contact Person</a></li>
							<!-- <li><a href="#tab-chat" data-toggle="tab">Email</a></li>
							<li><a href="#tab-friends" data-toggle="tab">Contact Person</a></li>
							<li><a href="#tab-products" data-toggle="tab">Products</a></li> -->
							<?php 
		                        // echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'customer_sales', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
		                    ?>
						</ul>
						
						<div class="tab-content">
						
									<div class="tab-pane fade active in" id="tab-ainfo">
										<div class="story-content remove-pad">
											<header class="story-header">
											
												<div class="story-author">
														<div class="table-responsive">
															<div class="col-lg-12">
	                                     		<div class="form-group">
			                                        <label for="inputEmail1" class="col-lg-2 control-label strong">
			                                        <i class="fa fa-calendar"></i>	
			                                        Birthday</label>
				                                      <div class="col-lg-9 value"> 
				                                       <i class="fa fa-cake"></i>
				                                       <?php echo date('Y-m-d',strtotime($employee['EmployeeAdditionalInformation']['birthday']))  ?>
				                                       </div>
			                                     </div>
			                                     <div class="form-group">
			                                        <label for="inputEmail1" class="col-lg-2 control-label strong">
			                                        <i class="fa fa-envelope-o"></i>	
			                                        Email</label>
				                                      <div class="col-lg-9 value"> 
				                                      <?php echo $employee['Email'][0]['email'];  ?>
				                                       </div>
			                                     </div>

			                                      <div class="form-group">
			                                        <label for="inputEmail1" class="col-lg-2 control-label strong">
			                                        	<i class="fa fa-genderless"></i>
			                                        Gender</label>
				                                      <div class="col-lg-9 value"> 
				                                       <?php echo ( $employee['EmployeeAdditionalInformation']['gender'] == 'M' ) ? 'Male' : 'Female' ?>
				                                       </div>
			                                     	</div>

			                                     	<div class="form-group">
			                                        <label for="inputEmail1" class="col-lg-2 control-label strong">
			                                        <i class="fa fa fa-user"></i>
			                                        Height</label>
				                                      <div class="col-lg-9 value"> 
				                                       <?php echo $employee['EmployeeAdditionalInformation']['height']; ?>
				                                       </div>
			                                     	</div>

			                                     	<div class="form-group">
			                                        <label for="inputEmail1" class="col-lg-2 control-label strong">
			                                        <i class="fa fa fa-user"></i>
			                                        Weight</label>
				                                      <div class="col-lg-9 value"> 
				                                     	 <?php echo $employee['EmployeeAdditionalInformation']['weight']; ?>
				                                       </div>
			                                     	</div>

			                                     	<div class="form-group">
			                                        <label for="inputEmail1" class="col-lg-2 control-label strong">
			                                        <i class="fa fa-tint"></i>
			                                        Blood Type</label>
				                                      <div class="col-lg-9 value"> 
				                                     	 <?php echo ucwords($employee['EmployeeAdditionalInformation']['blood']); ?>
				                                       </div>
			                                     	</div>

			                                     	<div class="form-group">
				                                        <label for="inputEmail1" class="col-lg-2 control-label strong">
				                                        	<i class="fa fa-globe"></i>
				                                        Languages</label>
					                                      <div class="col-lg-9 value"> 
					                                     	 <?php echo ucwords($employee['EmployeeAdditionalInformation']['languages']); ?>
					                                       </div>
				                                     	</div>

													<div class="form-group">
				                                        <label for="inputEmail1" class="col-lg-2 control-label strong">
				                                        	<i class="fa fa-star"></i>
				                                        Skills</label>
					                                      <div class="col-lg-9 value"> 
					                                     	 <?php echo ucwords($employee['EmployeeAdditionalInformation']['skills']); ?>
					                                       </div>
				                                     </div>

				                                    <div class="form-group">
				                                        <label for="inputEmail1" class="col-lg-2 control-label strong">
				                                        	<i class="fa fa-phone"></i>
				                                        Contact #</label>
					                                      <div class="col-lg-9 value"> 
					                                     	 <?php echo $employee['Contact'][0]['number']; ?>
					                                       </div>
				                                     </div>
				                                      
													</div>

													</div>
												</div>
												
											</header>
										</div>
									</div>

									<?php if(!empty($employee['Address'][0])) : ?>
									<div class="tab-pane" id="tab-address">
										<div class="story-content remove-pad">
											<header class="story-header">
												<div class="story-author">
													<div class="table-responsive">
														<div class="col-lg-12">
		                                     		<div class="form-group">
				                                        <label for="inputEmail1" class="col-lg-2 control-label strong">Address</label>
					                                      <div class="col-lg-9 value"> 
					                                       	<?php echo $employee['Address'][0]['address_1']; ?>
					                                       </div>
				                                     </div>
				                                     <div class="form-group">
				                                        <label for="inputEmail1" class="col-lg-2 control-label strong">City</label>
					                                      <div class="col-lg-9 value"> 
					                                       	<?php echo $employee['Address'][0]['city']; ?>
					                                       </div>
				                                     </div>

				                                      <div class="form-group">
				                                        <label for="inputEmail1" class="col-lg-2 control-label strong">Department</label>
					                                      <div class="col-lg-9 value"> 
					                                      	<?php echo $employee['Address'][0]['city']; ?>
					                                       </div>
				                                     	</div>

				                                     	<div class="form-group">
				                                        <label for="inputEmail1" class="col-lg-2 control-label strong">Position</label>
					                                      <div class="col-lg-9 value"> 
					                                       <?php echo !empty($positions[$employee['Employee']['position_id']]) ? $positions[$employee['Employee']['position_id']] : '';  ?>
					                                       </div>
				                                     	</div>

		                                 		</div>

												</div>
											</div>
												
											</header>
										</div>
									</div>

								<?php endif; ?>


								<div class="tab-pane" id="tab-gov">
										<div class="story-content remove-pad">
											<header class="story-header">
												<div class="story-author">
												<div class="table-responsive">

												<div class="col-lg-12">
													<?php if (!empty($employee['GovernmentRecord'])) :
						                           	
						                           	$agencies = array(
																'sss' => 'SSS',
																'philhealth' => 'PhilHealth',
																'bir' => 'Tin',
																'pagibig' => 'Pag-Ibig');

						                            foreach($employee['GovernmentRecord'] as $gov_key => $data) {

						                           	$this->request->data['EmployeeAgencyRecord'][$gov_key] = $data;

						                           	?>

						                           	<div class="form-group">
								                                        <label for="inputEmail1" class="col-lg-2 control-label strong"> <?php echo 	$agencies[$data['agency']] ?> Number </label>
									                                      <div class="col-lg-9 value"> 
									                                       	<?php echo $data['value'] ?>
									                                       </div>
								                               </div>


						                           	<?php } ?>	
						                           	<?php endif; ?>
		                                 		</div>

												</div>
											</div>
												
											</header>
										</div>
								</div>


								<div class="tab-pane" id="tab-cperson">
										<div class="story-content remove-pad">
											<header class="story-header">
												<div class="story-author">
												<div class="table-responsive">

												<div class="col-lg-12">
													
													<h2>Info</h2>

						                           	<div class="form-group">
				                                        <label for="inputEmail1" class="col-lg-2 control-label strong">
				                                        Name :
				                                         </label>
					                                      <div class="col-lg-9 value"> 
					                                        <?php echo $this->CustomText->getFullname($employee['ContactPerson'],'firstname','middlename','lastname');  ?>
					                                       </div>
								                 	</div>

								                 	<div class="form-group">
				                                        <label for="inputEmail1" class="col-lg-2 control-label strong">
				                                        Number :
				                                         </label>
					                                      <div class="col-lg-9 value"> 
					                                        <?php echo $employee['ContactPersonNumber']['number'];  ?>
					                                       </div>
								                 	</div>

								                 	<?php if(!empty($employee['ContactPersonAddress']['ContactPersonEmail'])) : ?>
								                 		<div class="form-group">
					                                       	<label for="inputEmail1" class="col-lg-2 control-label strong">
					                                        	Email
					                                        </label>
					                                      	<div class="col-lg-9 value"> 
					                                       	<?php echo $employee['ContactPersonEmail']['email'] ?>
					                                       </div>
								                 		</div>
								                    <?php endif;?>

								                 	<h2>Address</h2>

								                 	<div class="form-group">
				                                        <label for="inputEmail1" class="col-lg-2 control-label strong">
				                                        Address
				                                         </label>
					                                      <div class="col-lg-9 value"> 
					                                       	<?php echo $employee['ContactPersonAddress']['address_1'] ?>
					                                       </div>
								                 	</div>
								                 	<div class="form-group">
				                                        <label for="inputEmail1" class="col-lg-2 control-label strong">
				                                        City
				                                         </label>
					                                      <div class="col-lg-9 value"> 
					                                       	<?php echo $employee['ContactPersonAddress']['city'] ?>
					                                       </div>
								                 	</div>
								                 	<?php if(!empty($employee['ContactPersonAddress']['state_province'])) : ?>
								                 		<div class="form-group">
					                                       	<label for="inputEmail1" class="col-lg-2 control-label strong">
					                                        	State
					                                        </label>
					                                      	<div class="col-lg-9 value"> 
					                                       	<?php echo $employee['ContactPersonAddress']['state_province'] ?>
					                                       </div>
								                 		</div>
								                    <?php endif;?>

								                    <?php if(!empty($employee['ContactPersonAddress']['zipcode'])) : ?>
								                 		<div class="form-group">
					                                       	<label for="inputEmail1" class="col-lg-2 control-label strong">
					                                        	State
					                                        </label>
					                                      	<div class="col-lg-9 value"> 
					                                       	<?php echo $employee['ContactPersonAddress']['zipcode'] ?>
					                                       </div>
								                 		</div>
								                    <?php endif; ?>		
								                 	


		                                 		</div>

												</div>
											</div>
												
											</header>
										</div>
								</div>

								</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>