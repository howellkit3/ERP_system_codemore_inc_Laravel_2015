<?php $this->Html->addCrumb('Production', array('controller' => 'dashboards', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Jobs', array('controller' => 'jobs', 'action' => 'plans')); ?>
<?php $this->Html->addCrumb('Plans', array('controller' => 'jobs', 'action' => 'plans')); 
	$active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : '';
?>
<?php echo $this->Html->css(array('HumanResource.default'));?>
<?php echo $this->Html->script('Sales.jquery-sortable');?>
<?php echo $this->Html->script('Sales.draggableproducts');?>
<?php echo $this->Html->script(array(
						'jquery.maskedinput.min',
						'HumanResource.custom',
                        'Production.machine_schedule'
)); ?>
<?php 	//echo $this->element('production_options'); ?>
<div class="main-box">
	<div class="main-box-body clearfix">
		<div class="row">
			<div class="col-md-12">
				<br>
				<?php 	//echo $this->element('production_options'); ?>
				<?php 
					$active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : '';
				 	echo $this->element('tab/jobs',array('active_tab' => $active_tab)); 
				 ?>
			</div>
		</div>
	</div>
</div>


<div class="row">
	<div class="col-lg-12">
        <div class="main-box clearfix body-pad">
    		<div class="top-pad"></div>
			<div class="main-box-body clearfix">
			 
				<div class="tabs-wrapper">
					<div class="tab-content">
						<div class="tab-pane active" id="tab-calendar">
							<header class="main-box-header clearfix">
				                <h2 class="pull-left"><b>Items</b> </h2>
				                <div class="filter-block pull-right">

				                	<div class="form-group pull-left search-dropdown">
				                 		<?php 
				                 			echo $this->Form->input('process_id',array(
						                 		'options' => array(),
						                 		'class' => 'select-department-view form-control',
						                 		'label' => false,
						                 		'div'  => false,
						                 		//'default' => $department,
						                 		'empty'=> '-- Select Job Department --'

						                 		)); 

						                ?>
				                    </div>

				                 	<div class="form-group pull-left">
				                        <?php //echo $this->Form->create('Quotation',array('controller' => 'quotations','action' => 'search', 'type'=> 'get')); ?>
				                            <input placeholder="Search..." class="form-control searchMachine"  />
				                            <i class="fa fa-search search-icon"></i>
				                         <?php //echo $this->Form->end(); ?>
				                    </div>

				                    <div class="form-group pull-left">
			                 	
			                 			<input type="text" name="data[date]" id="changeDate" class="form-control datepick" value="<?php echo date('Y-m-d'); ?>">

			                            <i class="fa fa fa-calendar calendar-icon"></i>

			                    	</div>

				                   <br><br>
				               	</div>
				            </header>

							<div class="form-horizontal">	
								<!--text fields -->
								<section class="label-draggable-section">
									<section class="header-drag-section">
								    	<div class="form-group">
								    		<div class="col-lg-2 sched-header">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
												<b>Schedule No.</b>
											</div>
											<div class="col-lg-2 sched-header">
												<b>Customer</b>
											</div>
											<div class="col-lg-2 sched-header">
												<b>Product</b>
											</div>
											<div class="col-lg-2 sched-header">
												<b>Quantity</b>
											</div>
											<div class="col-lg-2 sched-header">
												<b>Production Status</b>
											</div>
											<div class="col-lg-2 sched-header">
												<b>Action</b>
											</div>
										</div>
									      
									</section>
									<ul id="sortable">
										
										<?php 
									        if(!empty($jobData)){
									            foreach ($jobData as $key => $jobList): ?>
													<li class="ui-state-default data-section">
													  <section class="dragField">
													    	<header class="dragHeader">
													          	<a class="remove-section pull-right" href="#">
																	<i class="fa fa-times-circle fa-fw fa-lg"></i>
																</a>
													    	</header>

													    	<div class="form-group parent-div-<?php echo $jobList['JobTicket']['id'] ?>">
													    		<div class="col-lg-2">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
																	<?php echo 'SCH - '.$jobList['ClientOrderDeliverySchedule']['uuid']; ?>
																</div>
																<div class="col-lg-2">
																	<?php echo ucfirst($companyData[$jobList['Product']['company_id']]); ?>
																</div>
																<div class="col-lg-2">
																	<?php echo ucfirst($jobList['Product']['name']); ?>
																</div>
																<div class="col-lg-2">
																	<?php echo $jobList['ClientOrderDeliverySchedule']['quantity']; ?>
																</div>
																<div class="col-lg-2 status-append">
																	<?php 
										                           		if (empty($jobList['JobTicket']['production_status'])) {
										                           			echo "<span class='label label-default'>Waiting For Schedule</span>";
										                           		}else{
										                           			if ($jobList['JobTicket']['production_status'] == 1) {
										                           				echo "<span class='label label-success'>Sheeter / Cutting</span>";
										                           			}
										                           		}
										                           	?>
																</div>
																<div class="col-lg-2">

																	<?php if (empty($jobList['JobTicket']['production_status'])) { ?>
																		<a data-toggle="modal" href="#myModalSchedule<?php echo $jobList['JobTicket']['id'] ?>" class="table-link">
																			<i class="fa fa-lg "></i>
																			<span class="fa-stack">
		                                            							<i class="fa fa-square fa-stack-2x "></i>
		                                            							<i class="fa  fa-calendar fa-stack-1x fa-inverse "></i>&nbsp;&nbsp;&nbsp;
		                                            							<span class ="post">
		                                            								<font size = "1px"> Sched </font>
		                                            							</span>
		                                            						</span>
		                                            					</a>
		                                            				<?php } else { ?>
		                                            					<a data-toggle="modal" href="#myModalScheduleView<?php echo $jobList['JobTicket']['id'] ?>" class="table-link">
																			<i class="fa fa-lg "></i>
																			<span class="fa-stack">
		                                            							<i class="fa fa-square fa-stack-2x "></i>
		                                            							<i class="fa  fa-search-plus fa-stack-1x fa-inverse "></i>&nbsp;&nbsp;&nbsp;
		                                            							<span class ="post">
		                                            								<font size = "1px"> View </font>
		                                            							</span>
		                                            						</span>
		                                            					</a>
		                                            				<?php } ?>
	                                            					<div class="modal fade" id="myModalSchedule<?php echo $jobList['JobTicket']['id'] ?>" role="dialog" >
										                                <div class="modal-dialog">
										                                    <div class="modal-content margintop">

										                                        <div class="modal-header">
										                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										                                            <h4 class="modal-title">Job Ticket / Machine Schedule</h4>
										                                        </div> 

										                                        <div class="modal-body">
										                                            <?php 

										                                                echo $this->Form->create('MachineSchedule',array(
										                                                    'url'=>(array('controller' => 'machine_schedules','action' => 'add')),'class' => 'form-horizontal','id' => 'updateMachineSchedule')); 
										                                            ?>

										                                                <div class="form-group">
										                                                    <label class="col-lg-2 control-label">Schedule #</label>
										                                                    <div class="col-lg-9">

										                                                        <?php 
										                                                            echo $this->Form->input('MachineSchedule.schedule_no', array(
										                                                                'class' => 'form-control required',
										                                                                'label' => false,
										                                                                'required' => 'required',
										                                                                'disabled' => 'disabled',
										                                                                'value' => $jobList['JobTicket']['uuid']
										                                                                ));

										                                                            echo $this->Form->input('MachineSchedule.job_ticket_id', array(
										                                                                'class' => 'form-control required',
										                                                                'label' => false,
										                                                                'required' => 'required',
										                                                                'type' => 'hidden',
										                                                                'value' => $jobList['JobTicket']['id']
										                                                                ));
										                                                            echo $this->Form->input('MachineSchedule.status_ticket', array(
										                                                                'class' => 'form-control required',
										                                                                'label' => false,
										                                                                'required' => 'required',
										                                                                'type' => 'hidden',
										                                                                'value' => 1
										                                                                ));

										                                                        ?>

										                                                    </div>
										                                                </div>

										                                                <div class="form-group">
										                                                    <label class="col-lg-2 control-label">Customer</label>
										                                                    <div class="col-lg-9">

										                                                        <?php 

										                                                            echo $this->Form->input('MachineSchedule.customer', array(
										                                                                'required' => 'required',
										                                                                'class' => 'form-control item_type editable limitQuantity',
										                                                                'label' => false,
										                                                                'disabled' => 'disabled',
										                                                                'value' => ucfirst($companyData[$jobList['Product']['company_id']])
										                                                                ));

										                                                        ?>
										                                                    </div>
										                                                </div>

										                                                <div class="form-group">
										                                                    <label class="col-lg-2 control-label">Item</label>
										                                                    <div class="col-lg-9">

										                                                        <?php 

										                                                            echo $this->Form->input('MachineSchedule.item', array(
										                                                                'required' => 'required',
										                                                                'class' => 'form-control item_type editable limitQuantity',
										                                                                'label' => false,
										                                                                'disabled' => 'disabled',
										                                                                'value' => ucfirst($jobList['Product']['name'])
										                                                                ));

										                                                        ?>
										                                                    </div>
										                                                </div>

										                                                <div class="form-group">
										                                                    <label class="col-lg-2 control-label">Quantity</label>
										                                                    <div class="col-lg-9">

										                                                        <?php 

										                                                            echo $this->Form->input('MachineSchedule.quantity', array(
										                                                                'required' => 'required',
										                                                                'class' => 'form-control item_type',
										                                                                'label' => false,
										                                                                'readonly' => true,
										                                                                'value' => $jobList['ClientOrderDeliverySchedule']['quantity']
										                                                                ));

										                                                        ?>
										                                                    </div>
										                                                </div>

										                                                <hr>

										                                                <h4 class="modal-title">Machine Schedule</h4>

										                                                <div class="form-group">
										                                                    <label class="col-lg-2 control-label">Machine</label>
										                                                    <div class="col-lg-9">

										                                                        <?php 

										                                                            echo $this->Form->input('MachineSchedule.machine_id', array(
										                                                                'options' => array($machineData),
										                                                                'class' => 'form-control required',
										                                                                'label' => false,
										                                                                'empty' => '-- select machine --'
										                                                                ));

										                                                        ?>
										                                                    </div>
										                                                </div>

										                                                <div class="form-group">
										                                                    <label class="col-lg-2 control-label">Date</label>
										                                                    <div class="col-lg-9">

										                                                        <input type="date" name="data[MachineSchedule][date]" min="<?php echo date('Y-m-d'); ?>" id="changeDate" class="form-control datepick" value="<?php echo date('Y-m-d'); ?>">
										                                                    </div>
										                                                </div>

										                                                <div class="form-group">
										                                                    <label class="col-lg-2 control-label">Time</label>
										                                                    <div class="col-lg-4 bootstrap-timepicker input-append">

										                                                        <?php
									                                                                echo $this->Form->input('MachineSchedule.from', array(
									                                                                    'type' => 'text',    
									                                                                    'class' => 'form-control col-lg-6 required timepicker workshift_from',
									                                                                    'label' => false,
									                                                                    ));
										                                                         ?>
										                                                    </div>

										                                                    <div class="col-lg-4 bootstrap-timepicker input-append">

										                                                        <?php
									                                                                echo $this->Form->input('MachineSchedule.to', array(
									                                                                    'type' => 'text',    
									                                                                    'class' => 'form-control col-lg-6 required timepicker workshift_from',
									                                                                    'label' => false,
									                                                                    ));
										                                                        ?>

										                                                    </div>
										                                                </div>

										                                                <div class="form-group">
										                                                    <label class="col-lg-2 control-label">Remarks</label>
										                                                    <div class="col-lg-9">

										                                                        <?php 

										                                                            echo $this->Form->input('MachineSchedule.remarks', array(
										                                                                'class' => 'form-control',
										                                                                'label' => false,
										                                                                ));

										                                                        ?>
										                                                    </div>
										                                                </div>

										                                                <div class="modal-footer">

										                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-arrow-circle-right fa-lg"></i> Proceed to Sheeter</button>
										                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

										                                                </div>
										                                            <?php echo $this->Form->end();  ?> 
										                                        </div>
										                                    </div>
										                                </div>
										                            </div>

										                        	<div class="md-overlay"></div> 
																</div>
															
															</div>
													      
													  </section>
													</li>
											<?php 
									            endforeach; 
									    } ?>
										
									</ul>
								</section>
								
							</div>

				        </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
	.fa-stack{
		color: #03a9f4;
	}
	.header-drag-section{
		background: #03A9F4;
		padding: 15px 1px 1px;
	}
	.sched-header{
		color: white;
	}
	.dragField{
		padding: 0px;
	}
	.table-link{
		position: relative;
		top: -17px;
	}
	.modal-header{
		background: #03A9F4;
		color: white;
	}
</style>
<script>
		
	jQuery(document).ready(function($){

		$("#MachineSchedulePlansForm").validate();
		
		$('.datepick').datepicker({
			format: 'yyyy-mm-dd'
		});

		$('.timepicker').timepicker({
		    minuteStep: 5,
		    showSeconds: true,
		    showMeridian: false,
		    disableFocus: false,
		    showWidget: true
		}).focus(function() {
		    $(this).next().trigger('click');
		});
		
	});


</script>