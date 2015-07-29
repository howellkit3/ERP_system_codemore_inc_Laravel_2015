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
								<?php echo $this->CustomText->getFullname($employee['Employee']);  ?>
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

					</div>
					
				</div>
			</div>
			<div class="col-lg-9 col-md-8 col-sm-8">
				<div class="main-box clearfix">
					<div class="tabs-wrapper profile-tabs">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab-newsfeed" data-toggle="tab">Government Records</a></li>
							<li><a href="#tab-activity" data-toggle="tab">Work Schedules</a></li>
							<!-- <li><a href="#tab-chat" data-toggle="tab">Email</a></li>
							<li><a href="#tab-friends" data-toggle="tab">Contact Person</a></li>
							<li><a href="#tab-products" data-toggle="tab">Products</a></li> -->
							<?php 
		                        // echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'customer_sales', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
		                    ?>
						</ul>
						
						<div class="tab-content">
							<div class="tab-pane fade in active" id="tab-newsfeed">
							
								<div id="">
									<div class="story">
										
										<div class="story-content remove-pad">
											<header class="story-header">
												<div class="story-author">
													<div class="table-responsive">
														test	
													
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
	</div>
</div>

<?php echo $this->Form->create('Employee',array('url'=>(array('controller' => 'employees','action' => 'add')),
'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' ));?>
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box">
                        <h1> &nbsp </h1>
                        <!-- <div class="top-space"></div> -->
                        <div class="main-box-body clearfix">
                            <div class="main-box-body clearfix">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                    	<div class="col-lg-6">
                                     		<div class="form-group">
		                                        <label for="inputEmail1" class="col-lg-2 control-label strong">Name</label>
			                                      <div class="col-lg-9 value"> 
			                                       <?php echo $this->CustomText->getFullname($employee['Employee']);  ?>
			                                       </div>
		                                     </div>
		                                     <div class="form-group">
		                                        <label for="inputEmail1" class="col-lg-2 control-label strong">Employee #</label>
			                                      <div class="col-lg-9 value"> 
			                                       <?php echo rand(1000,80000);  ?>
			                                       </div>
		                                     </div>

		                                      <div class="form-group">
		                                        <label for="inputEmail1" class="col-lg-2 control-label strong">Department</label>
			                                      <div class="col-lg-9 value"> 
			                                       <?php echo !empty($departments[$employee['Employee']['department_id']]) ? $departments[$employee['Employee']['department_id']] : '';  ?>
			                                       </div>
		                                     	</div>

		                                     	<div class="form-group">
		                                        <label for="inputEmail1" class="col-lg-2 control-label strong">Position</label>
			                                      <div class="col-lg-9 value"> 
			                                       <?php echo !empty($positions[$employee['Employee']['position_id']]) ? $positions[$employee['Employee']['position_id']] : '';  ?>
			                                       </div>
		                                     	</div>

		                                 </div>



		                                 <div class="col-lg-6">
                                     		<div class="form-group">
		                                       <div class="col-lg-7">

		                                       <div class="form-group">
		                                        <label for="inputEmail1" class="col-lg-2 control-label strong"> Gender </label>
			                                      <div class="col-lg-9 value"> 
			                                       <?php echo !empty($employee['Employee']['gender']) ? $employee['Employee']['gender'] : '';  ?>
			                                       </div>
		                                     	</div>

		                                     	<div class="form-group">
		                                        <label for="inputEmail1" class="col-lg-2 control-label strong"> Status </label>
			                                      <div class="col-lg-9 value"> 
			                                        <?php echo !empty($employee['Employee']['status']) ? $employee['Employee']['status'] : '';  ?>
			                                       </div>
		                                     	</div>

			                                          
		                                        </div>
		                                        <div class="col-lg-4">
		                                        <?php
		                                        $style = '';

		                                        if (!empty($employee['Employee']['image'])) {

		                                        $serverPath = $this->Html->url('/',true);	
		                                        $background =  $serverPath.'img/uploads/employee/'.$employee['Employee']['image'];	
		                                        $style = 'background:url('.$background.')';
		                                        } 

		                                        ?>
		                                        <div class="image_profile" style="<?php echo $style; ?>"></div>

		                                     	</div>



		                                     </div>
		                                 </div>


                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
