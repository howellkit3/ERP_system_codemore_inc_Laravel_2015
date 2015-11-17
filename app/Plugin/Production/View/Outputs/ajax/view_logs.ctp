<?php //echo $this->Html->css(array('bootstrap-timepicker'));

echo $this->Html->script(array(
                        'bootstrap-timepicker.min.js'
)); 

?>
<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			<center>
				<header class="main-box-header clearfix">
					<h1>Machine Logs</h1>
				</header>
			</center>
				
			<?php echo $this->Form->create('Output',array('url' => array('controller' => 'outputs','action' => 'save_logs'))); ?>	
			<div class="main-box-body clearfix">
				<div class="form-group">
					<?php 
						echo !empty($output['JobTicket']['uuid']) ? 'SCH-'.ucfirst($output['JobTicket']['uuid']) : '' ;
						echo $this->Form->input('Output.id',array(
							'value' => $output['Output']['id'],
							'type' => 'hidden'
						));
						echo $this->Form->input('Output.job_ticket_id',array(
							'value' => $output['JobTicket']['id'],
							'type' => 'hidden'
						));
						echo $this->Form->input('Output.ticket_process_schedule_id',array(
							'value' => $output['TicketProcessSchedule']['id'],
							'type' => 'hidden'
						));
						
						echo $this->Form->input('MachineLog.id',array(
							'value' => $output['MachineLog']['id'],
							'type' => 'hidden'
						));
						

						echo $this->Form->input('Output.department_process_id',array(
							'value' => $output['TicketProcessSchedule']['department_process_id'],
							'type' => 'hidden'
						));
					?>
				</div>	
					
					<div class="form-group">
						<div class="col-lg-5">
							Schedule No :
							<?php 
								echo !empty($output['JobTicket']['uuid']) ? 'SCH-'.ucfirst($output['JobTicket']['uuid']) : '' ;
							?>
						</div>
						<div class="col-lg-4">
							Item 
							:&emsp;
							<?php echo !empty($productName[$output['JobTicket']['product_id']]) ? $productName[$output['JobTicket']['product_id']] : ''; ?>
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
				                                        'value' => !empty($output['Output']['good']) ? $output['Output']['good'] : 0,
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
				                                        'value' => !empty($output['Output']['reject']) ? $output['Output']['reject'] : 0,
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
	                                        	
	                                        	<?php if (!empty($output['MachineLog']['start'])) : ?>

	                                        		<?php  $class = ''; ?>


	                                        	<?php else : ?>
	                                        			<a id="startTime" data-job-id="<?php echo $output['MachineLog']['id']; ?>" class="btn btn-default timeButton">Click Here to START </a>
	                                        			<?php  $class = '  hide'; ?>
	                                        	<?php endif; ?>		

	                                        		<?php
	                                        		 // echo $this->Form->input('MachineLog.start',
				                                        //  array(
				                                        // 'placeholder' => '00:00:00',
				                                        // 'value' => $output['MachineLog']['start'],
				                                        // 'label' => false,
				                                        // 'id' => 'timepicker'
				                                        // )); 

				                                        ?>

														<div class="form-group col-md-12 <?php echo $class; ?> timeFormat">
															<!-- <label for="timepicker">Time picker</label> -->
															<div class="input-group input-append bootstrap-timepicker">
															<input type="text" name="data[MachineLog][start]" class="timepicker form-control" value="<?php echo $output['MachineLog']['start'] ; ?>"

															<?php echo !empty($output['MachineLog']['start']) ? '' : 'disabled="disabled"' ?>
															>
															<span class="add-on input-group-addon"><i class="fa fa-clock-o"></i></span>
															</div>
														</div>


	                                        </div>

	                             </div>
						</div>
						<div class="col-lg-5">
							<div class="form-group">

	                                        <label class="col-lg-3 control-label"><span style="color:red">*</span> End </label>
	                                        
	                                        <div class="col-lg-9">
	                                        	
	                                        	<?php if (!empty($output['MachineLog']['end'])) : ?>

	                                        		<?php  $class = ''; ?>

	                                        	<?php else : ?>
	                                        			<a id="endTime" data-job-id="<?php echo $output['MachineLog']['id']; ?>" class="btn btn-default timeButton">End Process </a>
	                                        			<?php  $class = 'hide';
	                                        			 ?>
	                                        	<?php endif; ?>


	                                        	<div class="form-group col-md-12 <?php echo $class; ?> timeFormat">
															<!-- <label for="timepicker">Time picker</label> -->
															<div class="input-group input-append bootstrap-timepicker">
															<input type="text" name="data[MachineLog][end]" class="timepicker form-control" <?php echo !empty($output['MachineLog']['end']) ? '' : 'disabled="disabled"' ?> value="<?php echo $output['MachineLog']['end'] ; ?>">
															<span class="add-on input-group-addon"

															><i class="fa fa-clock-o"></i></span>
															</div>
												</div>

	                                        	<!-- 	<?php echo $this->Form->input('MachineLog.end',
				                                         array('class' => $class,
				                                        'placeholder' => '00:00:00',
				                                        'value' => $output['MachineLog']['end'],
				                                        'label' => false)); ?>		
 -->
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
	                                        	
	                                        	<?php if (!empty($output['MachineLog']['dt_start'])) : ?>

	                                        		<?php  $class = ''; ?>


	                                        	<?php else : ?>
	                                        			<a id="startTime" data-job-id="<?php echo $output['MachineLog']['id']; ?>" class="btn btn-default timeButton">Click Here to START </a>
	                                        			<?php  $class = 'hide'; ?>
	                                        	<?php endif; ?>		

	                                        	<!-- 	<?php echo $this->Form->input('MachineLog.dt_start',
				                                         array('class' => $class,
				                                         'placeholder' => '00:00:00',
				                                       	'value' => $output['MachineLog']['dt_start'],
				                                        'label' => false,
				                                        )); ?> -->

			                                        	<div class="form-group col-md-12 <?php echo $class; ?> timeFormat">
														<!-- <label for="timepicker">Time picker</label> -->
															<div class="input-group input-append bootstrap-timepicker">
															<input type="text" name="data[MachineLog][dt_start]" class="timepicker form-control" <?php echo !empty($output['MachineLog']['dt_start']) ? '' : 'disabled="disabled"' ?>  value="<?php echo $output['MachineLog']['dt_start'] ; ?>">
															<span class="add-on input-group-addon"><i class="fa fa-clock-o"></i></span>
														</div>
														</div>



	                                        </div>
	                             </div>
						</div>
						<div class="col-lg-5">
							<div class="form-group">

	                                        <label class="col-lg-3 control-label"><span style="color:red">*</span> End </label>
	                                        
	                                        <div class="col-lg-9">
	                                        	
	                                        	<?php if (!empty($output['MachineLog']['dt_end'])) : ?>

	                                        		<?php  $class = ''; ?>

	                                        	<?php else : ?>
	                                        			<a id="endTime" data-job-id="<?php echo $output['MachineLog']['id']; ?>" class="btn btn-default timeButton">End Process </a>
	                                        			<?php  $class = 'hide'; ?>
	                                        	<?php endif; ?>


	                                        	<!-- 	<?php echo $this->Form->input('MachineLog.dt_end',
				                                         array('class' => $class,
				                                        'placeholder' => '00:00:00',
				                                        'value' => $output['MachineLog']['dt_end'],
				                                        'label' => false)); ?>	 -->

				                                        	<div class="form-group col-md-12 <?php echo $class; ?> timeFormat">
														<!-- <label for="timepicker">Time picker</label> -->
																<div class="input-group input-append bootstrap-timepicker">
																<input type="text" name="data[MachineLog][dt_end]" class="timepicker form-control" <?php echo !empty($output['MachineLog']['dt_end']) ? '' : 'disabled="disabled"' ?> value="<?php echo $output['MachineLog']['dt_end'] ; ?>">
																<span class="add-on input-group-addon"><i class="fa fa-clock-o"></i></span>
																</div>	
															</div>


				                           </div>
	                             </div>
						</div>
					</div>

						<div class="clearfix"></div><br>
					<div class="form-group">
						<div class="col-lg-2">
								Status
						</div>
						<div class="col-lg-5">
							<div class="form-group">

	                                        <label class="col-lg-3 control-label"></label>
	                                        <div class="col-lg-9">
	                                        	
	                                        	
	                                        		<?php echo $this->Form->input('MachineLog.status',
				                                         array(
				                                         'class' => 'form-control',
				                                         'options' => array(
				                                         	'partial' => 'Partial',
				                                         	'full' => 'Full',
				                                         ),
				                                         'default' => $output['MachineLog']['status'],
				                                        'label' => false,
				                                        'empty' => '-- Change Status --'
				                                        )); ?>


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
		
		$('.timepicker').timepicker({
			minuteStep: 5,
			showSeconds: true,
			showMeridian: false,
			disableFocus: false,
			showWidget: true
		}).focus(function() {
			$(this).next().trigger('click');
		});

		$('body').on('click','.timeButton',function(){

				$timeNow = '<?php echo date("H:i:s"); ?>';

				$(this).addClass('hide');

				$(this).next().removeClass('hide').removeClass('hide').val($timeNow);

					$(this).next().find('.timepicker').attr('disabled',false);
				$('.timepicker').timepicker();
		});

		$('body').on('click','#startTime',function(){

				$timeNow = '<?php echo date("H:i:s"); ?>';

				$(this).addClass('hide');

				console.log($timeNow);

				$(this).next().removeClass('hide').val($timeNow);

					$(this).next().find('.timepicker').attr('disabled',false);

				$('.timepicker').timepicker();
		});

		
	});
</script>