<tr>
        <td colspan="4">

<div id="accordion" class="panel-group accordion">
<?php $processKey= 1; foreach ($dataSpecs['ProductSpecificationProcess']['ProcessHolder'] as $key => $processList) {   ?>

	<?php  if (!empty($subProcessData[$processList['ProductSpecificationProcessHolder']['sub_process_id']])) { ?>
   
	<div class="panel panel-default">
			<div class="panel-heading">
			<h4 class="panel-title">
			<a href="#collapse-<?php echo $key; ?>" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed">
					 >>PP<?php echo $processKey ?> &nbsp <?php echo  $subProcessData[$processList['ProductSpecificationProcessHolder']['sub_process_id']]; ?>
			</a>
			</h4>
			</div>
			<div class="panel-collapse collapse <?php echo ( $processKey == 1 ) ? 'in' : '';?>" id="collapse-<?php echo $key; ?>" >
				<div class="panel-body">
					<?php echo $this->Form->create('ProductionProcess',array('url' => array('controller' => 'jobs','action' => 'set_dates'))); ?>
						<h1>Set Process</h1>
						<div class="row parent-collapse">
							<div class="col-lg-5">

								<div class="col-lg-9"> <?php echo $this->Form->input('production_date',array('class' => 'datepicker form-control','label' => 'Production Date')); ?> </div>
							</div>
							<div class="col-lg-5">
								<div class="col-lg-9"> <?php echo $this->Form->input('process',array('class' => 'select_process form-control','label' => 'Process',
									'options' => $departmentProcess,
									'empty' => '-- Select Process --',
								)); ?> </div>
							</div>
							<div class="clearfix"></div>
							<div class="col-lg-5">
								<div class="col-lg-9">  </div>
							</div>
								<div class="col-lg-5">
								<div class="col-lg-9"> <?php echo $this->Form->input('machines',array('class' => 'form-control machine_data','label' => 'Machine')); ?> </div>
							</div>
								
						</div>
						<div class="row button" style="margin:17px 1px">
							<div class="col-lg-5">
								<div class="clearfix"></div>
									<button class="btn btn-success"> Save </button> | <button class="btn btn-danger"> Clear </button>
								</div>
						</div>
				
						<?php $this->Form->end(); ?>
				</div>
			</div>
		</div>
		<?php } ?>

      
  <?php $processKey++;  } ?>
  </div>
  </td>
</tr>
