<?php echo $this->Form->create('MachineLog',array('url' => array('controller' => 'machines','action' => 'save_logs'))); ?>	
<?php 
		//echo !empty($ticketData['JobTicket']['uuid']) ? 'SCH-'.ucfirst($ticketData['JobTicket']['uuid']) : '' ;
		echo $this->Form->input('id',array(
			'value' => $ticketData['JobTicket']['id'],
			'type' => 'hidden'
		));
		echo $this->Form->input('Output.job_ticket_id',array(
			'value' => $ticketData['JobTicket']['id'],
			'type' => 'hidden'
		));
		echo $this->Form->input('Output.ticket_process_schedule_id',array(
			'value' => $logs['TicketProcessSchedule']['id'],
			'type' => 'hidden'
		));
		echo $this->Form->input('Output.machine_log_id',array(
			'value' => $logs['MachineLog']['id'],
			'type' => 'hidden'
		));
		echo $this->Form->input('Output.department_process_id',array(
			'value' => $logs['TicketProcessSchedule']['department_process_id'],
			'type' => 'hidden'
		));
?>
<div>
<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			<header class="main-box-header clearfix">
				<h2>LOGS</h2>
			</header>
			<div class="main-box-body clearfix">
					<form class="form-inline" role="form">
						<div class="form-group">
							<label class="" for="exampleInputEmail2"><strong> Schedule No :  </strong> </label>
								<?php echo !empty($ticketData['JobTicket']['uuid']) ? 'SCH-'.ucfirst($ticketData['JobTicket']['uuid']) : '' ; ?>
							</div>
						<div class="form-group">
							<label class="" for="exampleInputPassword2"> <strong> Item : </strong> </label>
								
								<?php echo !empty($ticketData['Product']['name']) ? $ticketData['Product']['name'] : ''; ?>
							</div>
					</form>
			</div>
		</div>
	</div>
</div>
<?php if(!empty($logs['TicketProcessSchedule']['machine_id'])) : ?>
<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
				<header class="main-box-header clearfix">
					<strong><h2> Machine </h2> </strong>
				</header>
				<div class="main-box-body clearfix">
						<div class="col-lg-6">
							<strong> Machine : </strong>
							( <?php echo  $machineData[$logs['TicketProcessSchedule']['machine_id']] ?>) 
						</div>
						<div class="col-lg-6">
							<strong> Operator : </strong>
							<?php

									if (!empty($logs['TicketProcessSchedule']['operator_id'])) {

										echo "( ".$employees[$logs['TicketProcessSchedule']['operator_id']]." )";
									}

							?>


						</div>
				</div>


				<div class="main-box-body clearfix">
					<strong>Process</strong>
				</div>


					<div class="main-box-body clearfix">
					<div class="form-group col-lg-6">
						<label class="col-lg-3 control-label"><span style="color:red">*</span> Start </label>
							<div class="col-lg-9">
                            	
                            	<?php if (!empty($logs['MachineLog']['start'])) : ?>

	                            <?php  $class = 'form-control required timepicker'; ?>

	                        	<?php else : ?>
                            			<a id="startTime" data-job-id="<?php echo $logs['MachineLog']['id']; ?>" class="btn btn-default timeButton">Click Here to START </a>
                            			<?php  $class = 'form-control required timepicker hide'; ?>
                            	<?php endif; ?>		

                            	<div class="row input_date <?php echo $class; ?>">
									<div class="form-group col-md-12">
											<div class="input-group input-append bootstrap-timepicker">
											<input type="text" class="form-control timepicker" name="data[MachineLog][start]">
											<span class="add-on input-group-addon"><i class="fa fa-clock-o"></i></span>
											</div>
									</div>
								</div>
<!-- 
                            		<?php echo $this->Form->input('start',
                                         array('class' => $class,
                                        'placeholder' => '00:00:00',
                                        'value' => $logs['MachineLog']['start'],
                                        'label' => false,
                                        )); ?> -->

                           </div>
					</div>
					<div class="form-group col-lg-6">
						<label class="col-lg-3 control-label"><span style="color:red">*</span> End </label>
						 <div class="col-lg-9">
	                         
	                         <?php if (!empty($logs['MachineLog']['dt_end'])) : ?>

                            	<?php  $class = 'form-control required '; ?>

                            	<?php else : ?>
                            			
                            			<a id="endTime" data-job-id="<?php echo $logs['MachineLog']['id']; ?>" class="btn btn-default timeButton">End Process </a>
                            			<?php  $class = 'form-control required hide'; ?>

                            	<?php endif; ?>

								<div class="row input_date <?php echo $class; ?>">
									<div class="form-group col-md-12">
											<div class="input-group input-append bootstrap-timepicker">
											<input type="text" class="form-control timepicker" name="data[MachineLog][dt_end]">
											<span class="add-on input-group-addon"><i class="fa fa-clock-o"></i></span>
											</div>
									</div>
								</div>
	                      </div>
					</div>
				</div>

				<!-- down time -->
				<div class="main-box-body clearfix">
					<strong>DownTime </strong>
				</div>

					<div class="main-box-body clearfix">
					<div class="form-group col-lg-6">
						<label class="col-lg-3 control-label"><span style="color:red">*</span> Start </label>
							<div class="col-lg-9">
                            	
                            	<?php if (!empty($logs['MachineLog']['start'])) : ?>

	                            <?php  $class = 'form-control required timepicker'; ?>

	                        	<?php else : ?>
                            			<a id="startTime" data-job-id="<?php echo $logs['MachineLog']['id']; ?>" class="btn btn-default timeButton">Click Here to START </a>
                            			<?php  $class = 'form-control required timepicker hide'; ?>
                            	<?php endif; ?>		

                            		<?php echo $this->Form->input('start',
                                         array('class' => $class,
                                        'placeholder' => '00:00:00',
                                        'value' => $logs['MachineLog']['start'],
                                        'label' => false,
                                        )); ?>

                           </div>
					</div>
					<div class="form-group col-lg-6">
						<label class="col-lg-3 control-label"><span style="color:red">*</span> End </label>
						 <div class="col-lg-9">
	                         
	                         <?php if (!empty($logs['MachineLog']['dt_end'])) : ?>

                            	<?php  $class = 'form-control required '; ?>

                            	<?php else : ?>
                            			<a id="endTime" data-job-id="<?php echo $logs['MachineLog']['id']; ?>" class="btn btn-default timeButton">End Process </a>
                            			<?php  $class = 'form-control required hide'; ?>
                            	<?php endif; ?>

                            	<?php echo $this->Form->input('dt_end',
                                         array('class' => $class,
                                        'placeholder' => '00:00:00',
                                        'value' => $logs['MachineLog']['end'],
                                        'label' => false)); ?>		

	                        </div>
					</div>
				</div>
				
				
	</div>
