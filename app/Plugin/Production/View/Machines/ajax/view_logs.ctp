
<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			<center>
				<header class="main-box-header clearfix">
					<h1>Machine Logs</h1>
				</header>
			</center>
				
<?php echo $this->Form->create('MachineLog',array('url' => array('controller' => 'machine_logs','action' => 'save_logs'))); ?>	
			<div class="main-box-body clearfix">	
					
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
					<hr>

					<div class="form-group">
						<div class="col-lg-2">
								Quantity
						</div>
						<div class="col-lg-5">
							<div class="form-group">

	                                        <label class="col-lg-3 control-label"><span style="color:red">*</span> Good </label>
	                                        <div class="col-lg-9">
	                                        	
	                                            <?php echo $this->Form->input('good',
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
	                                        	<?php echo $this->Form->input('reject',
				                                         array(
				                                        'class' => 'form-control required',
				                                        'placeholder' => '00',
				                                        'type' => 'number',
				                                        'label' => false)); ?>
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
	                                        			<a id="startTime" data-job-id="<?php echo $logs['MachineLog']['id']; ?>" class="btn btn-default">Click Here to START </a>
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
	                                        	
	                                        	<?php if (!empty($logs['MachineLog']['reject'])) : ?>

	                                        		<?php echo $this->Form->input('end',
				                                         array('class' => 'form-control required',
				                                         'placeholder' => '00:00:00',
				                                        'value' => $logs['MachineLog']['end'],
				                                        'label' => false)); ?>


	                                        	<?php else : ?>
	                                        			<a id="endTime" data-job-id="<?php echo $logs['MachineLog']['id']; ?>" class="btn btn-default">End Process</a>
	                                        			<?php  $class = 'form-control required hide'; ?>
	                                        	<?php endif; ?>		

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
	                                        	
	                                        	<?php if (!empty($logs['MachineLog']['start'])) : ?>

	                                        		<?php  $class = 'form-control required '; ?>


	                                        	<?php else : ?>
	                                        			<a id="startTime" data-job-id="<?php echo $logs['MachineLog']['id']; ?>" class="btn btn-default">Click Here to START </a>
	                                        			<?php  $class = 'form-control required hide'; ?>
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
	                                        	
	                                        	<?php if (!empty($logs['MachineLog']['reject'])) : ?>

	                                        		<?php echo $this->Form->input('end',
				                                         array('class' => 'form-control required',
				                                        'placeholder' => '00:00:00',
				                                        'value' => $logs['MachineLog']['end'],
				                                        'label' => false)); ?>


	                                        	<?php else : ?>
	                                        			<a id="endTime" data-job-id="<?php echo $logs['MachineLog']['id']; ?>" class="btn btn-default">End Process </a>
	                                        			<?php  $class = 'form-control required hide'; ?>
	                                        	<?php endif; ?>		

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

		$('body').on('click','#startTime',function(){

				$timeNow = '<?php echo date("H:i:s"); ?>';

				$(this).addClass('hide');

				console.log($timeNow);
				$(this).next().find('input').removeClass('hide').val($timeNow);

					$('.timepicker').timepicker({
					    minuteStep: 5,
					    showSeconds: true,
					    showMeridian: false,
					    disableFocus: false,
					    showWidget: true
					});
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