<?php echo $this->element('payroll_setting_option');?><br><br>

<div class="row">
	<div class="col-lg-12">
		
		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					
                    
					<h1 class="pull-left">
						Social Security System Contribution Table
					</h1>
					<?php 
                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'settings', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
                    ?>
				</header>

			</div>
		</div>
		<?php echo $this->Form->create('SssRange',array('url'=>(array('controller' => 'payroll_settings','action' => 'sss_ranges_add'))));?>
			
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
										</div>
									</div>

									<div class="form-group">
										<label class="col-lg-2 control-label"><span style="color:red">*</span> Monthly Credit </label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('credits', array(
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
	                                            echo $this->Form->input('employers', array(
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
	                                            echo $this->Form->input('employees', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'placeholder' => 'Employees'));
                                            
                                            ?>

										</div>
									</div>


									<div class="form-group">
										<label class="col-lg-2 control-label"><span style="color:red">*</span> Employee Compensations</label>
										<div class="col-lg-8">
											<?php 
	                                            echo $this->Form->input('employee_compensations', array(
	                                            								'class' => 'form-control item_type',
							                                                    'label' => false,
							                                                    'placeholder' => 'Employee Compensations'));
                                            
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


						<div class="main-box-body clearfix">
							<div class="main-box-body clearfix">
								

							<div class="main-box clearfix">
							<header class="main-box-header clearfix">
							<h2 class="pull-left">Table</h2>
							<div id="reportrange" class="pull-right daterange-filter">
								<i class="icon-calendar"></i>
								<span></span> <b class="caret"></b>
							</div>
							</header>
							<div class="main-box-body clearfix">
							<div class="table-responsive">
								<table class="table">
								<thead>
									<tr>
										<th><a href="#"><span>Range of compensations</span></a></th>
										<th><a href="#" class="desc"><span>Credit</span></a></th>
										<th><a href="#" class="asc"><span>Employer</span></a></th>
										<th class="text-center"><span>Employee</span></th>
										<th class="text-center"><span>Employee Compensations</span></th>
										<th class="text-right"><span>Total Contibution</span></th>
										<th class="text-right"><span>Action</span></th>
									</tr>
								</thead>
								<tbody>
								<?php foreach ($ranges as $key => $range) { ?>
										
									<tr>
										<td>
											<?php echo $range['SssRange']['range_from'] ?>  - <?php echo $range['SssRange']['range_to'] ?>  
										</td>
										<td>
											<?php echo $range['SssRange']['credits']; ; ?> 
										</td>
										<td>
											<?php echo $range['SssRange']['employers']; $total = $range['SssRange']['employers']?> 
										</td>

										<td class="text-center">
											<?php echo $range['SssRange']['employees']; $total += $range['SssRange']['employees']?> 
										</td class="text-center">
										<td class="text-center">
											<?php echo $range['SssRange']['employee_compensations']; $total += $range['SssRange']['employee_compensations']?> 	
										</td>
										<td class="text-right">
											<?php echo $total; ?> 
										</td>

										<td class="text-right">
										<?php
										echo $this->Html->link('<span class="fa-stack">
										<i class="fa fa-square fa-stack-2x"></i>
										<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
										</span> ', array('controller' => 'payroll_settings', 'action' => 'sss_ranges_add',$range['SssRange']['id']),array('class' =>' table-link small-link-icon','escape' => false,'title'=>'Edit Information'));
										?>

										<?php
										echo $this->Html->link('<span class="fa-stack">
										<i class="fa fa-square fa-stack-2x"></i>
										<i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
										</span>', array('controller' => 'payroll_settings', 'action' => 'sss_ranges_delete',$range['SssRange']['id']),array('class' =>' table-link small-link-icon','escape' => false,'title'=>'Delete Information','confirm' => 'Do you want to delete this Process ?'));
										?>
										</td>
								</tr>
								<?php } ?>
								</tbody>
								</table>
							
							
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