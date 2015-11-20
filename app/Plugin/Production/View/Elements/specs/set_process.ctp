<tr>
        <td colspan="4">

<div id="accordion" class="panel-group accordion">
<?php $processKey= 1; foreach ($dataSpecs['ProductSpecificationProcess']['ProcessHolder'] as $key => $processList) {   ?>

	<?php  if (!empty($subProcessData[$processList['ProductSpecificationProcessHolder']['sub_process_id']])) { ?>
   
	<div class="panel panel-default">
			<div class="panel-heading">
			<h4 class="panel-title">
			<a href="#collapse-<?php echo $processList['ProductSpecificationProcessHolder']['sub_process_id']; ?>" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed">
					 >>PP<?php echo $processKey ?> &nbsp <?php echo  $subProcessData[$processList['ProductSpecificationProcessHolder']['sub_process_id']]; ?>
			</a>
			</h4>
			</div>
			<div class="panel-collapse collapse <?php echo ( $processKey == 1 ) ? 'in' : '';?>" id="collapse-<?php echo $processList['ProductSpecificationProcessHolder']['sub_process_id']; ?>" >
				<div class="panel-body">
					<?php echo $this->Form->create('TicketProcessSchedule',array('url' => array('controller' => 'ticket_process_schedules','action' => 'set_process')));
					 echo $this->Form->input('job_ticket_id',array('value' => $jobData['JobTicket']['id'],'type' => 'hidden')); 
					 ?>
						<h1>Set Process</h1>
						<div class="row parent-collapse">
							<div class="col-lg-5">

								<div class="col-lg-9"> <?php echo $this->Form->input('production_date',array(
								'class' => 'datepicker form-control required','label' => 'Production Date','type' => 'text')); ?> </div>
							</div>
							<div class="col-lg-5">
								<div class="col-lg-9"> <?php echo $this->Form->input('department_process_id',array(
									'class' => 'select_process form-control required','label' => 'Process',
									'options' => $departmentProcess,
									'empty' => '-- Select Process --',
								)); ?> </div>
							</div>
							<div class="clearfix"></div>
							<div class="col-lg-5">
								<div class="col-lg-9"> 
								<?php 
									 echo $this->Form->input('remarks',array('type' => 'textarea','class' => 'form-control required','label' => 'Notes'));
								?> 
								</div>
							</div>
								<div class="col-lg-5">
								<div class="col-lg-9"> <?php echo $this->Form->input('machine_id',array(
								'class' => 'form-control machine_data required',
								'label' => 'Machine',
								'options' => $machines
								)); ?> </div>
							</div>
								
						</div>
						<div class="row button" style="margin:17px 1px">
							<div class="col-lg-5">
								<div class="clearfix"></div>
									<button class="btn btn-success"> Save </button> | <button class="btn btn-danger"> Clear </button>
								</div>
						</div>
				
						<?php echo $this->Form->end(); ?>
				</div>
			</div>
		</div>
		<?php } ?>

      
  <?php $processKey++;  } ?>
  </div>
  </td>
</tr>
