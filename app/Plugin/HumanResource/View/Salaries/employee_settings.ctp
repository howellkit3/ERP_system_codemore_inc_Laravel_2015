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
                           Basic Salary
                        </h1> 
                    </center>
                     <div class="form-group pull-right">
                     	<?php echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'employees', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                   		?>
                    </div>
                  <!--   <div class="form-group pull-right" style="margin-right:10px;">
                    	
                    	<?php echo $this->Html->link('<i class="fa fa-pencil fa-lg"></i> Edit Information', array('controller' => 'employees', 'action' => 'edit',$employee['Employee']['id']),array('class' =>'btn btn-primary pull-right','escape' => false));
						?>

                    </div>

                    <div class="form-group pull-right" style="margin-right:10px;">
                    	
                    	<?php echo $this->Html->link('<i class="fa fa-money fa-lg"></i> Salary Settings', array('controller' => 'salaries', 'action' => 'employee_settings',$employee['Employee']['id']),array('class' =>'btn btn-primary pull-right','escape' => false));
						?>

                    </div> -->

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
					                                      <?php echo !empty($employee['Employee']['code']) ? $employee['Employee']['code'] : ''; //rand(1000,80000);  ?>
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
							<li class="active"><a href="#tab-ainfo" data-toggle="tab">Basic Salary Information</a></li>
						<!-- 	<li class=""><a href="#tab-ainfo" data-toggle="tab">Salary Adjustment</a></li> -->
							
						</ul>
						
						<div class="tab-content">
							
									<div class="tab-pane fade active in" id="tab-ainfo">

								        <?php echo $this->Form->create('Salary',array('url' => array('controller' => 'salaries','action' => 'employee_settings',$employee['Employee']['id']))); ?>
										<div class="story-content remove-pad">
											<header class="story-header">
											
												<div class="story-author">
														<div class="table-responsive">
															<div class="col-lg-12">
																<div class="form-group">
							                                        <label for="inputEmail1" class="col-lg-2 control-label strong"> Employee salary type </label>
								                                      <div class="col-lg-7 value">
								                                      		<?php
								                                      		 echo $this->Form->input('employee_salary_type',
								                                      		 	array(
								                                      		 		'options' => array(
								                                      		 			'daily' => 'Daily',
								                                      		 			'monthly' => 'Monthly'
								                                      		 		),
								                                      		 		'label' => false,
								                                      		 		'class' => 'form-control'
								                                      		 	));
								                                      		 ?>
								                                       </div>
							                                     </div>

							                                     <div class="clearfix"></div>
							                                     <div class="form-group">
							                                        <label for="inputEmail1" class="col-lg-2 control-label strong">  </label>
								                                      <div class="col-lg-7 value">
								                                      	
																	<div class="checkbox-nice">
																	<?php 
																		
																		$checked = !empty($this->request->data['Salary']['wage']) && $this->request->data['Salary']['wage'] == 'minimum' ? 'checked' : ''; 

																	?>	
																	<input type="checkbox" <?php echo $checked  ?> name="data[Salary][wage]" id="isMinimum" value="minimum">
																		<label for="isMinimum">
																			Minimun Wage
																		</label>
																	</div>

																	
					                                    			 </div>
							                                    <div class="col-lg-12">
							                                    <div class="form-group">
							                                        <label for="inputEmail1" class="col-lg-2 control-label strong"> Basic Salary  </label>
								                                      <div class="col-lg-7 value">
								                                      		<?php
								                                      		echo $this->Form->input('id');
								                                      		echo $this->Form->input('employee_id',array('type' => 'hidden' ,'value' => $employee['Employee']['id'])); 
								                                      		 echo $this->Form->input('basic_pay',array('label' => false,'class' => 'form-control'));
								                                      		 ?>
								                                       </div>
							                                     </div>
							                                     <div class="clearfix"></div>
																<div class="form-group">
							                                        <label for="inputEmail1" class="col-lg-2 control-label strong"> Tax Status </label>
								                                      <div class="col-lg-7 value">
								                                      		<?php
								                                      		 echo $this->Form->input('tax_status',
								                                      		 	array(
								                                      		 		'options' => array(
								                                      		 			'S' => 'Single',
								                                      		 			'S1' => 'Single 1 dependent',
																						'S2' => 'Single 2 dependents',
																						'S3' => 'Single 3 dependents',
																						'S4' => 'Single 4 dependents',
																						'ME' => 'Maried',
																						'ME1' => 'Maried 1 dependent',
																						'ME2' => 'Maried 2 dependents',
																						'ME3' => 'Maried 3 dependents',
																						'ME4' => 'Maried 4 dependents',
																						'no_exemption' => 'No Exemption'	
								                                      		 		),
								                                      		 		'empty' => '--- select ---',
								                                      		 		'label' => false,
								                                      		 		'class' => 'form-control'
								                                      		 	));
								                                      		 ?>
								                                       </div>
							                                     </div>
							                                     <div class="clearfix"></div>

					                                     		

							                                     <div class="form-group">
							                                        <label for="inputEmail1" class="col-lg-2 control-label strong"> Allowances </label>
								                                      <div class="col-lg-7 value"> 
								                                     		<?php echo $this->Form->input('allowances',array('label' => false,'class' => 'form-control')); ?>
								                                       </div>
							                                     </div>
							                                       <div class="clearfix"></div>

							                                      <div class="form-group">
							                                        <label for="inputEmail1" class="col-lg-2 control-label strong"> Comm Allowance </label>
								                                      <div class="col-lg-7 value"> 
								                                     		<?php echo $this->Form->input('communication_allowances',array('label' => false,'class' => 'form-control')); ?>
								                                       </div>
							                                     </div>

							                                       <div class="clearfix"></div>


							                                     <div class="form-group">
							                                        <label for="inputEmail1" class="col-lg-2 control-label strong"> CTPA </label>
								                                      <div class="col-lg-7 value"> 
								                                     		<?php echo $this->Form->input('ctpa',array('label' => false,'class' => 'form-control')); ?>
								                                       </div>
							                                     </div>
							                                      <div class="clearfix"></div>
							                                     <div class="form-group">
							                                        <label for="inputEmail1" class="col-lg-2 control-label strong"> SEA </label>
								                                      <div class="col-lg-7 value"> 
								                                     		<?php echo $this->Form->input('sea',array('label' => false,'class' => 'form-control')); ?>
								                                       </div>
							                                     </div>
			                                    			</div>
														</div>
												</div>
												
											</header>
											<hr class="dashed grey">
												<button class="btn btn-success"><i class="fa fa-check"></i> Submit </button> <button class="btn btn-default" type="reset"><i class="fa fa-times"></i> Clear </button>
										</div>
										<?php echo $this->Form->end(); ?>
									</div>

								
								</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){


		$('body').on('click','#isMinimum',function(e){

			$name = $(this).val();

			$('#SalaryBasicPay').val('');

			if ($(this).is(':checked') == true) {
				$.ajax({
					type: "GET",	
					url: serverPath + "payroll_settings/findWage/"+$name,
					dataType: "json",
					success: function(data) {

						try {

							$('#SalaryBasicPay').val(data.Wage.amount);
						} catch(e) {
							console.log(e);
						}	

					}
				});
			} 



			//e.preventDefault();


		});
	});
</script>