</div>
</div>
<?php endif; ?>

<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			<header class="main-box-header clearfix">
				<h2>Quantity</h2>
			</header>
					<div class="main-box-body clearfix">
					<div class="form-group col-lg-6">
						<label class="col-lg-3 control-label"><span style="color:red">*</span> Good </label>
						 <div class="col-lg-9">
	                                        	
	                                            <?php echo $this->Form->input('Output.good',
				                                         array('class' => 'form-control required',
				                                        'placeholder' => '00',
				                                        'type' => 'number',
				                                        'label' => false)); ?>

	                                        </div>
					</div>
					<div class="form-group col-lg-6">
						<label class="col-lg-3 control-label"><span style="color:red">*</span> Reject </label>
						 <div class="col-lg-9">
	                                        	
	                                            <?php echo $this->Form->input('Output.reject',
				                                         array('class' => 'form-control required',
				                                        'placeholder' => '00',
				                                        'type' => 'number',
				                                        'label' => false)); ?>

	                                        </div>
					</div>
				</div>
					<div class="main-box-body clearfix">
					<div class="form-group col-lg-6">
						<label class="col-lg-3 control-label"><span style="color:red">*</span> Scrap </label>
						 <div class="col-lg-9">
	                                        	
                                <?php echo $this->Form->input('Output.scrap',
                                         array('class' => 'form-control required',
                                        'placeholder' => '00',
                                        'type' => 'number',
                                        'label' => false)); ?>

	                                        </div>
					</div>
				</div>

				<header class="main-box-header clearfix">
				<h2>Waste</h2>
			</header>
					<div class="main-box-body clearfix">
					<div class="form-group col-lg-6">
						<label class="col-lg-3 control-label"><span style="color:red">*</span> Before Process </label>
						 <div class="col-lg-9">
	                                        	
	                                            <?php echo $this->Form->input('Output.waste_pre_process',
				                                         array('class' => 'form-control required',
				                                        'placeholder' => '00',
				                                        'type' => 'number',
				                                        'label' => false)); ?>

	                                        </div>
					</div>
					<div class="form-group col-lg-6">
						<label class="col-lg-3 control-label"><span style="color:red">*</span> On Process </label>
						 <div class="col-lg-9">
	                                        	
	                                            <?php echo $this->Form->input('Output.waste_on_process',
				                                         array('class' => 'form-control required',
				                                        'placeholder' => '00',
				                                        'type' => 'number',
				                                        'label' => false)); ?>

	                                        </div>
					</div>
				</div>
				
	</div>
</div>

	<?php switch ( $logs['TicketProcessSchedule']['department_process_id']) {
				case '1':
						echo $this->element('production_process/sheeter',array('departmentProcessId' => $logs['TicketProcessSchedule']['department_process_id'] ));
				break;
				
				default:
				break;
			}?>
<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			<header class="main-box-header clearfix">
				<h2>Next Process : </h2>
			</header>
	</div>
</div>
</div>
<div class="modal-footer pull-left">
	<button type="submit" class="btn btn-primary"><i class="fa icon-save"></i> Save</button>
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>

</div>
</div>
	<?php echo $this->Form->end(); ?>

<script type="text/javascript">
	$(function(){

		$('.timepicker').timepicker({
	            timeFormat: 'hh:mm:ss',
	            showSecond:true,
	            ampm: true
	    });  

		$('.timepicker').timepicker();

			$('body').on('click','.timeButton',function(){

				$timeNow = '<?php echo date("H:i:s"); ?>';

				$(this).addClass('hide');

				$(this).next().removeClass('hide').val($timeNow);

				//$('.timepicker').timepicker();
		});

		$('body').on('click','#startTime',function(){

				$timeNow = '<?php echo date("H:i:s"); ?>';

				$(this).addClass('hide');

				console.log($timeNow);

				$(this).next().find('input').removeClass('hide').val($timeNow);

				//$('.timepicker').timepicker();
		});

		
	});
</script>