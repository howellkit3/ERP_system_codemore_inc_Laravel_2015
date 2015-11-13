
<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			<center>
				<header class="main-box-header clearfix">
					<h1>Machine Logs</h1>
				</header>
			</center>
				
			<?php echo $this->Form->create('MachineLog',array('url' => array('controller' => 'machines','action' => 'save_logs'))); ?>	
			<div class="main-box-body clearfix">
				<div class="form-group">
					<?php 
						echo !empty($ticketData['JobTicket']['uuid']) ? 'SCH-'.ucfirst($ticketData['JobTicket']['uuid']) : '' ;
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
				</div>	
					
					<div class="form-group">
						<div class="col-lg-5">
							Schedule No :
							<?php 
								echo !empty($ticketData['JobTicket']['uuid']) ? 'SCH-'.ucfirst($ticketData['JobTicket']['uuid']) : '' ;
							?>
						</div>
						<div class="col-lg-4">
							Item 
							:&emsp;
							<?php echo !empty($productName[$ticketData['JobTicket']['product_id']]) ? $productName[$ticketData['JobTicket']['product_id']] : ''; ?>
						</div>
					</div>
					<div class="clearfix"></div>

					<br>
					<div class="form-group">
						<div class="col-lg-2">
								Quantity
						</div>
						<div class="col-lg-5">
							<div class="form-group">
								<label class="col-lg-3 control-label"><span style="color:red">*</span> Good </label>
	                                        <div class="col-lg-9">
	                                        	
	                                            <?php echo $this->Form->input('Output.good',
				                                         array('class' => 'form-control required',
				                                        'placeholder' => '00',
				                                        'type' => 'number',
				                                        'label' => false)); ?>

	                                        </div>
	                         </div>
						</div>
						<div class="col-lg-5">
							<div class="form-group">

	                                        <label class="col-lg-3 control-label"><span style="color:red">*</span> Reject </label>
	                                        
	                                        <div class="col-lg-9">
	                                        	<?php echo $this->Form->input('Output.reject',
				                                         array(
				                                        'class' => 'form-control required',
				                                        'placeholder' => '00',
				                                        'type' => 'number',
				                                        'label' => false));
				                                 ?>
				                           </div>
	                             </div>
						</div>
					</div>

					<div class="clearfix"></div>
					<br>
					<div class="form-group">
						<div class="col-lg-2">
								Machine
						</div>
						<div class="col-lg-5">
							<div class="form-group">

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
						</div>
						<div class="col-lg-5">
							<div class="form-group">

	                                        <label class="col-lg-3 control-label"><span style="color:red">*</span> End </label>
	                                        
	                                        <div class="col-lg-9">
	                                        	
	                                        	<?php if (!empty($logs['MachineLog']['end'])) : ?>

	                                        		<?php  $class = 'form-control required '; ?>

	                                        	<?php else : ?>
	                                        			<a id="endTime" data-job-id="<?php echo $logs['MachineLog']['id']; ?>" class="btn btn-default timeButton">End Process </a>
	                                        			<?php  $class = 'form-control required hide'; ?>
	                                        	<?php endif; ?>


	                                        		<?php echo $this->Form->input('end',
				                                         array('class' => $class,
				                                        'placeholder' => '00:00:00',
				                                        'value' => $logs['MachineLog']['end'],
				                                        'label' => false)); ?>		

				                           </div>
	                             </div>
						</div>
					</div>
					<div class="clearfix"></div><br>
					<div class="form-group">
						<div class="col-lg-2">
								DownTime
						</div>
						<div class="col-lg-5">
							<div class="form-group">

	                                        <label class="col-lg-3 control-label"><span style="color:red">*</span> Start </label>
	                                        <div class="col-lg-9">
	                                        	
	                                        	<?php if (!empty($logs['MachineLog']['dt_start'])) : ?>

	                                        		<?php  $class = 'form-control required '; ?>


	                                        	<?php else : ?>
	                                        			<a id="startTime" data-job-id="<?php echo $logs['MachineLog']['id']; ?>" class="btn btn-default timeButton">Click Here to START </a>
	                                        			<?php  $class = 'form-control required hide'; ?>
	                                        	<?php endif; ?>		

	                                        		<?php echo $this->Form->input('dt_start',
				                                         array('class' => $class,
				                                         'placeholder' => '00:00:00',
				                                       	'value' => $logs['MachineLog']['start'],
				                                        'label' => false,
				                                        )); ?>


	                                        </div>
	                             </div>
						</div>
						<div class="col-lg-5">
							<div class="form-group">

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

			  <div class="modal-footer pull-left">
               <button type="submit" class="btn btn-primary"><i class="fa icon-save"></i> Save</button>
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>

				<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(function(){



			$('body').on('click','.timeButton',function(){

				$timeNow = '<?php echo date("H:i:s"); ?>';

				$(this).addClass('hide');

				console.log($timeNow);

				$(this).next().find('input').removeClass('hide').val($timeNow);

				$('.timepicker').timepicker();
		});

			$('body').on('click','#startTime',function(){

				$timeNow = '<?php echo date("H:i:s"); ?>';

				$(this).addClass('hide');

				console.log($timeNow);

				$(this).next().find('input').removeClass('hide').val($timeNow);

				$('.timepicker').timepicker();
		});

		
	});
</script>